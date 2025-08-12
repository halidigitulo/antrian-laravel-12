<?php

namespace App\Http\Controllers;

use App\Models\Antrian;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $today = now()->format('Y-m-d');
        $jumlahAntrian = Antrian::whereDate('created_at',$today)->count();
        $asuransi = Antrian::whereDate('created_at',$today)->where('prefix','A')->count();
        $bpjs = Antrian::whereDate('created_at',$today)->where('prefix','B')->count();
        $mjkn = Antrian::whereDate('created_at',$today)->where('prefix','M')->count();
        return view('dashboard', compact('jumlahAntrian', 'asuransi', 'bpjs', 'mjkn'));
    }
}
