@extends('layouts.app')

@section('title', $program->title . ' - Program HASMI')

@section('content')

{{-- Breadcrumb --}}
<section class="bg-light py-3">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb mb-0">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Beranda</a></li>
                <li class="breadcrumb-item"><a href="{{ route('program.index') }}">Program</a></li>
                <li class="breadcrumb-item">
                    <a href="{{ route('program.category', $program->category->slug) }}">
                        {{ $program->category->name }}
                    </a>
                </li>
                @if($program->subcategory)
                    <li class="breadcrumb-item">
                        <a href="{{ route('program.subcategory', [$program->category->slug, $program->subcategory->slug]) }}">
                            {{ $program->subcategory->name }}
                        </a>
                    </li>
                @endif
                <li class="breadcrumb-item active">{{ $program->title }}</li>
            </ol>
        </nav>
    </div>
</section>

{{-- Hero Section --}}
<section class="py-5 bg-gradient-to-br from-blue-50 to-white">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-{{ $program->thumbnail && $program->media_position === 'top' ? '12' : '7' }}">
                
                {{-- Title --}}
                <h1 class="display-4 fw-bold mb-3">{{ $program->title }}</h1>

                {{-- Badges --}}
                <div class="mb-3">
                    <span class="badge bg-primary me-2 px-3 py-2">
                        <i class="fas fa-folder me-1"></i>
                        {{ $program->category->name }}
                    </span>

                    @if($program->subcategory)
                        <span class="badge bg-purple me-2 px-3 py-2">
                            <i class="fas fa-folder-open me-1"></i>
                            {{ $program->subcategory->name }}
                        </span>
                    @endif

                    @if($program->isVideo())
                        <span class="badge bg-danger px-3 py-2">
                            <i class="fas fa-video me-1"></i> Video
                        </span>
                    @else
                        <span class="badge bg-success px-3 py-2">
                            <i class="fas fa-image me-1"></i> Galeri Foto
                        </span>
                    @endif
                </div>

                {{-- Description --}}
                <p class="lead text-muted mb-4">{{ $program->description }}</p>
            </div>

            {{-- Thumbnail (if position is left or right) --}}
            @if($program->thumbnail && in_array($program->media_position, ['left', 'right']))
                <div class="col-lg-5 mt-4 mt-lg-0 {{ $program->media_position === 'left' ? 'order-first' : '' }}">
                    <img src="{{ $program->getThumbnailUrl() }}"
                         class="img-fluid rounded-3 shadow-lg"
                         alt="{{ $program->title }}"
                         style="object-fit: cover; max-height: 400px; width: 100%;">
                </div>
            @endif
        </div>

        {{-- Thumbnail (if position is top) --}}
        @if($program->thumbnail && $program->media_position === 'top')
            <div class="row mt-4">
                <div class="col-12">
                    <img src="{{ $program->getThumbnailUrl() }}"
                         class="img-fluid rounded-3 shadow-lg w-100"
                         alt="{{ $program->title }}"
                         style="object-fit: cover; max-height: 500px;">
                </div>
            </div>
        @endif
    </div>
</section>

{{-- Content Section --}}
@if($program->content)
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="card border-0 shadow-sm">
                    <div class="card-body p-4 p-lg-5">
                        <h3 class="h4 fw-bold mb-4">
                            <i class="fas fa-info-circle text-primary me-2"></i>
                            Tentang Program
                        </h3>
                        <div class="content-text" style="line-height: 1.8; font-size: 1.05rem;">
                            {!! nl2br(e($program->content)) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Video Section --}}
