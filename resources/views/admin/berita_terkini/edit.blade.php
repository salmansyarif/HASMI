@extends('layouts.admin')

@section('title', 'Edit Berita Terkini')
@section('page-title', 'Edit Berita')
@section('page-subtitle', 'Perbarui konten berita')

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

    <form action="{{ route('admin.berita-terkini.update', $beritaTerkini->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

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
                               value="{{ old('title', $beritaTerkini->title) }}" required>
                    </div>

                    <!-- Excerpt (Short Description) -->
                    <div class="mb-5">
                        <label for="excerpt" class="block text-sm font-semibold text-gray-700 mb-2">
                            Deskripsi Singkat (Opsional)
                            <span class="text-xs font-normal text-gray-500 ml-1">- Ditampilkan di preview kartu berita</span>
                        </label>
                        <textarea name="excerpt" id="excerpt" rows="3" 
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all">{{ old('excerpt', $beritaTerkini->excerpt) }}</textarea>
                    </div>

                    <!-- Content (Long Description) -->
                    <div>
                        <label for="content" class="block text-sm font-semibold text-gray-700 mb-2">Konten Berita Lengkap</label>
                        <textarea name="content" id="content" rows="20" 
                                  class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition-all font-sans text-base leading-relaxed p-4">{{ old('content', $beritaTerkini->content) }}</textarea>
                    </div>
                </div>

                <!-- Gallery Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2 flex items-center gap-2">
                        <i class="fas fa-images text-blue-500"></i> Galeri Foto Dokumentasi
                    </h3>

                    <!-- Manual Grid of Existing Photos with Delete Buttons -->
                    @if($beritaTerkini->hasPhotos())
                        <div class="grid grid-cols-4 gap-4 mb-6">
                            @foreach($beritaTerkini->photos as $photo)
                            <div class="relative group aspect-square rounded-lg overflow-hidden border border-gray-200 shadow-sm">
                                <img src="{{ asset('storage/' . $photo) }}" class="w-full h-full object-cover">
                                <button type="button" 
                                        onclick="deletePhoto(this, '{{ $photo }}')"
                                        class="absolute top-2 right-2 bg-red-600 text-white w-8 h-8 rounded-full flex items-center justify-center shadow-md opacity-0 group-hover:opacity-100 transition-all hover:bg-red-700">
                                    <i class="fas fa-trash-alt text-xs"></i>
                                </button>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <p class="text-sm text-gray-500 italic mb-4">Belum ada foto galeri.</p>
                    @endif
                    
                    <!-- Upload Box -->
                    <div class="mb-4">
                        <label class="block text-sm text-gray-500 mb-2">Tambah Foto Dokumentasi</label>
                        <input type="file" name="photos[]" id="photos" accept="image/*" multiple 
                               class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all"
                               onchange="previewPhotos(this)">
                        <p class="mt-2 text-xs text-gray-400">Bisa pilih lebih dari satu foto sekaligus.</p>
                    </div>
                    <!-- New Photos Preview -->
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
                            <input type="checkbox" name="is_active" value="1" class="sr-only peer" {{ old('is_active', $beritaTerkini->is_active) ? 'checked' : '' }}>
                            <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-600"></div>
                            <span class="ml-3 text-sm font-medium text-gray-900 peer-checked:text-blue-600">Aktif</span>
                        </label>
                    </div>

                    <button type="submit" class="w-full bg-blue-600 text-white font-bold py-3 px-4 rounded-lg hover:bg-blue-700 hover:shadow-lg transition-all flex items-center justify-center gap-2">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                </div>

                <!-- Media Thumbnail Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Thumbnail Utama</h3>
                    
                    @if($beritaTerkini->thumbnail)
                    <div class="mb-4 rounded-lg overflow-hidden border border-gray-200">
                        <img src="{{ asset('storage/' . $beritaTerkini->thumbnail) }}" class="w-full h-auto">
                    </div>
                    @endif

                    <div class="mb-4">
                        <label class="block text-sm text-gray-500 mb-2">Ganti Gambar Sampul</label>
                        <input type="file" name="thumbnail" id="thumbnail" accept="image/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                    </div>
                </div>

                <!-- Video Card -->
                <div class="bg-white rounded-xl shadow-sm border border-gray-100 p-6">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 border-b pb-2">Video (Opsional)</h3>
                    
                    <div class="space-y-4">
                        <div class="flex bg-gray-100 rounded-lg p-1">
                            <button type="button" onclick="toggleVideoInput('file')" id="btn-file" class="flex-1 py-1 px-3 text-sm rounded-md shadow text-blue-600 font-medium transition-all {{ $beritaTerkini->video_url && !filter_var($beritaTerkini->video_url, FILTER_VALIDATE_URL) ? 'bg-white shadow text-blue-600' : 'text-gray-500' }}">Upload</button>
                            <button type="button" onclick="toggleVideoInput('url')" id="btn-url" class="flex-1 py-1 px-3 text-sm rounded-md transition-all {{ $beritaTerkini->video_url && filter_var($beritaTerkini->video_url, FILTER_VALIDATE_URL) ? 'bg-white shadow text-blue-600' : 'text-gray-500' }}">URL Ext.</button>
                        </div>

                        <!-- Video File Input -->
                        <div id="video_file_input" class="{{ $beritaTerkini->video_url && filter_var($beritaTerkini->video_url, FILTER_VALIDATE_URL) ? 'hidden' : '' }} transition-all">
                            @if($beritaTerkini->video_url && !filter_var($beritaTerkini->video_url, FILTER_VALIDATE_URL))
                                <div class="mb-2 p-2 bg-blue-50 rounded text-xs text-blue-700 break-all">
                                    Current: {{ $beritaTerkini->video_url }}
                                </div>
                            @endif
                            <input type="file" name="video_file" accept="video/*" class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-blue-50 file:text-blue-700 hover:file:bg-blue-100 transition-all">
                        </div>

                        <!-- Video URL Input -->
                        <div id="video_url_input" class="{{ $beritaTerkini->video_url && filter_var($beritaTerkini->video_url, FILTER_VALIDATE_URL) ? '' : 'hidden' }} transition-all">
                            <input type="url" name="video_url" 
                                   class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200" 
                                   placeholder="https://youtube.com/..."
                                   value="{{ filter_var($beritaTerkini->video_url, FILTER_VALIDATE_URL) ? $beritaTerkini->video_url : '' }}">
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </form>
</div>

<script data-cfasync="false">
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
        previewContainer.innerHTML = ''; 

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

    function deletePhoto(btn, photoPath) {
        if (!confirm('Hapus foto ini?')) return;

        const container = btn.closest('.relative');
        
        // Disable button
        btn.disabled = true;
        btn.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';

        // Send AJAX request
        fetch('{{ route('admin.berita-terkini.photo.delete', $beritaTerkini->id) }}', {
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
                container.remove();
            } else {
                alert('Gagal menghapus foto.');
                btn.disabled = false;
                btn.innerHTML = '<i class="fas fa-trash-alt"></i>';
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('Terjadi kesalahan.');
            btn.disabled = false;
            btn.innerHTML = '<i class="fas fa-trash-alt"></i>';
        });
    }
</script>
@endsection
