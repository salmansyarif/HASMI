@props(['videoId' => null, 'title' => 'Play Video', 'cover' => null])

@php
    $finalVideoId = $videoId;
    // Simple regex to extract ID if a full URL is passed by mistake, though the component expects an ID primarily.
    if (filter_var($videoId, FILTER_VALIDATE_URL)) {
        if (
            preg_match(
                '%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i',
                $videoId,
                $match,
            )
        ) {
            $finalVideoId = $match[1];
        }
    }

    $thumbnailUrl = $cover ?? "https://img.youtube.com/vi/{$finalVideoId}/maxresdefault.jpg";
@endphp

<div {{ $attributes->merge(['class' => 'lite-youtube-embed relative w-full h-full overflow-hidden bg-slate-900 cursor-pointer group rounded-xl']) }}
    data-video-id="{{ $finalVideoId }}" data-title="{{ $title }}" onclick="loadLiteYoutube(this)">
    {{-- Thumbnail --}}
    <img src="{{ $thumbnailUrl }}" alt="{{ $title }}"
        class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105 opacity-90 group-hover:opacity-100"
        loading="lazy" onerror="this.src='https://img.youtube.com/vi/{{ $finalVideoId ?? '' }}/hqdefault.jpg'">

    {{-- Overlay Gradient --}}
    <div class="absolute inset-0 bg-gradient-to-t from-black/60 via-transparent to-transparent pointer-events-none">
    </div>

    {{-- Play Button --}}
    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
        <div
            class="w-16 h-16 md:w-20 md:h-20 bg-red-600/90 hover:bg-red-600 text-white rounded-full flex items-center justify-center shadow-[0_0_30px_rgba(220,38,38,0.5)] transition-all duration-300 group-hover:scale-110 group-hover:shadow-[0_0_50px_rgba(220,38,38,0.7)] backdrop-blur-sm">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-8 h-8 md:w-10 md:h-10 ml-1" viewBox="0 0 24 24"
                fill="currentColor">
                <path d="M8 5v14l11-7z" />
            </svg>
        </div>
    </div>
</div>

@push('scripts')
    @once
        <script>
            function loadLiteYoutube(element) {
                const videoId = element.getAttribute('data-video-id');
                const title = element.getAttribute('data-title');

                if (!videoId) return;

                const iframe = document.createElement('iframe');
                iframe.width = "100%";
                iframe.height = "100%";
                iframe.src =
                `https://www.youtube-nocookie.com/embed/${videoId}?autoplay=1&rel=0&modestbranding=1&playsinline=1`;
                iframe.title = title;
                iframe.frameBorder = "0";
                iframe.allow =
                    "accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share";
                iframe.allowFullscreen = true;
                iframe.className = "absolute inset-0 w-full h-full animate-fade-in";

                element.innerHTML = '';
                element.appendChild(iframe);
                element.removeAttribute('onclick');
                element.classList.remove('cursor-pointer', 'group');
            }
        </script>
        <style>
            @keyframes fadeIn {
                from {
                    opacity: 0;
                }

                to {
                    opacity: 1;
                }
            }

            .animate-fade-in {
                animation: fadeIn 0.5s ease-out forwards;
            }
        </style>
    @endonce
@endpush
