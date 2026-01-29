@extends('layouts.admin')

@section('title', 'Tambah Program - Admin HASMI')
@section('page-title', 'Tambah Program Baru')
@section('page-subtitle', 'Buat program baru')

@section('content')

<div class="max-w-4xl">
    <form action="{{ route('admin.programs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-lg shadow-lg p-8 space-y-6">
            
            <!-- KATEGORI PROGRAM -->
            <div>
                <label for="program_category_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-folder text-blue-600 mr-1"></i> Kategori Program <span class="text-red-500">*</span>
                </label>
                <select id="program_category_id" name="program_category_id" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('program_category_id') border-red-500 @enderror">
                    <option value="">-- Pilih Kategori --</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('program_category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('program_category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SUB KATEGORI PROGRAM (Conditional) -->
            <div id="subcategory-wrapper" class="hidden">
                <label for="program_subcategory_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-folder-open text-blue-600 mr-1"></i> Sub Kategori Program <span id="subcategory-required" class="text-red-500"></span>
                </label>
                <select id="program_subcategory_id" name="program_subcategory_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('program_subcategory_id') border-red-500 @enderror">
                    <option value="">-- Pilih Sub Kategori --</option>
                </select>
                <p class="text-gray-500 text-xs mt-1">
                    <i class="fas fa-info-circle"></i> Pilih sub kategori program (mirip seperti filter di Materi)
                </p>
                @error('program_subcategory_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- JUDUL PROGRAM -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Program <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" name="title" value="{{ old('title') }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror"
                       placeholder="Contoh: Bantuan Pangan untuk Dhuafa">
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi Singkat <span class="text-red-500">*</span>
                </label>
                <textarea id="description" name="description" rows="3" required
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('description') border-red-500 @enderror"
                          placeholder="Deskripsi singkat program (1-2 kalimat)...">{{ old('description') }}</textarea>
                @error('description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KONTEN LENGKAP -->
            <div>
                <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                    Konten Lengkap
                </label>
                <textarea id="content" name="content" rows="10"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror"
                          placeholder="Isi konten program lengkap...">{{ old('content') }}</textarea>
                @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- TIPE MEDIA -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Tipe Media <span class="text-red-500">*</span>
                </label>
                <div class="flex gap-4">
                    <label class="flex items-center">
                        <input type="radio" name="media_type" value="image" {{ old('media_type', 'image') == 'image' ? 'checked' : '' }} 
                               class="w-5 h-5 text-blue-600" onchange="toggleMediaType()">
                        <span class="ml-2 text-gray-700">
                            <i class="fas fa-image text-green-600 mr-1"></i> Gambar
                        </span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="media_type" value="video" {{ old('media_type') == 'video' ? 'checked' : '' }} 
                               class="w-5 h-5 text-blue-600" onchange="toggleMediaType()">
                        <span class="ml-2 text-gray-700">
                            <i class="fas fa-video text-red-600 mr-1"></i> Video
                        </span>
                    </label>
                </div>
                @error('media_type')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- THUMBNAIL -->
            <div>
                <label for="thumbnail" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-image text-blue-600 mr-1"></i> Thumbnail
                </label>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/jpg,image/webp"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('thumbnail') border-red-500 @enderror"
                       onchange="previewThumbnail(event)">
                <p class="text-gray-500 text-xs mt-1">
                    Format: JPG, PNG, WEBP. Maks 2MB. Rasio 16:9 (landscape) direkomendasikan.
                </p>
                @error('thumbnail')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div id="thumbnail-preview" class="mt-4"></div>
            </div>

            <!-- GALERI FOTO (Only for Image type) -->
            <div id="photos-section">
                <label for="photos" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-images text-blue-600 mr-1"></i> Galeri Foto
                </label>
                <input type="file" id="photos" name="photos[]" accept="image/jpeg,image/png,image/jpg,image/webp" multiple
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('photos.*') border-red-500 @enderror"
                       onchange="previewPhotos(event)">
                <p class="text-gray-500 text-xs mt-1">
                    Upload beberapa foto sekaligus untuk galeri. Format: JPG, PNG, WEBP. Maks 2MB per foto.
                </p>
                @error('photos.*')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div id="photos-preview" class="mt-4 grid grid-cols-4 gap-4"></div>
            </div>

            <!-- VIDEO SECTION (Only for Video type) -->
            <div id="video-section" style="display: none;">
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-video text-blue-600 mr-2"></i>Video Program
                    </h3>

                    <div class="space-y-4">
                        <!-- Upload Video File -->
                        <div>
                            <label for="video_file" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-upload text-blue-600 mr-1"></i> Upload Video File
                            </label>
                            <input type="file" id="video_file" name="video_file" accept="video/mp4,video/mov,video/avi,video/wmv,video/webm"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('video_file') border-red-500 @enderror">
                            <p class="text-gray-500 text-xs mt-1">
                                Format: MP4, MOV, AVI, WMV, WebM. Maksimal 100MB.
                            </p>
                            @error('video_file')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="text-center text-gray-500 font-semibold">ATAU</div>

                        <!-- Video URL -->
                        <div>
                            <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-2">
                                <i class="fas fa-link text-blue-600 mr-1"></i> URL Video (YouTube, Vimeo, dll)
                            </label>
                            <input type="url" id="video_url" name="video_url" value="{{ old('video_url') }}"
                                   class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('video_url') border-red-500 @enderror"
                                   placeholder="https://www.youtube.com/watch?v=...">
                            <p class="text-gray-500 text-xs mt-1">
                                Atau paste link video dari YouTube, Vimeo, atau platform lainnya.
                            </p>
                            @error('video_url')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

            <!-- POSISI MEDIA -->
            <div>
                <label for="media_position" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-arrows-alt text-blue-600 mr-1"></i> Posisi Media <span class="text-red-500">*</span>
                </label>
                <select id="media_position" name="media_position" required
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('media_position') border-red-500 @enderror">
                    <option value="top" {{ old('media_position', 'top') == 'top' ? 'selected' : '' }}>Atas (Top)</option>
                    <option value="left" {{ old('media_position') == 'left' ? 'selected' : '' }}>Kiri (Left)</option>
                    <option value="right" {{ old('media_position') == 'right' ? 'selected' : '' }}>Kanan (Right)</option>
                    <option value="bottom" {{ old('media_position') == 'bottom' ? 'selected' : '' }}>Bawah (Bottom)</option>
                </select>
                <p class="text-gray-500 text-xs mt-1">
                    <i class="fas fa-info-circle"></i> Posisi media (gambar/video) pada halaman detail program
                </p>
                @error('media_position')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- URUTAN TAMPILAN - REMOVED, AUTO GENERATE -->
            <!-- This field has been removed. Urutan tampilan will be auto-generated based on the order items are created -->

            <!-- STATUS AKTIF -->
            <div class="border-t border-gray-200 pt-6">
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', true) ? 'checked' : '' }}
                           class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                    <label for="is_active" class="text-gray-700 font-medium">
                        <i class="fas fa-toggle-on text-green-600 mr-1"></i> Program Aktif
                    </label>
                </div>
                <p class="text-gray-500 text-xs mt-2 ml-8">
                    Centang untuk mengaktifkan program dan menampilkannya di website
                </p>
            </div>

            <!-- TOMBOL AKSI -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.programs.index') }}" class="text-gray-600 hover:text-gray-800 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <div class="flex gap-3">
                    <button type="reset" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-3 rounded-lg font-semibold transition-all">
                        <i class="fas fa-redo mr-2"></i> Reset
                    </button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all">
                        <i class="fas fa-save mr-2"></i> Simpan Program
                    </button>
                </div>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
    // Get all categories data from backend
    const categoriesData = {!! json_encode($categories->mapWithKeys(function($cat) { return [$cat->id => ['has_subcategories' => $cat->has_subcategories]]; })) !!};
    
    // Load subcategories based on selected category
    document.getElementById('program_category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const subcategoryWrapper = document.getElementById('subcategory-wrapper');
        const subcategorySelect = document.getElementById('program_subcategory_id');
        const subcategoryRequired = document.getElementById('subcategory-required');
        
        // Reset subcategory
        subcategorySelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';
        subcategorySelect.removeAttribute('required');
        subcategoryRequired.textContent = '';
        
        if (!categoryId) {
            subcategoryWrapper.classList.add('hidden');
            return;
        }
        
        const categoryInfo = categoriesData[categoryId];
        const hasSubcategories = categoryInfo && categoryInfo.has_subcategories;
        
        // Fetch subcategories via AJAX
        fetch(`/admin/programs/subcategories?category_id=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                subcategorySelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';
                
                if (data.length > 0) {
                    // Set required if this category has subcategories
                    if (hasSubcategories) {
                        subcategorySelect.setAttribute('required', 'required');
                        subcategoryRequired.textContent = '*';
                    }
                    
                    data.forEach(sub => {
                        const option = document.createElement('option');
                        option.value = sub.id;
                        option.textContent = sub.name;
                        subcategorySelect.appendChild(option);
                    });
                    subcategoryWrapper.classList.remove('hidden');
                } else {
                    subcategoryWrapper.classList.add('hidden');
                }
            })
            .catch(error => {
                console.error('Error loading subcategories:', error);
                subcategoryWrapper.classList.add('hidden');
            });
    });

    // Toggle media type sections
    function toggleMediaType() {
        const mediaType = document.querySelector('input[name="media_type"]:checked').value;
        const photosSection = document.getElementById('photos-section');
        const videoSection = document.getElementById('video-section');
        
        if (mediaType === 'image') {
            photosSection.style.display = 'block';
            videoSection.style.display = 'none';
        } else {
            photosSection.style.display = 'none';
            videoSection.style.display = 'block';
        }
    }

    // Initialize on page load
    toggleMediaType();

    function previewThumbnail(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('thumbnail-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Thumbnail Preview" class="w-full max-w-md h-48 object-cover rounded-lg border border-gray-300">
                `;
            }
            reader.readAsDataURL(file);
        } else {
            preview.innerHTML = '';
        }
    }

    function previewPhotos(event) {
        const files = event.target.files;
        const previewContainer = document.getElementById('photos-preview');
        previewContainer.innerHTML = '';

        if (files.length > 0) {
            Array.from(files).forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.className = 'relative';
                    div.innerHTML = `
                        <img src="${e.target.result}" alt="Preview ${index + 1}" class="w-full h-32 object-cover rounded-lg border border-gray-300">
                        <div class="absolute bottom-2 right-2 bg-gray-800 bg-opacity-75 text-white text-xs px-2 py-1 rounded">#${index + 1}</div>
                    `;
                    previewContainer.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }
</script>
@endsection