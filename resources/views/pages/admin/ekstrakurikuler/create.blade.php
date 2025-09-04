@extends('layouts.form-cms')

@section('title', 'Tambah Data Ekstrakurikuler')

@section('backUrl', route('admin.ekstrakurikuler.index'))

@section('pageTitle', 'Tambah Ekstrakurikuler')

@section('formContent')
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-2 space-y-6">

                <x-input.textarea name="judul" label="Judul Ekstrakurikuler" placeholder="Judul Ekstrakurikuler" :required="true" />

                <x-input.link name="link_dokumen" label="Link Dokumen" placeholder="Tulis link" :required="true" />

                <x-input.publish-checkbox />

            </div>

            <div class="lg:col-span-2 flex flex-col justify-between">
                <x-input.image-uploader name="image" />
                <x-button.save text="Simpan Data" />
            </div>

        </div>
    </form>
@endsection
