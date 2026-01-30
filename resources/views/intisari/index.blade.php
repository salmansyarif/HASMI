@extends('layouts.app')

@section('title', 'Intisari HASMI - Artikel & Kajian Pilihan')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; overflow-x: hidden; }

    /* Hero Gradient Animation - Disamakan dengan Program */
    .hero-animate {
        background: linear-gradient(-45deg, #1e3a8a, #1e40af, #1e3a8a, #0f172a);
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
        border: 1px solid rgba(226, 232, 240, 0.8);
    }
    .article-card:hover {
        transform: translateY(-12px) scale(1.02);
        box-shadow: 0 25px 50px -12px rgba(37, 99, 235, 0.15);
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
<section class="relative min-h-[50vh] flex items-center overflow-hidden hero-animate">
    <div class="absolute inset-0 islamic-pattern"></div>
    
    {{-- Animated Shapes --}}
    <div class="absolute top-10 left-10 w-32 h-32 bg-blue-400/20 rounded-full blur-3xl shape-float"></div>
    <div class="absolute bottom-10 right-10 w-48 h-48 bg-cyan-400/20 rounded-full blur-3xl shape-float" style="animation-delay: 2s"></div>

    <div class="container mx-auto px-6 relative z-10 py-24 text-center">
        <div class="inline-flex items-center gap-2 px-4 py-2 bg-white/10 backdrop-blur-md rounded-full border border-white/20 mb-8" data-aos="zoom-in">
            <span class="relative flex h-3 w-3">
                <span class="animate-ping absolute inline-flex h-full w-full rounded-full bg-cyan-400 opacity-75"></span>
                <span class="relative inline-flex rounded-full h-3 w-3 bg-cyan-500"></span>
            </span>
            <span class="text-white text-xs font-bold uppercase tracking-widest">Khazanah Pemikiran Islam</span>
        </div>
        
        <h1 class="text-5xl lg:text-7xl font-extrabold text-white mb-8 tracking-tight" data-aos="fade-up" data-aos-delay="200">
            Intisari <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-300 to-cyan-200">Kajian</span> & Hikmah
        </h1>
        
        <p class="text-xl text-blue-100/80 max-w-2xl mx-auto mb-10 leading-relaxed font-light" data-aos="fade-up" data-aos-delay="400">
            "Menyajikan ringkasan ilmu, hikmah, dan kajian pilihan untuk mencerahkan hati dan pikiran umat."
        </p>

        <div class="flex justify-center gap-4" data-aos="fade-up" data-aos-delay="600">
            <div class="w-20 h-1.5 bg-cyan-400 rounded-full"></div>
            <div class="w-8 h-1.5 bg-white/30 rounded-full"></div>
            <div class="w-8 h-1.5 bg-white/30 rounded-full"></div>
        </div>
    </div>

    {{-- Wave Divider --}}
    <div class="absolute bottom-0 left-0 right-0">
        <svg viewBox="0 0 1440 120" fill="none" xmlns="http://www.w3.org/2000/svg" class="w-full">
            <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z" fill="#f8fafc"/>
        </svg>
    </div>
</section>

{{-- MAIN CONTENT --}}
<section class="py-20 bg-slate-50 relative overflow-hidden">
    {{-- Decorative Background Elements --}}
    <div class="absolute top-1/4 -right-20 w-96 h-96 bg-blue-100 rounded-full blur-[100px] opacity-50"></div>
    <div class="absolute bottom-1/4 -left-20 w-96 h-96 bg-cyan-100 rounded-full blur-[100px] opacity-50"></div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        @if($intisaris->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
                @foreach($intisaris as $index => $intisari)
                <article class="article-card group bg-white rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                         data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                    
                    {{-- Thumbnail with Glow --}}
                    <div class="h-64 relative overflow-hidden m-4 rounded-[2rem]">
                        @if($intisari->thumbnail)
                            <img src="{{ asset($intisari->thumbnail) }}" 
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                                 alt="{{ $intisari->title }}"
                                 loading="lazy">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-600 to-indigo-800 flex items-center justify-center">
                                <i class="fas fa-book-open text-white/20 text-6xl"></i>
                            </div>
                        @endif
                        
                        {{-- Overlay Info --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                            <p class="text-white text-xs leading-relaxed italic">
                                "Klik untuk membaca selengkapnya artikel bermanfaat ini."
                            </p>
                        </div>

                        {{-- Floating Badges --}}
                        <div class="absolute top-4 left-4 flex flex-col gap-2">
                            <span class="px-4 py-2 bg-blue-600 text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg border border-white/20">
                                Kajian Pilihan
                            </span>
                        </div>
                    </div>

                    {{-- Card Content --}}
                    <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                        <div class="flex items-center gap-2 mb-3">
                            <i class="far fa-calendar-alt text-blue-500 text-xs"></i>
                            <span class="text-slate-400 text-[11px] font-bold uppercase tracking-wider">
                                {{ $intisari->published_at ? $intisari->published_at->locale('id')->isoFormat('D MMMM Y') : 'Baru' }}
                            </span>
                        </div>

                        <h3 class="text-2xl font-bold text-slate-800 mb-4 line-clamp-2 group-hover:text-blue-600 transition-colors leading-tight">
                            {{ $intisari->title }}
                        </h3>
                        
                        <p class="text-slate-500 text-sm leading-relaxed mb-8 line-clamp-3 font-medium">
                            {{ $intisari->excerpt }}
                        </p>
                        
                        <div class="mt-auto">
                            <a href="{{ route('intisari.show', $intisari->slug) }}" 
                               class="w-full py-4 bg-slate-900 group-hover:bg-blue-600 text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition-all transform active:scale-95 shadow-xl shadow-slate-200">
                                <span>Baca Selengkapnya</span>
                                <i class="fas fa-arrow-right text-sm group-hover:translate-x-2 transition-transform"></i>
                            </a>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($intisaris->hasPages())
            <div class="mt-20" data-aos="fade-up">
                <div class="flex justify-center bg-white p-4 rounded-3xl shadow-sm border border-slate-100 w-fit mx-auto">
                    {{ $intisaris->links('vendor.pagination.tailwind') }}
                </div>
            </div>
            @endif

        @else
            <div class="text-center py-20" data-aos="zoom-in">
                <div class="relative w-48 h-48 mx-auto mb-10">
                    <div class="absolute inset-0 bg-blue-100 rounded-full animate-ping opacity-20"></div>
                    <div class="relative w-48 h-48 bg-white rounded-full flex items-center justify-center shadow-2xl border border-slate-100">
                        <i class="fas fa-book-reader text-blue-400 text-7xl"></i>
                    </div>
                </div>
                <h3 class="text-3xl font-bold text-slate-800 mb-4">Intisari Belum Tersedia</h3>
                <p class="text-slate-500 max-w-md mx-auto mb-10">Tim redaksi sedang menyiapkan konten bermanfaat untuk mencerahkan hari Anda. Silakan kembali lagi nanti.</p>
                <a href="{{ route('home') }}" class="px-10 py-4 bg-blue-600 text-white rounded-2xl font-bold shadow-xl hover:bg-blue-700 transition-all">Kembali ke Beranda</a>
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

        // Magnetic effect (Persis seperti di Program)
        const magneticElements = document.querySelectorAll('.article-card, a.bg-blue-600');
        magneticElements.forEach(el => {
            el.addEventListener('mousemove', (e) => {
                const rect = el.getBoundingClientRect();
                const x = e.clientX - rect.left - rect.width / 2;
                const y = e.clientY - rect.top - rect.height / 2;
                el.style.transform = `translate(${x * 0.05}px, ${y * 0.05}px)`;
            });
            el.addEventListener('mouseleave', () => {
                el.style.transform = '';
            });
        });
    });
</script>
@endsection