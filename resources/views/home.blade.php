@extends('layouts.app')

@section('title', 'HASMI - Membangun Peradaban Islami')

@section('content')
{{-- INTRO VIDEO OVERLAY --}}
<div id="intro-overlay" class="fixed inset-0 z-[9999] bg-black/95 backdrop-blur-xl flex items-center justify-center p-4 transition-opacity duration-500">
    <div class="relative w-full max-w-6xl aspect-video bg-black rounded-3xl overflow-hidden shadow-2xl border border-white/10 ring-4 ring-blue-500/30">
        <button onclick="closeIntro()" class="absolute top-4 right-4 z-50 bg-red-600 hover:bg-red-700 text-white px-5 py-2 rounded-full font-bold shadow-lg transition-transform hover:scale-105 flex items-center gap-2 group">
            <span>Tutup Video</span>
            <i class="fas fa-times group-hover:rotate-90 transition-transform"></i>
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
        
        overlay.classList.add('opacity-0', 'pointer-events-none');
        
        // Stop video by unsetting source after transition
        setTimeout(() => {
            frame.src = '';
            overlay.style.display = 'none';
        }, 500);
    }
</script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

{{-- HERO SECTION --}}
<section class="relative min-h-screen flex items-center overflow-hidden bg-gradient-to-br from-blue-600 via-blue-500 to-cyan-600">
    {{-- Animated Background Elements --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <div class="islamic-pattern"></div>
        <div class="floating-orb orb-1"></div>
        <div class="floating-orb orb-2"></div>
        <div class="floating-orb orb-3"></div>
        <div class="floating-orb orb-4"></div>
        <div class="floating-orb orb-5"></div>
        
        {{-- Animated Particles --}}
        <div class="particles">
            @for($i = 0; $i < 20; $i++)
                <div class="particle" style="--delay: {{ $i * 0.3 }}s; --duration: {{ 15 + ($i % 5) }}s;"></div>
            @endfor
        </div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Left Side: Content --}}
            <div class="space-y-8" data-aos="fade-right" data-aos-duration="1200" data-aos-delay="200">
                <div class="inline-flex items-center gap-4 bg-white/10 backdrop-blur-xl px-6 py-3 rounded-full shadow-2xl border border-white/20"
                     data-aos="zoom-in" data-aos-delay="400">
                    <div class="w-12 h-12 bg-white rounded-full flex items-center justify-center shadow-xl animate-pulse-slow">
                       <img src="{{ asset('img/hasmilogo.png') }}" alt="Logo HASMI" class="w-8 h-8 object-contain">
                    </div>
                    <span class="text-xl font-bold text-white tracking-wide">HASMI</span>
                </div>

                <h1 class="text-5xl lg:text-7xl font-bold leading-tight">
                    <span class="block text-white mb-2" data-aos="fade-up" data-aos-delay="600">Membangun</span>
                    <span class="block text-transparent bg-clip-text bg-gradient-to-r from-blue-200 via-blue-300 to-cyan-200 animate-gradient"
                          data-aos="fade-up" data-aos-delay="800">
                        Peradaban Islami
                    </span>
                </h1>

                <p class="text-lg lg:text-xl text-blue-100 leading-relaxed max-w-2xl" 
                   data-aos="fade-up" data-aos-delay="1000">
                    Himpunan Aktivis Siswa Muslim Indonesia berkomitmen membina generasi muslim melalui pendidikan, dakwah, dan aksi sosial berkelanjutan untuk kemajuan umat.
                </p>

                <div class="flex flex-wrap gap-4 pt-4" data-aos="fade-up" data-aos-delay="1200">
                    <a href="{{ route('materi.index') }}" 
                       class="group px-8 py-4 bg-white text-blue-900 rounded-2xl font-semibold shadow-2xl hover:shadow-blue-500/50 hover:scale-110 transition-all duration-500 flex items-center gap-2 hover-glow">
                        <span>Jelajahi Materi</span>
                        <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform duration-300"></i>
                    </a>
                    <a href="{{ route('tentang') }}" 
                       class="px-8 py-4 bg-blue-700/30 backdrop-blur-sm text-white rounded-2xl font-semibold shadow-xl border-2 border-blue-400/50 hover:bg-blue-600/50 hover:border-blue-300 hover:scale-110 transition-all duration-500">
                        Tentang Kami
                    </a>
                </div>

                {{-- Trust Indicators with Animation --}}
                <div class="flex items-center gap-8 pt-8 border-t border-white/20" data-aos="fade-up" data-aos-delay="1400">
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="1600">
                        <div class="text-3xl font-bold text-white counter" data-target="{{ \App\Models\Article::published()->count() }}">0</div>
                        <div class="text-sm text-blue-200 font-medium">Artikel</div>
                    </div>
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="1800">
                        <div class="text-3xl font-bold text-white counter" data-target="{{ \App\Models\Program::count() }}">0</div>
                        <div class="text-sm text-blue-200 font-medium">Program</div>
                    </div>
                    <div class="text-center" data-aos="zoom-in" data-aos-delay="2000">
                        <div class="text-3xl font-bold text-white counter" data-target="{{ \App\Models\Kegiatan::count() }}">0</div>
                        <div class="text-sm text-blue-200 font-medium">Kegiatan</div>
                    </div>
                </div>
            </div>

            {{-- Right Side: Latest Updates Slider --}}
            <div class="hidden lg:block relative" data-aos="fade-left" data-aos-duration="1200" data-aos-delay="400">
                <style>
                    /* Custom Swiper Styles for Status Effect */
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
                        gap: 6px;
                        padding: 0 20px;
                    }
                    
                    .status-bullet {
                        flex: 1;
                        height: 4px;
                        background: rgba(255, 255, 255, 0.3);
                        border-radius: 4px;
                        overflow: hidden;
                        position: relative;
                        cursor: pointer;
                    }
                    
                    .status-bullet-fill {
                        position: absolute;
                        top: 0;
                        left: 0;
                        height: 100%;
                        width: 0%;
                        background: #fff;
                        border-radius: 4px;
                    }
                    
                    .status-bullet.active .status-bullet-fill {
                        width: 100%;
                        transition: width 5s linear; /* Duration matches autoplay */
                    }
                    
                    .status-bullet.passed .status-bullet-fill {
                        width: 100%;
                    }
                </style>

                <div class="relative h-[650px] rounded-3xl overflow-hidden shadow-2xl border border-white/20 backdrop-blur-sm bg-white/5">
                    
                    <!-- Swiper -->
                    <div class="swiper status-swiper">
                        <!-- Custom Pagination (Status Bars) -->
                        <div class="status-pagination" id="statusPagination"></div>

                        <div class="swiper-wrapper">
                            @foreach($latestUpdates as $index => $update)
                            <div class="swiper-slide relative">
                                <!-- Background Image/Gradient -->
                                @if($update->thumbnail || (isset($update->cover) && $update->cover) || (isset($update->photos) && !empty($update->photos)))
                                    @php 
                                        $bgImage = $update->thumbnail ?? $update->cover ?? ($update->photos[0] ?? null);
                                        $bgUrl = $bgImage ? asset($bgImage) : null;
                                    @endphp
                                    @if($bgUrl)
                                        <div class="absolute inset-0 bg-cover bg-center transition-transform duration-[10000ms] ease-linear scale-100 hover:scale-110" 
                                             style="background-image: url('{{ $bgUrl }}');"></div>
                                    @else
                                         <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-blue-700"></div>
                                    @endif
                                @else
                                    <div class="absolute inset-0 bg-gradient-to-br from-blue-900 to-blue-700"></div>
                                @endif

                                <!-- Overlay -->
                                <div class="absolute inset-0 bg-gradient-to-t from-gray-900 via-gray-900/40 to-gray-900/30"></div>

                                <!-- Content -->
                                <div class="relative h-full flex flex-col justify-end p-8 pb-12">
                                    <!-- Header: Type & Date -->
                                    <div class="absolute top-12 left-8 right-8 flex justify-between items-start">
                                        <span class="px-4 py-1.5 rounded-full bg-blue-600/80 backdrop-blur-md text-white text-xs font-bold uppercase tracking-wider shadow-lg border border-white/20">
                                            {{ $update->type }}
                                        </span>
                                        <div class="text-right bg-black/30 backdrop-blur-sm p-2 rounded-lg border border-white/10">
                                            <div class="text-white font-bold text-lg text-shadow-sm">{{ $update->date ? \Carbon\Carbon::parse($update->date)->format('d M Y') : '' }}</div>
                                            <div class="text-blue-200 text-sm font-semibold">{{ $update->date ? \Carbon\Carbon::parse($update->date)->diffForHumans() : '' }}</div>
                                        </div>
                                    </div>

                                    <!-- Body: Title & Excerpt -->
                                    <div class="space-y-4 mb-6" data-swiper-parallax-y="-20">
                                        @if(isset($update->category))
                                        <div class="text-blue-300 font-medium text-sm mb-2 flex items-center gap-2">
                                            <span class="w-8 h-[2px] bg-blue-400 inline-block"></span>
                                            {{ $update->category->name }}
                                        </div>
                                        @endif

                                        <h2 class="text-3xl lg:text-4xl font-bold text-white leading-tight text-shadow">
                                            {{ $update->title ?? $update->judul }}
                                        </h2>
                                        
                                        <p class="text-gray-200 text-base line-clamp-3 leading-relaxed">
                                            {{ \Illuminate\Support\Str::limit(strip_tags($update->excerpt ?? $update->description ?? $update->content ?? ''), 150) }}
                                        </p>
                                    </div>

                                    <!-- Action -->
                                    <div data-swiper-parallax-y="-10">
                                        <a href="{{ route($update->route_name, $update->route_params) }}" 
                                           class="inline-flex items-center gap-3 px-6 py-3 bg-white text-blue-900 rounded-xl font-bold hover:bg-blue-50 transition-all duration-300 group w-fit">
                                            <span>Selengkapnya</span>
                                            <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                
                {{-- Decorative Elements --}}
                <div class="absolute -z-10 -top-8 -right-8 w-full h-full bg-blue-500/10 rounded-3xl blur-2xl"></div>
                <div class="absolute -z-10 -bottom-8 -left-8 w-full h-full bg-cyan-500/10 rounded-3xl blur-2xl"></div>
            </div>

            <!-- Swiper Logic (Inline for simplicity or move to scripts) -->
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    const totalSlides = {{ count($latestUpdates) }};
                    const paginationLimit = 10; // Show max 10 bars
                    const paginationContainer = document.getElementById('statusPagination');
                    
                    // Render Pagination Bars
                    let paginationHTML = '';
                    for (let i = 0; i < Math.min(totalSlides, paginationLimit); i++) {
                        paginationHTML += `<div class="status-bullet" onclick="goToSlide(${i})"><div class="status-bullet-fill"></div></div>`;
                    }
                    paginationContainer.innerHTML = paginationHTML;

                    const bullets = document.querySelectorAll('.status-bullet');
                    const autoplayDuration = 5000; // 5 seconds

                    const swiper = new Swiper(".status-swiper", {
                        effect: "fade",
                        fadeEffect: { crossFade: true },
                        speed: 600,
                        autoplay: {
                            delay: autoplayDuration,
                            disableOnInteraction: false,
                        },
                        loop: true, // Loop must be true for infinite experience
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
                            
                            // Reset animation
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

                    // Initial call
                    updatePagination(0);
                });
            </script>
        </div>
    </div>

    {{-- Scroll Indicator --}}
    <div class="absolute bottom-8 left-1/2 transform -translate-x-1/2 animate-bounce">
        <div class="w-6 h-10 border-2 border-blue-600 rounded-full flex justify-center p-2">
            <div class="w-1.5 h-3 bg-blue-600 rounded-full animate-scroll"></div>
        </div>
    </div>
