@extends('layouts.form-cms')
@section('title', 'Tambah Data Berita')
@section('backUrl', route('admin.berita.index'))
@section('pageTitle', 'Tambah Berita')
@section('formContent')
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            {{-- Kolom Kiri: Form Fields & Editor --}}
            <div class="lg:col-span-2 flex flex-col gap-y-6">

                <x-input.textarea name="judul" label="Judul Berita" placeholder="Judul Berita" :required="true" />

                <x-input.text name="penulis" label="Penulis" placeholder="Nama Jurnalis" :required="true" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input.date name="tanggal_berita" label="Tanggal Berita" />

                    {{-- Kategori (Select Input) --}}
                    <div>
                        <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori</label>
                        <select id="kategori" name="kategori"
                            class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">
                            <option>Pilih Kategori</option>
                            <option value="umum">Umum</option>
                            <option value="prestasi">Prestasi</option>
                            <option value="kegiatan">Kegiatan</option>
                        </select>
                    </div>
                </div>

                {{-- CKEditor --}}
                <div>
                    <label for="content-editor" class="block text-sm font-medium text-gray-700 mb-1">Isi Berita</label>
                    <textarea name="content" id="content-editor" rows="10"></textarea>
                </div>

            </div>

            {{-- Kolom Kanan: Uploader & Tombol Simpan --}}
            <div class="space-y-6">
                <x-input.image-uploader name="thumbnail" />
                <x-button.save text="Simpan Data" />
            </div>

        </div>
    </form>
@endsection

@push('scripts')

    <script>
        ClassicEditor
            .create(document.querySelector('#content-editor'), {
                toolbar: [
                    'undo', 'redo', '|',
                    'heading', '|',
                    'bold', 'italic', '|',
                    'link', 'uploadImage', 'blockQuote', '|',
                    'bulletedList', 'numberedList', 'outdent', 'indent'
                ]
            })
            .catch(error => {
                console.error(error);
            });
    </script>
@endpush
