<div>
    {{-- SECTION: HERO/JUDUL --}}
    <section class="relative bg-gradient-to-t from-teal-600 to-teal-800 text-white py-20 md:py-28">
        <div class="absolute inset-0 bg-cover bg-center opacity-50"
            style="background-image: url('{{ asset('images/Gambar2.jpg') }}');"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Tentang Puskesmas Bengkalis
            </h1>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mt-4">
                Mengenal lebih dekat Visi, Misi, dan Fungsi kami dalam melayani kesehatan masyarakat.
            </p>
        </div>
    </section>

    {{-- SECTION: KONTEN UTAMA --}}
    <section class="bg-white py-16 md:py-20">
        <div class="container mx-auto px-6 max-w-4xl">

            <div class="prose lg:prose-lg max-w-none text-gray-700">

                {{-- Paragraf Pengenalan --}}
                <p class="lead">
                    Puskesmas Bengkalis merupakan Unit Pelaksana Teknis (UPT) Dinas Kesehatan Kabupaten Bengkalis yang
                    bertanggung jawab menyelenggarakan pembangunan kesehatan di wilayah kerjanya. Puskesmas sebagai
                    pusat pelayanan kesehatan tingkat pertama menyelenggarakan kegiatan pelayanan kesehatan
                    komprehensif, menyeluruh, terpadu, dan berkesinambungan, yang meliputi pelayanan kesehatan
                    perorangan (<em>private goods</em>) dan pelayanan kesehatan masyarakat (<em>public goods</em>).
                </p>

                <hr class="my-8">

                {{-- Fungsi Vital Puskesmas --}}
                <h2 class="text-2xl font-bold text-gray-800">Fungsi Vital Kami</h2>
                <p>
                    Puskesmas memiliki beberapa fungsi yang vital untuk kesehatan masyarakat, antara lain:
                </p>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mt-6">
                    <div class="flex items-start space-x-4 p-4 bg-teal-50 rounded-lg">
                        <svg class="w-8 h-8 text-teal-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z">
                            </path>
                        </svg>
                        <span>Memberikan pelayanan kesehatan kepada masyarakat tanpa memandang satu golongan
                            tertentu.</span>
                    </div>
                    <div class="flex items-start space-x-4 p-4 bg-teal-50 rounded-lg">
                        <svg class="w-8 h-8 text-teal-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11.933 12.8a1 1 0 000-1.6L6.6 7.2A1 1 0 005 8v8a1 1 0 001.6.8l5.333-4zM19.933 12.8a1 1 0 000-1.6l-5.333-4A1 1 0 0013 8v8a1 1 0 001.6.8l5.333-4z">
                            </path>
                        </svg>
                        <span>Memberikan sosialisasi kesehatan terhadap masyarakat.</span>
                    </div>
                    <div class="flex items-start space-x-4 p-4 bg-teal-50 rounded-lg">
                        <svg class="w-8 h-8 text-teal-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4">
                            </path>
                        </svg>
                        <span>Sebagai pusat pembangunan kesehatan masyarakat di wilayahnya.</span>
                    </div>
                    <div class="flex items-start space-x-4 p-4 bg-teal-50 rounded-lg">
                        <svg class="w-8 h-8 text-teal-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z">
                            </path>
                        </svg>
                        <span>Memberikan pelayanan kesehatan secara menyeluruh dan terpadu kepada masyarakat.</span>
                    </div>
                </div>

                <hr class="my-8">

                {{-- Tujuan Puskesmas --}}
                <h2 class="text-2xl font-bold text-gray-800">Tujuan Utama Puskesmas</h2>
                <p>
                    Terdapat beberapa tujuan penting Puskesmas yang perlu untuk diketahui, antara lain:
                </p>
                <ul class="mt-4 space-y-3">
                    <li class="flex items-start"><span class="text-green-500 font-bold mr-3">&#10003;</span>
                        Meningkatkan kualitas kesehatan masyarakat sekitar.</li>
                    <li class="flex items-start"><span class="text-green-500 font-bold mr-3">&#10003;</span> Memastikan
                        bahwa masyarakat mendapatkan informasi yang tepat dan terbaru mengenai kesehatan.</li>
                    <li class="flex items-start"><span class="text-green-500 font-bold mr-3">&#10003;</span> Memastikan
                        bahwa masyarakat mendapatkan pelayanan kesehatan yang setara dan baik.</li>
                </ul>

                <hr class="my-8">

                {{-- Peran Lain --}}
                <p>
                    Selain memberikan fasilitas kesehatan yang layak bagi masyarakat, Puskesmas juga memikul tanggung
                    jawab untuk mengadakan kegiatan lain yang bertujuan mengedukasi masyarakat. Fenomena yang terjadi di
                    wilayah tersebut nantinya akan dijadikan sebagai bahan evaluasi bagi Puskesmas untuk menentukan
                    langkah selanjutnya dalam memperbaiki tingkat kesehatan masyarakat.
                </p>
            </div>

        </div>
    </section>
</div>
