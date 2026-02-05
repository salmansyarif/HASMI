@extends('layouts.app')

@section('title', $subCategory->name . ' - ' . $category->name . ' - HASMI')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

    /* Hero Gradient Animation */
    .hero-animate {
        background: linear-gradient(-45deg, #1e40af, #1e3a8a, #1e40af, #1e3a8a);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
    }
    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Article Card Enhancements */
    .article-card {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(59, 130, 246, 0.3);
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
    }
    .article-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.5);
        border-color: rgba(96, 165, 250, 0.6);
    }

    /* Floating Shape Animation */
    .shape-float {
        animation: shapeFloat 6s ease-in-out infinite;
    }
    @keyframes shapeFloat {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    /* Islamic Pattern Soft Overlay */
    .islamic-pattern {
        background-image: url('https://www.transparenttextures.com/patterns/islamic-art.png');
        opacity: 0.1;
    }
</style>

{{-- HERO SECTION --}}
<section class="relative min-h-[40vh] flex items-center overflow-hidden hero-animate">
    <div class="absolute inset-0 islamic-pattern"></div>
    
    {{-- Animated Shapes --}}
    <div class="absolute top-10 left-10 w-32 h-32 bg-blue-400/20 rounded-full blur-3xl shape-float"></div>
    <div class="absolute bottom-10 right-10 w-48 h-48 bg-cyan-400/20 rounded-full blur-3xl shape-float" style="animation-delay: 2s"></div>

    <div class="container mx-auto px-6 relative z-10 py-16 text-center">
        <!-- Breadcrumb -->
        <nav class="flex justify-center mb-8" aria-label="Breadcrumb" data-aos="fade-down">
            <ol class="inline-flex items-center space-x-1 md:space-x-3 text-sm text-blue-200">
                <li class="inline-flex items-center">
                    <a href="{{ route('materi.index') }}" class="hover:text-white transition-colors">
                        Materi
                    </a>
                </li>
                <li><i class="fas fa-chevron-right text-xs opacity-50 mx-2"></i></li>
                <li>
                    <a href="{{ route('materi.show', $category->slug) }}" class="hover:text-white transition-colors">
                        {{ $category->name }}
                    </a>
                </li>
                <li><i class="fas fa-chevron-right text-xs opacity-50 mx-2"></i></li>
                <li aria-current="page">
                    <span class="font-semibold text-white">{{ $subCategory->name }}</span>
                </li>
            </ol>
        </nav>

        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-white/10 backdrop-blur-md border border-white/20 text-white mb-6 shadow-lg" data-aos="zoom-in">
            <i class="fas {{ $subCategory->icon ?? 'fa-book' }} text-3xl"></i>
        </div>
        
        <h1 class="text-4xl lg:text-5xl font-extrabold text-white mb-4 tracking-tight" data-aos="fade-up" data-aos-delay="200">
            {{ $subCategory->name }}
        </h1>
        
        <p class="text-xl text-blue-100/90 max-w-2xl mx-auto leading-relaxed font-light" data-aos="fade-up" data-aos-delay="300">
            Kumpulan materi pilihan kategori {{ $category->name }}
        </p>
    </div>

    {{-- Wave Divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="#1e3a8a"/>
        </svg>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section class="py-16 bg-gradient-to-b from-blue-900 to-blue-800 relative min-h-screen">
    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        @if($articles->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-10">
                @foreach($articles as $index => $article)
                <article class="article-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                         data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    
                    {{-- Thumbnail --}}
                    <div class="h-80 relative overflow-hidden m-4 rounded-[2rem]">
                        @if($article->thumbnail)
                            <img src="{{ asset($article->thumbnail) }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 alt="{{ $article->title }}"
                                 loading="lazy">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-600 to-indigo-800 flex items-center justify-center">
                                <i class="fas fa-book-open text-white/20 text-6xl"></i>
                            </div>
                        @endif
                        
                        {{-- Overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                            <p class="text-white text-xs leading-relaxed italic">
                                "Klik untuk membaca selengkapnya."
                            </p>
                        </div>

                        {{-- Category Badge --}}
                        <div class="absolute top-4 left-4">
                            <span class="px-4 py-2 bg-blue-600/90 backdrop-blur-md text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg border border-white/20">
                                {{ $article->subCategory->name ?? $category->name }}
                            </span>
                        </div>
                    </div>

                    {{-- Content --}}
                    <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="far fa-calendar-alt text-blue-300 text-xs"></i>
                            <span class="text-blue-200 text-[11px] font-bold uppercase tracking-wider">
                                {{ $article->published_at ? $article->published_at->locale('id')->isoFormat('D MMMM Y') : 'Baru' }}
                            </span>
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-200 transition-colors leading-tight">
                            {{ $article->title }}
                        </h3>
                        
                        <p class="text-blue-100 text-sm leading-relaxed mb-8 line-clamp-3 font-medium">
                            {{ $article->excerpt }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('materi.detail', [$category->slug, $article->slug]) }}" 
                               class="w-full py-4 bg-blue-600 group-hover:bg-blue-500 text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition-all transform active:scale-95 shadow-xl shadow-blue-900/50">
                                <span>Baca Materi</span>
                                <i class="fas fa-arrow-right text-sm group-hover:translate-x-2 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            <div class="mt-20 flex justify-center" data-aos="fade-up">
                <div class="bg-blue-900/50 backdrop-blur-md p-4 rounded-3xl shadow-lg border border-blue-400/30">
                    {{ $articles->links('vendor.pagination.tailwind') }}
                </div>
            </div>

        @else
            <!-- Empty State -->
            <div class="text-center py-20" data-aos="zoom-in">
                <div class="relative w-48 h-48 mx-auto mb-10">
                    <div class="absolute inset-0 bg-blue-600/30 rounded-full animate-ping opacity-20"></div>
                    <div class="relative w-48 h-48 bg-blue-800 rounded-full flex items-center justify-center shadow-2xl border border-blue-600">
                        <i class="fas fa-inbox text-blue-400 text-7xl"></i>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-white mb-4">Belum Ada Artikel</h3>
                <p class="text-blue-200 max-w-md mx-auto mb-10">
                    Sub-kategori <strong>{{ $subCategory->name }}</strong> belum memiliki artikel saat ini.
                </p>
                <a href="{{ route('materi.show', $category->slug) }}" class="px-10 py-4 bg-blue-600 text-white rounded-2xl font-bold shadow-xl hover:bg-blue-500 transition-all">
                    Kembali ke {{ $category->name }}
                </a>
            </div>
        @endif
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 1000,
            easing: 'ease-out-back',
            once: true
        });
    });
</script>
@endsection