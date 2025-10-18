<x-dynamic-component :component="$getFieldWrapperView()" :field="$field">
    <div x-data="{
        state: $wire.entangle('{{ $getStatePath() }}'),
        init() {
            if (typeof this.state !== 'object' || this.state === null) {
                this.state = {};
            }
        },
        toggleCondition(gigi, kondisi) {
            if (!this.state[gigi]) {
                this.state[gigi] = [];
            }
            const index = this.state[gigi].indexOf(kondisi);
            if (index > -1) {
                this.state[gigi].splice(index, 1);
            } else {
                this.state[gigi].push(kondisi);
            }
        },
        // FUNGSI INI DISEDERHANAKAN, HANYA UNTUK STYLE DASAR
        getGigiBaseClass(gigi) {
            const kondisi = this.state[gigi] || [];
            let classes = 'bg-white hover:bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 ';
            if (kondisi.includes('cabut')) {
                // Warna teks jadi abu-abu dan dicoret jika dicabut
                classes += 'text-gray-400 line-through ';
            }
            return classes;
        }
    }">
        {{-- LEGENDA/KETERANGAN BARU DENGAN SIMBOL --}}
        <div
            class="mb-4 p-3 bg-gray-50 dark:bg-gray-800 rounded-lg flex flex-wrap gap-x-4 gap-y-2 items-center text-gray-700 dark:text-gray-200">
            <span class="font-semibold text-sm">Keterangan:</span>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-sm mr-2 border border-gray-400 bg-repeat bg-center"
                    style="background-image: url('data:image/svg+xml,%3Csvg width=\'4\' height=\'4\' viewBox=\'0 0 4 4\' xmlns=\'http://www.w3.org/2000/svg\'%3E%3Cpath d=\'M-1,1 l2,-2 M0,4 l4,-4 M3,5 l2,-2\' stroke=\'gray\' stroke-width=\'1\'/%3E%3C/svg%3E');">
                </div>
                <span class="text-xs">Berlubang</span>
            </div>
            <div class="flex items-center">
                <div class="w-4 h-4 rounded-sm mr-2 border border-gray-400 flex items-center justify-center">
                    <div class="w-2 h-2 rounded-full border border-gray-600"></div>
                </div>
                <span class="text-xs">Tambalan</span>
            </div>
            <div class="flex items-center">
                <div
                    class="w-4 h-4 rounded-sm mr-2 border border-gray-400 flex items-center justify-center text-gray-600 font-bold">
                    X</div>
                <span class="text-xs">Dicabut</span>
            </div>
            <span class="text-xs text-gray-500 dark:text-gray-400 italic">*Klik pada nomor gigi untuk memilih
                kondisi.</span>
        </div>

        @php
            $gigi = [
                'atas_kanan' => [18, 17, 16, 15, 14, 13, 12, 11],
                'atas_kiri' => [21, 22, 23, 24, 25, 26, 27, 28],
                'susu_atas_kanan' => [55, 54, 53, 52, 51],
                'susu_atas_kiri' => [61, 62, 63, 64, 65],
                'bawah_kanan' => [48, 47, 46, 45, 44, 43, 42, 41],
                'bawah_kiri' => [31, 32, 33, 34, 35, 36, 37, 38],
                'susu_bawah_kanan' => [85, 84, 83, 82, 81],
                'susu_bawah_kiri' => [71, 72, 73, 74, 75],
            ];
        @endphp

        {{-- GRID ODONTOGRAM  DENGAN SIMBOL OVERLAY --}}
        <div
            class="odontogram-grid border-2 border-gray-200 dark:border-gray-700 p-4 rounded-lg bg-gray-50/50 dark:bg-gray-800/50">
            <div class="inline-flex flex-col items-center mx-auto w-full">
                @php
                    $renderGigiRow = function ($gigiList) {
                        foreach ($gigiList as $g) {
                            echo '<div @click="$dispatch(\'open-modal\', { id: \'gigi-modal-' .
                                $g .
                                '\' })"
                                     :class="getGigiBaseClass(\'' .
                                $g .
                                '\')"
                                     class="relative w-10 h-10 border border-gray-300 dark:border-gray-600 flex items-center justify-center cursor-pointer text-sm font-medium transition-colors">';

                            // SIMBOL ARSIR (BERLUBANG) - Muncul jika ada 'lubang'
                            echo '<div x-show="state[\'' .
                                $g .
                                '\'] && state[\'' .
                                $g .
                                '\'].includes(\'lubang\')" class="absolute inset-0 bg-repeat bg-center" style="background-image: url(\'data:image/svg+xml,%3Csvg width=%224%22 height=%224%22 viewBox=%220 0 4 4%22 xmlns=%22http://www.w3.org/2000/svg%22%3E%3Cpath d=%22M-1,1 l2,-2 M0,4 l4,-4 M3,5 l2,-2%22 stroke=%22%239ca3af%22 stroke-width=%221%22/%3E%3C/svg%3E\');"></div>';

                            // SIMBOL LINGKARAN (TAMBALAN) - Muncul jika ada 'tambal'
                            echo '<div x-show="state[\'' .
                                $g .
                                '\'] && state[\'' .
                                $g .
                                '\'].includes(\'tambal\')" class="absolute inset-0 flex items-center justify-center">
                                    <div class="w-5 h-5 border-2 border-blue-600 dark:border-blue-400 rounded-full"></div>
                                  </div>';

                            // SIMBOL X (DICABUT) - Muncul jika ada 'dicabut'
                            echo '<div x-show="state[\'' .
                                $g .
                                '\'] && state[\'' .
                                $g .
                                '\'].includes(\'cabut\')" class="absolute inset-0 flex items-center justify-center text-gray-600 dark:text-gray-400 font-bold">
                                    X
                                  </div>';
                            // Tampilkan nomor giginya di atas semua simbol
                            echo '<span class="relative z-10">' . $g . '</span>';
                            echo '</div>';
                        }
                    };
                @endphp

                {{-- Render semua baris gigi (Layout disesuaikan agar gigi susu lebih ke tengah) --}}
                <div class="flex justify-center">
                    {{ $renderGigiRow($gigi['atas_kanan']) }}
                    <div class="w-px h-10 bg-gray-400 dark:bg-gray-500 mx-px"></div>
                    {{ $renderGigiRow($gigi['atas_kiri']) }}
                </div>
                <div class="flex justify-center mt-1">
                    <div class="w-[120px]"></div> {{-- Spacer Kanan --}}
                    {{ $renderGigiRow($gigi['susu_atas_kanan']) }}
                    <div class="w-px h-10 bg-gray-400 dark:bg-gray-500 mx-px"></div>
                    {{ $renderGigiRow($gigi['susu_atas_kiri']) }}
                    <div class="w-[120px]"></div> {{-- Spacer Kiri --}}
                </div>

                <div class="w-full max-w-lg border-t-2 border-gray-400 dark:border-gray-500 my-2"></div>

                <div class="flex justify-center mb-1">
                    <div class="w-[120px]"></div> {{-- Spacer Kanan --}}
                    {{ $renderGigiRow(array_reverse($gigi['susu_bawah_kanan'])) }}
                    <div class="w-px h-10 bg-gray-400 dark:bg-gray-500 mx-px"></div>
                    {{ $renderGigiRow($gigi['susu_bawah_kiri']) }}
                    <div class="w-[120px]"></div> {{-- Spacer Kiri --}}
                </div>
                <div class="flex justify-center">
                    {{ $renderGigiRow(array_reverse($gigi['bawah_kanan'])) }}
                    <div class="w-px h-10 bg-gray-400 dark:bg-gray-500 mx-px"></div>
                    {{ $renderGigiRow($gigi['bawah_kiri']) }}
                </div>
            </div>
        </div>

        {{-- MODAL (Tidak ada perubahan di sini) --}}
        @foreach (array_merge(...array_values($gigi)) as $g)
            <x-filament::modal id="gigi-modal-{{ $g }}" width="sm">
                <x-slot name="heading">Kondisi Gigi Nomor {{ $g }}</x-slot>
                <div class="space-y-3">
                    <label
                        class="flex items-center space-x-3 p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-md cursor-pointer">
                        <input type="checkbox" @click="toggleCondition('{{ $g }}', 'lubang')"
                            :checked="state['{{ $g }}'] && state['{{ $g }}'].includes('lubang')"
                            class="form-checkbox h-5 w-5 text-red-600 rounded focus:ring-red-500">
                        <span class="text-gray-700 dark:text-gray-200">Berlubang (Caries)</span>
                    </label>
                    <label
                        class="flex items-center space-x-3 p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-md cursor-pointer">
                        <input type="checkbox" @click="toggleCondition('{{ $g }}', 'tambal')"
                            :checked="state['{{ $g }}'] && state['{{ $g }}'].includes('tambal')"
                            class="form-checkbox h-5 w-5 text-blue-600 rounded focus:ring-blue-500">
                        <span class="text-gray-700 dark:text-gray-200">Ada Tambalan (Filling)</span>
                    </label>
                    <label
                        class="flex items-center space-x-3 p-3 hover:bg-gray-50 dark:hover:bg-gray-700/50 rounded-md cursor-pointer">
                        <input type="checkbox" @click="toggleCondition('{{ $g }}', 'cabut')"
                            :checked="state['{{ $g }}'] && state['{{ $g }}'].includes('cabut')"
                            class="form-checkbox h-5 w-5 text-gray-600 rounded focus:ring-gray-500">
                        <span class="text-gray-700 dark:text-gray-200">Sudah Dicabut (Extracted)</span>
                    </label>
                </div>
                <x-slot name="footer">
                    <x-filament::button color="gray" x-on:click="close()">Selesai</x-filament::button>
                </x-slot>
            </x-filament::modal>
        @endforeach
    </div>
</x-dynamic-component>