</section>

{{-- ABOUT SECTION --}}
<section class="py-24 lg:py-32 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950 relative overflow-hidden">
    {{-- Animated Background --}}
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-0 left-0 w-96 h-96 bg-blue-500 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute bottom-0 right-0 w-96 h-96 bg-cyan-500 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute top-1/2 left-1/2 w-96 h-96 bg-blue-400 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="grid lg:grid-cols-2 gap-16 items-center">
            {{-- Left: Image --}}
            <div class="relative" data-aos="fade-right" data-aos-duration="1000">
                <div class="relative z-10" data-aos="zoom-in" data-aos-delay="200">
                    <div class="aspect-video rounded-3xl overflow-hidden shadow-2xl border-4 border-white/20 backdrop-blur-lg bg-white/5 hover:scale-105 transition-transform duration-700 group">
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
                {{-- Animated Decorative Elements --}}
                <div class="absolute -z-10 top-8 left-8 w-full h-full border-4 border-blue-400/30 rounded-3xl animate-border-glow" data-aos="fade" data-aos-delay="400"></div>
                <div class="absolute -z-20 -bottom-8 -right-8 w-72 h-72 bg-blue-500/30 rounded-full blur-3xl animate-pulse-glow"></div>
            </div>

            {{-- Right: Content --}}
            <div class="space-y-6" data-aos="fade-left" data-aos-duration="1000">
                <div class="inline-block" data-aos="zoom-in" data-aos-delay="200">
                    <span class="px-4 py-2 bg-blue-500/30 backdrop-blur-sm text-blue-100 rounded-full text-sm font-semibold uppercase tracking-wider border border-blue-400/30 shadow-lg">Tentang Kami</span>
                </div>
                
                <h2 class="text-4xl lg:text-5xl font-bold text-white leading-tight" data-aos="fade-up" data-aos-delay="300">
                    Himpunan Aktivis Siswa Muslim Indonesia
                </h2>

                <div class="w-20 h-1.5 bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-500 rounded-full animate-gradient" data-aos="fade-right" data-aos-delay="400"></div>

                <div class="space-y-4 text-blue-100 text-lg leading-relaxed">
                    <p data-aos="fade-up" data-aos-delay="500">
                        HASMI adalah organisasi pendidikan, dakwah, dan sosial yang berfokus membina generasi muda muslim Indonesia dengan pendekatan komprehensif dan berkelanjutan.
                    </p>
                    <p data-aos="fade-up" data-aos-delay="600">
                        Melalui berbagai program unggulan, kami membentuk karakter Islami yang kuat, berilmu, dan berkontribusi nyata bagi kemajuan umat dan bangsa.
                    </p>
                </div>

                {{-- Features with Animation --}}
                <div class="grid grid-cols-2 gap-4 pt-6">
                    <div class="flex items-start gap-3 bg-blue-800/30 backdrop-blur-sm p-4 rounded-xl border border-blue-400/20 hover:border-blue-400/50 hover:bg-blue-700/30 transition-all duration-500 hover:scale-105"
                         data-aos="fade-up" data-aos-delay="700">
                        <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg animate-pulse-slow">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Pendidikan Berkualitas</h4>
                            <p class="text-sm text-blue-200">Program pembelajaran terpadu</p>
                        </div>
                    </div>
                    <div class="flex items-start gap-3 bg-blue-800/30 backdrop-blur-sm p-4 rounded-xl border border-blue-400/20 hover:border-blue-400/50 hover:bg-blue-700/30 transition-all duration-500 hover:scale-105"
                         data-aos="fade-up" data-aos-delay="800">
                        <div class="w-10 h-10 bg-blue-500 rounded-xl flex items-center justify-center flex-shrink-0 shadow-lg animate-pulse-slow animation-delay-1000">
                            <i class="fas fa-check text-white"></i>
                        </div>
                        <div>
                            <h4 class="font-semibold text-white">Dakwah Aktif</h4>
                            <p class="text-sm text-blue-200">Menyebarkan nilai-nilai Islam</p>
                        </div>
                    </div>
                </div>

                <a href="{{ route('tentang') }}" 
                   class="inline-flex items-center gap-2 px-8 py-4 bg-white text-blue-900 rounded-2xl font-semibold shadow-2xl hover:shadow-blue-500/50 hover:scale-110 transition-all duration-500 group"
                   data-aos="fade-up" data-aos-delay="900">
                    <span>Selengkapnya</span>
                    <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform duration-300"></i>
                </a>
            </div>
        </div>
    </div>
