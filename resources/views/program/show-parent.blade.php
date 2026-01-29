@extends('layouts.app')

@section('title', $category->name . ' - Program HASMI')

@section('content')

{{-- Breadcrumb --}}
<section class="bg-light py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('program.index') }}">Program</a></li>
                <li class="breadcrumb-item active">{{ $category->name }}</li>
            </ol>
        </nav>
    </div>
</section>

{{-- Header --}}
<section class="py-5 bg-gradient-to-br from-purple-50 to-white">
    <div class="container">
        <div class="text-center">
            <div class="d-inline-flex align-items-center justify-content-center mb-4"
                 style="width: 100px; height: 100px; background: linear-gradient(135deg, #9333ea 0%, #db2777 100%); border-radius: 25px;">
                <i class="fas fa-hand-holding-heart fa-3x text-white"></i>
            </div>
            <h1 class="display-4 fw-bold mb-3">{{ $category->name }}</h1>
            <p class="lead text-muted">
                @if($category->has_subcategories)
                    Pilih sub kategori program yang ingin Anda lihat
                @else
                    Daftar program dalam kategori {{ $category->name }}
                @endif
            </p>
            <div class="mx-auto mt-3" style="width: 80px; height: 4px; background: linear-gradient(90deg, #9333ea 0%, #db2777 100%); border-radius: 2px;"></div>
        </div>
    </div>
</section>

{{-- Jika punya subcategories, tampilkan subcategories --}}
@if($category->has_subcategories)
    <section class="py-5">
        <div class="container">
            @if($subcategories->count() > 0)
                <div class="row g-4">
                    @foreach($subcategories as $subcategory)
                        <div class="col-lg-3 col-md-6">
                            <div class="card h-100 border-0 shadow-sm hover-lift text-center">
                                <div class="card-body d-flex flex-column align-items-center justify-content-center py-5">
                                    
                                    <div class="mb-3">
                                        <div class="d-inline-flex align-items-center justify-content-center"
                                             style="width: 80px; height: 80px; background: linear-gradient(135deg, #9333ea 0%, #db2777 100%); border-radius: 20px;">
                                            <i class="fas fa-folder-open fa-2x text-white"></i>
                                        </div>
                                    </div>
                                    
                                    <h5 class="card-title fw-bold mb-2">{{ $subcategory->name }}</h5>
                                    
                                    <span class="badge bg-primary mb-3">
                                        {{ $subcategory->programs->where('is_active', true)->count() }} Program
                                    </span>
                                    
                                    <a href="{{ route('program.subcategory', [$category->slug, $subcategory->slug]) }}" 
                                       class="btn btn-outline-primary mt-auto">
                                        Lihat Program <i class="fas fa-arrow-right ms-1"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-inbox fa-5x text-muted mb-3"></i>
                    <h4 class="text-muted">Belum ada sub kategori</h4>
                </div>
            @endif
        </div>
    </section>

{{-- Jika tidak punya subcategories, tampilkan programs langsung --}}
@else
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
                    <p class="text-muted mb-4">Program untuk kategori ini akan segera tersedia.</p>
                </div>
            @endif
        </div>
    </section>
@endif

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