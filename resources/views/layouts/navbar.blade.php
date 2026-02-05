<nav id="navbar" class="fixed w-full z-50 bg-white/90 backdrop-blur-xl transition-all duration-300 shadow-sm border-b border-gray-100/50">
    <div class="container mx-auto px-6 h-24 flex items-center justify-between">

        <!-- LOGO BRANDING (Matches Home Hero) -->
        <a href="{{ route('home') }}" class="flex items-center gap-3 group">
            <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-[0_0_15px_rgba(59,130,246,0.2)] border border-blue-100 group-hover:scale-110 transition-transform duration-300">
                <img src="{{ asset('img/hasmilogo.png') }}" alt="HASMI Logo" class="w-8 h-8 object-contain">
            </div>
            <div class="flex flex-col">
                <span class="text-2xl font-extrabold text-slate-800 tracking-tighter leading-none group-hover:text-blue-700 transition-colors">
                    HASMI
                </span>
                <span class="text-[10px] font-bold text-blue-600 tracking-widest uppercase">Himpunan Ahlussunnah</span>
            </div>
        </a>

        <!-- ================= DESKTOP MENU ================= -->
        <div class="hidden lg:flex items-center gap-1">

            {{-- MENU ITEMS --}}
            <a href="{{ route('home') }}"
               class="nav-link px-4 py-2 rounded-full text-base font-bold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center gap-2 {{ request()->routeIs('home') ? 'bg-blue-50 text-blue-700' : '' }}">
                Beranda
            </a>

            <a href="{{ route('tentang') }}"
               class="nav-link px-4 py-2 rounded-full text-base font-bold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center gap-2 {{ request()->routeIs('tentang') ? 'bg-blue-50 text-blue-700' : '' }}">
                Tentang Kami
            </a>

            <!-- ===== DROPDOWN MATERI ===== -->
            <div class="relative group">
                <a href="{{ route('materi.index') }}" 
                   class="nav-link px-4 py-2 rounded-full text-base font-bold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center gap-2 {{ request()->routeIs('materi.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                    Materi
                    <i class="fas fa-chevron-down text-[10px] transition-transform group-hover:rotate-180 opacity-60"></i>
                </a>

                <div class="absolute top-full left-0 mt-4 w-72 bg-white/95 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 border border-white/20 ring-1 ring-black/5 p-3 z-50">
                    <div class="bg-blue-50/50 rounded-2xl p-1">
                    @foreach(\App\Models\Category::with('subCategories')->orderBy('name')->get() as $cat)
                        @if($cat->hasSubCategories())
                            <div class="relative nested-dropdown group/sub">
                                <a href="{{ route('materi.show', $cat->slug) }}"
                                   class="flex items-center justify-between px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-all font-semibold text-sm">
                                    <span class="flex items-center gap-3">
                                        <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-blue-500 shadow-sm text-xs">
                                            <i class="fas {{ $cat->icon }}"></i>
                                        </span>
                                        {{ $cat->name }}
                                    </span>
                                    <i class="fas fa-chevron-right text-[10px] opacity-40"></i>
                                </a>
                                
                                <div class="absolute left-full top-0 ml-3 w-64 bg-white/95 backdrop-blur-xl rounded-3xl shadow-xl opacity-0 invisible translate-x-2 group-hover/sub:opacity-100 group-hover/sub:visible group-hover/sub:translate-x-0 transition-all duration-300 border border-white/20 p-2 z-50">
                                    @foreach($cat->subCategories as $sub)
                                        <a href="{{ route('materi.sub-category', [$cat->slug, $sub->slug]) }}"
                                           class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition-all text-sm font-semibold">
                                            <i class="fas {{ $sub->icon }} text-blue-400"></i> {{ $sub->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ route('materi.show', $cat->slug) }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-all font-semibold text-sm">
                                <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-blue-500 shadow-sm text-xs">
                                    <i class="fas {{ $cat->icon }}"></i>
                                </span>
                                {{ $cat->name }}
                            </a>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>

            <!-- ===== DROPDOWN PROGRAM ===== -->
            <div class="relative group">
                <a href="{{ route('program.index') }}" 
                   class="nav-link px-4 py-2 rounded-full text-base font-bold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center gap-2 {{ request()->routeIs('program.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                    Program
                    <i class="fas fa-chevron-down text-[10px] transition-transform group-hover:rotate-180 opacity-60"></i>
                </a>

                <div class="absolute top-full left-0 mt-4 w-72 bg-white/95 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 border border-white/20 ring-1 ring-black/5 p-3 z-50">
                    <div class="bg-blue-50/50 rounded-2xl p-1">
                    @foreach(\App\Models\ProgramCategory::with('subcategories')->orderBy('sort_order')->get() as $category)
                        @if($category->shouldRedirect())
                            <a href="{{ $category->getRedirectUrl() }}" 
                               @if($category->redirect_type === 'youtube') target="_blank" @endif
                               class="flex items-center justify-between px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-all font-semibold text-sm">
                                <span class="flex items-center gap-3">
                                    <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-blue-500 shadow-sm text-xs">
                                        <i class="fas {{ $category->redirect_type === 'youtube' ? 'fa-play' : 'fa-star' }}"></i>
                                    </span>
                                    {{ $category->name }}
                                </span>
                                @if($category->redirect_type === 'youtube')
                                    <i class="fas fa-external-link-alt text-[10px] opacity-40"></i>
                                @endif
                            </a>
                        @elseif($category->has_subcategories)
                            <div class="relative nested-dropdown group/sub">
                                <a href="{{ route('program.category', $category->slug) }}"
                                   class="flex items-center justify-between px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-all font-semibold text-sm">
                                    <span class="flex items-center gap-3">
                                        <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-blue-500 shadow-sm text-xs">
                                            <i class="fas fa-hand-holding-heart"></i>
                                        </span>
                                        {{ $category->name }}
                                    </span>
                                    <i class="fas fa-chevron-right text-[10px] opacity-40"></i>
                                </a>

                                <div class="absolute left-full top-0 ml-3 w-64 bg-white/95 backdrop-blur-xl rounded-3xl shadow-xl opacity-0 invisible translate-x-2 group-hover/sub:opacity-100 group-hover/sub:visible group-hover/sub:translate-x-0 transition-all duration-300 border border-white/20 p-2 z-50">
                                    @foreach($category->subcategories as $subcategory)
                                        <a href="{{ route('program.subcategory', [$category->slug, $subcategory->slug]) }}"
                                           class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-600 hover:bg-blue-50 hover:text-blue-700 transition-all text-sm font-semibold">
                                            <i class="fas fa-dot-circle text-blue-400 text-[8px]"></i> {{ $subcategory->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ route('program.category', $category->slug) }}"
                               class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-all font-semibold text-sm">
                                <span class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-blue-500 shadow-sm text-xs">
                                    <i class="fas fa-bookmark"></i>
                                </span>
                                {{ $category->name }}
                            </a>
                        @endif
                    @endforeach
                    </div>
                </div>
            </div>

            <a href="{{ route('intisari.index') }}"
               class="nav-link px-4 py-2 rounded-full text-base font-bold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center gap-2 {{ request()->routeIs('intisari.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                Intisari
            </a>

            <a href="{{ route('kegiatan.index') }}"
               class="nav-link px-4 py-2 rounded-full text-base font-bold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center gap-2 {{ request()->routeIs('kegiatan.*') ? 'bg-blue-50 text-blue-700' : '' }}">
                Kegiatan
            </a>

            <!-- EXTERNAL LINKS RESTORED -->
            <div class="h-6 w-px bg-gray-200 mx-2"></div>

             <a href="https://donasi.hasmi.org/" target="_blank"
               class="nav-link px-3 py-2 rounded-full text-sm font-bold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center gap-1">
                Donasi <i class="fas fa-external-link-alt text-[10px] text-gray-400"></i>
            </a>

            <a href="https://beasiswapendidikanislam.com/" target="_blank"
               class="nav-link px-3 py-2 rounded-full text-sm font-bold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center gap-1">
                Beasiswa <i class="fas fa-external-link-alt text-[10px] text-gray-400"></i>
            </a>

            <a href="https://hasmi-islamicschool.com/" target="_blank"
               class="nav-link px-3 py-2 rounded-full text-sm font-bold text-gray-700 hover:text-blue-600 hover:bg-blue-50 transition-all duration-300 flex items-center gap-1">
                Sekolah <i class="fas fa-external-link-alt text-[10px] text-gray-400"></i>
            </a>

            <div class="h-6 w-px bg-gray-200 mx-2"></div>
            
            @auth
                <!-- Profile Menu -->
                <div class="relative group">
                    <button class="flex items-center gap-2 pl-2 pr-4 py-1.5 rounded-full border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all bg-white shadow-sm">
                        <div class="w-8 h-8 rounded-full bg-blue-600 flex items-center justify-center text-white text-sm font-bold">
                            {{ substr(Auth::user()->name, 0, 1) }}
                        </div>
                        <span class="text-sm font-bold text-gray-700 max-w-[80px] truncate">{{ Auth::user()->name }}</span>
                        <i class="fas fa-chevron-down text-[10px] text-gray-400"></i>
                    </button>

                    <div class="absolute right-0 mt-3 w-56 bg-white/95 backdrop-blur-xl rounded-3xl shadow-[0_20px_50px_rgba(0,0,0,0.1)] opacity-0 invisible translate-y-2 group-hover:opacity-100 group-hover:visible group-hover:translate-y-0 transition-all duration-300 border border-white/20 p-2 transform origin-top-right">
                        @if(Auth::user()->is_admin)
                            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 font-semibold text-sm">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                            </a>
                        @endif
                        <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl text-gray-700 hover:bg-blue-50 hover:text-blue-700 font-semibold text-sm">
                            <i class="fas fa-user-cog"></i> Edit Profil
                        </a>
                        <div class="h-px bg-gray-100 my-1"></div>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full flex items-center gap-3 px-4 py-3 rounded-xl text-red-600 hover:bg-red-50 hover:text-red-700 font-semibold text-sm transition-colors">
                                <i class="fas fa-sign-out-alt"></i> Logout
                            </button>
                        </form>
                    </div>
                </div>
            @else
                <a href="{{ route('login') }}"
                   class="px-6 py-2.5 rounded-full bg-blue-600 text-white text-base font-bold shadow-lg shadow-blue-500/30 hover:bg-blue-700 hover:shadow-blue-600/40 hover:-translate-y-0.5 transition-all duration-300 flex items-center gap-2">
                    <i class="fas fa-sign-in-alt"></i> Masuk
                </a>
            @endauth
        </div>

        <!-- ================= MOBILE BUTTON ================= -->
        <button id="mobileMenuBtn" class="lg:hidden w-12 h-12 flex items-center justify-center rounded-2xl bg-gray-50 text-gray-800 hover:bg-blue-50 hover:text-blue-600 transition-colors">
            <i class="fas fa-bars text-2xl"></i>
        </button>
    </div>

    <!-- ================= MOBILE MENU ================= -->
    <div id="mobileMenu" class="hidden lg:hidden bg-white/95 backdrop-blur-xl border-t border-gray-100/50 absolute w-full left-0 top-24 shadow-xl max-h-[85vh] overflow-y-auto">
        <div class="p-4 space-y-2 pb-20">
            <a href="{{ route('home') }}" class="block px-4 py-3 rounded-2xl font-bold text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all text-base">Beranda</a>
            <a href="{{ route('tentang') }}" class="block px-4 py-3 rounded-2xl font-bold text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all text-base">Tentang Kami</a>

            <!-- Mobile Materi -->
            <div class="border-t border-gray-100 pt-2">
                <p class="px-4 py-2 text-xs font-bold text-gray-400 uppercase tracking-widest">Materi</p>
                @foreach(\App\Models\Category::with('subCategories')->orderBy('name')->get() as $cat)
                <div x-data="{ open: false }">
                    <div class="flex items-center justify-between px-4 py-2.5 rounded-xl text-gray-700 hover:bg-gray-50 transition-all">
                        <a href="{{ route('materi.show', $cat->slug) }}" class="flex-grow font-semibold text-base flex items-center gap-3">
                            <i class="fas {{ $cat->icon }} text-blue-500 w-5"></i> {{ $cat->name }}
                        </a>
                        @if($cat->hasSubCategories())
                        <button onclick="document.getElementById('sub-mobil-{{ $cat->id }}').classList.toggle('hidden')" class="p-3 text-gray-400">
                            <i class="fas fa-chevron-down text-sm"></i>
                        </button>
                        @endif
                    </div>
                    @if($cat->hasSubCategories())
                    <div id="sub-mobil-{{ $cat->id }}" class="hidden pl-12 space-y-1 mb-2">
                        @foreach($cat->subCategories as $sub)
                        <a href="{{ route('materi.sub-category', [$cat->slug, $sub->slug]) }}" 
                           class="block py-2 text-sm font-medium text-gray-500 hover:text-blue-600">
                            {{ $sub->name }}
                        </a>
                        @endforeach
                    </div>
                    @endif
                </div>
                @endforeach
            </div>

            <!-- Mobile Program -->
            <div class="border-t border-gray-100 pt-2">
                <p class="px-4 py-2 text-xs font-bold text-gray-400 uppercase tracking-widest">Program</p>
                @foreach(\App\Models\ProgramCategory::with('subcategories')->orderBy('sort_order')->get() as $cat)
                    <div class="px-4 py-2.5">
                        <a href="{{ route('program.category', $cat->slug) }}" class="flex items-center gap-3 font-semibold text-gray-700 text-base">
                            <i class="fas fa-bookmark text-blue-500 w-5"></i> {{ $cat->name }}
                        </a>
                    </div>
                @endforeach
            </div>

            <a href="{{ route('intisari.index') }}" class="block px-4 py-3 rounded-2xl font-bold text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all text-base border-t border-gray-100 mt-2">Intisari</a>
            <a href="{{ route('kegiatan.index') }}" class="block px-4 py-3 rounded-2xl font-bold text-gray-600 hover:bg-blue-50 hover:text-blue-600 transition-all text-base">Kegiatan</a>

            <!-- EXTERNAL MOBILE -->
             <div class="border-t border-gray-100 pt-2 space-y-1">
                <a href="https://donasi.hasmi.org/" target="_blank" class="block px-4 py-2.5 rounded-xl font-bold text-gray-600 hover:bg-blue-50 hover:text-blue-600 text-sm">
                    <i class="fas fa-external-link-alt mr-2 text-xs"></i> Donasi
                </a>
                <a href="https://beasiswapendidikanislam.com/" target="_blank" class="block px-4 py-2.5 rounded-xl font-bold text-gray-600 hover:bg-blue-50 hover:text-blue-600 text-sm">
                    <i class="fas fa-external-link-alt mr-2 text-xs"></i> Beasiswa
                </a>
                <a href="https://hasmi-islamicschool.com/" target="_blank" class="block px-4 py-2.5 rounded-xl font-bold text-gray-600 hover:bg-blue-50 hover:text-blue-600 text-sm">
                    <i class="fas fa-external-link-alt mr-2 text-xs"></i> Sekolah
                </a>
            </div>

            <div class="border-t border-gray-100 pt-4 mt-4 grid grid-cols-2 gap-3">
                <a href="{{ route('login') }}" class="col-span-2 py-3 rounded-xl bg-blue-600 text-white font-bold text-center shadow-lg shadow-blue-500/30 text-lg">
                    Masuk Akun
                </a>
            </div>
        </div>
    </div>
</nav>

<script>
    // Blur on Scroll
    const navbar = document.getElementById('navbar');
    window.addEventListener('scroll', () => {
        if (window.scrollY > 10) {
            navbar.classList.add('shadow-md', 'bg-white/95');
            navbar.classList.remove('bg-white/90');
        } else {
            navbar.classList.remove('shadow-md', 'bg-white/95');
            navbar.classList.add('bg-white/90');
        }
    });

    // Mobile Menu Toggle
    const mobileBtn = document.getElementById('mobileMenuBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    
    mobileBtn.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
        const icon = mobileBtn.querySelector('i');
        if(mobileMenu.classList.contains('hidden')){
            icon.classList.remove('fa-times');
            icon.classList.add('fa-bars');
        } else {
            icon.classList.remove('fa-bars');
            icon.classList.add('fa-times');
        }
    });
</script>