@extends('layouts.form-cms')

@section('title', 'Tambah Data Alumni')
@section('backUrl', route('admin.alumni.index'))
@section('pageTitle', 'Tambah Alumni')

@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full mx-auto space-y-6">

            {{--  Foto Profil --}}
            <label class="block text-sm font-medium text-gray-700" for="image">Foto Alumni
                <span class="text-red-600">*</span>
            </label>
            <x-input.image-uploader name="image" />

            {{-- Nama Alumni --}}
            <x-input.text name="nama_alumni" label="Nama Alumni" placeholder="Masukkan Nama Lengkap" :required="true" />

            {{-- Tahun Lulus --}}
            <div>
                <label for="tahun_lulus" class="block text-sm font-medium text-gray-700">Tahun Lulus <span
                        class="text-red-600">*</span></label>
                <select id="tahun_lulus" name="tahun_lulus" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Pilih Tahun Lulus</option>
                    @for ($year = date('Y'); $year >= date('Y') - 15; $year--)
                        <option value="{{ $year }}">{{ $year }}</option>
                    @endfor
                </select>
            </div>


            {{-- Pekerjaan --}}
            <x-input.text name="pekerjaan" label="Pekerjaan" placeholder="Masukkan Pekerjaan Saat Ini" :required="true" />

            {{-- Lembaga --}}
            <div>
                <label for="lembaga" class="block text-sm font-medium text-gray-700">Lembaga <span
                        class="text-red-600">*</span></label>
                <select id="lembaga" name="lembaga" required
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                    <option value="">Pilih Lembaga</option>
                    <option value="0">SMP Darun Ihsan</option>
                    <option value="1">SMA Darun Ihsan</option>
                </select>
            </div>

            {{-- Tombol Simpan --}}
            <div class="pt-6 border-t">
                <x-button.save text="Simpan Data" />
            </div>

        </div>
    </form>
@endsection

@push('scripts')
    <script>
        $(document).ready(function () {
            const formData = new FormData()
            let formInput = $("form").find("input")
            let formTextArea = $("form").find("textarea")
            let formSelect = $("form").find("select")
            let nullValue = []

            function validateData (data) {
                if ($(data).val() === '' || $(data).val() === null) {
                    nullValue.push($(data).attr('name'))
                }
            }

            function postData (data) {
                try {
                    $.ajax({
                        url: "{{ url('admin/api/alumni') }}",
                        type: "POST",
                        data: data,
                        contentType: false,
                        processData: false,
                        success: function (response) {
                            console.log(response);
                        }
                    })
                } catch (error) {
                    console.log(error);
                }
            }

            $("#btnSimpan").on('click', function () {
                $.each(formInput, function (index, value) {
                    validateData(value);
                })
                $.each(formTextArea, function (index, value) {
                    validateData(value);
                })
                
                if (nullValue.length > 0) {
                    return false;
                }

                $.each(formInput, function (index, value) {
                    if ($(value).attr('type') === 'file') {
                        formData.append($(value).attr('name'), $(value)[0].files[0])
                    } else {
                        formData.append($(value).attr('name'), ($(value).val()))
                    }
                    
                })
                $.each(formTextArea, function (index, value) {
                    formData.append($(value).attr('name'), $(value).val())
                })
                $.each(formSelect, function (index, value) {
                    formData.append($(value).attr('name'), $(value).val())
                })

                postData(formData)
            })
        })
    </script>
@endpush
