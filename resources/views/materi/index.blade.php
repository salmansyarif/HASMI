@extends('layouts.app')

@section('title', 'Semua Materi - HASMI')

@section('content')

<div class="container mx-auto px-6 py-12">
    <!-- Header -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">Semua Materi Pembelajaran</h1>
        <p class="text-gray-600 text-lg">Koleksi lengkap materi pembelajaran Islam dari berbagai kategori</p>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-blue-400 mx-auto mt-4"></div>
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
                    
                    <!-- Category & Sub-Category Badges -->
                    <div class="absolute top-4 left-4 flex flex-col gap-2">
                        <!-- Category Badge -->
                        <span class="px-3 py-1 bg-blue-600 text-white text-xs font-semibold rounded-full inline-block w-fit">
                            <i class="fas {{ $article->category->icon }} mr-1"></i>
                            {{ $article->category->name }}
                        </span>
                        
                        <!-- Sub-Category Badge (if exists) -->
                        @if($article->subCategory)
                        <span class="px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded-full inline-block w-fit">
                            <i class="fas {{ $article->subCategory->icon }} mr-1"></i>
                            {{ $article->subCategory->name }}
                        </span>
                        @endif
                    </div>
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
                    <a href="{{ route('materi.detail', [$article->category->slug, $article->slug]) }}" 
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
        <div class="text-center py-16">
            <i class="fas fa-inbox text-gray-300 text-6xl mb-4"></i>
            <h3 class="text-xl font-semibold text-gray-600 mb-2">Belum Ada Artikel</h3>
            <p class="text-gray-500">Artikel akan muncul di sini setelah dipublikasikan.</p>
        </div>
    @endif
</div>

@endsection