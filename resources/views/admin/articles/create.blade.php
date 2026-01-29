@extends('layouts.admin')

@section('title', 'Tambah Artikel - Admin HASMI')
@section('page-title', 'Tambah Artikel Baru')
@section('page-subtitle', 'Buat artikel baru untuk website HASMI')

@section('content')

<div class="max-w-4xl">
    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-lg shadow-lg p-8 space-y-6">
            
            <!-- Title -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Artikel <span class="text-red-500">*</span>
                </label>
                <input type="text" 
                       id="title" 
                       name="title" 
                       value="{{ old('title') }}"
                       required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                       placeholder="Masukkan judul artikel...">
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Category -->
            <div>
                <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Kategori <span class="text-red-500">*</span>
                </label>
                <select id="category_id" 
                        name="category_id" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('category_id') border-red-500 @enderror">
                    <option value="">Pilih Kategori</option>
                    @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Sub Category (Dynamic) -->
            <div id="sub-category-container" class="hidden">
                <label for="sub_category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    Sub Kategori
                </label>
                <select id="sub_category_id" 
                        name="sub_category_id" 
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('sub_category_id') border-red-500 @enderror">
                    <option value="">Pilih Sub Kategori (Opsional)</option>
                </select>
                @error('sub_category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Excerpt -->
            <div>
                <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi Singkat (Excerpt)
                </label>
                <textarea id="excerpt" 
                          name="excerpt" 
                          rows="3"
                          maxlength="500"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('excerpt') border-red-500 @enderror"
                          placeholder="Ringkasan singkat artikel (maks 500 karakter)...">{{ old('excerpt') }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Opsional. Jika kosong, akan otomatis diambil dari konten.</p>
                @error('excerpt')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Content -->
            <div>
                <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                    Konten Artikel <span class="text-red-500">*</span>
                </label>
                <textarea id="content" 
                          name="content" 
                          rows="15"
                          required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror"
                          placeholder="Tulis konten artikel di sini...">{{ old('content') }}</textarea>
                @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Thumbnail -->
            <div>
                <label for="thumbnail" class="block text-sm font-semibold text-gray-700 mb-2">
                    Foto Thumbnail
                </label>
                <input type="file" 
                       id="thumbnail" 
                       name="thumbnail" 
                       accept="image/jpeg,image/png,image/jpg,image/webp"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('thumbnail') border-red-500 @enderror"
                       onchange="previewImage(event)">
                <p class="text-gray-500 text-xs mt-1">Opsional. Format: JPG, PNG, WEBP. Maks 2MB. Jika tidak diupload, akan menggunakan logo HASMI.</p>
                @error('thumbnail')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <!-- Preview -->
                <div id="preview-container" class="mt-4 hidden">
                    <p class="text-sm font-semibold text-gray-700 mb-2">Preview:</p>
                    <img id="preview-image" src="" alt="Preview" class="w-48 h-48 object-cover rounded-lg border border-gray-300">
                </div>
            </div>

            <!-- Status -->
            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" 
                        name="status" 
                        required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                    <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Belum Dipublikasi)</option>
                    <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Langsung Tayang)</option>
                </select>
                @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Buttons -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.articles.index') }}" class="text-gray-600 hover:text-gray-800 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <div class="flex gap-3">
                    <button type="reset" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-all">
                        <i class="fas fa-redo mr-2"></i> Reset
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all">
                        <i class="fas fa-save mr-2"></i> Simpan Artikel
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
    // Preview image sebelum upload
    function previewImage(event) {
        const file = event.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('preview-image').src = e.target.result;
                document.getElementById('preview-container').classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

    // Load Sub Categories when Category changes
    document.getElementById('category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const subCategoryContainer = document.getElementById('sub-category-container');
        const subCategorySelect = document.getElementById('sub_category_id');

        if (!categoryId) {
            subCategoryContainer.classList.add('hidden');
            subCategorySelect.innerHTML = '<option value="">Pilih Sub Kategori (Opsional)</option>';
            return;
        }

        // Fetch sub-categories via AJAX
        fetch(`/admin/articles/sub-categories/${categoryId}`)
            .then(response => response.json())
            .then(data => {
                subCategorySelect.innerHTML = '<option value="">Pilih Sub Kategori (Opsional)</option>';
                
                if (data.length > 0) {
                    data.forEach(sub => {
                        const option = document.createElement('option');
                        option.value = sub.id;
                        option.textContent = sub.name;
                        subCategorySelect.appendChild(option);
                    });
                    subCategoryContainer.classList.remove('hidden');
                } else {
                    subCategoryContainer.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error loading sub-categories:', error);
                subCategoryContainer.classList.add('hidden');
            });
    });
</script>
@endsection