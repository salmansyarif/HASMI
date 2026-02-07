@extends('layouts.admin')

@section('title', 'Tambah Berita Terkini')
@section('page-title', 'Tambah Berita')
@section('page-subtitle', 'Buat postingan berita baru')

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.berita-terkini.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-2 transition-colors">
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

    <form action="{{ route('admin.berita-terkini.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Main Content (2/3) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- General Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Umum</h3>
                    
                    <!-- Judul -->
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Berita <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" 
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg" 
                               placeholder="Masukkan judul berita yang menarik..."
                               value="{{ old('title') }}" required>
                    </div>

                    <!-- Excerpt (Short Description) -->
                    <div class="mb-5">
                        <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi Singkat (Opsional)
                            <span class="text-xs font-normal text-gray-500 ml-1">- Ditampilkan di preview kartu berita</span>
                        </label>
                        <textarea name="excerpt" id="excerpt" rows="3" 
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                  placeholder="Ringkasan singkat berita...">{{ old('excerpt') }}</textarea>
                    </div>

                    <!-- Content (Long Description) -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Konten Berita Lengkap</label>
                        <textarea name="content" id="content" rows="20" 
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all font-sans text-base leading-relaxed p-4"
                                  placeholder="Tulis lengkap berita di sini...">{{ old('content') }}</textarea>
                    </div>
                </div>

                <!-- Gallery Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 flex items-center gap-2">
                        <i class="fas fa-images text-blue-500"></i> Galeri Foto Dokumentasi
                    </h3>
                    
                    <div class="mb-4">
                        <label class="block text-sm text-gray-500 mb-2">Upload Foto Dokumentasi</label>
                        <input type="file" name="photos[]" id="photos" accept="image/*" multiple 
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all"
                               onchange="previewPhotos(this)">
                        <p class="mt-2 text-xs text-gray-400">Bisa pilih lebih dari satu foto sekaligus.</p>
                    </div>
                    <!-- Preview Container -->
                    <div id="photos-preview" class="grid grid-cols-4 gap-4 mt-4"></div>
                </div>

            </div>

            <!-- Right Column: Sidebar (1/3) -->
            <div class="space-y-6">
                
                <!-- Status & Action Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Status Publikasi</h3>
                    
                    <div class="flex items-center justify-between mb-6 p-3 bg-gray-50 rounded-lg">
                        <span class="text-sm font-medium text-gray-700">Status</span>
                        <label class="relative inline-flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', true) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 peer-checked:text-blue-600">Aktif</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-paper-plane"></i> Publikasikan Berita
                    </button>
                </div>

                <!-- Media Thumbnail Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thumbnail Utama</h3>
                    
                    <div class="mb-4">
                        <label class="block text-sm text-gray-500 mb-2">Gambar Sampul Berita</label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                    </div>
                </div>

                <!-- Video Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Video (Opsional)</h3>
                    
                    <div class="space-y-4">
                        <div class="flex bg-gray-100 rounded-lg p-1">
                            <button type="button" onclick="toggleVideoInput('file')" id="btn-file" class="flex-1 py-1 px-3 text-sm rounded-md bg-white shadow text-blue-600 font-medium transition-all">Upload</button>
                            <button type="button" onclick="toggleVideoInput('url')" id="btn-url" class="flex-1 py-1 px-3 text-sm rounded-md text-gray-500 font-medium hover:text-gray-700 transition-all">URL Ext.</button>
                        </div>

                        <!-- Video File Input -->
                        <div id="video_file_input" class="transition-all">
                            <input type="file" name="video_file" accept="video/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                            <p class="mt-2 text-xs text-gray-400">Max size: 100MB. Format: MP4.</p>
                        </div>

                        <!-- Video URL Input -->
                        <div id="video_url_input" class="hidden transition-all">
                            <input type="url" name="video_url" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" placeholder="https://youtube.com/...">
                            <p class="mt-2 text-xs text-gray-400">Masukkan link YouTube atau direct URL video.</p>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<script>
    function toggleVideoInput(type) {
        const fileInput = document.getElementById('video_file_input');
        const urlInput = document.getElementById('video_url_input');
        const btnFile = document.getElementById('btn-file');
        const btnUrl = document.getElementById('btn-url');

        if (type === 'file') {
            fileInput.classList.remove('hidden');
            urlInput.classList.add('hidden');
            
            btnFile.classList.add('bg-white', 'shadow', 'text-blue-600');
            btnFile.classList.remove('text-gray-500');
            
            btnUrl.classList.remove('bg-white', 'shadow', 'text-blue-600');
            btnUrl.classList.add('text-gray-500');
            
            // Allow radio to select correct value logic if using radio buttons, but here we used buttons for UI
            // We need a hidden input to actually submit the type preference if backend needs it, 
            // but controller logic checks hasFile('video_file') first so it should be fine.
        } else {
            fileInput.classList.add('hidden');
            urlInput.classList.remove('hidden');

            btnUrl.classList.add('bg-white', 'shadow', 'text-blue-600');
            btnUrl.classList.remove('text-gray-500');
            
            btnFile.classList.remove('bg-white', 'shadow', 'text-blue-600');
            btnFile.classList.add('text-gray-500');
        }
    }

    function previewPhotos(input) {
        const previewContainer = document.getElementById('photos-preview');
        previewContainer.innerHTML = ''; // Clear current previews

        if (input.files) {
            Array.from(input.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative aspect-square rounded-lg overflow-hidden border border-gray-200 shadow-sm';
                    div.innerHTML = `<img src="${e.target.result}" class="w-full h-full object-cover">`;
                    previewContainer.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }
</script>
@endsection
