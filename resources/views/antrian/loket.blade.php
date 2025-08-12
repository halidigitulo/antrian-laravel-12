@extends('layouts.app')
@section('title', 'Loket')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title text-white"><i class="ri-settings-line"></i> @yield('title')</h4>
                </div>
                <div class="card-body">
                    <div class="row justify-content-evenly">
                        @foreach ($loket as $item)
                            <div class="col-md-6 col-lg-2 col-xl-2 text-center">
                                <div class="card-container">
                                    <div class="card shadow-lg" style="width: 300px">
                                        <div class="card-body">
                                            <div class="card-title">
                                                <h5 class="fw-bold">{{ $item->nama }}
                                                </h5>
                                            </div>
                                            <?php
                                            $currentUser = auth()->user(); // Get logged-in user
                                            ?>

                                            <meta name="current-user-id" content="{{ $currentUser->id }}">

                                            <meta name="route-loket-detail" content="{{ url('antrian/loket') }}">
                                            @if ($item->user_aktif)
                                                <!-- Check if a user is already using the loket -->
                                                <h5 class="text-primary">
                                                    <a href="{{ route('loketantrian.detail', $item->id) }}">
                                                        <i class="ri-user-follow-line"></i> {{ $item->userAktif->name }}
                                                    </a>
                                                </h5>
                                            @else
                                                <h5 class="text-danger">
                                                    <a href="#" class="text-danger btn-pilih-loket"
                                                        data-loket-id="{{ $item->id }}"
                                                        data-user-aktif="{{ $item->user_aktif }}">
                                                        <i class="ri-login-box-line"></i> Masuk
                                                    </a>
                                                </h5>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.btn-pilih-loket').forEach(button => {

            button.addEventListener('click', function(e) {
                e.preventDefault();

                const loketId = this.dataset.loketId; // Get the selected loket ID
                const userAktif = this.dataset.userAktif; // Get current active user on this loket
                const baseRoute = document.querySelector('meta[name="route-loket-detail"]').content;
                const currentUserId = document.querySelector('meta[name="current-user-id"]')
                    .content; // Get logged-in user ID

                // If the logged-in user is already using this loket, redirect immediately
                if (userAktif == currentUserId) {
                    window.location.href = `/antrian/loket/${loketId}`;

                    return;
                }

                // If another user is already using this loket, suggest selecting another available loket
                if (userAktif && userAktif !== currentUserId) {
                    Swal.fire({
                        title: 'Loket Tidak Tersedia',
                        text: 'Loket ini sedang digunakan oleh pengguna lain. Silakan pilih loket lain yang tersedia.',
                        icon: 'warning',
                        confirmButtonText: 'OK'
                    });
                    return;
                }

                // If the loket is free, ask for confirmation to use it
                Swal.fire({
                    title: 'Pilih Loket?',
                    text: 'Anda akan menggunakan loket ini.',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, Pilih!',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Send AJAX request
                        fetch('{{ route('loketantrian.assignUser') }}', {
                                method: 'POST',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': document.querySelector(
                                        'meta[name="csrf-token"]').content
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
                                            title: 'Berhasil!',
                                            text: 'Loket Berhasil Dipilih',
                                            // confirmButtonText: 'OK',
                                            timerProgressBar: true,
                                            showConfirmButton: false,
                                            position: 'top-end',
                                            toast: true,
                                            timer: 1000,
                                        })
                                        .then(() => {
                                            // Redirect to the loketantrian.detail route with the selected loket ID
                                            window.location.href =
                                                `/antrian/loket/${loketId}`;

                                        });
                                } else {
                                    Swal.fire('Gagal!', data.message, 'error');
                                }
                            })
                            .catch(error => {
                                Swal.fire('Error!', 'Terjadi kesalahan. Silakan coba lagi.',
                                    'error');
                                console.error('Error:', error);
                            });
                    }
                });
            });
        });
    </script>
@endpush
