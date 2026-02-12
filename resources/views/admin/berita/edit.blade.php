@extends('layouts.admin')

@section('title', 'Edit Berita - Admin HASMI')
@section('page-title', 'Edit Berita')
@section('page-subtitle', 'Edit data berita')

@section('content')

<div class="max-w-4xl">
    <form action="{{ route('admin.berita.update', $berita) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-lg p-8 space-y-6">
            
            <!-- JUDUL BERITA -->
            <div>
                <label for="title" class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Berita <span class="text-red-500">*</span>
                </label>
                <input type="text" id="title" name="title" value="{{ old('title', $berita->title) }}" required
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('title') border-red-500 @enderror">
                @error('title')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- DESKRIPSI SINGKAT -->
            <div>
                <label for="short_description" class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi Singkat (Opsional)
                </label>
                <textarea id="short_description" name="short_description" rows="3"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('short_description') border-red-500 @enderror"
                          placeholder="Ringkasan berita...">{{ old('short_description', $berita->short_description) }}</textarea>
                @error('short_description')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- KONTEN -->
            <div>
                <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">
                    Konten Berita
                </label>
                <textarea id="content" name="content" rows="10"
                          class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('content') border-red-500 @enderror">{{ old('content', $berita->content) }}</textarea>
                @error('content')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- THUMBNAIL -->
            <div>
                <label for="thumbnail" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-image text-blue-600 mr-1"></i> Thumbnail Utama
                </label>
                <input type="file" id="thumbnail" name="thumbnail" accept="image/jpeg,image/png,image/jpg,image/webp"
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('thumbnail') border-red-500 @enderror"
                       onchange="previewThumbnail(event)">
                <p class="text-gray-500 text-xs mt-1">
                    Biarkan kosong jika tidak ingin mengubah thumbnail.
                </p>
                @error('thumbnail')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div id="thumbnail-preview" class="mt-4">
                    @if($berita->thumbnail)
                        <img src="{{ $berita->getThumbnailUrl() }}" alt="Current Thumbnail" class="w-full max-w-md h-48 object-cover rounded-lg border border-gray-300">
                        <p class="text-xs text-gray-500 mt-1">Thumbnail Saat Ini</p>
                    @endif
                </div>
            </div>

            <!-- GALERI FOTO -->
            <div>
                <label for="photos" class="block text-sm font-semibold text-gray-700 mb-2">
                    <i class="fas fa-images text-blue-600 mr-1"></i> Tambah Foto Galeri
                </label>
                <input type="file" id="photos" name="photos[]" accept="image/jpeg,image/png,image/jpg,image/webp" multiple
                       class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('photos.*') border-red-500 @enderror"
                       onchange="previewPhotos(event)">
                <p class="text-gray-500 text-xs mt-1">
                    Foto yang diupload akan DITAMBAHKAN ke galeri yang sudah ada.
                </p>
                @error('photos.*')
                <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                @enderror

                <div id="photos-preview" class="mt-4 grid grid-cols-4 gap-4"></div>

                <!-- Existing Photos -->
                @if($berita->hasPhotos())
                <div class="mt-6">
                    <h4 class="text-sm font-semibold text-gray-700 mb-3">Foto Saat Ini:</h4>
                    <div class="grid grid-cols-4 gap-4">
                        @foreach($berita->photos as $photo)
                            <div class="relative group">
                                <img src="{{ Storage::url($photo) }}" class="w-full h-32 object-cover rounded-lg border border-gray-300">
                                <button type="button" onclick="deletePhoto('{{ $photo }}', this)" 
                                        class="absolute top-2 right-2 bg-red-600 text-white p-1 rounded-full opacity-0 group-hover:opacity-100 transition-opacity hover:bg-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </div>
                        @endforeach
                    </div>
                    <p class="text-xs text-gray-500 mt-2">Klik ikon <i class="fas fa-times text-red-500"></i> pada foto untuk menghapusnya.</p>
                </div>
                @endif
            </div>

            <!-- VIDEO -->
            <div class="border-t border-gray-200 pt-6">
                <h3 class="text-lg font-semibold text-gray-800 mb-4">
                    <i class="fas fa-video text-blue-600 mr-2"></i>Video Dokumentasi
                </h3>

                <div class="space-y-4">
                    <!-- Upload Video File -->
                    <div>
                        <label for="video_file" class="block text-sm font-semibold text-gray-700 mb-2">
                            Ganti Video File
                        </label>
                        <input type="file" id="video_file" name="video_file" accept="video/mp4,video/mov,video/avi,video/wmv,video/webm"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('video_file') border-red-500 @enderror">
                    </div>

                    <div class="text-center text-gray-500 font-semibold text-sm">ATAU</div>

                    <!-- Video URL -->
                    <div>
                        <label for="video_url" class="block text-sm font-semibold text-gray-700 mb-2">
                            URL Video (YouTube/Link Eksternal)
                        </label>
                        <input type="url" id="video_url" name="video_url" value="{{ old('video_url', $berita->video_url) }}"
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 @error('video_url') border-red-500 @enderror"
                               placeholder="https://www.youtube.com/watch?v=...">
                    </div>
                </div>
            </div>

            <!-- STATUS AKTIF -->
            <div class="border-t border-gray-200 pt-6">
                <div class="flex items-center gap-3">
                    <input type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $berita->is_active) ? 'checked' : '' }}
                           class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-2 focus:ring-blue-500">
                    <label for="is_active" class="text-gray-700 font-medium">
                        <i class="fas fa-toggle-on text-green-600 mr-1"></i> Publikasikan Berita
                    </label>
                </div>
            </div>

            <!-- TOMBOL AKSI -->
            <div class="flex items-center justify-between pt-6 border-t border-gray-200">
                <a href="{{ route('admin.berita.index') }}" class="text-gray-600 hover:text-gray-800 font-semibold">
                    <i class="fas fa-arrow-left mr-2"></i> Kembali
                </a>
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg font-semibold transition-all">
                    <i class="fas fa-save mr-2"></i> Update Berita
                </button>
            </div>
        </div>
    </form>
</div>

@endsection

@section('scripts')
<script data-cfasync="false">
    function previewThumbnail(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('thumbnail-preview');
        
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.innerHTML = `
                    <img src="${e.target.result}" alt="Thumbnail Preview" class="w-full max-w-md h-48 object-cover rounded-lg border border-gray-300">
                    <p class="text-xs text-green-600 font-bold mt-1">Preview Thumbnail Baru</p>
                `;
            }
            reader.readAsDataURL(file);
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
                        <div class="absolute bottom-2 right-2 bg-gray-800 bg-opacity-75 text-white text-xs px-2 py-1 rounded">Baru</div>
                    `;
                    previewContainer.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        }
    }

    function deletePhoto(photoPath, btnElement) {
        if(!confirm('Hapus foto ini?')) return;

        fetch('{{ route("admin.berita.photo.delete", $berita) }}', {
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
                btnElement.closest('.relative').remove();
            } else {
                alert('Gagal menghapus foto.');
            }
        })
        .catch(err => {
            console.error(err);
            alert('Terjadi kesalahan.');
        });
    }
</script>
@endsection
