@extends('layouts.app')

@section('title', $category->name . ' - HASMI')

@section('content')

<div class="container mx-auto px-6 py-12">
    <!-- Header Category -->
    <div class="text-center mb-12">
        <h1 class="text-4xl font-bold text-gray-800 mb-4">{{ $category->name }}</h1>
        <div class="w-24 h-1 bg-gradient-to-r from-blue-600 to-blue-400 mx-auto mt-4"></div>
    </div>

    <!-- Breadcrumb -->
    <div class="mb-8">
        <nav class="flex items-center gap-2 text-sm text-gray-600">
            <a href="{{ route('home') }}" class="hover:text-blue-600">Beranda</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('program.index') }}" class="hover:text-blue-600">Program</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-gray-800 font-semibold">{{ $category->name }}</span>
        </nav>
    </div>

    <!-- Sub-Categories Filter (if exists) -->
    @if($category->has_subcategories && $subcategories->count() > 0)
    <div class="mb-8">
        <div class="bg-white rounded-2xl shadow-lg p-6">
            <h3 class="text-lg font-semibold text-gray-800 mb-4">
                <i class="fas fa-filter mr-2"></i> Kategori {{ $category->name }}
            </h3>
            <div class="flex flex-wrap gap-3">
                <a href="{{ route('program.category', $category->slug) }}" 
                   class="px-4 py-2 rounded-full {{ !request()->route('subcategorySlug') ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-700 hover:bg-gray-300' }} transition-colors font-semibold">
                    <i class="fas fa-list mr-1"></i> Semua
                </a>
                @foreach($subcategories as $sub)
                <a href="{{ route('program.subcategory', [$category->slug, $sub->slug]) }}" 
                   class="px-4 py-2 rounded-full bg-gray-200 text-gray-700 hover:bg-blue-100 hover:text-blue-700 transition-colors font-semibold">
                    {{ $sub->name }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
    @endif

    <!-- Program Grid -->
    @if($programs->count() > 0)
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($programs as $program)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden card-hover group h-full flex flex-col">
                <!-- Thumbnail -->
                <div class="relative h-48 overflow-hidden">
                    @if($program->thumbnail)
                        <img src="{{ asset('storage/' . $program->thumbnail) }}" 
                             alt="{{ $program->title }}" 
                             class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-300">
                    @else
                        <div class="w-full h-full hero-gradient flex items-center justify-center">
                            <i class="fas fa-hand-holding-heart text-white text-5xl"></i>
                        </div>
                    @endif

                    <!-- Sub-Category Badge (if exists) -->
                    @if($program->subcategory)
                    <div class="absolute top-4 left-4">
                        <span class="px-3 py-1 bg-green-600 text-white text-xs font-semibold rounded-full">
                            {{ $program->subcategory->name }}
                        </span>
                    </div>
                    @endif
                </div>

                <!-- Content -->
                <div class="p-6 flex flex-col flex-grow">
                    <!-- Title -->
                    <h3 class="text-xl font-bold text-gray-800 mb-3 line-clamp-2 group-hover:text-blue-600 transition-colors">
                        {{ $program->title }}
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-gray-600 mb-4 line-clamp-3">{{ $program->description }}</p>

                    <!-- Read More Button -->
                    <div class="mt-auto pt-4 border-t border-gray-100">
                        <a href="{{ route('program.show', $program->slug) }}" 
                           class="inline-flex items-center text-blue-600 font-semibold hover:gap-2 transition-all">
                            Lihat Detail 
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-1 transition-transform"></i>
                        </a>
                    </div>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Pagination -->
        <div class="mt-12">
            {{ $programs->links() }}
        </div>

    @else
        <!-- Empty State -->
        <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
            <div class="w-24 h-24 hero-gradient rounded-2xl flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-folder-open text-white text-5xl"></i>
            </div>
            <h3 class="text-2xl font-bold text-gray-800 mb-2">Belum Ada Program</h3>
            <p class="text-gray-600 mb-6">Kategori <strong>{{ $category->name }}</strong> belum memiliki program aktif.</p>
            <a href="{{ route('program.index') }}" class="inline-block px-6 py-3 bg-blue-600 text-white font-semibold rounded-xl hover:bg-blue-700 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i> Lihat Semua Program
            </a>
        </div>
    @endif
</div>

@endsection
