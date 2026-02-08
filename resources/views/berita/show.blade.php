@extends('layouts.app')

@section('title', $berita->title . ' - Berita HASMI')
@section('meta_description', $berita->short_description ? Str::limit($berita->short_description, 150) : Str::limit(strip_tags($berita->content), 150))

@section('content')

<!-- Header Progress Bar -->
<div class="fixed top-0 left-0 w-full h-2 bg-blue-900 z-50">
    <div class="h-full bg-blue-400" id="reading-progress" style="width: 0%"></div>
</div>

<!-- Hero Header (Larger & Brighter) -->
<section class="relative pt-48 pb-32 bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 overflow-hidden">
    <!-- Background Image with Blur -->
    <div class="absolute inset-0 z-0">
        <img src="{{ $berita->getThumbnailUrl() }}" class="w-full h-full object-cover opacity-30 blur-sm scale-105">
        <div class="absolute inset-0 bg-gradient-to-t from-blue-800 via-blue-700/60 to-blue-700/90"></div>
    </div>

    <div class="container max-w-7xl mx-auto px-6 relative z-10 text-center">
        <div class="inline-flex items-center gap-3 px-6 py-2 rounded-full bg-blue-500/30 backdrop-blur-md border-2 border-blue-400/40 text-blue-100 font-bold uppercase tracking-widest mb-10 shadow-[0_0_30px_rgba(59,130,246,0.4)]">
            <span class="w-2.5 h-2.5 rounded-full bg-blue-300 animate-pulse"></span>
            Berita Terkini
        </div>
        
        <h1 class="text-4xl md:text-6xl lg:text-7xl font-black text-white leading-tight mb-12 tracking-tight max-w-6xl mx-auto drop-shadow-[0_0_40px_rgba(0,0,0,0.5)]">
            {{ $berita->title }}
        </h1>
        
        <div class="flex flex-wrap items-center justify-center gap-8 text-blue-100 text-lg font-medium">
            <span class="flex items-center gap-3 bg-blue-700/50 backdrop-blur-md px-6 py-3 rounded-full border-2 border-blue-400/40">
                <i class="far fa-calendar-alt text-blue-300"></i>
                {{ $berita->created_at->format('d F Y') }}
            </span>
             <span class="flex items-center gap-3 bg-blue-700/50 backdrop-blur-md px-6 py-3 rounded-full border-2 border-blue-400/40">
                <i class="far fa-clock text-blue-300"></i>
                {{ $berita->created_at->format('H:i WIB') }}
            </span>
            <span class="flex items-center gap-3 bg-blue-700/50 backdrop-blur-md px-6 py-3 rounded-full border-2 border-blue-400/40">
                <i class="far fa-eye text-blue-300"></i>
                {{ number_format($berita->views) }} views
            </span>
        </div>
    </div>
</section>

