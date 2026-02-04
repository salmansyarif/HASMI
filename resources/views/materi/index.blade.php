@extends('layouts.app')

@section('title', 'Semua Materi - HASMI')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    
    /* Smooth Scrollbar */
    ::-webkit-scrollbar { width: 10px; }
    ::-webkit-scrollbar-track { background: #1e3a8a; }
    ::-webkit-scrollbar-thumb { 
        background: linear-gradient(to bottom, #3b82f6, #1d4ed8); 
        border-radius: 5px;
    }

    /* Glassmorphism Article Card */
    .glass-card {
        background: rgba(30, 58, 138, 0.4);
        backdrop-filter: blur(12px);
        border: 1px solid rgba(96, 165, 250, 0.3);
    }

    /* Shimmer Effect for Loading */
    .shimmer {
        background: linear-gradient(90deg, #1e3a8a 25%, #1e40af 50%, #1e3a8a 75%);
        background-size: 200% 100%;
        animation: shimmer 1.5s infinite;
    }
    @keyframes shimmer {
        0% { background-position: 200% 0; }
        100% { background-position: -200% 0; }
    }

    /* Image Pan Animation */
    .group:hover .pan-image {
        transform: scale(1.1) translateX(10px);
    }
</style>

{{-- HERO SECTION --}}
<section class="relative min-h-[50vh] flex items-center overflow-hidden bg-gradient-to-br from-blue-800 to-blue-900">
    {{-- Dynamic Background --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-800/90 via-blue-900/80 to-blue-900/95"></div>
        <div class="islamic-pattern opacity-10"></div>
        
        <div class="absolute top-0 -left-20 w-72 h-72 bg-blue-600 rounded-full mix-blend-multiply filter blur-[80px] opacity-30 animate-blob"></div>
        <div class="absolute top-0 -right-20 w-72 h-72 bg-cyan-600 rounded-full mix-blend-multiply filter blur-[80px] opacity-30 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-20 left-1/2 w-72 h-72 bg-indigo-600 rounded-full mix-blend-multiply filter blur-[80px] opacity-30 animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl">
            <div class="flex items-center gap-2 mb-6" data-aos="fade-right">
                <span class="h-[2px] w-12 bg-blue-500"></span>
                <span class="text-blue-400 font-bold uppercase tracking-widest text-sm">Learning Center</span>
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-extrabold text-white mb-8 leading-tight" data-aos="fade-up" data-aos-delay="200">
                Eksplorasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-300">Cahaya Ilmu</span> Islami
            </h1>
            
            <p class="text-xl text-blue-100 max-w-2xl mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="400">
                Temukan ribuan artikel, kajian, dan materi pembelajaran yang disusun secara sistematis untuk meningkatkan kualitas iman dan ilmu Anda.
            </p>

            <div class="flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="600">
                <a href="#materi" class="px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white rounded-xl font-bold transition-all shadow-lg shadow-blue-500/25 flex items-center gap-2">
                    Mulai Belajar <i class="fas fa-chevron-down text-sm"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section id="materi" class="py-20 bg-gradient-to-br from-blue-900 to-blue-800 relative">
    <div class="container mx-auto px-6 lg:px-12">
        
        {{-- Toolbar/Filter (Simulasi) --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6" data-aos="fade-down">
            <div>
                <h2 class="text-3xl font-bold text-white">Materi Terbaru</h2>
                <p class="text-blue-200">Menampilkan {{ $articles->count() }} materi pilihan</p>
            </div>
            <div class="flex gap-2">
                <button class="p-3 bg-blue-800/50 border border-blue-400/30 rounded-lg hover:bg-blue-700/50 hover:text-blue-300 transition-all text-blue-200">
                    <i class="fas fa-th-large"></i>
                </button>
                <button class="p-3 bg-blue-800/50 border border-blue-400/30 rounded-lg hover:bg-blue-700/50 hover:text-blue-300 transition-all text-blue-200">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>

        @if($articles->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($articles as $index => $article)
                <article class="group relative flex flex-col h-full glass-card rounded-[2rem] overflow-hidden transition-all duration-500 hover:shadow-2xl hover:shadow-blue-500/30 hover:-translate-y-2 border-2 border-blue-400/30"
                         data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 150 }}">
                    
                    {{-- Image Wrapper --}}
                    <div class="relative h-64 overflow-hidden">
                        @if($article->thumbnail)
                            <img src="{{ asset($article->thumbnail) }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 pan-image"
                                 alt="{{ $article->title }}">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                                <i class="fas fa-book-open text-white/30 text-6xl"></i>
                            </div>
                        @endif
                        
                        {{-- Badge Category --}}
                        <div class="absolute top-5 left-5">
                            <span class="px-4 py-2 bg-white/90 backdrop-blur-md text-blue-700 text-xs font-bold rounded-lg shadow-sm flex items-center gap-2">
                                <i class="fas {{ $article->category->icon ?? 'fa-tag' }}"></i>
                                {{ $article->category->name }}
                            </span>
                        </div>
                    </div>

                    {{-- Card Body --}}
                    <div class="p-8 flex flex-col flex-grow">
                        <div class="flex items-center gap-3 text-xs text-blue-300 mb-4 font-medium uppercase tracking-widest">
                            <span class="flex items-center gap-1"><i class="far fa-calendar"></i> {{ $article->published_at->format('d M, Y') }}</span>
                            <span class="w-1 h-1 bg-blue-400 rounded-full"></span>
                            <span class="flex items-center gap-1"><i class="far fa-clock"></i> 5 Menit Baca</span>
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-300 transition-colors">
                            {{ $article->title }}
                        </h3>

                        <p class="text-blue-100 line-clamp-3 mb-8 flex-grow leading-relaxed">
                            {{ $article->excerpt }}
                        </p>

                        <div class="pt-6 border-t border-blue-400/30 flex items-center justify-between">
                            <a href="{{ route('materi.detail', [$article->category->slug, $article->slug]) }}" 
                               class="text-blue-300 font-bold flex items-center gap-2 group/btn hover:text-white transition-colors">
                                Pelajari <i class="fas fa-arrow-right text-sm transition-transform group-hover/btn:translate-x-2"></i>
                            </a>
                            <div class="flex -space-x-2">
                                <div class="w-8 h-8 rounded-full border-2 border-blue-400 bg-blue-700 flex items-center justify-center text-[10px] font-bold text-white">
                                    {{ substr($article->author->name, 0, 1) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- Custom Pagination Container --}}
            <div class="mt-20 flex justify-center">
                <div class="bg-blue-800/50 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-blue-400/30">
                    {{ $articles->links('vendor.pagination.tailwind') }}
                </div>
            </div>

        @else
            <div class="text-center py-20 bg-blue-800/40 backdrop-blur-md rounded-3xl border-2 border-dashed border-blue-400/40">
                <img src="https://illustrations.popsy.co/amber/empty-states.svg" class="w-64 mx-auto mb-6 opacity-50" alt="Empty">
                <h3 class="text-2xl font-bold text-white">Materi Belum Tersedia</h3>
                <p class="text-blue-200">Kami sedang menyiapkan konten berkualitas untuk Anda.</p>
            </div>
        @endif
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 800,
            easing: 'ease-out-back',
            once: true
        });

        // Hover Effect Magnet
        const cards = document.querySelectorAll('.glass-card');
        cards.forEach(card => {
            card.addEventListener('mousemove', e => {
                const rect = card.getBoundingClientRect();
                const x = e.clientX - rect.left;
                const y = e.clientY - rect.top;
                
                card.style.setProperty('--mouse-x', `${x}px`);
                card.style.setProperty('--mouse-y', `${y}px`);
            });
        });
    });
</script>
@endsection