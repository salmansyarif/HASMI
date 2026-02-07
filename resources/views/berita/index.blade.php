@extends('layouts.app')

@section('title', 'Berita Terkini HASMI')
@section('meta_description', 'Berita dan informasi terkini dari Himpunan Ahlussunnah untuk Masyarakat Islami.')

@section('content')

<!-- Hero Section (Brighter) -->
<section class="relative pt-40 pb-32 bg-gradient-to-br from-blue-900 to-blue-800 overflow-hidden text-white">
    <!-- Background Patterns -->
    <div class="absolute inset-0 opacity-10">
        <svg class="h-full w-full" viewBox="0 0 100 100" preserveAspectRatio="none">
            <path d="M0 100 C 20 0 50 0 100 100 Z" fill="white" />
        </svg>
    </div>
    <div class="absolute top-0 right-0 w-[500px] h-[500px] bg-white opacity-10 rounded-full blur-[100px] -translate-y-1/2 translate-x-1/2"></div>

    <div class="container max-w-7xl mx-auto px-6 relative z-10 py-32 text-center text-white">
        <span class="inline-block py-2 px-6 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-blue-100 font-bold tracking-widest uppercase mb-8 shadow-lg">
            Update Terbaru
        </span>
        <h1 class="text-5xl md:text-7xl font-black mb-8 tracking-tight leading-tight drop-shadow-lg">
            Berita & Informasi
        </h1>
        <p class="text-2xl text-blue-100 max-w-3xl mx-auto leading-relaxed font-medium">
            Dapatkan informasi terbaru seputar kegiatan dakwah, sosial, dan perkembangan program HASMI.
        </p>
    </div>
</section>

