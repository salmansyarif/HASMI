@extends('layouts.app')

@section('title', $kegiatan->title . ' - Kegiatan HASMI')

@section('content')

<style>
    .prose-custom {
        color: #94a3b8; /* slate-400 */
        line-height: 1.8;
    }
    .prose-custom p { margin-bottom: 1.5rem; }
    
    .gallery-item {
        cursor: pointer;
        overflow: hidden;
        border-radius: 1.5rem;
        aspect-ratio: 1;
        border: 1px solid rgba(255, 255, 255, 0.05);
    }
    .gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .gallery-item:hover img {
        transform: scale(1.1);
        filter: brightness(1.1);
    }
    
    .lightbox {
        display: none;
        position: fixed;
        z-index: 9999;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(2, 6, 23, 0.98);
        backdrop-filter: blur(10px);
        align-items: center;
        justify-content: center;
    }
    .lightbox.active { display: flex; }
    .lightbox-content {
        max-width: 90%;
        max-height: 85%;
        object-fit: contain;
        border-radius: 10px;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5);
    }
</style>

<div class="bg-slate-950 min-h-screen pb-20">
    <div class="container mx-auto px-6 pt-12 mb-8">
        <a href="{{ route('kegiatan.index') }}" 
           class="inline-flex items-center gap-2 text-blue-500 hover:text-blue-400 font-bold transition-all group">
            <i class="fas fa-arrow-left group-hover:-translate-x-2 transition-transform"></i> 
            KEMBALI KE DAFTAR KEGIATAN
        </a>
    </div>

    <div class="container mx-auto px-6">
        <div class="max-w-5xl mx-auto">
            <article class="bg-slate-900 rounded-[3rem] shadow-2xl overflow-hidden border border-slate-800">
                
                @if($kegiatan->photo_position == 'top' && $kegiatan->thumbnail)
                <div class="w-full h-[500px] overflow-hidden relative">
                    <img src="{{ asset($kegiatan->thumbnail) }}" alt="{{ $kegiatan->title }}" class="w-full h-full object-cover">
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 to-transparent"></div>
                </div>
                @endif

                <div class="p-8 md:p-16">
                    <div class="flex flex-wrap items-center gap-6 mb-8">
                        @if($kegiatan->event_date)
                        <div class="flex items-center gap-3 px-4 py-2 bg-blue-600/10 rounded-full border border-blue-600/20 text-blue-400 text-xs font-bold uppercase tracking-widest">
                            <i class="far fa-calendar-alt"></i>
                            <span>{{ $kegiatan->event_date->locale('id')->isoFormat('dddd, D MMMM YYYY') }}</span>
                        </div>
                        @endif
                        @if($kegiatan->location)
                        <div class="flex items-center gap-3 px-4 py-2 bg-slate-800 rounded-full border border-slate-700 text-slate-400 text-xs font-bold uppercase tracking-widest">
                            <i class="fas fa-map-marker-alt text-blue-500"></i>
                            <span>{{ $kegiatan->location }}</span>
                        </div>
                        @endif
                    </div>

                    <h1 class="text-4xl md:text-6xl font-black text-white mb-10 leading-none tracking-tighter">
                        {{ $kegiatan->title }}
                    </h1>

                    <div class="mb-12 border-l-4 border-blue-600 pl-8">
                        <p class="text-xl text-slate-300 font-light leading-relaxed italic">{{ $kegiatan->description }}</p>
                    </div>

                    @if($kegiatan->content)
                    <div class="prose-custom text-lg mb-16">
                        <div class="whitespace-pre-wrap">{{ $kegiatan->content }}</div>
                    </div>
                    @endif

                    @if($kegiatan->photo_position == 'bottom' && $kegiatan->photos && count($kegiatan->photos) > 0)
                    <div class="mt-20 pt-16 border-t border-slate-800">
                        <h3 class="text-3xl font-black text-white mb-8 flex items-center gap-4">
                            <i class="fas fa-images text-blue-600"></i>
                            DOKUMENTASI KEGIATAN
                        </h3>
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach($kegiatan->photos as $index => $photo)
                            <div class="gallery-item shadow-xl" onclick="openLightbox({{ $index }})">
                                <img src="{{ asset($photo) }}" alt="Foto {{ $index + 1 }}" loading="lazy">
                            </div>
                            @endforeach
                        </div>
                    </div>
                    @endif

                    <div class="mt-20 p-8 bg-slate-800/50 rounded-3xl border border-slate-700 flex flex-col md:flex-row justify-between items-center gap-6">
                        <div class="text-center md:text-left">
                            <h4 class="text-white font-bold mb-1 uppercase tracking-widest text-sm">Bagikan Kebaikan</h4>
                            <p class="text-slate-500 text-xs italic">Ajak kerabat melihat kegiatan HASMI</p>
                        </div>
                        <div class="flex gap-4">
                            <a href="https://api.whatsapp.com/send?text={{ urlencode($kegiatan->title . ' - ' . url()->current()) }}" target="_blank" class="w-12 h-12 bg-green-600/20 text-green-500 rounded-full flex items-center justify-center hover:bg-green-600 hover:text-white transition-all border border-green-600/20"><i class="fab fa-whatsapp text-xl"></i></a>
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-12 h-12 bg-blue-600/20 text-blue-500 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all border border-blue-600/20"><i class="fab fa-facebook-f text-xl"></i></a>
                            <button onclick="copyToClipboard('{{ url()->current() }}')" class="w-12 h-12 bg-slate-700 text-slate-300 rounded-full flex items-center justify-center hover:bg-white hover:text-slate-950 transition-all border border-slate-600"><i class="fas fa-link"></i></button>
                        </div>
                    </div>
                </div>
            </article>

            <div class="mt-20">
                <h2 class="text-3xl font-black text-white mb-10 flex items-center gap-4 uppercase tracking-tighter">
                    <i class="far fa-comments text-blue-500"></i>
                    Respon Umat ({{ $kegiatan->approvedCommentsCount() }})
                </h2>

                <div class="grid lg:grid-cols-12 gap-10">
                    <div class="lg:col-span-5 order-2 lg:order-1">
                        <div class="bg-slate-900 rounded-[2rem] p-8 border border-slate-800 sticky top-10 shadow-2xl">
                            <h3 class="text-xl font-bold text-white mb-6">Tulis Komentar</h3>
                            
                            <form action="{{ route('comment.store') }}" method="POST" class="space-y-5">
                                @csrf
                                <input type="hidden" name="commentable_type" value="App\Models\Kegiatan">
                                <input type="hidden" name="commentable_id" value="{{ $kegiatan->id }}">
                                
                                <div class="space-y-4">
                                    <input type="text" name="name" required placeholder="Nama Lengkap" class="w-full px-5 py-4 bg-slate-950 border border-slate-800 rounded-xl text-white focus:ring-2 focus:ring-blue-600 outline-none transition-all">
                                    <input type="email" name="email" required placeholder="Email Aktif" class="w-full px-5 py-4 bg-slate-950 border border-slate-800 rounded-xl text-white focus:ring-2 focus:ring-blue-600 outline-none transition-all">
                                    <textarea name="comment" rows="4" required placeholder="Pesan Anda..." class="w-full px-5 py-4 bg-slate-950 border border-slate-800 rounded-xl text-white focus:ring-2 focus:ring-blue-600 outline-none transition-all"></textarea>
                                </div>

                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-4 rounded-xl transition-all shadow-lg shadow-blue-900/40 uppercase tracking-widest text-sm">
                                    Kirim Respon
                                </button>
                            </form>
                        </div>
                    </div>

                    <div class="lg:col-span-7 order-1 lg:order-2 space-y-6">
                        @php $comments = $kegiatan->comments()->approved()->latest()->get(); @endphp
                        @forelse($comments as $comment)
                        <div class="bg-slate-900/50 rounded-3xl p-8 border border-slate-800 flex gap-6">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-600 to-blue-900 rounded-2xl flex items-center justify-center text-white font-black text-xl flex-shrink-0 shadow-lg">
                                {{ $comment->initials }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-3">
                                    <h4 class="font-bold text-white text-lg">{{ $comment->name }}</h4>
                                    <span class="text-[10px] text-slate-500 uppercase font-bold tracking-widest">{{ $comment->created_at->locale('id')->diffForHumans() }}</span>
                                </div>
                                <p class="text-slate-400 leading-relaxed font-light">{{ $comment->comment }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-20 bg-slate-900/30 rounded-[2rem] border border-slate-800 border-dashed">
                            <i class="far fa-comment-dots text-slate-800 text-6xl mb-6"></i>
                            <p class="text-slate-600 italic">Jadilah yang pertama memberikan respon...</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div id="lightbox" class="lightbox" onclick="closeLightbox(event)">
    <button class="absolute top-10 right-10 text-white text-5xl font-light hover:text-blue-500 transition-colors">&times;</button>
    <button class="absolute left-10 text-white text-4xl p-4 bg-white/5 rounded-full hover:bg-blue-600 transition-all" onclick="changeImage(-1, event)">&#10094;</button>
    <img class="lightbox-content" id="lightbox-img" src="">
    <button class="absolute right-10 text-white text-4xl p-4 bg-white/5 rounded-full hover:bg-blue-600 transition-all" onclick="changeImage(1, event)">&#10095;</button>
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
        toast.className = `fixed bottom-10 right-10 px-8 py-4 rounded-2xl bg-blue-600 text-white font-bold shadow-2xl z-50 animate-bounce`;
        toast.innerText = message;
        document.body.appendChild(toast);
        setTimeout(() => toast.remove(), 3000);
    }
</script>

@endsection