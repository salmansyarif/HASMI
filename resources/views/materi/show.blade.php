@extends('layouts.app')

@section('title', 'Semua Materi - HASMI')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; }
    
    /* Smooth Scrollbar - UPDATED */
    ::-webkit-scrollbar { width: 10px; }
    ::-webkit-scrollbar-track { background: #1d4ed8; }
    ::-webkit-scrollbar-thumb { 
        background: linear-gradient(to bottom, #2563eb, #3b82f6); 
        border-radius: 5px;
    }

    /* Article Card Enhancements - UPDATED */
    .article-card {
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        border: 1px solid rgba(59, 130, 246, 0.4);
        background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    }
    .article-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.7);
        border-color: rgba(96, 165, 250, 0.7);
    }

    /* Islamic Pattern Soft Overlay */
    .islamic-pattern {
        background-image: url('https://www.transparenttextures.com/patterns/islamic-art.png');
        opacity: 0.15;
    }
</style>

{{-- HERO SECTION --}}
<section class="relative min-h-[50vh] flex items-center overflow-hidden bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800">
    {{-- Dynamic Background --}}
    <div class="absolute inset-0 z-0">
        <div class="absolute inset-0 bg-gradient-to-br from-blue-700/90 via-blue-600/80 to-blue-800/95"></div>
        <div class="islamic-pattern opacity-15"></div>
        
        <div class="absolute top-0 -left-20 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 animate-blob"></div>
        <div class="absolute top-0 -right-20 w-72 h-72 bg-blue-400 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 animate-blob animation-delay-2000"></div>
        <div class="absolute -bottom-20 left-1/2 w-72 h-72 bg-blue-500 rounded-full mix-blend-multiply filter blur-[80px] opacity-40 animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-4xl">
            <div class="flex items-center gap-2 mb-6" data-aos="fade-right">
                <span class="h-[2px] w-12 bg-blue-300"></span>
                <span class="text-blue-100 font-bold uppercase tracking-widest text-sm">Learning Center</span>
            </div>
            
            <h1 class="text-5xl lg:text-7xl font-extrabold text-white mb-8 leading-tight" data-aos="fade-up" data-aos-delay="200">
                Eksplorasi <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-blue-100 to-blue-200">Cahaya Ilmu</span> Islami
            </h1>
            
            <p class="text-xl text-blue-100/80 max-w-2xl mb-10 leading-relaxed" data-aos="fade-up" data-aos-delay="400">
                Temukan ribuan artikel, kajian, dan materi pembelajaran yang disusun secara sistematis untuk meningkatkan kualitas iman dan ilmu Anda.
            </p>

            <div class="flex flex-wrap gap-4" data-aos="fade-up" data-aos-delay="600">
                <a href="#materi" class="px-8 py-4 bg-blue-500 hover:bg-blue-400 text-white rounded-xl font-bold transition-all shadow-lg shadow-blue-800/40 flex items-center gap-2 border-2 border-blue-400/40">
                    Mulai Belajar <i class="fas fa-chevron-down text-sm"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section id="materi" class="py-20 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative">
    <div class="container mx-auto px-6 lg:px-12">
        
        {{-- Toolbar/Filter (Simulasi) --}}
        <div class="flex flex-col md:flex-row justify-between items-center mb-12 gap-6" data-aos="fade-down">
            <div>
                <h2 class="text-3xl font-bold text-white">Materi Terbaru</h2>
                <p class="text-blue-100">Menampilkan {{ $articles->count() }} materi pilihan</p>
            </div>
            <div class="flex gap-2">
                <button class="p-3 bg-blue-600/50 border border-blue-300/30 rounded-lg hover:bg-blue-500 hover:text-blue-100 transition-all text-blue-100">
                    <i class="fas fa-th-large"></i>
                </button>
                <button class="p-3 bg-blue-600/50 border border-blue-300/30 rounded-lg hover:bg-blue-500 hover:text-blue-100 transition-all text-blue-100">
                    <i class="fas fa-list"></i>
                </button>
            </div>
        </div>

        @if($articles->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-10">
                @foreach($articles as $index => $article)
                <article class="article-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                         data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    
                    {{-- Thumbnail with Glow --}}
                    <div class="h-80 relative overflow-hidden m-4 rounded-[2rem]">
                        @if($article->thumbnail)
                            <img src="{{ asset($article->thumbnail) }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 alt="{{ $article->title }}"
                                 loading="lazy">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                <i class="fas fa-book-open text-white/20 text-6xl"></i>
                            </div>
                        @endif
                        
                        {{-- Overlay Info --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                            <p class="text-white text-xs leading-relaxed italic">
                                "Klik untuk membaca selengkapnya materi ini."
                            </p>
                        </div>

                        {{-- Floating Badges --}}
                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                            <span class="px-4 py-2 bg-blue-500 text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg border border-blue-400/30">
                                {{ $article->category->name }}
                            </span>
                        </div>
                    </div>

                    {{-- Card Content --}}
                    <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="far fa-calendar-alt text-blue-100 text-xs"></i>
                            <span class="text-blue-100 text-[11px] font-bold uppercase tracking-wider">
                                {{ $article->published_at ? $article->published_at->locale('id')->isoFormat('D MMMM Y') : 'Baru' }}
                            </span>
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                            {{ $article->title }}
                        </h3>
                        
                        <p class="text-blue-100 text-sm leading-relaxed mb-8 line-clamp-3 font-medium">
                            {{ $article->excerpt }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('materi.detail', [$article->category->slug, $article->slug]) }}" 
                               class="w-full py-4 bg-blue-500 group-hover:bg-blue-400 text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition-all transform active:scale-95 shadow-xl shadow-blue-800/50 border-2 border-blue-400/40">
                                <span>Baca Materi</span>
                                <i class="fas fa-arrow-right text-sm group-hover:translate-x-2 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- Custom Pagination Container --}}
            <div class="mt-20 flex justify-center">
                <div class="bg-blue-600/50 backdrop-blur-md p-4 rounded-2xl shadow-lg border border-blue-300/30">
                    {{ $articles->links('vendor.pagination.tailwind') }}
                </div>
            </div>

        @else
            <div class="text-center py-20 bg-blue-600/50 backdrop-blur-md rounded-3xl border-2 border-dashed border-blue-400/30">
                <img src="https://illustrations.popsy.co/amber/empty-states.svg" class="w-64 mx-auto mb-6 opacity-50" alt="Empty">
                <h3 class="text-2xl font-bold text-white">Materi Belum Tersedia</h3>
                <p class="text-blue-100">Kami sedang menyiapkan konten berkualitas untuk Anda.</p>
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