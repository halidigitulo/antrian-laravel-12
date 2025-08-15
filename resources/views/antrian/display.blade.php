@extends('layouts.main')
@section('title', 'Display Antrian')
@section('content')
    <div class="row justify-content-center align-middle vh-100">
        <div class="row align-items-center justify-content-evenly mb-5">

            <div class="col">
                <img id="preview-logo" src="{{ asset('uploads/' . $profile->logo) }}" alt="{{ $profile->nama }}"
                    class="rounded img-fluid mb-3" style="height: 100px; object-fit:cover">
            </div>
            <div class="col-md-6 text-center">
                <h1 class="fw-bold">Antrian Pendaftaran Pasien</h1>
            </div>
            <div class="col">
                <div class="row align-items-center text-end float-end">
                    <div class="col-auto">
                        <h4 class="fw-bold mb-0" id="day"></h4>
                        <h4 class="fw-bold mb-0" id="date"></h4>
                    </div>
                    <!-- Vertical Line -->
                    <div class="col">
                        <div class="vr" style="height: 100%; border-right: 2px solid #000;"></div>
                    </div>

                    <!-- Time -->
                    <div class="col">
                        <h4 class="fw-bold mb-0" id="time"></h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mb-3">
            <div class="col-md-8">
                @php
                    // Ambil ID video dari URL embed
                    preg_match('/embed\/([a-zA-Z0-9_-]+)/', $profile->video_url, $matches);
                    $videoId = $matches[1] ?? '';
                @endphp
                <!-- Video Container -->
                <div id="video-container" class="fade-in">
                    <iframe id="video-frame" style="border-radius: 15px;" width="100%" height="450px"
                        src="{{ $profile->video_url }}?autoplay=1&mute=0&loop=1&playlist={{ $videoId }}"
                        frameborder="0" allow="autoplay; encrypted-media" allowfullscreen>
                    </iframe>
                </div>

                <!-- Bed Availability Container (Initially Hidden) -->
                <div id="bed-container" class="fade-out d-none">
                    <h2 class="text-center text-muted"><i class="fas fa-bed"></i> Informasi Ketersediaan Tempat Tidur</h2>
                    <div class="row justify-content-center px-5" id="bed-info-container">
                        <!-- Bed availability cards will be inserted here dynamically -->
                    </div>
                </div>
            </div>
            {{-- <div class="col-md-4">
                <div class="card" style="height: 450px;">
                    <div class="card-header bg-danger">
                        <h5 class="card-title text-center text-white" style="font-size: 3rem">ANTRIAN SAAT INI</h5>
                    </div>
                    <div class="card-body text-center align-middle">
                        <h1>LOKET </h1>
                        <h1 id="loket-number" class="mt-4">-</h1>
                        <h1>ANTRIAN</h1>
                        <h1 id="called-queue">-</h1>
                    </div>
                </div>
            </div> --}}
            <div class="col-md-4">
                <div class="card shadow-lg border-0" style="height: 450px; border-radius: 15px;">
                    <div class="card-header bg-danger text-center"
                        style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                        <h5 class="card-title text-white mb-0" style="font-size: 2rem; letter-spacing: 2px;">ANTRIAN SAAT
                            INI</h5>
                    </div>
                    <div class="card-body d-flex align-items-center justify-content-center p-4"
                        style="background: linear-gradient(135deg, #fff, #f8f9fa);">
                        <div class="row w-100">
                            <!-- Nomor Loket -->
                            <div class="col-5 d-flex align-items-center justify-content-center"
                                style="border-right: 3px solid #e9ecef;">
                                <div class="text-center">
                                    <h6 class="text-muted mb-2" style="font-size: 1.2rem;">LOKET</h6>
                                    <h1 id="loket-number" style="font-size: 10rem; font-weight: bold; color: #dc3545;">-
                                    </h1>
                                </div>
                            </div>
                            <!-- Nomor Antrian -->
                            <div class="col-7 d-flex flex-column align-items-center justify-content-center">
                                <h6 class="text-muted mb-2" style="font-size: 1.2rem;">NOMOR ANTRIAN</h6>
                                <h1 id="called-queue" style="font-size: 5rem; font-weight: bold; color: #0d6efd;">-</h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="loket-container" class="row d-flex justify-content-evenly text-center">
            <!-- AJAX will load the Loket cards here -->
        </div>
        <div class="bg-dark" style="height: 50px; position: fixed; bottom: 0px;">
            <h2 class="text-white">
                <marquee scrollamount="10">{{ $runningText }}</marquee>
                {{-- <marquee scrollamount="10">Selamat datang di sistem antrian digital kami. Silakan tunggu giliran Anda.</marquee> --}}
            </h2>
        </div>
    </div>

