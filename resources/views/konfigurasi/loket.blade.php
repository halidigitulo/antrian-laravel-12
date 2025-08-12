<div class="row">
    <div class="col">
        <a href="" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
            data-bs-target="loketModal" id="addLoketButton"><i class="ri-add-line"></i> Tambah Data</a>
        <button id="reset-all-btn" class="btn btn-danger">
            <i class="ri-refresh-line"></i> Reset Semua Loket
        </button>

    </div>
</div>
<div class="row">
    <div class="col table-responsive">
        <table id="table_loket" class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nama Loket</th>
                    <th>Status</th>
                    <th>User Aktif</th>
                    <th>Aksi</th>
                </tr>
            </thead>

        </table>
    </div>
</div>

{{-- Modal  --}}
<div class="modal fade" id="loketModal" tabindex="-1" role="dialog" aria-labelledby="loketModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="loketModalLabel">Add Loket</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="loketForm">
                <div class="modal-body">
                    <input type="hidden" id="loket_id">
                    <div class="form-group">
                        <label for="nama_loket">Nama Loket</label>
                        <input type="text" class="form-control" id="nama_loket" name="nama" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="customSwitch1" class="form-check-label">Aktif?</label>
                        <input type="checkbox" id="customSwitch1" class="form-check-input">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveLoket">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>


@push('scripts')
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
                $('#table_loket').DataTable({
                    serverSide: true,
                    processing: true,
                    ajax: {
                        url: "{{ route('loket.index') }}",
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
                            data: 'is_aktif',
                            name: 'is_aktif',
                            orderable: false,
                            render: function(data, type, row) {
                                let checked = data == 1 ? 'checked' : '';
                                return `<input type="checkbox" class="form-check-input check-loket" data-id="${row.id}" ${checked} />`;
                            }
                        },
                        {
                            data: 'user_aktif',
                            name: 'user_aktif',
                            render: function(data, type, row) {
                                // If user_aktif is NULL, show a placeholder
                                return data ?
                                    `<span class="badge bg-success text-white">${data}</span>` :
                                    'Belum Dipilih';
                                `<span class="badge bg-secondary text-white"></span>`;
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
                    ], // Default ordering by the second column (kode_loket)
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
            $('#addLoketButton').click(function() {
                $('#loketForm')[0].reset(); // Clear the form
                $('#loket_id').val(''); // Clear hidden input
                $('#loketModalLabel').text('Add Loket'); // Set modal title
                $('#saveLoket').text('Create'); // Change button text
                $('#loketModal').modal('show'); // Show modal
            });

            // Show modal for updating an existing record
            $(document).on('click', '.edit-loket', function() {
                let id = $(this).data('id');
                // Fetch data from server using the ID
                $.get(`/konfigurasi/loket/${id}/edit`, function(data) {
                    $('#loket_id').val(data.id); // Populate hidden input
                    $('#nama_loket').val(data.nama); // Populate nama
                    $('#customSwitch1').prop('checked', data.is_aktif == 1); // Set checkbox state
                    $('#loketModalLabel').text('Edit Loket'); // Set modal title
                    $('#saveLoket').text('Update'); // Change button text
                    $('#loketModal').modal('show'); // Show modal
                });
            });

            // Handle form submission for both create and update
            $('#loketForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                let id = $('#loket_id').val();
                let url = id ? `/konfigurasi/loket/${id}` :
                '/konfigurasi/loket'; // Update if ID exists, otherwise create
                let method = id ? 'PUT' : 'POST'; // HTTP method
                let formData = {
                    nama: $('#nama_loket').val(),
                    is_aktif: $('#customSwitch1').is(':checked') ? 1 : 0,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                };

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        $('#table_loket').DataTable().ajax.reload();
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
                        $('#loketModal').modal('hide'); // Hide the modal
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

            $(document).on('click', '.reset-loket', function() {
                let id = $(this).data('id');

                Swal.fire({
                    title: "Konfirmasi Reset",
                    text: "Apakah Anda yakin ingin mereset user aktif di loket ini?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#3085d6",
                    cancelButtonColor: "#d33",
                    confirmButtonText: "Ya, Reset!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `antrian/loket/${id}/reset`,
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                            },
                            success: function(response) {
                                Swal.fire("Berhasil!", "Loket berhasil direset.",
                                    "success");
                                $('#table_loket').DataTable().ajax
                                    .reload(); // Reload DataTable
                            },
                            error: function(xhr) {
                                Swal.fire("Gagal!",
                                    "Terjadi kesalahan saat mereset loket.", "error"
                                );
                            }
                        });
                    }
                });
            });

            // Hapus Data 
            $(document).on('click', '.hapus-loket', function() {
                let id = $(this).data('id');
                let deleteUrl = '{{ route('loket.destroy', ':id') }}'.replace(':id', id);

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
                                $('#table_loket').DataTable().ajax
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

        // Reset semua loket
        document.getElementById('reset-all-btn').addEventListener('click', function() {
            Swal.fire({
                title: 'Reset Semua Loket?',
                text: 'Ini akan menghapus semua user aktif dari semua loket.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Ya, Reset!',
                cancelButtonText: 'Batal'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Send an AJAX request to reset all loket
                    fetch('{{ route('loket.resetAll') }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                    .content
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                Swal.fire('Berhasil!', 'Semua loket telah direset.', 'success')
                                    .then(() => location.reload()); // Reload the page to update the UI
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
@endpush
