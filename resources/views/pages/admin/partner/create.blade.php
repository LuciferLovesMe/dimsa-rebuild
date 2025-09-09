@extends('layouts.form-cms')

@section('title', 'Tambah Data Partner')
@section('backUrl', route('admin.partner.index'))
@section('pageTitle', 'Tambah Data Partner')

@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full space-y-6">

            <x-input.image-uploader name="logo" />

            <x-input.text name="nama_mitra" label="Nama Partner" placeholder="Masukkan Nama Partner" :required="true" />

            <x-input.publish-checkbox name="is_publish" />

            <div class="pt-6 border-t">
                <x-button.save text="Simpan Data" />
            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#main-form').on('submit', function(event) {
                event.preventDefault();

                const apiUrl = "{{ url('/api/admin/partner/create') }}";
                const formData = new FormData(this);

                Swal.fire({
                    title: 'Menyimpan data...',
                    text: 'Mohon tunggu sebentar.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: apiUrl,
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        Swal.fire({
                            title: 'Berhasil!',
                            text: response.message || 'Data berhasil disimpan.',
                            icon: 'success',
                        }).then(() => {
                            window.location.href = "{{ route('admin.partner.index') }}";
                        });
                    },
                    error: function(xhr) {
                        Swal.close();
                        const errors = xhr.responseJSON.errors;
                        let errorMessages = '';
                        if (errors) {
                            for (const key in errors) {
                                errorMessages += `<p>${errors[key][0]}</p>`;
                            }
                        }
                        Swal.fire(
                            'Gagal!',
                            errorMessages || 'Terjadi kesalahan saat menyimpan data.',
                            'error'
                        );
                    }
                });
            });
        });
    </script>
@endpush
