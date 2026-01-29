@extends('layouts.admin')

@section('title', 'Edit Program - Admin HASMI')
@section('page-title', 'Edit Program')
@section('page-subtitle', 'Update program yang sudah ada')

@section('content')

<div class="max-w-4xl">
    <form action="{{ route('admin.programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                        <option value="{{ $category->id }}" {{ old('program_category_id', $program->program_category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('program_category_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- SUB KATEGORI PROGRAM -->
            <div id="subcategory-wrapper" style="display: {{ count($subcategories) > 0 ? 'block' : 'none' }};">
                <label for="program_subcategory_id" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-folder-open text-blue-600 mr-1"></i> Sub Kategori Program
                </label>
                <select id="program_subcategory_id" name="program_subcategory_id"
                        class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('program_subcategory_id') border-red-500 @enderror">
                    <option value="">-- Pilih Sub Kategori --</option>
                    @foreach($subcategories as $sub)
                        <option value="{{ $sub->id }}" {{ old('program_subcategory_id', $program->program_subcategory_id) == $sub->id ? 'selected' : '' }}>
                            {{ $sub->name }}
                        </option>
                    @endforeach
                </select>
                @error('program_subcategory_id')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- JUDUL PROGRAM -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Program <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" name="title" value="{{ old('title', $program->title) }}" required
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
                          placeholder="Deskripsi singkat program (1-2 kalimat)...">{{ old('description', $program->description) }}</textarea>
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
                          placeholder="Isi konten program lengkap...">{{ old('content', $program->content) }}</textarea>
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
                        <input type="radio" name="media_type" value="image" {{ old('media_type', $program->media_type) == 'image' ? 'checked' : '' }} 
                               class="w-5 h-5 text-blue-600" onchange="toggleMediaType()">
                        <span class="ml-2 text-gray-700">
                            <i class="fas fa-image text-green-600 mr-1"></i> Gambar
                        </span>
                    </label>
                    <label class="flex items-center">
                        <input type="radio" name="media_type" value="video" {{ old('media_type', $program->media_type) == 'video' ? 'checked' : '' }} 
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

            <!-- THUMBNAIL SAAT INI -->
            @if($program->thumbnail)
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-image text-blue-600 mr-1"></i> Thumbnail Saat Ini
                </label>
                <div class="relative inline-block">
                    <img src="{{ $program->getThumbnailUrl() }}" alt="{{ $program->title }}" class="w-full max-w-md h-48 object-cover rounded-lg border border-gray-300">
                    <button type="button" onclick="document.getElementById('thumbnail').click()"
                            class="absolute bottom-2 right-2 bg-blue-600 hover:bg-blue-700 text-white px-3 py-1 rounded-lg text-sm font-semibold">
                        <i class="fas fa-edit mr-1"></i> Ganti
                    </button>
                </div>
            </div>
            @endif

            <!-- UPLOAD THUMBNAIL BARU -->
            <div>
                <label for="thumbnail" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-image text-blue-600 mr-1"></i>
                    @if($program->thumbnail)
                        Upload Thumbnail Baru (Opsional)
                    @else
                        Upload Thumbnail
                    @endif
                </label>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/jpg,image/webp"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('thumbnail') border-red-500 @enderror"
                       onchange="previewThumbnail(event)">
                <p class="text-gray-500 text-xs mt-1">
                    Format: JPG, PNG, WEBP. Maks 2MB. Rasio 16:9 direkomendasikan.
                </p>
                @error('thumbnail')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div id="thumbnail-preview" class="mt-4"></div>
            </div>

            <!-- GALERI FOTO SAAT INI (Only show if media_type is image) -->
            @if($program->isImage() && $program->hasPhotos())
            <div id="existing-photos">
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-images text-blue-600 mr-1"></i> Galeri Foto Saat Ini ({{ count($program->photos) }} foto)
                </label>
                <div class="grid grid-cols-4 gap-4">
                    @foreach($program->photos as $index => $photo)
                    <div class="relative group" id="photo-{{ $index }}">
                        <img src="{{ Storage::url($photo) }}" alt="Photo {{ $index + 1 }}" class="w-full h-32 object-cover rounded-lg border border-gray-300">
                        <button type="button"
                                onclick="deletePhoto('{{ $photo }}', {{ $index }})"
                                class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white w-8 h-8 rounded-full opacity-0 group-hover:opacity-100 transition-opacity">
                            <i class="fas fa-trash text-xs"></i>
                        </button>
                        <div class="absolute bottom-2 left-2 bg-gray-800 bg-opacity-75 text-white text-xs px-2 py-1 rounded">
                            #{{ $index + 1 }}
                        </div>
                    </div>
                    @endforeach
                </div>
                <p class="text-gray-500 text-xs mt-2">
                    <i class="fas fa-info-circle"></i> Hover pada foto dan klik tombol trash untuk menghapus.
                </p>
            </div>
            @endif

            <!-- UPLOAD GALERI FOTO BARU (Only for Image type) -->
            <div id="photos-section" style="display: {{ $program->isImage() ? 'block' : 'none' }};">
                <label for="photos" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-images text-blue-600 mr-1"></i>
                    @if($program->hasPhotos())
                        Tambah Foto Baru ke Galeri
                    @else
                        Upload Galeri Foto
                    @endif
                </label>
                <input type="file" id="photos" name="photos[]" accept="image/jpeg,image/png,image/jpg,image/webp" multiple
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('photos.*') border-red-500 @enderror"
                       onchange="previewPhotos(event)">
                <p class="text-gray-500 text-xs mt-1">
                    Upload beberapa foto sekaligus. Format: JPG, PNG, WEBP. Maks 2MB per foto.
                </p>
                @error('photos.*')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div id="photos-preview" class="mt-4 grid grid-cols-4 gap-4"></div>
            </div>

            <!-- VIDEO SECTION (Only for Video type) -->
            <div id="video-section" style="display: {{ $program->isVideo() ? 'block' : 'none' }};">
                <div class="border-t border-gray-200 pt-6">
                    <h3 class="text-lg font-semibold text-gray-800 mb-4">
                        <i class="fas fa-video text-blue-600 mr-2"></i>Video Program
                    </h3>

                    <!-- VIDEO SAAT INI -->
                    @if($program->video_url)
                    <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <div class="flex items-center justify-between">
                            <div>
                                <p class="text-sm font-semibold text-gray-700">Video Saat Ini:</p>
                                @if(filter_var($program->video_url, FILTER_VALIDATE_URL))
                                    <p class="text-xs text-gray-600 mt-1 break-all">
                                        <i class="fas fa-link text-blue-600 mr-1"></i> URL: {{ $program->video_url }}
                                    </p>
                                @else
                                    <p class="text-xs text-gray-600 mt-1">
                                        <i class="fas fa-file-video text-blue-600 mr-1"></i> File: {{ basename($program->video_url) }}
                                    </p>
                                @endif
                            </div>
                            <form action="{{ route('admin.programs.video.delete', $program->id) }}" method="POST"
                                  onsubmit="return confirm('Yakin ingin menghapus video ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-3 py-1 rounded-lg text-sm font-semibold">
                                    <i class="fas fa-trash mr-1"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </div>
                    @endif

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
                            <input type="url" id="video_url" name="video_url" value="{{ old('video_url', filter_var($program->video_url ?? '', FILTER_VALIDATE_URL) ? $program->video_url : '') }}"
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
                    <option value="top" {{ old('media_position', $program->media_position) == 'top' ? 'selected' : '' }}>Atas (Top)</option>
                    <option value="left" {{ old('media_position', $program->media_position) == 'left' ? 'selected' : '' }}>Kiri (Left)</option>
                    <option value="right" {{ old('media_position', $program->media_position) == 'right' ? 'selected' : '' }}>Kanan (Right)</option>
                    <option value="bottom" {{ old('media_position', $program->media_position) == 'bottom' ? 'selected' : '' }}>Bawah (Bottom)</option>
                </select>
                @error('media_position')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- URUTAN TAMPILAN -->
            <div>
                <label for="position" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-sort-numeric-down text-blue-600 mr-1"></i> Urutan Tampilan
                </label>
                <input type="number" id="position" name="position" value="{{ old('position', $program->position ?? 0) }}" min="0"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('position') border-red-500 @enderror">
                <p class="text-gray-500 text-xs mt-1">
                    Nomor urutan tampilan (semakin kecil akan ditampilkan lebih dulu).
                </p>
                @error('position')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- STATUS AKTIF -->
            <div class="border-t border-gray-200 pt-6">
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $program->is_active) ? 'checked' : '' }}
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
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all">
                    <i class="fas fa-save mr-2"></i> Update Program
                </button>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script>
    // Load subcategories based on selected category
    document.getElementById('program_category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const subcategoryWrapper = document.getElementById('subcategory-wrapper');
        const subcategorySelect = document.getElementById('program_subcategory_id');
        
        // Reset subcategory
        subcategorySelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';
        subcategoryWrapper.style.display = 'none';
        
        if (categoryId) {
            // Fetch subcategories via AJAX
            fetch(`/admin/programs/subcategories?category_id=${categoryId}`)
                .then(response => response.json())
                .then(data => {
                    if (data.length > 0) {
                        subcategoryWrapper.style.display = 'block';
                        data.forEach(sub => {
                            const option = document.createElement('option');
                            option.value = sub.id;
                            option.textContent = sub.name;
                            subcategorySelect.appendChild(option);
                        });
                    }
                });
        }
    });

    // Toggle media type sections
    function toggleMediaType() {
        const mediaType = document.querySelector('input[name="media_type"]:checked').value;
        const photosSection = document.getElementById('photos-section');
        const videoSection = document.getElementById('video-section');
        const existingPhotos = document.getElementById('existing-photos');
        
        if (mediaType === 'image') {
            photosSection.style.display = 'block';
            videoSection.style.display = 'none';
            if (existingPhotos) existingPhotos.style.display = 'block';
        } else {
            photosSection.style.display = 'none';
            videoSection.style.display = 'block';
            if (existingPhotos) existingPhotos.style.display = 'none';
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
                        <div class="absolute top-2 right-2 bg-green-600 text-white text-xs px-2 py-1 rounded font-semibold">BARU</div>
                        <div class="absolute bottom-2 left-2 bg-gray-800 bg-opacity-75 text-white text-xs px-2 py-1 rounded">#${index + 1}</div>
                    `;
                    previewContainer.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }

    function deletePhoto(photoPath, index) {
        if (!confirm('Yakin ingin menghapus foto ini?')) {
            return;
        }

        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        fetch('{{ route("admin.programs.photo.delete", $program->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': csrfToken
            },
            body: JSON.stringify({
                photo: photoPath
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Foto berhasil dihapus!');
                location.reload();
            } else {
                alert('Gagal menghapus foto: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menghapus foto.');
        });
    }
</script>
@endsection