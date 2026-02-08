@extends('layouts.app')

@section('title', $kegiatan->title . ' - Kegiatan HASMI')

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
    
    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.8;
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
    
    @keyframes float {
        0%, 100% {
            transform: translateY(0px);
        }
        50% {
            transform: translateY(-10px);
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
    
    .animate-fade-in-up {
        animation: fadeInUp 0.6s ease-out forwards;
    }
    
    .animate-slide-in-left {
        animation: slideInLeft 0.5s ease-out forwards;
    }
    
    .animate-float {
        animation: float 3s ease-in-out infinite;
    }
    
    .prose-custom {
        color: #dbeafe;
        line-height: 1.8;
    }
    .prose-custom p { 
        margin-bottom: 1.5rem;
    }
    
    .gallery-item {
        cursor: pointer;
        overflow: hidden;
        border-radius: 1.5rem;
        aspect-ratio: 1;
        border: 2px solid rgba(59, 130, 246, 0.4);
        position: relative;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .gallery-item::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.3) 0%, transparent 100%);
        opacity: 0;
        transition: opacity 0.4s ease;
        z-index: 1;
    }
    
    .gallery-item:hover::before {
        opacity: 1;
    }
    
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .gallery-item:hover {
        transform: translateY(-8px);
        border-color: rgba(96, 165, 250, 0.7);
        box-shadow: 0 20px 40px rgba(59, 130, 246, 0.5);
    }
    
    .gallery-item:hover img {
        transform: scale(1.15);
        filter: brightness(1.2);
    }
    
    .lightbox {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(29, 78, 216, 0.95);
        backdrop-filter: blur(20px);
        align-items: center;
        justify-content: center;
        animation: fadeInUp 0.3s ease-out;
    }
    
    .lightbox.active { 
        display: flex;
    }
    
    .lightbox-content {
        max-width: 90%;
        max-height: 85%;
        object-fit: contain;
        border-radius: 16px;
        box-shadow: 0 25px 50px -12px rgba(59, 130, 246, 0.7);
        border: 3px solid rgba(96, 165, 250, 0.5);
        animation: fadeInUp 0.4s ease-out;
    }
    
    .btn-gradient {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }
    
    .btn-gradient::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        transition: left 0.5s ease;
    }
    
    .btn-gradient:hover::before {
        left: 100%;
    }
    
    .btn-gradient:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 30px rgba(59, 130, 246, 0.6);
    }
    
    .badge-date {
        background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
        animation: pulse 2s ease-in-out infinite;
    }
    
    .comment-card {
        transition: all 0.3s ease;
        border: 1px solid rgba(59, 130, 246, 0.2);
    }
    
    .comment-card:hover {
        transform: translateX(8px);
        border-color: rgba(59, 130, 246, 0.5);
        box-shadow: 0 8px 24px rgba(59, 130, 246, 0.3);
    }
    
    .input-glow:focus {
        box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.3), 0 0 20px rgba(59, 130, 246, 0.4);
    }
    
    .share-btn {
        transition: all 0.3s ease;
        position: relative;
    }
    
    .share-btn:hover {
        transform: scale(1.15) rotate(5deg);
    }
    
    .back-link {
        transition: all 0.3s ease;
    }
    
    .back-link:hover {
        transform: translateX(-5px);
    }
    
    .title-glow {
        text-shadow: 0 0 40px rgba(59, 130, 246, 0.4);
    }
    
    .hero-image {
        position: relative;
        overflow: hidden;
    }
    
    .hero-image::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(180deg, transparent 0%, rgba(29, 78, 216, 0.9) 100%);
    }
    
    .shimmer-effect {
        background: linear-gradient(90deg, transparent, rgba(59, 130, 246, 0.15), transparent);
        background-size: 200% 100%;
        animation: shimmer 2s infinite;
    }
</style>

