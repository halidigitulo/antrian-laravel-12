<div class="row">
    <div class="col">
        <a href="" class="btn btn-success waves-effect waves-light" data-bs-toggle="modal"
            data-bs-target="antrianModal" id="addAntrianButton"><i class="ri-add-line"></i> Tambah Data</a>
    </div>
</div>
<div class="row">
    <div class="col table-responsive">
        <table id="table_antrian" class="table table-hover table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Kode</th>
                    <th>Nama Antrian</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>

        </table>
    </div>
</div>

{{-- Modal  --}}
<div class="modal fade" id="antrianModal" tabindex="-1" role="dialog" aria-labelledby="antrianModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="antrianModalLabel">Add Antrian</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="antrianForm">
                <div class="modal-body">
                    <input type="hidden" id="antrian_id">
                    <div class="form-group">
                        <label for="kode_antrian">Kode</label>
                        <input type="text" class="form-control" id="kode_antrian" name="kode_antrian" required>
                    </div>
                    <div class="form-group">
                        <label for="nama_antrian">Nama Antrian</label>
                        <input type="text" class="form-control" id="nama_antrian" name="nama" required>
                    </div>
                    <div class="form-group mt-3">
                        <label for="customSwitchAntrian" class="form-check-label">Aktif?</label>
                        <input type="checkbox" id="customSwitchAntrian" class="form-check-input">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="saveAntrian">Save</button>
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
                $('#table_antrian').DataTable({
                    serverSide: true,
                    processing: true,
                    ajax: {
                        url: "{{ route('antrian.index') }}",
                        type: 'GET'
                    },
                    columns: [{
                            orderable: false,
                            render: function(data, type, row, meta) {
                                return meta.row + meta.settings._iDisplayStart + 1;
                            }
                        },
                        {
                            data: 'kode_antrian',
                            name: 'kode_antrian',
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
                                return `<input type="checkbox" class="form-check-input check-antrian" data-id="${row.id}" ${checked} />`;
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
                    ], // Default ordering by the second column (kode_antrian)
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
            $('#addAntrianButton').click(function() {
                $('#antrianForm')[0].reset(); // Clear the form
                $('#antrian_id').val(''); // Clear hidden input
                $('#antrianModalLabel').text('Add Antrian'); // Set modal title
                $('#saveAntrian').text('Create'); // Change button text
                $('#antrianModal').modal('show'); // Show modal
            });

            // Show modal for updating an existing record
            $(document).on('click', '.edit-antrian', function() {
                let id = $(this).data('id');
                // Fetch data from server using the ID
                $.get(`/konfigurasi/antrian/${id}/edit`, function(data) {
                    $('#antrian_id').val(data.id); // Populate hidden input
                    $('#kode_antrian').val(data.kode_antrian); // Populate nama
                    $('#nama_antrian').val(data.nama); // Populate nama
                    $('#customSwitchAntrian').prop('checked', data.is_aktif ==
                        1); // Set checkbox state
                    $('#antrianModalLabel').text('Edit antrian'); // Set modal title
                    $('#saveAntrian').text('Update'); // Change button text
                    $('#antrianModal').modal('show'); // Show modal
                });
            });

            // Handle form submission for both create and update
            $('#antrianForm').submit(function(e) {
                e.preventDefault(); // Prevent default form submission
                let id = $('#antrian_id').val();
                let url = id ? `/konfigurasi/antrian/${id}` :
                    '/konfigurasi/antrian'; // Update if ID exists, otherwise create
                let method = id ? 'PUT' : 'POST'; // HTTP method
                let formData = {
                    kode_antrian: $('#kode_antrian').val(),
                    nama: $('#nama_antrian').val(),
                    is_aktif: $('#customSwitchAntrian').is(':checked') ? 1 : 0,
                    _token: $('meta[name="csrf-token"]').attr('content'),
                };

                $.ajax({
                    url: url,
                    type: method,
                    data: formData,
                    success: function(response) {
                        $('#table_antrian').DataTable().ajax.reload();
                        Swal.fire({
                            title: 'Success!',
                            text: response.message,
                            icon: 'success',
                            timer: 3000,
                            // showClass: {
                            //     popup: 'animate__animated animate__fadeInDown'
                            // },
                            
                            toast: true,
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            position: 'top-end',
                        });
                        $('#antrianModal').modal('hide'); // Hide the modal
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

            // Hapus Data 
            $(document).on('click', '.hapus-antrian', function() {
                let id = $(this).data('id');
                let deleteUrl = '{{ route('antrian.destroy', ':id') }}'.replace(':id', id);

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
                                $('#table_antrian').DataTable().ajax
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
@endpush
