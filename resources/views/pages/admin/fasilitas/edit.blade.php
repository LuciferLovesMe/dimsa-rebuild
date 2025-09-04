@extends('layouts.form-cms')

@section('title', 'Edit Data Fasilitas')

@section('backUrl', route('admin.fasilitas.index'))

@section('pageTitle', 'Edit Fasilitas')

@section('formContent')
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf

        <!-- judul -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">

            <div class="lg:col-span-3 space-y-6">
                <x-input.text name="judul" label="Judul Fasilitas" placeholder="Judul Fasilitas" :required="true" />
            </div>

        </div>

        <!-- border -->
        <div class="border-t border-gray-300 mt-6"></div>

        <!-- image uploader -->
        <div class="grid grid-cols-1 lg:grid-cols-4 gap-8 mt-6">

            <div class="lg:col-span-1 space-y-6">
                <x-input.image-uploader name="image" />
            </div>

        </div>

        <!-- checkbox + button save -->
        <div class="flex justify-between mt-6">
            <x-input.publish-checkbox />
            <div class="w-[233px]">
                <x-button.save text="Perbarui Data" />
            </div>
        </div>
    </form>
@endsection
