@extends('layouts.app')
@section('title', 'Dokter')
@section('content')
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title"><i class="ri-settings-line"></i> @yield('title')</h4>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <a href="" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
                                data-bs-target="dokterModal" id="adddokterButton"><i class="ri-add-line"></i> Tambah
                                Data</a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col table-responsive">
                            <table id="table_dokter" class="table table-hover table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama Dokter</th>
                                        <th>Spesialisasi</th>
                                        <th>Praktik</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>

                            </table>
                        </div>
                    </div>

                    {{-- Modal  --}}
                    <div class="modal fade" id="dokterModal" tabindex="-1" role="dialog"
                        aria-labelledby="dokterModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="dokterModalLabel">Add dokter</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="dokterForm">
                                    <div class="modal-body">
                                        <input type="hidden" id="dokter_id">
                                        <div class="form-group">
                                            <label for="nama_dokter">Nama Dokter</label>
                                            <input type="text" class="form-control" id="nama_dokter" name="nama"
                                                required>
                                        </div>
                                        <div class="form-group">
                                            <label for="spesialisasi_id">Spesialisasi</label>
                                            <select name="spesialisasi_id" id="spesialisasi_id" class="form-select select2">
                                                <option value="">Pilih Spesialisasi</option>
                                                @foreach ($spesialisasi as $item)
                                                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light waves-effect"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary" id="savedokter">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('style')
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.min.css" rel="stylesheet">
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script>
        $(document).ready(function() {
            fetchData();

            // Include CSRF token in all AJAX requests
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            // ambil data
            function fetchData() {
                $('#table_dokter').DataTable({
                    serverSide: true,
                    processing: true,
                    ajax: {
                        url: "{{ route('dokter.index') }}",
                        type: 'GET'
                    },
                    columns: [{
                            orderable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'nama',
                            name: 'nama',
                        },
                        {
                            data: 'spesialisasi',
                            name: 'spesialisasi',
                            render: function(data, type, row) {
                                return data ? data : 'Tidak ada spesialisasi';
                            }
                        },
                        {
                            data: 'is_praktik',
                            name: 'is_praktik',
                            orderable: false,
                            render: function(data, type, row) {
                                let checked = data == 1 ? 'checked' : '';
                                return `<input type="checkbox" class="form-check-input check-dokter" data-id="${row.id}" ${checked} />`;
                            }
                        },

                        {
                            data: 'aksi',
                            name: 'aksi',
                            orderable: false
                        },
                    ],
                    "columnDefs": [{
                        "targets": [3], // Center Price, Quantity, and Total columns
                        "className": "text-center"
                    }],
                    order: [
                        [1, 'asc']
                    ], // Default ordering by the second column (kode_dokter)
                    responsive: true, // Makes the table responsive
                    autoWidth: false, // Prevents auto-sizing of columns
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ], // Controls the page length options
                    pageLength: 10, // Default page length
                })
            }

            // Show modal for creating a new record
            $('#adddokterButton').click(function() {
                $('#dokterForm')[0].reset(); // Clear the form
                $('#dokter_id').val(''); // Clear hidden input
                $('#dokterModalLabel').text('Add Dokter'); // Set modal title
                $('#savedokter').text('Create'); // Change button text
                $('#dokterModal').modal('show'); // Show modal
            });

            // Show modal for updating an existing record
            $(document).on('click', '.edit-dokter', function() {
                let id = $(this).data('id');
                // Fetch data from server using the ID
                $.get(`/dokter/${id}/edit`, function(data) {
                    $('#dokter_id').val(data.id); // Populate hidden input
                    $('#nama_dokter').val(data.nama); // Populate nama
                    $('#spesialisasi_id').val(data.spesialisasi_id); // Populate nama
                    $('#customSwitch1').prop('checked', data.is_praktik == 1); // Set checkbox state
                    $('#dokterModalLabel').text('Edit dokter'); // Set modal title
                    $('#savedokter').text('Update'); // Change button text
                    $('#dokterModal').modal('show'); // Show modal
                });
            });

            // Handle form submission for both create and update
            $('#dokterForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                let id = $('#dokter_id').val();
                let url = id ? `/dokter/${id}` :
                    '/dokter'; // Update if ID exists, otherwise create
                let method = id ? 'PUT' : 'POST'; // HTTP method
                let formData = {
                    nama: $('#nama_dokter').val(),
                    spesialisasi_id: $('#spesialisasi_id').val(),
                    is_praktik: $('#customSwitch1').is(':checked') ? 1 : 0,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                };

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        $('#table_dokter').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            allowEnterKey: false,
                            toast: true,
                            position: 'top-end',
                        });
                        $('#dokterModal').modal('hide'); // Hide the modal
                        // Refresh the data table or UI
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Something went wrong.',
                            icon: 'error',
                            timer: 3000,
                            toast: true,
                            position: 'top-end',
                        });
                    },
                });
            });

            // Toggle dokter aktif status
            $(document).on('change', '.check-dokter', function() {
                let id = $(this).data('id');
                let isPraktik = $(this).is(':checked') ? 1 : 0;
                let url = `/dokter/${id}/updateStatus`;
                $.ajax({
                    url: url,
                    type: 'POST',
                    data: {
                        is_praktik: isPraktik,
                        _token: $('meta[name="csrf-token"]').attr('content'),
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            timer: 3000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end',
                        });
                    },
                    error: function(xhr) {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Failed to update status.',
                            icon: 'error',
                            timer: 3000,
                            toast: true,
                            position: 'top-end',
                        });
                    },
                });
            });

            // Hapus Data 
            $(document).on('click', '.hapus-dokter', function() {
                let id = $(this).data('id');
                let deleteUrl = '{{ route('dokter.destroy', ':id') }}'.replace(':id', id);

                Swal.fire({
                    title: 'Are you sure?',
                    text: 'This action cannot be undone!',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, delete it!',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: deleteUrl,
                            type: 'DELETE',
                            data: {
                                _token: "{{ csrf_token() }}"
                            },
                            success: function(response) {
                                $('#table_dokter').DataTable().ajax
                                    .reload(); // Reload the DataTable
                                Swal.fire('Deleted!', response.message, 'success');
                            },
                            error: function(xhr) {
                                Swal.fire('Error!', 'Failed to delete record.',
                                    'error');
                            },
                        });
                    }
                });
            });
        })
    </script>
    <script>
        $('#dokterModal').on('shown.bs.modal', function() {
            const selects = ['#spesialisasi_id'];

            selects.forEach(function(selector) {
                new TomSelect(selector, {
                    sortField: {
                        field: "text",
                        direction: "asc"
                    },
                    // dropdownParent: $('#modal-personalia'), // Ensure the dropdown remains properly aligned in the modal
                    closeAfterSelect: true // Optional: close dropdown after selecting an option
                });
            });
        });
    </script>
@endpush
