@extends('layouts.form-cms')

@section('title', 'Edit Data Alumni')

@section('backUrl', route('admin.alumni.index'))

@section('pageTitle', 'Edit Alumni')

@section('formContent')
    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

            <div class="lg:col-span-2 space-y-6">

                <x-input.text name="alumni" label="Nama alumni" placeholder="Nama alumni" :required="true" />
                <x-input.text name="lembaga_perusahaan" label="Lembaga/Perusahaan" placeholder="Tulis Lembaga/Perusahaan"
                    :required="true" />

            </div>

            <div class="flex flex-col space-y-6 lg:justify-between">
                <div>
                    <label for="angkatan_lulus" class="block text-sm font-medium text-gray-900">
                        Angkatan lulus <span class="text-red-500">*</span>
                    </label>
                    <select id="angkatan_lulus" name="angkatan_lulus"
                        class="mt-1 block w-full rounded-md border border-gray-300 px-3 py-2 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm">

                        @for ($year = now()->year; $year >= 2000; $year--)
                            <option value="{{ $year }}">{{ $year }}</option>
                        @endfor
                    </select>
                </div>

                <x-button.save text="Perbarui Data" />
            </div>
        </div>
    </form>
@endsection
