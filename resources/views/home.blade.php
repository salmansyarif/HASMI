@extends('layouts.app')

@section('title', 'HASMI - Membangun Peradaban Islami')

@section('content')
{{-- INTRO VIDEO OVERLAY --}}
<div id="intro-overlay" class="fixed inset-0 z-[9999] bg-gradient-to-br from-blue-700 to-blue-900 backdrop-blur-xl flex items-center justify-center p-4 transition-all duration-700">
    <div class="relative w-full max-w-6xl aspect-video bg-gradient-to-br from-blue-600 to-blue-800 rounded-3xl overflow-hidden shadow-[0_0_100px_rgba(59,130,246,0.6)] border-2 border-blue-500/40 ring-8 ring-blue-600/30 animate-border-pulse">
        <button onclick="closeIntro()" class="absolute top-6 right-6 z-50 bg-gradient-to-r from-red-600 to-red-700 hover:from-red-700 hover:to-red-800 text-white px-6 py-3 rounded-full font-bold shadow-[0_0_30px_rgba(239,68,68,0.5)] transition-all duration-300 hover:scale-110 hover:shadow-[0_0_50px_rgba(239,68,68,0.8)] flex items-center gap-3 group">
            <span class="text-base">Tutup Video</span>
            <i class="fas fa-times group-hover:rotate-180 transition-transform duration-500"></i>
        </button>
        <iframe id="intro-frame" 
                class="w-full h-full" 
                src="https://www.youtube.com/embed/ykIhoH0FlD8?autoplay=1&controls=1&rel=0&modestbranding=1" 
                title="Intro HASMI" 
                frameborder="0" 
                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                allowfullscreen>
        </iframe>
    </div>
</div>

<script>
    function closeIntro() {
        const overlay = document.getElementById('intro-overlay');
        const frame = document.getElementById('intro-frame');
        
        overlay.classList.add('opacity-0', 'pointer-events-none', 'scale-95');
        
        setTimeout(() => {
            frame.src = '';
            overlay.style.display = 'none';
        }, 700);
    }
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

