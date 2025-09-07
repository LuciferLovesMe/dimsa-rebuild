@extends('pages.guest.berita.layout.berita-layout')

@section('heroImage', asset('images/qna.webp'))
@section('heroTitle', 'Tanya Jawab (QnA)')
@section('heroDesc',
    'Temukan jawaban atas pertanyaan yang sering diajukan mengenai pendaftaran, kehidupan di asrama,
    dan informasi umum lainnya.')

@section('main-content')
    <div class="p-4 sm:p-8 lg:p-20 bg-gray-50">
        <div class="max-w-4xl mx-auto">

            {{-- Pengantar --}}
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold text-gray-800">Pertanyaan yang Sering Diajukan</h2>
                <p class="mt-4 text-gray-600">
                    Kami telah merangkum beberapa pertanyaan umum untuk membantu Anda mendapatkan informasi lebih cepat.
                </p>
            </div>

            {{-- Akordeon FAQ --}}
            <div class="space-y-4" x-data="{ open: {} }" id="qna">

            </div>
        </div>
        <hr class="my-10 border-t-2 border-gray-200">
        <div class="max-w-7xl mx-auto flex flex-row justify-between">
            <div class="flex flex-col cursor-pointer" onclick="location.href='{{ route('guest.pengumuman') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800"><i
                        class="fa-solid fa-arrow-left mr-2"></i>Sebelumnya</p>
                <h1 class="text-lg md:text-xl font-bold">Pengumuman</h1>
            </div>
            <div class="flex flex-col items-end cursor-pointer" onclick="location.href='{{ route('guest.alumni') }}'">
                <p class="text-xs md:text-sm text-gray-600 hover:text-gray-800">Berikutnya<i
                        class="fa-solid fa-arrow-right ml-2"></i></p>
                <h1 class="text-lg md:text-xl font-bold">Alumni</h1>
            </div>
        </div>
    </div>
    @push('scripts')
        <script>
            $(document).ready(function() {
                loadQna();

                function loadQna() {
                    let url = "{{ url('api/qna') }}";
                    // console.log(url);

                    $.ajax({
                        url: url,
                        method: "GET",
                        success: function(response) {
                            $.each(response.data, function(index, item) {
                                if (index < 5) {
                                    $('#qna').append(`
                                        <div class="bg-white rounded-lg shadow-sm border border-gray-200">
                                            <button @click="open['${item.id}'] = !open['${item.id}']"
                                                class="w-full flex justify-between response.datas-center p-5 text-left">
                                                <span class="text-base sm:text-lg font-semibold text-gray-800">
                                                    ${item.pertanyaan}
                                                </span>
                                                <i class="fas fa-chevron-down transition-transform"
                                                    :class="open['${item.id}'] && 'rotate-180'"></i>
                                            </button>
                                            <div x-show="open['${item.id}']" x-transition class="p-5 pt-0">
                                                <p class="text-gray-600 text-sm sm:text-base leading-relaxed">
                                                    ${item.jawaban}
                                                </p>
                                            </div>
                                        </div>
                                    `);
                                }
                            });
                        }
                    })
                }
            });
        </script>
    @endpush
@endsection