</section>

{{-- VISI MISI SECTION --}}
<section class="py-24 lg:py-32 bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800 relative overflow-hidden">
    <div class="absolute top-0 right-0 w-1/3 h-full bg-blue-500 opacity-10 rounded-l-full blur-3xl animate-pulse-glow"></div>
    <div class="absolute bottom-0 left-0 w-1/3 h-full bg-cyan-500 opacity-10 rounded-r-full blur-3xl animate-pulse-glow animation-delay-2000"></div>
    
    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="px-4 py-2 bg-blue-500/30 backdrop-blur-sm text-blue-100 rounded-full text-sm font-semibold uppercase tracking-wider border border-blue-400/30 shadow-lg" data-aos="zoom-in">Komitmen Kami</span>
            <h2 class="text-4xl lg:text-5xl font-bold text-white mt-6 mb-4" data-aos="fade-up" data-aos-delay="200">Visi & Misi</h2>
            <div class="w-24 h-1.5 bg-gradient-to-r from-blue-400 via-cyan-400 to-blue-500 rounded-full mx-auto animate-gradient" data-aos="fade" data-aos-delay="300"></div>
        </div>

        <div class="grid lg:grid-cols-2 gap-8 max-w-6xl mx-auto">
            {{-- Visi Card --}}
            <div class="group relative" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1000">
                <div class="absolute inset-0 bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl transform group-hover:scale-105 transition-transform duration-500 animate-gradient-slow"></div>
                <div class="relative bg-blue-800/40 backdrop-blur-xl rounded-3xl p-10 shadow-2xl border border-blue-400/30 transform group-hover:-translate-y-3 transition-all duration-500 hover:border-blue-300">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-2xl group-hover:rotate-12 group-hover:scale-110 transition-all duration-500">
                        <i class="fas fa-eye text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Visi</h3>
                    <p class="text-blue-100 text-lg leading-relaxed">
                        Menjadi organisasi terdepan dalam pembinaan generasi muslim yang berakhlak mulia, berilmu, dan bermanfaat bagi umat dan bangsa.
                    </p>
                    {{-- Decorative Corner --}}
                    <div class="absolute top-4 right-4 w-16 h-16 border-t-2 border-r-2 border-blue-300/30 rounded-tr-2xl group-hover:border-blue-200/50 transition-colors duration-500"></div>
                    <div class="absolute bottom-4 left-4 w-16 h-16 border-b-2 border-l-2 border-blue-300/30 rounded-bl-2xl group-hover:border-blue-200/50 transition-colors duration-500"></div>
                </div>
            </div>

            {{-- Misi Card --}}
            <div class="group relative" data-aos="fade-up" data-aos-delay="600" data-aos-duration="1000">
                <div class="absolute inset-0 bg-gradient-to-br from-cyan-500 to-blue-700 rounded-3xl transform group-hover:scale-105 transition-transform duration-500 animate-gradient-slow animation-delay-2000"></div>
                <div class="relative bg-blue-800/40 backdrop-blur-xl rounded-3xl p-10 shadow-2xl border border-blue-400/30 transform group-hover:-translate-y-3 transition-all duration-500 hover:border-blue-300">
                    <div class="w-16 h-16 bg-white rounded-2xl flex items-center justify-center mb-6 shadow-2xl group-hover:rotate-12 group-hover:scale-110 transition-all duration-500">
                        <i class="fas fa-bullseye text-blue-600 text-2xl"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-4">Misi</h3>
                    <p class="text-blue-100 text-lg leading-relaxed">
                        Menyelenggarakan program pendidikan, dakwah, dan sosial secara komprehensif dan berkelanjutan untuk kemajuan peradaban Islam.
                    </p>
                    {{-- Decorative Corner --}}
                    <div class="absolute top-4 right-4 w-16 h-16 border-t-2 border-r-2 border-blue-300/30 rounded-tr-2xl group-hover:border-blue-200/50 transition-colors duration-500"></div>
                    <div class="absolute bottom-4 left-4 w-16 h-16 border-b-2 border-l-2 border-blue-300/30 rounded-bl-2xl group-hover:border-blue-200/50 transition-colors duration-500"></div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- PROGRAM UNGGULAN --}}