<!-- Berita Section -->
<section class="py-24 bg-blue-50 min-h-screen" x-data="{ activeTab: 'hari_ini' }">
    <div class="container max-w-7xl mx-auto px-6">
        
        <!-- Filter Tabs -->
        <div class="flex justify-center mb-20">
            <div class="bg-white p-2 rounded-full shadow-lg border border-slate-100 inline-flex shadow-blue-900/5">
                <button @click="activeTab = 'hari_ini'"
                        :class="activeTab === 'hari_ini' 
                            ? 'bg-blue-600 text-white shadow-md' 
                            : 'text-slate-500 hover:text-blue-600 hover:bg-slate-50'"
                        class="px-10 py-4 rounded-full text-lg font-bold transition-all duration-300 flex items-center gap-3">
                    <i class="fas fa-calendar-day"></i> Hari Ini
                </button>
                <button @click="activeTab = 'minggu_lalu'"
                        :class="activeTab === 'minggu_lalu' 
                            ? 'bg-blue-600 text-white shadow-md' 
                            : 'text-slate-500 hover:text-blue-600 hover:bg-blue-50'"
                        class="px-10 py-4 rounded-full text-lg font-bold transition-all duration-300 flex items-center gap-3">
                    <i class="fas fa-history"></i> Berita Lalu
                </button>
            </div>
        </div>

        <!-- Content: Hari Ini -->
        <div x-show="activeTab === 'hari_ini'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             style="display: none;">
            
            @if($todayNews->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-12 text-left">
                    @foreach($todayNews as $berita)
                    <article class="group bg-white rounded-[2.5rem] overflow-hidden shadow-xl shadow-blue-100/50 hover:shadow-2xl hover:shadow-blue-200 transition-all duration-300 border border-blue-50 h-full flex flex-col transform hover:-translate-y-2">
                        <!-- Image Container with Overlay -->
                        <div class="relative h-80 overflow-hidden">
                            <img src="{{ $berita->getThumbnailUrl() }}" alt="{{ $berita->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-60 group-hover:opacity-80 transition-opacity"></div>
                            
                            <!-- Badge Time -->
                            <div class="absolute top-6 right-6">
                                <span class="bg-white/95 backdrop-blur-sm text-blue-700 font-bold px-4 py-2 rounded-xl shadow-lg flex items-center gap-2">
                                    <i class="far fa-clock"></i> {{ $berita->created_at->format('H:i') }} WIB
                                </span>
                            </div>

                            <!-- Category Badge -->
                            <div class="absolute bottom-6 left-6">
                                <span class="bg-blue-600 text-white font-bold px-4 py-2 rounded-xl shadow-lg uppercase tracking-wider text-sm">
                                    Terbaru
                                </span>
                            </div>
                        </div>
                        
                        <div class="p-10 flex flex-col flex-grow">
                            <h3 class="text-3xl font-bold text-slate-800 mb-6 leading-tight group-hover:text-blue-600 transition-colors">
                                <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->title }}</a>
                            </h3>
                            
                            <!-- Short Description or Limited Content -->
                            <p class="text-slate-500 text-lg leading-relaxed mb-8 flex-grow">
                                {{ $berita->short_description ? Str::limit($berita->short_description, 120) : Str::limit(strip_tags($berita->content), 120) }}
                            </p>
                            
                            <div class="pt-8 border-t border-slate-100 flex items-center justify-between">
                                <div class="flex items-center text-slate-400 gap-6 text-lg">
                                    <span class="flex items-center gap-2"><i class="far fa-eye"></i> {{ number_format($berita->views) }}</span>
                                    <span class="flex items-center gap-2"><i class="far fa-comment"></i> {{ $berita->comments->count() }}</span>
                                </div>
                                <a href="{{ route('berita.show', $berita->slug) }}" class="text-blue-600 font-bold text-lg hover:text-blue-700 flex items-center gap-2 group-hover:gap-3 transition-all">
                                    Baca Selengkapnya <i class="fas fa-arrow-right text-sm"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                    <div class="inline-block p-8 rounded-full bg-blue-50 mb-6">
                        <i class="far fa-newspaper text-5xl text-blue-300"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-slate-700 mb-3">Belum Ada Berita Hari Ini</h3>
                    <p class="text-slate-500 text-xl max-w-md mx-auto">Kami sedang menyiapkan informasi terbaru untuk Anda.</p>
                </div>
            @endif
        </div>

        <!-- Content: Minggu Lalu (Older) -->
        <div x-show="activeTab === 'minggu_lalu'" 
             x-transition:enter="transition ease-out duration-300"
             x-transition:enter-start="opacity-0 translate-y-8"
             x-transition:enter-end="opacity-100 translate-y-0"
             style="display: none;">
            
            @if($oldNews->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8 text-left">
                    @foreach($oldNews as $berita)
                    <article class="group bg-white rounded-[2rem] overflow-hidden shadow-lg shadow-blue-100 hover:shadow-2xl hover:shadow-blue-200 transition-all duration-300 border border-blue-50 h-full flex flex-col">
                        <div class="relative h-60 overflow-hidden">
                            <img src="{{ $berita->getThumbnailUrl() }}" alt="{{ $berita->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
                            <span class="absolute top-4 left-4 bg-white/90 backdrop-blur text-slate-700 font-bold px-3 py-1 rounded-lg shadow-sm text-sm">
                                {{ $berita->created_at->format('d M Y') }}
                            </span>
                        </div>
                        
                        <div class="p-8 flex flex-col flex-grow">
                            <h3 class="text-xl font-bold text-slate-800 mb-3 leading-tight group-hover:text-blue-600 transition-colors line-clamp-2">
                                <a href="{{ route('berita.show', $berita->slug) }}">{{ $berita->title }}</a>
                            </h3>
                            
                            <p class="text-slate-500 text-base line-clamp-3 mb-6 flex-grow leading-relaxed">
                                {{ $berita->short_description ? Str::limit($berita->short_description, 100) : Str::limit(strip_tags($berita->content), 100) }}
                            </p>
                            
                            <a href="{{ route('berita.show', $berita->slug) }}" class="text-blue-600 font-bold hover:underline mt-auto flex items-center gap-2">
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
                 <div class="text-center py-24 bg-white rounded-[3rem] border-2 border-dashed border-slate-200">
                    <div class="inline-block p-8 rounded-full bg-slate-100 mb-6">
                        <i class="fas fa-history text-5xl text-slate-300"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-slate-700 mb-3">Arsip Berita Kosong</h3>
                    <p class="text-slate-500 text-xl">Belum ada berita yang diarsipkan.</p>
                </div>
            @endif
        </div>

    </div>
</section>

@endsection
