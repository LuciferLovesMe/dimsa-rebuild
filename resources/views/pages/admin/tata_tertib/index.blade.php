@extends('layouts.cms')

@section('title', 'Staff Yayasan')

@section('content')
    <x-cms_page :title="$title" breadcrumb1="Tentang Sekolah" :breadcrumb2="$title" :breadcrumb3="$breadcrumb3">
        <p>Data {{ $title }}</p>
        <form action="#" method="POST">
            @csrf

            <label for="link_data" class="block mt-10 mb-2 text-sm ">
                Link Data
            </label>

            <div class="flex items-center space-x-3">
                <div class="relative w-full">
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3.5 pointer-events-none">
                        <i class="fa fa-link text-gray-500"></i>
                    </div>
                    <input type="text" id="link_data" name="link_data"
                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5"
                        placeholder="https://prnt.sc/W3tdahqSIWmC">
                </div>

                <button type="submit"
                    class="flex-shrink-0 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">
                    Simpan Data
                </button>
            </div>

            <div class="flex items-center mt-4">
                <input id="publish-checkbox" type="checkbox" name="is_published" value="1"
                    class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2">
                <label for="publish-checkbox" class="ms-2 text-sm ">
                    Centang box disamping untuk publish data ke website!
                </label>
            </div>

        </form>
    </x-cms_page>
@endsection
