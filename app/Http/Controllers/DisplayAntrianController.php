<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use App\Models\GeneralSetting;
use App\Models\Loket;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DisplayAntrianController extends Controller
{
    public function index()
    {
        $profile = Profile::first();
        $loket = Loket::where('is_aktif', 1)->get();
        $runningText = GeneralSetting::first()->running_text ?? '';
        foreach ($loket as $item) {
            $today = Carbon::now()->format('Y-m-d');
            $latestQueue = Antrian::where('loket_id', $item->id)
                ->where('date', $today)
                ->orderBy('created_at', 'desc')
                ->first();
            // dd($latestQueue);
            $item->latest_queue = $latestQueue ? $latestQueue->prefix . str_pad($latestQueue->number, 3, '0', STR_PAD_LEFT) : '-';
        }
        return view('antrian.display', compact('profile', 'loket', 'runningText'));
        // return view('antrian.display',compact('profile'));

    }

    public function getLatestQueues()
    {
        $loket = Loket::where('is_aktif', 1)->get(); // Fetch active counters

        foreach ($loket as $item) {
            $today = Carbon::now()->format('Y-m-d');
            $latestQueue = Antrian::where('loket_id', $item->id)
                ->where('date', $today)
                ->where('status', 1)
                ->orderBy('updated_at', 'desc')
                ->first();

            $item->latest_queue = $latestQueue ? $latestQueue->prefix . str_pad($latestQueue->number, 3, '0', STR_PAD_LEFT) : '-';
        }

        return response()->json($loket); // Return JSON response
    }


    public function getLatestCalledQueue()
    {
        // Fetch the latest called queue (status = 1 means it's been called)
        $today = Carbon::now()->format('Y-m-d');
        $latestCalledQueue = Antrian::where('status', 1)
            ->where('date', $today)
            ->orderBy('updated_at', 'desc') // Order by the most recent update
            ->first();

        if ($latestCalledQueue) {
            return response()->json([
                'queue' => $latestCalledQueue->prefix . str_pad($latestCalledQueue->number, 3, '0', STR_PAD_LEFT),
                'loket' => $latestCalledQueue->loket_id // Assuming 'loket_id' is the foreign key
            ]);
        }

        // If no queue has been called, return default values
        return response()->json([
            'queue' => '-',
            'loket' => '-'
        ]);
    }
}
