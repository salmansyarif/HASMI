@extends('layouts.app')

@section('title', 'Dokumentasi Kegiatan - HASMI')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: linear-gradient(to bottom, #1e3a8a, #1e40af);
    }

    /* HERO SECTION */
    .hero-kegiatan {
        background: linear-gradient(135deg, #1e40af 0%, #1e3a8a 50%, #1e40af 100%);
        position: relative;
        overflow: hidden;
        min-height: 500px;
        display: flex;
        align-items: center;
    }

    .hero-kegiatan::before {
        content: '';
        position: absolute;
        inset: 0;
        background: rgba(0, 0, 0, 0.2);
        z-index: 1;
    }

    .hero-pattern {
        position: absolute;
        inset: 0;
        opacity: 0.15;
        z-index: 2;
        background-image: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='1'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }

    .hero-content {
        position: relative;
        z-index: 10;
    }

    .hero-title {
        font-size: 3.5rem;
        line-height: 1.1;
        font-weight: 800;
        color: #ffffff;
        text-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
    }

    .hero-description {
        color: #f1f5f9 !important;
        font-size: 1.25rem;
        line-height: 1.8;
        font-weight: 500;
        max-width: 800px;
        margin: 0 auto;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
    }

    /* KARTU KEGIATAN - FULL BIRU */
    .activity-card {
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
        border-radius: 30px;
        border: 1px solid rgba(59, 130, 246, 0.3);
        transition: all 0.4s ease;
    }

    .activity-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.5);
        border-color: rgba(96, 165, 250, 0.6);
    }

    .img-frame {
        border-radius: 24px;
        overflow: hidden;
    }

    /* Wave Divider */
    .wave-bottom {
        position: absolute;
        bottom: -1px;
        left: 0;
        width: 100%;
        line-height: 0;
        z-index: 5;
    }

    .wave-bottom svg {
        fill: #1e3a8a;
    }
</style>

{{-- HERO SECTION --}}
<section class="hero-kegiatan">
    <div class="hero-pattern"></div>
    
    <div class="container mx-auto px-6 hero-content text-center">
        <div class="inline-block mb-6" data-aos="fade-down">
            <span class="px-5 py-2 bg-blue-500/20 backdrop-blur-md border border-white/30 text-blue-100 rounded-full text-xs font-black uppercase tracking-[0.2em]">
                <i class="fas fa-archive mr-2"></i> Arsip Dokumentasi
            </span>
        </div>
        
        <h1 class="hero-title mb-8" data-aos="zoom-in">
            Laporan <span class="text-blue-200">Kegiatan</span>
        </h1>
        
        <p class="hero-description" data-aos="fade-up" data-aos-delay="200">
            "Jejak langkah dakwah, sosial, dan pendidikan HASMI dalam melayani umat di berbagai penjuru Indonesia."
        </p>
    </div>

    {{-- Wave Divider --}}
    <div class="wave-bottom">
        <svg viewBox="0 0 1440 120" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,64L80,69.3C160,75,320,85,480,80C640,75,800,53,960,48C1120,43,1280,53,1360,58.7L1440,64L1440,120L1360,120C1280,120,1120,120,960,120C800,120,640,120,480,120C320,120,160,120,80,120L0,120Z"></path>
        </svg>
    </div>
</section>

{{-- LIST SECTION - BACKGROUND BIRU --}}
<section class="py-20 bg-gradient-to-b from-blue-900 to-blue-800">
    <div class="container mx-auto px-6 lg:px-12">
        @forelse($kegiatans as $index => $kegiatan)
            @if($loop->first)
                <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            @endif

            <a href="{{ route('kegiatan.show', $kegiatan->slug) }}" class="activity-card group p-5" data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                {{-- Foto --}}
                <div class="img-frame h-60 mb-6 relative">
                    @if($kegiatan->thumbnail)
                        <img src="{{ asset($kegiatan->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700">
                    @else
                        <div class="w-full h-full bg-blue-800 flex items-center justify-center">
                            <i class="fas fa-camera text-blue-400 text-4xl"></i>
                        </div>
                    @endif
                    
                    {{-- Badge di atas foto --}}
                    <div class="absolute top-4 left-4 bg-blue-600 text-white text-[10px] font-bold px-3 py-1 rounded-full shadow-lg">
                        <i class="far fa-calendar-alt mr-1"></i> {{ $kegiatan->event_date ? $kegiatan->event_date->format('M Y') : 'Baru' }}
                    </div>
                </div>

                {{-- Detail --}}
                <div class="px-2">
                    <div class="text-blue-200 text-[10px] font-black uppercase tracking-widest mb-2 flex items-center gap-2">
                        <span class="w-6 h-[2px] bg-blue-300"></span>
                        {{ $kegiatan->location ?? 'NASIONAL' }}
                    </div>
                    
                    <h3 class="text-xl font-bold text-white mb-4 group-hover:text-blue-200 transition-colors line-clamp-2 leading-snug">
                        {{ $kegiatan->title }}
                    </h3>

                    <p class="text-blue-100 text-sm mb-6 line-clamp-2 leading-relaxed">
                        {{ $kegiatan->description }}
                    </p>

                    <div class="flex items-center justify-between pt-4 border-t border-blue-400/30">
                        <span class="text-xs font-bold text-blue-200 group-hover:text-white transition-colors">BACA DETAIL</span>
                        <i class="fas fa-arrow-right text-blue-300 group-hover:text-white group-hover:translate-x-2 transition-all"></i>
                    </div>
                </div>
            </a>

            @if($loop->last)
                </div>
            @endif
        @empty
            {{-- Empty State --}}
            <div class="max-w-2xl mx-auto text-center py-20 bg-blue-800 rounded-[40px] shadow-lg border border-blue-600" data-aos="zoom-in">
                <div class="w-24 h-24 bg-blue-700 rounded-full flex items-center justify-center mx-auto mb-6 text-blue-300 text-4xl">
                    <i class="fas fa-cloud-moon"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-2">Belum Ada Dokumentasi</h3>
                <p class="text-blue-200">Kami akan segera mengupdate laporan kegiatan terbaru dalam waktu dekat.</p>
            </div>
        @endforelse

        {{-- Pagination --}}
        @if($kegiatans->hasPages())
            <div class="mt-20 flex justify-center">
                {{ $kegiatans->links() }}
            </div>
        @endif
    </div>
</section>

<script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        AOS.init({ 
            duration: 800, 
            once: true,
            offset: 50 
        });
    });
</script>
@endsection