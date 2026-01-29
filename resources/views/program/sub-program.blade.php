@extends('layouts.app')

@section('title', $subcategory->name . ' - ' . $category->name . ' - Program HASMI')

@section('content')

{{-- Breadcrumb --}}
<section class="bg-light py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('program.index') }}">Program</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('program.category', $category->slug) }}">{{ $category->name }}</a>
                </li>
                <li class="breadcrumb-item active">{{ $subcategory->name }}</li>
            </ol>
        </nav>
    </div>
</section>

{{-- Header --}}
<section class="py-5 bg-gradient-to-br from-purple-50 to-white">
    <div class="container">
        <div class="text-center">
            <div class="d-inline-flex align-items-center justify-content-center mb-4"
                 style="width: 90px; height: 90px; background: linear-gradient(135deg, #9333ea 0%, #db2777 100%); border-radius: 20px;">
                <i class="fas fa-folder-open fa-3x text-white"></i>
            </div>
            <h1 class="display-5 fw-bold mb-2">{{ $subcategory->name }}</h1>
            <p class="lead text-muted">Bagian dari {{ $category->name }}</p>
            <div class="mx-auto mt-3" style="width: 60px; height: 3px; background: linear-gradient(90deg, #9333ea 0%, #db2777 100%); border-radius: 2px;"></div>
        </div>
    </div>
</section>

{{-- Programs Grid --}}
<section class="py-5">
    <div class="container">
        @if($programs->count() > 0)
            <div class="row g-4">
                @foreach($programs as $program)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 border-0 shadow-sm hover-lift">
                            
                            {{-- Thumbnail --}}
                            @if($program->thumbnail)
                                <div class="position-relative overflow-hidden" style="height: 220px;">
                                    <img src="{{ $program->getThumbnailUrl() }}" 
                                         class="card-img-top h-100 w-100" 
                                         alt="{{ $program->title }}"
                                         style="object-fit: cover;">
                                    
                                    {{-- Media Type Badge --}}
                                    <div class="position-absolute top-0 end-0 m-3">
                                        @if($program->isVideo())
                                            <span class="badge bg-danger">
                                                <i class="fas fa-video me-1"></i> Video
                                            </span>
                                        @else
                                            <span class="badge bg-success">
                                                <i class="fas fa-image me-1"></i> Foto
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title fw-bold mb-2">{{ $program->title }}</h5>
                                <p class="card-text text-muted flex-grow-1">
                                    {{ Str::limit($program->description, 120) }}
                                </p>
                                
                                <a href="{{ route('program.show', $program->slug) }}" 
                                   class="btn btn-outline-primary mt-3">
                                    Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Pagination --}}
            @if($programs->hasPages())
                <div class="mt-5 d-flex justify-content-center">
                    {{ $programs->links() }}
                </div>
            @endif
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-5x text-muted mb-3"></i>
                <h4 class="text-muted mb-3">Belum Ada Program</h4>
                <p class="text-muted mb-4">Program untuk sub-kategori ini akan segera tersedia.</p>
                <a href="{{ route('program.category', $category->slug) }}" class="btn btn-primary">
                    <i class="fas fa-arrow-left me-2"></i> Kembali ke {{ $category->name }}
                </a>
            </div>
        @endif
    </div>
</section>

<style>
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
}

.bg-gradient-to-br {
    background: linear-gradient(to bottom right, #faf5ff, #ffffff);
}
</style>

@endsection