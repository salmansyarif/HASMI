@extends('layouts.app')

@section('title', 'Berita Terkini - HASMI')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

    /* Hero BG animasi: hanya desktop */
    @media (min-width: 1024px) {
        .hero-animate {
            background: linear-gradient(-45deg, #1d4ed8, #2563eb, #1d4ed8, #2563eb);
            background-size: 400% 400%;
            animation: gradientBG 20s ease infinite;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }
    }
    @media (max-width: 1023px) {
        .hero-animate {
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
        }
    }

    /* Card: mobile hanya border transition */
    .news-card {
        border: 1px solid rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        transition: border-color 0.25s ease;
    }

    /* Hover hanya desktop */
    @media (hover: hover) and (pointer: fine) {
        .news-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform;
        }
        .news-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 20px 40px -12px rgba(59, 130, 246, 0.6);
            border-color: rgba(96, 165, 250, 0.7);
        }
    }

    /* Pulse badge hanya desktop */
    @media (max-width: 1023px) {
        .badge-new { animation: none !important; }
    }

    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }
</style>

{{-- HERO SECTION --}}
<section class="relative min-h-[40vh] flex items-center overflow-hidden hero-animate">
    <div class="container mx-auto px-6 relative z-10 py-16 text-center">
        <h1 class="text-4xl lg:text-6xl font-extrabold text-white mb-6 tracking-tight" data-aos="fade-up">
            Berita <span class="text-blue-200">Terkini</span>
        </h1>
        <p class="text-xl text-blue-100/80 max-w-2xl mx-auto mb-8 leading-relaxed font-light" data-aos="fade-up" data-aos-delay="200">
            Informasi terbaru seputar kegiatan dan perkembangan dakwah HASMI.
        </p>
    </div>
    
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="#1d4ed8"/>
        </svg>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section class="py-16 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden">
    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        
        {{-- BERITA HARI INI --}}
        <div class="mb-20">
            <div class="flex items-center gap-4 mb-10" data-aos="fade-right">
                <div class="w-2 h-10 bg-blue-300 rounded-full"></div>
                <h2 class="text-3xl font-bold text-white uppercase tracking-wider">Berita Hari Ini</h2>
            </div>

            @if($todayNews->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                    @foreach($todayNews as $index => $news)
                    <article class="news-card group rounded-3xl overflow-hidden flex flex-col h-full"
                             data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        
                        <div class="h-60 relative overflow-hidden">
                            <img src="{{ $news->getThumbnailUrl() }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 alt="{{ $news->title }}" loading="lazy">
                            <div class="absolute top-4 right-4 bg-blue-500 text-white text-xs font-bold px-3 py-1 rounded-full badge-new animate-pulse border-2 border-blue-300/40">
                                NEW
                            </div>
                        </div>

                        <div class="p-6 flex flex-col flex-grow">
                            <div class="flex items-center gap-2 mb-3 text-xs text-blue-100">
                                <i class="far fa-calendar-alt"></i>
                                <span>{{ $news->created_at->format('d M Y') }}</span>
                            </div>

                            <h3 class="text-xl font-bold text-white mb-3 line-clamp-2 group-hover:text-blue-100 transition-colors">
                                {{ $news->title }}
                            </h3>
                            
                            <p class="text-blue-100 text-sm leading-relaxed mb-6 line-clamp-3 font-light">
                                {{ Str::limit(strip_tags($news->content), 100) }}
                            </p>
                            
                            <div class="mt-auto">
                                <a href="{{ route('berita-terkini.show', $news->slug) }}" 
                                   class="inline-flex items-center text-blue-200 font-semibold hover:text-blue-100 transition-colors">
                                    Baca Selengkapnya <i class="fas fa-arrow-right ml-2 text-sm"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>
            @else
                <div class="text-center py-10 bg-blue-700/30 rounded-3xl border border-blue-500/50">
                    <p class="text-blue-100 italic">Belum ada berita untuk hari ini.</p>
                </div>
            @endif
        </div>

        {{-- BERITA MINGGU LALU --}}
        <div>
            <div class="flex items-center gap-4 mb-10" data-aos="fade-right">
                <div class="w-2 h-10 bg-blue-400 rounded-full"></div>
                <h2 class="text-3xl font-bold text-white uppercase tracking-wider">Berita Minggu Lalu</h2>
            </div>

            @if($olderNews->count() > 0)
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach($olderNews as $index => $news)
                    <article class="news-card group rounded-2xl overflow-hidden flex flex-col h-full"
                             data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                        
                        <div class="h-48 relative overflow-hidden">
                            <img src="{{ $news->getThumbnailUrl() }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 alt="{{ $news->title }}" loading="lazy">
                        </div>

                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex items-center gap-2 mb-2 text-xs text-blue-100">
                                <i class="far fa-calendar-alt"></i>
                                <span>{{ $news->created_at->format('d M Y') }}</span>
                            </div>

                            <h3 class="text-lg font-bold text-white mb-2 line-clamp-2 group-hover:text-blue-100 transition-colors">
                                {{ $news->title }}
                            </h3>
                            
                            <div class="mt-auto pt-4">
                                <a href="{{ route('berita-terkini.show', $news->slug) }}" 
                                   class="text-sm text-blue-200 font-semibold hover:text-white transition-colors">
                                    Lihat Detail &rarr;
                                </a>
                            </div>
                        </div>
                    </article>
                    @endforeach
                </div>

                <div class="mt-12 flex justify-center">
                    {{ $olderNews->links('vendor.pagination.tailwind') }}
                </div>
            @else
                <div class="text-center py-10 bg-blue-700/30 rounded-3xl border border-blue-500/50">
                    <p class="text-blue-100 italic">Belum ada berita lama.</p>
                </div>
            @endif
        </div>

    </div>
</section>

<script data-cfasync="false" src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script data-cfasync="false">
    document.addEventListener('DOMContentLoaded', function() {
        const isMobile = window.innerWidth < 1024 ||
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

        if (!isMobile) {
            AOS.init({ duration: 800, easing: 'ease-out-cubic', once: true });
        }
    });
</script>
@endsection