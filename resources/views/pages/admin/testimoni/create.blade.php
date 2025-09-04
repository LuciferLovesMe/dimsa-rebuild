@extends('layouts.form-cms')

@section('title', 'Tambah Data Testimoni')
@section('backUrl', route('admin.testimoni.index'))
@section('pageTitle', 'Tambah Testimoni')

@section('formContent')
    <form id="main-form" action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="w-full space-y-6">

            <div class="relative">
                <label for="alumni_id" class="block text-sm font-medium text-gray-700">Pilih Alumni <span
                        class="text-red-600">*</span></label>
                <select id="alumni_id" name="alumni_id"
                    class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm"
                    required>
                    <option value="">Cari nama alumni</option>
                </select>
            </div>


            <x-input.textarea name="testimoni" label="Testimoni" placeholder="Tuliskan testimoni dari alumni"
                :required="true" :rows="8" />

            <x-input.publish-checkbox name="is_publish" />
            <div class="pt-6 border-t">
                <x-button.save text="Simpan Data" />
            </div>

        </div>
    </form>
@endsection