<section class="py-24 lg:py-32 bg-gradient-to-br from-blue-900 via-blue-800 to-blue-950 relative overflow-hidden">
    {{-- Animated Background Elements --}}
    <div class="absolute inset-0 opacity-20">
        <div class="absolute top-1/4 left-1/4 w-64 h-64 bg-blue-500 rounded-full blur-3xl animate-blob"></div>
        <div class="absolute top-1/3 right-1/4 w-64 h-64 bg-cyan-500 rounded-full blur-3xl animate-blob animation-delay-2000"></div>
        <div class="absolute bottom-1/4 left-1/3 w-64 h-64 bg-blue-400 rounded-full blur-3xl animate-blob animation-delay-4000"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="px-4 py-2 bg-blue-500/30 backdrop-blur-sm text-blue-100 rounded-full text-sm font-semibold uppercase tracking-wider border border-blue-400/30 shadow-lg" data-aos="zoom-in">Program Kami</span>
            <h2 class="text-4xl lg:text-5xl font-bold text-white mt-6 mb-4" data-aos="fade-up" data-aos-delay="200">Program Unggulan</h2>
            <p class="text-blue-200 text-lg max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">Berbagai program terbaik untuk pembinaan generasi muslim Indonesia</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6 mb-12">
            @foreach($homePrograms as $index => $p)
            <a href="{{ route('program.show', $p->slug) }}" 
               class="group bg-blue-800/30 backdrop-blur-xl rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:shadow-blue-500/50 transition-all duration-500 hover:-translate-y-2 border border-blue-400/20 hover:border-blue-300"
               data-aos="fade-up" data-aos-delay="{{ $index * 100 }}" data-aos-duration="800">
                <div class="h-48 overflow-hidden relative">
                     @if($p->thumbnail)
                        <img src="{{ asset($p->thumbnail) }}" alt="{{ $p->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                     @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-600 to-blue-800">
                            <i class="fas fa-hand-holding-heart text-white text-5xl opacity-50 group-hover:scale-110 transition-transform duration-500"></i>
                        </div>
                     @endif
                     <div class="absolute inset-0 bg-gradient-to-t from-blue-900/90 to-transparent"></div>
                     <div class="absolute bottom-4 left-4">
                        <span class="px-3 py-1 bg-blue-500/80 backdrop-blur-sm rounded-lg text-xs font-bold text-white uppercase tracking-wider shadow-lg">
                            {{ $p->category->name ?? 'Program' }}
                        </span>
                     </div>
                </div>
                <div class="p-6">
                    <h3 class="text-white text-lg font-bold mb-2 line-clamp-2 group-hover:text-blue-200 transition-colors">{{ $p->title }}</h3>
                    <p class="text-blue-200 text-sm line-clamp-2 mb-4">{{ \Illuminate\Support\Str::limit(strip_tags($p->description), 80) }}</p>
                    <div class="flex items-center text-blue-300 text-sm font-semibold group-hover:gap-2 transition-all">
                        <span>Lihat Program</span>
                        <i class="fas fa-arrow-right ml-2 text-xs"></i>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center" data-aos="fade-up" data-aos-delay="600">
            <a href="{{ route('program.index') }}" class="inline-flex items-center gap-2 text-blue-200 font-semibold hover:gap-4 transition-all group px-6 py-3 bg-blue-800/30 backdrop-blur-sm rounded-full border border-blue-400/30 hover:bg-blue-700/40 hover:border-blue-300">
                <span>Lihat Semua Program</span>
                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

{{-- MATERI PEMBELAJARAN --}}
<section class="py-24 lg:py-32 bg-gradient-to-br from-blue-950 via-blue-900 to-blue-800">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="px-4 py-2 bg-blue-500/30 backdrop-blur-sm text-blue-100 rounded-full text-sm font-semibold uppercase tracking-wider border border-blue-400/30 shadow-lg" data-aos="zoom-in">Pembelajaran</span>
            <h2 class="text-4xl lg:text-5xl font-bold text-white mt-6 mb-4" data-aos="fade-up" data-aos-delay="200">Materi Terbaru</h2>
            <p class="text-blue-200 text-lg max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">Artikel dan materi pembelajaran untuk pemahaman agama yang lebih baik</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($homeArticles as $index => $article)
            <article class="group bg-blue-800/30 backdrop-blur-xl rounded-2xl overflow-hidden shadow-2xl hover:shadow-blue-500/50 transition-all duration-500 hover:-translate-y-3 border-2 border-blue-400/30 hover:border-blue-300 hover:bg-blue-700/40"
                     data-aos="fade-up" data-aos-delay="{{ $index * 150 }}" data-aos-duration="800">
                <div class="h-56 overflow-hidden relative">
                    @if($article->thumbnail)
                        <img src="{{ asset($article->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-125 group-hover:rotate-3 transition-all duration-700" loading="lazy">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-600 to-blue-800">
                            <i class="fas fa-book-open text-white text-5xl opacity-50 group-hover:scale-110 transition-transform duration-500"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-950 via-transparent to-transparent opacity-60"></div>
                    <div class="absolute top-4 left-4" data-aos="fade-right" data-aos-delay="{{ ($index * 150) + 100 }}">
                        <span class="px-3 py-1.5 bg-blue-500 backdrop-blur-sm text-white text-xs font-semibold rounded-full uppercase tracking-wider shadow-xl border border-blue-300/50 animate-pulse-slow">
                            {{ $article->category->name }}
                        </span>
                    </div>
                </div>
                <div class="p-6">
                    <h3 class="text-white font-bold text-xl mb-3 line-clamp-2 group-hover:text-blue-200 transition-colors leading-tight"
                        data-aos="fade-up" data-aos-delay="{{ ($index * 150) + 200 }}">
                        {{ $article->title }}
                    </h3>
                    <div class="flex items-center gap-2 text-blue-300 text-sm mb-4" data-aos="fade-up" data-aos-delay="{{ ($index * 150) + 300 }}">
                        <i class="far fa-clock"></i>
                        <span>{{ $article->published_at ? $article->published_at->diffForHumans() : $article->created_at->diffForHumans() }}</span>
                    </div>
                    <a href="{{ route('materi.detail', [$article->category->slug, $article->slug]) }}" 
                       class="inline-flex items-center gap-2 text-blue-300 font-semibold hover:gap-4 transition-all group"
                       data-aos="fade-up" data-aos-delay="{{ ($index * 150) + 400 }}">
                        <span>Baca Selengkapnya</span>
                        <i class="fas fa-arrow-right text-sm group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
                
                {{-- Hover Glow Effect --}}
                <div class="absolute inset-0 rounded-2xl opacity-0 group-hover:opacity-100 transition-opacity duration-500 pointer-events-none">
                    <div class="absolute inset-0 bg-gradient-to-r from-blue-500/20 to-cyan-500/20 blur-xl"></div>
                </div>
            </article>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="600">
            <a href="{{ route('materi.index') }}" 
               class="inline-flex items-center gap-2 px-8 py-4 bg-white text-blue-900 rounded-2xl font-semibold shadow-2xl hover:shadow-blue-500/50 hover:scale-110 transition-all duration-500 group">
                <span>Lihat Semua Materi</span>
                <i class="fas fa-arrow-right group-hover:translate-x-2 transition-transform duration-300"></i>
            </a>
        </div>
    </div>