@endsection
@push('style')
    <style>
        .fade-in {
            opacity: 1;
            transition: opacity 1.5s ease-in-out;
        }

        .fade-out {
            opacity: 0;
            transition: opacity 1.5s ease-in-out;
        }

        /* Animasi flip */
        .flip {
            animation: flip 0.6s ease-in-out;
        }

        @keyframes flip {
            0% {
                transform: rotateX(0);
            }

            50% {
                transform: rotateX(90deg);
                opacity: 0.3;
            }

            100% {
                transform: rotateX(0);
                opacity: 1;
            }
        }
    </style>
@endpush
@push('scripts')
    <script>
        function updateDateTime() {
            const date = new Date();
            const days = ["Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu"];
            const day = days[date.getDay()];

            const currentDate = date.toLocaleDateString('id-ID', {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            });


            const hours = date.getHours().toString().padStart(2, '0');
            const minutes = date.getMinutes().toString().padStart(2, '0');
            const seconds = date.getSeconds().toString().padStart(2, '0');
            const time = `${hours}:${minutes}:${seconds}`;

            document.getElementById('day').innerHTML = day;
            document.getElementById('date').innerHTML = currentDate;
            document.getElementById('time').innerHTML = time;

        }

        setInterval(updateDateTime, 1000); // Update every second
        updateDateTime();
    </script>

    <script>
        const latestQueuesUrl = "{{ route('loket.latest-queues') }}";

        function loadLoketData() {
            $.ajax({
                url: latestQueuesUrl, // Replace with your actual route
                method: 'GET',
                success: function(response) {
                    let loketHtml = '';
                    response.forEach(function(item) {
                        loketHtml += `
                    <div class="col-md-4 col-xl-2 col-sm-6 mb-3">
                        <div class="card-container">
                            <div class="card shadow-lg card-loket" style="width: 700px;">
                                
                                <div class="card-body text-center">
                                    <span class="badge bg-primary rounded-pill text-uppercase fw-bolder fs-3 mb-2">
                                        Loket ${item.id}
                                    </span>
                                    <h2 class="text-uppercase text-secondary mb-3">Antrian</h2>
                                    <h1 class="queue-number display-4 fw-bold">
                                        ${item.latest_queue ?? '000'}
                                    </h1>
                                </div>
                            </div>
                        </div>
                    </div>
                `;
                    });

                    // Update the container with the new HTML
                    $('#loket-container').html(loketHtml);
                },
                error: function(error) {
                    console.error('Error fetching Loket data:', error);
                }
            });
        }

        // Automatically refresh the data every 10 seconds
        setInterval(loadLoketData, 1000);
        loadLoketData(); // Initial call
    </script>

    <script>
        // Trigger immediately on page load
        // fetchLatestCalledQueue();

        function fetchLatestCalledQueue() {
            fetch('{{ route('loket.latest-called-queue') }}') // Update route name if needed
                .then(response => response.json())
                .then(data => {
                    // Update the main card with the latest called queue and loket
                    document.getElementById('called-queue').textContent = data.queue || '-';
                    document.getElementById('loket-number').textContent = data.loket ? `LOKET ${data.loket}` : '-';
                })
                .catch(error => console.error('Error fetching latest called queue:', error));
        }

        // Polling: Update every 5 seconds
        // setInterval(fetchLatestCalledQueue, 1000);
    </script>
    <script>
        console.log("Menunggu panggilan antrian...");

        let queue = [];
        let isPlaying = false;

        window.addEventListener('antrian-dipanggil', function(event) {
            console.log("Antrian diterima: ", event.detail);
            queue.push({
                nomor: event.detail.queueNumber,
                loket: event.detail.loketId
            });
            if (!isPlaying) {
                playNext();
            }
        });

        function playNext() {
            if (queue.length === 0) {
                isPlaying = false;
                return;
            }

            isPlaying = true;
            let {
                nomor,
                loket
            } = queue.shift();

            // Tampilkan ke layar
            document.getElementById('loket-number').innerText = loket;
            document.getElementById('called-queue').innerText = nomor;

            // Mulai mainkan suara
            playQueueSound(nomor, loket, () => {
                // Setelah suara selesai, lanjut ke antrian berikutnya
                playNext();
            });
        }

        function playQueueSound(queueNumber, loketNumber, callback) {
            const soundsPath = '/sounds/';
            const queueParts = queueNumber.split('');


            const soundSequence = [
                `${soundsPath}Pasien.wav`, // "Nomor Antrian"
                ...queueParts.map(part => `${soundsPath}${part}.wav`), // Queue number parts (e.g., "A", "0", "0", "1")
                `${soundsPath}KeLoket.wav`, // "Silakan ke Loket"
                `${soundsPath}${loketNumber}.wav`, // Loket number (e.g., "Loket 1")
                `${soundsPath}Terimakasih.wav`
            ];

            let currentIndex = 0;

            function playNextSound() {
                if (currentIndex >= soundSequence.length) {
                    callback(); // Semua suara selesai
                    return;
                }

                const audio = new Audio(soundSequence[currentIndex]);
                audio.play();
                audio.onended = () => {
                    currentIndex++;
                    playNextSound(); // Mainkan suara berikutnya
                };

                audio.onerror = () => {
                    console.error(`File tidak ditemukan: ${soundSequence[currentIndex]}`);
                    currentIndex++;
                    playNextSound(); // Tetap lanjutkan meskipun file error
                };
            }

            playNextSound();
        }
    </script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            let videoContainer = document.getElementById("video-container");
            let bedContainer = document.getElementById("bed-container");
            let isVideoPlaying = true;

            function toggleDisplay() {
                if (isVideoPlaying) {
                    // Fade out video and fade in bed info
                    videoContainer.classList.replace("fade-in", "fade-out");
                    bedContainer.classList.replace("fade-out", "fade-in");

                    // Hide video after animation, show bed info
                    setTimeout(() => {
                        videoContainer.classList.add("d-none");
                        bedContainer.classList.remove("d-none");
                    }, 1500);
                } else {
                    // Fade out bed info and fade in video
                    bedContainer.classList.replace("fade-in", "fade-out");
                    videoContainer.classList.replace("fade-out", "fade-in");

                    // Hide bed info after animation, show video
                    setTimeout(() => {
                        bedContainer.classList.add("d-none");
                        videoContainer.classList.remove("d-none");
                    }, 1500);
                }
                isVideoPlaying = !isVideoPlaying;
            }

            // Set interval to switch every 5 minutes (300,000 ms)
            setInterval(toggleDisplay, 30000);
        });



        // Function to fetch and display bed availability data
        function fetchBedAvailability() {
            fetch('https://10.99.19.11:442/api/master/inpatient-room-displaytt') // Replace with your actual API endpoint
                .then(response => response.json()) // Convert response to JSON
                .then(data => {
                    // console.log('API Response:', data); // Debugging: Check the structure of the response

                    // If `data` is an object, try accessing the correct key that contains the array
                    let bedData = Array.isArray(data) ? data : data.data;

                    // Check if bedData is actually an array
                    if (!Array.isArray(bedData)) {
                        throw new Error('Invalid data format: Expected an array');
                    }

                    const container = document.getElementById('bed-info-container');
                    container.innerHTML = ''; // Clear previous content

                    bedData.forEach(bed => {
                        const bedCard = `
                    <div class="col-md-3 g-5 mx-auto">
                        <div class="card shadow-lg bg-success " style="width: 18rem; border-radius: 15px;">
                            <div class="card-header">
                                <h5 class="card-title">${bed.namakelas}</h5>
                                </div>
                            <div class="card-body text-center">
                                <h3 class="card-text"><strong>Tersedia:</strong> </h3>
                                <h1 class="text-success fw-bolder" style="font-size:3rem;">${bed.tersedia} </h1>
                                <h2 class="bg-success rounded-pill py-3"><strong>Total:</strong> ${bed.kapasitas}</h2>
                            </div>
                        </div>
                    </div>
                `;
                        container.innerHTML += bedCard;
                    });
                })
                .catch(error => {
                    console.error('Error fetching bed availability:', error);
                    document.getElementById('bed-info-container').innerHTML =
                        '<p class="text-center text-danger">Failed to load bed availability.</p>';
                });
        }

        // Call function on page load
        fetchBedAvailability();

        // Auto-refresh every 30 seconds
        setInterval(fetchBedAvailability, 30000);
    </script>
    <script>
        function updateNumber(selector, newValue) {
            const el = document.querySelector(selector);
            if (el.innerText !== newValue) {
                el.classList.remove("flip");
                void el.offsetWidth; // restart animasi
                el.classList.add("flip");
                setTimeout(() => {
                    el.innerText = newValue;
                }, 300); // ganti angka di tengah animasi
            }
        }
    </script>
@endpush