{{-- HERO SECTION --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800">
    {{-- Animated Background Elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="islamic-pattern"></div>
        <div class="floating-orb orb-1"></div>
        <div class="floating-orb orb-2"></div>
        <div class="floating-orb orb-3"></div>
        <div class="floating-orb orb-4"></div>
        <div class="floating-orb orb-5"></div>
        
        {{-- Enhanced Animated Particles --}}
        <div class="particles">
            @for($i = 0; $i < 30; $i++)
                <div class="particle" style="--delay: {{ $i * 0.2 }}s; --duration: {{ 12 + ($i % 8) }}s; --size: {{ 3 + ($i % 4) }}px;"></div>
            @endfor
        </div>

        {{-- Light Rays --}}
        <div class="light-rays">
            @for($i = 0; $i < 5; $i++)
                <div class="light-ray" style="--ray-delay: {{ $i * 0.5 }}s;"></div>
            @endfor
        </div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Left Side: Content --}}
            <div class="space-y-8" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">
                <div class="inline-flex items-center gap-4 bg-blue-500/40 backdrop-blur-xl px-8 py-4 rounded-full shadow-[0_0_40px_rgba(59,130,246,0.4)] border-2 border-blue-400/40 hover:border-blue-300/60 transition-all duration-500 hover:shadow-[0_0_60px_rgba(59,130,246,0.6)] hover:scale-105"
                     data-aos="zoom-in" data-aos-delay="400">
                    <div class="w-14 h-14 bg-white rounded-full flex items-center justify-center shadow-[0_0_30px_rgba(59,130,246,0.6)] animate-pulse-glow">
                       <img src="{{ asset('img/hasmilogo.png') }}" alt="Logo HASMI" class="w-9 h-9 object-contain">
                    </div>
                    <span class="text-2xl font-bold text-white tracking-wide drop-shadow-[0_0_10px_rgba(191,219,254,0.5)]">HASMI</span>
                </div>

                <h1 class="text-6xl lg:text-8xl font-bold leading-tight">
                    <span class="block text-white mb-3 drop-shadow-[0_0_20px_rgba(191,219,254,0.4)] animate-text-glow" data-aos="fade-up" data-aos-delay="600">Membangun</span>
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-blue-100 to-blue-200 animate-gradient-flow drop-shadow-[0_0_30px_rgba(191,219,254,0.7)]"
                          data-aos="fade-up" data-aos-delay="800">
                        Peradaban Islami
                    </span>
                </h1>

                <p class="text-xl lg:text-2xl text-blue-100 leading-relaxed max-w-2xl drop-shadow-[0_2px_10px_rgba(0,0,0,0.3)]" 
                   data-aos="fade-up" data-aos-delay="1000">
                    Himpunan Aktivis Siswa Muslim Indonesia berkomitmen membina generasi muslim melalui pendidikan, dakwah, dan aksi sosial berkelanjutan untuk kemajuan umat.
                </p>

                <div class="flex flex-wrap gap-5 pt-6" data-aos="fade-up" data-aos-delay="1200">
                    <a href="{{ route('materi.index') }}" 
                       class="group px-10 py-5 bg-blue-500 text-white rounded-2xl font-bold shadow-[0_0_40px_rgba(59,130,246,0.5)] hover:shadow-[0_0_60px_rgba(59,130,246,0.7)] hover:scale-110 transition-all duration-500 flex items-center gap-3 relative overflow-hidden border-2 border-blue-400/40">
                        <div class="absolute inset-0 bg-gradient-to-r from-blue-400 to-blue-500 opacity-0 group-hover:opacity-100 transition-opacity duration-500"></div>
                        <span class="relative z-10 text-lg">Jelajahi Materi</span>
                        <i class="fas fa-arrow-right relative z-10 group-hover:translate-x-2 transition-transform duration-300"></i>
                    </a>
                    <a href="{{ route('tentang') }}" 
                       class="px-10 py-5 bg-blue-600/50 backdrop-blur-md text-white rounded-2xl font-bold shadow-[0_0_30px_rgba(59,130,246,0.4)] border-2 border-blue-400/60 hover:bg-blue-500/70 hover:border-blue-300 hover:scale-110 hover:shadow-[0_0_50px_rgba(59,130,246,0.6)] transition-all duration-500 text-lg">
                        Tentang Kami
                    </a>
                </div>

                {{-- Trust Indicators with Enhanced Animation --}}
                <div class="flex items-center gap-10 pt-10" data-aos="fade-up" data-aos-delay="1400">
                    <div class="text-center group" data-aos="zoom-in" data-aos-delay="1600">
                        <div class="text-4xl font-bold text-white counter drop-shadow-[0_0_20px_rgba(191,219,254,0.5)] group-hover:scale-125 transition-transform duration-300" data-target="{{ $materiCount }}">0</div>
                        <div class="text-base text-blue-100 font-semibold mt-1">Materi</div>
                    </div>
                    <div class="text-center group" data-aos="zoom-in" data-aos-delay="1800">
                        <div class="text-4xl font-bold text-white counter drop-shadow-[0_0_20px_rgba(191,219,254,0.5)] group-hover:scale-125 transition-transform duration-300" data-target="{{ $programCount }}">0</div>
                        <div class="text-base text-blue-100 font-semibold mt-1">Program</div>
                    </div>
                    <div class="text-center group" data-aos="zoom-in" data-aos-delay="2000">
                        <div class="text-4xl font-bold text-white counter drop-shadow-[0_0_20px_rgba(191,219,254,0.5)] group-hover:scale-125 transition-transform duration-300" data-target="{{ $intisariCount }}">0</div>
                        <div class="text-base text-blue-100 font-semibold mt-1">Intisari</div>
                    </div>
                    <div class="text-center group" data-aos="zoom-in" data-aos-delay="2200">
                        <div class="text-4xl font-bold text-white counter drop-shadow-[0_0_20px_rgba(191,219,254,0.5)] group-hover:scale-125 transition-transform duration-300" data-target="{{ $kegiatanCount }}">0</div>
                        <div class="text-base text-blue-100 font-semibold mt-1">Kegiatan</div>
                    </div>
                </div>
            </div>

            {{-- Right Side: Latest Updates Slider --}}
            <div class="hidden lg:block relative" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="400">
                <style>
                    .status-swiper {
                        width: 100%;
                        height: 650px;
                        border-radius: 1.5rem;
                    }
                    
                    .status-pagination {
                        position: absolute;
                        top: 20px;
                        left: 0;
                        right: 0;
                        z-index: 50;
                        display: flex;
                        gap: 8px;
                        padding: 0 20px;
                    }
                    
                    .status-bullet {
                        flex: 1;
                        height: 5px;
                        background: rgba(191, 219, 254, 0.25);
                        border-radius: 5px;
                        overflow: hidden;
                        position: relative;
                        cursor: pointer;
                        transition: all 0.3s ease;
                    }

                    .status-bullet:hover {
                        background: rgba(191, 219, 254, 0.35);
                        transform: scaleY(1.3);
                    }
                    
                    .status-bullet-fill {
                        position: absolute;
                        top: 0;
                        left: 0;
                        height: 100%;
                        width: 0%;
                        background: linear-gradient(90deg, #bfdbfe, #dbeafe);
                        border-radius: 5px;
                        box-shadow: 0 0 10px rgba(191, 219, 254, 0.6);
                    }
                    
                    .status-bullet.active .status-bullet-fill {
                        width: 100%;
                        transition: width 5s linear;
                    }
                    
                    .status-bullet.passed .status-bullet-fill {
                        width: 100%;
                    }
                </style>

                <div class="relative h-[650px] rounded-3xl overflow-hidden shadow-[0_0_80px_rgba(59,130,246,0.5)] border-2 border-blue-400/40 backdrop-blur-sm bg-blue-600/30 hover:shadow-[0_0_120px_rgba(59,130,246,0.7)] transition-all duration-700">
                    
                    <div class="swiper status-swiper">
                        <div class="status-pagination" id="statusPagination"></div>

                        <div class="swiper-wrapper">
                            @foreach($latestUpdates as $index => $update)
                            <div class="swiper-slide relative">
                                @if($update->thumbnail || (isset($update->cover) && $update->cover) || (isset($update->photos) && !empty($update->photos)))
                                    @php 
                                        $bgImage = $update->thumbnail ?? $update->cover ?? ($update->photos[0] ?? null);
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
                                    @if($bgUrl)
                                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[12000ms] ease-linear scale-100 hover:scale-110" 
                                             style="background-image: url('{{ $bgUrl }}');"></div>
                                    @else
                                         <div class="absolute inset-0 bg-gradient-to-br from-blue-700 to-blue-600"></div>
                                    @endif
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-blue-700 to-blue-600"></div>
                                @endif

                                <div class="absolute inset-0 bg-gradient-to-t from-blue-800 via-blue-700/60 to-blue-700/20"></div>

                                <div class="relative h-full flex flex-col justify-end p-8 pb-12">
                                    <div class="absolute top-12 left-8 right-8 flex justify-between items-start">
                                        <span class="px-5 py-2 rounded-full bg-blue-500/90 backdrop-blur-md text-white text-sm font-bold uppercase tracking-wider shadow-[0_0_30px_rgba(59,130,246,0.6)] border-2 border-blue-300/60 animate-pulse-subtle">
                                            {{ $update->type }}
                                        </span>
                                        <div class="text-right bg-black/40 backdrop-blur-md p-3 rounded-xl border-2 border-blue-400/30 shadow-[0_0_30px_rgba(0,0,0,0.3)]">
                                            <div class="text-white font-bold text-xl drop-shadow-lg">{{ $update->date ? \Carbon\Carbon::parse($update->date)->format('d M Y') : '' }}</div>
                                            <div class="text-blue-100 text-sm font-semibold">{{ $update->date ? \Carbon\Carbon::parse($update->date)->diffForHumans() : '' }}</div>
                                        </div>
                                    </div>

                                    <div class="space-y-5 mb-6" data-swiper-parallax-y="-20">
                                        @if(isset($update->category))
                                        <div class="text-blue-100 font-semibold text-base mb-3 flex items-center gap-3">
                                            <span class="w-12 h-[3px] bg-blue-300 inline-block animate-pulse-width"></span>
                                            {{ $update->category->name }}
                                        </div>
                                        @endif

                                        <h2 class="text-4xl lg:text-5xl font-bold text-white leading-tight drop-shadow-[0_0_30px_rgba(0,0,0,0.8)]">
                                            {{ $update->title ?? $update->judul }}
                                        </h2>
                                        
                                        <p class="text-gray-100 text-lg line-clamp-3 leading-relaxed drop-shadow-lg">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($update->excerpt ?? $update->description ?? $update->content ?? ''), 150) }}
                                        </p>
                                    </div>

                                    <div data-swiper-parallax-y="-10">
                                        <a href="{{ route($update->route_name, $update->route_params) }}" 
                                           class="inline-flex items-center gap-3 px-8 py-4 bg-blue-500 text-white rounded-xl font-bold hover:bg-blue-400 transition-all duration-300 group w-fit shadow-[0_0_30px_rgba(59,130,246,0.5)] hover:shadow-[0_0_50px_rgba(59,130,246,0.7)] hover:scale-105 border-2 border-blue-400/40">
                                            <span class="text-lg">Selengkapnya</span>
                                            <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                {{-- Enhanced Decorative Elements --}}
                <div class="absolute -z-10 -top-10 -right-10 w-full h-full bg-blue-500/25 rounded-3xl blur-3xl animate-pulse-glow"></div>
                <div class="absolute -z-10 -bottom-10 -left-10 w-full h-full bg-blue-400/25 rounded-3xl blur-3xl animate-pulse-glow animation-delay-2000"></div>
            </div>

            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const totalSlides = {{ count($latestUpdates) }};
                    const paginationLimit = 10;
                    const paginationContainer = document.getElementById('statusPagination');
                    
                    let paginationHTML = '';
                    for (let i = 0; i < Math.min(totalSlides, paginationLimit); i++) {
                        paginationHTML += `<div class="status-bullet" onclick="goToSlide(${i})"><div class="status-bullet-fill"></div></div>`;
                    }
                    paginationContainer.innerHTML = paginationHTML;

                    const bullets = document.querySelectorAll('.status-bullet');
                    const autoplayDuration = 5000;

                    const swiper = new Swiper(".status-swiper", {
                        effect: "fade",
                        fadeEffect: { crossFade: true },
                        speed: 800,
                        autoplay: {
                            delay: autoplayDuration,
                            disableOnInteraction: false,
                        },
                        loop: true,
                        on: {
                            slideChangeTransitionStart: function () {
                                updatePagination(this.realIndex);
                            }
                        }
                    });

                    window.goToSlide = function(index) {
                        swiper.slideToLoop(index);
                    };

                    function updatePagination(activeIndex) {
                        bullets.forEach((bullet, index) => {
                            bullet.classList.remove('active', 'passed');
                            const fill = bullet.querySelector('.status-bullet-fill');
                            
                            fill.style.transition = 'none';
                            fill.style.width = '0%';

                            if (index < activeIndex) {
                                bullet.classList.add('passed');
                            } else if (index === activeIndex) {
                                setTimeout(() => {
                                    bullet.classList.add('active');
                                    fill.style.transition = `width ${autoplayDuration}ms linear`;
                                    fill.style.width = '100%';
                                }, 10);
                            }
                        });
                    }

                    updatePagination(0);
                });
            </script>
        </div>
    </div>

    {{-- Enhanced Scroll Indicator --}}
    <div class="absolute bottom-10 left-1/2 transform -translate-x-1/2 animate-bounce-slow">
        <div class="w-7 h-12 border-3 border-blue-200/70 rounded-full flex justify-center p-2 shadow-[0_0_30px_rgba(191,219,254,0.4)]">
            <div class="w-2 h-4 bg-blue-100 rounded-full animate-scroll-pulse shadow-[0_0_10px_rgba(191,219,254,0.7)]"></div>
        </div>
    </div>
