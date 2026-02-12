@extends('layouts.app')

@section('title', $program->title . ' - HASMI')

@section('content')

    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes slideInLeft {
            from {
                opacity: 0;
                transform: translateX(-30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes slideInRight {
            from {
                opacity: 0;
                transform: translateX(30px);
            }

            to {
                opacity: 1;
                transform: translateX(0);
            }
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        @keyframes pulse {

            0%,
            100% {
                opacity: 1;
            }

            50% {
                opacity: 0.8;
            }
        }

        @keyframes shimmer {
            0% {
                background-position: -1000px 0;
            }

            100% {
                background-position: 1000px 0;
            }
        }

        @keyframes scaleIn {
            from {
                opacity: 0;
                transform: scale(0.9);
            }

            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        .animate-fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }

        .animate-slide-in-left {
            animation: slideInLeft 0.5s ease-out forwards;
        }

        .animate-slide-in-right {
            animation: slideInRight 0.5s ease-out forwards;
        }

        .animate-float {
            animation: float 3s ease-in-out infinite;
        }

        .animate-scale-in {
            animation: scaleIn 0.5s ease-out forwards;
        }

        .prose {
            color: #e2e8f0;
            line-height: 1.8;
        }

        .prose h2 {
            font-size: 1.75rem;
            font-weight: 700;
            margin-top: 2rem;
            margin-bottom: 1rem;
            color: #ffffff;
        }

        .prose p {
            margin-bottom: 1.25rem;
        }

        .prose ul {
            list-style-type: disc;
            margin-left: 1.5rem;
            margin-bottom: 1.25rem;
        }

        .prose img {
            border-radius: 1rem;
            margin: 1.5rem 0;
            border: 2px solid rgba(59, 130, 246, 0.4);
        }

        .breadcrumb-link {
            transition: all 0.3s ease;
            position: relative;
        }

        .breadcrumb-link::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background: linear-gradient(90deg, #3b82f6, #60a5fa);
            transition: width 0.3s ease;
        }

        .breadcrumb-link:hover::after {
            width: 100%;
        }

        .badge-category {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .badge-category::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .badge-category:hover::before {
            left: 100%;
        }

        .badge-category:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(59, 130, 246, 0.5);
        }

        .badge-subcategory {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            transition: all 0.3s ease;
        }

        .badge-subcategory:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.4);
        }

        .media-container {
            position: relative;
            overflow: hidden;
            border-radius: 1.5rem;
            border: 2px solid rgba(59, 130, 246, 0.4);
            transition: all 0.4s ease;
        }

        .media-container:hover {
            border-color: rgba(59, 130, 246, 0.7);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.4);
            transform: translateY(-4px);
        }

        .gallery-item {
            cursor: pointer;
            overflow: hidden;
            border-radius: 1rem;
            border: 2px solid rgba(59, 130, 246, 0.3);
            position: relative;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gallery-item::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(59, 130, 246, 0.4) 0%, transparent 100%);
            opacity: 0;
            transition: opacity 0.4s ease;
            z-index: 1;
        }

        .gallery-item:hover::before {
            opacity: 1;
        }

        .gallery-item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .gallery-item:hover {
            transform: translateY(-8px);
            border-color: rgba(59, 130, 246, 0.7);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.4);
        }

        .gallery-item:hover img {
            transform: scale(1.1);
            filter: brightness(1.2);
        }

        .share-btn {
            transition: all 0.3s ease;
            position: relative;
        }

        .share-btn:hover {
            transform: scale(1.15) rotate(5deg);
        }

        .btn-gradient {
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .btn-gradient::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
            transition: left 0.5s ease;
        }

        .btn-gradient:hover::before {
            left: 100%;
        }

        .btn-gradient:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(59, 130, 246, 0.5);
        }

        .comment-card {
            transition: all 0.3s ease;
            border: 1px solid rgba(59, 130, 246, 0.3);
        }

        .comment-card:hover {
            transform: translateX(8px);
            border-color: rgba(59, 130, 246, 0.5);
            box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
        }

        .input-glow:focus {
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3), 0 0 20px rgba(59, 130, 246, 0.4);
        }

        .related-card {
            transition: all 0.4s ease;
            border: 2px solid rgba(59, 130, 246, 0.3);
        }

        .related-card:hover {
            transform: translateY(-10px);
            border-color: rgba(59, 130, 246, 0.6);
            box-shadow: 0 20px 40px rgba(59, 130, 246, 0.4);
        }

        .related-card img {
            transition: all 0.5s ease;
        }

        .related-card:hover img {
            transform: scale(1.1);
            filter: brightness(1.2);
        }

        .title-glow {
            text-shadow: 0 0 40px rgba(59, 130, 246, 0.4);
        }

        .shimmer-effect {
            background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.15), transparent);
            background-size: 200% 100%;
            animation: shimmer 2s infinite;
        }
    </style>

    <div class="bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 min-h-screen pb-20">
        <div class="container mx-auto px-6 py-12">
            <!-- Breadcrumb -->
            <div class="mb-8 animate-slide-in-left">
                <nav class="flex items-center gap-2 text-sm text-blue-100">
                    <a href="{{ route('program.index') }}"
                        class="breadcrumb-link hover:text-white transition-colors">Program</a>
                    <i class="fas fa-chevron-right text-xs text-blue-300"></i>
                    <a href="{{ route('program.category', $program->category->slug) }}"
                        class="breadcrumb-link hover:text-white transition-colors">
                        {{ $program->category->name }}
                    </a>
                    @if ($program->subcategory)
                        <i class="fas fa-chevron-right text-xs text-blue-300"></i>
                        <a href="{{ route('program.subcategory', [$program->category->slug, $program->subcategory->slug]) }}"
                            class="breadcrumb-link hover:text-white transition-colors">
                            {{ $program->subcategory->name }}
                        </a>
                    @endif
                    <i class="fas fa-chevron-right text-xs text-blue-300"></i>
                    <span class="text-white font-semibold">{{ Str::limit($program->title, 30) }}</span>
                </nav>
            </div>

            <!-- Content -->
            <div class="max-w-4xl mx-auto">
                <article
                    class="bg-blue-700/50 backdrop-blur-xl rounded-[3rem] shadow-2xl overflow-hidden border-2 border-blue-400/40 animate-fade-in-up">
                    <div class="p-8 md:p-12">
                        <!-- Badges -->
                        <div class="flex flex-wrap gap-3 mb-6 animate-slide-in-left">
                            <a href="{{ route('program.category', $program->category->slug) }}"
                                class="badge-category inline-flex items-center gap-2 text-white px-5 py-2 rounded-full text-sm font-bold shadow-lg shadow-blue-500/40 border-2 border-white/20">
                                <i class="fas fa-tag"></i>
                                {{ $program->category->name }}
                            </a>

                            @if ($program->subcategory)
                                <a href="{{ route('program.subcategory', [$program->category->slug, $program->subcategory->slug]) }}"
                                    class="badge-subcategory inline-flex items-center gap-2 text-white px-5 py-2 rounded-full text-sm font-bold shadow-lg shadow-green-500/30 border-2 border-white/20">
                                    <i class="fas fa-layer-group"></i>
                                    {{ $program->subcategory->name }}
                                </a>
                            @endif
                        </div>

                        <!-- Title -->
                        <h1
                            class="title-glow text-4xl md:text-5xl font-black text-white mb-8 leading-tight tracking-tight animate-fade-in-up">
                            {{ $program->title }}
                        </h1>

                        <!-- Media (Image/Video) -->
                        <div class="media-container mb-10 shadow-2xl animate-scale-in">
                            @if ($program->media_type == 'video' && $program->video_url)
                                <div class="aspect-video w-full relative overflow-hidden rounded-xl">
                                    @if (Str::contains($program->video_url, 'youtube.com') || Str::contains($program->video_url, 'youtu.be'))
                                        <x-lite-youtube :videoId="$program->video_url" :title="$program->title" />
                                    @else
                                        <video controls class="w-full h-full object-cover rounded-xl">
                                            <source src="{{ asset('storage/' . $program->video_url) }}" type="video/mp4">
                                            Browser anda tidak mendukung tag video.
                                        </video>
                                    @endif
                                </div>
                            @elseif($program->thumbnail)
                                <img src="{{ asset('storage/' . $program->thumbnail) }}" alt="{{ $program->title }}"
                                    class="w-full h-auto object-cover">
                            @endif
                        </div>

                        <!-- Description/Excerpt -->
                        <div class="mb-10 pb-8 border-b-2 border-blue-400/40 animate-fade-in-up">
                            <div
                                class="border-l-4 border-blue-400 pl-6 bg-gradient-to-r from-blue-500/20 to-transparent py-4 rounded-r-2xl">
                                <p class="text-xl text-blue-50 leading-relaxed italic font-light">
                                    {{ $program->description }}</p>
                            </div>
                        </div>

                        <!-- Full Content -->
                        <div class="prose prose-lg max-w-none mb-10 whitespace-pre-wrap animate-fade-in-up">
                            {!! nl2br(e($program->content)) !!}</div>

                        <!-- Photo Gallery (if exists) -->
                        @if ($program->photos && count($program->photos) > 0)
                            <div class="mt-12 pt-10 border-t-2 border-blue-400/40 animate-fade-in-up">
                                <h3 class="text-3xl font-black text-white mb-8 flex items-center gap-4">
                                    <i class="fas fa-images text-blue-300 animate-float"></i>
                                    GALERI FOTO
                                </h3>
                                <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                                    @foreach ($program->photos as $index => $photo)
                                        <div class="gallery-item shadow-xl h-48"
                                            style="animation-delay: {{ $index * 0.1 }}s"
                                            onclick="window.open('{{ asset('storage/' . $photo) }}', '_blank')">
                                            <img src="{{ asset('storage/' . $photo) }}" alt="Gallery {{ $index + 1 }}"
                                                loading="lazy">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif

                        <!-- Share Buttons -->
                        <div class="pt-10 mt-12 border-t-2 border-blue-400/40 animate-fade-in-up">
                            <div
                                class="p-8 bg-gradient-to-br from-blue-500/20 to-blue-600/10 rounded-3xl border-2 border-blue-400/40 flex flex-col md:flex-row justify-between items-center gap-6 backdrop-blur-sm shimmer-effect">
                                <div class="text-center md:text-left">
                                    <h4
                                        class="text-white font-bold mb-1 uppercase tracking-widest text-sm flex items-center gap-2">
                                        <i class="fas fa-share-alt text-blue-300"></i>
                                        Bagikan Program Ini
                                    </h4>
                                    <p class="text-blue-100 text-xs italic">Sebarkan kebaikan kepada sesama</p>
                                </div>
                                <div class="flex gap-4">
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                                        target="_blank"
                                        class="share-btn w-14 h-14 bg-blue-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-blue-500/50 border-2 border-white/20">
                                        <i class="fab fa-facebook-f text-xl"></i>
                                    </a>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($program->title) }}"
                                        target="_blank"
                                        class="share-btn w-14 h-14 bg-sky-400 text-white rounded-full flex items-center justify-center shadow-lg shadow-sky-400/50 border-2 border-white/20">
                                        <i class="fab fa-twitter text-xl"></i>
                                    </a>
                                    <a href="https://api.whatsapp.com/send?text={{ urlencode($program->title . ' - ' . url()->current()) }}"
                                        target="_blank"
                                        class="share-btn w-14 h-14 bg-green-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-green-500/40 border-2 border-white/20">
                                        <i class="fab fa-whatsapp text-2xl"></i>
                                    </a>
                                </div>
                                <a href="{{ route('program.category', $program->category->slug) }}"
                                    class="btn-gradient text-white font-bold px-6 py-3 rounded-xl flex items-center gap-2 shadow-lg border-2 border-white/20">
                                    <i class="fas fa-arrow-left"></i> Program Lainnya
                                </a>
                            </div>
                        </div>
                    </div>
                </article>

                <!-- Related Programs -->
                @if (isset($relatedPrograms) && $relatedPrograms->count() > 0)
                    <div class="mt-20 animate-fade-in-up">
                        <h2 class="text-3xl font-black text-white mb-10 flex items-center gap-4 uppercase tracking-tighter">
                            <i class="fas fa-hand-holding-heart text-blue-300 animate-float"></i>
                            Program Terkait
                        </h2>
                        <div class="grid md:grid-cols-3 gap-8">
                            @foreach ($relatedPrograms as $index => $related)
                                <a href="{{ route('program.show', $related->slug) }}"
                                    class="related-card bg-blue-700/50 backdrop-blur-xl rounded-2xl overflow-hidden shadow-xl block"
                                    style="animation-delay: {{ $index * 0.1 }}s">
                                    <div class="h-48 relative overflow-hidden">
                                        @if ($related->thumbnail)
                                            <img src="{{ asset('storage/' . $related->thumbnail) }}"
                                                alt="{{ $related->title }}" class="w-full h-full object-cover">
                                        @else
                                            <div
                                                class="w-full h-full bg-gradient-to-br from-blue-500 to-blue-700 flex items-center justify-center">
                                                <i class="fas fa-hand-holding-heart text-white text-4xl animate-float"></i>
                                            </div>
                                        @endif
                                        <div class="absolute inset-0 bg-gradient-to-t from-blue-800 to-transparent"></div>
                                    </div>
                                    <div class="p-6">
                                        <h3 class="font-bold text-white text-lg line-clamp-2 mb-2">{{ $related->title }}
                                        </h3>
                                        <p class="text-sm text-blue-100 line-clamp-2 font-light">
                                            {{ $related->description }}</p>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- KOMENTAR SECTION -->
                <div class="mt-20">
                    <h2
                        class="text-3xl font-black text-white mb-10 flex items-center gap-4 uppercase tracking-tighter animate-slide-in-left">
                        <i class="far fa-comments text-blue-300 animate-float"></i>
                        Respon Umat ({{ $program->comments->count() }})
                    </h2>

                    <div class="grid lg:grid-cols-12 gap-10">
                        <!-- Form Komentar -->
                        <div class="lg:col-span-5 order-2 lg:order-1">
                            <div
                                class="bg-gradient-to-br from-blue-700 to-blue-600/60 rounded-[2rem] p-8 border-2 border-blue-400/40 sticky top-10 shadow-2xl backdrop-blur-xl animate-fade-in-up">
                                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                                    <i class="fas fa-pen text-blue-200"></i>
                                    Tulis Komentar
                                </h3>

                                @if (session('success'))
                                    <div
                                        class="bg-gradient-to-r from-green-500 to-green-600 border-2 border-white/20 text-white px-5 py-4 rounded-xl mb-6 flex items-center gap-3 shadow-lg animate-scale-in">
                                        <i class="fas fa-check-circle text-2xl"></i>
                                        <span class="font-semibold">{{ session('success') }}</span>
                                    </div>
                                @endif

                                <form action="{{ route('comment.store') }}" method="POST" class="space-y-5">
                                    @csrf

                                    <input type="hidden" name="commentable_type" value="App\Models\Program">
                                    <input type="hidden" name="commentable_id" value="{{ $program->id }}">

                                    <div class="space-y-4">
                                        <div>
                                            <label for="name" class="block text-sm font-bold text-blue-100 mb-2">
                                                Nama <span class="text-red-400">*</span>
                                            </label>
                                            <input type="text" id="name" name="name"
                                                value="{{ old('name') }}" required
                                                class="input-glow w-full px-5 py-4 bg-blue-800/50 border-2 border-blue-400/40 rounded-xl text-white placeholder-blue-100/50 focus:ring-2 focus:ring-blue-300 outline-none transition-all backdrop-blur-sm @error('name') border-red-500 @enderror"
                                                placeholder="Nama Lengkap">
                                            @error('name')
                                                <p class="text-red-400 text-sm mt-2 flex items-center gap-1">
                                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="email" class="block text-sm font-bold text-blue-100 mb-2">
                                                Email <span class="text-red-400">*</span>
                                            </label>
                                            <input type="email" id="email" name="email"
                                                value="{{ old('email') }}" required
                                                class="input-glow w-full px-5 py-4 bg-blue-800/50 border-2 border-blue-400/40 rounded-xl text-white placeholder-blue-100/50 focus:ring-2 focus:ring-blue-300 outline-none transition-all backdrop-blur-sm @error('email') border-red-500 @enderror"
                                                placeholder="email@example.com">
                                            @error('email')
                                                <p class="text-red-400 text-sm mt-2 flex items-center gap-1">
                                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                                </p>
                                            @enderror
                                        </div>

                                        <div>
                                            <label for="comment" class="block text-sm font-bold text-blue-100 mb-2">
                                                Komentar <span class="text-red-400">*</span>
                                            </label>
                                            <textarea id="comment" name="comment" rows="4" required maxlength="1000"
                                                class="input-glow w-full px-5 py-4 bg-blue-800/50 border-2 border-blue-400/40 rounded-xl text-white placeholder-blue-100/50 focus:ring-2 focus:ring-blue-300 outline-none transition-all backdrop-blur-sm @error('comment') border-red-500 @enderror"
                                                placeholder="Tulis komentar Anda...">{{ old('comment') }}</textarea>
                                            @error('comment')
                                                <p class="text-red-400 text-sm mt-2 flex items-center gap-1">
                                                    <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                                </p>
                                            @enderror
                                            <p class="text-blue-200/70 text-xs mt-2">Maksimal 1000 karakter</p>
                                        </div>
                                    </div>

                                    <button type="submit"
                                        class="btn-gradient w-full text-white font-black py-4 rounded-xl transition-all shadow-lg shadow-blue-500/50 uppercase tracking-widest text-sm border-2 border-white/20">
                                        <span class="flex items-center justify-center gap-2">
                                            <i class="fas fa-paper-plane"></i>
                                            Kirim Respon
                                        </span>
                                    </button>
                                </form>
                            </div>
                        </div>

                        <!-- List Komentar -->
                        <div class="lg:col-span-7 order-1 lg:order-2 space-y-6">
                            @forelse($program->comments as $index => $comment)
                                <div class="comment-card bg-blue-700/50 backdrop-blur-sm rounded-3xl p-8 flex gap-6 animate-fade-in-up"
                                    style="animation-delay: {{ $index * 0.1 }}s">
                                    <div class="flex-shrink-0">
                                        <div
                                            class="w-16 h-16 bg-gradient-to-br from-blue-400 to-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-lg shadow-blue-500/50 border-2 border-white/20">
                                            {{ $comment->initials }}
                                        </div>
                                    </div>

                                    <div class="flex-1">
                                        <div class="flex items-center justify-between mb-3">
                                            <h4 class="font-bold text-white text-lg">{{ $comment->name }}</h4>
                                            <span
                                                class="text-[10px] text-blue-200 uppercase font-bold tracking-widest bg-blue-500/30 px-3 py-1 rounded-full flex items-center gap-1">
                                                <i class="far fa-clock"></i>
                                                {{ $comment->created_at->locale('id')->diffForHumans() }}
                                            </span>
                                        </div>
                                        <p class="text-blue-50 leading-relaxed font-light whitespace-pre-wrap">
                                            {{ $comment->comment }}</p>
                                    </div>
                                </div>
                            @empty
                                <div
                                    class="text-center py-20 bg-blue-700/30 backdrop-blur-sm rounded-[2rem] border-2 border-blue-400/30 border-dashed animate-fade-in-up">
                                    <i class="far fa-comment-dots text-blue-300/40 text-6xl mb-6 animate-float"></i>
                                    <p class="text-blue-200 italic font-light text-lg">Jadilah yang pertama memberikan
                                        respon...</p>
                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script data-cfasync="false">
        function copyToClipboard(text) {
            if (navigator.clipboard) {
                navigator.clipboard.writeText(text).then(function() {
                    showToast('Link berhasil disalin!');
                }).catch(function(err) {
                    showToast('Gagal menyalin link', 'error');
                });
            } else {
                const tempInput = document.createElement('input');
                tempInput.value = text;
                document.body.appendChild(tempInput);
                tempInput.select();
                document.execCommand('copy');
                document.body.removeChild(tempInput);
                showToast('Link berhasil disalin!');
            }
        }

        function showToast(message, type = 'success') {
            const toast = document.createElement('div');
            toast.className =
                `fixed bottom-10 right-10 px-8 py-5 rounded-2xl ${type === 'success' ? 'bg-gradient-to-r from-blue-500 to-blue-600' : 'bg-gradient-to-r from-red-500 to-red-600'} text-white font-bold shadow-2xl z-50 border-2 border-white/30 backdrop-blur-sm`;
            toast.innerHTML = `
        <div class="flex items-center gap-3">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'} text-2xl"></i>
            <span>${message}</span>
        </div>
    `;
            toast.style.animation = 'fadeInUp 0.4s ease-out, pulse 1s ease-in-out infinite';
            document.body.appendChild(toast);

            setTimeout(() => {
                toast.style.animation = 'fadeInUp 0.4s ease-out reverse';
                setTimeout(() => toast.remove(), 400);
            }, 2600);
        }

        // Intersection Observer untuk animasi saat scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }
            });
        }, observerOptions);

        document.querySelectorAll('.animate-fade-in-up, .animate-slide-in-left, .animate-slide-in-right').forEach(el => {
            el.style.opacity = '0';
            el.style.transform = 'translateY(30px)';
            observer.observe(el);
        });
    </script>

@endsection
