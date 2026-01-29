@extends('layouts.app')

@section('title', $category->name . ' - HASMI')

@section('content')

<div class="container mx-auto px-6 py-12">
    <!-- Header Category -->
    <div class="text-center mb-12">
        <div class="inline-block mb-4">
            <div class="w-20 h-20 hero-gradient rounded-2xl flex items-center justify-center">
                <i class="fas {{ $category->icon }} text-white text-4xl"></i>
            </div>
        </div>
        <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $category->name }}</h1>
        <p class="text-gray-600 text-lg max-w-2xl mx-auto">{{ $category->description }}</p>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-blue-400 mx-auto mt-4"></div>
    </div>

    <!-- Breadcrumb -->
    <div class="mb-8">
        <nav class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('materi.index') }}" class="hover:text-blue-600">Materi</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-800 font-semibold">{{ $category->name }}</span>
        </nav>
    </div>

    <!-- Sub-Categories Filter (if exists) -->
    @if($category->hasSubCategories())
    <div class="mb-8">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-filter mr-2"></i> Filter Sub Kategori
            </h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('materi.show', $category->slug) }}" 
                   class="px-4 py-2 rounded-full {{ !request()->has('sub') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors font-semibold">
                    <i class="fas fa-list mr-1"></i> Semua
                </a>
                @foreach($category->subCategories as $sub)
                <a href="{{ route('materi.sub-category', [$category->slug, $sub->slug]) }}" 
                   class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-purple-100 hover:text-purple-700 transition-colors font-semibold">
                    <i class="fas {{ $sub->icon }} mr-1"></i> {{ $sub->name }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

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
                            <i class="fas {{ $category->icon }} text-white text-5xl"></i>
                        </div>
                    @endif

                    <!-- Sub-Category Badge (if exists) -->
                    @if($article->subCategory)
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-purple-600 text-white text-xs font-semibold rounded-full">
                            <i class="fas {{ $article->subCategory->icon }} mr-1"></i>
                            {{ $article->subCategory->name }}
                        </span>
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
        <!-- Empty State (Jika category kosong) -->
        <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
            <div class="w-24 h-24 hero-gradient rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas {{ $category->icon }} text-white text-5xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Artikel</h3>
            <p class="text-gray-600 mb-6">Kategori <strong>{{ $category->name }}</strong> belum memiliki artikel yang dipublikasikan.</p>
            <a href="{{ route('materi.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Lihat Semua Materi
            </a>
        </div>
    @endif
</div>

@endsection