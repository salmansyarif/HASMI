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
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Galeri Foto</h3>

                    <!-- Current Photos -->
                    <div class="mb-6">
                        <label class="block text-sm font-semibold text-gray-700 mb-4">
                            Foto Saat Ini 
                            <span class="text-xs font-normal text-gray-500 ml-1">(Foto pertama otomatis menjadi thumbnail)</span>
                        </label>
                        
                        @if($kegiatan->photos && count($kegiatan->photos) > 0)
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="photo-gallery">
                                @foreach($kegiatan->photos as $index => $photo)
                                <div class="relative group rounded-xl overflow-hidden border-2 {{ $index === 0 ? 'border-green-500 ring-4 ring-green-500/10' : 'border-gray-200' }} shadow-sm transition-all">
                                    <div class="aspect-square w-full relative">
                                        <img src="{{ asset($photo) }}" class="w-full h-full object-cover">
                                        
                                        {{-- Thumbnail Badge Overlay --}}
                                        @if($index === 0)
                                        <div class="absolute inset-0 bg-green-500/10 flex items-center justify-center">
                                            <span class="bg-green-500 text-white text-xs font-black px-2 py-1 rounded-full shadow-lg border-2 border-white tracking-wider flex items-center gap-1 transform scale-75 md:scale-100">
                                                <i class="fas fa-check-circle"></i> THUMB
                                            </span>
                                        </div>
                                        @endif
                                    </div>

                                    {{-- Control Bar --}}
                                    <div class="bg-white p-2 border-t flex items-center justify-between gap-1">
                                        @if($index === 0)
                                            <div class="text-green-600 font-bold text-xs flex items-center gap-1 w-full justify-center py-1">
                                                <i class="fas fa-image"></i> Utama
                                            </div>
                                        @else
                                            <button type="button" onclick="setThumbnail('{{ $photo }}')" 
                                                    class="flex-1 bg-blue-50 text-blue-600 hover:bg-blue-100 px-2 py-1 rounded text-xs font-bold transition-colors flex items-center justify-center gap-1"
                                                    title="Jadikan Thumbnail">
                                                <i class="far fa-check-circle"></i> Set
                                            </button>
                                        @endif

                                        <button type="button" onclick="deletePhoto('{{ $photo }}')" 
                                                class="w-6 h-6 flex items-center justify-center bg-red-50 text-red-500 hover:bg-red-100 rounded transition-colors" 
                                                title="Hapus Foto">
                                            <i class="fas fa-trash-alt text-xs"></i>
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
                                   class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all"
                                   onchange="previewPhotos(event)">
                            <p class="mt-2 text-xs text-gray-400">
                                Format: JPG, PNG, WEBP. Maks 2MB. <br>
                                <span class="text-blue-600 text-xs">*Foto baru akan ditambahkan di urutan terakhir.</span>
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
                        <label for="photo_position" class="block text-sm font-semibold text-gray-700 mb-2">Posisi Foto Utama <span class="text-red-500">*</span></label>
                        <select id="photo_position" name="photo_position" required
                                class="w-full rounded-lg border-2 border-gray-300 shadow-sm focus:border-blue-600 focus:ring focus:ring-blue-200 transition-all py-3 px-4 text-lg bg-gray-50 focus:bg-white">
                            <option value="top" {{ old('photo_position', $kegiatan->photo_position) == 'top' ? 'selected' : '' }}>Atas (Top)</option>
                            <option value="bottom" {{ old('photo_position', $kegiatan->photo_position) == 'bottom' ? 'selected' : '' }}>Bawah (Bottom)</option>
                            <option value="none" {{ old('photo_position', $kegiatan->photo_position) == 'none' ? 'selected' : '' }}>Tanpa Foto</option>
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
