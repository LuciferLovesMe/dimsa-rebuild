@extends('layouts.form-cms')

@section('title', 'Edit Data Majalah')

@section('backUrl', route('admin.majalah.index'))

@section('pageTitle', 'Edit Majalah')

@section('formContent')

    <form action="#" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">


            <div class="lg:col-span-2 space-y-6">

                <x-input.textarea name="judul" label="Judul Majalah" placeholder="Judul Majalah" :required="true"
                    :value="$majalah->judul ?? ''" />

                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <x-input.text name="penulis" label="Penulis" placeholder="Tulis Nama Penulis" :required="true"
                        :value="$majalah->penulis ?? ''" />
                    <x-input.date name="tanggal_terbit" label="Tanggal" :required="true" :value="$majalah->tanggal_terbit ?? ''" />
                </div>

                <x-input.link name="link_dokumen" label="Link Dokumen" placeholder="Tulis link" :required="true"
                    :value="$majalah->link_dokumen ?? ''" />

                <x-input.publish-checkbox :checked="$majalah->status ?? false" />

            </div>


            <div class="space-y-6">
                <x-input.image-uploader name="image" :src="$majalah->image_url ?? 'https://placehold.co/600x400/e2e8f0/334155?text=Cover'" />
                <x-button.save text="Perbarui Data" />
            </div>

        </div>
    </form>
@endsection
