@extends('layouts.admin')

@section('title', 'Daftar Berita Terkini')
@section('page-title', 'Berita Terkini')
@section('page-subtitle', 'Kelola berita terkini dan dokumentasi')

@section('content')
<div class="bg-white rounded-xl shadow-sm border border-gray-100 overflow-hidden">
    <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row md:items-center justify-between gap-4">
        <div class="flex-1">
            <form action="{{ route('admin.berita-terkini.index') }}" method="GET" class="relative">
                <i class="fas fa-search absolute left-3 top-1/2 -translate-y-1/2 text-gray-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" 
                    class="w-full pl-10 pr-4 py-2 border border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent"
                    placeholder="Cari berita...">
            </form>
        </div>
        <div class="flex gap-2">
            <a href="{{ route('admin.berita-terkini.create') }}" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition class font-medium flex items-center gap-2">
                <i class="fas fa-plus"></i> Tambah Berita
            </a>
        </div>
    </div>

    @if(session('success'))
    <div class="px-6 py-4 bg-green-50 border-b border-green-100 text-green-700 flex items-center gap-3">
        <i class="fas fa-check-circle"></i>
        <span class="text-sm font-medium">{{ session('success') }}</span>
    </div>
    @endif

    <div class="overflow-x-auto">
        <table class="w-full text-left border-collapse">
            <thead>
                <tr class="bg-gray-50 text-gray-600 text-xs uppercase tracking-wider">
                    <th class="px-6 py-4 font-semibold border-b">No</th>
                    <th class="px-6 py-4 font-semibold border-b">Thumbnail</th>
                    <th class="px-6 py-4 font-semibold border-b">Judul & Cuplikan</th>
                    <th class="px-6 py-4 font-semibold border-b">Views</th>
                    <th class="px-6 py-4 font-semibold border-b">Status</th>
                    <th class="px-6 py-4 font-semibold border-b text-right">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($beritas as $index => $berita)
                <tr class="hover:bg-gray-50/50 transition-colors">
                    <td class="px-6 py-4 text-gray-500 text-sm">
                        {{ $beritas->firstItem() + $index }}
                    </td>
                    <td class="px-6 py-4">
                        <div class="w-16 h-12 rounded-lg overflow-hidden bg-gray-100 border border-gray-200">
                            @if($berita->thumbnail)
                                <img src="{{ $berita->getThumbnailUrl() }}" alt="" class="w-full h-full object-cover">
                            @else
                                <div class="w-full h-full flex items-center justify-center text-gray-400">
                                    <i class="fas fa-image"></i>
                                </div>
                            @endif
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="max-w-xs">
                            <h4 class="font-bold text-gray-800 mb-1 line-clamp-1" title="{{ $berita->title }}">
                                {{ $berita->title }}
                            </h4>
                            <p class="text-xs text-gray-500 line-clamp-2">
                                {{ $berita->excerpt }}
                            </p>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm text-gray-600">
                            <i class="far fa-eye mr-1 text-gray-400"></i>
                            {{ number_format($berita->views) }}
                        </div>
                        <div class="text-xs text-gray-400 mt-1">
                            Published: {{ $berita->created_at->format('d M Y') }}
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        @if($berita->is_active)
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                <span class="w-1.5 h-1.5 bg-green-500 rounded-full mr-1.5"></span>
                                Aktif
                            </span>
                        @else
                            <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-gray-100 text-gray-800">
                                <span class="w-1.5 h-1.5 bg-gray-500 rounded-full mr-1.5"></span>
                                Non-Aktif
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('berita-terkini.show', $berita->slug) }}" target="_blank" 
                               class="w-8 h-8 rounded-lg flex items-center justify-center text-gray-400 hover:text-blue-600 hover:bg-blue-50 transition-colors"
                                title="Lihat di Website">
                                <i class="fas fa-external-link-alt"></i>
                            </a>
                            <a href="{{ route('admin.berita-terkini.edit', $berita->id) }}" 
                               class="w-8 h-8 rounded-lg flex items-center justify-center text-blue-600 bg-blue-50 hover:bg-blue-100 transition-colors"
                                title="Edit">
                                <i class="fas fa-pencil-alt"></i>
                            </a>
                            <form action="{{ route('admin.berita-terkini.destroy', $berita->id) }}" method="POST" 
                                  onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="w-8 h-8 rounded-lg flex items-center justify-center text-red-600 bg-red-50 hover:bg-red-100 transition-colors"
                                    title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                            <i class="fas fa-newspaper text-2xl text-gray-400"></i>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-1">Belum ada berita</h3>
                        <p class="text-sm mb-4">Silakan tambahkan berita pertama Anda.</p>
                        <a href="{{ route('admin.berita-terkini.create') }}" class="text-blue-600 hover:underline font-medium">Buat Berita Pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($beritas->hasPages())
    <div class="px-6 py-4 border-t border-gray-100">
        {{ $beritas->links() }}
    </div>
    @endif
</div>
@endsection
