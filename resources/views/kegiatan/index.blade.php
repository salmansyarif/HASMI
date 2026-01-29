@extends('layouts.app')

@section('title', 'Kegiatan - HASMI')

@section('content')

<div class="bg-slate-950 min-h-screen">
    <div class="bg-gradient-to-b from-slate-900 via-blue-950 to-slate-950 pt-24 pb-16 text-center px-6">
        <span class="inline-block py-1 px-4 rounded-full bg-blue-600/20 text-blue-400 text-xs font-bold tracking-widest uppercase mb-6 border border-blue-500/30">
            Arsip Dokumentasi
        </span>
        <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tighter uppercase">
            Kegiatan <span class="text-blue-500">HASMI</span>
        </h1>
        <div class="w-24 h-1.5 bg-blue-600 mx-auto rounded-full mb-8"></div>
        <p class="text-gray-400 text-lg max-w-2xl mx-auto font-light leading-relaxed">
            Dokumentasi berbagai aktivitas dakwah, pendidikan, dan aksi sosial kemanusiaan yang telah kami laksanakan untuk umat.
        </p>
    </div>

    <div class="container mx-auto px-6 pb-24">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($kegiatans as $kegiatan)
            <a href="{{ route('kegiatan.show', $kegiatan->slug) }}" 
               class="group bg-slate-900 rounded-[2rem] overflow-hidden border border-slate-800 shadow-2xl transition-all duration-500 hover:border-blue-500/50 hover:-translate-y-2 block">
                
                <div class="h-64 relative overflow-hidden">
                    @if($kegiatan->show_thumbnail_in_list && $kegiatan->thumbnail)
                        <img src="{{ asset($kegiatan->thumbnail) }}" 
                             alt="{{ $kegiatan->title }}" 
                             class="w-full h-full object-cover grayscale-[20%] group-hover:grayscale-0 group-hover:scale-110 transition-transform duration-700"
                             loading="lazy">
                    @else
                        <div class="w-full h-full bg-slate-800 flex flex-col items-center justify-center">
                            <i class="fas fa-mosque text-slate-700 text-6xl mb-3"></i>
                            <span class="text-slate-600 text-xs font-bold tracking-[0.3em] uppercase">HASMI MEDIA</span>
                        </div>
                    @endif
                    
                    @if($kegiatan->photos && count($kegiatan->photos) > 1)
                    <div class="absolute top-4 right-4 bg-blue-600/90 backdrop-blur-md text-white text-[10px] px-3 py-1.5 rounded-lg font-bold shadow-xl flex items-center gap-2">
                        <i class="fas fa-images"></i>
                        <span>{{ count($kegiatan->photos) }} FOTO</span>
                    </div>
                    @endif

                    <div class="absolute inset-0 bg-gradient-to-t from-slate-950 via-transparent to-transparent opacity-80"></div>
                </div>
                
                <div class="p-8">
                    <div class="flex items-center gap-3 mb-4">
                        <span class="w-8 h-[2px] bg-blue-600"></span>
                        <span class="text-blue-500 text-xs font-bold uppercase tracking-widest">
                             @if($kegiatan->event_date)
                                {{ $kegiatan->event_date->locale('id')->isoFormat('MMMM Y') }}
                             @endif
                        </span>
                    </div>

                    <h3 class="text-xl font-bold text-white group-hover:text-blue-400 transition-colors line-clamp-2 mb-4 leading-snug">
                        {{ $kegiatan->title }}
                    </h3>
                    
                    <p class="text-slate-400 line-clamp-3 text-sm leading-relaxed mb-6 font-light">
                        {{ $kegiatan->description }}
                    </p>
                    
                    <div class="pt-6 border-t border-slate-800 flex items-center justify-between text-[11px] font-bold uppercase tracking-tighter">
                        <div class="flex items-center gap-4 text-slate-500">
                            @if($kegiatan->event_date)
                            <div class="flex items-center gap-1.5">
                                <i class="far fa-calendar-alt text-blue-500"></i>
                                <span>{{ $kegiatan->event_date->locale('id')->isoFormat('D MMM') }}</span>
                            </div>
                            @endif

                            @if($kegiatan->location)
                            <div class="flex items-center gap-1.5">
                                <i class="fas fa-map-marker-alt text-blue-500"></i>
                                <span class="truncate max-w-[100px]">{{ $kegiatan->location }}</span>
                            </div>
                            @endif
                        </div>
                        
                        <div class="text-blue-500 group-hover:translate-x-2 transition-transform duration-300">
                            DETAIL <i class="fas fa-arrow-right ml-1"></i>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-32 bg-slate-900/50 rounded-[3rem] border border-slate-800 border-dashed">
                <div class="inline-block p-10 bg-slate-800 rounded-full mb-8">
                    <i class="fas fa-archive text-slate-700 text-7xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-white mb-4">Belum Ada Dokumentasi</h3>
                <p class="text-slate-500 max-w-sm mx-auto mb-10 font-light italic">Mohon maaf, saat ini kami belum mempublikasikan laporan kegiatan terbaru.</p>
                <a href="{{ route('home') }}" class="inline-flex items-center gap-3 bg-blue-900/20 hover:bg-blue-600 text-blue-400 hover:text-white px-10 py-4 rounded-full font-bold border border-blue-900/50 transition-all">
                    <i class="fas fa-arrow-left"></i>
                    <span>Kembali ke Beranda</span>
                </a>
            </div>
            @endforelse
        </div>

        @if($kegiatans->hasPages())
        <div class="mt-20 flex justify-center">
            <div class="inline-flex p-2 bg-slate-900 rounded-2xl border border-slate-800 shadow-xl">
                {{ $kegiatans->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    /* Pagination Styling for Dark Mode */
    .pagination { @apply flex list-none rounded-xl overflow-hidden; }
    .page-item .page-link { @apply bg-transparent border-none text-slate-500 px-4 py-2 hover:text-white; }
    .page-item.active .page-link { @apply bg-blue-600 text-white rounded-lg shadow-lg shadow-blue-900/40; }
    
    .line-clamp-2 {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
    .line-clamp-3 {
        display: -webkit-box;
        -webkit-line-clamp: 3;
        -webkit-box-orient: vertical;
        overflow: hidden;
    }
</style>

@endsection