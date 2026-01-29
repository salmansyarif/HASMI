@extends('layouts.app')

@section('title', 'Intisari HASMI - Artikel & Kajian Pilihan')

@section('content')

<div class="bg-slate-950 min-h-screen">
    <div class="bg-gradient-to-b from-slate-900 via-blue-950 to-slate-950 pt-24 pb-16 text-center px-6">
        <span class="inline-block py-1.5 px-6 rounded-full bg-blue-600/10 text-blue-400 text-xs font-bold tracking-[0.2em] uppercase mb-6 border border-blue-500/20">
            Khazanah Pemikiran
        </span>
        <h1 class="text-4xl md:text-6xl font-black text-white mb-6 tracking-tighter uppercase leading-none">
            Intisari <span class="text-blue-500">HASMI</span>
        </h1>
        <div class="w-24 h-1.5 bg-blue-600 mx-auto rounded-full mb-8"></div>
        <p class="text-slate-400 text-lg max-w-2xl mx-auto font-light leading-relaxed italic">
            "Menyajikan ringkasan ilmu, hikmah, dan kajian pilihan untuk mencerahkan hati dan pikiran umat."
        </p>
    </div>

    <div class="container mx-auto px-6 pb-24">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-10">
            @forelse($intisaris as $intisari)
            <a href="{{ route('intisari.show', $intisari->slug) }}" 
               class="group bg-slate-900 rounded-[2.5rem] overflow-hidden border border-slate-800 shadow-2xl transition-all duration-500 hover:border-blue-500/50 hover:-translate-y-2 flex flex-col h-full">
                
                <div class="h-52 relative overflow-hidden flex-shrink-0">
                    @if($intisari->thumbnail)
                        <img src="{{ asset($intisari->thumbnail) }}" 
                             alt="{{ $intisari->title }}" 
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 group-hover:rotate-1">
                    @else
                        <div class="w-full h-full bg-slate-800 flex items-center justify-center relative">
                            <div class="absolute inset-0 opacity-5" style="background-image: url('https://www.transparenttextures.com/patterns/grid-me.png');"></div>
                            <div class="relative w-16 h-16 bg-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-4xl shadow-lg shadow-blue-900/50 group-hover:rotate-12 transition-transform">
                                H
                            </div>
                        </div>
                    @endif
                    
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900 via-transparent to-transparent opacity-60"></div>
                </div>

                <div class="p-8 flex flex-col flex-1">
                    <div class="flex items-center gap-3 mb-5">
                        <span class="w-6 h-[2px] bg-blue-600"></span>
                        <span class="text-blue-500 text-[10px] font-bold uppercase tracking-widest">Kajian Pilihan</span>
                    </div>

                    <h3 class="text-xl font-bold text-white group-hover:text-blue-400 transition-colors line-clamp-2 mb-4 leading-snug">
                        {{ $intisari->title }}
                    </h3>
                    
                    <p class="text-slate-400 text-sm leading-relaxed mb-8 font-light line-clamp-3">
                        {{ $intisari->excerpt }}
                    </p>
                    
                    <div class="mt-auto pt-6 border-t border-slate-800 flex items-center justify-between">
                        <div class="flex items-center gap-2 text-slate-500 text-xs font-bold uppercase tracking-tighter">
                            <i class="far fa-calendar-alt text-blue-600"></i>
                            <span>
                                {{ $intisari->published_at ? $intisari->published_at->locale('id')->isoFormat('D MMM Y') : '-' }}
                            </span>
                        </div>
                        
                        <div class="flex items-center gap-2 text-blue-500 text-[10px] font-black group-hover:translate-x-2 transition-transform uppercase tracking-widest">
                            BACA <i class="fas fa-arrow-right"></i>
                        </div>
                    </div>
                </div>
            </a>
            @empty
            <div class="col-span-full text-center py-32 bg-slate-900/50 rounded-[3rem] border border-slate-800 border-dashed">
                <div class="inline-block p-10 bg-slate-800 rounded-full mb-8">
                    <i class="fas fa-book-reader text-slate-700 text-7xl"></i>
                </div>
                <h3 class="text-3xl font-bold text-white mb-4 tracking-tighter uppercase">Intisari Belum Tersedia</h3>
                <p class="text-slate-500 max-w-sm mx-auto mb-10 font-light italic">Tim redaksi HASMI sedang menyiapkan konten bermanfaat untuk Anda. Pantau terus halaman ini.</p>
                <a href="{{ route('home') }}" class="px-10 py-4 bg-blue-900/20 hover:bg-blue-600 text-blue-400 hover:text-white rounded-full font-bold border border-blue-900/50 transition-all uppercase tracking-widest text-xs">
                    <i class="fas fa-home mr-2"></i> Kembali Ke Beranda
                </a>
            </div>
            @endforelse
        </div>

        @if($intisaris->hasPages())
        <div class="mt-20 flex justify-center">
            <div class="bg-slate-900 p-2 rounded-2xl border border-slate-800 shadow-2xl">
                {{ $intisaris->links() }}
            </div>
        </div>
        @endif
    </div>
</div>

<style>
    /* Utility Line Clamp (jika Tailwind belum terpasang pluginnya) */
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
    
    /* Pagination Overrides */
    .pagination { @apply flex list-none gap-2; }
    .page-item .page-link { @apply bg-transparent border-none text-slate-500 px-4 py-2 hover:text-white transition-all; }
    .page-item.active .page-link { @apply bg-blue-600 text-white rounded-xl shadow-lg shadow-blue-900/40; }
</style>

@endsection