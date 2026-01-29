@extends('layouts.app')

@section('title', $program->title . ' - HASMI')

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
    .prose p {
        margin-bottom: 1.25rem;
    }
    .prose ul {
        list-style-type: disc;
        margin-left: 1.5rem;
        margin-bottom: 1.25rem;
    }
    .prose img {
        border-radius: 0.5rem;
        margin: 1.5rem 0;
    }
</style>

<div class="container mx-auto px-6 py-12">
    <!-- Breadcrumb -->
    <div class="mb-8">
        <nav class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('program.index') }}" class="hover:text-blue-600">Program</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('program.category', $program->category->slug) }}" class="hover:text-blue-600">
                {{ $program->category->name }}
            </a>
            @if($program->subcategory)
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('program.subcategory', [$program->category->slug, $program->subcategory->slug]) }}" class="hover:text-blue-600">
                {{ $program->subcategory->name }}
            </a>
            @endif
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-800 font-semibold">{{ Str::limit($program->title, 30) }}</span>
        </nav>
    </div>

    <!-- Content -->
    <div class="max-w-4xl mx-auto">
        <article class="bg-white rounded-2xl shadow-lg overflow-hidden">
            <div class="p-8 md:p-12">
                <!-- Badges -->
                <div class="flex flex-wrap gap-2 mb-4">
                    <a href="{{ route('program.category', $program->category->slug) }}" 
                       class="inline-block bg-blue-100 text-blue-600 px-4 py-1 rounded-full text-sm font-semibold hover:bg-blue-200 transition-colors">
                        {{ $program->category->name }}
                    </a>
                    
                    @if($program->subcategory)
                    <a href="{{ route('program.subcategory', [$program->category->slug, $program->subcategory->slug]) }}" 
                       class="inline-block bg-green-100 text-green-600 px-4 py-1 rounded-full text-sm font-semibold hover:bg-green-200 transition-colors">
                        {{ $program->subcategory->name }}
                    </a>
                    @endif
                </div>

                <!-- Title -->
                <h1 class="text-4xl md:text-5xl font-bold text-gray-800 mb-6 leading-tight">
                    {{ $program->title }}
                </h1>

                <!-- Media (Image/Video) -->
                <div class="mb-8 rounded-xl overflow-hidden shadow-md">
                    @if($program->media_type == 'video' && $program->video_url)
                        <div class="aspect-w-16 aspect-h-9">
                            @if(Str::contains($program->video_url, 'youtube.com') || Str::contains($program->video_url, 'youtu.be'))
                                <iframe src="{{ str_replace('watch?v=', 'embed/', $program->video_url) }}" 
                                        frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                        allowfullscreen class="w-full h-96"></iframe>
                            @else
                                <video controls class="w-full">
                                    <source src="{{ asset('storage/' . $program->video_url) }}" type="video/mp4">
                                    Browser anda tidak mendukung tag video.
                                </video>
                            @endif
                        </div>
                    @elseif($program->thumbnail)
                        <img src="{{ asset('storage/' . $program->thumbnail) }}" 
                             alt="{{ $program->title }}" 
                             class="w-full h-auto object-cover">
                    @endif
                </div>

                <!-- Description/Excerpt -->
                <div class="mb-8 pb-8 border-b border-gray-200">
                    <p class="text-lg text-gray-600 leading-relaxed italic">{{ $program->description }}</p>
                </div>

                <!-- Full Content -->
                <div class="prose prose-lg max-w-none mb-8 whitespace-pre-wrap">{!! nl2br(e($program->content)) !!}</div>

                <!-- Photo Gallery (if exists) -->
                @if($program->photos && count($program->photos) > 0)
                <div class="mt-8 pt-8 border-t border-gray-200">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Galeri Foto</h3>
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        @foreach($program->photos as $photo)
                        <div class="rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow">
                            <img src="{{ asset('storage/' . $photo) }}" alt="Gallery" class="w-full h-40 object-cover cursor-pointer" onclick="window.open(this.src, '_blank')">
                        </div>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Share Buttons -->
                <div class="pt-8 mt-8 border-t border-gray-200">
                    <div class="flex items-center justify-between flex-wrap gap-4">
                        <div>
                            <p class="text-sm text-gray-600 mb-2">Bagikan program ini:</p>
                            <div class="flex gap-3">
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" 
                                   target="_blank" class="w-10 h-10 bg-blue-600 text-white rounded-lg flex items-center justify-center hover:bg-blue-700 transition-colors">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                                <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}&text={{ urlencode($program->title) }}" 
                                   target="_blank" class="w-10 h-10 bg-blue-400 text-white rounded-lg flex items-center justify-center hover:bg-blue-500 transition-colors">
                                    <i class="fab fa-twitter"></i>
                                </a>
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($program->title . ' - ' . url()->current()) }}" 
                                   target="_blank" class="w-10 h-10 bg-green-600 text-white rounded-lg flex items-center justify-center hover:bg-green-700 transition-colors">
                                    <i class="fab fa-whatsapp"></i>
                                </a>
                            </div>
                        </div>
                        <a href="{{ route('program.category', $program->category->slug) }}" 
                           class="text-blue-600 hover:text-blue-700 font-semibold flex items-center gap-2">
                            <i class="fas fa-arrow-left"></i> Program Lainnya
                        </a>
                    </div>
                </div>
            </div>
        </article>

        <!-- Related Programs -->
        @if(isset($relatedPrograms) && $relatedPrograms->count() > 0)
        <div class="mt-12">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Program Terkait</h2>
            <div class="grid md:grid-cols-3 gap-6">
                @foreach($relatedPrograms as $related)
                <a href="{{ route('program.show', $related->slug) }}" 
                   class="bg-white rounded-2xl overflow-hidden shadow-lg card-hover block">
                    <div class="h-40 relative overflow-hidden">
                        @if($related->thumbnail)
                            <img src="{{ asset('storage/' . $related->thumbnail) }}" 
                                 alt="{{ $related->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full hero-gradient flex items-center justify-center">
                                <i class="fas fa-hand-holding-heart text-white text-3xl"></i>
                            </div>
                        @endif
                    </div>
                    <div class="p-4">
                        <h3 class="font-bold text-gray-800 line-clamp-2 mb-2">{{ $related->title }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2">{{ $related->description }}</p>
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
                Komentar ({{ $program->comments->count() }})
            </h2>

            <!-- List Komentar -->
            <div class="space-y-6 mb-8">
                @forelse($program->comments as $comment)
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

            <!-- Form Komentar -->
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
                    
                    <input type="hidden" name="commentable_type" value="App\Models\Program">
                    <input type="hidden" name="commentable_id" value="{{ $program->id }}">
                    
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