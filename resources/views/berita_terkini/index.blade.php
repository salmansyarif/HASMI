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

    /* Card Enhancements: Same as Program */
    .news-card {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    }

    /* Hover Desktop */
    @media (hover: hover) and (pointer: fine) {
        .news-card:hover {
            transform: translateY(-12px) scale(1.02);
            box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.7);
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

    /* ===== AOS MOBILE SAFETY NET =====
       Paksa elemen data-aos selalu visible di mobile
       sebelum JS sempat jalan (mencegah blank page) */
    @media (max-width: 1023px) {
        [data-aos] {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
            visibility: visible !important;
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
                <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-10">
                    @foreach($todayNews as $index => $news)
                    <article class="news-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                             data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        
                        @if($news->show_thumbnail_in_list)
                        <div class="h-80 relative overflow-hidden m-4 rounded-[2rem]">
                            <img src="{{ $news->getThumbnailUrl() }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 alt="{{ $news->title }}" loading="lazy">
                            <div class="absolute top-4 right-4 bg-blue-500 text-white text-[10px] font-extrabold shadow-lg px-3 py-1 rounded-full badge-new animate-pulse border-2 border-blue-300/40 uppercase tracking-widest">
                                Berita Baru
                            </div>
                            
                            {{-- Overlay Info --}}
                            <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                                <p class="text-white text-xs leading-relaxed italic">
                                    "Klik untuk membaca kabar selengkapnya."
                                </p>
                            </div>
                        </div>
                        @endif

                        <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="p-1 px-3 rounded-lg bg-blue-500/20 border border-blue-400/30 flex items-center gap-2">
                                    <i class="far fa-calendar-alt text-blue-200 text-xs"></i>
                                    <span class="text-blue-100 text-[10px] font-bold uppercase tracking-wider">{{ $news->created_at->format('d M Y') }}</span>
                                </div>
                            </div>

                            <h3 class="text-2xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                                {{ $news->title }}
                            </h3>
                            
                            <p class="text-blue-100 text-sm leading-relaxed mb-8 line-clamp-3 font-medium opacity-90 text-justify">
                                {{ Str::limit(strip_tags($news->content), 120) }}
                            </p>
                            
                            <div class="mt-auto">
                                <a href="{{ route('berita-terkini.show', $news->slug) }}" 
                                   class="w-full py-4 bg-blue-500 group-hover:bg-blue-400 text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition-all transform active:scale-95 shadow-xl shadow-blue-800/50 border-2 border-blue-400/40">
                                    <span>Baca Selengkapnya</span>
                                    <i class="fas fa-arrow-right text-sm group-hover:translate-x-2 transition-transform"></i>
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
                <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-10">
                    @foreach($olderNews as $index => $news)
                    <article class="news-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                             data-aos="fade-up" data-aos-delay="{{ $index * 50 }}">
                        
                        @if($news->show_thumbnail_in_list)
                        <div class="h-80 relative overflow-hidden m-4 rounded-[2rem]">
                            <img src="{{ $news->getThumbnailUrl() }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 alt="{{ $news->title }}" loading="lazy">
                        </div>
                        @endif

                        <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                            <div class="flex items-center gap-2 mb-3">
                                <div class="p-1 px-3 rounded-lg bg-blue-500/20 border border-blue-400/30 flex items-center gap-2">
                                    <i class="far fa-calendar-alt text-blue-200 text-xs"></i>
                                    <span class="text-blue-100 text-[10px] font-bold uppercase tracking-wider">{{ $news->created_at->format('d M Y') }}</span>
                                </div>
                            </div>

                            <h3 class="text-xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                                {{ $news->title }}
                            </h3>
                            
                            <div class="mt-auto pt-6">
                                <a href="{{ route('berita-terkini.show', $news->slug) }}" 
                                   class="w-full py-3 bg-blue-500/40 hover:bg-blue-500 text-white rounded-xl font-bold flex items-center justify-center gap-2 transition-all border border-blue-400/30">
                                    <span>Detail Berita</span>
                                    <i class="fas fa-chevron-right text-xs"></i>
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

        
    // AOS init + fix mobile visibility
    if (!isMobile) {
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 60,
        });
    } else {
        // Mobile: AOS tidak diinit, paksa semua elemen data-aos jadi visible
        document.querySelectorAll('[data-aos]').forEach(el => {
            el.removeAttribute('data-aos');
            el.removeAttribute('data-aos-delay');
            el.removeAttribute('data-aos-duration');
            el.style.opacity = '';
            el.style.transform = '';
            el.style.visibility = '';
        });
    }    });
</script>
@endsection