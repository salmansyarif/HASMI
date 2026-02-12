@extends('layouts.admin')

@section('title', 'Edit Intisari - Admin HASMI')
@section('page-title', 'Edit Intisari')
@section('page-subtitle', 'Update intisari yang sudah ada')

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.intisari.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-2 transition-colors">
            <i class="fas fa-arrow-left"></i> Kembali ke Daftar
        </a>
    </div>

    @if ($errors->any())
        <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-r-lg shadow-sm">
            <div class="flex">
                <div class="flex-shrink-0">
                    <i class="fas fa-exclamation-circle text-red-500"></i>
                </div>
                <div class="ml-3">
                    <h3 class="text-sm font-medium text-red-800">Terdapat kesalahan pada inputan:</h3>
                    <ul class="mt-2 text-sm text-red-700 list-disc list-inside">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    @endif

    <form action="{{ route('admin.intisari.update', $intisari->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Main Content (2/3) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- General Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Intisari</h3>
                    
                    <!-- Judul -->
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Intisari <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" 
                               class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white" 
                               placeholder="Masukkan judul intisari..."
                               value="{{ old('title', $intisari->title) }}" required>
                    </div>

                    <!-- Excerpt -->
                    <div class="mb-5">
                        <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat (Excerpt)</label>
                        <textarea name="excerpt" id="excerpt" rows="3" maxlength="500"
                                  class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white"
                                  placeholder="Ringkasan singkat (maks 500 karakter)...">{{ old('excerpt', $intisari->excerpt) }}</textarea>
                        <p class="text-gray-500 text-xs mt-1">Opsional. Jika kosong, akan otomatis diambil dari konten.</p>
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Konten Intisari <span class="text-red-500">*</span></label>
                        <textarea name="content" id="content" rows="15" required
                                  class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all font-sans text-lg leading-relaxed p-4 bg-gray-50 focus:bg-white"
                                  placeholder="Tulis konten intisari di sini...">{{ old('content', $intisari->content) }}</textarea>
                    </div>
                </div>

            </div>

            <!-- Right Column: Sidebar (1/3) -->
            <div class="space-y-6">
                
                <!-- Status & Action Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Status Publikasi</h3>
                    
                    <div class="mb-5">
                        <label for="status" class="block text-sm font-semibold text-gray-700 mb-2">Status <span class="text-red-500">*</span></label>
                        <select id="status" name="status" required
                                class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white">
                            <option value="draft" {{ old('status', $intisari->status) == 'draft' ? 'selected' : '' }}>Draft (Belum Dipublikasi)</option>
                            <option value="published" {{ old('status', $intisari->status) == 'published' ? 'selected' : '' }}>Published (Langsung Tayang)</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Update Intisari
                        </button>
                        <a href="{{ route('admin.intisari.index') }}" class="w-full bg-gray-100 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </div>

                <!-- Thumbnail Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thumbnail</h3>
                    
                    @if($intisari->thumbnail)
                    <div class="mb-4">
                        <p class="text-xs text-gray-500 mb-2">Thumbnail Saat Ini:</p>
                        <div class="relative group rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ asset($intisari->thumbnail) }}" alt="Current thumbnail" class="w-full h-auto object-cover">
                        </div>
                    </div>
                    @endif

                    <div class="mb-4">
                        <label class="block text-sm text-gray-500 mb-2">
                            {{ $intisari->thumbnail ? 'Ganti Thumbnail' : 'Upload Thumbnail' }}
                        </label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/jpeg,image/png,image/jpg,image/webp"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all"
                               onchange="previewThumbnail(event)">
                        <p class="mt-2 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                    </div>

                    <!-- Preview -->
                    <div id="thumbnail-preview" class="mt-4"></div>
                </div>

            </div>
        </div>
    </form>
</div>

<script data-cfasync="false">
    function previewThumbnail(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('thumbnail-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <div class="relative inline-block">
                        <img src="${e.target.result}" alt="Thumbnail Preview" class="w-full max-w-md h-48 object-cover rounded-lg border border-gray-300">
                        <div class="absolute top-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded font-semibold">PREVIEW BARU</div>
                    </div>
                `;
            }
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    }
</script>
@endsection