</section>

{{-- ABOUT SECTION --}}
<section class="py-32 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden">
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-0 left-0 w-[500px] h-[500px] bg-blue-500 rounded-full blur-[150px] animate-blob-slow"></div>
        <div class="absolute bottom-0 right-0 w-[500px] h-[500px] bg-blue-400 rounded-full blur-[150px] animate-blob-slow animation-delay-3000"></div>
        <div class="absolute top-1/2 left-1/2 w-[500px] h-[500px] bg-blue-600 rounded-full blur-[150px] animate-blob-slow animation-delay-6000"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="grid lg:grid-cols-2 gap-20 items-center">
            <div class="relative" data-aos="fade-right" data-aos-duration="1000">
                <div class="relative z-10" data-aos="zoom-in" data-aos-delay="200">
                    <div class="aspect-video rounded-3xl overflow-hidden shadow-[0_0_80px_rgba(59,130,246,0.6)] border-4 border-blue-400/40 backdrop-blur-lg bg-blue-600/30 hover:scale-105 hover:shadow-[0_0_120px_rgba(59,130,246,0.8)] transition-all duration-700 group">
                        <iframe 
                            class="w-full h-full"
                            src="https://www.youtube.com/embed/ovpPnlSwpe4?autoplay=0&controls=1&rel=0" 
                            title="Profil HASMI" 
                            frameborder="0" 
                            allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" 
                            allowfullscreen>
                        </iframe>
                    </div>
                </div>
                <div class="absolute -z-10 top-10 left-10 w-full h-full border-4 border-blue-400/50 rounded-3xl animate-border-pulse-slow" data-aos="fade" data-aos-delay="400"></div>
                <div class="absolute -z-20 -bottom-10 -right-10 w-96 h-96 bg-blue-500/35 rounded-full blur-[100px] animate-pulse-glow"></div>
            </div>

            <div class="space-y-7" data-aos="fade-left" data-aos-duration="1000">
                <div class="inline-block" data-aos="zoom-in" data-aos-delay="200">
                    <span class="px-6 py-3 bg-blue-500/50 backdrop-blur-md text-blue-50 rounded-full text-sm font-bold uppercase tracking-wider border-2 border-blue-300/50 shadow-[0_0_30px_rgba(59,130,246,0.4)]">Tentang Kami</span>
                </div>
                
                <h2 class="text-5xl lg:text-6xl font-bold text-white leading-tight drop-shadow-[0_0_30px_rgba(0,0,0,0.5)]" data-aos="fade-up" data-aos-delay="300">
                    Himpunan Aktivis Siswa Muslim Indonesia
                </h2>

                <div class="w-24 h-2 bg-gradient-to-r from-blue-400 via-blue-300 to-blue-400 rounded-full animate-gradient-flow shadow-[0_0_20px_rgba(96,165,250,0.6)]" data-aos="fade-right" data-aos-delay="400"></div>

                <div class="space-y-5 text-blue-50 text-xl leading-relaxed">
                    <p data-aos="fade-up" data-aos-delay="500" class="drop-shadow-lg">
                        HASMI adalah organisasi pendidikan, dakwah, dan sosial yang berfokus membina generasi muda muslim Indonesia dengan pendekatan komprehensif dan berkelanjutan.
                    </p>
                    <p data-aos="fade-up" data-aos-delay="600" class="drop-shadow-lg">
                        Melalui berbagai program unggulan, kami membentuk karakter Islami yang kuat, berilmu, dan berkontribusi nyata bagi kemajuan umat dan bangsa.
                    </p>
                </div>

                <div class="grid grid-cols-2 gap-5 pt-8">
                    <div class="flex items-start gap-4 bg-blue-600/50 backdrop-blur-md p-6 rounded-2xl border-2 border-blue-400/40 hover:border-blue-300 hover:bg-blue-500/60 transition-all duration-500 hover:scale-105 hover:shadow-[0_0_40px_rgba(59,130,246,0.5)] group"
                         data-aos="fade-up" data-aos-delay="700">
                        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-[0_0_30px_rgba(59,130,246,0.6)] group-hover:scale-110 group-hover:rotate-12 transition-all duration-500">
                            <i class="fas fa-check text-white text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-lg mb-1">Pendidikan Berkualitas</h4>
                            <p class="text-sm text-blue-100">Program pembelajaran terpadu</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-4 bg-blue-600/50 backdrop-blur-md p-6 rounded-2xl border-2 border-blue-400/40 hover:border-blue-300 hover:bg-blue-500/60 transition-all duration-500 hover:scale-105 hover:shadow-[0_0_40px_rgba(59,130,246,0.5)] group"
                         data-aos="fade-up" data-aos-delay="800">
                        <div class="w-12 h-12 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-[0_0_30px_rgba(59,130,246,0.6)] group-hover:scale-110 group-hover:rotate-12 transition-all duration-500 animation-delay-1000">
                            <i class="fas fa-check text-white text-xl"></i>
                        </div>
                        <div>
                            <h4 class="font-bold text-white text-lg mb-1">Dakwah Aktif</h4>
                            <p class="text-sm text-blue-100">Menyebarkan nilai-nilai Islam</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('tentang') }}" 
                   class="inline-flex items-center gap-3 px-10 py-5 bg-blue-500 text-white rounded-2xl font-bold shadow-[0_0_40px_rgba(59,130,246,0.5)] hover:shadow-[0_0_60px_rgba(59,130,246,0.7)] hover:scale-110 transition-all duration-500 group mt-6 border-2 border-blue-400/40"
                   data-aos="fade-up" data-aos-delay="900">
                    <span class="text-lg">Selengkapnya</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform duration-300"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- VISI MISI SECTION --}}
