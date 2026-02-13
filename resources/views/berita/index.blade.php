@extends('layouts.app')

@section('title', 'Berita Terkini HASMI')
@section('meta_description', 'Berita dan informasi terkini dari Himpunan Ahlussunnah untuk Masyarakat Islami.')

@section('content')

<!-- Hero Section -->
<section class="relative pt-40 pb-32 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 overflow-hidden text-white">
    {{-- Dekorasi ringan: hanya desktop --}}
    <div class="absolute inset-0 opacity-10 hidden lg:block">
        <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[400px] h-[400px] bg-blue-400 opacity-15 rounded-full blur-[80px] -translate-y-1/2 translate-x-1/2 hidden lg:block"></div>

    <div class="container max-w-7xl mx-auto px-6 relative z-10 py-32 text-center">
        <span class="inline-block py-2 px-6 rounded-full bg-blue-500/40 backdrop-blur-md border border-blue-400/40 text-blue-50 font-bold tracking-widest uppercase mb-8">
            Update Terbaru
        </span>
        <h1 class="text-5xl md:text-7xl font-black mb-8 tracking-tight leading-tight">
            Berita & Informasi
        </h1>
        <p class="text-2xl text-blue-50 max-w-3xl mx-auto leading-relaxed font-medium">
            Dapatkan informasi terbaru seputar kegiatan dakwah, sosial, dan perkembangan program HASMI.
        </p>
    </div>
</section>

