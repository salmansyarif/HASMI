@extends('layouts.admin')

@section('title', 'Edit Program - Admin HASMI')
@section('page-title', 'Edit Program')
@section('page-subtitle', 'Update program yang sudah ada')

@section('content')
<div class="container mx-auto">
    <div class="mb-6">
        <a href="{{ route('admin.programs.index') }}" class="text-gray-500 hover:text-gray-700 flex items-center gap-2 transition-colors">
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

    <form action="{{ route('admin.programs.update', $program->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Left Column: Main Content (2/3) -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- General Info Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Informasi Program</h3>
                    
                    <!-- Judul -->
                    <div class="mb-5">
                        <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">Judul Program <span class="text-red-500">*</span></label>
                        <input type="text" name="title" id="title" 
                               class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white" 
                               placeholder="Contoh: Bantuan Pangan untuk Dhuafa"
                               value="{{ old('title', $program->title) }}" required>
                    </div>

                    <!-- Category & Sub Category Row -->
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5 mb-5">
                        <!-- Category -->
                        <div>
                            <label for="program_category_id" class="block text-sm font-semibold text-gray-700 mb-2">Kategori <span class="text-red-500">*</span></label>
                            <select id="program_category_id" name="program_category_id" required
                                    class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white">
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('program_category_id', $program->program_category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <!-- Sub Category -->
                        <div id="subcategory-wrapper" class="{{ $program->Category->has_subcategories ? '' : 'hidden' }}">
                            <label for="program_subcategory_id" class="block text-sm font-semibold text-gray-700 mb-2">Sub Kategori <span id="subcategory-required" class="text-red-500"></span></label>
                            <select id="program_subcategory_id" name="program_subcategory_id"
                                    class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white"
                                    {{ $program->Category->has_subcategories ? 'required' : '' }}>
                                <option value="">-- Pilih Sub Kategori --</option>
                                @foreach($subcategories as $sub)
                                    <option value="{{ $sub->id }}" {{ old('program_subcategory_id', $program->program_subcategory_id) == $sub->id ? 'selected' : '' }}>
                                        {{ $sub->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <!-- Description -->
                    <div class="mb-5">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat (Opsional)</label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white"
                                  placeholder="Deskripsi singkat program...">{{ old('description', $program->description) }}</textarea>
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Konten Lengkap</label>
                        <textarea name="content" id="content" rows="15"
                                  class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all font-sans text-lg leading-relaxed p-4 bg-gray-50 focus:bg-white"
                                  placeholder="Isi konten program lengkap...">{{ old('content', $program->content) }}</textarea>
                    </div>
                </div>

                <!-- Media Content Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Konten Media</h3>

                    <!-- Image Section (Gallery) -->
                    <div id="photos-section">
                        <!-- Existing Photos -->
                        @if($program->isImage() && $program->hasPhotos())
                        <div class="mb-6">
                            <label class="block text-sm text-gray-500 mb-2">Galeri Foto Saat Ini</label>
                            <div class="grid grid-cols-4 gap-4">
                                @foreach($program->photos as $index => $photo)
                                <div class="relative group aspect-square rounded-lg overflow-hidden border border-gray-200">
                                    <img src="{{ Storage::url($photo) }}" alt="Photo {{ $index + 1 }}" class="w-full h-full object-cover">
                                    <button type="button"
                                            onclick="deletePhoto('{{ $photo }}')"
                                            class="absolute top-2 right-2 bg-red-600 hover:bg-red-700 text-white w-8 h-8 rounded-full opacity-0 group-hover:opacity-100 transition-opacity flex items-center justify-center shadow-sm">
                                        <i class="fas fa-trash text-xs"></i>
                                    </button>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif

                        <div class="mb-4">
                            <label class="block text-sm text-gray-500 mb-2">
                                {{ $program->hasPhotos() ? 'Tambah Foto Baru' : 'Upload Galeri Foto' }}
                            </label>
                            <input type="file" name="photos[]" id="photos" accept="image/jpeg,image/png,image/jpg,image/webp" multiple
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all"
                                   onchange="previewPhotos(event)">
                            <p class="mt-2 text-xs text-gray-400">Bisa pilih lebih dari satu foto. Format: JPG, PNG, WEBP. Maks 2MB.</p>
                        </div>
                        <div id="photos-preview" class="grid grid-cols-4 gap-4 mt-4"></div>
                    </div>

                    <!-- Video Section -->
                    <div id="video-section" style="display: none;">
                        <div class="space-y-4">
                            @if($program->isVideo() && $program->video_url)
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200 flex items-center justify-between">
                                <div>
                                    <span class="text-xs font-bold text-gray-500 uppercase tracking-widest">Video Saat Ini</span>
                                    @if(filter_var($program->video_url, FILTER_VALIDATE_URL))
                                        <div class="flex items-center gap-2 mt-1">
                                            <i class="fab fa-youtube text-red-600"></i>
                                            <a href="{{ $program->video_url }}" target="_blank" class="text-sm text-blue-600 hover:underline truncate max-w-xs">{{ $program->video_url }}</a>
                                        </div>
                                    @else
                                        <div class="flex items-center gap-2 mt-1">
                                            <i class="fas fa-file-video text-blue-600"></i>
                                            <span class="text-sm text-gray-700 truncate max-w-xs">{{ basename($program->video_url) }}</span>
                                        </div>
                                    @endif
                                </div>
                                <button type="button" onclick="if(confirm('Hapus video saat ini?')) document.getElementById('form-delete-video').submit();" 
                                        class="text-red-600 hover:text-red-800 text-sm font-semibold">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </div>
                            @endif

                            <!-- File -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">Upload Video File</label>
                                <input type="file" name="video_file" accept="video/mp4,video/mov,video/avi,video/wmv,video/webm"
                                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                                <p class="mt-1 text-xs text-gray-400">Format: MP4, MOV, AVI. Maks 100MB.</p>
                            </div>
                            
                            <div class="text-center text-xs font-bold text-gray-400">- ATAU -</div>

                            <!-- URL -->
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-2">URL Video (YouTube, dll)</label>
                                <input type="url" name="video_url" class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white" 
                                       placeholder="https://youtube.com/..." 
                                       value="{{ old('video_url', filter_var($program->video_url ?? '', FILTER_VALIDATE_URL) ? $program->video_url : '') }}">
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Right Column: Sidebar (1/3) -->
            <div class="space-y-6">
                
                <!-- Status & Action Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6 sticky top-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Status Publikasi</h3>
                    
                    <div class="mb-4">
                        <label class="flex items-center cursor-pointer">
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $program->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 peer-checked:text-blue-600">Program Aktif</span>
                        </label>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Update Program
                        </button>
                        <a href="{{ route('admin.programs.index') }}" class="w-full bg-gray-100 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </div>

                <!-- Media Settings Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Pengaturan Media</h3>
                    
                    <!-- Media Type -->
                    <div class="mb-5">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Tipe Media</label>
                        <div class="flex flex-col gap-2">
                            <label class="inline-flex items-center">
                                <input type="radio" name="media_type" value="image" {{ old('media_type', $program->media_type) == 'image' ? 'checked' : '' }} 
                                       class="form-radio text-blue-600" onchange="toggleMediaType()">
                                <span class="ml-2">Gambar (Galeri)</span>
                            </label>
                            <label class="inline-flex items-center">
                                <input type="radio" name="media_type" value="video" {{ old('media_type', $program->media_type) == 'video' ? 'checked' : '' }} 
                                       class="form-radio text-blue-600" onchange="toggleMediaType()">
                                <span class="ml-2">Video</span>
                            </label>
                        </div>
                    </div>

                    <!-- Media Position -->
                    <div>
                        <label for="media_position" class="block text-sm font-semibold text-gray-700 mb-2">Posisi Media</label>
                        <select id="media_position" name="media_position" required
                                class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white">
                            <option value="top" {{ old('media_position', $program->media_position) == 'top' ? 'selected' : '' }}>Atas (Top)</option>
                            <option value="left" {{ old('media_position', $program->media_position) == 'left' ? 'selected' : '' }}>Kiri (Left)</option>
                            <option value="right" {{ old('media_position', $program->media_position) == 'right' ? 'selected' : '' }}>Kanan (Right)</option>
                            <option value="bottom" {{ old('media_position', $program->media_position) == 'bottom' ? 'selected' : '' }}>Bawah (Bottom)</option>
                        </select>
                    </div>
                </div>

                <!-- Thumbnail Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thumbnail</h3>
                    
                    @if($program->thumbnail)
                    <div class="mb-4">
                        <p class="text-xs text-gray-500 mb-2">Thumbnail Saat Ini:</p>
                        <div class="relative group rounded-lg overflow-hidden border border-gray-200">
                            <img src="{{ $program->getThumbnailUrl() }}" alt="Current thumbnail" class="w-full h-auto object-cover">
                        </div>
                    </div>
                    @endif

                    <div class="mb-4">
                        <label class="block text-sm text-gray-500 mb-2">
                            {{ $program->thumbnail ? 'Ganti Thumbnail' : 'Upload Thumbnail' }}
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

<!-- Hidden Form for Video Deletion -->
<form id="form-delete-video" action="{{ route('admin.programs.video.delete', $program->id) }}" method="POST" class="hidden">
    @csrf
    @method('DELETE')
</form>

<script data-cfasync="false">
    // Categories Data
    const categoriesData = {!! json_encode($categories->mapWithKeys(function($cat) { return [$cat->id => ['has_subcategories' => $cat->has_subcategories]]; })) !!};
    
    // Subcategories Logic
    document.getElementById('program_category_id').addEventListener('change', function() {
        const categoryId = this.value;
        const subcategoryWrapper = document.getElementById('subcategory-wrapper');
        const subcategorySelect = document.getElementById('program_subcategory_id');
        const subcategoryRequired = document.getElementById('subcategory-required');
        
        subcategorySelect.innerHTML = '<option value="">-- Pilih Sub Kategori --</option>';
        subcategorySelect.removeAttribute('required');
        subcategoryRequired.textContent = '';
        
        if (!categoryId) {
            subcategoryWrapper.classList.add('hidden');
            return;
        }
        
        const categoryInfo = categoriesData[categoryId];
        const hasSubcategories = categoryInfo && categoryInfo.has_subcategories;
        
        // Fetch subcategories via AJAX (Optimized: only fetch if category has subcategories or always fetch?)
        // Better to fetch always if dynamic, or rely on precached data if small.
        // For now, fetch is fine.
        fetch(`/admin/programs/subcategories?category_id=${categoryId}`)
            .then(response => response.json())
            .then(data => {
                if (data.length > 0) {
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

    // Toggle Media Type
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

    // Initialize
    toggleMediaType();

    // Previews
    function previewThumbnail(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('thumbnail-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `<img src="${e.target.result}" class="w-full rounded-lg border border-gray-200 shadow-sm">`;
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

    function deletePhoto(photoPath) {
        if (!confirm('Yakin ingin menghapus foto ini?')) return;

        fetch('{{ route("admin.programs.photo.delete", $program->id) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ photo: photoPath })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Gagal menghapus foto: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan network.');
        });
    }
</script>
@endsection