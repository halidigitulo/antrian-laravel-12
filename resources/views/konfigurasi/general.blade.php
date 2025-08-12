<form id="form_general">
    @csrf
    <div class="mb-3">
        <label for="running_text" class="form-label">Running Text</label>
        <input type="text" class="form-control" id="running_text" name="running_text"
            value="{{ $generalSettings->running_text ?? '' }}" placeholder="Masukkan running text">
    </div>
    <div class="mb-3">
        @can('general-settings.update')
            <button class="btn btn-primary" type="submit"><i class="ri-send-plane-line"></i>
                Submit</button>
        @endcan
    </div>
</form>

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#form_general').on('submit', function(e) {
                e.preventDefault();

                // Use FormData for file uploads
                let formData = new FormData(this);

                $.ajax({
                    type: "POST",
                    url: "{{ route('generalsettings.update') }}",
                    data: formData,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': "{{ csrf_token() }}"
                    },
                    success: function(response) {
                        Swal.fire({
                            position: "top-end",
                            icon: 'success',
                            title: 'Sukses',
                            text: response.message,
                            showConfirmButton: false,
                            timer: 1000,
                            toast: true,
                            background: '#28a745',
                            color: '#fff'
                        });

                        // Update logo preview if provided in the response
                        if (response.general_settings) {

                            // Update text fields
                            $('#running_text').val(response.general_settings.running_text);

                        }
                    },
                    error: function(xhr) {
                        if (xhr.status === 422) {
                            let errors = xhr.responseJSON.errors;
                            let errorMessage = '';
                            $.each(errors, function(key, value) {
                                errorMessage += value + '<br>';
                            });
                            Swal.fire({
                                title: 'Error!',
                                html: errorMessage,
                                icon: 'error',
                                position: 'top-end',
                                width: '400px',
                                showConfirmButton: false,
                                timer: 3000,
                                toast: true,
                                background: '#dc3545',
                                color: '#fff'
                            });
                        } else {
                            Swal.fire({
                                title: 'Error!',
                                text: 'Something went wrong. Please try again.',
                                icon: 'error',
                                position: 'top-end',
                                showConfirmButton: false,
                                timer: 3000,
                                toast: true,
                                background: '#dc3545',
                                color: '#fff'
                            });
                        }
                    }
                });
            });
        });
    </script>
@endpush
