<div>
    {{-- SECTION: JUDUL --}}
    <section class="relative bg-gradient-to-t from-teal-600 to-teal-800 text-white py-20 md:py-28">
        <div class="absolute inset-0 bg-cover bg-center opacity-50"
            style="background-image: url('{{ asset('images/Gambar2.jpg') }}');"></div>
        <div class="container mx-auto px-6 text-center relative z-10">
            <h1 class="text-4xl md:text-5xl font-extrabold leading-tight">
                Jadwal Dokter Hari Ini
            </h1>
            <p class="text-lg md:text-xl max-w-3xl mx-auto mt-4">
                Informasi jadwal dokter yang praktek pada hari ini,
            </p>
        </div>
    </section>

    {{-- SECTION: DAFTAR JADWAL DOKTER --}}
    <section class="py-16">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">

                @forelse ($dokters as $dokter)
                    @php
                        // Logika untuk menentukan warna border berdasarkan poli
                        $borderColor = 'border-teal-500'; // Default
                        if (str_contains(strtolower($dokter->poli?->nama_poli ?? ''), 'gigi')) {
                            $borderColor = 'border-blue-500';
                        } elseif (str_contains(strtolower($dokter->poli?->nama_poli ?? ''), 'tindakan')) {
                            $borderColor = 'border-red-500';
                        }
                    @endphp

                    {{-- Card untuk setiap dokter --}}
                    <div
                        class="bg-white p-6 rounded-xl shadow-lg border-t-4 {{ $borderColor }} transform hover:scale-105 transition-transform duration-300">
                        <div class="text-center">
                            <h3 class="text-xl font-bold text-gray-900 mb-1">{{ $dokter->name }}</h3>
                            <p class="text-gray-500 text-sm font-semibold mb-4">
                                {{ $dokter->poli?->nama_poli ?? 'Poli Tidak Ditemukan' }}</p>

                            @if ($dokter->jadwal_aktif)
                                <p class="text-gray-700 mb-4">
                                    Jam Praktek:
                                    <span
                                        class="font-bold">{{ \Illuminate\Support\Carbon::parse($dokter->jadwal_aktif->jam_mulai)->format('H:i') }}
                                        -
                                        {{ \Illuminate\Support\Carbon::parse($dokter->jadwal_aktif->jam_selesai)->format('H:i') }}</span>
                                </p>
                            @else
                                <p class="text-gray-500 mb-4 italic">Tidak ada jadwal praktek hari ini.</p>
                            @endif

                            {{-- Badge Status Dinamis --}}
                            @php
                                $statusClass = '';
                                switch ($dokter->status) {
                                    case 'Aktif':
                                        $statusClass = 'bg-green-100 text-green-800';
                                        break;
                                    case 'Selesai Praktek':
                                        $statusClass = 'bg-yellow-100 text-yellow-800';
                                        break;
                                    case 'Libur':
                                        $statusClass = 'bg-gray-200 text-gray-800';
                                        break;
                                }
                            @endphp
                            <div class="font-semibold px-4 py-2 rounded-full text-sm inline-block {{ $statusClass }}">
                                Status: {{ $dokter->status }}
                            </div>
                        </div>
                    </div>
                @empty
                    <p class="text-center text-gray-500 col-span-3">Tidak ada data dokter yang tersedia saat ini.</p>
                @endforelse

            </div>
        </div>
    </section>
</div>
