<footer class="bg-teal-500 text-gray-100 justify-end">
    <div class="container mx-auto px-6 py-12">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8">

            {{-- Kolom 1: Tentang & Logo --}}
            <div class="md:col-span-1">
                <h3 class="text-lg font-bold text-white mb-4">Puskesmas Bengkalis</h3>
                <p class="text-sm">Sahabat Sehat Masyarakat. Melayani dengan hati, profesional, dan terpercaya.</p>
            </div>

            {{-- Kolom 2: Tautan Cepat --}}
            <div>
                <h3 class="text-lg font-bold text-white mb-4">Tautan Cepat</h3>
                <ul class="space-y-2 text-sm">
                    <li><a href="/" class="hover:text-white transition-colors">Beranda</a></li>
                    <li><a href="{{ route('JadwalDokter') }}" class="hover:text-white transition-colors">Jadwal Dokter</a></li>
                    <li><a href="{{ route('CaraBerobat') }}" class="hover:text-white transition-colors">Cara Berobat</a></li>
                    <li><a href="{{ route('tentangPuskesmas') }}" class="hover:text-white transition-colors">Tentang Kami</a></li>
                </ul>
            </div>

            {{-- Kolom 3: Kontak --}}
            <div>
                <h3 class="text-lg font-bold text-white mb-4">Hubungi Kami</h3>
                <ul class="space-y-2 text-sm">
                    <li class="flex items-start">
                        
                        <svg class="w-4 h-4 mr-2 mt-1 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <span>Jalan Awang Mahmud, Desa Selat Alam, Bengkalis</span>
                    </li>
                    <li class="flex items-center">
                        <svg class="w-4 h-4 mr-2 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z">
                            </path>
                        </svg>
                        <span>0811-7600-71</span>
                    </li>
                </ul>
            </div>

            {{-- Kolom 4: Sosial Media --}}
            <div>
                <h3 class="text-lg font-bold text-white mb-4">Ikuti Kami</h3>
                <div class="flex space-x-4">
                    <a href="https://www.facebook.com/profile.php?id=100053900581628&ref=xav_ig_profile_web" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M22 12c0-5.523-4.477-10-10-10S2 6.477 2 12c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V12h2.54V9.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V12h2.773l-.443 2.89h-2.33v6.988C18.343 21.128 22 16.991 22 12z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                    <a href="#" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path
                                d="M8.29 20.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0022 5.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.072 4.072 0 012.8 9.71v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 012 18.407a11.616 11.616 0 006.29 1.84" />
                        </svg>
                    </a>
                    <a href="https://www.instagram.com/puskesmasbengkalis?utm_source=ig_web_button_share_sheet&igsh=ZDNlZDc0MzIxNw==" class="text-gray-400 hover:text-white transition-colors">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24" aria-hidden="true">
                            <path fill-rule="evenodd"
                                d="M12.315 2c2.43 0 2.784.013 3.808.06 1.064.049 1.791.218 2.427.465a4.902 4.902 0 011.772 1.153 4.902 4.902 0 011.153 1.772c.247.636.416 1.363.465 2.427.048 1.024.06 1.378.06 3.808s-.012 2.784-.06 3.808c-.049 1.064-.218 1.791-.465 2.427a4.902 4.902 0 01-1.153 1.772 4.902 4.902 0 01-1.772 1.153c-.636.247-1.363.416-2.427.465-1.024.048-1.378.06-3.808.06s-2.784-.012-3.808-.06c-1.064-.049-1.791-.218-2.427-.465a4.902 4.902 0 01-1.772-1.153 4.902 4.902 0 01-1.153-1.772c-.247-.636-.416-1.363-.465-2.427-.048-1.024-.06-1.378-.06-3.808s.012-2.784.06-3.808c.049-1.064.218-1.791.465-2.427a4.902 4.902 0 011.153-1.772A4.902 4.902 0 016.345 2.525c.636-.247 1.363-.416 2.427-.465C9.795 2.013 10.148 2 12.315 2zm-1.161 1.043c-1.087.052-1.748.227-2.228.42a3.917 3.917 0 00-1.423.918 3.917 3.917 0 00-.918 1.423c-.193.48-.368 1.141-.42 2.228-.053 1.086-.065 1.428-.065 3.807 0 2.378.012 2.721.065 3.807.052 1.087.227 1.748.42 2.228a3.917 3.917 0 00.918 1.423 3.917 3.917 0 001.423.918c.48.193 1.141.368 2.228.42 1.086.052 1.428.065 3.807.065 2.378 0 2.721-.012 3.807-.065 1.087-.052 1.748-.227 2.228-.42a3.917 3.917 0 001.423-.918 3.917 3.917 0 00.918-1.423c.193-.48.368-1.141.42-2.228.053-1.086.065-1.428.065-3.807s-.012-2.721-.065-3.807c-.052-1.087-.227-1.748-.42-2.228a3.917 3.917 0 00-.918-1.423 3.917 3.917 0 00-1.423-.918c-.48-.193-1.141-.368-2.228-.42-1.086-.053-1.428-.065-3.807-.065zM12 6.865a5.135 5.135 0 100 10.27 5.135 5.135 0 000-10.27zm0 8.468a3.333 3.333 0 110-6.666 3.333 3.333 0 010 6.666zm5.338-9.87a1.2 1.2 0 100-2.4 1.2 1.2 0 000 2.4z"
                                clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>

        </div>

        {{-- Copyright --}}
        <div class="mt-12 border-t border-gray-700 pt-6 text-center text-sm">
            <p>&copy; {{ date('Y') }} Puskesmas Bengkalis. All rights reserved.</p>
        </div>
    </div>
</footer>
