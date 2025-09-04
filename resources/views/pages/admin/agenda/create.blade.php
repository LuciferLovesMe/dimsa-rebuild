@extends('layouts.form-cms')
@section('title', 'Tambah Data Agenda')
@section('backUrl', route('admin.agenda.index'))
@section('pageTitle', 'Tambah Agenda')
@section('formContent')
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 flex flex-col gap-y-6">

                <x-input.textarea name="nama" label="Nama Agenda" placeholder="Nama Agenda" :required="true" />


                <div class=" md:grid-cols-2 gap-6">
                    <x-input.date name="datetime" label="Tanggal Agenda" />
                </div>

                <x-input.textarea name="alamat" label="Alamat Agenda" placeholder="Alamat Agenda" :required="true" />

            </div>

            <div class="space-y-6">
                <x-input.image-uploader name="image" />
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
            let nullValue = []

            function validateData (data) {
                if ($(data).val() === '' || $(data).val() === null) {
                    nullValue.push($(data).attr('name'))
                }
            }

            function postData (data) {
                try {
                    $.ajax({
                        url: "{{ url('admin/api/agenda') }}",
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

                postData(formData)
            })
        })
    </script>
@endpush
