@extends('layouts.admin')

@section('title', 'Tambah Artikel - Admin HASMI')
@section('page-title', 'Tambah Artikel Baru')
@section('page-subtitle', 'Buat artikel baru untuk website HASMI')

@section('content')

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.articles.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-2 transition-colors">
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

    <form action="{{ route('admin.articles.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Main Content (2/3) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- General Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Artikel</h3>
                    
                    <!-- Judul -->
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Artikel <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" 
                               class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg" 
                               placeholder="Masukkan judul artikel..."
                               value="{{ old('title') }}" required>
                    </div>

                    <!-- Category & Sub Category Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <!-- Category -->
                        <div>
                            <label for="category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                            <select id="category_id" name="category_id" required
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all">
                                <option value="">Pilih Kategori</option>
                                @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sub Category -->
                        <div id="sub-category-container" class="hidden">
                            <label for="sub_category_id" class="block text-sm font-semibold text-gray-700 mb-2">Sub Kategori</label>
                            <select id="sub_category_id" name="sub_category_id"
                                    class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all">
                                <option value="">Pilih Sub Kategori (Opsional)</option>
                            </select>
                        </div>
                    </div>

                    <!-- Excerpt -->
                    <div class="mb-5">
                        <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi Singkat (Excerpt)
                            <span class="text-xs font-normal text-gray-500 ml-1">- Opsional, otomatis dari konten jika kosong</span>
                        </label>
                        <textarea name="excerpt" id="excerpt" rows="3" maxlength="500"
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all"
                                  placeholder="Ringkasan singkat artikel...">{{ old('excerpt') }}</textarea>
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Konten Artikel <span class="text-red-500">*</span></label>
                        <textarea name="content" id="content" rows="20" required
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all font-sans text-base leading-relaxed p-4"
                                  placeholder="Tulis konten artikel di sini...">{{ old('content') }}</textarea>
                    </div>
                </div>

            </div>

            <!-- Right Column: Sidebar (1/3) -->
            <div class="space-y-6">
                
                <!-- Status & Action Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Status Publikasi</h3>
                    
                    <div class="mb-6">
                        <label for="status" class="block text-sm font-medium text-gray-700 mb-2">Status</label>
                        <select id="status" name="status" required
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all">
                            <option value="draft" {{ old('status') == 'draft' ? 'selected' : '' }}>Draft (Belum Dipublikasi)</option>
                            <option value="published" {{ old('status') == 'published' ? 'selected' : '' }}>Published (Langsung Tayang)</option>
                        </select>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Simpan Artikel
                        </button>
                        <button type="reset" class="w-full bg-gray-100 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-redo"></i> Reset Form
                        </button>
                    </div>
                </div>

                <!-- Media Settings Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 mb-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Pengaturan Media</h3>
                    
                    <!-- Media Type -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Media</label>
                        <div class="flex flex-col gap-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="media_type" value="image" {{ old('media_type', 'image') == 'image' ? 'checked' : '' }} 
                                       class="form-radio text-blue-600" onchange="toggleMediaType()">
                                <span class="ml-2">Gambar (Galeri)</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="media_type" value="video" {{ old('media_type') == 'video' ? 'checked' : '' }} 
                                       class="form-radio text-blue-600" onchange="toggleMediaType()">
                                <span class="ml-2">Video</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="media_type" value="none" {{ old('media_type') == 'none' ? 'checked' : '' }} 
                                       class="form-radio text-blue-600" onchange="toggleMediaType()">
                                <span class="ml-2">Tanpa Media</span>
                            </label>
                        </div>
                    </div>

                    <!-- Photos Section -->
                    <div id="photos-section">
                        <div class="space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Foto Galeri</label>
                                <input type="file" name="photos[]" multiple accept="image/jpeg,image/png,image/jpg,image/webp"
                                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all"
                                       onchange="previewPhotos(event)">
                                <p class="mt-1 text-xs text-gray-400">Bisa pilih banyak foto sekaligus. Format: JPG, PNG, WEBP.</p>
                            </div>
                            <!-- Preview Photos -->
                            <div id="photos-preview" class="grid grid-cols-3 gap-2 mt-2"></div>
                        </div>
                    </div>

                    <!-- Video Section -->
                    <div id="video-section" style="display: none;">
                        <div class="space-y-4">
                            <!-- URL -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">URL Video (YouTube, dll)</label>
                                <input type="url" name="video_url" class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white"  
                                       placeholder="https://youtube.com/..."></input>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Thumbnail Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thumbnail</h3>
                    
                    <div class="mb-4">
                        <label class="block text-sm text-gray-500 mb-2">Foto Thumbnail</label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/jpeg,image/png,image/jpg,image/webp"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all"
                               onchange="previewImage(event)">
                        <p class="mt-2 text-xs text-gray-400">Format: JPG, PNG, WEBP. Maks 2MB.</p>
                    </div>

                    <!-- Preview -->
                    <div id="preview-container" class="mt-4 hidden">
                        <p class="text-sm font-semibold text-gray-700 mb-2">Preview:</p>
                        <img id="preview-image" src="" alt="Preview" class="w-full rounded-lg border border-gray-200 shadow-sm">
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script data-cfasync="false">
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

    // Toggle Media Type
    function toggleMediaType() {
        const mediaType = document.querySelector('input[name="media_type"]:checked').value;
        const photosSection = document.getElementById('photos-section');
        const videoSection = document.getElementById('video-section');
        const thumbnailCard = document.querySelector('input[name="thumbnail"]').closest('.bg-white');

        if (mediaType === 'image') {
            photosSection.style.display = 'block';
            videoSection.style.display = 'none';
            if(thumbnailCard) thumbnailCard.style.display = 'block';
        } else if (mediaType === 'video') {
            photosSection.style.display = 'none';
            videoSection.style.display = 'block';
            if(thumbnailCard) thumbnailCard.style.display = 'block';
        } else {
            photosSection.style.display = 'none';
            videoSection.style.display = 'none';
            if(thumbnailCard) thumbnailCard.style.display = 'none';
        }
    }

    // Initialize
    toggleMediaType();

    function previewPhotos(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('photos-preview');
        previewContainer.innerHTML = '';

        if (files) {
            Array.from(files).forEach(file => {
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