@extends('layouts.app')

@section('title', $category->name . ' - HASMI')

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
            transform: scale(1);
        }
        50% {
            opacity: 0.9;
            transform: scale(1.05);
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
    
    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
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
    
    .animate-pulse-custom {
        animation: pulse 2s ease-in-out infinite;
    }
    
    .animate-scale-in {
        animation: scaleIn 0.5s ease-out forwards;
    }
    
    .category-icon-wrapper {
        position: relative;
    }
    
    .category-icon-wrapper::before {
        content: '';
        position: absolute;
        inset: -10px;
        background: linear-gradient(135deg, #3b82f6, #60a5fa, #3b82f6);
        border-radius: 1.5rem;
        opacity: 0.3;
        filter: blur(20px);
        animation: pulse 2s ease-in-out infinite;
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
    
    .filter-btn {
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .filter-btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .filter-btn:hover::before {
        left: 100%;
    }
    
    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }
    
    .filter-btn-active {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        animation: pulse 2s ease-in-out infinite;
    }
    
    .article-card {
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        border: 2px solid rgba(59, 130, 246, 0.1);
    }
    
    .article-card:hover {
        transform: translateY(-12px);
        border-color: rgba(59, 130, 246, 0.4);
        box-shadow: 0 25px 50px rgba(59, 130, 246, 0.25);
    }
    
    .article-card-image {
        transition: all 0.5s ease;
        position: relative;
        overflow: hidden;
    }
    
    .article-card-image::after {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.4) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }
    
    .article-card:hover .article-card-image::after {
        opacity: 1;
    }
    
    .article-card:hover .article-card-image img {
        transform: scale(1.15);
        filter: brightness(1.2);
    }
    
    .badge-sub {
        animation: scaleIn 0.5s ease-out forwards;
        transition: all 0.3s ease;
    }
    
    .badge-sub:hover {
        transform: scale(1.1);
    }
    
    .read-more-btn {
        position: relative;
        transition: all 0.3s ease;
    }
    
    .read-more-btn::after {
        content: '';
        position: absolute;
        bottom: -2px;
        left: 0;
        width: 0;
        height: 2px;
        background: linear-gradient(90deg, #3b82f6, #60a5fa);
        transition: width 0.3s ease;
    }
    
    .read-more-btn:hover::after {
        width: 100%;
    }
    
    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.1), transparent);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }
    
    .title-glow {
        text-shadow: 0 0 40px rgba(59, 130, 246, 0.3);
    }
    
    .divider-line {
        background: linear-gradient(90deg, transparent, #3b82f6, transparent);
        animation: shimmer 3s infinite;
        background-size: 200% 100%;
    }
</style>

<div class="bg-gradient-to-br from-slate-950 via-blue-950/20 to-slate-950 min-h-screen pb-20">
    <div class="container mx-auto px-6 py-12">
        <!-- Header Category -->
        <div class="text-center mb-16 animate-fade-in-up">
            <div class="category-icon-wrapper inline-block mb-6 animate-pulse-custom">
                <div class="w-24 h-24 bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl flex items-center justify-center shadow-2xl shadow-blue-500/40 border-4 border-white/20 relative z-10">
                    <i class="fas {{ $category->icon }} text-white text-5xl animate-float"></i>
                </div>
            </div>
            <h1 class="title-glow text-5xl md:text-6xl font-black text-white mb-6 tracking-tight">{{ $category->name }}</h1>
            <p class="text-blue-100 text-xl max-w-3xl mx-auto leading-relaxed font-light">{{ $category->description }}</p>
            <div class="divider-line w-32 h-1 mx-auto mt-6 rounded-full"></div>
        </div>

        <!-- Breadcrumb -->
        <div class="mb-10 animate-slide-in-left">
            <nav class="flex items-center gap-2 text-sm text-blue-200">
                <a href="{{ route('home') }}" class="breadcrumb-link hover:text-white transition-colors">Beranda</a>
                <i class="fas fa-chevron-right text-xs text-blue-400"></i>
                <a href="{{ route('materi.index') }}" class="breadcrumb-link hover:text-white transition-colors">Materi</a>
                <i class="fas fa-chevron-right text-xs text-blue-400"></i>
                <span class="text-white font-semibold">{{ $category->name }}</span>
            </nav>
        </div>

        <!-- Sub-Categories Filter (if exists) -->
        @if($category->hasSubCategories())
        <div class="mb-12 animate-scale-in">
            <div class="bg-slate-900/50 backdrop-blur-xl rounded-3xl shadow-2xl p-8 border-2 border-blue-400/30">
                <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                    <i class="fas fa-filter text-blue-400 animate-float"></i> 
                    <span>Filter Sub Kategori</span>
                </h3>
                <div class="flex flex-wrap gap-4">
                    <a href="{{ route('materi.show', $category->slug) }}" 
                       class="filter-btn {{ !request()->has('sub') ? 'filter-btn-active text-white' : 'bg-slate-800 text-blue-200 hover:bg-blue-500/20 hover:text-white' }} px-6 py-3 rounded-full font-bold border-2 border-white/20 shadow-lg">
                        <i class="fas fa-list mr-2"></i> Semua
                    </a>
                    @foreach($category->subCategories as $sub)
                    <a href="{{ route('materi.sub-category', [$category->slug, $sub->slug]) }}" 
                       class="filter-btn bg-slate-800 text-blue-200 hover:bg-purple-500/20 hover:text-purple-300 px-6 py-3 rounded-full font-bold border-2 border-blue-400/20 shadow-lg">
                        <i class="fas {{ $sub->icon }} mr-2"></i> {{ $sub->name }}
                    </a>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        <!-- Artikel Grid -->
        @if($articles->count() > 0)
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($articles as $index => $article)
                <article class="article-card bg-slate-900/50 backdrop-blur-xl rounded-3xl shadow-2xl overflow-hidden group animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s">
                    <!-- Thumbnail -->
                    <div class="article-card-image relative h-56 overflow-hidden">
                        @if($article->thumbnail)
                            <img src="{{ asset($article->thumbnail) }}" 
                                 alt="{{ $article->title }}" 
                                 class="w-full h-full object-cover">
                        @else
                            <div class="w-full h-full bg-gradient-to-br from-blue-600 to-blue-800 flex items-center justify-center">
                                <i class="fas {{ $category->icon }} text-white text-6xl animate-float"></i>
                            </div>
                        @endif
                        
                        <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-slate-900/50 to-transparent"></div>

                        <!-- Sub-Category Badge (if exists) -->
                        @if($article->subCategory)
                        <div class="absolute top-4 left-4">
                            <span class="badge-sub px-4 py-2 bg-gradient-to-r from-purple-500 to-purple-700 text-white text-xs font-bold rounded-full shadow-lg shadow-purple-500/40 border-2 border-white/30 backdrop-blur-sm">
                                <i class="fas {{ $article->subCategory->icon }} mr-1"></i>
                                {{ $article->subCategory->name }}
                            </span>
                        </div>
                        @endif
                    </div>

                    <!-- Content -->
                    <div class="p-6">
                        <!-- Meta Info -->
                        <div class="flex items-center gap-4 text-xs text-blue-300 mb-4 font-semibold">
                            <span class="flex items-center gap-2 bg-blue-500/20 px-3 py-1 rounded-full">
                                <i class="far fa-calendar"></i> 
                                {{ $article->published_at->format('d M Y') }}
                            </span>
                            <span class="flex items-center gap-2 bg-slate-800 px-3 py-1 rounded-full">
                                <i class="far fa-user"></i> 
                                {{ $article->author->name }}
                            </span>
                        </div>

                        <!-- Title -->
                        <h3 class="text-xl font-bold text-white mb-3 line-clamp-2 group-hover:text-blue-400 transition-colors leading-snug">
                            {{ $article->title }}
                        </h3>

                        <!-- Excerpt -->
                        <p class="text-blue-100 mb-5 line-clamp-3 leading-relaxed font-light text-sm">{{ $article->excerpt }}</p>

                        <!-- Read More Button -->
                        <a href="{{ route('materi.detail', [$category->slug, $article->slug]) }}" 
                           class="read-more-btn inline-flex items-center text-blue-400 font-bold hover:text-white transition-all group">
                            Baca Selengkapnya 
                            <i class="fas fa-arrow-right ml-2 group-hover:translate-x-2 transition-transform"></i>
                        </a>
                    </div>
                </article>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-16 animate-fade-in-up">
                {{ $articles->links() }}
            </div>

        @else
            <!-- Empty State -->
            <div class="text-center py-20 bg-slate-900/50 backdrop-blur-xl rounded-[3rem] shadow-2xl border-2 border-blue-500/20 animate-scale-in">
                <div class="category-icon-wrapper inline-block mb-8">
                    <div class="w-28 h-28 bg-gradient-to-br from-blue-500 to-blue-700 rounded-3xl flex items-center justify-center shadow-2xl shadow-blue-500/40 border-4 border-white/20 relative z-10">
                        <i class="fas {{ $category->icon }} text-white text-6xl animate-float"></i>
                    </div>
                </div>
                <h3 class="text-3xl font-black text-white mb-4">Belum Ada Artikel</h3>
                <p class="text-blue-200 mb-8 text-lg">
                    Kategori <strong class="text-blue-400">{{ $category->name }}</strong> belum memiliki artikel yang dipublikasikan.
                </p>
                <a href="{{ route('materi.index') }}" 
                   class="inline-flex items-center gap-3 px-8 py-4 bg-gradient-to-r from-blue-500 to-blue-700 text-white font-black rounded-2xl hover:from-blue-600 hover:to-blue-800 transition-all shadow-xl shadow-blue-500/40 border-2 border-white/20 hover:scale-105">
                    <i class="fas fa-arrow-left"></i> 
                    <span>Lihat Semua Materi</span>
                </a>
            </div>
        @endif
    </div>
</div>

<style>
    /* Custom Pagination Styling */
    .pagination {
        display: flex;
        justify-content: center;
        gap: 0.5rem;
        flex-wrap: wrap;
    }
    
    .pagination > * {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        min-width: 3rem;
        height: 3rem;
        padding: 0 1rem;
        background: rgba(15, 23, 42, 0.5);
        backdrop-filter: blur(12px);
        border: 2px solid rgba(59, 130, 246, 0.2);
        border-radius: 1rem;
        color: #93c5fd;
        font-weight: 700;
        transition: all 0.3s ease;
    }
    
    .pagination > *:hover {
        background: rgba(59, 130, 246, 0.2);
        border-color: rgba(59, 130, 246, 0.4);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.3);
    }
    
    .pagination .active {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        border-color: rgba(255, 255, 255, 0.3);
        color: white;
        box-shadow: 0 8px 20px rgba(59, 130, 246, 0.4);
    }
    
    .pagination .disabled {
        opacity: 0.3;
        cursor: not-allowed;
    }
    
    .pagination .disabled:hover {
        background: rgba(15, 23, 42, 0.5);
        border-color: rgba(59, 130, 246, 0.2);
        color: #93c5fd;
        transform: none;
        box-shadow: none;
    }
</style>

<script>
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
    
    document.querySelectorAll('.animate-fade-in-up, .animate-slide-in-left, .animate-scale-in').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        observer.observe(el);
    });
</script>

@endsection