<section class="py-32 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/2 h-full bg-blue-500 opacity-15 rounded-l-[100px] blur-[150px] animate-pulse-glow"></div>
    <div class="absolute bottom-0 left-0 w-1/2 h-full bg-blue-400 opacity-15 rounded-r-[100px] blur-[150px] animate-pulse-glow animation-delay-3000"></div>
    
    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="px-6 py-3 bg-blue-500/50 backdrop-blur-md text-blue-50 rounded-full text-sm font-bold uppercase tracking-wider border-2 border-blue-300/50 shadow-[0_0_30px_rgba(59,130,246,0.4)]" data-aos="zoom-in">Komitmen Kami</span>
            <h2 class="text-5xl lg:text-6xl font-bold text-white mt-8 mb-5 drop-shadow-[0_0_30px_rgba(0,0,0,0.5)]" data-aos="fade-up" data-aos-delay="200">Visi & Misi</h2>
            <div class="w-28 h-2 bg-gradient-to-r from-blue-400 via-blue-300 to-blue-400 rounded-full mx-auto animate-gradient-flow shadow-[0_0_20px_rgba(96,165,250,0.6)]" data-aos="fade" data-aos-delay="300"></div>
        </div>

        <div class="grid lg:grid-cols-2 gap-10 max-w-6xl mx-auto">
            {{-- Visi Card --}}
            <div class="group relative" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-700 rounded-3xl transform group-hover:scale-105 transition-transform duration-700 shadow-[0_0_60px_rgba(59,130,246,0.5)]"></div>
                <div class="relative bg-blue-700/60 backdrop-blur-xl rounded-3xl p-12 shadow-[0_0_80px_rgba(59,130,246,0.4)] border-2 border-blue-400/50 transform group-hover:-translate-y-4 transition-all duration-700 hover:border-blue-300 hover:shadow-[0_0_100px_rgba(59,130,246,0.6)]">
                    <div class="w-20 h-20 bg-blue-500 rounded-2xl flex items-center justify-center mb-8 shadow-[0_0_40px_rgba(59,130,246,0.6)] group-hover:rotate-12 group-hover:scale-125 transition-all duration-700 border-2 border-blue-300/40">
                        <i class="fas fa-eye text-white text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-5 drop-shadow-lg">Visi</h3>
                    <p class="text-blue-50 text-xl leading-relaxed drop-shadow-md">
                        Menjadi organisasi terdepan dalam pembinaan generasi muslim yang berakhlak mulia, berilmu, dan bermanfaat bagi umat dan bangsa.
                    </p>
                </div>
            </div>

            {{-- Misi Card --}}
            <div class="group relative" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-600 to-blue-700 rounded-3xl transform group-hover:scale-105 transition-transform duration-700 shadow-[0_0_60px_rgba(59,130,246,0.5)]"></div>
                <div class="relative bg-blue-700/60 backdrop-blur-xl rounded-3xl p-12 shadow-[0_0_80px_rgba(59,130,246,0.4)] border-2 border-blue-400/50 transform group-hover:-translate-y-4 transition-all duration-700 hover:border-blue-300 hover:shadow-[0_0_100px_rgba(59,130,246,0.6)]">
                    <div class="w-20 h-20 bg-blue-500 rounded-2xl flex items-center justify-center mb-8 shadow-[0_0_40px_rgba(59,130,246,0.6)] group-hover:rotate-12 group-hover:scale-125 transition-all duration-700 border-2 border-blue-300/40">
                        <i class="fas fa-bullseye text-white text-3xl"></i>
                    </div>
                    <h3 class="text-3xl font-bold text-white mb-5 drop-shadow-lg">Misi</h3>
                    <p class="text-blue-50 text-xl leading-relaxed drop-shadow-md">
                        Menyelenggarakan program pendidikan, dakwah, dan sosial secara komprehensif dan berkelanjutan untuk kemajuan peradaban Islam.
                    </p>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROGRAM UNGGULAN --}}
