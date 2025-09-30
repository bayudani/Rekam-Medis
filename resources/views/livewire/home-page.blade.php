<div>
    {{-- Best Practice: Menggunakan 'div' tunggal sebagai root element --}}

    {{-- SECTION: HERO --}}
    <section class="relative bg-gradient-to-t from-teal-600 to-teal-800 text-white min-h-[70vh] flex items-center">
        <div class="absolute inset-0 bg-cover bg-center opacity-40" style="background-image: url('{{ asset('images/Gambar2.jpg') }}');"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h1 class="text-4xl md:text-6xl font-extrabold leading-tight mb-4 animate-fade-in-down">
                Puskesmas Bengkalis
            </h1>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mb-8 animate-fade-in-up">
                Kami Sahabat Sehat Masyarakat Bengkalis
            </p>
            <div class="flex justify-center space-x-4">
                <a href="#layanan" class="bg-white text-teal-700 font-bold py-3 px-8 rounded-full shadow-lg hover:bg-gray-100 transform hover:-translate-y-1 transition-all duration-300">
                    Lihat Layanan Kami
                </a>
                <a href="#kontak" class="bg-yellow-400 text-gray-900 font-bold py-3 px-8 rounded-full shadow-lg hover:bg-yellow-300 transform hover:-translate-y-1 transition-all duration-300">
                    Hubungi Kami
                </a>
            </div>
        </div>
    </section>

    {{-- SECTION: QUICK INFO CARDS --}}
    <section class="bg-gray-50 mt-16 relative z-20 pb-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                {{-- Card 1: Jam Operasional (Dinamis dari Livewire) --}}
                <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-teal-500 text-center transform hover:scale-105 transition-transform duration-300">
                    <div class="flex justify-center mb-4">
                         <svg class="w-12 h-12 text-teal-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Jam Operasional</h3>
                    <p class="text-gray-600 mb-4">Senin-Jumat: 08:00-16:00 <br> Sabtu: 08:00-12:00</p>
                    {{-- Data dari Livewire Component --}}
                    <div class="font-semibold px-4 py-2 rounded-full text-sm {{ $statusOperasional == 'Buka' ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                        Saat Ini: {{ $statusOperasional }}
                    </div>
                </div>

                {{-- Card 2: Alur Pendaftaran --}}
                <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-yellow-500 text-center transform hover:scale-105 transition-transform duration-300">
                     <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Alur Pendaftaran</h3>
                    <p class="text-gray-600 mb-4">Ikuti langkah-langkah mudah untuk mendapatkan pelayanan kesehatan.</p>
                    <a href="#" class="font-semibold text-teal-600 hover:text-teal-800">Lihat Alur &rarr;</a>
                </div>

                {{-- Card 3: Lokasi --}}
                <div class="bg-white p-6 rounded-xl shadow-lg border-t-4 border-blue-500 text-center transform hover:scale-105 transition-transform duration-300">
                    <div class="flex justify-center mb-4">
                        <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Lokasi Kami</h3>
                    <p class="text-gray-600 mb-4">Temukan kami dengan mudah melalui peta interaktif.</p>
                     <a href="#" class="font-semibold text-teal-600 hover:text-teal-800">Lihat Peta &rarr;</a>
                </div>
            </div>
        </div>
    </section>

    {{-- SECTION: LAYANAN UNGGULAN --}}
    <section id="layanan" class="py-20">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">Layanan Unggulan Kami</h2>
            <p class="text-gray-600 max-w-2xl mx-auto mb-12">Dari pemeriksaan rutin hingga penanganan khusus, kami menyediakan layanan komprehensif.</p>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
                {{-- Layanan Item 1 --}}
                <div class="bg-white rounded-lg shadow-md p-6">
                    <h4 class="font-bold text-lg mb-2">Poli Umum</h4>
                    <p class="text-gray-600 text-sm">Pemeriksaan dan penanganan medis dasar untuk segala usia.</p>
                </div>
                {{-- Layanan Item 2 --}}
                 <div class="bg-white rounded-lg shadow-md p-6">
                    <h4 class="font-bold text-lg mb-2">Poli Gigi</h4>
                    <p class="text-gray-600 text-sm">Perawatan kesehatan gigi dan mulut, mulai dari penambalan hingga pembersihan karang gigi.</p>
                </div>
                 {{-- Layanan Item 3 --}}
                 <div class="bg-white rounded-lg shadow-md p-6">
                    <h4 class="font-bold text-lg mb-2">Kesehatan Ibu & Anak</h4>
                    <p class="text-gray-600 text-sm">Layanan komprehensif untuk ibu hamil, persalinan, dan tumbuh kembang anak.</p>
                </div>
                 {{-- Layanan Item 4 --}}
                 <div class="bg-white rounded-lg shadow-md p-6">
                    <h4 class="font-bold text-lg mb-2">Laboratorium</h4>
                    <p class="text-gray-600 text-sm">Pemeriksaan penunjang diagnostik yang akurat dan cepat.</p>
                </div>
            </div>
        </div>
    </section>

</div>
