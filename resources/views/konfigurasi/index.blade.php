@extends('layouts.app')
@section('title', 'Konfigurasi')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="ri-settings-line"></i> @yield('title')</h4>
                </div>
                <div class="card-body">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#general" role="tab">
                                <span class="d-block d-sm-none"><i class="fas fa-home"></i></span>
                                <span class="d-none d-sm-block">General</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#loket" role="tab">
                                <span class="d-block d-sm-none"><i class="far fa-user"></i></span>
                                <span class="d-none d-sm-block">Loket</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#settings" role="tab">
                                <span class="d-block d-sm-none"><i class="ri-list-check"></i></span>
                                <span class="d-none d-sm-block">Antrian</span>
                            </button>
                        </li>
                        <li class="nav-item">
                            <button class="nav-link" data-bs-toggle="tab" data-bs-target="#spesialisasi" role="tab">
                                <span class="d-block d-sm-none"><i class="ri-list-check"></i></span>
                                <span class="d-none d-sm-block">Spesialisasi</span>
                            </button>
                        </li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content p-3 text-muted">
                        <div class="tab-pane active" id="general" role="tabpanel">
                            <p class="mb-0">
                                @include('konfigurasi.general')
                            </p>
                        </div>
                        <div class="tab-pane" id="loket" role="tabpanel">
                            <p class="mb-0">
                                @include('konfigurasi.loket')
                            </p>
                        </div>
                        <div class="tab-pane" id="settings" role="tabpanel">
                            <p class="mb-0">
                                @include('konfigurasi.antrian')
                            </p>
                        </div>
                        <div class="tab-pane" id="spesialisasi" role="tabpanel">
                            <p class="mb-0">
                                @include('konfigurasi.spesialisasi')
                            </p>
                        </div>

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
@endpush