<div class="bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 min-h-screen pb-20">
    <div class="container mx-auto px-6 pt-12 mb-8">
        <a href="{{ route('kegiatan.index') }}" 
           class="back-link inline-flex items-center gap-2 text-blue-200 hover:text-white font-bold transition-all group">
            <i class="fas fa-arrow-left group-hover:-translate-x-2 transition-transform duration-300"></i> 
            KEMBALI KE DAFTAR KEGIATAN
        </a>
    </div>

    <div class="container mx-auto px-6">
        <div class="max-w-5xl mx-auto">
            <article class="bg-blue-700/60 backdrop-blur-xl rounded-[3rem] shadow-[0_0_80px_rgba(59,130,246,0.4)] overflow-hidden border-2 border-blue-400/50 animate-fade-in-up">
                
                @if($kegiatan->photo_position == 'top' && $kegiatan->thumbnail)
                <div class="hero-image w-full h-[500px] overflow-hidden relative">
                    <img src="{{ asset($kegiatan->thumbnail) }}" alt="{{ $kegiatan->title }}" class="w-full h-full object-cover transition-transform duration-700 hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-blue-800 via-blue-700/50 to-transparent"></div>
                </div>
                @endif

                <div class="p-8 md:p-16">
                    <div class="flex flex-wrap items-center gap-6 mb-8 animate-slide-in-left">
                        @if($kegiatan->event_date)
                        <div class="badge-date flex items-center gap-3 px-5 py-3 rounded-full text-white text-xs font-bold uppercase tracking-widest shadow-[0_0_30px_rgba(59,130,246,0.5)] border-2 border-blue-400/40">
                            <i class="far fa-calendar-alt animate-float"></i>
                            <span>{{ $kegiatan->event_date->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                        </div>
                        @endif
                        @if($kegiatan->location)
                        <div class="flex items-center gap-3 px-5 py-3 bg-blue-600/50 backdrop-blur-md rounded-full border-2 border-blue-400/40 text-blue-50 text-xs font-bold uppercase tracking-widest transition-all duration-300 hover:bg-blue-500/60 hover:border-blue-300">
                            <i class="fas fa-map-marker-alt text-blue-200"></i>
                            <span>{{ $kegiatan->location }}</span>
                        </div>
                        @endif
                    </div>

                    <h1 class="title-glow text-4xl md:text-6xl font-black text-white mb-10 leading-none tracking-tighter animate-fade-in-up">
                        {{ $kegiatan->title }}
                    </h1>

                    <div class="mb-12 border-l-4 border-blue-400 pl-8 bg-gradient-to-r from-blue-500/20 to-transparent py-6 rounded-r-2xl animate-fade-in-up">
                        <p class="text-xl text-blue-50 font-light leading-relaxed italic">{{ $kegiatan->description }}</p>
                    </div>

                    @if($kegiatan->content)
                    <div class="prose-custom text-lg mb-16 animate-fade-in-up">
                        <div class="whitespace-pre-wrap">{{ $kegiatan->content }}</div>
                    </div>
                    @endif

                    @if($kegiatan->photo_position == 'bottom' && $kegiatan->photos && count($kegiatan->photos) > 0)
                    <div class="mt-20 pt-16 border-t-2 border-blue-400/30">
                        <h3 class="text-3xl font-black text-white mb-8 flex items-center gap-4 animate-slide-in-left">
                            <i class="fas fa-images text-blue-300 animate-float"></i>
                            DOKUMENTASI KEGIATAN
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($kegiatan->photos as $index => $photo)
                            <div class="gallery-item shadow-[0_0_40px_rgba(59,130,246,0.3)] animate-fade-in-up" style="animation-delay: {{ $index * 0.1 }}s" onclick="openLightbox({{ $index }})">
                                <img src="{{ asset($photo) }}" alt="Foto {{ $index + 1 }}" loading="lazy">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mt-20 p-8 bg-gradient-to-br from-blue-500/20 to-blue-600/10 rounded-3xl border-2 border-blue-400/40 flex flex-col md:flex-row justify-between items-center gap-6 backdrop-blur-sm animate-fade-in-up shimmer-effect">
                        <div class="text-center md:text-left">
                            <h4 class="text-white font-bold mb-1 uppercase tracking-widest text-sm">Bagikan Kebaikan</h4>
                            <p class="text-blue-100 text-xs italic">Ajak kerabat melihat kegiatan HASMI</p>
                        </div>
                        <div class="flex gap-4">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($kegiatan->title . ' - ' . url()->current()) }}" target="_blank" class="share-btn w-14 h-14 bg-green-500 text-white rounded-full flex items-center justify-center shadow-[0_0_30px_rgba(34,197,94,0.5)] border-2 border-white/20">
                                <i class="fab fa-whatsapp text-2xl"></i>
                            </a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="share-btn w-14 h-14 bg-blue-500 text-white rounded-full flex items-center justify-center shadow-[0_0_30px_rgba(59,130,246,0.5)] border-2 border-white/20">
                                <i class="fab fa-facebook-f text-xl"></i>
                            </a>
                            <button onclick="copyToClipboard('{{ url()->current() }}')" class="share-btn w-14 h-14 bg-white text-blue-600 rounded-full flex items-center justify-center shadow-[0_0_30px_rgba(255,255,255,0.3)] border-2 border-blue-400/40">
                                <i class="fas fa-link text-xl"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </article>

            <div class="mt-20">
                <h2 class="text-3xl font-black text-white mb-10 flex items-center gap-4 uppercase tracking-tighter animate-slide-in-left">
                    <i class="far fa-comments text-blue-300 animate-float"></i>
                    Respon Umat ({{ $kegiatan->approvedCommentsCount() }})
                </h2>

                <div class="grid lg:grid-cols-12 gap-10">
                    <div class="lg:col-span-5 order-2 lg:order-1">
                        <div class="bg-gradient-to-br from-blue-700/80 to-blue-800/60 backdrop-blur-xl rounded-[2rem] p-8 border-2 border-blue-400/40 sticky top-10 shadow-[0_0_60px_rgba(59,130,246,0.4)] animate-fade-in-up">
                            <h3 class="text-xl font-bold text-white mb-6 flex items-center gap-3">
                                <i class="fas fa-pen text-blue-300"></i>
                                Tulis Komentar
                            </h3>
                            
                            <form action="{{ route('comment.store') }}" method="POST" class="space-y-5">
                                @csrf
                                <input type="hidden" name="commentable_type" value="App\Models\Kegiatan">
                                <input type="hidden" name="commentable_id" value="{{ $kegiatan->id }}">
                                
                                <div class="space-y-4">
                                    <input type="text" name="name" required placeholder="Nama Lengkap" class="input-glow w-full px-5 py-4 bg-blue-800/50 border-2 border-blue-400/40 rounded-xl text-white placeholder-blue-100/50 focus:ring-2 focus:ring-blue-400 outline-none transition-all backdrop-blur-sm">
                                    <input type="email" name="email" required placeholder="Email Aktif" class="input-glow w-full px-5 py-4 bg-blue-800/50 border-2 border-blue-400/40 rounded-xl text-white placeholder-blue-100/50 focus:ring-2 focus:ring-blue-400 outline-none transition-all backdrop-blur-sm">
                                    <textarea name="comment" rows="4" required placeholder="Pesan Anda..." class="input-glow w-full px-5 py-4 bg-blue-800/50 border-2 border-blue-400/40 rounded-xl text-white placeholder-blue-100/50 focus:ring-2 focus:ring-blue-400 outline-none transition-all backdrop-blur-sm"></textarea>
                                </div>

                                <button type="submit" class="btn-gradient w-full text-white font-black py-4 rounded-xl transition-all shadow-[0_0_40px_rgba(59,130,246,0.5)] uppercase tracking-widest text-sm border-2 border-white/20">
                                    <span class="flex items-center justify-center gap-2">
                                        <i class="fas fa-paper-plane"></i>
                                        Kirim Respon
                                    </span>
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="lg:col-span-7 order-1 lg:order-2 space-y-6">
                        @php $comments = $kegiatan->comments()->approved()->latest()->get(); @endphp
                        @forelse($comments as $comment)
                        <div class="comment-card bg-blue-700/50 backdrop-blur-sm rounded-3xl p-8 flex gap-6 animate-fade-in-up" style="animation-delay: {{ $loop->index * 0.1 }}s">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl flex-shrink-0 shadow-[0_0_30px_rgba(59,130,246,0.5)] border-2 border-white/20">
                                {{ $comment->initials }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-3">
                                    <h4 class="font-bold text-white text-lg">{{ $comment->name }}</h4>
                                    <span class="text-[10px] text-blue-200 uppercase font-bold tracking-widest bg-blue-500/30 px-3 py-1 rounded-full">{{ $comment->created_at->locale('id')->diffForHumans() }}</span>
                                </div>
                                <p class="text-blue-50 leading-relaxed font-light">{{ $comment->comment }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-20 bg-blue-700/40 backdrop-blur-sm rounded-[2rem] border-2 border-blue-400/30 border-dashed animate-fade-in-up">
                            <i class="far fa-comment-dots text-blue-300/40 text-6xl mb-6 animate-float"></i>
                            <p class="text-blue-100 italic font-light">Jadilah yang pertama memberikan respon...</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
    <button class="absolute top-10 right-10 text-white text-5xl font-light hover:text-blue-300 transition-all duration-300 hover:scale-110 hover:rotate-90">&times;</button>
    <button class="absolute left-10 text-white text-4xl p-4 bg-blue-500/30 backdrop-blur-sm rounded-full hover:bg-blue-500 transition-all duration-300 border-2 border-white/20 hover:scale-110" onclick="changeImage(-1, event)">&#10094;</button>
    <img class="lightbox-content" id="lightbox-img" src="">
    <button class="absolute right-10 text-white text-4xl p-4 bg-blue-500/30 backdrop-blur-sm rounded-full hover:bg-blue-500 transition-all duration-300 border-2 border-white/20 hover:scale-110" onclick="changeImage(1, event)">&#10095;</button>
</div>

<script>
    const galleryPhotos = @json($kegiatan->photos);
    let currentImageIndex = 0;

    function openLightbox(index) {
        currentImageIndex = index;
        const lightbox = document.getElementById('lightbox');
        const img = document.getElementById('lightbox-img');
        lightbox.classList.add('active');
        img.src = '{{ asset('') }}' + galleryPhotos[index];
        document.body.style.overflow = 'hidden';
    }

    function closeLightbox(event) {
        if (event.target.id === 'lightbox' || event.target.tagName === 'BUTTON') {
            document.getElementById('lightbox').classList.remove('active');
            document.body.style.overflow = 'auto';
        }
    }

    function changeImage(direction, event) {
        event.stopPropagation();
        currentImageIndex = (currentImageIndex + direction + galleryPhotos.length) % galleryPhotos.length;
        document.getElementById('lightbox-img').src = '{{ asset('') }}' + galleryPhotos[currentImageIndex];
    }

    function copyToClipboard(text) {
        navigator.clipboard.writeText(text).then(() => showToast('Link Berhasil Disalin!'));
    }

    function showToast(message) {
        const toast = document.createElement('div');
        toast.className = `fixed bottom-10 right-10 px-8 py-5 rounded-2xl bg-gradient-to-r from-blue-500 to-blue-600 text-white font-bold shadow-[0_0_60px_rgba(59,130,246,0.6)] z-50 border-2 border-white/30 backdrop-blur-sm`;
        toast.innerHTML = `<span class="flex items-center gap-3"><i class="fas fa-check-circle text-2xl"></i>${message}</span>`;
        toast.style.animation = 'fadeInUp 0.4s ease-out, pulse 1s ease-in-out infinite';
        document.body.appendChild(toast);
        setTimeout(() => {
            toast.style.animation = 'fadeInUp 0.4s ease-out reverse';
            setTimeout(() => toast.remove(), 400);
        }, 2600);
    }
    
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
    
    document.querySelectorAll('.animate-fade-in-up, .animate-slide-in-left').forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(30px)';
        observer.observe(el);
    });
</script>

@endsection