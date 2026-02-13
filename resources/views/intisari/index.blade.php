@extends('layouts.app')

@section('title', 'Intisari HASMI - Artikel & Kajian Pilihan')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

    /* Hero BG: animasi gradient hanya desktop */
    @media (min-width: 1024px) {
        .hero-animate {
            background: linear-gradient(-45deg, #2563eb, #1d4ed8, #2563eb, #1d4ed8);
            background-size: 400% 400%;
            animation: gradientBG 20s ease infinite;
        }
        @keyframes gradientBG {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* Floating shapes: hanya desktop */
        .shape-float { animation: shapeFloat 8s ease-in-out infinite; }
        @keyframes shapeFloat {
            0%, 100% { transform: translateY(0); }
            50% { transform: translateY(-15px); }
        }
    }

    /* Mobile hero: warna solid, tanpa animasi */
    @media (max-width: 1023px) {
        .hero-animate {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }
    }

    /* Card: mobile hanya border transition */
    .article-card {
        border: 1px solid rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        transition: border-color 0.25s ease;
    }

    /* Hover hanya desktop */
    @media (hover: hover) and (pointer: fine) {
        .article-card {
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            will-change: transform;
        }
        .article-card:hover {
            transform: translateY(-8px) scale(1.01);
            box-shadow: 0 20px 40px -12px rgba(59, 130, 246, 0.6);
            border-color: rgba(96, 165, 250, 0.7);
        }
    }

    /* Decorative blur blobs: hanya desktop */
    .deco-blob { display: none; }
    @media (min-width: 1024px) {
        .deco-blob { display: block; }
    }

    /* Islamic pattern: hanya desktop */
    @media (min-width: 1024px) {
        .islamic-pattern {
            background-image: url('https://www.transparenttextures.com/patterns/islamic-art.png');
            opacity: 0.1;
        }
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
<section class="relative min-h-[50vh] flex items-center overflow-hidden hero-animate">
    <div class="islamic-pattern absolute inset-0"></div>

    {{-- Shapes: hanya desktop --}}
    <div class="deco-blob absolute top-10 left-10 w-32 h-32 bg-blue-400/20 rounded-full blur-3xl shape-float"></div>
    <div class="deco-blob absolute bottom-10 right-10 w-48 h-48 bg-blue-300/20 rounded-full blur-3xl shape-float" style="animation-delay: 2s"></div>

    <div class="container mx-auto px-6 relative z-10 py-24 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-blue-500/40 backdrop-blur-md rounded-full border border-blue-400/40 mb-8" data-aos="zoom-in">
            {{-- Ping animation: matikan di mobile --}}
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-300 opacity-75 hidden lg:inline-flex"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-400"></span>
            </span>
            <span class="text-white text-xs font-bold uppercase tracking-widest">Khazanah Pemikiran Islam</span>
        </div>
        
        <h1 class="text-5xl lg:text-7xl font-extrabold text-white mb-8 tracking-tight" data-aos="fade-up" data-aos-delay="200">
            Intisari <span class="text-blue-200">Kajian</span> & Hikmah
        </h1>
        
        <p class="text-xl text-blue-50/90 max-w-2xl mx-auto mb-10 leading-relaxed font-light" data-aos="fade-up" data-aos-delay="400">
            "Menyajikan ringkasan ilmu, hikmah, dan kajian pilihan untuk mencerahkan hati dan pikiran umat."
        </p>

        <div class="flex justify-center gap-4" data-aos="fade-up" data-aos-delay="600">
            <div class="w-20 h-1.5 bg-blue-300 rounded-full"></div>
            <div class="w-8 h-1.5 bg-white/30 rounded-full"></div>
            <div class="w-8 h-1.5 bg-white/30 rounded-full"></div>
        </div>
    </div>

    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="#1d4ed8"/>
        </svg>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section class="py-20 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden">
    {{-- Dekoratif blur: hanya desktop --}}
    <div class="deco-blob absolute top-1/4 -right-20 w-96 h-96 bg-blue-500/30 rounded-full blur-[100px]"></div>
    <div class="deco-blob absolute bottom-1/4 -left-20 w-96 h-96 bg-blue-400/30 rounded-full blur-[100px]"></div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        @if($intisaris->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-10">
                @foreach($intisaris as $index => $intisari)
                <article class="article-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                         data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    
                    <div class="h-80 relative overflow-hidden m-4 rounded-[2rem]">
                        @if($intisari->thumbnail)
                            <img src="{{ asset($intisari->thumbnail) }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 alt="{{ $intisari->title }}"
                                 loading="lazy">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                <i class="fas fa-book-open text-white/20 text-6xl"></i>
                            </div>
                        @endif
                        
                        {{-- Hover overlay: hanya desktop --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 items-end p-6 hidden lg:flex">
                            <p class="text-white text-xs leading-relaxed italic">
                                "Klik untuk membaca selengkapnya artikel bermanfaat ini."
                            </p>
                        </div>

                        <div class="absolute top-4 left-4">
                            <span class="px-4 py-2 bg-blue-500 text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg border border-blue-400/30">
                                Kajian Pilihan
                            </span>
                        </div>
                    </div>

                    <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="far fa-calendar-alt text-blue-100 text-xs"></i>
                            <span class="text-blue-100 text-[11px] font-bold uppercase tracking-wider">
                                {{ $intisari->published_at ? $intisari->published_at->locale('id')->isoFormat('D MMMM Y') : 'Baru' }}
                            </span>
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                            {{ $intisari->title }}
                        </h3>
                        
                        <p class="text-blue-100 text-sm leading-relaxed mb-8 line-clamp-3 font-medium">
                            {{ $intisari->excerpt }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('intisari.show', $intisari->slug) }}" 
                               class="w-full py-4 bg-blue-500 hover:bg-blue-400 text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition-colors active:scale-95 shadow-xl shadow-blue-800/50 border-2 border-blue-400/40">
                                <span>Baca Selengkapnya</span>
                                <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            @if($intisaris->hasPages())
            <div class="mt-20" data-aos="fade-up">
                <div class="flex justify-center bg-blue-700/60 backdrop-blur-md p-4 rounded-3xl border-2 border-blue-400/40 w-fit mx-auto">
                    {{ $intisaris->links('vendor.pagination.tailwind') }}
                </div>
            </div>
            @endif

        @else
            <div class="text-center py-20" data-aos="zoom-in">
                <div class="w-48 h-48 bg-blue-700/60 backdrop-blur-xl rounded-full flex items-center justify-center mx-auto mb-10 border-2 border-blue-400/50">
                    <i class="fas fa-book-reader text-blue-300 text-7xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-white mb-4">Intisari Belum Tersedia</h3>
                <p class="text-blue-100 max-w-md mx-auto mb-10">Tim redaksi sedang menyiapkan konten bermanfaat untuk mencerahkan hari Anda. Silakan kembali lagi nanti.</p>
                <a href="{{ route('home') }}" class="px-10 py-4 bg-blue-500 text-white rounded-2xl font-bold hover:bg-blue-400 transition-colors border-2 border-blue-400/40">Kembali ke Beranda</a>
            </div>
        @endif
    </div>
</section>

<script data-cfasync="false" src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script data-cfasync="false">
    document.addEventListener('DOMContentLoaded', function() {
        const isMobile = window.innerWidth < 1024 ||
            /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

        if (!isMobile) {
            AOS.init({ duration: 900, easing: 'ease-out-cubic', once: true });
        }

        // Magnetic effect: hanya desktop
        if (!isMobile) {
            document.querySelectorAll('.article-card').forEach(el => {
                el.addEventListener('mousemove', (e) => {
                    const rect = el.getBoundingClientRect();
                    const x = e.clientX - rect.left - rect.width / 2;
                    const y = e.clientY - rect.top - rect.height / 2;
                    el.style.transform = `translateY(-8px) translate(${x * 0.03}px, ${y * 0.03}px)`;
                });
                el.addEventListener('mouseleave', () => {
                    el.style.transform = '';
                });
            });
        }
    });
</script>
@endsection