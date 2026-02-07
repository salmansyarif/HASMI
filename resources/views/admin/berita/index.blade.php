@extends('layouts.admin')

@section('title', 'Kelola Berita - Admin HASMI')
@section('page-title', 'Kelola Berita Terkini')
@section('page-subtitle', 'Daftar semua berita dan informasi terkini')

@section('content')

<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <!-- Header Tools -->
    <div class="p-6 border-b border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
        <div class="flex items-center gap-4">
            <div class="relative">
                <input type="text" placeholder="Cari berita..." class="pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 w-64">
                <i class="fas fa-search absolute left-3 top-3 text-gray-400"></i>
            </div>
        </div>
        <a href="{{ route('admin.berita.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold transition-all flex items-center gap-2">
            <i class="fas fa-plus"></i> Tambah Berita
        </a>
    </div>

    <!-- Table -->
    <div class="overflow-x-auto">
        <table class="w-full text-left">
            <thead class="bg-gray-50 text-gray-600 uppercase text-xs font-semibold">
                <tr>
                    <th class="px-6 py-4">Thumbnail</th>
                    <th class="px-6 py-4">Judul Berita</th>
                    <th class="px-6 py-4">Tanggal</th>
                    <th class="px-6 py-4 text-center">Views</th>
                    <th class="px-6 py-4 text-center">Status</th>
                    <th class="px-6 py-4 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse($beritas as $berita)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <img src="{{ $berita->getThumbnailUrl() }}" alt="Thumb" class="w-16 h-10 object-cover rounded shadow-sm">
                    </td>
                    <td class="px-6 py-4">
                        <div class="font-bold text-gray-800">{{ $berita->title }}</div>
                        <div class="text-xs text-cool-gray-500 mt-1 truncate w-64">{{ Str::limit(strip_tags($berita->content), 50) }}</div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $berita->created_at->format('d M Y, H:i') }}
                    </td>
                    <td class="px-6 py-4 text-center text-sm font-semibold text-gray-600">
                        {{ number_format($berita->views) }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        @if($berita->is_active)
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700">
                                Aktif
                            </span>
                        @else
                            <span class="px-3 py-1 rounded-full text-xs font-bold bg-gray-100 text-gray-500">
                                Draft
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.berita.edit', $berita) }}" class="p-2 text-blue-600 hover:bg-blue-50 rounded-lg transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.berita.destroy', $berita) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus berita ini?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="p-2 text-red-600 hover:bg-red-50 rounded-lg transition-colors" title="Hapus">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                        <i class="fas fa-newspaper text-4xl mb-3 text-gray-300"></i>
                        <p>Belum ada berita yang ditambahkan.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    <div class="p-4 border-t border-gray-100">
        {{ $beritas->links() }}
    </div>
</div>

@endsection
