@if ($kegiatan->video_url || ($kegiatan->photos && count($kegiatan->photos) > 0))
@php $isHero = $isHero ?? false; @endphp
<div class="media-content-block {{ $isHero ? '' : 'space-y-8 animate-scale-in' }}">
    {{-- Video Display --}}
    @if ($kegiatan->video_url)
        <div class="video-container shadow-2xl {{ $isHero ? '' : 'rounded-[2rem] border-4 border-blue-400/30 overflow-hidden' }}">
            <div class="aspect-video w-full relative">
                @if (Str::contains($kegiatan->video_url, 'youtube.com') || Str::contains($kegiatan->video_url, 'youtu.be'))
                    @php
                        $videoId = '';
                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $kegiatan->video_url, $match)) {
                            $videoId = $match[1];
                        }
                    @endphp
                    @if($videoId)
                        <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                    @else
                        <div class="w-full h-full flex items-center justify-center bg-gray-800 text-white">Invalid YouTube URL</div>
                    @endif
                @else
                    <video controls class="w-full h-full object-cover">
                        <source src="{{ Str::startsWith($kegiatan->video_url, 'storage') ? asset($kegiatan->video_url) : $kegiatan->video_url }}" type="video/mp4">
                        Browser anda tidak mendukung tag video.
                    </video>
                @endif
            </div>
            @if($isHero)
                <div class="h-2 bg-gradient-to-b from-transparent to-blue-900/20"></div>
            @endif
        </div>
    @endif

    {{-- Main Photo Display (Only if not using 'none' position and has photos) --}}
    @if (($kegiatan->photo_position ?? 'top') != 'none' && $kegiatan->photos && count($kegiatan->photos) > 0)
        <div class="featured-photo {{ $isHero ? 'relative h-[400px] md:h-[600px]' : 'shadow-2xl rounded-[2rem] overflow-hidden border-4 border-blue-400/30' }}">
            <img src="{{ asset($kegiatan->photos[0]) }}" alt="{{ $kegiatan->title }}" class="w-full h-full object-cover">
            @if($isHero)
                <div class="absolute inset-0 bg-gradient-to-t from-blue-900/40 to-transparent"></div>
            @endif
        </div>
    @endif
</div>
@endif
