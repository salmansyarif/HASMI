@extends('layouts.app')

@section('title', $intisari->title . ' - Intisari HASMI')

@section('content')

<style>
    .prose-reader {
        color: #cbd5e1; /* slate-300 */
        line-height: 2;
        font-size: 1.125rem;
    }
    .prose-reader p {
        margin-bottom: 1.8rem;
    }
    .prose-reader strong {
        color: #f8fafc; /* slate-50 */
    }
</style>

<div class="bg-slate-950 min-h-screen pb-20">
    <div class="container mx-auto px-6 pt-12 mb-8">
        <a href="{{ route('intisari.index') }}" 
           class="inline-flex items-center gap-2 text-blue-500 hover:text-blue-400 font-bold transition-all group">
            <i class="fas fa-arrow-left group-hover:-translate-x-2 transition-transform"></i> 
            KEMBALI KE INTISARI
        </a>
    </div>

    <div class="container mx-auto px-6">
        <div class="max-w-4xl mx-auto">
            <article class="bg-slate-900 rounded-[3rem] shadow-2xl border border-slate-800 overflow-hidden">
                
                <div class="p-8 md:p-16">
                    <h1 class="text-4xl md:text-6xl font-black text-white mb-8 leading-tight tracking-tighter">
                        {{ $intisari->title }}
                    </h1>

                    <div class="flex items-center gap-3 mb-12 pb-8 border-b border-slate-800">
                        <div class="w-10 h-10 bg-blue-600/10 rounded-full flex items-center justify-center">
                            <i class="far fa-calendar-alt text-blue-500"></i>
                        </div>
                        <span class="text-slate-400 text-sm font-bold uppercase tracking-widest">
                            Diterbitkan pada: {{ $intisari->published_at->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                        </span>
                    </div>

                    @if($intisari->excerpt)
                    <div class="mb-12 p-8 bg-blue-950/30 rounded-3xl border-l-4 border-blue-600 italic">
                        <p class="text-xl text-blue-100 font-light leading-relaxed">
                            {{ $intisari->excerpt }}
                        </p>
                    </div>
                    @endif

                    <div class="prose-reader whitespace-pre-wrap mb-16 text-justify">
                        {{ $intisari->content }}
                    </div>

                    <div class="pt-12 border-t border-slate-800 flex flex-col md:flex-row justify-between items-center gap-8">
                        <div>
                            <p class="text-slate-500 text-xs font-bold uppercase tracking-[0.2em] mb-4 text-center md:text-left">Bagikan Faedah Ini</p>
                            <div class="flex gap-4">
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($intisari->title . ' - ' . url()->current()) }}" target="_blank" class="w-12 h-12 bg-green-600/10 text-green-500 rounded-full flex items-center justify-center hover:bg-green-600 hover:text-white transition-all border border-green-600/10"><i class="fab fa-whatsapp text-xl"></i></a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" class="w-12 h-12 bg-blue-600/10 text-blue-500 rounded-full flex items-center justify-center hover:bg-blue-600 hover:text-white transition-all border border-blue-600/10"><i class="fab fa-facebook-f text-xl"></i></a>
                                <button onclick="copyToClipboard('{{ url()->current() }}')" class="w-12 h-12 bg-slate-800 text-slate-400 rounded-full flex items-center justify-center hover:bg-white hover:text-slate-950 transition-all border border-slate-700"><i class="fas fa-link"></i></button>
                            </div>
                        </div>
                        <a href="{{ route('intisari.index') }}" class="px-8 py-4 bg-slate-800 hover:bg-blue-900 text-white rounded-2xl font-bold transition-all text-sm uppercase tracking-widest border border-slate-700">
                            Intisari Lainnya
                        </a>
                    </div>
                </div>
            </article>

            <div class="mt-20">
                <h2 class="text-3xl font-black text-white mb-10 flex items-center gap-4 uppercase tracking-tighter">
                    <i class="far fa-comments text-blue-500"></i>
                    Diskusi Kajian ({{ $intisari->approvedCommentsCount() }})
                </h2>

                <div class="grid lg:grid-cols-12 gap-12">
                    <div class="lg:col-span-7 space-y-6 order-2 lg:order-1">
                        @php $comments = $intisari->comments()->approved()->latest()->get(); @endphp
                        @forelse($comments as $comment)
                        <div class="bg-slate-900/50 rounded-3xl p-8 border border-slate-800 flex gap-6 shadow-xl">
                            <div class="w-14 h-14 bg-gradient-to-br from-blue-700 to-blue-900 rounded-2xl flex items-center justify-center text-white font-black text-xl flex-shrink-0">
                                {{ $comment->initials }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-3">
                                    <h4 class="font-bold text-white text-lg">{{ $comment->name }}</h4>
                                    <span class="text-[10px] text-slate-500 font-bold uppercase tracking-widest">{{ $comment->created_at->locale('id')->diffForHumans() }}</span>
                                </div>
                                <p class="text-slate-400 leading-relaxed font-light italic">"{{ $comment->comment }}"</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-20 bg-slate-900/30 rounded-[3rem] border border-slate-800 border-dashed">
                            <i class="far fa-comment-dots text-slate-800 text-6xl mb-6"></i>
                            <p class="text-slate-600 italic font-light">Belum ada diskusi untuk intisari ini...</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="lg:col-span-5 order-1 lg:order-2">
                        <div class="bg-slate-900 rounded-[2.5rem] p-8 border border-slate-800 sticky top-10 shadow-2xl">
                            <h3 class="text-xl font-bold text-white mb-6">Tulis Tanggapan</h3>
                            
                            @if(session('success'))
                            <div class="bg-blue-600/20 text-blue-400 p-4 rounded-xl border border-blue-600/30 text-sm mb-6 flex items-center gap-3">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                            </div>
                            @endif

                            <form action="{{ route('comment.store') }}" method="POST" class="space-y-4">
                                @csrf
                                <input type="hidden" name="commentable_type" value="App\Models\Intisari">
                                <input type="hidden" name="commentable_id" value="{{ $intisari->id }}">
                                
                                <input type="text" name="name" required placeholder="Nama Anda" class="w-full px-5 py-4 bg-slate-950 border border-slate-800 rounded-2xl text-white outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                <input type="email" name="email" required placeholder="Email (Privasi Terjamin)" class="w-full px-5 py-4 bg-slate-950 border border-slate-800 rounded-2xl text-white outline-none focus:ring-2 focus:ring-blue-600 transition-all">
                                <textarea name="comment" rows="4" required placeholder="Apa tanggapan Anda mengenai intisari ini?" class="w-full px-5 py-4 bg-slate-950 border border-slate-800 rounded-2xl text-white outline-none focus:ring-2 focus:ring-blue-600 transition-all"></textarea>
                                
                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-500 text-white font-black py-5 rounded-2xl transition-all shadow-lg shadow-blue-900/40 uppercase tracking-widest text-xs">
                                    Kirim Tanggapan <i class="fas fa-paper-plane ml-2"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        showToast('Link Artikel Berhasil Disalin!');
    });
}

function showToast(message) {
    const toast = document.createElement('div');
    toast.className = `fixed bottom-10 left-1/2 -translate-x-1/2 px-8 py-4 bg-blue-600 text-white rounded-full font-bold shadow-2xl z-50 animate-fade-in-up`;
    toast.innerText = message;
    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 3000);
}
</script>

@endsection