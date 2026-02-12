@extends('layouts.admin')

@section('title', 'Kelola Artikel - Admin HASMI')
@section('page-title', 'Kelola Artikel')
@section('page-subtitle', 'Manajemen artikel website HASMI')

@section('content')

<!-- Filter & Search -->
<div class="bg-white rounded-lg shadow-lg p-6 mb-6">
    <form method="GET" action="{{ route('admin.articles.index') }}" class="grid grid-cols-1 md:grid-cols-4 gap-4">
        
        <!-- Search -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Cari Artikel</label>
            <input type="text" 
                   name="search" 
                   value="{{ request('search') }}"
                   placeholder="Judul artikel..."
                   class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
        </div>

        <!-- Category Filter -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Kategori</label>
            <select name="category" 
                    id="filter-category"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Kategori</option>
                @foreach($categories as $cat)
                <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
                    {{ $cat->name }}
                </option>
                @endforeach
            </select>
        </div>

        <!-- Sub Category Filter (Dynamic) -->
        <div id="filter-sub-category-container" class="{{ request('sub_category') ? '' : 'hidden' }}">
            <label class="block text-sm font-semibold text-gray-700 mb-2">Sub Kategori</label>
            <select name="sub_category" 
                    id="filter-sub-category"
                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Sub Kategori</option>
                <!-- Will be populated via AJAX -->
            </select>
        </div>

        <!-- Status Filter -->
        <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2">Status</label>
            <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500">
                <option value="">Semua Status</option>
                <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Draft</option>
                <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Published</option>
            </select>
        </div>

        <!-- Buttons -->
        <div class="md:col-span-4 flex gap-3">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg font-semibold">
                <i class="fas fa-search mr-2"></i> Filter
            </button>
            <a href="{{ route('admin.articles.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg font-semibold">
                <i class="fas fa-redo mr-2"></i> Reset
            </a>
        </div>
    </form>
</div>

<!-- Header Actions -->
<div class="flex items-center justify-between mb-6">
    <div>
        <p class="text-gray-600">Total: <strong>{{ $articles->total() }}</strong> artikel</p>
    </div>
    <a href="{{ route('admin.articles.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold inline-flex items-center gap-2">
        <i class="fas fa-plus"></i> Tambah Artikel
    </a>
</div>

