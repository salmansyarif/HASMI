@extends('layouts.app')

@section('title', $berita->title . ' - Berita Terkini HASMI')

@section('content')
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        .prose p {
            margin-bottom: 1.5rem;
            color: #dbeafe;
            line-height: 1.8;
        }

        .prose strong {
            color: white;
        }

        .gallery-img {
            transition: transform 0.3s ease;
            cursor: pointer;
        }

        .gallery-img:hover {
            transform: scale(1.05);
        }
    </style>

    <div class="bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 min-h-screen text-white">

        {{-- Breadcrumb --}}
        <div class="container mx-auto px-6 py-8">
            <nav class="flex text-sm text-blue-100 mb-8">
                <a href="{{ route('home') }}" class="hover:text-white transition-colors">Home</a>
                <span class="mx-2">/</span>
                <a href="{{ route('berita-terkini.index') }}" class="hover:text-white transition-colors">Berita Terkini</a>
                <span class="mx-2">/</span>
                <span class="text-white font-semibold truncate">{{ Str::limit($berita->title, 40) }}</span>
            </nav>
        </div>

        <div class="container mx-auto px-6 pb-20">
            <div class="max-w-4xl mx-auto">

                {{-- Header --}}
                <div class="mb-10 text-center" data-aos="fade-up">
                    <div
                        class="inline-block px-4 py-2 bg-blue-500/50 rounded-full text-blue-50 text-sm font-semibold mb-4 border border-blue-300/50">
                        {{ $berita->created_at->format('l, d F Y') }}
                    </div>
                    <h1 class="text-3xl md:text-5xl font-bold leading-tight mb-6">{{ $berita->title }}</h1>
                    <div class="flex justify-center items-center gap-6 text-sm text-blue-100">
                        <div class="flex items-center gap-2">
                            <i class="far fa-eye"></i>
                            <span>{{ $berita->views }} Dilihat</span>
                        </div>
                    </div>
                </div>

                {{-- Main Media (Video or Thumbnail) --}}
                <div class="mb-12 rounded-3xl overflow-hidden shadow-2xl border border-blue-400/30 bg-blue-600/30"
                    data-aos="zoom-in">
                    @if ($berita->video_url)
                        <div class="aspect-video w-full relative">
                            @if (Str::contains($berita->video_url, 'youtube.com') || Str::contains($berita->video_url, 'youtu.be'))
                                <x-lite-youtube :videoId="$berita->video_url" :title="$berita->title" />
                            @else
                                <video controls class="w-full h-full object-cover">
                                    <source src="{{ asset('storage/' . $berita->video_url) }}" type="video/mp4">
                                    Browser anda tidak mendukung tag video.
                                </video>
                            @endif
                        </div>
                    @elseif($berita->thumbnail)
                        <img src="{{ $berita->getThumbnailUrl() }}" alt="{{ $berita->title }}"
                            class="w-full h-auto object-cover">
                    @endif
                </div>

                {{-- Content --}}
                <article class="prose prose-lg max-w-none mb-16 bg-blue-700/30 p-8 rounded-3xl border border-blue-500/30"
                    data-aos="fade-up">
                    {!! nl2br(e($berita->content)) !!}
                </article>

                {{-- Photo Gallery --}}
                @if ($berita->hasPhotos())
                    <div class="mb-16" data-aos="fade-up">
                        <h3 class="text-2xl font-bold mb-8 flex items-center gap-3 border-b border-blue-500/30 pb-4">
                            <i class="fas fa-camera text-blue-300"></i> Galeri Dokumentasi
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach ($berita->photos as $index => $photo)
                                <div class="aspect-square rounded-xl overflow-hidden shadow-lg border border-blue-400/20"
                                    onclick="window.open('{{ Storage::url($photo) }}', '_blank')">
                                    <img src="{{ Storage::url($photo) }}"
                                        class="gallery-img w-full h-full object-cover hover:scale-110 transition-transform duration-500"
                                        loading="lazy" alt="Dokumentasi {{ $index + 1 }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Share --}}
                <div class="text-center pt-10 border-t border-blue-500/50" data-aos="fade-up">
                    <h4 class="text-blue-100 font-semibold mb-6">Bagikan Berita Ini</h4>
                    <div class="flex justify-center gap-4">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                            target="_blank"
                            class="w-12 h-12 rounded-full bg-blue-500 hover:bg-blue-400 flex items-center justify-center text-white transition-all transform hover:-translate-y-1 shadow-lg">
                            <i class="fab fa-facebook-f"></i>
                        </a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($berita->title . ' - ' . url()->current()) }}"
                            target="_blank"
                            class="w-12 h-12 rounded-full bg-green-500 hover:bg-green-400 flex items-center justify-center text-white transition-all transform hover:-translate-y-1 shadow-lg">
                            <i class="fab fa-whatsapp"></i>
                        </a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($berita->title) }}"
                            target="_blank"
                            class="w-12 h-12 rounded-full bg-sky-500 hover:bg-sky-400 flex items-center justify-center text-white transition-all transform hover:-translate-y-1 shadow-lg">
                            <i class="fab fa-twitter"></i>
                        </a>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <script src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-out-back',
                once: true
            });
        });
    </script>
@endsection
