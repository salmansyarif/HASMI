@extends('layouts.app')

@section('title', $article->title . ' - HASMI')

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
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
        }
    }
    
    @keyframes pulse {
        0%, 100% {
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
        font-size: 1.875rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #ffffff;
        text-shadow: 0 0 20px rgba(59, 130, 246, 0.3);
    }
    .prose h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        color: #ffffff;
    }
    .prose p {
        margin-bottom: 1.25rem;
    }
    .prose ul, .prose ol {
        margin-left: 1.5rem;
        margin-bottom: 1.25rem;
    }
    .prose li {
        margin-bottom: 0.5rem;
    }
    .prose strong {
        font-weight: 600;
        color: #ffffff;
    }
    .prose blockquote {
        border-left: 4px solid #3b82f6;
        padding-left: 1.5rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #93c5fd;
        background: rgba(59, 130, 246, 0.1);
        padding: 1rem 1.5rem;
        border-radius: 0.5rem;
    }
    .prose img {
        border-radius: 1rem;
        margin: 1.5rem 0;
        border: 2px solid rgba(59, 130, 246, 0.3);
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
        background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%);
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.5s ease;
    }
    
    .badge-category:hover::before {
        left: 100%;
    }
    
    .badge-category:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
    }
    
    .badge-subcategory {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        transition: all 0.3s ease;
    }
    
    .badge-subcategory:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
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
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.1), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-gradient:hover::before {
        left: 100%;
    }
    
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.4);
    }
    
    .comment-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(59, 130, 246, 0.1);
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
    }
    
    .comment-card:hover {
        transform: translateX(8px);
        border-color: rgba(59, 130, 246, 0.3);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.15);
    }
    
    .input-glow:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.2), 0 0 20px rgba(59, 130, 246, 0.3);
    }
    
    .related-card {
        transition: all 0.4s ease;
        border: 2px solid rgba(59, 130, 246, 0.1);
        background: linear-gradient(135deg, #1e3a8a 0%, #1e40af 100%);
    }
    
    .related-card:hover {
        transform: translateY(-10px);
        border-color: rgba(59, 130, 246, 0.4);
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.2);
    }
    
    .related-card img {
        transition: all 0.5s ease;
    }
    
    .related-card:hover img {
        transform: scale(1.1);
        filter: brightness(1.2);
    }
    
    .title-glow {
        text-shadow: 0 0 40px rgba(59, 130, 246, 0.3);
    }
    
    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<div class="bg-gradient-to-br from-blue-800 via-blue-900 to-blue-800 min-h-screen pb-20">
    <div class="container mx-auto px-6 py-12">
        <!-- Breadcrumb -->
        <div class="mb-10 animate-slide-in-left">
            <nav class="flex items-center gap-2 text-sm text-blue-200">
                <a href="{{ route('materi.index') }}" class="breadcrumb-link hover:text-white transition-colors">Materi</a>
                <i class="fas fa-chevron-right text-xs text-blue-400"></i>
                <a href="{{ route('materi.show', $article->category->slug) }}" class="breadcrumb-link hover:text-white transition-colors">
                    {{ $article->category->name }}
                </a>
                @if($article->subCategory)
                <i class="fas fa-chevron-right text-xs text-blue-400"></i>
                <a href="{{ route('materi.sub-category', [$article->category->slug, $article->subCategory->slug]) }}" class="breadcrumb-link hover:text-white transition-colors">
                    {{ $article->subCategory->name }}
                </a>
                @endif
                <i class="fas fa-chevron-right text-xs text-blue-400"></i>
                <span class="text-white font-semibold">{{ Str::limit($article->title, 30) }}</span>
            </nav>
        </div>

        <!-- Article Content -->
        <div class="max-w-4xl mx-auto">
            <article class="bg-blue-800/50 backdrop-blur-xl rounded-[3rem] shadow-2xl overflow-hidden border-2 border-blue-500/20 animate-fade-in-up">
                <div class="p-8 md:p-12">
                    <!-- Category & Sub-Category Badges -->
                    <div class="flex flex-wrap gap-3 mb-6 animate-slide-in-left">
                        <a href="{{ route('materi.show', $article->category->slug) }}" 
                           class="badge-category inline-flex items-center gap-2 text-white px-5 py-2 rounded-full text-sm font-bold shadow-lg shadow-blue-500/30 border-2 border-blue-400/20">
                            <i class="fas {{ $article->category->icon }}"></i>
                            {{ $article->category->name }}
                        </a>
                        
                        @if($article->subCategory)
                        <a href="{{ route('materi.sub-category', [$article->category->slug, $article->subCategory->slug]) }}" 
                           class="badge-subcategory inline-flex items-center gap-2 text-white px-5 py-2 rounded-full text-sm font-bold shadow-lg shadow-blue-500/30 border-2 border-blue-400/20">
                            <i class="fas {{ $article->subCategory->icon }}"></i>
                            {{ $article->subCategory->name }}
                        </a>
                        @endif
                    </div>

                    <!-- Title -->
                    <h1 class="title-glow text-4xl md:text-5xl font-black text-white mb-8 leading-tight tracking-tight animate-fade-in-up">
                        {{ $article->title }}
                    </h1>

                    <!-- EXCERPT/DESKRIPSI -->
                    @if($article->excerpt)
                    <div class="mb-10 pb-8 border-b-2 border-blue-500/20 animate-fade-in-up">
                        <div class="border-l-4 border-blue-500 pl-6 bg-gradient-to-r from-blue-500/10 to-transparent py-4 rounded-r-2xl">
                            <p class="text-xl text-blue-100 leading-relaxed italic font-light whitespace-pre-wrap">{{ $article->excerpt }}</p>
                        </div>
                    </div>
                    @endif

                    <!-- Content -->
                    <div class="prose prose-lg max-w-none mb-10 whitespace-pre-wrap animate-fade-in-up">{!! nl2br(e($article->content)) !!}</div>

                    <!-- Meta (Dipindah ke bawah artikel) -->
                    <div class="flex flex-wrap items-center gap-6 pt-8 border-t-2 border-blue-500/20 mb-10 animate-slide-in-left">
                        <div class="flex items-center gap-3 bg-blue-500/20 px-5 py-3 rounded-full text-blue-200 font-semibold">
                            <i class="far fa-calendar text-blue-400 text-lg"></i>
                            <span>{{ $article->published_at->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                        </div>
                        @if($article->author)
                        <div class="flex items-center gap-3 bg-blue-700/40 px-5 py-3 rounded-full text-blue-200 font-semibold">
                            <i class="far fa-user text-blue-400 text-lg"></i>
                            <span>{{ $article->author->name }}</span>
                        </div>
                        @endif
                    </div>

                    <!-- Share Buttons -->
                    <div class="pt-10 border-t-2 border-blue-500/20 animate-fade-in-up">
                        <div class="p-8 bg-gradient-to-br from-blue-500/10 to-blue-600/5 rounded-3xl border-2 border-blue-400/30 flex flex-col md:flex-row justify-between items-center gap-6 backdrop-blur-sm shimmer-effect">
                            <div class="text-center md:text-left">
                                <h4 class="text-white font-bold mb-1 uppercase tracking-widest text-sm flex items-center gap-2">
                                    <i class="fas fa-share-alt text-blue-400"></i>
                                    Bagikan Artikel Ini
                                </h4>
                                <p class="text-blue-200 text-xs italic">Sebarkan ilmu bermanfaat</p>
                            </div>
                            <div class="flex gap-4">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="share-btn w-14 h-14 bg-blue-600 text-white rounded-full flex items-center justify-center shadow-lg shadow-blue-600/40 border-2 border-blue-400/20"
                                   title="Bagikan ke Facebook">
                                    <i class="fab fa-facebook-f text-xl"></i>
                                </a>
                                
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="share-btn w-14 h-14 bg-sky-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-sky-500/40 border-2 border-blue-400/20"
                                   title="Bagikan ke Twitter">
                                    <i class="fab fa-twitter text-xl"></i>
                                </a>
                                
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . url()->current()) }}" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="share-btn w-14 h-14 bg-green-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-green-500/40 border-2 border-blue-400/20"
                                   title="Bagikan ke WhatsApp">
                                    <i class="fab fa-whatsapp text-2xl"></i>
                                </a>

                                <button onclick="copyToClipboard('{{ url()->current() }}')" 
                                        class="share-btn w-14 h-14 bg-blue-500 text-white rounded-full flex items-center justify-center shadow-lg shadow-blue-500/40 border-2 border-blue-400/30"
                                        title="Copy Link">
                                    <i class="fas fa-link text-xl"></i>
                                </button>
                            </div>
                            <a href="{{ route('materi.show', $article->category->slug) }}" 
                               class="btn-gradient text-white font-bold px-6 py-3 rounded-xl flex items-center gap-2 shadow-lg border-2 border-blue-400/20">
                                <i class="fas fa-arrow-left"></i> Artikel Lainnya
                            </a>
                        </div>
                    </div>
                </div>
            </article>

            <!-- Related Articles -->
            @if($relatedArticles->count() > 0)
            <div class="mt-20 animate-fade-in-up">
                <h2 class="text-3xl font-black text-white mb-10 flex items-center gap-4 uppercase tracking-tighter">
                    <i class="fas fa-book-open text-blue-400 animate-float"></i>
                    Artikel Terkait
                </h2>
                <div class="grid md:grid-cols-3 gap-8">
                    @foreach($relatedArticles as $index => $related)
                    <a href="{{ route('materi.detail', [$related->category->slug, $related->slug]) }}" 
                       class="related-card backdrop-blur-xl rounded-2xl overflow-hidden shadow-xl block"
                       style="animation-delay: {{ $index * 0.1 }}s">
                        <div class="h-48 relative overflow-hidden">
                            @if($related->thumbnail)
                                <img src="{{ asset($related->thumbnail) }}" 
                                     alt="{{ $related->title }}" 
                                     class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                                    <i class="fas fa-book-open text-white text-5xl animate-float"></i>
                                </div>
                            @endif
                            <div class="absolute inset-0 bg-gradient-to-t from-blue-900 to-transparent"></div>
                        </div>
                        <div class="p-6">
                            <h3 class="font-bold text-white text-lg line-clamp-2 mb-3">{{ $related->title }}</h3>
                            <p class="text-xs text-blue-300 flex items-center gap-2 bg-blue-500/20 px-3 py-1 rounded-full inline-flex">
                                <i class="far fa-calendar"></i>
                                {{ $related->published_at->locale('id')->isoFormat('D MMM Y') }}
                            </p>
                        </div>
                    </a>
                    @endforeach
                </div>
            </div>
            @endif

            <!-- KOMENTAR SECTION -->
            <div class="mt-20">
                <h2 class="text-3xl font-black text-white mb-10 flex items-center gap-4 uppercase tracking-tighter animate-slide-in-left">
                    <i class="far fa-comments text-blue-400 animate-float"></i>
                    Respon Pembaca ({{ $article->approvedCommentsCount() }})
                </h2>

                <div class="grid lg:grid-cols-12 gap-10">
                    <!-- Form Komentar -->
                    <div class="lg:col-span-5 order-2 lg:order-1">
                        <div class="bg-gradient-to-br from-blue-800 to-blue-900 rounded-[2rem] p-8 border-2 border-blue-400/30 sticky top-10 shadow-2xl backdrop-blur-xl animate-fade-in-up">
                            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                                <i class="fas fa-pen text-blue-400"></i>
                                Tulis Komentar
                            </h3>
                            
                            @if(session('success'))
                            <div class="bg-gradient-to-r from-green-500 to-green-600 border-2 border-blue-400/20 text-white px-5 py-4 rounded-xl mb-6 flex items-center gap-3 shadow-lg animate-scale-in">
                                <i class="fas fa-check-circle text-2xl"></i>
                                <span class="font-semibold">{{ session('success') }}</span>
                            </div>
                            @endif

                            <form action="{{ route('comment.store') }}" method="POST" class="space-y-5">
                                @csrf
                                
                                <input type="hidden" name="commentable_type" value="App\Models\Article">
                                <input type="hidden" name="commentable_id" value="{{ $article->id }}">
                                
                                <div class="space-y-4">
                                    <div>
                                        <label for="name" class="block text-sm font-bold text-blue-200 mb-2">
                                            Nama <span class="text-red-400">*</span>
                                        </label>
                                        <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                               class="input-glow w-full px-5 py-4 bg-blue-950/50 border-2 border-blue-400/30 rounded-xl text-white placeholder-blue-200/50 focus:ring-2 focus:ring-blue-400 outline-none transition-all backdrop-blur-sm @error('name') border-red-500 @enderror"
                                               placeholder="Nama Lengkap">
                                        @error('name')
                                        <p class="text-red-400 text-sm mt-2 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="email" class="block text-sm font-bold text-blue-200 mb-2">
                                            Email <span class="text-red-400">*</span>
                                        </label>
                                        <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                               class="input-glow w-full px-5 py-4 bg-blue-950/50 border-2 border-blue-400/30 rounded-xl text-white placeholder-blue-200/50 focus:ring-2 focus:ring-blue-400 outline-none transition-all backdrop-blur-sm @error('email') border-red-500 @enderror"
                                               placeholder="email@example.com">
                                        @error('email')
                                        <p class="text-red-400 text-sm mt-2 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                        </p>
                                        @enderror
                                    </div>

                                    <div>
                                        <label for="comment" class="block text-sm font-bold text-blue-200 mb-2">
                                            Komentar <span class="text-red-400">*</span>
                                        </label>
                                        <textarea id="comment" name="comment" rows="4" required maxlength="1000"
                                                  class="input-glow w-full px-5 py-4 bg-blue-950/50 border-2 border-blue-400/30 rounded-xl text-white placeholder-blue-200/50 focus:ring-2 focus:ring-blue-400 outline-none transition-all backdrop-blur-sm @error('comment') border-red-500 @enderror"
                                                  placeholder="Tulis komentar Anda...">{{ old('comment') }}</textarea>
                                        @error('comment')
                                        <p class="text-red-400 text-sm mt-2 flex items-center gap-1">
                                            <i class="fas fa-exclamation-circle"></i>{{ $message }}
                                        </p>
                                        @enderror
                                        <p class="text-blue-300/70 text-xs mt-2">Maksimal 1000 karakter</p>
                                    </div>
                                </div>

                                <button type="submit" 
                                        class="btn-gradient w-full text-white font-black py-4 rounded-xl transition-all shadow-lg shadow-blue-500/40 uppercase tracking-widest text-sm border-2 border-blue-400/20">
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
                        @php
                        $comments = $article->comments()->approved()->latest()->get();
                        @endphp

                        @forelse($comments as $index => $comment)
                        <div class="comment-card backdrop-blur-sm rounded-3xl p-8 flex gap-6 animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
                            <div class="flex-shrink-0">
                                <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-700 rounded-2xl flex items-center justify-center text-white font-black text-2xl shadow-lg shadow-blue-500/40 border-2 border-blue-400/20">
                                    {{ $comment->initials }}
                                </div>
                            </div>

                            <div class="flex-1">
                                <div class="flex items-center justify-between mb-3">
                                    <h4 class="font-bold text-white text-lg">{{ $comment->name }}</h4>
                                    <span class="text-[10px] text-blue-300 uppercase font-bold tracking-widest bg-blue-500/20 px-3 py-1 rounded-full flex items-center gap-1">
                                        <i class="far fa-clock"></i>
                                        {{ $comment->created_at->locale('id')->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-blue-100 leading-relaxed font-light whitespace-pre-wrap">{{ $comment->comment }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-20 bg-blue-800/30 backdrop-blur-sm rounded-[2rem] border-2 border-blue-500/20 border-dashed animate-fade-in-up">
                            <i class="far fa-comment-dots text-blue-400/40 text-6xl mb-6 animate-float"></i>
                            <p class="text-blue-300 italic font-light text-lg">Jadilah yang pertama memberikan respon...</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
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
    toast.className = `fixed bottom-10 right-10 px-8 py-5 rounded-2xl ${type === 'success' ? 'bg-gradient-to-r from-blue-500 to-blue-600' : 'bg-gradient-to-r from-red-500 to-red-600'} text-white font-bold shadow-2xl z-50 border-2 border-blue-400/30 backdrop-blur-sm`;
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