</section>

{{-- INTISARI SECTION --}}
<section class="py-24 lg:py-32 bg-gradient-to-br from-blue-600 to-blue-800 relative overflow-hidden">
    {{-- Animated Background --}}
    <div class="absolute inset-0 opacity-10">
        <div class="absolute top-0 left-0 w-full h-full bg-gradient-to-br from-white to-transparent animate-gradient-slow"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="px-4 py-2 bg-blue-500/30 backdrop-blur-sm text-blue-100 rounded-full text-sm font-semibold uppercase tracking-wider border border-blue-400/30 shadow-lg" data-aos="zoom-in">Publikasi</span>
            <h2 class="text-4xl lg:text-5xl font-bold text-white mt-6 mb-4" data-aos="fade-up" data-aos-delay="200">Intisari HASMI</h2>
            <p class="text-blue-200 text-lg max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">Kumpulan materi dan ringkasan pembelajaran dalam bentuk publikasi</p>
        </div>

        <div class="grid grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($homeIntisari as $index => $i)
            <a href="{{ route('intisari.show', $i->slug) }}" 
               class="group relative h-80 rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:shadow-purple-500/50 transition-all duration-500 hover:-translate-y-2"
               data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                
                @if($i->thumbnail_url)
                    <img src="{{ $i->thumbnail_url }}" alt="{{ $i->title }}" class="absolute inset-0 w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                @else
                    <div class="absolute inset-0 bg-gradient-to-br from-purple-600 to-indigo-800 group-hover:scale-110 transition-transform duration-700"></div>
                @endif
                
                <div class="absolute inset-0 bg-gradient-to-t from-black via-black/50 to-transparent opacity-80 group-hover:opacity-90 transition-opacity"></div>
                
                <div class="absolute bottom-0 left-0 right-0 p-6 translate-y-2 group-hover:translate-y-0 transition-transform duration-300">
                    <span class="inline-block px-3 py-1 rounded-lg bg-purple-500/30 backdrop-blur-md border border-purple-400/30 text-purple-200 text-xs font-bold mb-3">
                        Intisari
                    </span>
                    <h3 class="text-white text-lg font-bold leading-tight line-clamp-2 mb-2 group-hover:text-purple-300 transition-colors">
                        {{ $i->title }}
                    </h3>
                    <p class="text-gray-300 text-sm line-clamp-2 opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                        {{ \Illuminate\Support\Str::limit(strip_tags($i->content), 80) }}
                    </p>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="500">
            <a href="{{ route('intisari.index') }}" class="inline-flex items-center gap-2 text-blue-200 font-semibold hover:gap-4 transition-all group px-6 py-3 bg-blue-800/30 backdrop-blur-sm rounded-full border border-blue-400/30 hover:bg-blue-700/40 hover:border-blue-300">
                <span>Lihat Semua Intisari</span>
                <i class="fas fa-arrow-right group-hover:translate-x-1 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

</section>

{{-- KEGIATAN SECTION --}}
<section class="py-24 lg:py-32 bg-blue-50 relative overflow-hidden" id="kegiatan">
    {{-- Animated Background --}}
    <div class="absolute inset-0 opacity-5">
        <div class="absolute inset-0 bg-[url('https://t4.ftcdn.net/jpg/04/79/11/48/360_F_479114881_0d050529_e08d_4a0e_8c0e_8b0b5b5b5b5b.jpg')] bg-cover bg-center mix-blend-overlay"></div>
    </div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="px-4 py-2 bg-blue-100 text-blue-600 rounded-full text-sm font-semibold uppercase tracking-wider border border-blue-200 shadow-sm" data-aos="zoom-in">Aktivitas</span>
            <h2 class="text-4xl lg:text-5xl font-bold text-slate-800 mt-6 mb-4" data-aos="fade-up" data-aos-delay="200">Kegiatan HASMI</h2>
            <p class="text-slate-600 text-lg max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="300">Dokumentasi kegiatan dan agenda dakwah terbaru</p>
        </div>

        <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-6">
            @foreach($homeKegiatan as $index => $k)
            <a href="{{ route('kegiatan.show', $k->slug) }}" 
               class="group bg-white rounded-2xl overflow-hidden shadow-xl hover:shadow-2xl hover:shadow-blue-200 transition-all duration-500 hover:-translate-y-2 border border-slate-100 hover:border-blue-300"
               data-aos="fade-up" data-aos-delay="{{ $index * 100 }}">
                <div class="h-48 overflow-hidden relative">
                    @if($k->thumbnail_url)
                        <img src="{{ $k->thumbnail_url }}" alt="{{ $k->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-slate-100 to-slate-200">
                            <i class="fas fa-images text-slate-400 text-5xl group-hover:scale-110 transition-transform duration-500"></i>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 to-transparent opacity-80"></div>
                    <div class="absolute bottom-3 left-3 right-3 flex justify-between items-end">
                        <div class="bg-white/90 backdrop-blur-md px-3 py-1 rounded-lg text-xs font-bold text-blue-700 shadow-md">
                            <i class="far fa-calendar-alt mr-1"></i>
                            {{ $k->event_date ? \Carbon\Carbon::parse($k->event_date)->isoFormat('D MMM Y') : \Carbon\Carbon::parse($k->created_at)->isoFormat('D MMM Y') }}
                        </div>
                    </div>
                </div>
                <div class="p-5">
                    <h3 class="text-slate-800 text-lg font-bold mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors leading-tight">{{ $k->title }}</h3>
                    <div class="flex items-center text-slate-500 text-sm group-hover:text-blue-500 transition-colors">
                        <span>Lihat Dokumentasi</span>
                        <i class="fas fa-arrow-right ml-2 text-xs group-hover:translate-x-1 transition-transform"></i>
                    </div>
                </div>
            </a>
            @endforeach
        </div>

        <div class="text-center mt-12" data-aos="fade-up" data-aos-delay="500">
            <a href="{{ route('kegiatan.index') }}" class="inline-flex items-center gap-3 px-8 py-3 bg-blue-600 text-white rounded-full font-bold hover:bg-blue-700 transition-all group shadow-lg shadow-blue-500/30 hover:shadow-blue-500/50">
                <span>Galeri Kegiatan</span>
                <i class="fas fa-images group-hover:rotate-12 transition-transform"></i>
            </a>
        </div>
    </div>
