<div class="row">
    <div class="col">
        @can('spesialisasi.create')
            <form id="generate-spesialisasi-form">
                @csrf
                <div class="mb-3">
                    <label for="modules">Nama Spesialisasi:</label>
                    <input type="text" id="nama" name="nama" class="form-control"
                        placeholder="Contoh: Spesialisasi Anak" required>
                </div>
                <button type="submit" id="generate-spesialisasi-btn" class="btn btn-primary">Simpan</button>
            </form>

            <div id="result" class="mt-3"></div>
        @endcan
    </div>
</div>
<div class="row">
    <div class="col table-responsive">
        <table class="table table-bordered table-striped" id="spesialisasi-table">
            <thead>
                <tr>
                    <th style="width: 20px">#</th>
                    <th>Nama Spesialisasi</th>
                    <th style="width: 5px" class="text-center">Aksi</th>
                </tr>
            </thead>
            {{-- <tbody></tbody> --}}
        </table>
    </div>
</div>

@push('scripts')
    <script>
        $(document).ready(function() {
            fetchData();

            function fetchData() {
                let table = $('#spesialisasi-table').DataTable({
                    serverSide: true,
                    processing: true,
                    ajax: {
                        url: "{{ route('spesialisasi.index') }}",
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
                            render: function(data, type, row) {
                                // Render input inline edit
                                return `
                        <input type="text" 
                            class="form-control edit-spesialisasi" 
                            value="${htmlEscape(data)}" 
                            data-id="${row.id}">
                    `;
                            }
                        },
                        {
                            data: 'aksi',
                            name: 'aksi',
                            orderable: false,
                            searchable: false
                        }
                    ],
                    order: [
                        [1, 'asc']
                    ],
                    responsive: true,
                    autoWidth: false,
                    lengthMenu: [
                        [10, 25, 50, -1],
                        [10, 25, 50, "All"]
                    ],
                    pageLength: 10
                });
            }

            // Tambah spesialisasi
            $('#generate-spesialisasi-form').submit(function(e) {
                e.preventDefault();

                let nama = $('#nama').val().trim();
                if (!nama) {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Field kosong',
                        text: 'Silakan isi nama spesialisasi terlebih dahulu.',
                        toast: true,
                        position: 'top-end',
                        timer: 3000
                    });
                    return;
                }

                $.ajax({
                    url: "{{ route('spesialisasi.store') }}",
                    method: 'POST',
                    data: {
                        _token: $('input[name=_token]').val(),
                        nama: nama
                    },
                    success: function(res) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Berhasil!',
                            text: res.message,
                            toast: true,
                            position: 'top-end',
                            timer: 2000
                        });
                        $('#generate-spesialisasi-form')[0].reset();
                        $('#spesialisasi-table').DataTable().ajax
                                    .reload();
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON?.message || 'Gagal menyimpan spesialisasi';
                        Swal.fire('Gagal', msg, 'error');
                    }
                });
            });

            function htmlEscape(str) {
                return String(str)
                    .replace(/&/g, '&amp;')
                    .replace(/"/g, '&quot;')
                    .replace(/'/g, '&#39;')
                    .replace(/</g, '&lt;')
                    .replace(/>/g, '&gt;');
            }

            // Inline edit spesialisasi
            $(document).on('change', '.edit-spesialisasi', function() {
                const input = $(this);
                const id = input.data('id');
                const nama = input.val();

                if (!nama) {
                    Swal.fire('Peringatan', 'Nama spesialisasi tidak boleh kosong', 'warning');
                    return;
                }

                $.ajax({
                    url: `konfigurasi/spesialisasi/${id}`,
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        _method: 'PUT',
                        nama: nama
                    },
                    success: function(res) {
                        Swal.fire({
                            title: 'Success!',
                            text: res.message,
                            toast: true,
                            icon: 'success',
                            position: 'top-end',
                            timer: 2000
                        });
                        table.ajax.reload(null, false);
                    },
                    error: function(xhr) {
                        let msg = xhr.responseJSON?.message || 'Terjadi kesalahan';
                        Swal.fire('Gagal', msg, 'error');
                    }
                });
            });

            // Tekan enter untuk simpan edit
            $(document).on('keypress', '.edit-spesialisasi', function(e) {
                if (e.which === 13) {
                    $(this).blur();
                }
            });

            // Hapus spesialisasi
            $(document).on('click', '.hapus-spesialisasi', function() {
                const id = $(this).data('id');

                Swal.fire({
                    title: 'Yakin menghapus?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Ya, hapus',
                    cancelButtonText: 'Batal'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: `konfigurasi/spesialisasi/${id}`,
                            method: 'POST',
                            data: {
                                _token: '{{ csrf_token() }}',
                                _method: 'DELETE'
                            },
                            success: function(res) {
                                Swal.fire({
                                    title: 'Success!',
                                    text: res.message,
                                    toast: true,
                                    icon: 'success',
                                    position: 'top-end',
                                    timer: 2000
                                });
                                $('#spesialisasi-table').DataTable().ajax
                                    .reload();
                            },
                            error: function() {
                                Swal.fire('Gagal', 'Gagal menghapus spesialisasi',
                                    'error');
                            }
                        });
                    }
                });
            });

        });
    </script>
@endpush
