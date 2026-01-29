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
                <label class="block text-sm font-semibold text-gray-700 mb-2">Deskripsi *</label>
                <textarea name="description" rows="3" required
                    class="w-full px-4 py-3 border rounded-lg">{{ old('description', $kegiatan->description) }}</textarea>
            </div>

            <!-- KONTEN -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Konten</label>
                <textarea name="content" rows="8"
                    class="w-full px-4 py-3 border rounded-lg">{{ old('content', $kegiatan->content) }}</textarea>
            </div>

            <!-- FOTO BARU -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tambah Foto</label>
                <input type="file" name="photos[]" multiple
                    class="w-full px-4 py-3 border rounded-lg">
            </div>

            <!-- TANGGAL -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Tanggal</label>
                <input type="date" name="event_date"
                    value="{{ old('event_date', $kegiatan->event_date) }}"
                    class="w-full px-4 py-3 border rounded-lg">
            </div>

            <!-- LOKASI -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">Lokasi</label>
                <input type="text" name="location"
                    value="{{ old('location', $kegiatan->location) }}"
                    class="w-full px-4 py-3 border rounded-lg">
            </div>

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
@endsection
