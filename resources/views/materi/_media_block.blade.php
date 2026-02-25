@if ($article->media_type && $article->media_type != 'none' && (($article->media_type == 'video' && $article->video_url) || ($article->media_type == 'image' && $article->photos && count($article->photos) > 0)))
<div class="media-container mb-10 shadow-2xl animate-scale-in">
    @if ($article->media_type == 'video' && $article->video_url)
        <div class="aspect-video w-full relative overflow-hidden rounded-xl">
            @if (Str::contains($article->video_url, 'youtube.com') || Str::contains($article->video_url, 'youtu.be'))
                <x-lite-youtube :videoId="$article->video_url" :title="$article->title" />
            @else
                <video controls class="w-full h-full object-cover rounded-xl">
                    <source src="{{ asset($article->video_url) }}" type="video/mp4">
                    Browser anda tidak mendukung tag video.
                </video>
            @endif
        </div>
    @elseif($article->media_type == 'image' && $article->photos && count($article->photos) > 0)
        <!-- Gallery Slider/Grid -->
        <div class="grid grid-cols-1 {{ count($article->photos) > 1 ? 'md:grid-cols-2' : '' }} gap-4">
            @foreach($article->photos as $photo)
                <img src="{{ asset($photo) }}" alt="{{ $article->title }}" class="w-full h-auto object-cover rounded-xl shadow-md">
            @endforeach
        </div>
    @endif
</div>
@endif
