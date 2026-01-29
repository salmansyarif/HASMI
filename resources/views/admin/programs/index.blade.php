@extends('layouts.admin')

@section('title', 'Kelola Program - Admin HASMI')
@section('page-title', 'Kelola Program')
@section('page-subtitle', 'Daftar semua program HASMI')

@section('content')

<div class="container-fluid">
    
    <!-- Header Actions -->
    <div class="flex justify-between items-center mb-6">
        <div>
            <h1 class="text-2xl font-bold text-gray-800">Kelola Program</h1>
            <p class="text-gray-600 text-sm mt-1">Total: {{ $programs->total() }} program</p>
        </div>
        <a href="{{ route('admin.programs.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all">
            <i class="fas fa-plus mr-2"></i> Tambah Program
        </a>
    </div>

    <!-- Success Message -->
    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 relative">
            <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
            <button type="button" class="absolute top-0 right-0 px-4 py-3" onclick="this.parentElement.remove()">
                <i class="fas fa-times"></i>
            </button>
        </div>
    @endif

    <!-- Filter -->
    <div class="bg-white rounded-lg shadow-lg p-6 mb-6">
        <form method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-filter text-blue-600 mr-1"></i> Kategori
                </label>
                <select name="category" id="filter-category" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Semua Kategori --</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                            {{ $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-filter text-blue-600 mr-1"></i> Sub Kategori
                </label>
                <select name="subcategory" id="filter-subcategory" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                    <option value="">-- Semua Sub Kategori --</option>
                </select>
            </div>

            <div class="flex items-end gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all">
                    <i class="fas fa-search mr-2"></i> Filter
                </button>
                <a href="{{ route('admin.programs.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-all">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">No</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Thumbnail</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Judul Program</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                        <th class="px-6 py-4 text-left text-xs font-semibold text-gray-600 uppercase">Tipe</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Status</th>
                        <th class="px-6 py-4 text-center text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($programs as $index => $program)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-600">
                            {{ $programs->firstItem() + $index }}
                        </td>
                        <td class="px-6 py-4">
                            @if($program->thumbnail)
                                <img src="{{ $program->getThumbnailUrl() }}" 
                                     class="w-16 h-16 object-cover rounded-lg border border-gray-200"
                                     alt="{{ $program->title }}">
                            @else
                                <div class="w-16 h-16 bg-gray-200 rounded-lg flex items-center justify-center">
                                    <i class="fas fa-image text-gray-400"></i>
                                </div>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div>
                                <p class="font-semibold text-gray-800">{{ $program->title }}</p>
                                <p class="text-xs text-gray-500 mt-1">
                                    <i class="fas fa-link mr-1"></i> {{ $program->slug }}
                                </p>
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="space-y-1">
                                <span class="inline-block px-3 py-1 bg-blue-100 text-blue-700 text-xs rounded-full">
                                    <i class="fas fa-folder mr-1"></i> {{ $program->category->name }}
                                </span>
                                @if($program->subcategory)
                                    <br>
                                    <span class="inline-block px-3 py-1 bg-purple-100 text-purple-700 text-xs rounded-full">
                                        <i class="fas fa-folder-open mr-1"></i> {{ $program->subcategory->name }}
                                    </span>
                                @endif
                            </div>
                        </td>
                        <td class="px-6 py-4">
                            @if($program->isVideo())
                                <span class="inline-block px-3 py-1 bg-red-100 text-red-700 text-xs rounded-full">
                                    <i class="fas fa-video mr-1"></i> Video
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full">
                                    <i class="fas fa-image mr-1"></i> Gambar
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-center">
                            @if($program->is_active)
                                <span class="inline-block px-3 py-1 bg-green-100 text-green-700 text-xs rounded-full font-semibold">
                                    <i class="fas fa-check-circle mr-1"></i> Aktif
                                </span>
                            @else
                                <span class="inline-block px-3 py-1 bg-gray-100 text-gray-700 text-xs rounded-full font-semibold">
                                    <i class="fas fa-times-circle mr-1"></i> Nonaktif
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex items-center justify-center gap-2">
                                <a href="{{ route('admin.programs.edit', $program) }}" 
                                   class="bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg text-sm font-semibold transition-all"
                                   title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.programs.destroy', $program) }}" 
                                      method="POST" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg text-sm font-semibold transition-all"
                                            title="Hapus"
                                            onclick="return confirm('Yakin ingin menghapus program \'{{ $program->title }}\'?')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" class="px-6 py-12 text-center">
                            <i class="fas fa-inbox text-gray-300 text-5xl mb-4"></i>
                            <p class="text-gray-500 text-lg">Belum ada data program</p>
                            <a href="{{ route('admin.programs.create') }}" class="inline-block mt-4 text-blue-600 hover:text-blue-700 font-semibold">
                                <i class="fas fa-plus mr-2"></i> Tambah Program Pertama
                            </a>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($programs->hasPages())
        <div class="px-6 py-4 border-t border-gray-200">
            {{ $programs->links() }}
        </div>
        @endif
    </div>
</div>

@endsection

@section('scripts')
<script>
// Load subcategories berdasarkan category yang dipilih
document.getElementById('filter-category').addEventListener('change', function() {
    const categoryId = this.value;
    const subcategorySelect = document.getElementById('filter-subcategory');
    
    // Reset subcategory
    subcategorySelect.innerHTML = '<option value="">-- Semua Sub Kategori --</option>';
    
    if (categoryId) {
        // Fetch subcategories via AJAX
        fetch(`/admin/programs/subcategories?category_id=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                data.forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub.id;
                    option.textContent = sub.name;
                    subcategorySelect.appendChild(option);
                });
            });
    }
});

// Load subcategories on page load jika ada filter
@if(request('category'))
    document.getElementById('filter-category').dispatchEvent(new Event('change'));
    @if(request('subcategory'))
        setTimeout(() => {
            document.getElementById('filter-subcategory').value = '{{ request('subcategory') }}';
        }, 500);
    @endif
@endif
</script>
@endsection