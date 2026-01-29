@extends('layouts.admin')

@section('title', 'Moderasi Komentar - Admin HASMI')
@section('page-title', 'Moderasi Komentar')
@section('page-subtitle', 'Kelola dan moderasi semua komentar user')

@section('content')

<div class="bg-white rounded-lg shadow-lg">
    <div class="p-6 border-b border-gray-200 flex items-center justify-between">
        <div>
            <h2 class="text-xl font-bold text-gray-800">Daftar Komentar</h2>
            <p class="text-gray-600 text-sm">Total: {{ $comments->total() }} komentar</p>
        </div>
        <div class="flex gap-2">
            <span class="bg-yellow-100 text-yellow-700 px-4 py-2 rounded-lg text-sm font-semibold">
                <i class="fas fa-clock mr-1"></i> Pending: {{ $comments->where('status', 'pending')->count() }}
            </span>
            <span class="bg-green-100 text-green-700 px-4 py-2 rounded-lg text-sm font-semibold">
                <i class="fas fa-check-circle mr-1"></i> Approved: {{ $comments->where('status', 'approved')->count() }}
            </span>
        </div>
    </div>

    <!-- Filter & Search -->
    <div class="p-6 bg-gray-50 border-b border-gray-200">
        <form method="GET" action="{{ route('admin.comments.index') }}" class="grid md:grid-cols-3 gap-4">
            <div>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama, email, atau komentar..."
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
            </div>

            <div>
                <select name="status" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <option value="">Semua Status</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="approved" {{ request('status') == 'approved' ? 'selected' : '' }}>Approved</option>
                    <option value="rejected" {{ request('status') == 'rejected' ? 'selected' : '' }}>Rejected</option>
                </select>
            </div>

            <div class="flex gap-2">
                <button type="submit" class="flex-1 bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg font-semibold transition-all">
                    <i class="fas fa-filter mr-2"></i> Filter
                </button>
                <a href="{{ route('admin.comments.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-4 py-2 rounded-lg font-semibold transition-all">
                    <i class="fas fa-redo"></i>
                </a>
            </div>
        </form>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">
            <thead class="bg-gray-100 border-b border-gray-200">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">User</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Komentar</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Artikel/Konten</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Tanggal</th>
                    <th class="px-6 py-3 text-left text-xs font-semibold text-gray-600 uppercase">Status</th>
                    <th class="px-6 py-3 text-right text-xs font-semibold text-gray-600 uppercase">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-200">
                @forelse($comments as $comment)
                <tr class="hover:bg-gray-50 transition-colors">
                    <td class="px-6 py-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 bg-gradient-to-br from-blue-400 to-blue-600 rounded-full flex items-center justify-center text-white font-bold">
                                {{ $comment->initials }}
                            </div>
                            <div>
                                <p class="font-semibold text-gray-800">{{ $comment->name }}</p>
                                <p class="text-xs text-gray-500">{{ $comment->email }}</p>
                            </div>
                        </div>
                    </td>
                    <td class="px-6 py-4">
                        <p class="text-sm text-gray-700">{{ Str::limit($comment->comment, 80) }}</p>
                    </td>
                    <td class="px-6 py-4">
                        <div class="text-sm">
                            <p class="font-semibold text-gray-800">
                                @if($comment->commentable)
                                    {{ $comment->commentable->title ?? $comment->commentable->name ?? 'N/A' }}
                                @else
                                    <span class="text-red-500">Konten dihapus</span>
                                @endif
                            </p>
                            <p class="text-xs text-gray-500">
                                {{ class_basename($comment->commentable_type) }}
                            </p>
                        </div>
                    </td>
                    <td class="px-6 py-4 text-sm text-gray-600">
                        {{ $comment->created_at->locale('id')->isoFormat('D MMM Y, HH:mm') }}
                    </td>
                    <td class="px-6 py-4">
                        @if($comment->status == 'approved')
                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-700 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-check-circle"></i> Approved
                            </span>
                        @elseif($comment->status == 'rejected')
                            <span class="inline-flex items-center gap-1 bg-red-100 text-red-700 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-times-circle"></i> Rejected
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-xs font-semibold">
                                <i class="fas fa-clock"></i> Pending
                            </span>
                        @endif
                    </td>
                    <td class="px-6 py-4 text-right">
                        <div class="flex items-center justify-end gap-2">
                            @if($comment->status != 'approved')
                            <form action="{{ route('admin.comments.approve', $comment->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-green-600 hover:text-green-700 p-2 hover:bg-green-50 rounded-lg transition-all" title="Approve">
                                    <i class="fas fa-check"></i>
                                </button>
                            </form>
                            @endif

                            @if($comment->status != 'rejected')
                            <form action="{{ route('admin.comments.reject', $comment->id) }}" method="POST" class="inline">
                                @csrf
                                <button type="submit" class="text-orange-600 hover:text-orange-700 p-2 hover:bg-orange-50 rounded-lg transition-all" title="Reject">
                                    <i class="fas fa-ban"></i>
                                </button>
                            </form>
                            @endif

                            <form action="{{ route('admin.comments.destroy', $comment->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus komentar ini?')" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-700 p-2 hover:bg-red-50 rounded-lg transition-all" title="Hapus">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="px-6 py-12 text-center">
                        <i class="fas fa-comments text-gray-300 text-5xl mb-4"></i>
                        <p class="text-gray-500 text-lg">Belum ada komentar.</p>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    @if($comments->hasPages())
    <div class="p-6 border-t border-gray-200">
        {{ $comments->links() }}
    </div>
    @endif
</div>

@endsection