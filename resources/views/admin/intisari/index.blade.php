@extends('layouts.admin')

@section('title', 'Kelola Intisari - Admin HASMI')
@section('page-title', 'Kelola Intisari HASMI')
@section('page-subtitle', 'Daftar semua artikel intisari')

@section('content')

<div class="bg-white rounded-lg shadow-lg">
    <div class="p-6 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Daftar Intisari</h2>
            <p class="text-gray-600 text-sm">Total: {{ $intisaris->total() }} artikel</p>
        </div>
        <a href="{{ route('admin.intisari.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold flex items-center gap-2 transition-all">
            <i class="fas fa-plus"></i> Tambah Intisari
        </a>
    </div>

    <!-- Filter & Search -->
    <div class="p-6 bg-gray-50 border-b border-gray-200">
        <form method="GET" action="{{ route('admin.intisari.index') }}" class="grid md:grid-cols-3 gap-4">
            <div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari judul..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                <a href="{{ route('admin.intisari.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-semibold transition-all">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Intisari</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($intisaris as $intisari)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-16 h-16 rounded-lg overflow-hidden flex-shrink-0">
                                @if($intisari->thumbnail)
                                    <img src="{{ asset($intisari->thumbnail) }}" alt="{{ $intisari->title }}" class="w-full h-full object-cover">
                                @else
                                    <div class="w-full h-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center">
                                        <span class="text-white font-bold text-xl">H</span>
                                    </div>
                                @endif
                            </div>
                            <div class="flex-1 min-w-0">
                                <p class="font-semibold text-gray-800 truncate">{{ $intisari->title }}</p>
                                <p class="text-xs text-gray-500 truncate">{{ Str::limit($intisari->excerpt, 60) }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $intisari->published_at ? $intisari->published_at->locale('id')->isoFormat('D MMM Y') : '-' }}
                    </td>
                    <td class="px-6 py-4">
                        @if($intisari->status == 'published')
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-check-circle"></i> Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-clock"></i> Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            <a href="{{ route('admin.intisari.edit', $intisari->id) }}" class="text-blue-600 hover:text-blue-700 p-2 hover:bg-blue-50 rounded-lg transition-all" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.intisari.destroy', $intisari->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus intisari ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-12 text-center">
                        <i class="fas fa-folder-open text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500 text-lg">Belum ada intisari.</p>
                        <a href="{{ route('admin.intisari.create') }}" class="text-blue-600 hover:text-blue-700 font-semibold mt-2 inline-block">+ Tambah Intisari Pertama</a>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($intisaris->hasPages())
    <div class="p-6 border-t border-gray-200">
        {{ $intisaris->links() }}
    </div>
    @endif
</div>

@endsection