</section>

{{-- EXTERNAL LINKS (LAYANAN KAMI) --}}
<section class="py-24 lg:py-32 bg-white relative overflow-hidden">
    {{-- Decorative Elements --}}
    <div class="absolute top-0 left-1/2 -translate-x-1/2 w-full h-[500px] bg-blue-100 blur-[120px] rounded-full pointer-events-none"></div>

    <div class="container mx-auto px-6 lg:px-12 relative z-10">
        <div class="text-center mb-16" data-aos="fade-up">
            <span class="px-4 py-2 bg-blue-50 text-blue-600 rounded-full text-sm font-semibold uppercase tracking-wider border border-blue-100">Layanan Kami</span>
            <h2 class="text-4xl lg:text-5xl font-bold text-slate-800 mt-6 mb-4">Kontribusi Untuk Umat</h2>
        </div>

        <div class="grid md:grid-cols-3 gap-8 max-w-6xl mx-auto">
            <a href="https://donasi.hasmi.org/" target="_blank" 
               class="group relative overflow-hidden bg-white rounded-3xl p-10 text-slate-700 shadow-2xl shadow-blue-100 hover:shadow-blue-200 transition-all duration-300 hover:-translate-y-2 border border-slate-100 hover:border-blue-200"
               data-aos="fade-up" data-aos-delay="100">
                <div class="relative z-10 text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-blue-500/30">
                        <i class="fas fa-hand-holding-heart text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-slate-800">Donasi</h3>
                    <p class="text-slate-500 leading-relaxed">Salurkan donasi terbaik Anda untuk kemajuan dakwah dan pendidikan Islam</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-b from-blue-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>

            <a href="https://beasiswapendidikanislam.com/" target="_blank" 
               class="group relative overflow-hidden bg-white rounded-3xl p-10 text-slate-700 shadow-2xl shadow-blue-100 hover:shadow-blue-200 transition-all duration-300 hover:-translate-y-2 border border-slate-100 hover:border-blue-200"
               data-aos="fade-up" data-aos-delay="200">
                <div class="relative z-10 text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-indigo-500 to-indigo-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-indigo-500/30">
                        <i class="fas fa-user-graduate text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-slate-800">Beasiswa</h3>
                    <p class="text-slate-500 leading-relaxed">Program beasiswa pendidikan Islam untuk mencetak kader dai berkualitas</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-b from-indigo-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>

            <a href="https://hasmipeduli.org/" target="_blank" 
               class="group relative overflow-hidden bg-white rounded-3xl p-10 text-slate-700 shadow-2xl shadow-blue-100 hover:shadow-blue-200 transition-all duration-300 hover:-translate-y-2 border border-slate-100 hover:border-blue-200"
               data-aos="fade-up" data-aos-delay="300">
                <div class="relative z-10 text-center">
                    <div class="w-20 h-20 bg-gradient-to-br from-cyan-500 to-cyan-600 rounded-2xl flex items-center justify-center mx-auto mb-6 group-hover:scale-110 group-hover:rotate-6 transition-all duration-300 shadow-lg shadow-cyan-500/30">
                        <i class="fas fa-hands-helping text-3xl text-white"></i>
                    </div>
                    <h3 class="text-2xl font-bold mb-3 text-slate-800">Sosial</h3>
                    <p class="text-slate-500 leading-relaxed">Aksi sosial dan kemanusiaan untuk membantu sesama yang membutuhkan</p>
                </div>
                <div class="absolute inset-0 bg-gradient-to-b from-cyan-50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            </a>
        </div>
    </div>
</section>

@endsection

{{-- STYLES --}}
<style>
/* Global Styles */
* {
    scroll-behavior: smooth;
}

