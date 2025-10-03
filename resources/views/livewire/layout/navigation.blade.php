<?php

use App\Livewire\Actions\Logout;
use Livewire\Volt\Component;

new class extends Component
{
    /**
     * Log the current user out of the application.
     */
    public function logout(Logout $logout): void
    {
        $logout();

        $this->redirect('/', navigate: true);
    }
}; ?>

<nav x-data="{ open: false }" class="bg-white shadow-md sticky top-0 z-50">
        <div class="container mx-auto px-6 py-3">
            <div class="flex justify-between items-center">
                {{-- Logo --}}
                <a href="/" class="flex items-center space-x-2">
                    <img src="{{ asset('images/LogoPuskesmas.png') }}" alt="Logo" class="w-8 h-8">
                    {{-- <svg class="w-8 h-8 text-teal-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a9.004 9.004 0 00-4.288 1.13M12 3a9.004 9.004 0 014.288 1.13m-8.576 2.87a9.004 9.004 0 018.576 0M7.712 12.253a9.004 9.004 0 008.576 0"></path></svg> --}}
                    <span class="text-xl font-bold text-gray-800">Puskesmas</span>
                </a>

                {{-- Desktop Menu --}}
                <div class="hidden md:flex items-center space-x-8">
                    <a href="/" class="text-gray-600 hover:text-teal-600 font-semibold">Beranda</a>
                    <a href="#" class="text-gray-600 hover:text-teal-600 font-semibold">Tentang Kami</a>
                    <a href="{{ route('JadwalDokter') }}" class="text-gray-600 hover:text-teal-600 font-semibold">Jadwal Dokter</a>
                    <a href="#kontak" class="text-gray-600 hover:text-teal-600 font-semibold">Kontak</a>
                    <a href="#layanan" class="text-gray-600 hover:text-teal-600 font-semibold">Cara Berobat</a>
                </div>

                {{-- Mobile Menu Button --}}
                <div class="md:hidden">
                    <button @click="open = !open" class="text-gray-600 hover:text-teal-600 focus:outline-none">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path :class="{'hidden': open, 'block': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
                            <path :class="{'block': open, 'hidden': !open }" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>

            {{-- Mobile Menu --}}
            <div x-show="open" @click.away="open = false" class="md:hidden mt-4" x-transition>
                <a href="/" class="block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 rounded">Beranda</a>
                <a href="#" class="block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 rounded">Tentang Kami</a>
                <a href="{{ route('JadwalDokter') }}" class="block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 rounded">Jadwal Dokter</a>
                <a href="#kontak" class="block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 rounded">Kontak</a>
                <a href="#layanan" class="block py-2 px-4 text-sm text-gray-600 hover:bg-gray-100 rounded">Cara Berobat</a>
            </div>
        </div>
    </nav>
</div>

