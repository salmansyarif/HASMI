@extends('layouts.admin')

@section('title', 'Dashboard - Admin HASMI')
@section('page-title', 'Dashboard Overview')
@section('page-subtitle', 'Ringkasan statistik website HASMI')

@section('content')
<div class="grid grid-cols-2 gap-4 md:gap-6 lg:grid-cols-4 mb-6 md:mb-8">
    
    <!-- Articles -->
    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-blue-500 flex flex-col justify-between h-full">
        <div class="flex justify-between items-start mb-2">
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Artikel</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['articles'] }}</h3>
            </div>
            <div class="bg-blue-50 text-blue-600 w-10 h-10 rounded-full flex items-center justify-center text-lg">
                <i class="fas fa-newspaper"></i>
            </div>
        </div>
    </div>

    <!-- Programs -->
    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-emerald-500 flex flex-col justify-between h-full">
        <div class="flex justify-between items-start mb-2">
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Program</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['programs'] }}</h3>
            </div>
            <div class="bg-emerald-50 text-emerald-600 w-10 h-10 rounded-full flex items-center justify-center text-lg">
                <i class="fas fa-briefcase"></i>
            </div>
        </div>
    </div>

    <!-- Berita Terkini -->
    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-orange-500 flex flex-col justify-between h-full">
        <div class="flex justify-between items-start mb-2">
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Berita</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['berita'] }}</h3>
            </div>
            <div class="bg-orange-50 text-orange-600 w-10 h-10 rounded-full flex items-center justify-center text-lg">
                <i class="fas fa-bullhorn"></i>
            </div>
        </div>
    </div>

    <!-- Kegiatan -->
    <div class="bg-white rounded-xl shadow-sm p-4 border-l-4 border-purple-500 flex flex-col justify-between h-full">
        <div class="flex justify-between items-start mb-2">
            <div>
                <p class="text-xs font-bold text-gray-400 uppercase tracking-wider mb-1">Kegiatan</p>
                <h3 class="text-2xl font-bold text-gray-800">{{ $stats['kegiatan'] }}</h3>
            </div>
            <div class="bg-purple-50 text-purple-600 w-10 h-10 rounded-full flex items-center justify-center text-lg">
                <i class="fas fa-calendar-alt"></i>
            </div>
        </div>
    </div>

</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    
    <!-- Quick Actions -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Aksi Cepat</h3>
        <div class="grid grid-cols-2 gap-4">
            <a href="{{ route('admin.articles.create') }}" class="flex items-center gap-3 p-4 rounded-lg bg-gray-50 hover:bg-blue-50 transition-colors border border-gray-100 hover:border-blue-200 group">
                <div class="bg-blue-600 text-white w-8 h-8 rounded flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-plus"></i>
                </div>
                <span class="font-semibold text-gray-700 group-hover:text-blue-700">Artikel Baru</span>
            </a>
            <a href="{{ route('admin.programs.create') }}" class="flex items-center gap-3 p-4 rounded-lg bg-gray-50 hover:bg-emerald-50 transition-colors border border-gray-100 hover:border-emerald-200 group">
                <div class="bg-emerald-600 text-white w-8 h-8 rounded flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-plus"></i>
                </div>
                <span class="font-semibold text-gray-700 group-hover:text-emerald-700">Program Baru</span>
            </a>
            <a href="{{ route('admin.berita-terkini.create') }}" class="flex items-center gap-3 p-4 rounded-lg bg-gray-50 hover:bg-orange-50 transition-colors border border-gray-100 hover:border-orange-200 group">
                <div class="bg-orange-600 text-white w-8 h-8 rounded flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-plus"></i>
                </div>
                <span class="font-semibold text-gray-700 group-hover:text-orange-700">Berita Baru</span>
            </a>
            <a href="{{ route('admin.kegiatan.create') }}" class="flex items-center gap-3 p-4 rounded-lg bg-gray-50 hover:bg-purple-50 transition-colors border border-gray-100 hover:border-purple-200 group">
                <div class="bg-purple-600 text-white w-8 h-8 rounded flex items-center justify-center shadow-lg group-hover:scale-110 transition-transform">
                    <i class="fas fa-plus"></i>
                </div>
                <span class="font-semibold text-gray-700 group-hover:text-purple-700">Kegiatan Baru</span>
            </a>
        </div>
    </div>

    <!-- Pending Comments -->
    <div class="bg-white rounded-xl shadow-sm p-6">
        <div class="flex items-center justify-between mb-4 border-b pb-2">
            <h3 class="text-lg font-bold text-gray-800">Moderasi Komentar</h3>
            @if($stats['comments_pending'] > 0)
            <span class="bg-yellow-100 text-yellow-800 text-xs font-bold px-2 py-1 rounded-full animate-pulse">
                {{ $stats['comments_pending'] }} Pending
            </span>
            @else
            <span class="bg-green-100 text-green-800 text-xs font-bold px-2 py-1 rounded-full">
                Semua Aman
            </span>
            @endif
        </div>
        
        <div class="flex flex-col items-center justify-center h-48 text-center text-gray-500">
            @if($stats['comments_pending'] > 0)
                <i class="fas fa-comments text-4xl text-yellow-400 mb-3"></i>
                <p class="mb-4">Ada {{ $stats['comments_pending'] }} komentar menunggu persetujuan Anda.</p>
                <a href="{{ route('admin.comments.index') }}?status=pending" class="px-4 py-2 bg-yellow-500 hover:bg-yellow-600 text-white rounded-lg font-semibold transition-colors">
                    Review Sekarang
                </a>
            @else
                <i class="fas fa-check-circle text-4xl text-green-400 mb-3"></i>
                <p>Tidak ada komentar pending saat ini.</p>
            @endif
        </div>
    </div>

</div>
@endsection
