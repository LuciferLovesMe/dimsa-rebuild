@extends('layouts.form-cms')

@section('title', 'Edit Data Majalah')

@section('backUrl', route('admin.majalah.index'))

@section('pageTitle', 'Edit Majalah')

@section('formContent')

    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


            <div class="lg:col-span-2 space-y-6">

                <x-input.textarea name="judul" label="Judul Majalah" placeholder="Judul Majalah" :required="true"
                    :value="$majalah->judul ?? ''" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input.text name="penulis" label="Penulis" placeholder="Tulis Nama Penulis" :required="true"
                        :value="$majalah->penulis ?? ''" />
                    <x-input.date name="tanggal_terbit" label="Tanggal" :required="true" :value="$majalah->tanggal_terbit ?? ''" />
                </div>

                <x-input.link name="url" label="Link Dokumen" placeholder="Tulis link" :required="true"
                    :value="$majalah->link_dokumen ?? ''" />

                <x-input.publish-checkbox name="is_publish" :checked="$majalah->status ?? false" />

            </div>


            <div class="space-y-6">
                <x-input.image-uploader id="image-preview" name="image" :src="$majalah->image_url ?? 'https://placehold.co/600x400/e2e8f0/334155?text=Cover'" />
                <x-button.save text="Perbarui Data" />
            </div>

        </div>
    </form>
@endsection


@push('scripts')
    <script>
        $(document).ready(function() {
            const id = getUrlParameter('id')
            loadData()

            function loadData ()
            {
                $.ajax({
                    url: `{{ url('admin/api/majalah') }}/${id}`,
                    type: "GET",
                    success: (response) => {
                        let data = response.data
                        $("textarea[name=judul]").val(data.judul)
                        $("input[name=penulis]").val(data.penulis)
                        $("input[name=tanggal_terbit]").val(data.tanggal_terbit)
                        $("input[name=url]").val(data.url)
                        $("#image-preview").attr('src', `{{ asset('/uploads/publikasi/majalah') }}/${data.image}`)
                        $("input[type=checkbox]").prop('checked', (data.is_publish === 1 ? true : false ))
                    }
                })
            }

            const formData = new FormData()
            let formInput = $("form").find("input")
            let formTextArea = $("form").find("textarea")
            let nullValue = []

            function validateData (data) {
                if (($(data).val() === '' || $(data).val() === null) && $(data).attr('type', 'file')) {
                    nullValue.push($(data).attr('name'))
                }
            }

            function postData (data) {
                console.log(data);
                
                try {
                    $.ajax({
                        url: `{{ url('admin/api/majalah/') }}/${id}}/update`,
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
                    if ($(value).attr('type') !== 'file') {
                        validateData(value);
                    }
                })
                $.each(formTextArea, function (index, value) {
                    validateData(value);
                })
                
                if (nullValue.length > 0) {
                    return false;
                }

                $.each(formInput, function (index, value) {
                    console.log($(value).attr('name'));
                    
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