@if($program->isVideo() && $program->video_url)
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-4">
                    <h3 class="h4 fw-bold">
                        <i class="fas fa-video text-danger me-2"></i>
                        Video Program
                    </h3>
                </div>
                
                <div class="ratio ratio-16x9 rounded-3 overflow-hidden shadow-lg">
                    @if(filter_var($program->video_url, FILTER_VALIDATE_URL))
                        {{-- External video URL (YouTube, Vimeo, etc) --}}
                        <iframe src="{{ $program->video_url }}" 
                                allowfullscreen
                                frameborder="0"></iframe>
                    @else
                        {{-- Video file uploaded --}}
                        <video controls class="w-100">
                            <source src="{{ Storage::url($program->video_url) }}" type="video/mp4">
                            Browser Anda tidak mendukung video.
                        </video>
                    @endif
                </div>
            </div>
        </div>
    </div>
</section>
@endif

{{-- Photo Gallery --}}
@if($program->isImage() && $program->hasPhotos())
<section class="py-5 {{ $program->video_url ? 'bg-white' : 'bg-light' }}">
    <div class="container">
        <div class="text-center mb-4">
            <h3 class="h4 fw-bold">
                <i class="fas fa-images text-primary me-2"></i>
                Galeri Foto
            </h3>
        </div>

        <div class="row g-3">
            @foreach($program->getPhotosUrls() as $photo)
                <div class="col-lg-3 col-md-4 col-6">
                    <div class="position-relative overflow-hidden rounded-3 shadow-sm hover-zoom-container">
                        <img src="{{ $photo }}"
                             class="img-fluid hover-zoom-img"
                             alt="Foto {{ $program->title }}"
                             style="height: 200px; width: 100%; object-fit: cover; cursor: pointer;"
                             onclick="openPhotoModal('{{ $photo }}')">
                        <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-0 hover-overlay transition-all"></div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

{{-- Photo Modal (Simple Lightbox) --}}
<div class="modal fade" id="photoModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content bg-transparent border-0">
            <div class="modal-body p-0 position-relative">
                <button type="button" class="btn-close btn-close-white position-absolute top-0 end-0 m-3" 
                        data-bs-dismiss="modal" aria-label="Close" style="z-index: 10;"></button>
                <img id="modalPhoto" src="" class="img-fluid rounded-3" alt="Foto">
            </div>
        </div>
    </div>
</div>
@endif

{{-- Thumbnail at Bottom (if position is bottom) --}}
@if($program->thumbnail && $program->media_position === 'bottom')
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <img src="{{ $program->getThumbnailUrl() }}"
                     class="img-fluid rounded-3 shadow-lg w-100"
                     alt="{{ $program->title }}"
                     style="object-fit: cover; max-height: 500px;">
            </div>
        </div>
    </div>
</section>
@endif

