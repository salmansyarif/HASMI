@extends('layouts.admin')

@section('title', 'Tambah Kegiatan')
@section('page-title', 'Tambah Kegiatan')
@section('page-subtitle', 'Buat kegiatan baru')

@section('content')
<div class="max-w-4xl">
    <form action="{{ route('admin.kegiatan.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="bg-white rounded-lg shadow-lg p-8 space-y-6">

            <!-- JUDUL -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Judul Kegiatan *
                </label>
                <input type="text" name="title" value="{{ old('title') }}" required
                    class="w-full px-4 py-3 border rounded-lg @error('title') border-red-500 @enderror">
                @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- DESKRIPSI -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Deskripsi Singkat *
                </label>
                <textarea name="description" rows="3" required
                    class="w-full px-4 py-3 border rounded-lg @error('description') border-red-500 @enderror">{{ old('description') }}</textarea>
                @error('description') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- KONTEN -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Konten Lengkap
                </label>
                <textarea name="content" rows="8"
                    class="w-full px-4 py-3 border rounded-lg @error('content') border-red-500 @enderror">{{ old('content') }}</textarea>
            </div>

            <!-- FOTO -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Foto Kegiatan
                </label>
                <input type="file" name="photos[]" multiple
                    class="w-full px-4 py-3 border rounded-lg @error('photos.*') border-red-500 @enderror">
                @error('photos.*') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
            </div>

            <!-- TANGGAL -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Tanggal Kegiatan
                </label>
                <input type="date" name="event_date" value="{{ old('event_date') }}"
                    class="w-full px-4 py-3 border rounded-lg @error('event_date') border-red-500 @enderror">
            </div>

            <!-- LOKASI -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Lokasi
                </label>
                <input type="text" name="location" value="{{ old('location') }}"
                    class="w-full px-4 py-3 border rounded-lg @error('location') border-red-500 @enderror">
            </div>

            <!-- STATUS -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Status *
                </label>
                <select name="status"
                    class="w-full px-4 py-3 border rounded-lg @error('status') border-red-500 @enderror">
                    <option value="draft">Draft</option>
                    <option value="published">Published</option>
                </select>
            </div>

            <!-- POSISI FOTO -->
            <div>
                <label class="block text-sm font-semibold text-gray-700 mb-2">
                    Posisi Foto *
                </label>
                <select name="photo_position"
                    class="w-full px-4 py-3 border rounded-lg @error('photo_position') border-red-500 @enderror">
                    <option value="top">Atas</option>
                    <option value="bottom">Bawah</option>
                    <option value="none">Tanpa Foto</option>
                </select>
            </div>

            <!-- THUMBNAIL DI LIST -->
            <div class="flex items-center gap-3">
                <input type="checkbox" name="show_thumbnail_in_list" value="1"
                    {{ old('show_thumbnail_in_list') ? 'checked' : '' }}>
                <span>Tampilkan thumbnail di daftar</span>
            </div>

            <!-- TOMBOL -->
            <div class="flex justify-between pt-6 border-t">
                <a href="{{ route('admin.kegiatan.index') }}" class="text-gray-600">← Kembali</a>
                <button class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-3 rounded-lg">
                    Simpan Kegiatan
                </button>
            </div>

        </div>
    </form>
</div>
@endsection
