<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\Dokter;
use App\Models\GeneralSetting;
use App\Models\JenisAntrian;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class AmbilAntrianController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $jenis_antrian = JenisAntrian::where('is_aktif', 1)->get();
        $runningText = GeneralSetting::first()->running_text ?? '';
        $dokter_cuti = Dokter::where('is_praktik', 0)->get();
        return view('antrian.ambil', compact('profile', 'jenis_antrian', 'runningText','dokter_cuti'));
    }

    public function generateQueue($jenisAntrianId)
    {
        try {
            $today = Carbon::now()->format('Y-m-d');

            // Find the active "JenisAntrian" or throw a 404 exception if not found
            $jenisAntrian = JenisAntrian::where('is_aktif', 1)->findOrFail($jenisAntrianId);

            // Get the last queue for today with the same prefix
            $lastQueue = Antrian::where('prefix', $jenisAntrian->kode_antrian)
                ->where('date', $today)
                ->orderBy('number', 'desc')
                ->first();

            // Calculate the next queue number
            $nextNumber = $lastQueue ? $lastQueue->number + 1 : 1;

            // Create a new queue record
            $queue = Antrian::create([
                'prefix' => $jenisAntrian->kode_antrian,
                'number' => $nextNumber,
                'date' => $today,
            ]);

            // Format the queue number (e.g., A-001)
            $queueNumber = sprintf('%s-%03d', $jenisAntrian->kode_antrian, $nextNumber);

            // Return success response with the queue number
            return response()->json([
                'success' => true,
                'queue' => $queueNumber
            ]);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            // Handle the case where the "JenisAntrian" is not found
            return response()->json([
                'success' => false,
                'message' => 'Jenis Antrian tidak ditemukan atau tidak aktif.'
            ], 404);
        } catch (\Exception $e) {
            // Handle general errors
            return response()->json([
                'success' => false,
                'message' => 'Terjadi kesalahan saat menghasilkan nomor antrian.',
                'error' => $e->getMessage(), // Optional: Include error details for debugging
            ], 500);
        }
    }
}
