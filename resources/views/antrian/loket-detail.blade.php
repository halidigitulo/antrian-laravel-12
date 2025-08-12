@extends('layouts.app')
@section('title', 'Antrian Loket')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header align-items-center">
                    <a href="javascript:void(0);" class="btn btn-danger btn-sm float-start" id="kembali-btn">
                        <i class="ri-close-circle-fill"></i> Tutup Loket
                    </a>
                    <h4 class="fw-bold text-white"><i class="ri-sort-asc"></i> @yield('title') {{ $loket->id }}</h4>
                </div>
                <div class="card-body">
                    <h4 class="">Daftar Antrian Belum Dipanggil</h4>
                    <ul class="nav nav-tabs" id="queueTabs" role="tablist">
                        @foreach ($antrianAktif as $item)
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="asuransi-tab" data-type={{$item->kode_antrian}} data-bs-toggle="tab"
                                    data-bs-target={{$item->kode_antrian}} type="button" role="tab" aria-controls={{$item->kode_antrian}}
                                    aria-selected="true">{{$item->nama}}</button>
                            </li>
                        @endforeach
                       
                    </ul>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <div id="typeA" class="queue-table">
                                        <p class="mt-3">Loading data...</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                   

                    <hr>
                    <h4 class="mt-4">Daftar Antrian Sudah Dilayani</h4>

                    <div class="table-responsive scrollable-table" style="max-height: 300px; overflow-y: auto;">
                        <table class="table table-bordered table-striped table-sm" id="calledQueueTable">
                            <thead class="text-center fw-bold">
                                <tr>
                                    <th width="5%">#</th>
                                    <th>Nomor Antrian</th>
                                    <th>Status</th>
                                    <th>Jam Panggil</th>
                                    <th>Loket</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
   
    <script>
        $(document).ready(function() {
            // Check if there's a stored active tab in localStorage
            var activeTab = localStorage.getItem('activeTab');

            // If there's a stored tab, show it
            if (activeTab) {
                $('[data-bs-target="' + activeTab + '"]').tab('show');
            }

            // Save the active tab to localStorage when the tab is clicked
            $('button[data-bs-toggle="tab"]').on('shown.bs.tab', function(e) {
                var activeTab = $(e.target).attr('data-bs-target');
                localStorage.setItem('activeTab', activeTab);
            });
        });
    </script>
    <script>
        // Refresh by clicked btn
        document.getElementById('refresh-btn').addEventListener('click', function() {
            location.reload(); // Reloads the current page
        });

        // Alternatively, fetch immediately after "Panggil Antrian" is clicked
        document.querySelectorAll('.btn-panggil-antrian').forEach(button => {
            button.addEventListener('click', () => {
                fetchCalledQueues();
                // loadQueueData();
            });
        });

        function fetchCalledQueues() {
            fetch('{{ route('loket.get-called-queue') }}', {
                    method: 'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}', // Add CSRF token for Laravel
                    }
                })
                .then(response => response.json())
                .then(data => {
                    // Clear the container before updating
                    const tableBody = document.querySelector('#calledQueueTable tbody');
                    tableBody.innerHTML = ''; // Clear the table body before appending new rows

                    if (data.length === 0) {
                        // If there's no data, show a message
                        const row = `
                    <tr>
                        <td colspan="6" class="text-center">Belum ada antrian yang dipanggil.</td>
                    </tr>
                `;
                        tableBody.insertAdjacentHTML('beforeend', row);
                    } else {
                        // Loop through the data and append rows
                        data.forEach((queue, index) => {
                            const row = `
                        <tr>
                            <td class="text-center">${index + 1}</td>
                            <td>${queue.nomor_antrian}</td>
                            <td class="text-center"><span class="badge bg-success">${queue.status}</span></td>
                            <td>${queue.jam_panggil}</td>
                            <td class="text-center">${queue.loket}</td>
                            <td></td>
                        </tr>
                    `;
                            tableBody.insertAdjacentHTML('beforeend', row);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error fetching called queues:', error);
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: 'Terjadi kesalahan saat mengambil data antrian.',
                    });
                });
        }

        // Polling: Update every 5 seconds
        setInterval(fetchCalledQueues, 1000);

        // Trigger immediately on page load
        fetchCalledQueues();

        // Play Sound 
        function playQueueSound(queueNumber, loketNumber) {
            const soundsPath = '/sounds/'; // Path to your sounds folder in public
            const queueParts = queueNumber.split(''); // Split the queue number into parts (e.g., ["A", "0", "0", "1"])
            // const loketId = {{ $loket->id }}

            // Define the sequence of sound files
            const soundSequence = [
                `${soundsPath}Pasien.wav`, // "Nomor Antrian"
                ...queueParts.map(part => `${soundsPath}${part}.wav`), // Queue number parts (e.g., "A", "0", "0", "1")
                `${soundsPath}KeLoket.wav`, // "Silakan ke Loket"
                `${soundsPath}${loketNumber}.wav`, // Loket number (e.g., "Loket 1")
                `${soundsPath}Terimakasih.wav`
            ];

            // Play each part of the queue number sequentially
            let currentIndex = 0;

            function playNextSound() {
                if (currentIndex < soundSequence.length) {
                    const audio = new Audio(soundSequence[currentIndex]);
                    audio.play();
                    audio.onended = () => {
                        currentIndex++;
                        playNextSound();
                    };
                }
            }

            playNextSound(); // Start playing the sounds
        }

        // Tekan tombol kembali 
        document.getElementById('kembali-btn').addEventListener('click', function() {
            const loketId = {{ $loket->id }}; // Pass the current loket ID

            Swal.fire({
                title: 'Tutup Loket?',
                text: 'Ini akan menghapus user aktif dari loket.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Tutup!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send an AJAX request to update user_aktif to NULL
                    fetch('{{ route('loket.setUserAktifNull') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            },
                            body: JSON.stringify({
                                loket_id: loketId
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire({
                                    icon: 'success',
                                            icon: 'success',
                                            title: 'Berhasil!',
                                            text: 'Loket Berhasil Ditutup',
                                            // confirmButtonText: 'OK',
                                            timerProgressBar: true,
                                            showConfirmButton: false,
                                            position: 'top-end',
                                            toast: true,
                                            timer: 1000,
                                })
                                    .then(() => {
                                        // Redirect to the loket page
                                        window.location.href = '{{ route('loketantrian.index') }}';
                                    });
                            } else {
                                Swal.fire('Gagal!', data.message, 'error');
                            }
                        })
                        .catch(error => {
                            Swal.fire('Error!', 'Terjadi kesalahan. Silakan coba lagi.', 'error');
                            console.error('Error:', error);
                        });
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const tabs = document.querySelectorAll('.nav-link'); // Select all tab buttons

            // loadQueueData(queueType);

            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // const queueType = this.id.replace('-tab',
                    //     '');
                    const queueType = tab.getAttribute('data-type');
                    loadQueueData(queueType); // Load the queue data for this tab
                });
            });

            // Function to load queue data
            function loadQueueData(queueType) {
                fetch(`/antrian/${queueType}`)
                    .then(response => response.json())
                    .then(data => {
                        const tableContainer = document.querySelector('.queue-table');
                        if (!tableContainer) {
                            console.error(`Table container not found for queue type: ${queueType}`);
                            return;
                        }
                        console.log(queueType); // Should output the ID you're trying to target
                        console.log(document.querySelector('.queue-table'));
                        if (!data.length) {
                            tableContainer.innerHTML = '<p class="mt-3">Belum ada antrian.</p>';
                            return;
                        }

                        let tableHTML = `
                <table class="table table-bordered table-striped table-sm">
                    <thead class="text-center fw-bold">
                        <tr>
                            <th width="5%">#</th>
                            <th>Nomor Antrian</th>
                            <th width="10%">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
            `;

                        data.forEach((queue, index) => {
                            const queueNumber =
                                `${queue.prefix}${String(queue.number).padStart(3, '0')}`;
                            tableHTML += `
                    <tr>
                        <td class="text-center align-middle">${index + 1}</td>
                        <td class="fw-bold fs-4 text-center align-middle">${queueNumber}</td>
                        <td class="text-center">
                            <button class="btn btn-success btn-panggil-antrian" data-id="${queue.id}" data-queue-number="${queueNumber}">
                                <i class="ri-volume-up-line"></i> Panggil
                            </button>
                        </td>
                    </tr>
                `;
                        });

                        tableHTML += '</tbody></table>';
                        tableContainer.innerHTML = tableHTML;
                    })
                    .catch(error => console.error('Error fetching queue data:', error));
            }


            // loadQueueData(['asuransi', 'bpjs', 'umum']);
            loadQueueData();
        });

        document.addEventListener('click', function(event) {
            const callButton = event.target.closest('.btn-panggil-antrian');
            if (callButton) {
                const queueId = callButton.dataset.id;
                const queueNumber = callButton.dataset.queueNumber;
                const loketNumber = {{ $loket->id }}; // Replace with your dynamic Loket ID logic

                // Confirm the action with SweetAlert
                Swal.fire({
                    title: 'Panggil Antrian?',
                    text: `Anda akan memanggil antrian ${queueNumber}`,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Ya, Panggil!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Play queue sound (implement your sound-playing logic)
                        // playQueueSound(queueNumber, loketNumber);

                        // Make a POST request to the Laravel backend
                        fetch('panggil-antrian', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                        .content
                                },
                                body: JSON.stringify({
                                    queue_number: queueNumber,
                                    loket_id: loketNumber
                                })
                            })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    // Show success notification with SweetAlert
                                    Swal.fire(
                                        'Berhasil!',
                                        `Antrian ${queueNumber} berhasil dipanggil.`,
                                        'success'
                                    );

                                    // Remove the row from the table
                                    callButton.closest('tr').remove();
                                } else {
                                    // Show error notification with SweetAlert
                                    Swal.fire(
                                        'Gagal!',
                                        'Antrian tidak ditemukan atau gagal memanggil. Silakan coba lagi.',
                                        'error'
                                    );
                                }
                            })
                            .catch(error => {
                                // Show a generic error notification
                                Swal.fire(
                                    'Error!',
                                    'Terjadi kesalahan. Silakan coba lagi nanti.',
                                    'error'
                                );
                                console.error('Error:', error);
                            });
                    }
                });
            }
        });
    </script>
@endpush
