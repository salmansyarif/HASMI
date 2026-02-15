@extends('layouts.app')

@section('title', 'HASMI - Membangun Peradaban Islami')

@section('content')
    {{-- INTRO VIDEO OVERLAY --}}
    <div id="intro-overlay"
        class="fixed inset-0 z-[9999] bg-gradient-to-br from-blue-700 to-blue-900 flex items-center justify-center p-4 transition-all duration-700">
        <div class="relative w-full max-w-6xl aspect-video bg-gradient-to-br from-blue-600 to-blue-800 rounded-3xl overflow-hidden shadow-2xl border-2 border-blue-500/40">
            <button onclick="closeIntro()"
                class="absolute top-4 right-4 z-50 bg-red-600 hover:bg-red-700 text-white px-3 py-1.5 md:px-6 md:py-3 rounded-full font-bold transition-all duration-300 flex items-center gap-2">
                <span class="text-xs md:text-base">Tutup Video</span>
                <i class="fas fa-times text-xs md:text-base"></i>
            </button>
            <x-lite-youtube videoId="ykIhoH0FlD8" title="Intro HASMI" class="w-full h-full" />
        </div>
    </div>

    <script data-cfasync="false">
        function closeIntro() {
            const overlay = document.getElementById('intro-overlay');
            const frame = document.querySelector('.lite-youtube-embed iframe');
            overlay.classList.add('opacity-0', 'pointer-events-none');
            setTimeout(() => {
                if (frame) frame.src = '';
                overlay.style.display = 'none';
            }, 700);
        }
    </script>


    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <style>
        .swiper-slide {
            opacity: 0 !important;
            transition: opacity 0.5s ease-in-out;
        }
        .swiper-slide-active {
            opacity: 1 !important;
            z-index: 10;
        }
    </style>
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    {{-- ===== HERO SECTION ===== --}}
    <section class="hero-section relative overflow-hidden bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800">

        {{-- Background decorations desktop only --}}
        <div class="absolute inset-0 pointer-events-none hidden lg:block">
            <div class="floating-orb orb-1"></div>
            <div class="floating-orb orb-2"></div>
            <div class="floating-orb orb-3"></div>
        </div>

        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="grid lg:grid-cols-2 gap-6 lg:gap-16 items-center">

                {{-- ===== LEFT: Content ===== --}}
                <div class="hero-left pt-24 pb-6 lg:pt-0 lg:pb-0 lg:py-32">

                    {{-- Logo Badge --}}
                    <div class="inline-flex items-center gap-3 bg-white/10 backdrop-blur-md px-4 py-2 rounded-full border border-white/20 mb-5 lg:mb-8">
                        <div class="w-9 h-9 lg:w-12 lg:h-12 bg-white rounded-full flex items-center justify-center flex-shrink-0">
                            <img src="{{ asset('img/hasmilogo.png') }}" alt="Logo HASMI" class="w-6 h-6 lg:w-8 lg:h-8 object-contain">
                        </div>
                        <span class="text-lg lg:text-2xl font-bold text-white tracking-wide">HASMI</span>
                    </div>

                    {{-- Heading --}}
                    <h1 class="text-4xl sm:text-5xl lg:text-7xl font-black leading-[1.1] mb-4 lg:mb-6">
                        <span class="block text-white">Membangun</span>
                        <span class="block text-blue-200">Peradaban Islami</span>
                    </h1>

                    {{-- Description --}}
                    <p class="text-sm sm:text-base lg:text-xl text-blue-100 leading-relaxed max-w-lg mb-6 lg:mb-8">
                        Himpunan Aktivis Siswa Muslim Indonesia berkomitmen membina generasi muslim melalui pendidikan,
                        dakwah, dan aksi sosial berkelanjutan untuk kemajuan umat.
                    </p>

                    {{-- CTA Buttons --}}
                    <div class="flex flex-wrap gap-3 mb-8 lg:mb-12">
                        <a href="{{ route('materi.index') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 lg:px-8 lg:py-4 bg-white text-blue-700 rounded-xl font-bold shadow-lg hover:shadow-xl hover:scale-105 transition-all duration-300 text-sm lg:text-base">
                            <span>Jelajahi Materi</span>
                            <i class="fas fa-arrow-right text-xs"></i>
                        </a>
                        <a href="{{ route('tentang') }}"
                            class="inline-flex items-center gap-2 px-6 py-3 lg:px-8 lg:py-4 bg-white/10 text-white rounded-xl font-bold border border-white/30 hover:bg-white/20 hover:scale-105 transition-all duration-300 text-sm lg:text-base">
                            <span>Tentang Kami</span>
                        </a>
                    </div>

                    {{-- ===== STATS ===== --}}
                    <div class="stats-grid grid grid-cols-2 lg:grid-cols-4 gap-3 sm:gap-6">
                        <div class="text-center min-w-[80px]">
                            <div class="text-2xl sm:text-3xl lg:text-5xl font-black text-white stats-counter leading-none mb-1"
                                data-target="{{ $materiCount }}">0</div>
                            <div class="text-[10px] sm:text-xs lg:text-sm text-blue-200 font-semibold uppercase tracking-wide">Materi</div>
                        </div>
                        <div class="text-center min-w-[80px]">
                            <div class="text-2xl sm:text-3xl lg:text-5xl font-black text-white stats-counter leading-none mb-1"
                                data-target="{{ $programCount }}">0</div>
                            <div class="text-[10px] sm:text-xs lg:text-sm text-blue-200 font-semibold uppercase tracking-wide">Program</div>
                        </div>
                        <div class="text-center min-w-[80px]">
                            <div class="text-2xl sm:text-3xl lg:text-5xl font-black text-white stats-counter leading-none mb-1"
                                data-target="{{ $intisariCount }}">0</div>
                            <div class="text-[10px] sm:text-xs lg:text-sm text-blue-200 font-semibold uppercase tracking-wide">Intisari</div>
                        </div>
                        <div class="text-center min-w-[80px]">
                            <div class="text-2xl sm:text-3xl lg:text-5xl font-black text-white stats-counter leading-none mb-1"
                                data-target="{{ $kegiatanCount }}">0</div>
                            <div class="text-[10px] sm:text-xs lg:text-sm text-blue-200 font-semibold uppercase tracking-wide">Kegiatan</div>
                        </div>
                    </div>
                </div>

                {{-- ===== RIGHT: Slider ===== --}}
                <div class="hero-right pb-8 lg:py-12">

                    {{-- Slider Container --}}
                    {{-- Scrollable List Container --}}
                    {{-- Slider Container (IG Story Style) --}}
                    <div class="slider-wrapper relative rounded-2xl lg:rounded-3xl overflow-hidden border-2 border-white/20 shadow-2xl bg-blue-800"
                         style="height: 380px; min-height: 380px;">

                        {{-- Story Progress Bars --}}
                        <div class="absolute top-3 left-3 right-3 z-30 flex gap-1.5">
                            @foreach ($latestUpdates as $index => $update)
                                @if ($index < 10)
                                    <div class="h-1 lg:h-1.5 flex-1 bg-white/30 rounded-full overflow-hidden">
                                        <div class="story-progress-bar h-full bg-white w-0" id="progress-{{ $index }}"></div>
                                    </div>
                                @endif
                            @endforeach
                        </div>

                        {{-- Swiper --}}
                        <div class="swiper hero-swiper w-full h-full">
                            <div class="swiper-wrapper">
                                @foreach ($latestUpdates as $index => $update)
                                    <div class="swiper-slide relative w-full h-full overflow-hidden" data-swiper-autoplay="5000">

                                        {{-- BG Image --}}
                                        @php
                                            $bgImage = $update->thumbnail ?? ($update->cover ?? ($update->photos[0] ?? null));
                                            $bgUrl = null;
                                            if ($bgImage) {
                                                if (filter_var($bgImage, FILTER_VALIDATE_URL)) {
                                                    $bgUrl = $bgImage;
                                                } elseif (\Illuminate\Support\Str::startsWith($bgImage, 'storage/')) {
                                                    $bgUrl = asset($bgImage);
                                                } else {
                                                    $bgUrl = asset('storage/' . $bgImage);
                                                }
                                            }
                                        @endphp

                                        @if ($bgUrl)
                                            <div class="absolute inset-0" style="background: url('{{ $bgUrl }}') center/cover no-repeat;"></div>
                                        @else
                                            <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                                                <i class="fas fa-image text-white/10 text-6xl"></i>
                                            </div>
                                        @endif

                                        {{-- Dark gradient overlay --}}
                                        <div class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/40 to-transparent"></div>

                                        {{-- Slide Content --}}
                                        <div class="absolute inset-0 flex flex-col justify-between p-5 lg:p-8 pt-12 lg:pt-16">
                                            
                                            {{-- Top: Type + Date --}}
                                            <div class="flex items-start justify-between">
                                                <span class="inline-block px-3 py-1 bg-blue-600/90 text-white text-[10px] lg:text-xs font-bold uppercase tracking-widest rounded-lg border border-white/10 shadow-lg backdrop-blur-sm">
                                                    {{ $update->type }}
                                                </span>
                                                <div class="text-right bg-black/40 backdrop-blur-md px-3 py-1.5 rounded-lg border border-white/5">
                                                    <div class="text-white font-bold text-xs lg:text-sm leading-tight">
                                                        {{ $update->date ? \Carbon\Carbon::parse($update->date)->format('d M Y') : '' }}
                                                    </div>
                                                    <div class="text-blue-200 text-[10px] lg:text-xs">
                                                        {{ $update->date ? \Carbon\Carbon::parse($update->date)->diffForHumans() : '' }}
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Bottom: Content --}}
                                            <div class="space-y-3">
                                                @if (isset($update->category))
                                                    <p class="text-blue-300 text-xs font-bold uppercase tracking-wider flex items-center gap-2">
                                                        <i class="fas fa-hashtag text-[10px]"></i>
                                                        {{ $update->category->name }}
                                                    </p>
                                                @endif

                                                <h2 class="text-xl sm:text-2xl lg:text-3xl font-bold text-white leading-tight line-clamp-2 drop-shadow-lg">
                                                    {{ $update->title ?? $update->judul }}
                                                </h2>

                                                <p class="text-gray-200 text-xs sm:text-sm lg:text-base line-clamp-2 leading-relaxed drop-shadow-md">
                                                    {{ \Illuminate\Support\Str::limit(strip_tags($update->excerpt ?? ($update->description ?? ($update->content ?? ''))), 100) }}
                                                </p>

                                                <div class="pt-2">
                                                    <a href="{{ route($update->route_name, $update->route_params) }}"
                                                        class="inline-flex items-center gap-2 px-5 py-2.5 bg-white text-blue-800 rounded-full font-bold transition-all hover:bg-blue-50 hover:scale-105 shadow-lg text-xs sm:text-sm">
                                                        <span>Baca Selengkapnya</span>
                                                        <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

            </div>{{-- end grid --}}
        </div>{{-- end container --}}
    </section>

    {{-- Swiper & Slider JS --}}
    <script data-cfasync="false" src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script data-cfasync="false">
    document.addEventListener('DOMContentLoaded', function() {
        // IG Story Logic
        const AUTOPLAY_MS = 5000;
        let swiper;
        const progressBars = document.querySelectorAll('.story-progress-bar');
        
        function updateStoryProgress(activeIndex) {
            progressBars.forEach((bar, index) => {
                bar.style.transition = 'none';
                
                if (index < activeIndex) {
                    // Previous bars: Full
                    bar.style.width = '100%';
                } else if (index === activeIndex) {
                    // Current bar: Animate from 0 to 100%
                    bar.style.width = '0%';
                    // Force reflow
                    void bar.offsetWidth;
                    bar.style.transition = `width ${AUTOPLAY_MS}ms linear`;
                    bar.style.width = '100%';
                } else {
                    // Next bars: Empty
                    bar.style.width = '0%';
                }
            });
        }

        swiper = new Swiper('.hero-swiper', {
            // Use 'fade' for better text readability, or 'slide' if preferred
            effect: 'fade', 
            fadeEffect: { crossFade: true },
            speed: 500,
            loop: true, // Infinite loop
            autoplay: {
                delay: AUTOPLAY_MS,
                disableOnInteraction: false,
            },
            allowTouchMove: true,
            on: {
                slideChangeTransitionStart: function() {
                    console.log('Slide Change:', this.realIndex);
                    updateStoryProgress(this.realIndex);
                },
                init: function() {
                    console.log('Swiper Init');
                    updateStoryProgress(0);
                }
            }
        });
    });
    </script>

    {{-- ===== ABOUT SECTION ===== --}}
    <section class="py-16 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="grid lg:grid-cols-2 gap-10 lg:gap-20 items-center">

                <div data-aos="fade-right" data-aos-duration="1000">
                    <div class="aspect-video rounded-2xl lg:rounded-3xl overflow-hidden shadow-xl border-2 border-white/20 bg-blue-800">
                        <x-lite-youtube videoId="ovpPnlSwpe4" title="Profil HASMI" class="w-full h-full" />
                    </div>
                </div>

                <div class="space-y-5 lg:space-y-7" data-aos="fade-left" data-aos-duration="1000">
                    <span class="inline-block px-4 py-2 lg:px-6 lg:py-3 bg-white/10 text-white rounded-full text-xs lg:text-sm font-bold uppercase tracking-wider border border-white/20">Tentang Kami</span>

                    <h2 class="text-2xl sm:text-3xl lg:text-5xl font-bold text-white leading-tight">
                        Himpunan Aktivis Siswa Muslim Indonesia
                    </h2>

                    <div class="w-16 lg:w-24 h-1 lg:h-1.5 bg-blue-300 rounded-full"></div>

                    <div class="space-y-3 text-blue-100 text-sm sm:text-base lg:text-lg leading-relaxed">
                        <p>HASMI adalah organisasi pendidikan, dakwah, dan sosial yang berfokus membina generasi muda muslim Indonesia dengan pendekatan komprehensif dan berkelanjutan.</p>
                        <p>Melalui berbagai program unggulan, kami membentuk karakter Islami yang kuat, berilmu, dan berkontribusi nyata bagi kemajuan umat dan bangsa.</p>
                    </div>

                    <div class="grid sm:grid-cols-2 gap-4 pt-2">
                        <div class="flex items-start gap-3 bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-sm mb-0.5">Pendidikan Berkualitas</h4>
                                <p class="text-xs text-blue-200 leading-relaxed">Program pembelajaran terpadu untuk membentuk karakter islami.</p>
                            </div>
                        </div>
                        <div class="flex items-start gap-3 bg-white/10 backdrop-blur-md p-4 rounded-xl border border-white/20">
                            <div class="w-10 h-10 bg-blue-500 rounded-lg flex items-center justify-center flex-shrink-0">
                                <i class="fas fa-check text-white text-sm"></i>
                            </div>
                            <div>
                                <h4 class="font-bold text-white text-sm mb-0.5">Dakwah Aktif</h4>
                                <p class="text-xs text-blue-200 leading-relaxed">Menyebarkan nilai-nilai Islam rahmatan lil 'alamin.</p>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('tentang') }}"
                        class="inline-flex items-center gap-3 px-6 py-3 lg:px-8 lg:py-4 bg-blue-500 text-white rounded-xl font-bold hover:bg-blue-400 hover:scale-105 transition-all duration-300 text-sm lg:text-base border border-blue-400/50">
                        <span>Selengkapnya</span>
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== VISI MISI ===== --}}
    <section class="py-16 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-10 lg:mb-20" data-aos="fade-up">
                <span class="inline-block px-4 py-2 lg:px-6 lg:py-3 bg-white/10 text-white rounded-full text-xs lg:text-sm font-bold uppercase tracking-wider border border-white/20 mb-4">Komitmen Kami</span>
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-bold text-white mb-3">Visi & Misi</h2>
                <div class="w-16 lg:w-24 h-1 bg-blue-300 rounded-full mx-auto"></div>
            </div>

            <div class="grid sm:grid-cols-2 gap-5 lg:gap-10 max-w-5xl mx-auto">
                <div class="group bg-white/10 backdrop-blur-xl rounded-2xl lg:rounded-3xl p-6 lg:p-10 border border-white/20 hover:bg-white/15 transition-all duration-500" data-aos="fade-up" data-aos-delay="200">
                    <div class="w-12 h-12 lg:w-16 lg:h-16 bg-blue-500 rounded-xl flex items-center justify-center mb-4 lg:mb-6">
                        <i class="fas fa-eye text-white text-lg lg:text-2xl"></i>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-white mb-3">Visi</h3>
                    <p class="text-blue-100 text-sm lg:text-base leading-relaxed">
                        Menjadi organisasi terdepan dalam pembinaan generasi muslim yang berakhlak mulia, berilmu, dan bermanfaat bagi umat dan bangsa.
                    </p>
                </div>

                <div class="group bg-white/10 backdrop-blur-xl rounded-2xl lg:rounded-3xl p-6 lg:p-10 border border-white/20 hover:bg-white/15 transition-all duration-500" data-aos="fade-up" data-aos-delay="400">
                    <div class="w-12 h-12 lg:w-16 lg:h-16 bg-blue-500 rounded-xl flex items-center justify-center mb-4 lg:mb-6">
                        <i class="fas fa-bullseye text-white text-lg lg:text-2xl"></i>
                    </div>
                    <h3 class="text-xl lg:text-2xl font-bold text-white mb-3">Misi</h3>
                    <p class="text-blue-100 text-sm lg:text-base leading-relaxed">
                        Menyelenggarakan program pendidikan, dakwah, dan sosial secara komprehensif dan berkelanjutan untuk kemajuan peradaban Islam.
                    </p>
                </div>
            </div>
        </div>
    </section>

    {{-- ===== PROGRAM UNGGULAN ===== --}}
    <section class="py-16 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-10 lg:mb-20" data-aos="fade-up">
                <span class="inline-block px-4 py-2 bg-white/10 text-white rounded-full text-xs font-bold uppercase tracking-wider border border-white/20 mb-4">Program Kami</span>
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-bold text-white mb-3">Program Unggulan</h2>
                <p class="text-blue-200 text-sm lg:text-base max-w-xl mx-auto">Berbagai program terbaik untuk pembinaan generasi muslim Indonesia</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-8 mb-10">
                @foreach ($homePrograms as $index => $p)
                    <article class="card-item group rounded-2xl overflow-hidden flex flex-col h-full bg-blue-600/50 border border-white/20 hover:border-white/40 transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="relative overflow-hidden" style="height: 200px;">
                            @if ($p->thumbnail)
                                <img src="{{ asset('storage/' . $p->thumbnail) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    alt="{{ $p->title }}" loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-800 flex items-center justify-center">
                                    <i class="fas fa-hand-holding-heart text-white/20 text-5xl"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 bg-blue-500 text-white text-[9px] font-bold uppercase tracking-wider rounded-lg border border-blue-400/40">
                                    {{ $p->category->name ?? 'Program' }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-base font-bold text-white mb-2 line-clamp-2 group-hover:text-blue-100 transition-colors">
                                {{ $p->title }}
                            </h3>
                            <p class="text-blue-200 text-xs leading-relaxed mb-4 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($p->description), 100) }}
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('program.show', $p->slug) }}"
                                    class="w-full py-3 bg-blue-500 hover:bg-blue-400 text-white rounded-xl font-bold flex items-center justify-center gap-2 transition-all text-sm border border-blue-400/40">
                                    <span>Lihat Program</span>
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center">
                <a href="{{ route('program.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 text-white rounded-full border border-white/30 hover:bg-white/20 transition-all text-sm font-bold">
                    <span>Lihat Semua Program</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ===== MATERI PEMBELAJARAN ===== --}}
    <section class="py-16 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12">
            <div class="text-center mb-10 lg:mb-20" data-aos="fade-up">
                <span class="inline-block px-4 py-2 bg-white/10 text-white rounded-full text-xs font-bold uppercase tracking-wider border border-white/20 mb-4">Pembelajaran</span>
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-bold text-white mb-3">Materi Terbaru</h2>
                <p class="text-blue-200 text-sm lg:text-base max-w-xl mx-auto">Artikel dan materi pembelajaran untuk pemahaman agama yang lebih baik</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-8">
                @foreach ($homeArticles as $index => $article)
                    <article class="card-item group rounded-2xl overflow-hidden flex flex-col h-full bg-blue-600/50 border border-white/20 hover:border-white/40 transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="relative overflow-hidden" style="height: 200px;">
                            @if ($article->thumbnail)
                                <img src="{{ asset($article->thumbnail) }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    alt="{{ $article->title }}" loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-800 flex items-center justify-center">
                                    <i class="fas fa-book-open text-white/20 text-5xl"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 bg-blue-500 text-white text-[9px] font-bold uppercase tracking-wider rounded-lg border border-blue-400/40">
                                    {{ $article->category->name }}
                                </span>
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <h3 class="text-base font-bold text-white mb-2 line-clamp-2 group-hover:text-blue-100 transition-colors">
                                {{ $article->title }}
                            </h3>
                            <p class="text-blue-200 text-xs leading-relaxed mb-4 line-clamp-3">
                                {{ \Illuminate\Support\Str::limit(strip_tags($article->content ?? $article->excerpt), 100) }}
                            </p>
                            <div class="mt-auto">
                                <a href="{{ route('materi.detail', [$article->category->slug, $article->slug]) }}"
                                    class="w-full py-3 bg-blue-500 hover:bg-blue-400 text-white rounded-xl font-bold flex items-center justify-center gap-2 transition-all text-sm border border-blue-400/40">
                                    <span>Baca Materi</span>
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('materi.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-blue-500 text-white rounded-xl font-bold hover:bg-blue-400 transition-all text-sm border border-blue-400/40">
                    <span>Lihat Semua Materi</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ===== INTISARI SECTION ===== --}}
    <section class="py-16 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-10 lg:mb-20" data-aos="fade-up">
                <span class="inline-block px-4 py-2 bg-white/10 text-white rounded-full text-xs font-bold uppercase tracking-wider border border-white/20 mb-4">Publikasi</span>
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-bold text-white mb-3">Intisari HASMI</h2>
                <p class="text-blue-200 text-sm lg:text-base max-w-xl mx-auto">Kumpulan materi dan ringkasan pembelajaran dalam bentuk publikasi</p>
            </div>

            <div class="grid grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8">
                @foreach ($homeIntisari as $index => $i)
                    <article class="card-item group rounded-2xl overflow-hidden flex flex-col h-full bg-blue-600/50 border border-white/20 hover:border-white/40 transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="relative overflow-hidden" style="height: 160px;">
                            @if ($i->thumbnail_url)
                                <img src="{{ $i->thumbnail_url }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    alt="{{ $i->title }}" loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-800 flex items-center justify-center">
                                    <i class="fas fa-image text-white/20 text-4xl"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute top-2.5 left-2.5">
                                <span class="px-2 py-1 bg-blue-500 text-white text-[8px] font-bold uppercase tracking-wider rounded-md border border-blue-400/40">
                                    Intisari
                                </span>
                            </div>
                        </div>
                        <div class="p-3 sm:p-4 flex flex-col flex-grow">
                            <h3 class="text-xs sm:text-sm font-bold text-white mb-2 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                                {{ $i->title }}
                            </h3>
                            <div class="mt-auto">
                                <a href="{{ route('intisari.show', $i->slug) }}"
                                    class="w-full py-2 sm:py-2.5 bg-blue-500 hover:bg-blue-400 text-white rounded-lg font-bold flex items-center justify-center gap-1.5 transition-all text-xs border border-blue-400/40">
                                    <span>Baca</span>
                                    <i class="fas fa-arrow-right text-[10px]"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('intisari.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-white/10 text-white rounded-full border border-white/30 hover:bg-white/20 transition-all text-sm font-bold">
                    <span>Lihat Semua Intisari</span>
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ===== KEGIATAN ===== --}}
    <section class="py-16 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800" id="kegiatan">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-10 lg:mb-20" data-aos="fade-up">
                <span class="inline-block px-4 py-2 bg-white/10 text-white rounded-full text-xs font-bold uppercase tracking-wider border border-white/20 mb-4">Aktivitas</span>
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-bold text-white mb-3">Kegiatan HASMI</h2>
                <p class="text-blue-200 text-sm lg:text-base max-w-xl mx-auto">Dokumentasi kegiatan dan agenda dakwah terbaru</p>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5 lg:gap-8">
                @foreach ($homeKegiatan as $index => $k)
                    <article class="card-item group rounded-2xl overflow-hidden flex flex-col h-full bg-blue-600/50 border border-white/20 hover:border-white/40 transition-all duration-300"
                        data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                        <div class="relative overflow-hidden" style="height: 200px;">
                            @if ($k->thumbnail_url)
                                <img src="{{ $k->thumbnail_url }}"
                                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                                    alt="{{ $k->title }}" loading="lazy">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-800 flex items-center justify-center">
                                    <i class="fas fa-camera text-white/20 text-5xl"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent"></div>
                            <div class="absolute top-3 left-3">
                                <span class="px-2.5 py-1 bg-blue-500 text-white text-[9px] font-bold uppercase tracking-wider rounded-lg border border-blue-400/40">
                                    Kegiatan
                                </span>
                            </div>
                        </div>
                        <div class="p-5 flex flex-col flex-grow">
                            <div class="flex items-center gap-1.5 mb-2">
                                <i class="far fa-calendar-alt text-blue-300 text-xs"></i>
                                <span class="text-blue-300 text-[10px] font-semibold">
                                    {{ $k->event_date ? \Carbon\Carbon::parse($k->event_date)->isoFormat('D MMM Y') : \Carbon\Carbon::parse($k->created_at)->isoFormat('D MMM Y') }}
                                </span>
                            </div>
                            <h3 class="text-base font-bold text-white mb-3 line-clamp-2 group-hover:text-blue-100 transition-colors">
                                {{ $k->title }}
                            </h3>
                            <div class="mt-auto">
                                <a href="{{ route('kegiatan.show', $k->slug) }}"
                                    class="w-full py-3 bg-blue-500 hover:bg-blue-400 text-white rounded-xl font-bold flex items-center justify-center gap-2 transition-all text-sm border border-blue-400/40">
                                    <span>Lihat Dokumentasi</span>
                                    <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                    </article>
                @endforeach
            </div>

            <div class="text-center mt-10">
                <a href="{{ route('kegiatan.index') }}"
                    class="inline-flex items-center gap-2 px-6 py-3 bg-blue-500 text-white rounded-xl font-bold hover:bg-blue-400 transition-all text-sm border border-blue-400/40">
                    <span>Galeri Kegiatan</span>
                    <i class="fas fa-images"></i>
                </a>
            </div>
        </div>
    </section>

    {{-- ===== LAYANAN KAMI ===== --}}
    <section class="py-16 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800">
        <div class="container mx-auto px-4 sm:px-6 lg:px-12 relative z-10">
            <div class="text-center mb-10 lg:mb-16" data-aos="fade-up">
                <span class="inline-block px-4 py-2 bg-white/10 text-white rounded-full text-xs font-bold uppercase tracking-wider border border-white/20 mb-4">Layanan Kami</span>
                <h2 class="text-2xl sm:text-3xl lg:text-5xl font-bold text-white">Kontribusi Untuk Umat</h2>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-3 gap-5 lg:gap-8 max-w-5xl mx-auto">
                @php
                $layanan = [
                    ['url' => 'https://donasi.hasmi.org/', 'icon' => 'fa-hand-holding-heart', 'title' => 'Donasi', 'desc' => 'Salurkan donasi terbaik Anda untuk kemajuan dakwah dan pendidikan Islam', 'delay' => 100],
                    ['url' => 'https://beasiswapendidikanislam.com/', 'icon' => 'fa-user-graduate', 'title' => 'Beasiswa', 'desc' => 'Program beasiswa pendidikan Islam untuk mencetak kader dai berkualitas', 'delay' => 200],
                    ['url' => 'https://hasmipeduli.org/', 'icon' => 'fa-hands-helping', 'title' => 'Sosial', 'desc' => 'Aksi sosial dan kemanusiaan untuk membantu sesama yang membutuhkan', 'delay' => 300],
                ];
                @endphp

                @foreach ($layanan as $l)
                <a href="{{ $l['url'] }}" target="_blank"
                    class="group flex sm:flex-col items-center sm:items-center gap-4 sm:gap-0 sm:text-center bg-white/10 rounded-2xl p-5 sm:p-8 border border-white/20 hover:bg-white/20 hover:border-white/40 transition-all duration-300"
                    data-aos="fade-up" data-aos-delay="{{ $l['delay'] }}">
                    <div class="w-14 h-14 sm:w-16 sm:h-16 lg:w-20 lg:h-20 bg-blue-500 rounded-2xl flex items-center justify-center flex-shrink-0 sm:mx-auto sm:mb-4 lg:mb-6 group-hover:scale-110 transition-transform duration-300 border border-blue-400/40">
                        <i class="fas {{ $l['icon'] }} text-xl lg:text-3xl text-white"></i>
                    </div>
                    <div>
                        <h3 class="text-lg lg:text-2xl font-bold text-white mb-1 sm:mb-2">{{ $l['title'] }}</h3>
                        <p class="text-blue-200 text-xs lg:text-sm leading-relaxed">{{ $l['desc'] }}</p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </section>