<!-- Berita Section -->
<section class="py-24 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 min-h-screen" x-data="{ activeTab: 'hari_ini' }">
    <div class="container max-w-7xl mx-auto px-6">
        
        <!-- Filter Tabs -->
        <div class="flex justify-center mb-20">
            <div class="bg-blue-700/60 backdrop-blur-xl p-2 rounded-full border-2 border-blue-400/40 inline-flex">
                <button @click="activeTab = 'hari_ini'"
                        :class="activeTab === 'hari_ini' 
                            ? 'bg-blue-500 text-white' 
                            : 'text-blue-100 hover:text-white hover:bg-blue-600/50'"
                        class="px-10 py-4 rounded-full text-lg font-bold transition-colors duration-200 flex items-center gap-3">
                    <i class="fas fa-calendar-day"></i> Hari Ini
                </button>
                <button @click="activeTab = 'minggu_lalu'"
                        :class="activeTab === 'minggu_lalu' 
                            ? 'bg-blue-500 text-white' 
                            : 'text-blue-100 hover:text-white hover:bg-blue-600/50'"
                        class="px-10 py-4 rounded-full text-lg font-bold transition-colors duration-200 flex items-center gap-3">
                    <i class="fas fa-history"></i> Berita Lalu
                </button>
            </div>
        </div>

        <!-- Content: Hari Ini -->
        <div x-show="activeTab === 'hari_ini'" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             style="display: none;">
            
            @if($todayNews->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-12 text-left">
                    @foreach($todayNews as $berita)
                    <article class="group bg-blue-700/60 backdrop-blur-xl rounded-[2.5rem] overflow-hidden border-2 border-blue-400/40 h-full flex flex-col card-hover">
                        <div class="relative h-80 overflow-hidden">
                            <img src="{{ $berita->getThumbnailUrl() }}" alt="{{ $berita->title }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-60"></div>
                            
                            <div class="absolute top-6 right-6">
                                <span class="bg-blue-500/90 text-white font-bold px-4 py-2 rounded-xl flex items-center gap-2 border-2 border-blue-400/40">
                                    <i class="far fa-clock"></i> {{ $berita->created_at->format('H:i') }} WIB
                                </span>
                            </div>

                            <div class="absolute bottom-6 left-6">
                                <span class="bg-blue-500 text-white font-bold px-4 py-2 rounded-xl uppercase tracking-wider text-sm border-2 border-blue-400/40">
                                    Terbaru
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-10 flex flex-col flex-grow">
                            <h3 class="text-3xl font-bold text-white mb-6 leading-tight group-hover:text-blue-100 transition-colors">
                                <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->title }}</a>
                            </h3>
                            
                            <p class="text-blue-100 text-lg leading-relaxed mb-8 flex-grow">
                                {{ $berita->short_description ? Str::limit($berita->short_description, 120) : Str::limit(strip_tags($berita->content), 120) }}
                            </p>
                            
                            <div class="pt-8 border-t border-blue-400/30 flex items-center justify-between">
                                <div class="flex items-center text-blue-200 gap-6 text-lg">
                                    <span class="flex items-center gap-2"><i class="far fa-eye"></i> {{ number_format($berita->views) }}</span>
                                    <span class="flex items-center gap-2"><i class="far fa-comment"></i> {{ $berita->comments->count() }}</span>
                                </div>
                                <a href="{{ route('berita.show', $berita->slug) }}" class="text-blue-200 font-bold text-lg hover:text-white flex items-center gap-2 transition-colors">
                                    Baca Selengkapnya <i class="fas fa-arrow-right text-sm"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-24 bg-blue-700/60 backdrop-blur-xl rounded-[3rem] border-2 border-dashed border-blue-400/40">
                    <div class="inline-block p-8 rounded-full bg-blue-600/40 mb-6">
                        <i class="far fa-newspaper text-5xl text-blue-200"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-3">Belum Ada Berita Hari Ini</h3>
                    <p class="text-blue-100 text-xl max-w-md mx-auto">Kami sedang menyiapkan informasi terbaru untuk Anda.</p>
                </div>
            @endif
        </div>

        <!-- Content: Minggu Lalu -->
        <div x-show="activeTab === 'minggu_lalu'" 
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0"
             x-transition:enter-end="opacity-100"
             style="display: none;">
            
            @if($oldNews->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 text-left">
                    @foreach($oldNews as $berita)
                    <article class="group bg-blue-700/60 backdrop-blur-xl rounded-[2rem] overflow-hidden border-2 border-blue-400/40 h-full flex flex-col card-hover">
                        <div class="relative h-60 overflow-hidden">
                            <img src="{{ $berita->getThumbnailUrl() }}" alt="{{ $berita->title }}"
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                            <span class="absolute top-4 left-4 bg-blue-500/90 backdrop-blur text-white font-bold px-3 py-1 rounded-lg text-sm border border-blue-400/40">
                                {{ $berita->created_at->format('d M Y') }}
                            </span>
                        </div>
                        
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-white mb-3 leading-tight group-hover:text-blue-100 transition-colors line-clamp-2">
                                <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->title }}</a>
                            </h3>
                            
                            <p class="text-blue-100 text-base line-clamp-3 mb-6 flex-grow leading-relaxed">
                                {{ $berita->short_description ? Str::limit($berita->short_description, 100) : Str::limit(strip_tags($berita->content), 100) }}
                            </p>
                            
                            <a href="{{ route('berita.show', $berita->slug) }}" class="text-blue-200 font-bold hover:text-white mt-auto flex items-center gap-2 transition-colors">
                                Baca Selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                            </a>
                        </div>
                    </article>
                    @endforeach
                </div>
                
                <div class="mt-20 flex justify-center">
                    {{ $oldNews->links() }}
                </div>
            @else
                <div class="text-center py-24 bg-blue-700/60 backdrop-blur-xl rounded-[3rem] border-2 border-dashed border-blue-400/40">
                    <div class="inline-block p-8 rounded-full bg-blue-600/40 mb-6">
                        <i class="fas fa-history text-5xl text-blue-200"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-3">Arsip Berita Kosong</h3>
                    <p class="text-blue-100 text-xl">Belum ada berita yang diarsipkan.</p>
                </div>
            @endif
        </div>

    </div>
</section>

<style>
    /* Card hover: hanya desktop */
    @media (hover: hover) and (pointer: fine) {
        .card-hover {
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            will-change: transform;
        }
        .card-hover:hover {
            transform: translateY(-4px);
            box-shadow: 0 20px 50px rgba(59, 130, 246, 0.4);
        }
    }

    /* Hapus translate-y animasi tab di mobile (hemat render) */
    @media (max-width: 1023px) {
        [x-transition\:enter-start] { transform: none !important; }
    }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

@endsection