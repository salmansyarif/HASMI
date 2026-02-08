@extends('layouts.app')

@section('title', 'Semua Program - HASMI')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

    /* Custom Gradient Hero */
    .hero-animate {
        background: linear-gradient(-45deg, #1d4ed8, #2563eb, #1d4ed8, #2563eb);
        background-size: 400% 400%;
        animation: gradientBG 15s ease infinite;
    }
    @keyframes gradientBG {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    /* Article Card Enhancements (Reused for Program) */
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

    /* Floating Shape Animation */
    .shape-float {
        animation: shapeFloat 6s ease-in-out infinite;
    }
    @keyframes shapeFloat {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(5deg); }
    }

    /* Filter Active State */
    .filter-btn.active {
        background: #3b82f6;
        color: white;
        box-shadow: 0 10px 20px rgba(59, 130, 246, 0.5);
        border-color: #3b82f6;
    }
</style>

{{-- HERO SECTION --}}
<section class="relative min-h-[50vh] flex items-center overflow-hidden hero-animate">
    <div class="absolute inset-0 opacity-20 islamic-pattern"></div>
    
    {{-- Animated Shapes --}}
    <div class="absolute top-10 left-10 w-32 h-32 bg-blue-400/20 rounded-full blur-3xl shape-float"></div>
    <div class="absolute bottom-10 right-10 w-48 h-48 bg-blue-300/20 rounded-full blur-3xl shape-float" style="animation-delay: 2s"></div>

    <div class="container mx-auto px-6 relative z-10 py-24 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md rounded-full border border-white/20 mb-8" data-aos="zoom-in">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-blue-300 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-blue-400"></span>
            </span>
            <span class="text-white text-xs font-bold uppercase tracking-widest">Wujudkan Kebaikan Bersama</span>
        </div>
        
        <h1 class="text-5xl lg:text-7xl font-extrabold text-white mb-8 tracking-tight" data-aos="fade-up" data-aos-delay="200">
            Program <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-blue-100 to-blue-200">Kemanusiaan</span> & Dakwah
        </h1>
        
        <p class="text-xl text-blue-100/80 max-w-2xl mx-auto mb-10 leading-relaxed font-light" data-aos="fade-up" data-aos-delay="400">
            "Sebaik-baik manusia adalah yang paling bermanfaat bagi orang lain." Telusuri berbagai inisiatif kami untuk umat.
        </p>

        <div class="flex justify-center gap-4" data-aos="fade-up" data-aos-delay="600">
            <div class="w-20 h-1.5 bg-blue-300 rounded-full"></div>
            <div class="w-8 h-1.5 bg-white/30 rounded-full"></div>
            <div class="w-8 h-1.5 bg-white/30 rounded-full"></div>
        </div>
    </div>

    {{-- Wave Divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="#1e40af"/>
        </svg>
    </div>
</section>

{{-- FILTER SECTION --}}
<section class="py-12 bg-blue-700 border-b border-blue-600">
    <div class="container mx-auto px-6">
        <div class="flex flex-wrap justify-center gap-3 lg:gap-6" data-aos="fade-up">
            <a href="{{ route('program.index') }}" 
               class="filter-btn active px-8 py-3 rounded-2xl border-2 border-blue-400/40 font-bold transition-all flex items-center gap-2">
               <i class="fas fa-grid-2"></i> Semua Program
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('program.category', $cat->slug) }}" 
               class="filter-btn px-8 py-3 bg-blue-600/50 rounded-2xl border-2 border-blue-400/40 text-blue-100 hover:border-blue-300 hover:text-white hover:bg-blue-500/60 font-bold transition-all group shadow-sm">
               <i class="fas {{ $cat->icon ?? 'fa-heart' }} mr-2 group-hover:animate-bounce"></i>
               {{ $cat->name }}
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section class="py-20 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-1/4 -right-20 w-96 h-96 bg-blue-500/30 rounded-full blur-[100px] opacity-50"></div>
    <div class="absolute bottom-1/4 -left-20 w-96 h-96 bg-blue-400/30 rounded-full blur-[100px] opacity-50"></div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        @if($programs->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-10">
                @foreach($programs as $index => $program)
                <article class="article-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                         data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    
                    {{-- Thumbnail with Glow --}}
                    <div class="h-80 relative overflow-hidden m-4 rounded-[2rem]">
                        @if($program->thumbnail)
                            <img src="{{ asset('storage/' . $program->thumbnail) }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 alt="{{ $program->title }}"
                                 loading="lazy">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                <i class="fas fa-hand-holding-heart text-white/20 text-6xl"></i>
                            </div>
                        @endif
                        
                        {{-- Overlay Info --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                            <p class="text-white text-xs leading-relaxed italic">
                                "Klik untuk melihat detail program ini."
                            </p>
                        </div>

                        {{-- Floating Badges --}}
                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                            <span class="px-4 py-2 bg-blue-500 text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg border border-blue-400/30">
                                {{ $program->category->name ?? 'Program' }}
                            </span>
                        </div>
                    </div>

                    {{-- Card Content --}}
                    <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-3">
                            <div class="p-1 px-2 rounded-lg bg-green-500/20 border border-green-500/30 flex items-center gap-1">
                                <span class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></span>
                                <span class="text-green-300 text-[10px] font-bold uppercase">Aktif</span>
                            </div>
                        </div>

                        <h3 class="text-2xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                            {{ $program->title }}
                        </h3>
                        
                        <p class="text-blue-100 text-sm leading-relaxed mb-8 line-clamp-3 font-medium">
                            {{ \Illuminate\Support\Str::limit(strip_tags($program->description), 100) }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('program.show', $program->slug) }}" 
                               class="w-full py-4 bg-blue-500 group-hover:bg-blue-400 text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition-all transform active:scale-95 shadow-xl shadow-blue-800/50 border-2 border-blue-400/40">
                                <span>Detail Program</span>
                                <i class="fas fa-arrow-right text-sm group-hover:translate-x-2 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($programs->hasPages())
            <div class="mt-20" data-aos="fade-up">
                <div class="flex justify-center bg-blue-600/50 backdrop-blur-md p-4 rounded-3xl shadow-lg border border-blue-400/40 w-fit mx-auto">
                    {{ $programs->links('vendor.pagination.tailwind') }}
                </div>
            </div>
            @endif

        @else
            <div class="text-center py-20" data-aos="zoom-in">
                <div class="relative w-48 h-48 mx-auto mb-10">
                    <div class="absolute inset-0 bg-blue-500/30 rounded-full animate-ping opacity-20"></div>
                    <div class="relative w-48 h-48 bg-blue-600/50 backdrop-blur-md rounded-full flex items-center justify-center shadow-2xl border-2 border-blue-400/40">
                        <i class="fas fa-heart-circle-exclamation text-blue-300 text-7xl"></i>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-white mb-4">Belum Ada Program Aktif</h3>
                <p class="text-blue-100 max-w-md mx-auto mb-10">Maaf, kategori program yang Anda cari belum tersedia saat ini. Silakan cek kembali nanti.</p>
                <a href="{{ route('program.index') }}" class="px-10 py-4 bg-blue-500 text-white rounded-2xl font-bold shadow-xl hover:bg-blue-400 transition-all border-2 border-blue-400/40">Lihat Semua Program</a>
            </div>
        @endif
    </div>
</section>

{{-- SCRIPTS --}}
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({
            duration: 1000,
            easing: 'ease-out-back',
            once: true
        });

        // Add magnetic effect to buttons
        const magneticBtns = document.querySelectorAll('.filter-btn, .program-card');
        magneticBtns.forEach(btn => {
            btn.addEventListener('mousemove', (e) => {
                const rect = btn.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                
                btn.style.transform = `translate(${x * 0.05}px, ${y * 0.05}px)`;
            });
            btn.addEventListener('mouseleave', () => {
                btn.style.transform = '';
            });
        });
    });
</script>
@endsection