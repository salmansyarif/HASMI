@extends('layouts.admin')

@section('title', 'Edit Kegiatan')
@section('page-title', 'Edit Kegiatan')
@section('page-subtitle', 'Update kegiatan')

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

    <form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="existing_photos" value="{{ json_encode($kegiatan->photos) }}">
        
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
                               value="{{ old('title', $kegiatan->title) }}" required>
                    </div>

                    <!-- Description -->
                    <div class="mb-5">
                        <label for="description" class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi Singkat (Opsional)</label>
                        <textarea name="description" id="description" rows="3"
                                  class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white"
                                  placeholder="Deskripsi singkat kegiatan...">{{ old('description', $kegiatan->description) }}</textarea>
                    </div>

                    <!-- Content -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Konten Lengkap</label>
                        <textarea name="content" id="content" rows="15"
                                  class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all font-sans text-lg leading-relaxed p-4 bg-gray-50 focus:bg-white"
                                  placeholder="Tulis konten lengkap kegiatan di sini...">{{ old('content', $kegiatan->content) }}</textarea>
                    </div>
                </div>

                <!-- Media Content Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Media Kegiatan</h3>

                    <!-- Thumbnail Section -->
                    <div class="mb-8 p-4 bg-blue-50/50 rounded-xl border border-blue-100">
                        <label class="block text-sm font-bold text-blue-900 mb-2">Thumbnail (Card List)</label>
                        <input type="file" name="thumbnail" accept="image/*"
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-600 file:text-white hover:file:bg-blue-700 transition-all"
                               onchange="previewThumbnail(event)">
                        <p class="mt-2 text-xs text-blue-600 font-medium italic">Thumbnail ini hanya muncul di daftar/grid kegiatan.</p>
                        
                        <div id="thumbnail-preview" class="mt-3 {{ $kegiatan->thumbnail ? '' : 'hidden' }}">
                            <img src="{{ $kegiatan->thumbnail ? asset($kegiatan->thumbnail) : '' }}" class="w-32 h-32 object-cover rounded-lg shadow-md border-2 border-white">
                        </div>
                    </div>

                    <!-- Video Section -->
                    @php
                        $isExternal = $kegiatan->video_url && Str::startsWith($kegiatan->video_url, 'http');
                        $isLocal = $kegiatan->video_url && !Str::startsWith($kegiatan->video_url, 'http');
                        $initialSource = $isLocal ? 'file' : 'url';
                    @endphp
                    <div class="mb-8" x-data="{ videoSource: '{{ $initialSource }}' }">
                        <label class="block text-sm font-semibold text-gray-700 mb-3">Konten Video (Opsional)</label>
                        
                        <div class="flex gap-4 mb-4">
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" value="url" x-model="videoSource" class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="text-sm font-medium text-gray-600 group-hover:text-blue-600">URL Link</span>
                            </label>
                            <label class="flex items-center gap-2 cursor-pointer group">
                                <input type="radio" value="file" x-model="videoSource" class="w-4 h-4 text-blue-600 focus:ring-blue-500 border-gray-300">
                                <span class="text-sm font-medium text-gray-600 group-hover:text-blue-600">Upload File</span>
                            </label>
                        </div>

                        <div x-show="videoSource === 'url'" x-transition>
                            <input type="url" name="video_url" id="video_url" 
                                   class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 bg-gray-50 focus:bg-white" 
                                   placeholder="https://www.youtube.com/watch?v=..."
                                   value="{{ old('video_url', $isExternal ? $kegiatan->video_url : '') }}">
                            <p class="mt-1 text-xs text-gray-400 italic font-medium">Link YouTube atau link video eksternal.</p>
                        </div>

                        <div x-show="videoSource === 'file'" x-transition>
                            <input type="file" name="video_file" id="video_file" accept="video/mp4,video/x-m4v,video/*"
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-100 file:text-gray-700 hover:file:bg-gray-200 transition-all">
                            <p class="mt-1 text-xs text-gray-400 italic font-medium">Maksimal 50MB. Format: MP4, MOV, AVI.</p>
                            @if($isLocal)
                                <div class="mt-3 p-3 bg-gray-50 rounded-lg border flex items-center gap-3">
                                    <i class="fas fa-file-video text-blue-500 text-xl"></i>
                                    <div class="flex-1">
                                        <p class="text-xs font-bold text-gray-700">Video Terupload:</p>
                                        <p class="text-[10px] text-gray-500 truncate">{{ $kegiatan->video_url }}</p>
                                    </div>
                                    <a href="{{ asset($kegiatan->video_url) }}" target="_blank" class="text-[10px] bg-blue-100 text-blue-600 px-2 py-1 rounded font-bold hover:bg-blue-200">Lihat</a>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="border-t pt-5">
                        <h4 class="text-sm font-bold text-gray-700 mb-4">Galeri Foto (Dokumentasi Detail)</h4>
                        <!-- Current Photos -->
                        <div class="mb-6">
                            @if($kegiatan->photos && count($kegiatan->photos) > 0)
                                <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="photo-gallery">
                                    @foreach($kegiatan->photos as $index => $photo)
                                    <div class="relative group rounded-xl overflow-hidden border-2 border-gray-200 shadow-sm transition-all hover:border-red-400">
                                        <div class="aspect-square w-full relative">
                                            <img src="{{ asset($photo) }}" class="w-full h-full object-cover">
                                        </div>

                                        {{-- Control Bar --}}
                                        <div class="bg-white p-2 border-t flex items-center justify-center">
                                            <button type="button" onclick="deletePhoto('{{ $photo }}')" 
                                                    class="w-full py-1 flex items-center justify-center bg-red-50 text-red-500 hover:bg-red-500 hover:text-white rounded transition-all" 
                                                    title="Hapus Foto">
                                                <i class="fas fa-trash-alt text-xs mr-2"></i> <span class="text-xs font-bold">Hapus</span>
                                            </button>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="bg-gray-50 border-2 border-dashed border-gray-300 rounded-xl p-8 text-center text-gray-500">
                                    <i class="far fa-images text-2xl mb-2"></i>
                                    <p>Belum ada foto yang diupload.</p>
                                </div>
                            @endif
                        </div>

                        <!-- Add New Photos -->
                        <div id="photos-section">
                            <div class="mb-4">
                                <label class="block text-sm text-gray-500 mb-2">Tambah Foto Baru</label>
                                <input type="file" name="photos[]" id="photos" accept="image/jpeg,image/png,image/jpg,image/webp" multiple
                                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-gray-600 file:text-white hover:file:bg-gray-700 transition-all"
                                       onchange="previewPhotos(event)">
                                <p class="mt-2 text-xs text-gray-400">
                                    Format: JPG, PNG, WEBP. Maks 2MB.
                                </p>
                            </div>
                            <div id="photos-preview" class="grid grid-cols-4 gap-4 mt-4"></div>
                        </div>
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
                            <option value="draft" {{ old('status', $kegiatan->status) == 'draft' ? 'selected' : '' }}>Draft (Belum Dipublikasi)</option>
                            <option value="published" {{ old('status', $kegiatan->status) == 'published' ? 'selected' : '' }}>Published (Langsung Tayang)</option>
                        </select>
                    </div>

                    <div class="mb-5">
                        <label class="flex items-center space-x-3 cursor-pointer p-3 border rounded-lg hover:bg-gray-50 transition-colors">
                            <input type="checkbox" name="show_thumbnail_in_list" value="1" 
                                   class="w-5 h-5 text-blue-600 rounded border-gray-300 focus:ring-blue-500" 
                                   {{ old('show_thumbnail_in_list', $kegiatan->show_thumbnail_in_list) ? 'checked' : '' }}>
                            <span class="text-sm font-medium text-gray-700">Tampilkan thumbnail di daftar</span>
                        </label>
                    </div>

                    <div class="flex flex-col gap-3">
                        <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-save"></i> Update Kegiatan
                        </button>
                        <a href="{{ route('admin.kegiatan.index') }}" class="w-full bg-gray-100 text-gray-700 font-semibold py-3 px-4 rounded-lg hover:bg-gray-200 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-times"></i> Batal
                        </a>
                    </div>
                </div>

                <!-- Display Settings Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Pengaturan Tampilan</h3>
                    
                    <!-- Photo Position -->
                    <div>
                        <label for="photo_position" class="block text-sm font-semibold text-gray-700 mb-2">Posisi Media Utama <span class="text-red-500">*</span></label>
                        <select id="photo_position" name="photo_position" required
                                class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white">
                            <option value="top" {{ old('photo_position', $kegiatan->photo_position) == 'top' ? 'selected' : '' }}>Atas (Setelah Judul)</option>
                            <option value="middle" {{ old('photo_position', $kegiatan->photo_position) == 'middle' ? 'selected' : '' }}>Tengah (Setelah Deskripsi)</option>
                            <option value="bottom" {{ old('photo_position', $kegiatan->photo_position) == 'bottom' ? 'selected' : '' }}>Bawah (Setelah Konten)</option>
                            <option value="none" {{ old('photo_position', $kegiatan->photo_position) == 'none' ? 'selected' : '' }}>Tanpa Media di Detail</option>
                        </select>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<script data-cfasync="false">
    function previewThumbnail(event) {
        const previewContainer = document.getElementById('thumbnail-preview');
        const img = previewContainer.querySelector('img');
        const file = event.target.files[0];

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                img.src = e.target.result;
                previewContainer.classList.remove('hidden');
            }
            reader.readAsDataURL(file);
        }
    }

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

    function setThumbnail(photoPath) {
        fetch(`{{ route('admin.kegiatan.thumbnail.update', $kegiatan->id) }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ photo: photoPath })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                window.location.reload();
            } else {
                alert('Gagal update thumbnail: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan sistem');
        });
    }

    function deletePhoto(photoPath) {
        if(!confirm('Apakah anda yakin ingin menghapus foto ini?')) return;

        fetch(`{{ route('admin.kegiatan.photo.delete', $kegiatan->id) }}`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ photo: photoPath })
        })
        .then(response => response.json())
        .then(data => {
            if(data.success) {
                window.location.reload();
            } else {
                alert('Gagal menghapus foto: ' + data.message);
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan sistem');
        });
    }
</script>
@endsection