<!-- Articles Table -->
<div class="bg-white rounded-lg shadow-lg overflow-hidden">
    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-50 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Judul</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Kategori</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Sub Kategori</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Penulis</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                    <th class="px-6 py-4 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Tanggal</th>
                    <th class="px-6 py-4 text-center text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($articles as $article)
                <tr class="hover:bg-gray-50 transition-colors">
                    <!-- Title -->
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            @if($article->thumbnail)
                            <img src="{{ asset($article->thumbnail) }}" alt="Thumbnail" class="w-12 h-12 object-cover rounded-lg">
                            @else
                            <div class="w-12 h-12 bg-gray-200 rounded-lg flex items-center justify-center">
                                <i class="fas fa-image text-gray-400"></i>
                            </div>
                            @endif
                            <div>
                                <p class="font-semibold text-gray-900">{{ Str::limit($article->title, 50) }}</p>
                                <p class="text-sm text-gray-500">{{ $article->slug }}</p>
                            </div>
                        </div>
                    </td>

                    <!-- Category -->
                    <td class="px-6 py-4">
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-blue-100 text-blue-800 rounded-full text-xs font-semibold">
                            <i class="fas {{ $article->category->icon }}"></i>
                            {{ $article->category->name }}
                        </span>
                    </td>

                    <!-- Sub Category -->
                    <td class="px-6 py-4">
                        @if($article->subCategory)
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-purple-100 text-purple-800 rounded-full text-xs font-semibold">
                            <i class="fas {{ $article->subCategory->icon }}"></i>
                            {{ $article->subCategory->name }}
                        </span>
                        @else
                        <span class="text-gray-400 text-xs">-</span>
                        @endif
                    </td>

                    <!-- Author -->
                    <td class="px-6 py-4">
                        <p class="text-sm text-gray-900">{{ $article->author->name }}</p>
                    </td>

                    <!-- Status -->
                    <td class="px-6 py-4">
                        @if($article->status == 'published')
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-green-100 text-green-800 rounded-full text-xs font-semibold">
                            <i class="fas fa-check-circle"></i> Published
                        </span>
                        @else
                        <span class="inline-flex items-center gap-1 px-3 py-1 bg-yellow-100 text-yellow-800 rounded-full text-xs font-semibold">
                            <i class="fas fa-clock"></i> Draft
                        </span>
                        @endif
                    </td>

                    <!-- Date -->
                    <td class="px-6 py-4">
                        @if($article->published_at)
                        <p class="text-sm text-gray-900">{{ $article->published_at->format('d M Y') }}</p>
                        <p class="text-xs text-gray-500">{{ $article->published_at->format('H:i') }}</p>
                        @else
                        <p class="text-sm text-gray-500">Belum publish</p>
                        @endif
                    </td>

                    <!-- Actions -->
                    <td class="px-6 py-4 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('admin.articles.edit', $article->id) }}" 
                               class="text-blue-600 hover:text-blue-700 p-2" 
                               title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('admin.articles.destroy', $article->id) }}" 
                                  method="POST" 
                                  onsubmit="return confirm('Yakin ingin menghapus artikel ini?')"
                                  class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-700 p-2" 
                                        title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="px-6 py-12 text-center">
                        <div class="flex flex-col items-center gap-3">
                            <i class="fas fa-inbox text-gray-300 text-5xl"></i>
                            <p class="text-gray-500 font-semibold">Tidak ada artikel</p>
                            <a href="{{ route('admin.articles.create') }}" class="text-blue-600 hover:text-blue-700 font-semibold">
                                <i class="fas fa-plus mr-1"></i> Tambah Artikel Pertama
                            </a>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <!-- Pagination -->
    @if($articles->hasPages())
    <div class="px-6 py-4 border-t border-gray-200">
        {{ $articles->links() }}
    </div>
    @endif
</div>

@endsection

@section('scripts')
<script data-cfasync="false">
    // Load Sub Categories when Category filter changes
    const filterCategory = document.getElementById('filter-category');
    const filterSubCategoryContainer = document.getElementById('filter-sub-category-container');
    const filterSubCategory = document.getElementById('filter-sub-category');

    // Load on page load if category is selected
    window.addEventListener('DOMContentLoaded', function() {
        const selectedCategory = filterCategory.value;
        const selectedSubCategory = '{{ request("sub_category") }}';
        
        if (selectedCategory) {
            loadSubCategories(selectedCategory, selectedSubCategory);
        }
    });

    // Load when category changes
    filterCategory.addEventListener('change', function() {
        const categoryId = this.value;
        
        if (!categoryId) {
            filterSubCategoryContainer.classList.add('hidden');
            filterSubCategory.innerHTML = '<option value="">Semua Sub Kategori</option>';
            return;
        }

        loadSubCategories(categoryId);
    });

    function loadSubCategories(categoryId, selectedId = null) {
        fetch(`/admin/articles/sub-categories/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                filterSubCategory.innerHTML = '<option value="">Semua Sub Kategori</option>';
                
                if (data.length > 0) {
                    data.forEach(sub => {
                        const option = document.createElement('option');
                        option.value = sub.id;
                        option.textContent = sub.name;
                        
                        if (selectedId && sub.id == selectedId) {
                            option.selected = true;
                        }
                        
                        filterSubCategory.appendChild(option);
                    });
                    filterSubCategoryContainer.classList.remove('hidden');
                } else {
                    filterSubCategoryContainer.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error loading sub-categories:', error);
                filterSubCategoryContainer.classList.add('hidden');
            });
    }
</script>
@endsection 