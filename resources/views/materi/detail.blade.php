@extends('layouts.app')

@section('title', $article->title . ' - HASMI')

@section('content')

<style>
    .prose {
        color: #374151;
        line-height: 1.75;
    }
    .prose h2 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-top: 2rem;
        margin-bottom: 1rem;
        color: #1f2937;
    }
    .prose h3 {
        font-size: 1.5rem;
        font-weight: 600;
        margin-top: 1.5rem;
        margin-bottom: 0.75rem;
        color: #1f2937;
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
        color: #1f2937;
    }
    .prose blockquote {
        border-left: 4px solid #3B82F6;
        padding-left: 1rem;
        margin: 1.5rem 0;
        font-style: italic;
        color: #6b7280;
    }
    .prose img {
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

<div class="container mx-auto px-6 py-12">
    <!-- Breadcrumb -->
    <div class="mb-8">
        <nav class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('materi.index') }}" class="hover:text-blue-600">Materi</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('materi.show', $article->category->slug) }}" class="hover:text-blue-600">
                {{ $article->category->name }}
            </a>
            @if($article->subCategory)
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('materi.sub-category', [$article->category->slug, $article->subCategory->slug]) }}" class="hover:text-blue-600">
                {{ $article->subCategory->name }}
            </a>
            @endif
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-800 font-semibold">{{ Str::limit($article->title, 30) }}</span>
        </nav>
    </div>

    <!-- Article Content -->
    <div class="max-w-4xl mx-auto">
        <article class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8 md:p-12">
                <!-- Category & Sub-Category Badges -->
                <div class="flex flex-wrap gap-2 mb-4">
                    <a href="{{ route('materi.show', $article->category->slug) }}" 
                       class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-semibold hover:bg-blue-200 transition-colors">
                        <i class="fas {{ $article->category->icon }} mr-1"></i>
                        {{ $article->category->name }}
                    </a>
                    
                    @if($article->subCategory)
                    <a href="{{ route('materi.sub-category', [$article->category->slug, $article->subCategory->slug]) }}" 
                       class="inline-block bg-purple-100 text-purple-600 px-4 py-1 rounded-full text-sm font-semibold hover:bg-purple-200 transition-colors">
                        <i class="fas {{ $article->subCategory->icon }} mr-1"></i>
                        {{ $article->subCategory->name }}
                    </a>
                    @endif
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-4 leading-tight">
                    {{ $article->title }}
                </h1>

                <!-- EXCERPT/DESKRIPSI -->
                @if($article->excerpt)
                <div class="mb-8 pb-8 border-b border-gray-200">
                    <p class="text-lg text-gray-600 leading-relaxed italic whitespace-pre-wrap">{{ $article->excerpt }}</p>
                </div>
                @endif

                <!-- Content -->
                <div class="prose prose-lg max-w-none mb-8 whitespace-pre-wrap">{!! nl2br(e($article->content)) !!}</div>

                <!-- Meta (Dipindah ke bawah artikel) -->
                <div class="flex flex-wrap items-center gap-4 text-gray-600 pt-8 border-t border-gray-200 mb-8">
                    <div class="flex items-center gap-2">
                        <i class="far fa-calendar text-blue-600"></i>
                        <span>{{ $article->published_at->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                    </div>
                    @if($article->author)
                    <div class="flex items-center gap-2">
                        <i class="far fa-user text-blue-600"></i>
                        <span>{{ $article->author->name }}</span>
                    </div>
                    @endif
                </div>

                <!-- Share Buttons -->
                <div class="pt-8 border-t border-gray-200">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Bagikan artikel ini:</p>
                            <div class="flex gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition-colors"
                                   title="Bagikan ke Facebook">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($article->title) }}" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-10 h-10 bg-blue-400 text-white rounded-lg flex items-center justify-center hover:bg-blue-500 transition-colors"
                                   title="Bagikan ke Twitter">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($article->title . ' - ' . url()->current()) }}" 
                                   target="_blank" rel="noopener noreferrer"
                                   class="w-10 h-10 bg-green-600 text-white rounded-lg flex items-center justify-center hover:bg-green-700 transition-colors"
                                   title="Bagikan ke WhatsApp">
                                    <i class="fab fa-whatsapp"></i>
                                </a>

                                <button onclick="copyToClipboard('{{ url()->current() }}')" 
                                        class="w-10 h-10 bg-gray-600 text-white rounded-lg flex items-center justify-center hover:bg-gray-700 transition-colors"
                                        title="Copy Link">
                                    <i class="fas fa-link"></i>
                                </button>
                            </div>
                        </div>
                        <a href="{{ route('materi.show', $article->category->slug) }}" 
                           class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-2">
                            <i class="fas fa-arrow-left"></i> Artikel Lainnya
                        </a>
                    </div>
                </div>
            </div>
        </article>

        <!-- Related Articles -->
        @if($relatedArticles->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Artikel Terkait</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($relatedArticles as $related)
                <a href="{{ route('materi.detail', [$related->category->slug, $related->slug]) }}" 
                   class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover">
                    <div class="h-40 relative overflow-hidden">
                        @if($related->thumbnail)
                            <img src="{{ asset($related->thumbnail) }}" 
                                 alt="{{ $related->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full hero-gradient flex items-center justify-center">
                                <div class="text-white text-4xl font-bold">H</div>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 line-clamp-2 mb-2">{{ $related->title }}</h3>
                        <p class="text-xs text-gray-500">
                            <i class="far fa-calendar mr-1"></i>
                            {{ $related->published_at->locale('id')->isoFormat('D MMM Y') }}
                        </p>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
        @endif

        <!-- KOMENTAR SECTION -->
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">
                <i class="far fa-comments text-blue-600 mr-2"></i>
                Komentar ({{ $article->approvedCommentsCount() }})
            </h2>

            <!-- List Komentar (DI ATAS) -->
            <div class="space-y-6 mb-8">
                @php
                $comments = $article->comments()->approved()->latest()->get();
                @endphp

                @forelse($comments as $comment)
                <div class="bg-white rounded-2xl shadow-lg p-6 flex gap-4">
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 hero-gradient rounded-full flex items-center justify-center text-white font-bold text-lg">
                            {{ $comment->initials }}
                        </div>
                    </div>

                    <div class="flex-1">
                        <div class="flex items-center justify-between mb-2">
                            <h4 class="font-bold text-gray-800">{{ $comment->name }}</h4>
                            <span class="text-xs text-gray-500">
                                <i class="far fa-clock mr-1"></i>
                                {{ $comment->created_at->locale('id')->diffForHumans() }}
                            </span>
                        </div>
                        <p class="text-gray-700 leading-relaxed whitespace-pre-wrap">{{ $comment->comment }}</p>
                    </div>
                </div>
                @empty
                <div class="text-center py-12 bg-gray-50 rounded-2xl">
                    <i class="far fa-comment-dots text-gray-300 text-5xl mb-4"></i>
                    <p class="text-gray-500">Belum ada komentar. Jadilah yang pertama!</p>
                </div>
                @endforelse
            </div>

            <!-- Form Komentar (DI BAWAH) -->
            <div class="bg-white rounded-2xl shadow-lg p-8">
                <h3 class="text-xl font-semibold text-gray-800 mb-4">Tulis Komentar</h3>
                
                @if(session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 flex items-center gap-2">
                    <i class="fas fa-check-circle"></i>
                    <span>{{ session('success') }}</span>
                </div>
                @endif

                <form action="{{ route('comment.store') }}" method="POST" class="space-y-4">
                    @csrf
                    
                    <input type="hidden" name="commentable_type" value="App\Models\Article">
                    <input type="hidden" name="commentable_id" value="{{ $article->id }}">
                    
                    <div class="grid md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                                Nama <span class="text-red-500">*</span>
                            </label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('name') border-red-500 @enderror"
                                   placeholder="Nama Anda">
                            @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                                Email <span class="text-red-500">*</span>
                            </label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}" required
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('email') border-red-500 @enderror"
                                   placeholder="email@example.com">
                            @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="comment" class="block text-sm font-semibold text-gray-700 mb-2">
                            Komentar <span class="text-red-500">*</span>
                        </label>
                        <textarea id="comment" name="comment" rows="4" required maxlength="1000"
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('comment') border-red-500 @enderror"
                                  placeholder="Tulis komentar Anda...">{{ old('comment') }}</textarea>
                        @error('comment')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        <p class="text-gray-500 text-xs mt-1">Maksimal 1000 karakter</p>
                    </div>

                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all flex items-center gap-2">
                        <i class="fas fa-paper-plane"></i> Kirim Komentar
                    </button>
                </form>
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
    toast.className = `fixed bottom-8 right-8 px-6 py-3 rounded-lg shadow-lg text-white transform transition-all duration-300 z-50 ${type === 'success' ? 'bg-green-600' : 'bg-red-600'}`;
    toast.innerHTML = `
        <div class="flex items-center gap-2">
            <i class="fas ${type === 'success' ? 'fa-check-circle' : 'fa-exclamation-circle'}"></i>
            <span>${message}</span>
        </div>
    `;
    document.body.appendChild(toast);
    
    setTimeout(() => {
        toast.style.opacity = '0';
        setTimeout(() => toast.remove(), 300);
    }, 3000);
}
</script>

@endsection