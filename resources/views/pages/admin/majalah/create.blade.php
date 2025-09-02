@extends('layouts.form-cms')

@section('title', 'Tambah Data Majalah')

@section('backUrl', route('admin.majalah.index'))

@section('pageTitle', 'Tambah Majalah')

@section('formContent')
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">

                <x-input.textarea name="judul" label="Judul Majalah" placeholder="Judul Majalah" :required="true" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input.text name="penulis" label="Penulis" placeholder="Tulis Nama Penulis" :required="true" />
                    <x-input.date name="tanggal_terbit" label="Tanggal" :required="true" />
                </div>

                <x-input.link name="link_dokumen" label="Link Dokumen" placeholder="Tulis link" :required="true" />

                <x-input.publish-checkbox />

            </div>

            <div class="space-y-6">
                <x-input.image-uploader name="image" />
                <x-button.save text="Simpan Data" />
            </div>

        </div>
    </form>
@endsection
