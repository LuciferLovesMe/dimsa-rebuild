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
                    <x-input.date name="tanggal" label="Tanggal Agenda" />
                </div>

                <x-input.textarea name="alamat" label="Alamat Agenda" placeholder="Alamat Agenda" :required="true" />

            </div>

            <div class="space-y-6">
                <x-input.image-uploader name="thumbnail" />
                <x-button.save text="Simpan Data" />
            </div>

        </div>
    </form>
@endsection
