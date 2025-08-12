@extends('layouts.main')
@section('title', 'Ambil Antrian')
@section('content')
    <div class="row justify-content-between vh-100 justify-content-center" style="height: 100%">
        <div class="col-md-12 text-center mb-4">
            <!-- Logo with hover effect -->
            <img src="{{ asset('uploads/' . $profile->logo) }}" alt="{{ $profile->nama }}" class="img-fluid mb-3 logo-image">

            <!-- Title -->
            <h1 class="fw-bold animated-title">Antrian {{ $profile->nama }}</h1>

            <!-- Live Date & Time -->
            <h3 class="text-muted" id="date-day-time"></h3>
        </div>

        @php
            $colors = [
                'bg-gradient bg-danger',
                'bg-gradient bg-primary',
                'bg-gradient bg-success',
                'bg-gradient bg-warning',
            ];
        @endphp

        <div class="py-4 mb-4">
            <div class="p-4 mb-4 rounded-4 w-50 mx-auto text-center">
                <h5 class="text-center text-danger mb-3 animated-header" style="font-size: 1.8rem; font-weight: bold;">
                    <span style="background-color: #ffe6e6; padding: 8px 16px; border-radius: 8px; display: inline-block;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi bi-calendar-event me-2" viewBox="0 0 16 16" style="vertical-align: middle;">
                            <path
                                d="M4 .5a.5.5 0 0 1 .5.5V2h6V1a.5.5 0 0 1 1 0v1h1a2 2 0 0 1 2 2v1H1V4a2 2 0 0 1 2-2h1V1a.5.5 0 0 1 .5-.5z" />
                            <path
                                d="M16 14V5H0v9a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2zM1 7.5A.5.5 0 0 1 1.5 7H2v1h-.5a.5.5 0 0 1-.5-.5zM3 8h1v1H3V8zm2 0h1v1H5V8zm2 0h1v1H7V8zm2 0h1v1H9V8zm2 0h1v1h-1V8z" />
                        </svg>
                        Informasi Dokter Cuti
                    </span>
                </h5>


                @if ($dokter_cuti->isEmpty())
                    <div class="alert alert-success d-flex align-items-center justify-content-center" role="alert"
                        style="font-size: 1.8rem; font-weight: bold; border-radius: 10px; padding: 20px;">
                        <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                            class="bi bi-check-circle-fill me-3" viewBox="0 0 16 16">
                            <path
                                d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM6.97 11.03a.75.75 0 0 0 1.08-.02l3.992-4.99a.75.75 0 1 0-1.16-.96L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06l2.646 2.646z" />
                        </svg>
                        Tidak ada dokter yang sedang cuti
                    </div>
                @else
                    <div class="ticker-vertical-wrap">
                        <div class="ticker-vertical">
                            @foreach ($dokter_cuti as $dokter)
                                <div class="ticker-vertical-item">
                                    🩺 <strong>{{ $dokter->nama }}</strong>
                                    <span class="spesialisasi"
                                        style="background-color: {{ preg_match('/anak/i', $dokter->spesialisasi->nama ?? '')
                                            ? '#28a745'
                                            : (preg_match('/bedah/i', $dokter->spesialisasi->nama ?? '')
                                                ? '#dc3545'
                                                : (preg_match('/umum/i', $dokter->spesialisasi->nama ?? '')
                                                    ? '#17a2b8'
                                                    : '#ffc107')) }};
                    color: #fff;
                    padding: 2px 8px;
                    border-radius: 4px;
                    font-size: 0.9rem;
                    margin-left: 8px;">
                                        {{ $dokter->spesialisasi->nama ?? 'Tidak diketahui' }}
                                    </span>
                                    <span class="status" style="color: #ff0000; font-size: 0.9rem; margin-left: 8px;">
                                        (Sedang cuti)
                                    </span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>
            <h3 class="text-center fw-bold mb-4">🚀 Ambil Antrian Anda</h3>
            <div class="row justify-content-center">
                @foreach ($jenis_antrian as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card shadow-lg border-0 rounded-4 overflow-hidden text-center antrian-card"
                            onclick="generateQueue('{{ $item->id }}', '{{ $item->nama }}')"
                            style="cursor: pointer; transition: transform 0.3s ease-in-out;">

                            <div class="card-header text-white {{ $colors[$loop->index % count($colors)] }} py-3">
                                <h5 class="card-title fw-bold">{{ $item->nama }}</h5>
                            </div>


                            <div class="card-body position-relative">
                                <h1 class="fw-bolder display-1 text-primary queue-number"
                                    id="queue-display-{{ $item->id }}">-</h1>

                                <button class="btn btn-xl btn-dark w-100 rounded-5 shadow-sm card-btn">
                                    <i class="ri-fingerprint-line"></i> Ambil Antrian
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="bg-dark" style="height: 50px; position: fixed; bottom: 0px;">
            <h2 class="text-white">
                <marquee scrollamount="10">{{ $runningText }}</marquee>
            </h2>
        </div>
    </div>


@endsection
@push('style')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
        /* Smooth hover effect */
        .antrian-card:hover {
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }

        /* Animated queue number */
        .queue-number {
            transition: all 0.3s ease-in-out;
        }

        /* Button hover effect */
        .card-btn {
            transition: background 0.3s ease, transform 0.2s;
        }

        .card-btn:hover {
            background: linear-gradient(to right, #007bff, #0056b3);
        }

        /* Glassmorphism Card Style */
        .header-container {
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            border-radius: 15px;
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
            display: inline-block;
            padding: 20px;
        }

        /* Logo Styling */
        .logo-image {
            height: 150px;
            transition: transform 0.3s ease-in-out;
        }

        .logo-image:hover {
            transform: scale(1.05);
        }

        /* Animated Title */
        .animated-title {
            font-size: 2.5rem;
            letter-spacing: 2px;
            transition: color 0.3s ease-in-out;
        }

        .animated-title:hover {
            color: #007bff;
        }

        /* Live Date Styling */
        #date-day-time {
            font-size: 1.2rem;
            font-weight: 500;
            transition: opacity 0.3s ease-in-out;
        }


        .ticker-vertical-wrap {
            width: 100%;
            height: 60px;
            /* tinggi per item */
            overflow: hidden;
            background: #e9f5ff;
            border: 2px solid #007bff;
            border-radius: 8px;
            position: relative;
        }

        .ticker-vertical {
            display: flex;
            flex-direction: column;
            animation: tickerVerticalMove linear infinite;
        }

        .ticker-vertical-item {
            display: flex;
            justify-content: center;
            /* rata tengah horizontal */
            align-items: center;
            /* rata tengah vertikal */
            padding: 10px 15px;
            font-size: 1.2rem;
            font-weight: 600;
            color: #004085;
            white-space: nowrap;
            text-align: center;
            /* jaga-jaga kalau text multi-baris */
        }

        /* animasi akan diatur via JS */
        .ticker-vertical-item strong {
            margin-left: 10px;
            color: #0056b3;
        }


        .nama-dokter {
            font-size: 1.8rem;
            /* lebih besar dari teks biasa */
            font-weight: 700;
        }

        .spesialisasi {
            padding: 5px 10px;
            border-radius: 6px;
            font-size: 1.3rem;
            color: #fff;
            font-weight: 700;
        }

        .status {
            font-size: 1.2rem;
            color: #6c757d;
            font-style: italic;
        }

        @keyframes tickerMove {
            0% {
                transform: translateX(100%);
            }

            100% {
                transform: translateX(-100%);
            }
        }

        @keyframes fadeSlideIn {
            0% {
                opacity: 0;
                transform: translateY(-20px);
            }

            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .animated-header {
            animation: fadeSlideIn 1s ease-out;
        }
    </style>
@endpush
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        // Live Date & Time
        function updateDateTime() {
            const now = new Date();
            const options = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                hour12: false
            };
            document.getElementById('date-day-time').innerText = now.toLocaleString('id-ID', options);
        }

        setInterval(updateDateTime, 1000);
        updateDateTime();
    </script>
    <script>
        const hospitalName = @json($profile->nama);

        function generateQueue(jenisAntrianId, jenisAntrianName) {
            fetch(`/generate-queue/${jenisAntrianId}`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Update the queue display for the specific queue type
                        document.getElementById(`queue-display-${jenisAntrianId}`).innerText = data.queue;
                        // SweetAlert success notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Antrian Berhasil Dicetak',
                            html: `Antrian <br/> ${jenisAntrianName}: ${data.queue}`,
                            confirmButtonText: 'OK',
                            timer: 1000,
                        }).then(() => {
                            // Directly print the queue
                            // sendESCPOSToPrinter(hospitalName, jenisAntrianName, data.queue);
                            // printQueueToThermalPrinter(hospitalName, jenisAntrianName, data.queue);
                            printQueue(jenisAntrianName, data.queue);
                        });
                    } else {
                        // SweetAlert error notification
                        Swal.fire({
                            icon: 'error',
                            title: 'Failed',
                            text: 'Failed to generate queue. Please try again.',
                            confirmButtonText: 'OK'
                        });
                    }
                })
                .catch(error => {
                    console.error('Error:', error);

                    // SweetAlert error notification for fetch failure
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: 'An error occurred while generating the queue.',
                        confirmButtonText: 'OK'
                    }).then(() => {
                        window.location.reload(); // Refresh the page on error
                    });
                });
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let ticker = document.querySelector(".ticker-vertical");
            let items = document.querySelectorAll(".ticker-vertical-item");
            let itemHeight = items[0].offsetHeight;
            let totalItems = items.length;
            let durationPerItem = 3; // detik per item

            ticker.style.animationDuration = `${totalItems * durationPerItem}s`;

            let keyframes = `@keyframes tickerVerticalMove {`;
            for (let i = 0; i <= totalItems; i++) {
                let startPercent = (i / totalItems) * 100;
                let endPercent = ((i + 1) / totalItems) * 100;
                keyframes += `
            ${startPercent}% { transform: translateY(-${i * itemHeight}px); }
            ${endPercent}% { transform: translateY(-${i * itemHeight}px); }
        `;
            }
            keyframes += `}`;

            let styleSheet = document.createElement("style");
            styleSheet.innerHTML = keyframes;
            document.head.appendChild(styleSheet);
        });
    </script>

    {{-- Print dengan preview  --}}
    <script>
        function printQueue(jenisAntrianName, queue) {

            const now = new Date();
            const formattedDate = now.toLocaleDateString('id-ID', {
                weekday: 'long', // Display day name (e.g., Senin)
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });

            const formattedTime = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit'
            });

            // Create a hidden print area
            const printArea = document.createElement('div');
            printArea.id = 'print-area';
            printArea.style.position = 'absolute';
            printArea.style.top = '-1px';
            printArea.innerHTML = `
                <div style="width: 8cm; height: 7cm; text-align: center; font-family: Arial, sans-serif; margin: 0 auto; padding: 0;>
                <p style="margin: 5px 0; padding: 0;">${hospitalName}</p>
                <hr style="border: dotted 0.5px black">
                <p style="margin: 0; padding: 0;">Nomor Antrian Pendaftaran</p>
                <h3 style="margin: 5px 0; padding: 0;">${jenisAntrianName}</h3>
                <h1 style="font-size: 2.5rem; font-weight: bold; margin: 10px 0;">${queue}</h1>
                <p style="margin: 10px 0;">${formattedDate} - ${formattedTime}</p>
                <p style="margin: 10px 0;">Terimakasih atas kunjungan Anda 🙏</p>
                </div>
                `;

            // Append the print area to the body
            document.body.appendChild(printArea);

            // Set a media query for print styles
            const printStyle = document.createElement('style');
            printStyle.type = 'text/css';
            printStyle.innerHTML = `
                @media print {
                #print-area {
                    width: 8cm;
                    height: 7cm;
                    margin: 0;
                    padding: 0;
                    overflow: hidden;
                }
                body * {
                    visibility: hidden;
                }
                #print-area, #print-area * {
                    visibility: visible;
                }
                #print-area {
                    position: absolute;
                    left: 0;
                    top: 0;
                }
                }
                `;
            document.head.appendChild(printStyle);

            // Trigger the print
            window.print();

            // Clean up after printing
            setTimeout(() => {
                document.body.removeChild(printArea);
                document.head.removeChild(printStyle);
            }, 1000); // Wait for the print job to finish
        }
    </script>

    {{-- Direct print menggunakan QZ Tray --}}
    <script>
        qz.security.setCertificatePromise(function(resolve, reject) {
            resolve();
        });
        qz.security.setSignaturePromise(function(toSign) {
            return function(resolve, reject) {
                resolve();
            };
        });

        function printQueueToThermalPrinter(hospitalName, jenisAntrianName, queue) {
            const now = new Date();
            const formattedDate = now.toLocaleDateString('id-ID', {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric',
            });
            const formattedTime = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
            });

            const printContent = `
                <div style="text-align: center; font-family: Arial, sans-serif; width: 250px; padding: 10px;">
                    <h3 style="margin: 0; padding: 5px 0;">${hospitalName}</h3>
                    <hr style="border: 1px dashed black;">
                    <h4 style="margin: 0; padding: 5px 0;">Nomor Antrian Pendaftaran</h4>
                    <h2 style="margin: 10px 0; font-size: 2.5rem; font-weight: bold;">${queue}</h2>
                    <h4 style="margin: 10px 0;">${jenisAntrianName}</h4>
                    <hr style="border: 1px dashed black;">
                    <p style="margin: 5px 0;">Tanggal: ${formattedDate}</p>
                    <p style="margin: 5px 0;">Waktu: ${formattedTime}</p>
                    <hr style="border: 1px dashed black;">
                    <p style="margin: 10px 0;">Terimakasih atas kunjungan Anda 🙏</p>
                </div>
            `;


        }
    </script>
@endpush
