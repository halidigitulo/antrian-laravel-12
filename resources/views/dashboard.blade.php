@extends('layouts.app')
@section('title', 'Dashboard')
@section('content')
    <div class="row">
        <div class="col mb-4">
            <h3>Dashboard</h3>
            <div class="alert alert-primary" role="alert">
                Halo, <span class="fw-bold">{{Auth::user()->name}} </span> 🎉 Selamat Datang di halaman dashboard.
            </div>
        </div>
    </div>
    <div class="row justify-content-center">
        <h4 class="text-center fw-bold mb-4">📢 Antrian Terbit Hari Ini</h4>

        <div class="col-md-3">
            <div class="card border-0 shadow-lg glass-card">
                <div class="card-header text-center">
                    <h6 class="fw-semibold text-uppercase">🏥 Asuransi / Umum</h6>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4 fw-bold text-primary">{{ $asuransi }}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-lg glass-card">
                <div class="card-header text-center">
                    <h6 class="fw-semibold text-uppercase">🩺 BPJS Kesehatan (On Site)</h6>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4 fw-bold text-success">{{ $bpjs }}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-lg glass-card">
                <div class="card-header text-center">
                    <h6 class="fw-semibold text-uppercase">📱 Mobile JKN</h6>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4 fw-bold text-warning">{{ $mjkn }}</h1>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-lg glass-card">
                <div class="card-header text-center">
                    <h6 class="fw-semibold text-uppercase">📊 Total Antrian Terbit</h6>
                </div>
                <div class="card-body text-center">
                    <h1 class="display-4 fw-bold text-danger">{{ $jumlahAntrian }}</h1>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <style>
        /* Glassmorphism Effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            border-radius: 12px;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .glass-card .card-header {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(5px);
            border-bottom: none;
            padding: 15px;
            font-weight: bold;
        }

        .glass-card .card-body h1 {
            font-size: 3rem;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.2);
        }

        .glass-card:hover {
            transform: scale(1.05);
            transition: all 0.3s ease-in-out;
            box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.2);
        }
    </style>
@endpush