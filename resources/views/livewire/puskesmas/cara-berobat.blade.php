<div>
    {{-- SECTION: JUDUL --}}
    <section class="relative bg-gradient-to-t from-teal-600 to-teal-800 text-white py-20 md:py-28">
        <div class="absolute inset-0 bg-cover bg-center opacity-50"
            style="background-image: url('{{ asset('images/Gambar2.jpg') }}');"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Alur Pelayanan & Informasi
            </h1>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mt-4">
                Panduan lengkap untuk mendapatkan pelayanan terbaik di Puskesmas Bengkalis.
            </p>
        </div>
    </section>

    {{-- SECTION: KONTEN INFORMASI --}}
    <section class="pb-20 py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8 max-w-5xl mx-auto">

                <!-- CARD: Langkah-langkah Berobat -->
                <div
                    class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-teal-500 transform hover:-translate-y-2 transition-transform duration-300 md:col-span-2">
                    <div class="flex items-start space-x-4">
                        <div>
                            <svg class="w-12 h-12 text-teal-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Langkah-langkah Berobat</h3>
                            <ol class="list-decimal list-outside ml-5 space-y-2 text-gray-700">
                                <li>Pasien datang dan mengambil nomor antrian yang tersedia.</li>
                                <li>Pasien menunggu di ruang tunggu hingga nomor antrian dipanggil oleh Petugas Loket.
                                </li>
                                <li>Petugas Loket memanggil, mendata pasien, dan menanyakan poli tujuan (Umum, Gigi,
                                    Tindakan).</li>
                                <li>Setelah didata, pasien kembali menunggu di depan ruang poli yang dituju.</li>
                                <li>Petugas Poli akan memanggil pasien sesuai urutan untuk mendapatkan pemeriksaan.</li>
                            </ol>
                        </div>
                    </div>
                </div>

                <!-- CARD: Persyaratan Berobat -->
                <div
                    class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-yellow-500 transform hover:-translate-y-2 transition-transform duration-300 md:col-span-2">
                    <div class="flex items-start space-x-4">
                        <div>
                            <svg class="w-12 h-12 text-yellow-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Persyaratan Berobat</h3>
                            <ul class="list-disc list-outside ml-5 space-y-2 text-gray-700">
                                <li><b>Pasien Umum:</b> Fotocopy KTP dan Kartu Keluarga (KK).</li>
                                <li><b>Pasien BPJS:</b> Fotocopy KTP, KK, dan Kartu BPJS/KIS yang masih aktif.</li>
                                <li>Membawa Kartu Berobat (jika merupakan kunjungan ulang).</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- CARD: Jam Operasional -->
                <div
                    class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-blue-500 transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="flex items-start space-x-4">
                        <div>
                            <svg class="w-12 h-12 text-blue-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Jam Operasional</h3>
                            <ul class="list-disc list-outside ml-5 text-gray-700">
                                <li><b>Senin - Jumat:</b> 08:00 - 16:00</li>
                                <li><b>Sabtu:</b> 08:00 - 12:00</li>
                                <li>Tutup pada hari Minggu & Libur Nasional.</li>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- CARD: Waktu & Biaya -->
                <div
                    class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-green-500 transform hover:-translate-y-2 transition-transform duration-300">
                    <div class="flex items-start space-x-4">
                        <div>
                            <svg class="w-12 h-12 text-green-500" fill="none" stroke="currentColor"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v.01">
                                </path>
                            </svg>
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900 mb-4">Waktu & Biaya</h3>
                            <ul class="list-disc list-outside ml-5 text-gray-700">
                                <li><b>Waktu Penyelesaian Loket:</b> 5 - 10 Menit</li>
                                <li><b>Biaya / Tarif:</b> Tidak dipungut biaya untuk pendaftaran.</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
</div>
