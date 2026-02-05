@extends('layouts.admin')

@section('title', 'Edit Kegiatan')
@section('page-title', 'Edit Kegiatan')
@section('page-subtitle', 'Update kegiatan')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="bg-white rounded-lg shadow-lg p-8 space-y-6">

            <input type="hidden" name="existing_photos" value="{{ json_encode($kegiatan->photos) }}">

            <!-- JUDUL -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Judul *</label>
                <input type="text" name="title" value="{{ old('title', $kegiatan->title) }}" required
                    class="w-full px-4 py-3 border rounded-lg">
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi (Opsional)</label>
                <textarea name="description" rows="3"
                    class="w-full px-4 py-3 border rounded-lg">{{ old('description', $kegiatan->description) }}</textarea>
            </div>

            <!-- KONTEN -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Konten</label>
                <textarea name="content" rows="8"
                    class="w-full px-4 py-3 border rounded-lg">{{ old('content', $kegiatan->content) }}</textarea>
            </div>

            <!-- FOTO SAAT INI -->
            <div class="mb-6">
                <label class="block text-sm font-semibold text-gray-700 mb-4">
                    Foto Saat Ini 
                    <span class="text-xs font-normal text-gray-500 ml-1">(Foto pertama otomatis menjadi thumbnail)</span>
                </label>
                
                @if($kegiatan->photos && count($kegiatan->photos) > 0)
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4" id="photo-gallery">
                        @foreach($kegiatan->photos as $index => $photo)
                        <div class="relative group rounded-xl overflow-hidden border-2 {{ $index === 0 ? 'border-green-500 ring-4 ring-green-500/10' : 'border-gray-200' }} shadow-sm transition-all">
                            <div class="aspect-video w-full relative">
                                <img src="{{ asset($photo) }}" class="w-full h-full object-cover">
                                
                                {{-- Thumbnail Badge Overlay --}}
                                @if($index === 0)
                                <div class="absolute inset-0 bg-green-500/10 flex items-center justify-center">
                                    <span class="bg-green-500 text-white text-xs font-black px-4 py-2 rounded-full shadow-lg border-2 border-white tracking-wider flex items-center gap-2">
                                        <i class="fas fa-check-circle"></i> THUMBNAIL AKTIF
                                    </span>
                                </div>
                                @endif
                            </div>

                            {{-- Control Bar --}}
                            <div class="bg-white p-3 border-t flex items-center justify-between gap-2">
                                @if($index === 0)
                                    <div class="text-green-600 font-bold text-xs flex items-center gap-1">
                                        <i class="fas fa-image"></i> Foto Utama
                                    </div>
                                @else
                                    <button type="button" onclick="setThumbnail('{{ $photo }}')" 
                                            class="flex-1 bg-blue-50 text-blue-600 hover:bg-blue-100 px-3 py-2 rounded-lg text-xs font-bold transition-colors flex items-center justify-center gap-2">
                                        <i class="far fa-check-circle"></i> Jadikan Thumbnail
                                    </button>
                                @endif

                                <button type="button" onclick="deletePhoto('{{ $photo }}')" 
                                        class="w-8 h-8 flex items-center justify-center bg-red-50 text-red-500 hover:bg-red-100 rounded-lg transition-colors" 
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

            <!-- FOTO BARU -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tambah Foto Baru</label>
                <input type="file" name="photos[]" multiple
                    class="w-full px-4 py-3 border rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all">
                <p class="text-xs text-gray-500 mt-1">*Foto baru akan ditambahkan di urutan terakhir.</p>
            </div>

            <!-- TANGGAL & LOKASI DIHAPUS -->

            <!-- STATUS -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Status *</label>
                <select name="status" class="w-full px-4 py-3 border rounded-lg">
                    <option value="draft" {{ $kegiatan->status=='draft'?'selected':'' }}>Draft</option>
                    <option value="published" {{ $kegiatan->status=='published'?'selected':'' }}>Published</option>
                </select>
            </div>

            <!-- POSISI FOTO -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Posisi Foto *</label>
                <select name="photo_position" class="w-full px-4 py-3 border rounded-lg">
                    <option value="top" {{ $kegiatan->photo_position=='top'?'selected':'' }}>Atas</option>
                    <option value="bottom" {{ $kegiatan->photo_position=='bottom'?'selected':'' }}>Bawah</option>
                    <option value="none" {{ $kegiatan->photo_position=='none'?'selected':'' }}>Tanpa Foto</option>
                </select>
            </div>

            <!-- THUMBNAIL LIST -->
            <div class="flex items-center gap-3">
                <input type="checkbox" name="show_thumbnail_in_list" value="1"
                    {{ $kegiatan->show_thumbnail_in_list ? 'checked' : '' }}>
                <span>Tampilkan thumbnail di daftar</span>
            </div>

            <!-- TOMBOL -->
            <div class="flex justify-between pt-6 border-t">
                <a href="{{ route('admin.kegiatan.index') }}" class="text-gray-600">← Kembali</a>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
                    Update Kegiatan
                </button>
            </div>

        </div>
    </form>
</div>

<script>
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
            // Reload page to reflect changes (thumbnail might change)
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
