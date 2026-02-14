@extends('layouts.app')

@section('title', 'Semua Materi - HASMI')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    
    ::-webkit-scrollbar { width: 10px; }
    ::-webkit-scrollbar-track { background: #2563eb; }
    ::-webkit-scrollbar-thumb { 
        background: linear-gradient(to bottom, #3b82f6, #60a5fa); 
        border-radius: 5px;
    }

    /* Card: mobile hanya border transition */
    .article-card {
        border: 1px solid rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
        transition: border-color 0.25s ease;
    }

    /* Hover hanya untuk device pointer (desktop) */
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

    /* Blob: hanya desktop */
    @media (min-width: 1024px) {
        @keyframes blob {
            0%, 100% { transform: translate(0, 0) scale(1); }
            33% { transform: translate(20px, -30px) scale(1.05); }
            66% { transform: translate(-15px, 15px) scale(0.95); }
        }
        .animate-blob { animation: blob 20s infinite ease-in-out; }
        .animation-delay-2000 { animation-delay: 7s; }
        .animation-delay-4000 { animation-delay: 14s; }
    }

    /* Gradient BG hero: matikan animasi di mobile */
    @media (max-width: 1023px) {
        .hero-section-bg {
            background: linear-gradient(135deg, #2563eb, #1d4ed8);
        }
    }

    /* Islamic pattern: lightweight, tanpa external fetch di mobile */
    @media (min-width: 1024px) {
        .islamic-pattern {
            background-image: url('https://www.transparenttextures.com/patterns/islamic-art.png');
            opacity: 0.1;
        }
    }

    /* ===== AOS MOBILE SAFETY NET =====
       Paksa elemen data-aos selalu visible di mobile
       sebelum JS sempat jalan (mencegah halaman kosong) */
    @media (max-width: 1023px) {
        [data-aos] {
            opacity: 1 !important;
            transform: none !important;
            transition: none !important;
            visibility: visible !important;
        }
    }

    /* Reduce motion */
    @media (prefers-reduced-motion: reduce) {
        *, *::before, *::after {
            animation-duration: 0.01ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.01ms !important;
        }
    }

    
</style>

{{-- HERO SECTION --}}
<section class="hero-section-bg relative min-h-[50vh] flex items-center overflow-hidden bg-gradient-to-br from-blue-600 to-blue-700">
    {{-- Animated blobs: hanya desktop --}}
    <div class="absolute inset-0 z-0 hidden lg:block">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-600/90 via-blue-700/80 to-blue-700/95"></div>
        <div class="islamic-pattern absolute inset-0"></div>
        <div class="absolute top-0 -left-20 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 animate-blob"></div>
        <div class="absolute top-0 -right-20 w-72 h-72 bg-cyan-400 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-20 left-1/2 w-72 h-72 bg-indigo-400 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl">
            <div class="flex items-center gap-2 mb-6" data-aos="fade-right">
                <span class="h-[2px] w-12 bg-blue-300"></span>
                <span class="text-blue-200 font-bold uppercase tracking-widest text-sm">Learning Center</span>
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-extrabold text-white mb-8 leading-tight" data-aos="fade-up" data-aos-delay="200">
                Eksplorasi <span class="text-blue-200">Cahaya Ilmu</span> Islami
            </h1>
            
            <p class="text-xl text-blue-50 max-w-2xl mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="400">
                Temukan ribuan artikel, kajian, dan materi pembelajaran yang disusun secara sistematis untuk meningkatkan kualitas iman dan ilmu Anda.
            </p>

            <div class="flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="600">
                <a href="#materi" class="px-8 py-4 bg-blue-500 hover:bg-blue-400 text-white rounded-xl font-bold transition-colors shadow-lg flex items-center gap-2">
                    Mulai Belajar <i class="fas fa-chevron-down text-sm"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section id="materi" class="py-20 bg-gradient-to-br from-blue-700 to-blue-600 relative">
    <div class="container mx-auto px-6 lg:px-12">
        
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6" data-aos="fade-down">
            <div>
                <h2 class="text-3xl font-bold text-white">Materi Terbaru</h2>
                <p class="text-blue-100">Menampilkan {{ $articles->count() }} materi pilihan</p>
            </div>
            <div class="flex gap-2">
                <button class="p-3 bg-blue-600/60 border border-blue-300/40 rounded-lg hover:bg-blue-500/70 transition-colors text-blue-100">
                    <i class="fas fa-th-large"></i>
                </button>
                <button class="p-3 bg-blue-600/60 border border-blue-300/40 rounded-lg hover:bg-blue-500/70 transition-colors text-blue-100">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>

        @if($articles->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-10">
                @foreach($articles as $index => $article)
                <article class="article-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                         data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    
                    <div class="h-80 relative overflow-hidden m-4 rounded-[2rem]">
                        @if($article->thumbnail)
                            <img src="{{ asset($article->thumbnail) }}" 
                                 class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105"
                                 alt="{{ $article->title }}"
                                 loading="lazy">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-400 to-indigo-600 flex items-center justify-center">
                                <i class="fas fa-book-open text-white/20 text-6xl"></i>
                            </div>
                        @endif

                        {{-- Hover overlay: hanya desktop via CSS --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 items-end p-6 hidden lg:flex">
                            <p class="text-white text-xs leading-relaxed italic">
                                "Klik untuk membaca selengkapnya materi ini."
                            </p>
                        </div>

                        <div class="absolute top-4 left-4">
                            <span class="px-4 py-2 bg-blue-500 text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg border border-white/30">
                                {{ $article->category->name }}
                            </span>
                        </div>
                    </div>

                    <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="far fa-calendar-alt text-blue-100 text-xs"></i>
                            <span class="text-blue-50 text-[11px] font-bold uppercase tracking-wider">
                                {{ $article->published_at ? $article->published_at->locale('id')->isoFormat('D MMMM Y') : 'Baru' }}
                            </span>
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                            {{ $article->title }}
                        </h3>
                        
                        <p class="text-blue-50 text-sm leading-relaxed mb-8 line-clamp-3 font-medium">
                            {{ $article->excerpt }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('materi.detail', [$article->category->slug, $article->slug]) }}" 
                               class="w-full py-4 bg-blue-500 hover:bg-blue-400 text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition-colors active:scale-95 shadow-xl shadow-blue-700/50">
                                <span>Baca Materi</span>
                                <i class="fas fa-arrow-right text-sm"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            <div class="mt-20 flex justify-center">
                <div class="bg-blue-600/60 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-blue-300/40">
                    {{ $articles->links('vendor.pagination.tailwind') }}
                </div>
            </div>

        @else
            <div class="text-center py-20 bg-blue-600/50 backdrop-blur-md rounded-3xl border-2 border-dashed border-blue-300/50">
                <h3 class="text-2xl font-bold text-white">Materi Belum Tersedia</h3>
                <p class="text-blue-100">Kami sedang menyiapkan konten berkualitas untuk Anda.</p>
            </div>
        @endif
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