<div class="bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800">
    <div class="container max-w-7xl mx-auto px-6 py-20">
        <div class="grid lg:grid-cols-12 gap-16">
            
            <!-- Main Content (Wider) -->
            <div class="lg:col-span-8">
                <!-- Thumbnail -->
                <div class="rounded-[2.5rem] overflow-hidden shadow-[0_0_60px_rgba(59,130,246,0.5)] mb-16 relative group ring-2 ring-blue-400/40">
                    <img src="{{ $berita->getThumbnailUrl() }}" alt="{{ $berita->title }}" class="w-full h-auto object-cover">
                </div>

                <!-- Short Description (Lead) -->
                @if($berita->short_description)
                <div class="bg-blue-600/40 backdrop-blur-md rounded-[2rem] p-10 mb-12 border-l-8 border-blue-400 shadow-[0_0_40px_rgba(59,130,246,0.3)]">
                    <p class="text-2xl text-blue-50 font-medium leading-relaxed italic">
                        "{{ $berita->short_description }}"
                    </p>
                </div>
                @endif

                <!-- Article Content (Larger Text) -->
                <article class="prose prose-xl prose-invert prose-headings:font-black prose-headings:text-white prose-p:text-blue-50 prose-a:text-blue-300 prose-a:no-underline hover:prose-a:underline prose-img:rounded-3xl max-w-none leading-loose bg-blue-700/60 backdrop-blur-xl p-12 rounded-[2.5rem] border-2 border-blue-400/40 shadow-[0_0_60px_rgba(59,130,246,0.4)]">
                    {!! nl2br(e($berita->content)) !!}
                </article>

                <!-- Video Section -->
                @if($berita->video_url)
                <div class="mt-20 mb-10 bg-blue-800/60 backdrop-blur-xl rounded-[2.5rem] p-3 shadow-[0_0_60px_rgba(59,130,246,0.4)] border-2 border-blue-400/40">
                    <div class="flex items-center justify-between px-8 py-6">
                         <h3 class="text-2xl font-bold text-white flex items-center gap-4">
                            <i class="fas fa-play-circle text-blue-300 text-3xl"></i>
                            Video Dokumentasi
                        </h3>
                    </div>
                    <div class="rounded-[2rem] overflow-hidden bg-black aspect-video relative">
                        @if(filter_var($berita->video_url, FILTER_VALIDATE_URL))
                             @if(Str::contains($berita->video_url, 'youtube.com') || Str::contains($berita->video_url, 'youtu.be'))
                                <iframe class="w-full h-full" src="{{ str_replace('watch?v=', 'embed/', $berita->video_url) }}" frameborder="0" allowfullscreen></iframe>
                             @else
                                <video controls class="w-full h-full">
                                    <source src="{{ $berita->video_url }}" type="video/mp4">
                                    Browser Anda tidak mendukung video tag.
                                </video>
                             @endif
                        @else
                            <video controls class="w-full h-full">
                                <source src="{{ Storage::url($berita->video_url) }}" type="video/mp4">
                                Browser Anda tidak mendukung video tag.
                            </video>
                        @endif
                    </div>
                </div>
                @endif

                <!-- Photo Gallery Slider -->
                @if($berita->hasPhotos())
                <div class="mt-20 pt-10 border-t-2 border-blue-400/40">
                    <h3 class="text-3xl font-black text-white mb-10 flex items-center gap-4">
                        <span class="w-12 h-12 rounded-xl bg-blue-500/40 text-blue-200 flex items-center justify-center text-xl border-2 border-blue-400/40">
                            <i class="fas fa-images"></i>
                        </span>
                        Galeri Dokumentasi
                    </h3>
                    
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-6" id="gallery-grid">
                        @foreach($berita->getPhotosUrls() as $index => $photoUrl)
                            <a href="{{ $photoUrl }}" data-fslightbox="gallery" class="block rounded-3xl overflow-hidden shadow-[0_0_40px_rgba(59,130,246,0.4)] hover:shadow-[0_0_80px_rgba(59,130,246,0.6)] transition-all hover:-translate-y-2 relative group h-56 ring-2 ring-blue-400/40">
                                <img src="{{ $photoUrl }}" alt="Dokumentasi {{ $index+1 }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-110">
                                <div class="absolute inset-0 bg-blue-600/40 opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center text-white backdrop-blur-[2px]">
                                    <div class="transform translate-y-4 group-hover:translate-y-0 transition-transform duration-300">
                                        <i class="fas fa-search-plus text-3xl drop-shadow-md"></i>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
                @endif
                
                <!-- Share Buttons -->
                <div class="mt-20 pt-10 border-t-2 border-dashed border-blue-400/40">
                    <div class="flex flex-col md:flex-row items-center justify-between gap-8 bg-blue-700/60 backdrop-blur-xl p-8 rounded-3xl border-2 border-blue-400/40 shadow-[0_0_40px_rgba(59,130,246,0.3)]">
                        <div class="text-center md:text-left">
                            <span class="block font-bold text-white text-xl mb-2">Bagikan Berita Ini</span>
                            <span class="text-blue-100 text-lg">Bantu sebarkan informasi kebaikan kepada khalayak.</span>
                        </div>
                        <div class="flex gap-4">
                            <a href="https://www.facebook.com/sharer/sharer.php?u={{ url()->current() }}" target="_blank" class="w-14 h-14 rounded-full bg-[#1877F2] text-white flex items-center justify-center hover:bg-blue-700 transition-transform hover:scale-110 shadow-[0_0_30px_rgba(24,119,242,0.4)] text-2xl">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="https://twitter.com/intent/tweet?url={{ url()->current() }}&text={{ urlencode($berita->title) }}" target="_blank" class="w-14 h-14 rounded-full bg-[#1DA1F2] text-white flex items-center justify-center hover:bg-sky-600 transition-transform hover:scale-110 shadow-[0_0_30px_rgba(29,161,242,0.4)] text-2xl">
                                <i class="fab fa-twitter"></i>
                            </a>
                            <a href="https://wa.me/?text={{ urlencode($berita->title . ' ' . url()->current()) }}" target="_blank" class="w-14 h-14 rounded-full bg-[#25D366] text-white flex items-center justify-center hover:bg-green-600 transition-transform hover:scale-110 shadow-[0_0_30px_rgba(37,211,102,0.4)] text-2xl">
                                <i class="fab fa-whatsapp"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- COMMENTS SECTION -->
                <div class="mt-20">
                    <h3 class="text-3xl font-black text-white mb-10 border-b-2 border-blue-400/40 pb-6 flex items-center gap-4">
                        <i class="far fa-comments text-blue-300"></i> Komentar ({{ $comments->count() }})
                    </h3>

                    <!-- Comment Form -->
                    <div class="bg-blue-700/60 backdrop-blur-xl rounded-[2rem] shadow-[0_0_60px_rgba(59,130,246,0.4)] p-10 mb-16 border-2 border-blue-400/40">
                         <h4 class="font-bold text-2xl text-white mb-6">Tulis Komentar</h4>
                        
                        @if(session('success'))
                            <div class="bg-blue-500/40 backdrop-blur-md text-blue-50 p-6 rounded-2xl mb-8 flex items-start gap-4 border-2 border-blue-400/50">
                                <i class="fas fa-check-circle mt-1 text-xl"></i>
                                <div>
                                    <p class="font-bold text-lg">Terima kasih!</p>
                                    <p class="text-base">{{ session('success') }}</p>
                                </div>
                            </div>
                        @endif

                        <form action="{{ route('comments.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="commentable_type" value="App\Models\Berita">
                            <input type="hidden" name="commentable_id" value="{{ $berita->id }}">

                            <div class="grid md:grid-cols-2 gap-8 mb-8">
                                <div>
                                    <label class="block text-base font-bold text-blue-100 mb-3">Nama Lengkap</label>
                                    <input type="text" name="name" required class="w-full px-6 py-4 bg-blue-800/50 backdrop-blur-md border-2 border-blue-400/40 rounded-2xl focus:ring-4 focus:ring-blue-500/50 focus:border-blue-400 transition-all outline-none text-lg text-white placeholder-blue-200/50" placeholder="Nama Anda">
                                </div>
                                <div>
                                    <label class="block text-base font-bold text-blue-100 mb-3">Email (Privasi terjaga)</label>
                                    <input type="email" name="email" required class="w-full px-6 py-4 bg-blue-800/50 backdrop-blur-md border-2 border-blue-400/40 rounded-2xl focus:ring-4 focus:ring-blue-500/50 focus:border-blue-400 transition-all outline-none text-lg text-white placeholder-blue-200/50" placeholder="alamat@email.com">
                                </div>
                            </div>
                            <div class="mb-8">
                                <label class="block text-base font-bold text-blue-100 mb-3">Isi Komentar</label>
                                <textarea name="comment" rows="5" required class="w-full px-6 py-4 bg-blue-800/50 backdrop-blur-md border-2 border-blue-400/40 rounded-2xl focus:ring-4 focus:ring-blue-500/50 focus:border-blue-400 transition-all outline-none text-lg text-white placeholder-blue-200/50" placeholder="Tulis tanggapan Anda di sini..."></textarea>
                            </div>
                            <button type="submit" class="bg-blue-500 hover:bg-blue-400 text-white font-bold py-4 px-10 rounded-2xl transition-all hover:shadow-[0_0_60px_rgba(59,130,246,0.6)] hover:-translate-y-1 block w-full md:w-auto text-lg border-2 border-blue-400/40">
                                <i class="fas fa-paper-plane mr-2"></i> Kirim Komentar
                            </button>
                        </form>
                    </div>

                    <!-- Comment List -->
                        <div class="space-y-8">
                        @forelse($comments as $comment)
                        <div class="flex gap-6 p-8 bg-blue-700/60 backdrop-blur-xl rounded-[2rem] border-2 border-blue-400/40 shadow-[0_0_40px_rgba(59,130,246,0.3)]">
                            <div class="w-14 h-14 rounded-full bg-gradient-to-br from-blue-500 to-blue-600 flex items-center justify-center text-white font-bold text-xl shadow-[0_0_30px_rgba(59,130,246,0.5)] flex-shrink-0 border-2 border-blue-400/50">
                                {{ $comment->initials }}
                            </div>
                            <div class="flex-grow">
                                <div class="flex items-center justify-between mb-3">
                                    <h5 class="font-bold text-white text-lg">{{ $comment->name }}</h5>
                                    <span class="text-sm text-blue-200 font-medium">{{ $comment->created_at->diffForHumans() }}</span>
                                </div>
                                <p class="text-blue-50 leading-relaxed text-lg">{{ $comment->comment }}</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-16 bg-blue-700/40 backdrop-blur-md rounded-[2rem] border-2 border-dashed border-blue-400/40">
                            <div class="w-20 h-20 bg-blue-600/40 rounded-full flex items-center justify-center mx-auto mb-6 text-blue-200 text-3xl">
                                <i class="far fa-comments"></i>
                            </div>
                            <p class="text-blue-100 text-lg">Belum ada komentar. Jadilah yang pertama berkomentar!</p>
                        </div>
                        @endforelse
                    </div>

                </div>
            </div>

            <!-- Sidebar -->
            <aside class="lg:col-span-4 space-y-12">
                <!-- Related News -->
                <div class="bg-blue-700/60 backdrop-blur-xl rounded-[2.5rem] p-8 shadow-[0_0_60px_rgba(59,130,246,0.4)] border-2 border-blue-400/40 sticky top-32">
                    <div class="flex items-center justify-between mb-8 pb-6 border-b-2 border-blue-400/40">
                        <h3 class="font-bold text-2xl text-white border-l-4 border-blue-400 pl-4">
                            Berita Lainnya
                        </h3>
                        <a href="{{ route('berita.index') }}" class="text-blue-200 font-bold hover:text-white">Semua</a>
                    </div>
                    
                    <div class="space-y-8">
                        @foreach($recentNews as $recent)
                        <article class="flex gap-5 group cursor-pointer" onclick="window.location='{{ route('berita.show', $recent->slug) }}'">
                            <div class="w-28 h-28 flex-shrink-0 rounded-2xl overflow-hidden relative shadow-[0_0_30px_rgba(59,130,246,0.3)] ring-2 ring-blue-400/40">
                                <img src="{{ $recent->getThumbnailUrl() }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500">
                                <div class="absolute inset-0 bg-black/10 group-hover:bg-transparent transition-colors"></div>
                            </div>
                            <div class="flex flex-col justify-center">
                                 <h4 class="text-lg font-bold text-white leading-snug group-hover:text-blue-200 transition-colors mb-2 line-clamp-3">
                                    {{ $recent->title }}
                                </h4>
                                <span class="text-sm text-blue-200 flex items-center gap-2 font-medium">
                                    <i class="far fa-clock"></i> {{ $recent->created_at->diffForHumans() }}
                                </span>
                            </div>
                        </article>
                        @endforeach
                    </div>
                </div>

                <!-- Call to Action -->
                <div class="rounded-[2.5rem] p-10 bg-gradient-to-br from-blue-500 to-blue-600 text-white shadow-[0_0_80px_rgba(59,130,246,0.5)] relative overflow-hidden group border-2 border-blue-400/40">
                    <div class="absolute top-0 right-0 w-48 h-48 bg-white rounded-full mix-blend-overlay filter blur-3xl opacity-20 -translate-y-1/2 translate-x-1/2 group-hover:scale-110 transition-transform duration-700"></div>
                    
                    <h3 class="text-3xl font-black mb-6 relative z-10 leading-tight">Dukung Program Kebaikan</h3>
                    <p class="text-blue-50 text-lg mb-8 leading-relaxed relative z-10">
                        Mari berpartisipasi dalam program-program kemanusiaan dan dakwah HASMI untuk kemaslahatan umat.
                    </p>
                    <a href="#" class="inline-block w-full text-center bg-white text-blue-700 font-bold py-4 px-8 rounded-2xl text-lg hover:shadow-[0_0_40px_rgba(255,255,255,0.5)] hover:-translate-y-1 transition-all relative z-10">
                        Salurkan Donasi
                    </a>
                </div>
            </aside>
        </div>
    </div>
</div>

<!-- Scroll Progress Script -->
<script>
    window.onscroll = function() {
        let winScroll = document.body.scrollTop || document.documentElement.scrollTop;
        let height = document.documentElement.scrollHeight - document.documentElement.clientHeight;
        let scrolled = (winScroll / height) * 100;
        document.getElementById("reading-progress").style.width = scrolled + "%";
    };
</script>

<!-- FSLightbox script for gallery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/fslightbox/3.0.9/index.min.js"></script>

@endsection