{{-- Comment Section --}}
<section class="py-5 bg-white">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                
                {{-- Comment Header --}}
                <div class="mb-4">
                    <h3 class="h4 fw-bold mb-2">
                        <i class="fas fa-comments text-primary me-2"></i>
                        Komentar ({{ $program->comments->where('is_approved', true)->count() }})
                    </h3>
                    <p class="text-muted">Bagikan pendapat Anda tentang program ini</p>
                </div>

                {{-- Comment Form --}}
                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body p-4">
                        <h5 class="fw-bold mb-3">Tulis Komentar</h5>
                        
                        <form action="{{ route('comment.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="commentable_type" value="App\Models\Program">
                            <input type="hidden" name="commentable_id" value="{{ $program->id }}">

                            <div class="mb-3">
                                <label for="name" class="form-label fw-semibold">Nama <span class="text-danger">*</span></label>
                                <input type="text" 
                                       class="form-control @error('name') is-invalid @enderror" 
                                       id="name" 
                                       name="name" 
                                       value="{{ old('name', Auth::check() ? Auth::user()->name : '') }}"
                                       placeholder="Masukkan nama Anda" 
                                       required>
                                @error('name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="mb-3">
                                <label for="email" class="form-label fw-semibold">Email <span class="text-danger">*</span></label>
                                <input type="email" 
                                       class="form-control @error('email') is-invalid @enderror" 
                                       id="email" 
                                       name="email" 
                                       value="{{ old('email', Auth::check() ? Auth::user()->email : '') }}"
                                       placeholder="email@example.com" 
                                       required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">Email tidak akan dipublikasikan</small>
                            </div>

                            <div class="mb-3">
                                <label for="comment" class="form-label fw-semibold">Komentar <span class="text-danger">*</span></label>
                                <textarea class="form-control @error('comment') is-invalid @enderror" 
                                          id="comment" 
                                          name="comment" 
                                          rows="4" 
                                          placeholder="Tulis komentar Anda di sini..." 
                                          required>{{ old('comment') }}</textarea>
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-paper-plane me-2"></i>
                                Kirim Komentar
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Success Message --}}
                @if(session('comment_success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <i class="fas fa-check-circle me-2"></i>
                        {{ session('comment_success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif

                {{-- Comments List --}}
                <div class="comments-list">
                    @forelse($program->comments->where('is_approved', true)->sortByDesc('created_at') as $comment)
                        <div class="card border-0 shadow-sm mb-3">
                            <div class="card-body p-4">
                                <div class="d-flex align-items-start">
                                    <div class="flex-shrink-0">
                                        <div class="d-flex align-items-center justify-content-center rounded-circle bg-primary text-white"
                                             style="width: 50px; height: 50px;">
                                            <i class="fas fa-user fa-lg"></i>
                                        </div>
                                    </div>
                                    <div class="flex-grow-1 ms-3">
                                        <h6 class="fw-bold mb-1">{{ $comment->name }}</h6>
                                        <p class="text-muted small mb-2">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ $comment->created_at->diffForHumans() }}
                                        </p>
                                        <p class="mb-0">{{ $comment->comment }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="text-center py-5">
                            <i class="fas fa-comments fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</section>

{{-- Related Programs Section --}}
@if(isset($relatedPrograms) && $relatedPrograms->count() > 0)
<section class="py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h3 class="h4 fw-bold">Program Terkait</h3>
            <p class="text-muted">Program lainnya yang mungkin Anda minati</p>
        </div>

        <div class="row g-4">
            @foreach($relatedPrograms as $related)
                <div class="col-lg-4 col-md-6">
                    <div class="card h-100 border-0 shadow-sm hover-lift">
                        
                        @if($related->thumbnail)
                            <img src="{{ $related->getThumbnailUrl() }}"
                                 class="card-img-top"
                                 alt="{{ $related->title }}"
                                 style="height: 180px; object-fit: cover;">
                        @endif

                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $related->title }}</h5>
                            <p class="card-text text-muted">
                                {{ Str::limit($related->description, 100) }}
                            </p>

                            <a href="{{ route('program.show', $related->slug) }}"
                               class="btn btn-outline-primary">
                                Lihat Detail <i class="fas fa-arrow-right ms-1"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

<style>
/* Hover Effects */
.hover-lift {
    transition: all 0.3s ease;
}

.hover-lift:hover {
    transform: translateY(-8px);
    box-shadow: 0 15px 35px rgba(0,0,0,0.15) !important;
}

.hover-zoom-container {
    transition: all 0.3s ease;
}

.hover-zoom-container:hover .hover-zoom-img {
    transform: scale(1.1);
}

.hover-zoom-img {
    transition: transform 0.5s ease;
}

.hover-zoom-container:hover .hover-overlay {
    background-color: rgba(0,0,0,0.3) !important;
}

.hover-overlay {
    transition: background-color 0.3s ease;
}

/* Custom Badge Color */
.bg-purple {
    background-color: #9333ea !important;
}

/* Gradient Background */
.bg-gradient-to-br {
    background: linear-gradient(to bottom right, #eff6ff, #ffffff);
}

/* Comment Styles */
.comments-list .card {
    transition: all 0.2s ease;
}

.comments-list .card:hover {
    transform: translateX(5px);
}
</style>

@endsection

@if($program->hasPhotos())
@push('scripts')
<script>
function openPhotoModal(photoUrl) {
    document.getElementById('modalPhoto').src = photoUrl;
    var photoModal = new bootstrap.Modal(document.getElementById('photoModal'));
    photoModal.show();
}
</script>
@endpush
@endif