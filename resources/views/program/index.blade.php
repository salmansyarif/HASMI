@extends('layouts.app')

@section('title', 'Program HASMI')

@section('content')

{{-- Hero Section --}}
<section class="bg-gradient-to-br from-blue-600 to-blue-800 text-white py-5">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8">
                <h1 class="display-4 fw-bold mb-3">Program HASMI</h1>
                <p class="lead mb-0">Berbagai program kemanusiaan dan dakwah untuk membangun peradaban Islam</p>
            </div>
            <div class="col-lg-4 text-center text-lg-end">
                <i class="fas fa-hands-helping" style="font-size: 120px; opacity: 0.2;"></i>
            </div>
        </div>
    </div>
</section>

{{-- Categories Grid --}}
<section class="py-5">
    <div class="container">
        @if($categories->count() > 0)
            <div class="row g-4">
                @foreach($categories as $category)
                    <div class="col-lg-4 col-md-6">
                        <div class="card h-100 shadow-sm hover-lift border-0">
                            
                            <div class="card-body d-flex flex-column">
                                {{-- Icon --}}
                                <div class="mb-3">
                                    <div class="d-inline-flex align-items-center justify-center"
                                         style="width: 70px; height: 70px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 15px;">
                                        <i class="fas fa-th-large fa-2x text-white"></i>
                                    </div>
                                </div>
                                
                                <h5 class="card-title fw-bold mb-2">{{ $category->name }}</h5>
                                
                                {{-- Badges --}}
                                <div class="mb-3">
                                    @if($category->has_subcategories)
                                        <span class="badge bg-info">
                                            <i class="fas fa-folder-open me-1"></i> 
                                            {{ $category->subcategories->count() }} Sub Kategori
                                        </span>
                                    @endif
                                    
                                    @if(!$category->is_creatable)
                                        @if($category->redirect_type === 'youtube')
                                            <span class="badge bg-danger">
                                                <i class="fas fa-youtube me-1"></i> YouTube
                                            </span>
                                        @elseif($category->redirect_type === 'static')
                                            <span class="badge bg-secondary">
                                                <i class="fas fa-link me-1"></i> Halaman Khusus
                                            </span>
                                        @endif
                                    @else
                                        <span class="badge bg-success">
                                            <i class="fas fa-check-circle me-1"></i> 
                                            {{ $category->programs->where('is_active', true)->count() }} Program
                                        </span>
                                    @endif
                                </div>
                                
                                {{-- Action Button --}}
                                <div class="mt-auto">
                                    @if($category->shouldRedirect())
                                        <a href="{{ $category->getRedirectUrl() }}" 
                                           @if($category->redirect_type === 'youtube') target="_blank" @endif
                                           class="btn btn-primary w-100">
                                            @if($category->redirect_type === 'youtube')
                                                <i class="fab fa-youtube me-2"></i> Tonton di YouTube
                                            @else
                                                Lihat Halaman <i class="fas fa-arrow-right ms-1"></i>
                                            @endif
                                        </a>
                                    @else
                                        <a href="{{ route('program.category', $category->slug) }}" 
                                           class="btn btn-outline-primary w-100">
                                            Lihat Program <i class="fas fa-arrow-right ms-1"></i>
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="text-center py-5">
                <i class="fas fa-inbox fa-5x text-muted mb-3"></i>
                <h4 class="text-muted">Belum ada program tersedia</h4>
            </div>
        @endif
    </div>
</section>

<style>
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-10px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
}

.bg-gradient-to-br {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
</style>

@endsection