body {
    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
    background: linear-gradient(to bottom, #1e3a8a, #1e40af);
}

/* Islamic Pattern Background */
.islamic-pattern {
    position: absolute;
    inset: 0;
    background-image: 
        radial-gradient(circle at 20% 50%, rgba(59, 130, 246, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 80% 50%, rgba(147, 197, 253, 0.15) 0%, transparent 50%),
        radial-gradient(circle at 50% 20%, rgba(96, 165, 250, 0.1) 0%, transparent 50%);
    background-size: 800px 800px;
    animation: patternMove 25s ease-in-out infinite;
}

@keyframes patternMove {
    0%, 100% { transform: translate(0, 0) rotate(0deg); }
    33% { transform: translate(-40px, 40px) rotate(2deg); }
    66% { transform: translate(40px, -40px) rotate(-2deg); }
}

/* Floating Orbs - More Dynamic */
.floating-orb {
    position: absolute;
    border-radius: 50%;
    filter: blur(100px);
    animation: float 20s ease-in-out infinite;
    opacity: 0.6;
}

.orb-1 {
    width: 500px;
    height: 500px;
    background: linear-gradient(135deg, #3b82f6 0%, #60a5fa 100%);
    top: -150px;
    left: -150px;
    animation-delay: 0s;
}

.orb-2 {
    width: 400px;
    height: 400px;
    background: linear-gradient(135deg, #60a5fa 0%, #93c5fd 100%);
    bottom: -100px;
    right: 15%;
    animation-delay: 5s;
}

.orb-3 {
    width: 350px;
    height: 350px;
    background: linear-gradient(135deg, #93c5fd 0%, #dbeafe 100%);
    top: 30%;
    right: -120px;
    animation-delay: 10s;
}

.orb-4 {
    width: 300px;
    height: 300px;
    background: linear-gradient(135deg, #2563eb 0%, #3b82f6 100%);
    bottom: 20%;
    left: 30%;
    animation-delay: 3s;
}

.orb-5 {
    width: 280px;
    height: 280px;
    background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 100%);
    top: 50%;
    left: 10%;
    animation-delay: 8s;
}

@keyframes float {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(50px, -50px) scale(1.15); }
    50% { transform: translate(-30px, 40px) scale(0.95); }
    75% { transform: translate(40px, 30px) scale(1.05); }
}

/* Particles Animation */
.particles {
    position: absolute;
    inset: 0;
}

.particle {
    position: absolute;
    width: 4px;
    height: 4px;
    background: rgba(255, 255, 255, 0.5);
    border-radius: 50%;
    animation: particleFloat var(--duration, 15s) ease-in-out infinite;
    animation-delay: var(--delay, 0s);
    top: calc(50% + (var(--delay) * 10px));
    left: calc(50% + (var(--delay) * 15px));
    box-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
}

@keyframes particleFloat {
    0%, 100% { 
        transform: translate(0, 0) scale(0.5);
        opacity: 0;
    }
    25% { 
        transform: translate(100px, -100px) scale(1);
        opacity: 1;
    }
    50% { 
        transform: translate(-80px, -200px) scale(0.8);
        opacity: 0.7;
    }
    75% { 
        transform: translate(150px, -150px) scale(1.2);
        opacity: 0.9;
    }
}

/* Gradient Text Animation */
@keyframes gradient {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-gradient {
    background-size: 200% 200%;
    animation: gradient 5s ease infinite;
}

@keyframes gradient-slow {
    0%, 100% { background-position: 0% 50%; }
    50% { background-position: 100% 50%; }
}

.animate-gradient-slow {
    background-size: 200% 200%;
    animation: gradient-slow 10s ease infinite;
}

/* Pulse Slow Animation */
@keyframes pulse-slow {
    0%, 100% { opacity: 1; transform: scale(1); }
    50% { opacity: 0.8; transform: scale(1.05); }
}

.animate-pulse-slow {
    animation: pulse-slow 4s ease-in-out infinite;
}

/* Pulse Glow Animation */
@keyframes pulse-glow {
    0%, 100% { opacity: 0.3; transform: scale(0.95); }
    50% { opacity: 0.6; transform: scale(1.1); }
}

.animate-pulse-glow {
    animation: pulse-glow 5s ease-in-out infinite;
}

/* Blob Animation */
@keyframes blob {
    0%, 100% { transform: translate(0, 0) scale(1); }
    25% { transform: translate(30px, -50px) scale(1.1); }
    50% { transform: translate(-20px, 20px) scale(0.9); }
    75% { transform: translate(40px, 30px) scale(1.05); }
}

.animate-blob {
    animation: blob 15s infinite ease-in-out;
}

/* Border Glow Animation */
@keyframes border-glow {
    0%, 100% { 
        border-color: rgba(59, 130, 246, 0.3);
        box-shadow: 0 0 20px rgba(59, 130, 246, 0.2);
    }
    50% { 
        border-color: rgba(59, 130, 246, 0.8);
        box-shadow: 0 0 40px rgba(59, 130, 246, 0.5);
    }
}

.animate-border-glow {
    animation: border-glow 3s ease-in-out infinite;
}

/* Float Slow Animation */
@keyframes float-slow {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(-20px) rotate(3deg); }
}

.animate-float-slow {
    animation: float-slow 6s ease-in-out infinite;
}

/* Float Reverse Animation */
@keyframes float-reverse {
    0%, 100% { transform: translateY(0) rotate(0deg); }
    50% { transform: translateY(20px) rotate(-3deg); }
}

.animate-float-reverse {
    animation: float-reverse 7s ease-in-out infinite;
}

/* Scroll Animation */
@keyframes scroll {
    0% { transform: translateY(0); opacity: 0; }
    50% { opacity: 1; }
    100% { transform: translateY(12px); opacity: 0; }
}

.animate-scroll {
    animation: scroll 2s ease-in-out infinite;
}

/* Hover Glow Effect */
.hover-glow {
    position: relative;
    overflow: hidden;
}

.hover-glow::before {
    content: '';
    position: absolute;
    top: 50%;
    left: 50%;
    width: 0;
    height: 0;
    border-radius: 50%;
    background: rgba(255, 255, 255, 0.3);
    transform: translate(-50%, -50%);
    transition: width 0.6s, height 0.6s;
}

.hover-glow:hover::before {
    width: 300px;
    height: 300px;
}

/* Slide Zoom Effect */
.slide-zoom {
    transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1);
}

.swiper-slide-active .slide-zoom {
    animation: slideZoom 0.8s ease-out;
}

@keyframes slideZoom {
    0% { transform: scale(1.2); }
    100% { transform: scale(1); }
}

/* Slide Content Animations */
.slide-content > * {
    animation: slideUp 0.6s ease-out backwards;
}

.slide-fade {
    animation-delay: 0.2s;
}

.slide-fade-delay {
    animation-delay: 0.4s;
}

.slide-fade-delay-2 {
    animation-delay: 0.6s;
}

@keyframes slideUp {
    0% {
        opacity: 0;
        transform: translateY(30px);
    }
    100% {
        opacity: 1;
        transform: translateY(0);
    }
}

/* Animation Delays */
.animation-delay-1000 {
    animation-delay: 1s;
}

.animation-delay-2000 {
    animation-delay: 2s;
}

.animation-delay-3000 {
    animation-delay: 3s;
}

.animation-delay-4000 {
    animation-delay: 4s;
}

/* Line Clamp */
.line-clamp-2 {
    display: -webkit-box;
    -webkit-line-clamp: 2;
    -webkit-box-orient: vertical;
    overflow: hidden;
}

/* Swiper Customization */
.heroSwiper .swiper-pagination {
    bottom: 24px !important;
}

.heroSwiper .swiper-pagination-bullet {
    width: 12px;
    height: 12px;
    background: rgba(255, 255, 255, 0.5) !important;
    opacity: 1 !important;
    transition: all 0.4s ease;
    border: 2px solid transparent;
}

.heroSwiper .swiper-pagination-bullet-active {
    background: #3b82f6 !important;
    width: 40px !important;
    border-radius: 8px !important;
    border-color: rgba(255, 255, 255, 0.5);
    box-shadow: 0 0 20px rgba(59, 130, 246, 0.8);
}

/* Custom Scrollbar */
::-webkit-scrollbar {
    width: 14px;
}

::-webkit-scrollbar-track {
    background: linear-gradient(to bottom, #1e3a8a, #1e40af);
}

::-webkit-scrollbar-thumb {
    background: linear-gradient(to bottom, #3b82f6, #2563eb);
    border-radius: 7px;
    border: 3px solid #1e40af;
}

::-webkit-scrollbar-thumb:hover {
    background: linear-gradient(to bottom, #60a5fa, #3b82f6);
}

/* Responsive adjustments */
@media (max-width: 768px) {
    .floating-orb {
        opacity: 0.3;
    }
    
    .particle {
        display: none;
    }
}

/* Shimmer Effect */
@keyframes shimmer {
    0% { background-position: -1000px 0; }
    100% { background-position: 1000px 0; }
}

.shimmer {
    background: linear-gradient(90deg, transparent, rgba(255,255,255,0.1), transparent);
    background-size: 1000px 100%;
    animation: shimmer 3s infinite;
}
</style>

{{-- SCRIPTS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize AOS with custom settings
    AOS.init({
        duration: 1000,
        easing: 'ease-out-cubic',
        once: false,
        offset: 100,
        delay: 100,
        mirror: true,
        anchorPlacement: 'top-bottom',
    });

    // Refresh AOS on window resize
    window.addEventListener('resize', () => {
        AOS.refresh();
    });

    // Initialize Swiper with enhanced effects
    const swiper = new Swiper(".heroSwiper", {
        loop: true,
        autoplay: {
            delay: 5000,
            disableOnInteraction: false,
            pauseOnMouseEnter: true,
        },
        pagination: {
            el: ".swiper-pagination",
            clickable: true,
            dynamicBullets: false,
        },
        effect: "creative",
        creativeEffect: {
            prev: {
                shadow: true,
                translate: ["-20%", 0, -1],
                opacity: 0.8,
            },
            next: {
                translate: ["100%", 0, 0],
                opacity: 0,
            },
        },
        speed: 1000,
        on: {
            slideChangeTransitionStart: function() {
                // Add slide transition effects
                const activeSlide = this.slides[this.activeIndex];
                activeSlide.classList.add('slide-active-animation');
            },
            slideChangeTransitionEnd: function() {
                // Clean up
                this.slides.forEach(slide => {
                    slide.classList.remove('slide-active-animation');
                });
            }
        }
    });

    // Enhanced Counter Animation with Intersection Observer
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
                        // Add completion animation
                        counter.style.transform = 'scale(1.2)';
                        setTimeout(() => {
                            counter.style.transform = 'scale(1)';
                        }, 200);
                    }
                };
                
                counter.style.transition = 'transform 0.2s ease';
                updateCount();
                counterObserver.unobserve(counter);
            }
        });
    }, observerOptions);

    counters.forEach(counter => counterObserver.observe(counter));

    // Smooth scroll for anchor links
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

    // Enhanced Parallax effect on scroll
    let ticking = false;
    window.addEventListener('scroll', () => {
        if (!ticking) {
            window.requestAnimationFrame(() => {
                const scrolled = window.pageYOffset;
                const parallaxElements = document.querySelectorAll('.floating-orb');
                
                parallaxElements.forEach((el, index) => {
                    const speed = 0.15 + (index * 0.05);
                    const yPos = -(scrolled * speed);
                    el.style.transform = `translateY(${yPos}px)`;
                });

                // Parallax for particles
                const particles = document.querySelectorAll('.particle');
                particles.forEach((particle, index) => {
                    const speed = 0.05 + (index * 0.01);
                    const yPos = -(scrolled * speed);
                    particle.style.transform = `translateY(${yPos}px)`;
                });

                ticking = false;
            });
            ticking = true;
        }
    });

    // Add hover effect to cards
    const cards = document.querySelectorAll('[data-aos]');
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) scale(1.02)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) scale(1)';
        });
    });

    // Magnetic button effect
    const buttons = document.querySelectorAll('a[class*="group"], button');
    buttons.forEach(button => {
        button.addEventListener('mousemove', function(e) {
            const rect = this.getBoundingClientRect();
            const x = e.clientX - rect.left - rect.width / 2;
            const y = e.clientY - rect.top - rect.height / 2;
            
            this.style.transform = `translate(${x * 0.1}px, ${y * 0.1}px)`;
        });
        
        button.addEventListener('mouseleave', function() {
            this.style.transform = 'translate(0, 0)';
        });
    });

    // Intersection Observer for fade-in animations
    const fadeElements = document.querySelectorAll('article, section > div');
    const fadeObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = '1';
                entry.target.style.transform = 'translateY(0)';
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '50px'
    });

    fadeElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        fadeObserver.observe(el);
    });

    // Add loading animation
    window.addEventListener('load', function() {
        document.body.style.opacity = '0';
        setTimeout(() => {
            document.body.style.transition = 'opacity 0.5s ease';
            document.body.style.opacity = '1';
        }, 100);
    });

    // Cursor trail effect (optional, can be removed if too much)
    let cursor = document.createElement('div');
    cursor.className = 'cursor-trail';
    cursor.style.cssText = `
        position: fixed;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.3), transparent);
        pointer-events: none;
        z-index: 9999;
        transition: transform 0.15s ease;
        display: none;
    `;
    document.body.appendChild(cursor);

    document.addEventListener('mousemove', (e) => {
        cursor.style.display = 'block';
        cursor.style.left = e.clientX - 10 + 'px';
        cursor.style.top = e.clientY - 10 + 'px';
    });

    // Hide scroll indicator after scroll
    const scrollIndicator = document.querySelector('.animate-bounce');
    if (scrollIndicator) {
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                scrollIndicator.style.opacity = '0';
                scrollIndicator.style.pointerEvents = 'none';
            } else {
                scrollIndicator.style.opacity = '1';
                scrollIndicator.style.pointerEvents = 'auto';
            }
        });
    }

    // Add shimmer effect to images when they load
    const images = document.querySelectorAll('img');
    images.forEach(img => {
        img.addEventListener('load', function() {
            this.style.animation = 'fadeIn 0.5s ease';
        });
    });
});

// Add CSS for fadeIn animation
const style = document.createElement('style');
style.textContent = `
    @keyframes fadeIn {
        from { opacity: 0; transform: scale(0.95); }
        to { opacity: 1; transform: scale(1); }
    }
    
    .slide-active-animation {
        animation: slideAppear 0.8s ease-out;
    }
    
    @keyframes slideAppear {
        from {
            opacity: 0;
            transform: scale(1.1);
        }
        to {
            opacity: 1;
            transform: scale(1);
        }
    }
`;
document.head.appendChild(style);
</script>