@endsection

@section('styles')
<style>
/* ===== GLOBAL ===== */
* { scroll-behavior: smooth; box-sizing: border-box; }
body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
    background: #1d4ed8;
    overflow-x: hidden;
}

/* ===== HERO ===== */
.hero-section {
    min-height: 100svh;
    display: flex;
    align-items: center;
}
@media (max-width: 1023px) {
    .hero-section {
        min-height: auto;
        padding-bottom: 2rem;
    }
    .hero-left {
        padding-top: 5.5rem;
        padding-bottom: 1.5rem;
    }
    .hero-right {
        padding-bottom: 2rem;
    }
}

/* ===== SLIDER ===== */
.slider-wrapper {
    position: relative;
    width: 100%;
}
@media (min-width: 1024px) {
    .slider-wrapper { height: 600px !important; }
}

.hero-swiper,
.hero-swiper .swiper-wrapper,
.hero-swiper .swiper-slide {
    width: 100% !important;
    height: 100% !important;
    position: absolute !important;
    top: 0; left: 0;
}
.hero-swiper {
    position: absolute !important;
    inset: 0;
    overflow: hidden;
}
.hero-swiper .swiper-wrapper {
    display: flex;
}
.hero-swiper .swiper-slide {
    position: absolute !important;
    flex-shrink: 0;
    overflow: hidden;
}

