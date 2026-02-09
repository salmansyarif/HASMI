@extends('layouts.admin')

@section('title', 'Tambah Kegiatan')
@section('page-title', 'Tambah Kegiatan')
@section('page-subtitle', 'Buat kegiatan baru')

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.kegiatan.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-2 transition-colors">
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

    <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Main Content (2/3) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- General Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Kegiatan</h3>
                    
                    <!-- Judul -->
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Kegiatan <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" 
                               class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white" 
                               placeholder="Contoh: Bakti Sosial Tahun 2024"
                               value="{{ old('title') }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-5">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat (Opsional)</label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white"
                                  placeholder="Deskripsi singkat kegiatan...">{{ old('description') }}</textarea>
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Konten Lengkap</label>
                        <textarea name="content" id="content" rows="15"
                                  class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all font-sans text-lg leading-relaxed p-4 bg-gray-50 focus:bg-white"
                                  placeholder="Tulis konten lengkap kegiatan di sini...">{{ old('content') }}</textarea>
                    </div>
                </div>

                <!-- Media Content Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Galeri Foto</h3>

                    <!-- Image Section (Gallery) -->
                    <div id="photos-section">
                        <div class="mb-4">
                            <label class="block text-sm text-gray-500 mb-2">Upload Foto Kegiatan</label>
                            <input type="file" name="photos[]" id="photos" accept="image/jpeg,image/png,image/jpg,image/webp" multiple
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all"
                                   onchange="previewPhotos(event)">
                            <p class="mt-2 text-xs text-gray-400">
                                Bisa pilih lebih dari satu foto. Format: JPG, PNG, WEBP. Maks 2MB. <br>
                                <span class="text-blue-600 font-semibold">Catatan:</span> Foto pertama yang dipilih akan menjadi thumbnail default.
                            </p>
                        </div>
                        <div id="photos-preview" class="grid grid-cols-4 gap-4 mt-4"></div>
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
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Belum Dipublikasi)</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Langsung Tayang)</option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="flex items-center space-x-3 cursor-pointer p-3 border rounded-lg hover:bg-gray-50 transition-colors">
                            <input type="checkbox" name="show_thumbnail_in_list" value="1" 
                                   class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500" 
                                   {{ old('show_thumbnail_in_list') ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Tampilkan thumbnail di daftar</span>
                        </label>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Simpan Kegiatan
                        </button>
                        <button type="reset" class="w-full bg-gray-100 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-redo"></i> Reset Form
                        </button>
                    </div>
                </div>

                <!-- Display Settings Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Pengaturan Tampilan</h3>
                    
                    <!-- Photo Position -->
                    <div>
                        <label for="photo_position" class="block text-sm font-semibold text-gray-700 mb-2">Posisi Foto Utama <span class="text-red-500">*</span></label>
                        <select id="photo_position" name="photo_position" required
                                class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white">
                            <option value="top" {{ old('photo_position', 'top') == 'top' ? 'selected' : '' }}>Atas (Top)</option>
                            <option value="bottom" {{ old('photo_position') == 'bottom' ? 'selected' : '' }}>Bawah (Bottom)</option>
                            <option value="none" {{ old('photo_position') == 'none' ? 'selected' : '' }}>Tanpa Foto</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
    function previewPhotos(event) {
        const previewContainer = document.getElementById('photos-preview');
        previewContainer.innerHTML = '';
        const files = event.target.files;

        if (files) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const imgDiv = document.createElement('div');
                    imgDiv.className = 'relative aspect-square rounded-lg overflow-hidden border border-gray-200 shadow-sm';
                    imgDiv.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    previewContainer.appendChild(imgDiv);
                }
                reader.readAsDataURL(file);
            });
        }
    }
</script>
@endsection
