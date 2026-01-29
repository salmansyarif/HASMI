@extends('layouts.app')

@section('title', 'HASMI - Membangun Peradaban Islami')

@section('content')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

{{-- HERO SECTION --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden bg-[#0a192f]">
    <div class="absolute top-[-10%] left-[-10%] w-[500px] h-[500px] bg-blue-600/10 rounded-full blur-[120px]"></div>
    <div class="relative container mx-auto px-6 z-10">
        <div class="grid md:grid-cols-2 gap-16 items-center">
            {{-- Sisi Kiri: Teks & Action --}}
            <div class="space-y-8">
                <div class="flex items-center gap-4">
                    <div class="w-14 h-14 bg-blue-600 rounded-xl flex items-center justify-center shadow-lg shadow-blue-500/20">
                       <img src="{{ asset('img/hasmilogo.png') }}" alt="Logo" class="w-full h-auto object-contain p-2">
                    </div>
                    <span class="text-2xl font-bold text-white tracking-tighter uppercase">HASMI</span>
                </div>
                <h1 class="text-5xl md:text-7xl font-extrabold leading-tight text-white">
                    Membangun <br>
                    <span class="text-blue-400">Peradaban Islami</span>
                </h1>
                <p class="text-lg text-gray-400 leading-relaxed max-w-xl">
                    Himpunan Aktivis Siswa Muslim Indonesia (HASMI) berkomitmen membina generasi muslim melalui pendidikan, dakwah, dan aksi sosial berkelanjutan.
                </p>
                <div class="flex flex-wrap gap-5">
                    <a href="{{ route('materi.index') }}" class="px-8 py-4 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 transition-all shadow-lg">Jelajahi Materi</a>
                    <a href="{{ route('tentang') }}" class="px-8 py-4 rounded-xl font-bold text-blue-300 border-2 border-blue-800 hover:bg-blue-900/50 transition-all">Tentang Kami</a>
                </div>
            </div>

            {{-- Sisi Kanan: Slider Dinamis --}}
            <div class="hidden md:block relative">
                <div class="swiper heroSwiper rounded-[40px] shadow-2xl border border-blue-500/20 overflow-hidden">
                    <div class="swiper-wrapper">
                        @php
                            // Mengambil data terbaru dari Artikel atau Kegiatan
                            $latestUpdates = \App\Models\Article::published()->latest()->limit(5)->get();
                        @endphp

                        @foreach($latestUpdates as $update)
                        <div class="swiper-slide relative aspect-square bg-[#0d1e36]">
                            @if($update->thumbnail)
                                <img src="{{ asset($update->thumbnail) }}" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center bg-gradient-to-br from-blue-700 to-blue-950">
                                    <span class="text-white text-[150px] font-black opacity-10">H</span>
                                </div>
                            @endif
                            
                            <div class="absolute bottom-0 left-0 right-0 p-8 bg-gradient-to-t from-[#060e1a] via-[#060e1a]/70 to-transparent">
                                <div class="flex items-center gap-3 text-blue-400 text-sm font-bold mb-2">
                                    <span class="px-2 py-0.5 bg-blue-600 text-white text-[10px] rounded uppercase">Terbaru</span>
                                    <span class="flex items-center gap-1">
                                        <i class="far fa-clock"></i>
                                        {{ $update->published_at ? $update->published_at->diffForHumans() : $update->created_at->diffForHumans() }}
                                    </span>
                                </div>
                                <h3 class="text-white text-2xl font-bold line-clamp-2 leading-tight">
                                    {{ $update->title }}
                                </h3>
                                <a href="{{ route('materi.detail', [$update->category->slug, $update->slug]) }}" class="mt-4 inline-flex items-center gap-2 text-blue-400 font-bold hover:underline">
                                    Baca Selengkapnya <i class="fas fa-arrow-right text-xs"></i>
                                </a>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="swiper-pagination !bottom-8 !left-auto !right-8 !w-auto"></div>
                </div>
                <div class="absolute -z-10 -bottom-6 -right-6 w-full h-full border-2 border-blue-500/10 rounded-[40px]"></div>
            </div>
        </div>
    </div>
</section>

{{-- STATS SECTION --}}
<section class="bg-[#060e1a] py-16 border-y border-blue-900/30">
    <div class="container mx-auto px-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-8 text-center">
            @php
                $stats = [
                    ['val' => \App\Models\Article::published()->count(), 'label' => 'Artikel'],
                    ['val' => \App\Models\Program::count(), 'label' => 'Program'],
                    ['val' => \App\Models\Kegiatan::count(), 'label' => 'Kegiatan'],
                    ['val' => \App\Models\Intisari::count(), 'label' => 'Intisari'],
                ];
            @endphp
            @foreach($stats as $stat)
            <div>
                <div class="text-4xl font-black text-white">{{ $stat['val'] }}+</div>
                <p class="text-blue-400 text-xs font-bold uppercase tracking-widest mt-2">{{ $stat['label'] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ABOUT SECTION --}}
<section class="bg-[#0a192f] py-24">
    <div class="container mx-auto px-6 grid md:grid-cols-2 gap-16 items-center">
        <div class="relative flex justify-center">
            <div class="p-20 rounded-3xl bg-[#0d1e36] border border-blue-800 shadow-2xl transform -rotate-3">
                <span class="text-white text-9xl font-black">H</span>
            </div>
        </div>
        <div class="space-y-6">
            <h2 class="text-4xl font-bold text-white">Tentang HASMI</h2>
            <div class="w-20 h-1.5 bg-blue-500 rounded-full"></div>
            <p class="text-gray-400 text-lg leading-relaxed">Himpunan Aktivis Siswa Muslim Indonesia (HASMI) adalah organisasi pendidikan, dakwah, dan sosial yang berfokus membina generasi muda muslim Indonesia.</p>
            <p class="text-gray-400 text-lg leading-relaxed">Melalui berbagai program, HASMI membentuk karakter Islami, berilmu, dan berkontribusi nyata bagi umat dan bangsa.</p>
            <a href="{{ route('tentang') }}" class="inline-block px-8 py-3 rounded-xl font-bold text-white bg-blue-600 hover:bg-blue-700 transition-all">Selengkapnya</a>
        </div>
    </div>
</section>

{{-- VISI MISI --}}
<section class="bg-[#060e1a] py-24">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-white">Visi & Misi</h2>
            <div class="w-24 h-1 bg-blue-500 mx-auto mt-4"></div>
        </div>
        <div class="grid md:grid-cols-2 gap-10">
            <div class="bg-[#0d1e36] p-10 rounded-3xl border border-blue-900 shadow-xl hover:-translate-y-2 transition-all">
                <div class="w-16 h-16 mb-6 rounded-2xl bg-blue-600 flex items-center justify-center">
                    <i class="fas fa-eye text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Visi</h3>
                <p class="text-gray-400 leading-relaxed">Menjadi organisasi terdepan dalam pembinaan generasi muslim yang berakhlak mulia, berilmu, dan bermanfaat.</p>
            </div>
            <div class="bg-[#0d1e36] p-10 rounded-3xl border border-blue-900 shadow-xl hover:-translate-y-2 transition-all">
                <div class="w-16 h-16 mb-6 rounded-2xl bg-blue-600 flex items-center justify-center">
                    <i class="fas fa-bullseye text-white text-2xl"></i>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Misi</h3>
                <p class="text-gray-400 leading-relaxed">Menyelenggarakan program pendidikan, dakwah, dan sosial secara komprehensif dan berkelanjutan.</p>
            </div>
        </div>
    </div>
</section>

{{-- PROGRAM UNGGULAN --}}
<section class="bg-[#0a192f] py-24">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-4xl font-bold text-white mb-12">Program Unggulan</h2>
        <div class="grid grid-cols-2 md:grid-cols-5 gap-6 mb-12">
            @php
            $programs = [
                ['name'=>'Program Dakwah','icon'=>'fa-mosque','slug'=>'program-dakwah'],
                ['name'=>'Program Pendidikan','icon'=>'fa-graduation-cap','slug'=>'program-pendidikan'],
                ['name'=>'Program HASMI','icon'=>'fa-star','route'=>'program-hasmi'],
                ['name'=>'HASMI Peduli','icon'=>'fa-hand-holding-heart','slug'=>'hasmi-peduli'],
                ['name'=>'HASMI TV','icon'=>'fa-youtube','slug'=>'hasmi-tv'],
            ];
            @endphp
            @foreach($programs as $p)
            <a href="{{ isset($p['route']) ? route($p['route']) : route('program.show', $p['slug']) }}" class="group bg-[#0d1e36] p-6 rounded-2xl border border-blue-900 hover:border-blue-500 transition-all">
                <i class="fas {{ $p['icon'] }} text-blue-500 text-3xl mb-4 block group-hover:scale-110 transition"></i>
                <h3 class="text-white font-bold text-sm">{{ $p['name'] }}</h3>
            </a>
            @endforeach
        </div>
        <a href="{{ route('program.index') }}" class="text-blue-400 font-bold hover:underline">Lihat Semua Program →</a>
    </div>
</section>

{{-- MATERI PEMBELAJARAN --}}
<section class="bg-[#060e1a] py-24">
    <div class="container mx-auto px-6">
        <div class="text-center mb-16">
            <h2 class="text-4xl font-bold text-white">Materi Pembelajaran</h2>
            <p class="text-gray-500 mt-2">Artikel terbaru untuk pemahaman agama</p>
        </div>
        <div class="grid md:grid-cols-3 gap-8">
            @php $latestArticles = \App\Models\Article::with(['category'])->published()->orderBy('published_at', 'desc')->limit(3)->get(); @endphp
            @foreach($latestArticles as $article)
            <article class="bg-[#0d1e36] rounded-2xl overflow-hidden border border-blue-900 shadow-lg group">
                <div class="h-48 bg-blue-900 overflow-hidden">
                    @if($article->thumbnail) <img src="{{ asset($article->thumbnail) }}" class="w-full h-full object-cover group-hover:scale-110 transition"> @else <div class="w-full h-full flex items-center justify-center"><i class="fas fa-book-open text-blue-800 text-5xl"></i></div> @endif
                </div>
                <div class="p-6">
                    <span class="text-blue-500 text-xs font-bold uppercase">{{ $article->category->name }}</span>
                    <h3 class="text-white font-bold text-xl mt-2 line-clamp-2 group-hover:text-blue-400 transition">{{ $article->title }}</h3>
                    <a href="{{ route('materi.detail', [$article->category->slug, $article->slug]) }}" class="inline-block mt-4 text-blue-400 font-bold">Baca Selengkapnya →</a>
                </div>
            </article>
            @endforeach
        </div>
    </div>
</section>

{{-- INTISARI SECTION --}}
<section class="bg-[#060e1a] py-24">
    <div class="container mx-auto px-6 text-center">
        <h2 class="text-3xl font-bold text-white mb-12">Intisari HASMI</h2>
        <div class="grid grid-cols-2 md:grid-cols-4 gap-6">
            @php $latestIntisari = \App\Models\Intisari::orderBy('created_at', 'desc')->limit(4)->get(); @endphp
            @foreach($latestIntisari as $i)
            <a href="{{ route('intisari.show', $i->slug) }}" class="bg-[#0d1e36] p-4 rounded-2xl border border-blue-900 group">
                <div class="aspect-[3/4] bg-blue-900 rounded-xl mb-4 overflow-hidden">
                    @if($i->cover) <img src="{{ asset($i->cover) }}" class="w-full h-full object-cover group-hover:scale-110 transition"> @endif
                </div>
                <h3 class="text-white font-bold text-xs">{{ $i->judul }}</h3>
            </a>
            @endforeach
        </div>
    </div>
</section>

{{-- EXTERNAL LINKS (DONASI, BEASISWA) --}}
<section class="bg-[#0a192f] py-24">
    <div class="container mx-auto px-6 grid md:grid-cols-3 gap-8">
        <a href="https://donasi.hasmi.org/" target="_blank" class="p-10 rounded-3xl bg-emerald-600 text-white shadow-xl hover:-translate-y-2 transition-all text-center">
            <i class="fas fa-hand-holding-heart text-4xl mb-6"></i>
            <h3 class="text-2xl font-bold mb-2">Donasi</h3>
            <p class="text-emerald-100 text-sm">Salurkan donasi terbaik Anda.</p>
        </a>
        <a href="https://beasiswapendidikanislam.com/" target="_blank" class="p-10 rounded-3xl bg-blue-600 text-white shadow-xl hover:-translate-y-2 transition-all text-center">
            <i class="fas fa-graduation-cap text-4xl mb-6"></i>
            <h3 class="text-2xl font-bold mb-2">Beasiswa</h3>
            <p class="text-blue-100 text-sm">Pendidikan untuk masa depan umat.</p>
        </a>
        <a href="https://hasmi-islamicschool.com/" target="_blank" class="p-10 rounded-3xl bg-purple-600 text-white shadow-xl hover:-translate-y-2 transition-all text-center">
            <i class="fas fa-school text-4xl mb-6"></i>
            <h3 class="text-2xl font-bold mb-2">Sekolah Islam</h3>
            <p class="text-purple-100 text-sm">Pendidikan karakter Islami.</p>
        </a>
    </div>
</section>

{{-- FOOTER --}}
<footer class="bg-[#060e1a] py-12 border-t border-blue-900/30 text-center">
    <p class="text-gray-500 text-sm">&copy; {{ date('Y') }} HASMI. Membangun Peradaban Islami.</p>
</footer>

@endsection

{{-- STYLE --}}
<style>
    body { background-color: #0a192f; color: white; }
    .line-clamp-2 { display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    
    /* Swiper Styling */
    .heroSwiper .swiper-pagination-bullet {
        background: rgba(255, 255, 255, 0.4) !important;
        opacity: 1;
    }
    .heroSwiper .swiper-pagination-bullet-active {
        background: #3b82f6 !important;
        width: 25px !important;
        border-radius: 10px !important;
        transition: all 0.3s ease;
    }
</style>

{{-- SCRIPTS --}}
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        var swiper = new Swiper(".heroSwiper", {
            loop: true,
            autoplay: {
                delay: 4500,
                disableOnInteraction: false,
            },
            pagination: {
                el: ".swiper-pagination",
                clickable: true,
            },
            effect: "creative",
            creativeEffect: {
                prev: { shadow: true, translate: ["-20%", 0, -1] },
                next: { translate: ["100%", 0, 0] },
            },
        });
    });
</script>