<section class="py-32 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden">
    <div class="absolute inset-0 opacity-15">
        <div class="absolute top-1/4 left-1/4 w-96 h-96 bg-blue-500 rounded-full blur-[150px] animate-blob-slow"></div>
        <div class="absolute top-1/3 right-1/4 w-96 h-96 bg-blue-400 rounded-full blur-[150px] animate-blob-slow animation-delay-3000"></div>
        <div class="absolute bottom-1/4 left-1/3 w-96 h-96 bg-blue-600 rounded-full blur-[150px] animate-blob-slow animation-delay-6000"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="px-6 py-3 bg-blue-500/50 backdrop-blur-md text-blue-50 rounded-full text-sm font-bold uppercase tracking-wider border-2 border-blue-300/50 shadow-[0_0_30px_rgba(59,130,246,0.4)]" data-aos="zoom-in">Program Kami</span>
            <h2 class="text-5xl lg:text-6xl font-bold text-white mt-8 mb-5 drop-shadow-[0_0_30px_rgba(0,0,0,0.5)]" data-aos="fade-up" data-aos-delay="200">Program Unggulan</h2>
            <p class="text-blue-50 text-xl max-w-2xl mx-auto drop-shadow-lg" data-aos="fade-up" data-aos-delay="300">Berbagai program terbaik untuk pembinaan generasi muslim Indonesia</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8 mb-16">
            @foreach($homePrograms as $index => $p)
            <article class="article-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                     data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                
                {{-- Thumbnail --}}
                <div class="h-64 relative overflow-hidden m-4 rounded-[2rem]">
                    @if($p->thumbnail)
                        <img src="{{ asset('storage/' . $p->thumbnail) }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                             alt="{{ $p->title }}"
                             loading="lazy">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                            <i class="fas fa-hand-holding-heart text-white/20 text-6xl"></i>
                        </div>
                    @endif
                    
                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                        <p class="text-white text-xs leading-relaxed italic">"Klik untuk detail."</p>
                    </div>

                    {{-- Category Badge --}}
                    <div class="absolute top-4 left-4">
                        <span class="px-4 py-2 bg-blue-500 text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg border border-blue-400/30">
                            {{ $p->category->name ?? 'Program' }}
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                        {{ $p->title }}
                    </h3>
                    
                    <p class="text-blue-100 text-sm leading-relaxed mb-6 line-clamp-3 font-medium">
                        {{ \Illuminate\Support\Str::limit(strip_tags($p->description), 100) }}
                    </p>
                    
                    <div class="mt-auto">
                        <a href="{{ route('program.show', $p->slug) }}" 
                           class="w-full py-4 bg-blue-500 group-hover:bg-blue-400 text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition-all transform active:scale-95 shadow-xl shadow-blue-800/50 border-2 border-blue-400/40">
                            <span>Lihat Program</span>
                            <i class="fas fa-arrow-right text-sm group-hover:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center" data-aos="fade-up" data-aos-delay="600">
            <a href="{{ route('program.index') }}" class="inline-flex items-center gap-3 text-blue-50 font-bold hover:gap-5 transition-all group px-8 py-4 bg-blue-600/50 backdrop-blur-md rounded-full border-2 border-blue-300/50 hover:bg-blue-500/60 hover:border-blue-200 shadow-[0_0_30px_rgba(59,130,246,0.4)] hover:shadow-[0_0_50px_rgba(59,130,246,0.6)] text-lg">
                <span>Lihat Semua Program</span>
                <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

{{-- MATERI PEMBELAJARAN --}}
<section class="py-32 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="px-6 py-3 bg-blue-500/50 backdrop-blur-md text-blue-50 rounded-full text-sm font-bold uppercase tracking-wider border-2 border-blue-300/50 shadow-[0_0_30px_rgba(59,130,246,0.4)]" data-aos="zoom-in">Pembelajaran</span>
            <h2 class="text-5xl lg:text-6xl font-bold text-white mt-8 mb-5 drop-shadow-[0_0_30px_rgba(0,0,0,0.5)]" data-aos="fade-up" data-aos-delay="200">Materi Terbaru</h2>
            <p class="text-blue-50 text-xl max-w-2xl mx-auto drop-shadow-lg" data-aos="fade-up" data-aos-delay="300">Artikel dan materi pembelajaran untuk pemahaman agama yang lebih baik</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($homeArticles as $index => $article)
            <article class="article-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                     data-aos="fade-up" data-aos-delay="{{ $index * 150 }}">
                
                {{-- Thumbnail --}}
                <div class="h-64 relative overflow-hidden m-4 rounded-[2rem]">
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
                    
                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                        <p class="text-white text-xs leading-relaxed italic">"Klik untuk membaca."</p>
                    </div>

                    {{-- Category Badge --}}
                    <div class="absolute top-4 left-4">
                        <span class="px-4 py-2 bg-blue-500 text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg border border-blue-400/30">
                            {{ $article->category->name }}
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                        {{ $article->title }}
                    </h3>
                    
                    <p class="text-blue-100 text-sm leading-relaxed mb-6 line-clamp-3 font-medium">
                        {{ \Illuminate\Support\Str::limit(strip_tags($article->content ?? $article->excerpt), 100) }}
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

        <div class="text-center mt-16" data-aos="fade-up" data-aos-delay="600">
            <a href="{{ route('materi.index') }}" 
               class="inline-flex items-center gap-3 px-10 py-5 bg-blue-500 text-white rounded-2xl font-bold shadow-[0_0_40px_rgba(59,130,246,0.5)] hover:shadow-[0_0_60px_rgba(59,130,246,0.7)] hover:scale-110 transition-all duration-500 group text-lg border-2 border-blue-400/40">
                <span>Lihat Semua Materi</span>
                <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform duration-300"></i>
            </a>
        </div>
    </div>
</section>

{{-- INTISARI SECTION --}}
<section class="py-32 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden">
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full bg-blue-500 animate-pulse-glow"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="px-6 py-3 bg-blue-500/50 backdrop-blur-md text-blue-50 rounded-full text-sm font-bold uppercase tracking-wider border-2 border-blue-300/50 shadow-[0_0_30px_rgba(59,130,246,0.4)]" data-aos="zoom-in">Publikasi</span>
            <h2 class="text-5xl lg:text-6xl font-bold text-white mt-8 mb-5 drop-shadow-[0_0_30px_rgba(0,0,0,0.5)]" data-aos="fade-up" data-aos-delay="200">Intisari HASMI</h2>
            <p class="text-blue-50 text-xl max-w-2xl mx-auto drop-shadow-lg" data-aos="fade-up" data-aos-delay="300">Kumpulan materi dan ringkasan pembelajaran dalam bentuk publikasi</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($homeIntisari as $index => $i)
            <article class="article-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                     data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                
                {{-- Thumbnail --}}
                <div class="h-64 relative overflow-hidden m-4 rounded-[2rem]">
                    @if($i->thumbnail_url)
                        <img src="{{ $i->thumbnail_url }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                             alt="{{ $i->title }}"
                             loading="lazy">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                            <i class="fas fa-image text-white/20 text-6xl"></i>
                        </div>
                    @endif
                    
                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                        <p class="text-white text-xs leading-relaxed italic">"Klik untuk membaca."</p>
                    </div>

                    {{-- Badge --}}
                    <div class="absolute top-4 left-4">
                        <span class="px-4 py-2 bg-blue-500 text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg border border-blue-400/30">
                            Intisari
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                    <h3 class="text-xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                        {{ $i->title }}
                    </h3>
                    
                    <p class="text-blue-100 text-sm leading-relaxed mb-6 line-clamp-3 font-medium">
                        {{ \Illuminate\Support\Str::limit(strip_tags($i->content), 100) }}
                    </p>
                    
                    <div class="mt-auto">
                        <a href="{{ route('intisari.show', $i->slug) }}" 
                           class="w-full py-4 bg-blue-500 group-hover:bg-blue-400 text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition-all transform active:scale-95 shadow-xl shadow-blue-800/50 border-2 border-blue-400/40">
                            <span>Baca Intisari</span>
                            <i class="fas fa-arrow-right text-sm group-hover:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-16" data-aos="fade-up" data-aos-delay="500">
            <a href="{{ route('intisari.index') }}" class="inline-flex items-center gap-3 text-blue-50 font-bold hover:gap-5 transition-all group px-8 py-4 bg-blue-600/50 backdrop-blur-md rounded-full border-2 border-blue-300/50 hover:bg-blue-500/60 hover:border-blue-200 shadow-[0_0_30px_rgba(59,130,246,0.4)] hover:shadow-[0_0_50px_rgba(59,130,246,0.6)] text-lg">
                <span>Lihat Semua Intisari</span>
                <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

