<div>
    {{-- SECTION: HERO/JUDUL --}}
    <section class="relative bg-gradient-to-t from-teal-600 to-teal-800 text-white py-20 md:py-28">
        <div class="absolute inset-0 bg-cover bg-center opacity-50"
            style="background-image: url('{{ asset('images/Gambar2.jpg') }}');"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Hubungi Kami
            </h1>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mt-4">
                Kami siap membantu. Temukan kami melalui peta atau kirimkan pesan langsung.
            </p>
        </div>
    </section>

    {{-- SECTION: KONTEN KONTAK --}}
    <section class="bg-gray-50 py-16 md:py-20">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 max-w-6xl mx-auto">

                {{-- Kolom Kiri: Info & Peta --}}
                <div class="space-y-8">
                    {{-- Info Kontak --}}
                    <div class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-teal-500">
                        <h3 class="text-2xl font-bold text-gray-900 mb-6">Informasi Kontak</h3>
                        <div class="space-y-4 text-gray-700">
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-4 mt-1 text-teal-600 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z">
                                    </path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                </svg>
                                <div>
                                    <h4 class="font-bold">Alamat</h4>
                                    <p>Jalan Awang Mahmud, Desa Selat Alam, Bengkalis, Riau 28714</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-4 mt-1 text-teal-600 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z">
                                    </path>
                                </svg>
                                <div>
                                    <h4 class="font-bold">Telepon</h4>
                                    <p>0811-7600-71</p>
                                </div>
                            </div>
                            <div class="flex items-start">
                                <svg class="w-6 h-6 mr-4 mt-1 text-teal-600 flex-shrink-0" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z">
                                    </path>
                                </svg>
                                <div>
                                    <h4 class="font-bold">Email</h4>
                                    <p>puskesmas.bengkalis@mail.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Peta Lokasi --}}
                    <div class="bg-white rounded-xl shadow-lg overflow-hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3988.5299714517973!2d102.1441706750135!3d1.456094298530205!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d15fae77235cd7%3A0x8a3c23a9f1ffe44d!2sPUSKESMAS%20BENGKALIS!5e0!3m2!1sid!2sid!4v1760022680568!5m2!1sid!2sid"
                            width="100%" height="350" style="border:0;" allowfullscreen="" loading="lazy"
                            referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>

                {{-- Kolom Kanan: Form Kontak --}}
                <div class="bg-white p-8 rounded-xl shadow-lg border-t-4 border-yellow-500">
                    <h3 class="text-2xl font-bold text-gray-900 mb-6">Kirim Pesan</h3>

                    @if (session()->has('sukses'))
                        <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-6 rounded-md"
                            role="alert">
                            <p class="font-bold">Berhasil!</p>
                            <p>{{ session('sukses') }}</p>
                        </div>
                    @endif

                    <form wire:submit.prevent="kirimPesan" class="space-y-6">
                        <div>
                            <label for="nama" class="block text-sm font-medium text-gray-700">Nama Lengkap</label>
                            <input wire:model="nama" type="text" id="nama"
                                class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500">
                            @error('nama')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700">Alamat Email</label>
                            <input wire:model="email" type="email" id="email"
                                class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500">
                            @error('email')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <label for="pesan" class="block text-sm font-medium text-gray-700">Pesan Anda</label>
                            <textarea wire:model="pesan" id="pesan" rows="5"
                                class="mt-1 block w-full px-3 py-2 bg-white border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-teal-500 focus:border-teal-500"></textarea>
                            @error('pesan')
                                <span class="text-red-500 text-sm mt-1">{{ $message }}</span>
                            @enderror
                        </div>
                        <div>
                            <button type="submit"
                                class="w-full bg-teal-600 text-white font-bold py-3 px-6 rounded-lg shadow-lg hover:bg-teal-700 transform hover:-translate-y-1 transition-all duration-300">
                                Kirim Pesan
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>


</div>
