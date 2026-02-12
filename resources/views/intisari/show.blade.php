@extends('layouts.app')

@section('title', $intisari->title . ' - Intisari HASMI')

@section('content')

<link rel="stylesheet" href="https://unpkg.com/aos@2.3.4/dist/aos.css" />

<style>
    .prose-reader {
        color: #dbeafe; /* blue-100 */
        line-height: 2.2;
        font-size: 1.25rem;
        text-shadow: 0 1px 3px rgba(0, 0, 0, 0.3);
    }
    .prose-reader p {
        margin-bottom: 2rem;
    }
    .prose-reader strong {
        color: #ffffff;
        font-weight: 700;
        text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
    }

    /* Enhanced Animations */
    @keyframes float-gentle {
        0%, 100% { transform: translateY(0) rotate(0deg); }
        50% { transform: translateY(-15px) rotate(2deg); }
    }

    @keyframes glow-pulse {
        0%, 100% { 
            box-shadow: 0 0 30px rgba(59, 130, 246, 0.4);
        }
        50% { 
            box-shadow: 0 0 60px rgba(59, 130, 246, 0.7), 0 0 90px rgba(59, 130, 246, 0.4);
        }
    }

    @keyframes shimmer-border {
        0% { border-color: rgba(96, 165, 250, 0.4); }
        50% { border-color: rgba(147, 197, 253, 0.8); }
        100% { border-color: rgba(96, 165, 250, 0.4); }
    }

    @keyframes fade-in-up {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-float-gentle {
        animation: float-gentle 6s ease-in-out infinite;
    }

    .animate-glow-pulse {
        animation: glow-pulse 3s ease-in-out infinite;
    }

    .animate-shimmer-border {
        animation: shimmer-border 3s ease-in-out infinite;
    }

    .animate-fade-in-up {
        animation: fade-in-up 0.6s ease-out;
    }

    /* Background Effects */
    .bg-animated {
        position: relative;
        overflow: hidden;
    }

    .bg-animated::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.15) 0%, transparent 70%);
        animation: rotate-bg 20s linear infinite;
    }

    @keyframes rotate-bg {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Particle Background */
    .particles-bg {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: 0;
    }

    .particle-dot {
        position: absolute;
        width: 3px;
        height: 3px;
        background: rgba(147, 197, 253, 0.4);
        border-radius: 50%;
        animation: particle-float 15s ease-in-out infinite;
    }

    @keyframes particle-float {
        0%, 100% { 
            transform: translate(0, 0) scale(1);
            opacity: 0;
        }
        25% { 
            transform: translate(100px, -100px) scale(1.5);
            opacity: 1;
        }
        50% { 
            transform: translate(-80px, -200px) scale(1);
            opacity: 0.8;
        }
        75% { 
            transform: translate(120px, -150px) scale(1.3);
            opacity: 1;
        }
    }
</style>

{{-- Particle Background --}}
<div class="particles-bg">
    @for($i = 0; $i < 20; $i++)
        <div class="particle-dot" style="left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%; animation-delay: {{ $i * 0.5 }}s;"></div>
    @endfor
</div>

<div class="bg-gradient-to-br from-blue-700 via-blue-600 to-blue-800 min-h-screen pb-32 relative">
    {{-- Animated Background Orbs --}}
    <div class="absolute inset-0 overflow-hidden pointer-events-none opacity-20">
        <div class="absolute top-0 left-0 w-[600px] h-[600px] bg-blue-500 rounded-full blur-[150px] animate-float-gentle"></div>
        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-blue-400 rounded-full blur-[150px] animate-float-gentle" style="animation-delay: 3s;"></div>
    </div>

    <div class="container mx-auto px-6 pt-16 mb-12 relative z-10" data-aos="fade-down">
        <a href="{{ route('intisari.index') }}" 
           class="inline-flex items-center gap-3 text-blue-200 hover:text-white font-bold transition-all group px-6 py-3 bg-blue-700/60 backdrop-blur-md rounded-full border-2 border-blue-400/40 hover:border-blue-300 hover:bg-blue-600/70 shadow-[0_0_30px_rgba(59,130,246,0.3)] hover:shadow-[0_0_50px_rgba(59,130,246,0.5)] text-lg">
            <i class="fas fa-arrow-left group-hover:-translate-x-2 transition-transform text-xl"></i> 
            <span>KEMBALI KE INTISARI</span>
        </a>
    </div>

    <div class="container mx-auto px-6 relative z-10">
        <div class="max-w-5xl mx-auto">
            <article class="bg-blue-700/60 backdrop-blur-xl rounded-[3rem] shadow-[0_0_80px_rgba(59,130,246,0.4)] border-2 border-blue-400/50 overflow-hidden hover:shadow-[0_0_120px_rgba(59,130,246,0.6)] transition-all duration-700" data-aos="fade-up" data-aos-duration="1000">
                
                <div class="p-10 md:p-20">
                    <h1 class="text-5xl md:text-7xl font-black text-white mb-10 leading-tight tracking-tighter drop-shadow-[0_0_40px_rgba(255,255,255,0.3)] animate-text-glow" data-aos="fade-up" data-aos-delay="200">
                        {{ $intisari->title }}
                    </h1>

                    <div class="flex items-center gap-4 mb-14 pb-10 border-b-2 border-blue-400/40 animate-shimmer-border" data-aos="fade-up" data-aos-delay="400">
                        <div class="w-14 h-14 bg-blue-500/30 backdrop-blur-md rounded-full flex items-center justify-center border-2 border-blue-400/50 shadow-[0_0_30px_rgba(59,130,246,0.4)] group hover:scale-125 hover:rotate-12 transition-all duration-500">
                            <i class="far fa-calendar-alt text-blue-200 text-xl group-hover:text-white transition-colors"></i>
                        </div>
                        <span class="text-blue-100 text-base font-bold uppercase tracking-widest drop-shadow-lg">
                            Diterbitkan pada: {{ $intisari->published_at->locale('id')->isoFormat('dddd, D MMMM YYYY') }}
                        </span>
                    </div>

                    @if($intisari->excerpt)
                    <div class="mb-14 p-10 bg-blue-600/40 backdrop-blur-md rounded-3xl border-l-4 border-blue-400 italic shadow-[0_0_40px_rgba(59,130,246,0.3)] hover:shadow-[0_0_60px_rgba(59,130,246,0.5)] transition-all duration-500 animate-glow-pulse" data-aos="fade-up" data-aos-delay="600">
                        <p class="text-2xl text-blue-50 font-light leading-relaxed drop-shadow-lg">
                            {{ $intisari->excerpt }}
                        </p>
                    </div>
                    @endif

                    <div class="prose-reader whitespace-pre-wrap mb-20 text-justify" data-aos="fade-up" data-aos-delay="800">
                        {{ $intisari->content }}
                    </div>

                    <div class="pt-14 border-t-2 border-blue-400/40 flex flex-col md:flex-row justify-between items-center gap-10 animate-shimmer-border" data-aos="fade-up" data-aos-delay="1000">
                        <div>
                            <p class="text-blue-200 text-sm font-bold uppercase tracking-[0.2em] mb-6 text-center md:text-left drop-shadow-lg">Bagikan Faedah Ini</p>
                            <div class="flex gap-5">
                                <a href="https://api.whatsapp.com/send?text={{ urlencode($intisari->title . ' - ' . url()->current()) }}" target="_blank" 
                                   class="w-16 h-16 bg-green-600/30 backdrop-blur-md text-green-300 rounded-full flex items-center justify-center hover:bg-green-600 hover:text-white hover:scale-125 hover:rotate-12 transition-all duration-500 border-2 border-green-500/40 hover:border-green-400 shadow-[0_0_30px_rgba(34,197,94,0.3)] hover:shadow-[0_0_50px_rgba(34,197,94,0.6)] group">
                                    <i class="fab fa-whatsapp text-2xl group-hover:scale-110 transition-transform"></i>
                                </a>
                                <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" 
                                   class="w-16 h-16 bg-blue-500/30 backdrop-blur-md text-blue-200 rounded-full flex items-center justify-center hover:bg-blue-500 hover:text-white hover:scale-125 hover:rotate-12 transition-all duration-500 border-2 border-blue-400/40 hover:border-blue-300 shadow-[0_0_30px_rgba(59,130,246,0.3)] hover:shadow-[0_0_50px_rgba(59,130,246,0.6)] group">
                                    <i class="fab fa-facebook-f text-2xl group-hover:scale-110 transition-transform"></i>
                                </a>
                                <button onclick="copyToClipboard('{{ url()->current() }}')" 
                                        class="w-16 h-16 bg-blue-600/40 backdrop-blur-md text-blue-200 rounded-full flex items-center justify-center hover:bg-white hover:text-blue-950 hover:scale-125 hover:rotate-12 transition-all duration-500 border-2 border-blue-400/40 hover:border-white shadow-[0_0_30px_rgba(59,130,246,0.3)] hover:shadow-[0_0_50px_rgba(255,255,255,0.5)] group">
                                    <i class="fas fa-link text-xl group-hover:scale-110 transition-transform"></i>
                                </button>
                            </div>
                        </div>
                        <a href="{{ route('intisari.index') }}" 
                           class="px-10 py-5 bg-blue-600/50 backdrop-blur-md hover:bg-white text-blue-50 hover:text-blue-950 rounded-2xl font-bold transition-all text-base uppercase tracking-widest border-2 border-blue-400/40 hover:border-white shadow-[0_0_30px_rgba(59,130,246,0.4)] hover:shadow-[0_0_60px_rgba(255,255,255,0.5)] hover:scale-110 duration-500">
                            Intisari Lainnya
                        </a>
                    </div>
                </div>
            </article>

            <div class="mt-24">
                <h2 class="text-4xl md:text-5xl font-black text-white mb-12 flex items-center gap-5 uppercase tracking-tighter drop-shadow-[0_0_30px_rgba(255,255,255,0.3)]" data-aos="fade-right">
                    <div class="w-16 h-16 bg-blue-500/40 backdrop-blur-md rounded-2xl flex items-center justify-center border-2 border-blue-400/50 shadow-[0_0_40px_rgba(59,130,246,0.4)] animate-pulse-subtle">
                        <i class="far fa-comments text-blue-200 text-2xl"></i>
                    </div>
                    <span>Diskusi Kajian ({{ $intisari->approvedCommentsCount() }})</span>
                </h2>

                <div class="grid lg:grid-cols-12 gap-14">
                    <div class="lg:col-span-7 space-y-8 order-2 lg:order-1">
                        @php $comments = $intisari->comments()->approved()->latest()->get(); @endphp
                        @forelse($comments as $comment)
                        <div class="bg-blue-700/50 backdrop-blur-xl rounded-3xl p-10 border-2 border-blue-400/40 flex gap-7 shadow-[0_0_40px_rgba(59,130,246,0.3)] hover:shadow-[0_0_60px_rgba(59,130,246,0.5)] hover:-translate-y-2 transition-all duration-500 group" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                            <div class="w-16 h-16 bg-gradient-to-br from-blue-500 to-blue-600 rounded-2xl flex items-center justify-center text-white font-black text-2xl flex-shrink-0 shadow-[0_0_30px_rgba(59,130,246,0.5)] group-hover:scale-125 group-hover:rotate-12 transition-all duration-500 border-2 border-blue-400/50">
                                {{ $comment->initials }}
                            </div>
                            <div class="flex-1">
                                <div class="flex justify-between items-center mb-4">
                                    <h4 class="font-bold text-white text-xl drop-shadow-lg">{{ $comment->name }}</h4>
                                    <span class="text-xs text-blue-200 font-bold uppercase tracking-widest bg-blue-600/40 px-3 py-1 rounded-full border border-blue-400/40">
                                        {{ $comment->created_at->locale('id')->diffForHumans() }}
                                    </span>
                                </div>
                                <p class="text-blue-50 text-lg leading-relaxed font-light italic drop-shadow-md">"{{ $comment->comment }}"</p>
                            </div>
                        </div>
                        @empty
                        <div class="text-center py-24 bg-blue-700/40 backdrop-blur-md rounded-[3rem] border-2 border-blue-400/30 border-dashed" data-aos="fade-up">
                            <div class="w-24 h-24 mx-auto mb-8 bg-blue-600/40 rounded-full flex items-center justify-center">
                                <i class="far fa-comment-dots text-blue-300 text-5xl"></i>
                            </div>
                            <p class="text-blue-100 italic font-light text-xl">Belum ada diskusi untuk intisari ini...</p>
                            <p class="text-blue-200 text-sm mt-3">Jadilah yang pertama berkomentar!</p>
                        </div>
                        @endforelse
                    </div>

                    <div class="lg:col-span-5 order-1 lg:order-2">
                        <div class="bg-blue-700/60 backdrop-blur-xl rounded-[2.5rem] p-10 border-2 border-blue-400/40 sticky top-10 shadow-[0_0_60px_rgba(59,130,246,0.4)] hover:shadow-[0_0_80px_rgba(59,130,246,0.6)] transition-all duration-700" data-aos="fade-left">
                            <div class="flex items-center gap-4 mb-8">
                                <div class="w-12 h-12 bg-blue-500/40 rounded-xl flex items-center justify-center">
                                    <i class="fas fa-pen text-blue-200 text-xl"></i>
                                </div>
                                <h3 class="text-2xl font-bold text-white drop-shadow-lg">Tulis Tanggapan</h3>
                            </div>
                            
                            @if(session('success'))
                            <div class="bg-blue-500/40 backdrop-blur-md text-blue-50 p-5 rounded-2xl border-2 border-blue-400/50 text-base mb-8 flex items-center gap-4 shadow-[0_0_30px_rgba(59,130,246,0.4)] animate-fade-in-up">
                                <div class="w-10 h-10 bg-blue-400 rounded-full flex items-center justify-center flex-shrink-0">
                                    <i class="fas fa-check-circle text-white text-xl"></i>
                                </div>
                                <span class="font-semibold">{{ session('success') }}</span>
                            </div>
                            @endif

                            <form action="{{ route('comment.store') }}" method="POST" class="space-y-5">
                                @csrf
                                <input type="hidden" name="commentable_type" value="App\Models\Intisari">
                                <input type="hidden" name="commentable_id" value="{{ $intisari->id }}">
                                
                                <div class="relative group">
                                    <input type="text" name="name" required placeholder="Nama Anda" 
                                           class="w-full px-6 py-5 bg-blue-800/50 backdrop-blur-md border-2 border-blue-400/40 rounded-2xl text-white text-lg outline-none focus:ring-4 focus:ring-blue-500/50 focus:border-blue-400 transition-all shadow-inner group-hover:border-blue-400/60">
                                </div>
                                
                                <div class="relative group">
                                    <input type="email" name="email" required placeholder="Email (Privasi Terjamin)" 
                                           class="w-full px-6 py-5 bg-blue-800/50 backdrop-blur-md border-2 border-blue-400/40 rounded-2xl text-white text-lg outline-none focus:ring-4 focus:ring-blue-500/50 focus:border-blue-400 transition-all shadow-inner group-hover:border-blue-400/60">
                                </div>
                                
                                <div class="relative group">
                                    <textarea name="comment" rows="5" required placeholder="Apa tanggapan Anda mengenai intisari ini?" 
                                              class="w-full px-6 py-5 bg-blue-800/50 backdrop-blur-md border-2 border-blue-400/40 rounded-2xl text-white text-lg outline-none focus:ring-4 focus:ring-blue-500/50 focus:border-blue-400 transition-all shadow-inner resize-none group-hover:border-blue-400/60"></textarea>
                                </div>
                                
                                <button type="submit" 
                                        class="w-full bg-gradient-to-r from-blue-500 to-blue-600 hover:from-blue-400 hover:to-blue-500 text-white font-black py-6 rounded-2xl transition-all shadow-[0_10px_40px_rgba(59,130,246,0.5)] hover:shadow-[0_15px_60px_rgba(59,130,246,0.7)] uppercase tracking-widest text-base hover:scale-105 duration-500 border-2 border-blue-400/50 hover:border-blue-300 group">
                                    <span>Kirim Tanggapan</span>
                                    <i class="fas fa-paper-plane ml-3 group-hover:translate-x-2 group-hover:-translate-y-1 transition-transform"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script data-cfasync="false" src="https://unpkg.com/aos@2.3.4/dist/aos.js"></script>
<script data-cfasync="false">
// Initialize AOS
AOS.init({
    duration: 1000,
    easing: 'ease-out-cubic',
    once: false,
    offset: 100,
    delay: 100,
});

function copyToClipboard(text) {
    navigator.clipboard.writeText(text).then(() => {
        showToast('✓ Link Artikel Berhasil Disalin!');
    });
}

function showToast(message) {
    const toast = document.createElement('div');
    toast.className = `fixed bottom-10 left-1/2 -translate-x-1/2 px-10 py-5 bg-gradient-to-r from-blue-500 to-blue-600 text-white rounded-full font-bold shadow-[0_20px_60px_rgba(59,130,246,0.6)] z-50 animate-fade-in-up border-2 border-blue-400/50 text-lg backdrop-blur-md`;
    toast.innerHTML = `
        <div class="flex items-center gap-3">
            <i class="fas fa-check-circle text-2xl"></i>
            <span>${message}</span>
        </div>
    `;
    document.body.appendChild(toast);
    setTimeout(() => {
        toast.style.opacity = '0';
        toast.style.transform = 'translateX(-50%) translateY(20px)';
        setTimeout(() => toast.remove(), 500);
    }, 3000);
}

// Smooth scroll behavior
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});

// Add text glow animation
const style = document.createElement('style');
style.textContent = `
    @keyframes text-glow {
        0%, 100% { 
            text-shadow: 0 0 20px rgba(255, 255, 255, 0.3);
        }
        50% { 
            text-shadow: 0 0 40px rgba(255, 255, 255, 0.5), 0 0 60px rgba(147, 197, 253, 0.4);
        }
    }

    .animate-text-glow {
        animation: text-glow 4s ease-in-out infinite;
    }

    @keyframes pulse-subtle {
        0%, 100% { 
            transform: scale(1);
            opacity: 1;
        }
        50% { 
            transform: scale(1.05);
            opacity: 0.9;
        }
    }

    .animate-pulse-subtle {
        animation: pulse-subtle 3s ease-in-out infinite;
    }
`;
document.head.appendChild(style);
</script>

@endsection