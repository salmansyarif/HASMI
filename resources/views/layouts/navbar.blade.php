<nav id="navbar" class="fixed w-full z-50 bg-white transition-all duration-300 shadow-sm">
    <div class="container mx-auto px-6 py-4">
        <div class="flex items-center justify-between">

            <!-- Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3">
                <div class="w-12 h-12 hero-gradient rounded-xl flex items-center justify-center">
                    <span class="text-white font-bold text-xl">H</span>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-blue-800 bg-clip-text text-transparent">
                    HASMI
                </span>
            </a>

            <!-- ================= DESKTOP MENU ================= -->
            <div class="hidden lg:flex items-center gap-2">

                <a href="{{ route('home') }}"
                   class="nav-link text-gray-700 px-4 py-2 rounded-lg {{ request()->routeIs('home') ? 'active' : '' }}">
                    Beranda
                </a>

                <a href="{{ route('tentang') }}"
                   class="nav-link text-gray-700 px-4 py-2 rounded-lg {{ request()->routeIs('tentang') ? 'active' : '' }}">
                    Tentang Kami
                </a>

                <!-- ===== DROPDOWN MATERI ===== -->
                <div class="relative group">
                    <a href="{{ route('materi.index') }}"
                       class="nav-link text-gray-700 px-4 py-2 rounded-lg flex items-center gap-1 {{ request()->routeIs('materi.*') ? 'active' : '' }}">
                        Materi
                        <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                    </a>

                    <div class="absolute left-0 mt-2 w-64 bg-white rounded-xl shadow-xl opacity-0 invisible
                                group-hover:opacity-100 group-hover:visible transition-all duration-300 border border-gray-100">

                        @php
                            $categories = \App\Models\Category::with('subCategories')
                                ->orderBy('name')->get();
                        @endphp

                        @foreach($categories as $cat)
                            @if($cat->hasSubCategories())
                                <div class="relative nested-dropdown">
                                    <a href="{{ route('materi.show', $cat->slug) }}"
                                       class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600
                                              transition-colors border-b border-gray-100 flex items-center justify-between">
                                        <span>
                                            <i class="fas {{ $cat->icon }} mr-2"></i> {{ $cat->name }}
                                        </span>
                                        <i class="fas fa-chevron-right text-xs"></i>
                                    </a>

                                    <div class="absolute left-full top-0 ml-1 w-64 bg-white rounded-xl shadow-xl
                                                opacity-0 invisible nested-dropdown:hover:opacity-100
                                                nested-dropdown:hover:visible transition-all duration-300 border border-gray-100">
                                        @foreach($cat->subCategories as $sub)
                                            <a href="{{ route('materi.sub-category', [$cat->slug, $sub->slug]) }}"
                                               class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600
                                                      transition-colors {{ $loop->last ? 'rounded-b-xl' : 'border-b border-gray-100' }}">
                                                <i class="fas {{ $sub->icon }} mr-2 text-sm"></i> {{ $sub->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                <a href="{{ route('materi.show', $cat->slug) }}"
                                   class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600
                                          transition-colors {{ $loop->last ? 'rounded-b-xl' : 'border-b border-gray-100' }}">
                                    <i class="fas {{ $cat->icon }} mr-2"></i> {{ $cat->name }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <!-- ===== DROPDOWN PROGRAM (NEW STRUCTURE) ===== -->
                <div class="relative group">
                    <a href="{{ route('program.index') }}"
                       class="nav-link text-gray-700 px-4 py-2 rounded-lg flex items-center gap-1
                              {{ request()->routeIs('program.*') ? 'active' : '' }}">
                        Program
                        <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                    </a>

                    <div class="absolute left-0 mt-2 w-64 bg-white rounded-xl shadow-xl opacity-0 invisible
                                group-hover:opacity-100 group-hover:visible transition-all duration-300 border border-gray-100">

                        @php
                            $programCategories = \App\Models\ProgramCategory::with('subcategories')
                                ->orderBy('sort_order')
                                ->get();
                        @endphp

                        @foreach($programCategories as $category)
                            @if($category->shouldRedirect())
                                {{-- Untuk PROGRAM HASMI (static) dan HASMI TV (youtube) --}}
                                <a href="{{ $category->getRedirectUrl() }}" 
                                   @if($category->redirect_type === 'youtube') target="_blank" @endif
                                   class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600
                                          transition-colors {{ $loop->last ? 'rounded-b-xl' : 'border-b border-gray-100' }}">
                                    {{ $category->name }}
                                    @if($category->redirect_type === 'youtube')
                                        <i class="fas fa-external-link-alt text-xs ml-1"></i>
                                    @endif
                                </a>
                            @elseif($category->has_subcategories)
                                {{-- Untuk HASMI PEDULI (punya subcategories) --}}
                                <div class="relative nested-dropdown">
                                    <a href="{{ route('program.category', $category->slug) }}"
                                       class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600
                                              transition-colors border-b border-gray-100 flex items-center justify-between">
                                        <span>{{ $category->name }}</span>
                                        <i class="fas fa-chevron-right text-xs"></i>
                                    </a>

                                    <div class="absolute left-full top-0 ml-1 w-64 bg-white rounded-xl shadow-xl
                                                opacity-0 invisible nested-dropdown:hover:opacity-100
                                                nested-dropdown:hover:visible transition-all duration-300 border border-gray-100">
                                        @foreach($category->subcategories as $subcategory)
                                            <a href="{{ route('program.subcategory', [$category->slug, $subcategory->slug]) }}"
                                               class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600
                                                      transition-colors {{ $loop->last ? 'rounded-b-xl' : 'border-b border-gray-100' }}">
                                                {{ $subcategory->name }}
                                            </a>
                                        @endforeach
                                    </div>
                                </div>
                            @else
                                {{-- Untuk PROGRAM DAKWAH dan PROGRAM PENDIDIKAN (tanpa subcategories) --}}
                                <a href="{{ route('program.category', $category->slug) }}"
                                   class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600
                                          transition-colors {{ $loop->last ? 'rounded-b-xl' : 'border-b border-gray-100' }}">
                                    {{ $category->name }}
                                </a>
                            @endif
                        @endforeach
                    </div>
                </div>

                <a href="{{ route('intisari.index') }}"
                   class="nav-link text-gray-700 px-4 py-2 rounded-lg {{ request()->routeIs('intisari.*') ? 'active' : '' }}">
                    Intisari HASMI
                </a>

                <a href="{{ route('kegiatan.index') }}"
                   class="nav-link text-gray-700 px-4 py-2 rounded-lg {{ request()->routeIs('kegiatan.*') ? 'active' : '' }}">
                    Kegiatan
                </a>

                <a href="https://donasi.hasmi.org/" target="_blank"
                   class="nav-link text-gray-700 px-4 py-2 rounded-lg flex items-center gap-1">
                    Donasi <i class="fas fa-external-link-alt text-xs"></i>
                </a>

                <a href="https://beasiswapendidikanislam.com/" target="_blank"
                   class="nav-link text-gray-700 px-4 py-2 rounded-lg flex items-center gap-1">
                    Beasiswa <i class="fas fa-external-link-alt text-xs"></i>
                </a>

                <a href="https://hasmi-islamicschool.com/" target="_blank"
                   class="nav-link text-gray-700 px-4 py-2 rounded-lg flex items-center gap-1">
                    Sekolah <i class="fas fa-external-link-alt text-xs"></i>
                </a>

                <!-- LOGIN/USER MENU -->
                @auth
                    <div class="relative group">
                        <button class="nav-link text-gray-700 px-4 py-2 rounded-lg flex items-center gap-2">
                            <i class="fas fa-user-circle text-xl"></i>
                            <span>{{ Auth::user()->name }}</span>
                            <i class="fas fa-chevron-down text-xs transition-transform group-hover:rotate-180"></i>
                        </button>

                        <div class="absolute right-0 mt-2 w-48 bg-white rounded-xl shadow-xl opacity-0 invisible
                                    group-hover:opacity-100 group-hover:visible transition-all duration-300 border border-gray-100">
                            @if(Auth::user()->is_admin)
                                <a href="{{ route('admin.dashboard') }}"
                                   class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600
                                          transition-colors border-b border-gray-100">
                                    <i class="fas fa-tachometer-alt mr-2"></i> Dashboard Admin
                                </a>
                            @endif
                            
                            <a href="{{ route('profile.edit') }}"
                               class="block px-4 py-3 text-gray-700 hover:bg-blue-50 hover:text-blue-600
                                      transition-colors border-b border-gray-100">
                                <i class="fas fa-user-cog mr-2"></i> Profil
                            </a>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit"
                                        class="w-full text-left px-4 py-3 text-red-600 hover:bg-red-50
                                               transition-colors rounded-b-xl">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}"
                       class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition-all">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                @endauth
            </div>

            <!-- ================= MOBILE BUTTON ================= -->
            <button id="mobileMenuBtn" class="lg:hidden text-gray-700">
                <i class="fas fa-bars text-2xl"></i>
            </button>
        </div>

        <!-- ================= MOBILE MENU ================= -->
        <div id="mobileMenu" class="hidden lg:hidden mt-4 pb-4 space-y-2">

            <a href="{{ route('home') }}" class="block nav-link text-gray-700 px-4 py-2 rounded-lg">Beranda</a>
            <a href="{{ route('tentang') }}" class="block nav-link text-gray-700 px-4 py-2 rounded-lg">Tentang Kami</a>

            <!-- Mobile Materi -->
            <div>
                <button onclick="toggleMobileMateri()"
                        class="w-full text-left nav-link text-gray-700 px-4 py-2 rounded-lg flex items-center justify-between">
                    Materi
                    <i class="fas fa-chevron-down text-xs transition-transform" id="mobileMateriIcon"></i>
                </button>

                <div id="mobileMateriDropdown" class="hidden pl-4 mt-2 space-y-1">
                    @foreach($categories as $cat)
                        @if($cat->hasSubCategories())
                            <div>
                                <button onclick="toggleMobileSubMateri({{ $cat->id }})"
                                        class="w-full text-left text-gray-600 px-4 py-2 hover:bg-blue-50 rounded-lg
                                               text-sm flex items-center justify-between">
                                    <span>
                                        <i class="fas {{ $cat->icon }} mr-2"></i> {{ $cat->name }}
                                    </span>
                                    <i class="fas fa-chevron-down text-xs transition-transform"
                                       id="mobileSubMateriIcon{{ $cat->id }}"></i>
                                </button>

                                <div id="mobileSubMateri{{ $cat->id }}" class="hidden pl-4 mt-1 space-y-1">
                                    @foreach($cat->subCategories as $sub)
                                        <a href="{{ route('materi.sub-category', [$cat->slug, $sub->slug]) }}"
                                           class="block text-gray-500 px-4 py-2 hover:bg-blue-50 rounded-lg text-xs">
                                            <i class="fas {{ $sub->icon }} mr-2"></i> {{ $sub->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ route('materi.show', $cat->slug) }}"
                               class="block text-gray-600 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm">
                                <i class="fas {{ $cat->icon }} mr-2"></i> {{ $cat->name }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Mobile Program -->
            <div>
                <button onclick="toggleMobileProgram()"
                        class="w-full text-left nav-link text-gray-700 px-4 py-2 rounded-lg flex items-center justify-between">
                    Program
                    <i class="fas fa-chevron-down text-xs transition-transform" id="mobileProgramIcon"></i>
                </button>

                <div id="mobileProgramDropdown" class="hidden pl-4 mt-2 space-y-1">
                    @foreach($programCategories as $category)
                        @if($category->shouldRedirect())
                            <a href="{{ $category->getRedirectUrl() }}" 
                               @if($category->redirect_type === 'youtube') target="_blank" @endif
                               class="block text-gray-600 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm">
                                {{ $category->name }}
                                @if($category->redirect_type === 'youtube')
                                    <i class="fas fa-external-link-alt text-xs ml-1"></i>
                                @endif
                            </a>
                        @elseif($category->has_subcategories)
                            <div>
                                <button onclick="toggleMobileSubProgram({{ $category->id }})"
                                        class="w-full text-left text-gray-600 px-4 py-2 hover:bg-blue-50 rounded-lg
                                               text-sm flex items-center justify-between">
                                    <span>{{ $category->name }}</span>
                                    <i class="fas fa-chevron-down text-xs transition-transform"
                                       id="mobileSubIcon{{ $category->id }}"></i>
                                </button>

                                <div id="mobileSubProgram{{ $category->id }}" class="hidden pl-4 mt-1 space-y-1">
                                    @foreach($category->subcategories as $subcategory)
                                        <a href="{{ route('program.subcategory', [$category->slug, $subcategory->slug]) }}"
                                           class="block text-gray-500 px-4 py-2 hover:bg-blue-50 rounded-lg text-xs">
                                            {{ $subcategory->name }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <a href="{{ route('program.category', $category->slug) }}"
                               class="block text-gray-600 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm">
                                {{ $category->name }}
                            </a>
                        @endif
                    @endforeach
                </div>
            </div>

            <a href="{{ route('intisari.index') }}" class="block nav-link text-gray-700 px-4 py-2 rounded-lg">
                Intisari HASMI
            </a>

            <a href="{{ route('kegiatan.index') }}" class="block nav-link text-gray-700 px-4 py-2 rounded-lg">
                Kegiatan
            </a>

            <!-- Mobile Login/User -->
            @auth
                <div class="border-t border-gray-200 pt-2 mt-2">
                    <div class="px-4 py-2 text-gray-600 font-semibold text-sm">
                        <i class="fas fa-user-circle mr-2"></i> {{ Auth::user()->name }}
                    </div>
                    
                    @if(Auth::user()->is_admin)
                        <a href="{{ route('admin.dashboard') }}"
                           class="block text-gray-600 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm">
                            <i class="fas fa-tachometer-alt mr-2"></i> Dashboard Admin
                        </a>
                    @endif
                    
                    <a href="{{ route('profile.edit') }}"
                       class="block text-gray-600 px-4 py-2 hover:bg-blue-50 rounded-lg text-sm">
                        <i class="fas fa-user-cog mr-2"></i> Profil
                    </a>

                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                                class="w-full text-left text-red-600 px-4 py-2 hover:bg-red-50 rounded-lg text-sm">
                            <i class="fas fa-sign-out-alt mr-2"></i> Logout
                        </button>
                    </form>
                </div>
            @else
                <div class="border-t border-gray-200 pt-2 mt-2">
                    <a href="{{ route('login') }}"
                       class="block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-center font-semibold">
                        <i class="fas fa-sign-in-alt mr-2"></i> Login
                    </a>
                </div>
            @endauth
        </div>
    </div>
</nav>

<style>
.nested-dropdown:hover > div {
    opacity: 1;
    visibility: visible;
}
</style>

<script>
document.getElementById('mobileMenuBtn').addEventListener('click', function () {
    document.getElementById('mobileMenu').classList.toggle('hidden');
});

function toggleMobileMateri() {
    const dropdown = document.getElementById('mobileMateriDropdown');
    const icon = document.getElementById('mobileMateriIcon');
    dropdown.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}

function toggleMobileSubMateri(id) {
    const dropdown = document.getElementById('mobileSubMateri' + id);
    const icon = document.getElementById('mobileSubMateriIcon' + id);
    dropdown.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}

function toggleMobileProgram() {
    const dropdown = document.getElementById('mobileProgramDropdown');
    const icon = document.getElementById('mobileProgramIcon');
    dropdown.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}

function toggleMobileSubProgram(id) {
    const dropdown = document.getElementById('mobileSubProgram' + id);
    const icon = document.getElementById('mobileSubIcon' + id);
    dropdown.classList.toggle('hidden');
    icon.classList.toggle('rotate-180');
}
</script>