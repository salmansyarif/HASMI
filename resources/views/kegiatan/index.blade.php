@extends('layouts.app')

@section('title', 'Dokumentasi Kegiatan - HASMI')

@section('content')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" />
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

<style>
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: linear-gradient(to bottom, #1d4ed8, #2563eb);
    }

    /* HERO SECTION */
    .hero-kegiatan {
        background: linear-gradient(135deg, #2563eb 0%, #1d4ed8 50%, #2563eb 100%);
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
        color: #bfdbfe !important;
        font-size: 1.25rem;
        line-height: 1.8;
        font-weight: 500;
        max-width: 800px;
        margin: 0 auto;
        text-shadow: 0 2px 8px rgba(0, 0, 0, 0.4);
    }

    /* Article Card Enhancements (Reused for Kegiatan) */
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
        fill: #1d4ed8;
    }
</style>

{{-- HERO SECTION --}}
<section class="hero-kegiatan">
    <div class="hero-pattern"></div>
    
    <div class="container mx-auto px-6 hero-content text-center">
        <div class="inline-block mb-6" data-aos="fade-down">
            <span class="px-5 py-2 bg-blue-500/40 backdrop-blur-md border border-blue-400/40 text-blue-50 rounded-full text-xs font-black uppercase tracking-[0.2em]">
                <i class="fas fa-archive mr-2"></i> Arsip Dokumentasi
            </span>
        </div>
        
        <h1 class="hero-title mb-8" data-aos="zoom-in">
            Laporan <span class="text-blue-300">Kegiatan</span>
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
<section class="py-20 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800">
    <div class="container mx-auto px-6 lg:px-12">
        <div class="grid md:grid-cols-2 lg:grid-cols-2 gap-10">
            @forelse($kegiatans as $index => $kegiatan)
            <article class="article-card group rounded-[2.5rem] overflow-hidden flex flex-col h-full"
                     data-aos="fade-up" data-aos-delay="{{ ($index % 3) * 100 }}">
                
                {{-- Thumbnail with Glow --}}
                <div class="h-80 relative overflow-hidden m-4 rounded-[2rem]">
                    @if($kegiatan->thumbnail)
                        <img src="{{ asset($kegiatan->thumbnail) }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110"
                             alt="{{ $kegiatan->title }}"
                             loading="lazy">
                    @else
                        <div class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                            <i class="fas fa-camera text-white/20 text-6xl"></i>
                        </div>
                    @endif
                    
                    {{-- Overlay Info --}}
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-all duration-500 flex items-end p-6">
                        <p class="text-white text-xs leading-relaxed italic">
                            "Klik untuk melihat dokumentasi lengkap."
                        </p>
                    </div>

                    {{-- Floating Badges --}}
                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                        <span class="px-4 py-2 bg-blue-500 text-white text-[10px] font-extrabold uppercase tracking-widest rounded-xl shadow-lg border border-blue-400/30">
                            Dokumentasi
                        </span>
                    </div>
                </div>

                {{-- Card Content --}}
                <div class="px-8 pb-8 pt-4 flex flex-col flex-grow">
                    <div class="flex items-center gap-2 mb-3">
                        <i class="far fa-calendar-alt text-blue-100 text-xs"></i>
                        <span class="text-blue-100 text-[11px] font-bold uppercase tracking-wider">
                            {{ $kegiatan->event_date ? $kegiatan->event_date->format('D M Y') : $kegiatan->created_at->format('D M Y') }}
                        </span>
                    </div>

                    <h3 class="text-2xl font-bold text-white mb-4 line-clamp-2 group-hover:text-blue-100 transition-colors leading-tight">
                        {{ $kegiatan->title }}
                    </h3>
                    
                    <p class="text-blue-100 text-sm leading-relaxed mb-8 line-clamp-3 font-medium">
                        {{ \Illuminate\Support\Str::limit(strip_tags($kegiatan->description), 100) }}
                    </p>
                    
                    <div class="mt-auto">
                        <a href="{{ route('kegiatan.show', $kegiatan->slug) }}" 
                           class="w-full py-4 bg-blue-500 group-hover:bg-blue-400 text-white rounded-2xl font-bold flex items-center justify-center gap-3 transition-all transform active:scale-95 shadow-xl shadow-blue-800/50 border-2 border-blue-400/40">
                            <span>Lihat Dokumentasi</span>
                            <i class="fas fa-arrow-right text-sm group-hover:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </article>
            @empty
            <div class="col-span-full">
                {{-- Empty State --}}
                <div class="max-w-2xl mx-auto text-center py-20 bg-blue-700/60 backdrop-blur-xl rounded-[40px] shadow-[0_0_80px_rgba(59,130,246,0.4)] border-2 border-blue-400/50" data-aos="zoom-in">
                    <div class="w-24 h-24 bg-blue-500 rounded-full flex items-center justify-center mx-auto mb-6 text-blue-100 text-4xl shadow-[0_0_40px_rgba(59,130,246,0.6)]">
                        <i class="fas fa-cloud-moon"></i>
                    </div>
                    <h3 class="text-2xl font-bold text-white mb-2">Belum Ada Dokumentasi</h3>
                    <p class="text-blue-50">Kami akan segera mengupdate laporan kegiatan terbaru dalam waktu dekat.</p>
                </div>
            </div>
            @endforelse
        </div>

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