/* ===== CARDS ===== */
/* Mobile: hanya transition ringan, tanpa transform */
.card-item {
    transition: box-shadow 0.25s ease;
}
/* Desktop hover dengan transform hanya untuk perangkat yang support hover */
@media (hover: hover) and (pointer: fine) {
    .card-item {
        transition: transform 0.25s ease, box-shadow 0.25s ease;
        will-change: transform;
    }
    .card-item:hover {
        transform: translateY(-4px);
        box-shadow: 0 16px 40px rgba(0,0,0,0.3);
    }
}

/* ===== STATS ===== */
.stats-grid { width: 100%; }
.counter {
    display: block;
    font-variant-numeric: tabular-nums;
}

/* ===== FLOATING ORBS — HANYA DESKTOP ===== */
@media (min-width: 1024px) {
    .floating-orb {
        position: absolute;
        border-radius: 50%;
        /* Blur dikurangi 100px → 60px, opacity 0.4 → 0.25 */
        filter: blur(60px);
        opacity: 0.25;
        pointer-events: none;
    }
    .orb-1 {
        width: 400px; height: 400px;
        background: #60a5fa;
        top: -150px; left: -100px;
        animation: floatOrb 25s ease-in-out infinite;
    }
    .orb-2 {
        width: 320px; height: 320px;
        background: #3b82f6;
        bottom: -80px; right: 5%;
        animation: floatOrb 30s ease-in-out infinite reverse;
    }
    .orb-3 {
        width: 280px; height: 280px;
        background: #93c5fd;
        top: 30%; right: -80px;
        animation: floatOrb 22s ease-in-out infinite;
        animation-delay: -8s;
    }

    /* Gerak diperkecil dari 40px → 20px agar lebih ringan */
    @keyframes floatOrb {
        0%, 100% { transform: translate(0, 0); }
        50% { transform: translate(20px, -25px); }
    }
}