{{-- KEGIATAN SECTION --}}
<section class="py-32 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden" id="kegiatan">
    <div class="absolute inset-0 opacity-8">
        <div class="absolute inset-0 bg-[radial-gradient(circle_at_50%_50%,_rgba(59,130,246,0.4),transparent_50%)]"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="px-6 py-3 bg-blue-500/50 backdrop-blur-md text-blue-50 rounded-full text-sm font-bold uppercase tracking-wider border-2 border-blue-300/50 shadow-[0_0_30px_rgba(59,130,246,0.4)]" data-aos="zoom-in">Aktivitas</span>
            <h2 class="text-5xl lg:text-6xl font-bold text-white mt-8 mb-5 drop-shadow-[0_0_30px_rgba(0,0,0,0.5)]" data-aos="fade-up" data-aos-delay="200">Kegiatan HASMI</h2>
            <p class="text-blue-50 text-xl max-w-2xl mx-auto drop-shadow-lg" data-aos="fade-up" data-aos-delay="300">Dokumentasi kegiatan dan agenda dakwah terbaru</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($homeKegiatan as $index => $k)
            <article class="article-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                     data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                
                {{-- Thumbnail --}}
                <div class="h-64 relative overflow-hidden m-4 rounded-[2rem]">
                    @if($k->thumbnail_url)
                        <img src="{{ $k->thumbnail_url }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                             alt="{{ $k->title }}"
                             loading="lazy">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                            <i class="fas fa-camera text-white/20 text-6xl"></i>
                        </div>
                    @endif
                    
                    {{-- Overlay --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                        <p class="text-white text-xs leading-relaxed italic">"Klik untuk dokumentasi."</p>
                    </div>

                    {{-- Badge --}}
                    <div class="absolute top-4 left-4">
                        <span class="px-4 py-2 bg-blue-500 text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg border border-blue-400/30">
                            Kegiatan
                        </span>
                    </div>
                </div>

                {{-- Content --}}
                <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 mb-3">
                        <i class="far fa-calendar-alt text-blue-100 text-xs"></i>
                        <span class="text-blue-100 text-[11px] font-bold uppercase tracking-wider">
                            {{ $k->event_date ? \Carbon\Carbon::parse($k->event_date)->isoFormat('D MMM Y') : \Carbon\Carbon::parse($k->created_at)->isoFormat('D MMM Y') }}
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                        {{ $k->title }}
                    </h3>
                    
                    <div class="mt-auto">
                        <a href="{{ route('kegiatan.show', $k->slug) }}" 
                           class="w-full py-4 bg-blue-500 group-hover:bg-blue-400 text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition-all transform active:scale-95 shadow-xl shadow-blue-800/50 border-2 border-blue-400/40">
                            <span>Lihat Dokumentasi</span>
                            <i class="fas fa-arrow-right text-sm group-hover:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-16" data-aos="fade-up" data-aos-delay="500">
            <a href="{{ route('kegiatan.index') }}" class="inline-flex items-center gap-4 px-10 py-5 bg-blue-500 text-white rounded-2xl font-bold shadow-[0_0_40px_rgba(59,130,246,0.5)] hover:shadow-[0_0_60px_rgba(59,130,246,0.7)] hover:scale-110 transition-all duration-500 group text-lg border-2 border-blue-400/40">
                <span>Galeri Kegiatan</span>
                <i class="fas fa-images group-hover:rotate-12 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

{{-- EXTERNAL LINKS (LAYANAN KAMI) --}}
<section class="py-32 lg:py-40 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 relative overflow-hidden">
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[600px] bg-blue-500/35 blur-[180px] rounded-full pointer-events-none"></div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-center mb-20" data-aos="fade-up">
            <span class="px-6 py-3 bg-blue-500/50 backdrop-blur-md text-blue-50 rounded-full text-sm font-bold uppercase tracking-wider border-2 border-blue-300/50 shadow-[0_0_30px_rgba(59,130,246,0.4)]">Layanan Kami</span>
            <h2 class="text-5xl lg:text-6xl font-bold text-white mt-8 mb-5 drop-shadow-[0_0_30px_rgba(0,0,0,0.5)]">Kontribusi Untuk Umat</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-10 max-w-6xl mx-auto">
            <a href="https://donasi.hasmi.org/" target="_blank" 
               class="group relative overflow-hidden bg-blue-700/50 backdrop-blur-xl rounded-3xl p-12 shadow-[0_0_40px_rgba(59,130,246,0.4)] hover:shadow-[0_0_80px_rgba(59,130,246,0.6)] transition-all duration-700 hover:-translate-y-3 border-2 border-blue-400/40 hover:border-blue-300"
               data-aos="fade-up" data-aos-delay="100">
                <div class="relative z-10 text-center">
                    <div class="w-24 h-24 bg-blue-500 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-125 group-hover:rotate-12 transition-all duration-700 shadow-[0_10px_40px_rgba(59,130,246,0.5)] border-2 border-blue-400/40">
                        <i class="fas fa-hand-holding-heart text-4xl text-white"></i>
                    </div>
                    <h3 class="text-3xl font-bold mb-4 text-white">Donasi</h3>
                    <p class="text-blue-50 text-lg leading-relaxed">Salurkan donasi terbaik Anda untuk kemajuan dakwah dan pendidikan Islam</p>
                </div>
                <div class="absolute inset-0 bg-blue-500/40 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            </a>

            <a href="https://beasiswapendidikanislam.com/" target="_blank" 
               class="group relative overflow-hidden bg-blue-700/50 backdrop-blur-xl rounded-3xl p-12 shadow-[0_0_40px_rgba(59,130,246,0.4)] hover:shadow-[0_0_80px_rgba(59,130,246,0.6)] transition-all duration-700 hover:-translate-y-3 border-2 border-blue-400/40 hover:border-blue-300"
               data-aos="fade-up" data-aos-delay="200">
                <div class="relative z-10 text-center">
                    <div class="w-24 h-24 bg-blue-500 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-125 group-hover:rotate-12 transition-all duration-700 shadow-[0_10px_40px_rgba(59,130,246,0.5)] border-2 border-blue-400/40">
                        <i class="fas fa-user-graduate text-4xl text-white"></i>
                    </div>
                    <h3 class="text-3xl font-bold mb-4 text-white">Beasiswa</h3>
                    <p class="text-blue-50 text-lg leading-relaxed">Program beasiswa pendidikan Islam untuk mencetak kader dai berkualitas</p>
                </div>
                <div class="absolute inset-0 bg-blue-500/40 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            </a>

            <a href="https://hasmipeduli.org/" target="_blank" 
               class="group relative overflow-hidden bg-blue-700/50 backdrop-blur-xl rounded-3xl p-12 shadow-[0_0_40px_rgba(59,130,246,0.4)] hover:shadow-[0_0_80px_rgba(59,130,246,0.6)] transition-all duration-700 hover:-translate-y-3 border-2 border-blue-400/40 hover:border-blue-300"
               data-aos="fade-up" data-aos-delay="300">
                <div class="relative z-10 text-center">
                    <div class="w-24 h-24 bg-blue-500 rounded-3xl flex items-center justify-center mx-auto mb-8 group-hover:scale-125 group-hover:rotate-12 transition-all duration-700 shadow-[0_10px_40px_rgba(59,130,246,0.5)] border-2 border-blue-400/40">
                        <i class="fas fa-hands-helping text-4xl text-white"></i>
                    </div>
                    <h3 class="text-3xl font-bold mb-4 text-white">Sosial</h3>
                    <p class="text-blue-50 text-lg leading-relaxed">Aksi sosial dan kemanusiaan untuk membantu sesama yang membutuhkan</p>
                </div>
                <div class="absolute inset-0 bg-blue-500/40 opacity-0 group-hover:opacity-100 transition-opacity duration-700"></div>
            </a>
        </div>
    </div>
</section>

@endsection

{{-- ENHANCED STYLES --}}
@section('styles')
<style>
* {
    scroll-behavior: smooth;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(to bottom, #1d4ed8, #2563eb);
}

/* Enhanced Islamic Pattern */
.islamic-pattern {
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 80% 50%, rgba(96, 165, 250, 0.3) 0%, transparent 50%),
        radial-gradient(circle at 50% 20%, rgba(59, 130, 246, 0.25) 0%, transparent 50%);
    background-size: 1000px 1000px;
    animation: patternMove 30s ease-in-out infinite;
}

@keyframes patternMove {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    33% { transform: translate(-50px, 50px) rotate(3deg); }
    66% { transform: translate(50px, -50px) rotate(-3deg); }
}

/* Enhanced Floating Orbs - WARNA BIRU LEBIH TERANG */
.floating-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(120px);
    animation: float-enhanced 25s ease-in-out infinite;
    opacity: 0.6;
}

.orb-1 {
    width: 600px;
    height: 600px;
    background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
    top: -200px;
    left: -200px;
    animation-delay: 0s;
}

.orb-2 {
    width: 500px;
    height: 500px;
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    bottom: -150px;
    right: 10%;
    animation-delay: 7s;
}

.orb-3 {
    width: 450px;
    height: 450px;
    background: linear-gradient(135deg, #60a5fa 0%, #93c5fd 100%);
    top: 25%;
    right: -150px;
    animation-delay: 14s;
}

.orb-4 {
    width: 400px;
    height: 400px;
    background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
    bottom: 15%;
    left: 25%;
    animation-delay: 4s;
}

.orb-5 {
    width: 350px;
    height: 350px;
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    top: 45%;
    left: 5%;
    animation-delay: 11s;
}

/* Article Card Style */
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

@keyframes float-enhanced {
    0%, 100% { transform: translate(0, 0) scale(1) rotate(0deg); }
    25% { transform: translate(60px, -60px) scale(1.2) rotate(5deg); }
    50% { transform: translate(-40px, 50px) scale(0.9) rotate(-5deg); }
    75% { transform: translate(50px, 40px) scale(1.1) rotate(3deg); }
}

/* Enhanced Particles */
.particles {
    position: absolute;
    inset: 0;
}

.particle {
    position: absolute;
    width: var(--size, 4px);
    height: var(--size, 4px);
    background: radial-gradient(circle, rgba(191, 219, 254, 0.8), rgba(147, 197, 253, 0.2));
    border-radius: 50%;
    animation: particleFloat-enhanced var(--duration, 15s) ease-in-out infinite;
    animation-delay: var(--delay, 0s);
    top: calc(50% + (var(--delay) * 15px));
    left: calc(50% + (var(--delay) * 20px));
    box-shadow: 0 0 15px rgba(191, 219, 254, 0.6);
}

@keyframes particleFloat-enhanced {
    0%, 100% { 
        transform: translate(0, 0) scale(0.3);
        opacity: 0;
    }
    25% { 
        transform: translate(120px, -120px) scale(1.2);
        opacity: 1;
    }
    50% { 
        transform: translate(-100px, -250px) scale(0.9);
        opacity: 0.8;
    }
    75% { 
        transform: translate(180px, -180px) scale(1.4);
        opacity: 1;
    }
}

/* Light Rays */
.light-rays {
    position: absolute;
    inset: 0;
    overflow: hidden;
}

.light-ray {
    position: absolute;
    width: 2px;
    height: 100%;
    background: linear-gradient(180deg, transparent, rgba(191, 219, 254, 0.3), transparent);
    animation: lightRay 8s ease-in-out infinite;
    animation-delay: var(--ray-delay, 0s);
    left: calc(20% * var(--ray-delay));
    opacity: 0.4;
}

@keyframes lightRay {
    0%, 100% { 
        transform: translateY(-100%) scaleY(0);
        opacity: 0;
    }
    50% { 
        transform: translateY(0) scaleY(1);
        opacity: 0.4;
    }
}

/* Enhanced Gradient Animations */
@keyframes gradient-flow {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-gradient-flow {
    background-size: 200% 200%;
    animation: gradient-flow 6s ease infinite;
}

/* Enhanced Text Glow */
@keyframes text-glow {
    0%, 100% { 
        text-shadow: 0 0 20px rgba(191, 219, 254, 0.3);
    }
    50% { 
        text-shadow: 0 0 40px rgba(191, 219, 254, 0.6), 0 0 60px rgba(191, 219, 254, 0.5);
    }
}

.animate-text-glow {
    animation: text-glow 3s ease-in-out infinite;
}

/* Enhanced Pulse Animations */
@keyframes pulse-glow {
    0%, 100% { 
        opacity: 0.4; 
        transform: scale(0.95);
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
    }
    50% { 
        opacity: 0.7; 
        transform: scale(1.15);
        box-shadow: 0 0 60px rgba(59, 130, 246, 0.6);
    }
}

.animate-pulse-glow {
    animation: pulse-glow 6s ease-in-out infinite;
}

@keyframes pulse-subtle {
    0%, 100% { 
        transform: scale(1);
        opacity: 1;
    }
    50% { 
        transform: scale(1.05);
        opacity: 0.9;
    }
}

.animate-pulse-subtle {
    animation: pulse-subtle 3s ease-in-out infinite;
}

/* Enhanced Blob Animation */
@keyframes blob-slow {
    0%, 100% { 
        transform: translate(0, 0) scale(1) rotate(0deg);
    }
    25% { 
        transform: translate(40px, -60px) scale(1.15) rotate(5deg);
    }
    50% { 
        transform: translate(-30px, 30px) scale(0.85) rotate(-5deg);
    }
    75% { 
        transform: translate(50px, 40px) scale(1.1) rotate(3deg);
    }
}

.animate-blob-slow {
    animation: blob-slow 20s infinite ease-in-out;
}

/* Enhanced Border Animations */
@keyframes border-pulse {
    0%, 100% { 
        border-color: rgba(59, 130, 246, 0.4);
        box-shadow: 0 0 30px rgba(59, 130, 246, 0.3);
    }
    50% { 
        border-color: rgba(96, 165, 250, 0.7);
        box-shadow: 0 0 60px rgba(59, 130, 246, 0.6);
    }
}

.animate-border-pulse {
    animation: border-pulse 3s ease-in-out infinite;
}

@keyframes border-pulse-slow {
    0%, 100% { 
        border-color: rgba(59, 130, 246, 0.5);
        box-shadow: 0 0 40px rgba(59, 130, 246, 0.3);
    }
    50% { 
        border-color: rgba(96, 165, 250, 0.8);
        box-shadow: 0 0 80px rgba(59, 130, 246, 0.7);
    }
}

.animate-border-pulse-slow {
    animation: border-pulse-slow 5s ease-in-out infinite;
}

/* Pulse Width Animation */
@keyframes pulse-width {
    0%, 100% { 
        width: 48px;
        opacity: 1;
    }
    50% { 
        width: 72px;
        opacity: 0.7;
    }
}

.animate-pulse-width {
    animation: pulse-width 2s ease-in-out infinite;
}

/* Enhanced Scroll Animation */
@keyframes scroll-pulse {
    0% { 
        transform: translateY(0);
        opacity: 0;
    }
    50% { 
        opacity: 1;
    }
    100% { 
        transform: translateY(16px);
        opacity: 0;
    }
}

.animate-scroll-pulse {
    animation: scroll-pulse 2.5s ease-in-out infinite;
}

@keyframes bounce-slow {
    0%, 100% {
        transform: translateY(0);
    }
    50% {
        transform: translateY(-15px);
    }
}

.animate-bounce-slow {
    animation: bounce-slow 3s ease-in-out infinite;
}

/* Animation Delays */
.animation-delay-1000 { animation-delay: 1s; }
.animation-delay-2000 { animation-delay: 2s; }
.animation-delay-3000 { animation-delay: 3s; }
.animation-delay-4000 { animation-delay: 4s; }
.animation-delay-6000 { animation-delay: 6s; }

/* Line Clamp */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

.line-clamp-3 {
    display: -webkit-box;
    -webkit-line-clamp: 3;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Enhanced Scrollbar */
::-webkit-scrollbar {
    width: 16px;
}

::-webkit-scrollbar-track {
    background: linear-gradient(to bottom, #1d4ed8, #2563eb);
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #3b82f6, #60a5fa);
    border-radius: 8px;
    border: 4px solid #2563eb;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #60a5fa, #93c5fd);
}

/* Responsive */
@media (max-width: 768px) {
    .floating-orb {
        opacity: 0.3;
    }
    
    .particle {
        display: none;
    }

    .light-ray {
        display: none;
    }
}
</style>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS
    AOS.init({
        duration: 1200,
        easing: 'ease-out-cubic',
        once: false,
        offset: 120,
        delay: 100,
        mirror: true,
        anchorPlacement: 'top-bottom',
    });

    window.addEventListener('resize', () => {
        AOS.refresh();
    });

    // Enhanced Counter Animation
    const counters = document.querySelectorAll('.counter');
    const speed = 200;
    
    const observerOptions = {
        threshold: 0.7,
        rootMargin: '0px'
    };

    const counterObserver = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const target = +counter.getAttribute('data-target');
                const increment = target / speed;
                
                const updateCount = () => {
                    const count = +counter.innerText;
                    if (count < target) {
                        counter.innerText = Math.ceil(count + increment);
                        setTimeout(updateCount, 10);
                    } else {
                        counter.innerText = target;
                        counter.style.transform = 'scale(1.3)';
                        setTimeout(() => {
                            counter.style.transform = 'scale(1)';
                        }, 300);
                    }
                };
                
                counter.style.transition = 'transform 0.3s ease';
                updateCount();
                counterObserver.unobserve(counter);
            }
        });
    }, observerOptions);

    counters.forEach(counter => counterObserver.observe(counter));

    // Smooth scroll
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });

    // Enhanced Parallax
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.floating-orb');
                
                parallaxElements.forEach((el, index) => {
                    const speed = 0.2 + (index * 0.05);
                    const yPos = -(scrolled * speed);
                    el.style.transform = `translateY(${yPos}px)`;
                });

                const particles = document.querySelectorAll('.particle');
                particles.forEach((particle, index) => {
                    const speed = 0.08 + (index * 0.01);
                    const yPos = -(scrolled * speed);
                    particle.style.transform = `translateY(${yPos}px)`;
                });

                ticking = false;
            });
            ticking = true;
        }
    });

    // Loading animation
    window.addEventListener('load', function() {
        document.body.style.opacity = '0';
        setTimeout(() => {
            document.body.style.transition = 'opacity 0.8s ease';
            document.body.style.opacity = '1';
        }, 100);
    });
});
</script>
@endsection