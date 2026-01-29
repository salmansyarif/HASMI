@extends('layouts.admin')

@section('title', 'Edit Intisari - Admin HASMI')
@section('page-title', 'Edit Intisari')
@section('page-subtitle', 'Update intisari yang sudah ada')

@section('content')

<div class="max-w-4xl">
    <form action="{{ route('admin.intisari.update', $intisari->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-lg p-8 space-y-6">
            
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Intisari <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" name="title" value="{{ old('title', $intisari->title) }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                       placeholder="Masukkan judul intisari...">
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi Singkat (Excerpt)
                </label>
                <textarea id="excerpt" name="excerpt" rows="3" maxlength="500"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('excerpt') border-red-500 @enderror"
                          placeholder="Ringkasan singkat (maks 500 karakter)...">{{ old('excerpt', $intisari->excerpt) }}</textarea>
                <p class="text-gray-500 text-xs mt-1">Opsional. Jika kosong, akan otomatis diambil dari konten.</p>
                @error('excerpt')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                    Konten Intisari <span class="text-red-500">*</span>
                </label>
                <textarea id="content" name="content" rows="15" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror"
                          placeholder="Tulis konten intisari di sini...">{{ old('content', $intisari->content) }}</textarea>
                @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="thumbnail" class="block text-sm font-semibold text-gray-700 mb-2">
                    Foto Thumbnail
                </label>
                
                @if($intisari->thumbnail)
                <div class="mb-4">
                    <img src="{{ asset($intisari->thumbnail) }}" alt="Current thumbnail" class="w-32 h-32 object-cover rounded-lg border border-gray-300">
                </div>
                @endif

                <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/jpg,image/webp"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('thumbnail') border-red-500 @enderror"
                       onchange="previewImage(event)">
                <p class="text-gray-500 text-xs mt-1">Opsional. Format: JPG, PNG, WEBP. Maks 2MB.</p>
                @error('thumbnail')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div id="preview-container" class="mt-4 hidden">
                    <p class="text-sm font-semibold text-gray-700 mb-2">Preview Baru:</p>
                    <img id="preview-image" src="" alt="Preview" class="w-48 h-48 object-cover rounded-lg border border-gray-300">
                </div>
            </div>

            <div>
                <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">
                    Status <span class="text-red-500">*</span>
                </label>
                <select id="status" name="status" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('status') border-red-500 @enderror">
                    <option value="draft" {{ old('status', $intisari->status) == 'draft' ? 'selected' : '' }}>Draft (Belum Dipublikasi)</option>
                    <option value="published" {{ old('status', $intisari->status) == 'published' ? 'selected' : '' }}>Published (Langsung Tayang)</option>
                </select>
                @error('status')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.intisari.index') }}" class="text-gray-600 hover:text-gray-800 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all">
                    <i class="fas fa-save mr-2"></i> Update Intisari
                </button>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
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
</script>
@endsection