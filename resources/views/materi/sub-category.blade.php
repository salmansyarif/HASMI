@extends('layouts.app')

@section('title', $subCategory->name . ' - ' . $category->name . ' - HASMI')

@section('content')

<div class="container mx-auto px-6 py-12">
    <!-- Breadcrumb -->
    <div class="mb-8">
        <nav class="flex" aria-label="Breadcrumb">
            <ol class="inline-flex items-center space-x-1 md:space-x-3">
                <li class="inline-flex items-center">
                    <a href="{{ route('materi.index') }}" class="text-gray-600 hover:text-blue-600">
                        <i class="fas fa-home mr-2"></i> Materi
                    </a>
                </li>
                <li>
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <a href="{{ route('materi.show', $category->slug) }}" class="text-gray-600 hover:text-blue-600">
                            {{ $category->name }}
                        </a>
                    </div>
                </li>
                <li aria-current="page">
                    <div class="flex items-center">
                        <i class="fas fa-chevron-right text-gray-400 mx-2"></i>
                        <span class="text-gray-800 font-semibold">{{ $subCategory->name }}</span>
                    </div>
                </li>
            </ol>
        </nav>
    </div>

    <!-- Header -->
    <div class="text-center mb-12">
        <div class="inline-flex items-center justify-center w-20 h-20 rounded-full bg-gradient-to-r from-purple-600 to-purple-400 text-white mb-4">
            <i class="fas {{ $subCategory->icon }} text-3xl"></i>
        </div>
        <h1 class="text-4xl font-bold text-gray-800 mb-2">{{ $subCategory->name }}</h1>
        <p class="text-gray-600 text-lg">Bagian dari {{ $category->name }}</p>
        <div class="w-24 h-1 bg-gradient-to-r from-purple-600 to-purple-400 mx-auto mt-4"></div>
    </div>

    <!-- Artikel Grid -->
    @if($articles->count() > 0)
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($articles as $article)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group">
                <!-- Thumbnail -->
                <div class="relative h-48 overflow-hidden">
                    @if($article->thumbnail)
                        <img src="{{ asset($article->thumbnail) }}" 
                             alt="{{ $article->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    @else
                        <div class="w-full h-full hero-gradient flex items-center justify-center">
                            <i class="fas fa-book-open text-white text-5xl"></i>
                        </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-6">
                    <!-- Meta Info -->
                    <div class="flex items-center gap-4 text-sm text-gray-500 mb-3">
                        <span><i class="far fa-calendar mr-1"></i> {{ $article->published_at->format('d M Y') }}</span>
                        <span><i class="far fa-user mr-1"></i> {{ $article->author->name }}</span>
                    </div>

                    <!-- Title -->
                    <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                        {{ $article->title }}
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $article->excerpt }}</p>

                    <!-- Read More Button -->
                    <a href="{{ route('materi.detail', [$category->slug, $article->slug]) }}" 
                       class="inline-flex items-center text-blue-600 font-semibold hover:gap-2 transition-all">
                        Baca Selengkapnya 
                        <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $articles->links() }}
        </div>

    @else
        <!-- Empty State -->
        <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
            <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Artikel</h3>
            <p class="text-gray-500">Sub-kategori <strong>{{ $subCategory->name }}</strong> belum memiliki artikel.</p>
            <a href="{{ route('materi.show', $category->slug) }}" class="inline-block mt-6 px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Kembali ke {{ $category->name }}
            </a>
        </div>
    @endif
</div>

<style>
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
</style>

@endsection
```

---

## **Penjelasan Error:**

Dari stack trace yang kamu kasih:
```
View [materi.sub-category] not found.
app\Http\Controllers\MateriController.php:52