/* ===== SCROLLBAR ===== */
::-webkit-scrollbar { width: 10px; }
::-webkit-scrollbar-track { background: #1e40af; }
::-webkit-scrollbar-thumb { background: #3b82f6; border-radius: 5px; }
::-webkit-scrollbar-thumb:hover { background: #60a5fa; }

/* ===== LINE CLAMP ===== */
.line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.line-clamp-3 { display: -webkit-box; -webkit-line-clamp: 3; -webkit-box-orient: vertical; overflow: hidden; }

/* ===== REDUCE MOTION: hormati preferensi aksesibilitas ===== */
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
@endsection

@section('scripts')
<script data-cfasync="false" src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script data-cfasync="false">
document.addEventListener('DOMContentLoaded', function() {

    // Deteksi mobile
    const isMobile = window.innerWidth < 1024 ||
        /Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

    // ===== AOS: hanya aktif di desktop =====
    
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
    }    function animateCounter(el) {
        // Gunakan Number() agar lebih aman daripada parseInt
        const target = Number(el.getAttribute('data-target')) || 0;
        
        // Mobile: langsung tampilkan angka final
        if (isMobile) {
            el.innerHTML = target; // Pakai innerHTML untuk memastikan render
            return;
        }

        if (target === 0) { 
            el.textContent = '0'; 
            return; 
        }

        const duration = 1500;
        const steps = 50;
        const increment = target / steps;
        let current = 0;
        let step = 0;
        const timer = setInterval(() => {
            step++;
            current = Math.min(Math.ceil(increment * step), target);
            el.textContent = current;
            if (current >= target) clearInterval(timer);
        }, duration / steps);
    }

    const counters = document.querySelectorAll('.stats-counter');

    // FORCE RENDER UNTUK MOBILE SEGERA
    if (isMobile) {
        setTimeout(() => {
            counters.forEach(c => {
                const t = c.getAttribute('data-target');
                c.innerHTML = t;
            });
        }, 100);
    } else {
        const obs = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    obs.unobserve(entry.target);
                }
            });
        }, { threshold: 0.3 });

        counters.forEach(c => obs.observe(c));
    }

    // ===== SMOOTH SCROLL =====
    document.querySelectorAll('a[href^="#"]').forEach(a => {
        a.addEventListener('click', e => {
            const target = document.querySelector(a.getAttribute('href'));
            if (target) {
                e.preventDefault();
                // Mobile: pakai 'auto' agar lebih ringan
                target.scrollIntoView({ behavior: isMobile ? 'auto' : 'smooth' });
            }
        });
    });
});
</script>
@endsection