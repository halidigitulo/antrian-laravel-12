<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\JenisAntrian;
use App\Models\Loket;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Events\AntrianDipanggil;
use Illuminate\Support\Facades\Auth;

class LoketAntrianController extends Controller
{
    public function index()
    {
        $loket = Loket::where('is_aktif', 1)->get();
        return view('antrian.loket', compact('loket'));
    }

    public function show($loket_id)
    {
        // Fetch the Loket by ID
        $today = Carbon::now()->format('Y-m-d');
        // $loket = Loket::findOrFail($loket_id);
        $loket = Loket::where('id', $loket_id)->where('is_aktif', 1)->firstOrFail();

        // Fetch all queues (Antrian) associated with this Loket
        $antrianBPJS = Antrian::where('date', $today)->where('prefix', 'B')->where('status', 0)->orderBy('created_at', 'asc')->get();
        $antrianMjkn = Antrian::where('date', $today)->where('prefix', 'M')->where('status', 0)->orderBy('created_at', 'asc')->get();
        $antrianAsuransi = Antrian::where('date', $today)->where('prefix', 'A')->where('status', 0)->orderBy('created_at', 'asc')->get();
        $sudahPanggil = Antrian::where('date', $today)->where('status', 1)->orderBy('updated_at', 'desc')->get();
        $antrianAktif = JenisAntrian::where('is_aktif', 1)->get();
        // Pass the data to the view
        return view('antrian.loket-detail', [
            'loket' => $loket,
            'antrianBPJS' => $antrianBPJS,
            'antrianMjkn' => $antrianMjkn,
            'antrianAsuransi' => $antrianAsuransi,
            'sudahPanggil' => $sudahPanggil,
            'antrianAktif' => $antrianAktif,
        ]);
    }

    public function getAntrianByType($type)
    {
        // dd($type);
        $today = Carbon::now()->format('Y-m-d');
        $queues = Antrian::whereDate('date', $today)
            // ->whereRaw('UPPER(prefix) = ?', [strtoupper($type)])
            ->where('prefix', strtoupper($type))

            // ->where('prefix', 'M')
            ->where('status', 0) // Use the type as the prefix
            ->orderBy('created_at', 'asc')
            ->get()
            ->map(function ($queue) {
                // Format the number with leading zeros
                $queue->number = str_pad($queue->number, 3, '0', STR_PAD_LEFT);
                return $queue;
            });

        return response()->json($queues); // Return the queues as JSON
    }

    public function panggilAntrian(Request $request)
    {
        $queueNumber = $request->input('queue_number');
        $loketId = $request->input('loket_id');
        $today = now()->format('Y-m-d');

        // Extract prefix and number from the queue_number
        $prefix = substr($queueNumber, 0, 1);
        $number = intval(substr($queueNumber, 2));

        // Fetch the queue from the database
        $queue = Antrian::where('prefix', $prefix)
            ->where('number', $number)
            ->where('date', $today)
            ->first();

        if ($queue) {
            // Update the queue status to 'called'
            // $queue->status = 'called';
            $queue->status = 1;
            $queue->loket_id = $loketId;
            $queue->save();

            event(new AntrianDipanggil($queueNumber, $loketId));
            
            return response()->json(['success' => true, 'message' => 'Queue called successfully']);
        }

        // Return error if the queue is not found
        return response()->json(['success' => false, 'message' => 'Queue not found']);
    }

    public function assignUser(Request $request)
    {
        $loketId = $request->input('loket_id');
        $userId = Auth::id(); // Get the authenticated user's ID

        // Find the loket and update the user_aktif field
        $loket = Loket::find($loketId);

        if ($loket) {
            // Check if the loket is already assigned to another user
            if ($loket->user_aktif && $loket->user_aktif != $userId) {
                return response()->json([
                    'success' => false,
                    'message' => 'Loket sudah digunakan oleh pengguna lain.'
                ]);
            }

            // Assign the authenticated user to the loket
            $loket->user_aktif = $userId;
            $loket->save();

            return response()->json([
                'success' => true,
                'message' => 'Loket berhasil dipilih.'
            ]);
        }

        return response()->json([
            'success' => false,
            'message' => 'Loket tidak ditemukan.'
        ]);
    }

    public function setUserAktifNull(Request $request)
    {
        $loketId = $request->input('loket_id');

        // Find the loket and set user_aktif to NULL
        $loket = Loket::find($loketId);

        if ($loket) {
            $loket->user_aktif = null;
            $loket->save();

            return response()->json(['success' => true, 'message' => 'User aktif telah direset.']);
        }

        return response()->json(['success' => false, 'message' => 'Loket tidak ditemukan.']);
    }

    public function reset($id)
    {
        $loket = Loket::findOrFail($id);
        $loket->user_aktif = null;
        $loket->save();

        return response()->json(['status' => 'success', 'message' => 'Loket berhasil direset']);
    }


    public function getCalledQueue(Request $request)
    {
        // Fetch all queues with status = 1, including related loket data if needed

        $today = Carbon::now()->format('Y-m-d');
        $calledQueues = Antrian::where('status', 1)->with('loket')
            ->where('date', $today)
            ->orderBy('updated_at', 'desc')
            // Assuming a relationship exists with the Loket model
            ->get();

        // Format the data to include nomor_antrian and loket name
        $formattedQueues = $calledQueues->map(function ($queue) {
            return [
                'nomor_antrian' => $queue->prefix . str_pad($queue->number, 3, '0', STR_PAD_LEFT), // Format queue number
                'loket' => $queue->loket->nama ?? 'Tidak Diketahui', // Loket name or fallback
                'jam_panggil' => date('d-m-Y h:i:s A', strtotime($queue->updated_at)),
                'status' => $queue->status === 1 ? 'Sudah Panggil' : 'Belum Panggil',
            ];
        });

        // Return JSON response
        return response()->json($formattedQueues);
    }
}
