@php
    $showThumbnail = $model->show_thumbnail_in_detail ?? true;
    $photoPosition = $model->photo_position ?? 'top';
    $mediaType = $model->media_type ?? 'image'; // Default to image if not specified
    $hasVideo = !empty($model->video_url);
    $hasPhotos = !empty($model->photos) && is_array($model->photos) && count($model->photos) > 0;
    $hasThumbnail = !empty($model->thumbnail);
@endphp

@if(($photoPosition == $position) && $photoPosition != 'none')
    <div class="media-container mb-10 overflow-hidden rounded-3xl border-2 border-blue-400/40 shadow-2xl animate-scale-in">
        {{-- 1. Video Priority --}}
        @if($mediaType == 'video' && $hasVideo)
            <div class="aspect-video w-full relative overflow-hidden bg-black">
                @php
                    $videoUrl = $model->video_url;
                    $videoId = '';
                    if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $videoUrl, $match)) {
                        $videoId = $match[1];
                    }
                @endphp
                @if($videoId)
                    <iframe class="w-full h-full" src="https://www.youtube.com/embed/{{ $videoId }}" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                @else
                    <video controls class="w-full h-full object-cover">
                        <source src="{{ Str::startsWith($videoUrl, 'storage') ? asset($videoUrl) : (Str::startsWith($videoUrl, 'http') ? $videoUrl : asset('storage/' . $videoUrl)) }}" type="video/mp4">
                        Browser anda tidak mendukung tag video.
                    </video>
                @endif
            </div>
        @endif

        {{-- 2. Thumbnail (Only if show_thumbnail_in_detail is true) --}}
        @if($showThumbnail && $hasThumbnail && ($mediaType != 'video' || !$hasVideo))
            <div class="relative overflow-hidden">
                <img src="{{ method_exists($model, 'getThumbnailUrl') ? $model->getThumbnailUrl() : asset('storage/' . $model->thumbnail) }}" 
                     alt="{{ $model->title }}"
                     class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-700">
            </div>
        @endif

        {{-- 3. Gallery (Secondary if Thumbnail/Video exists, OR main if neither exists) --}}
        {{-- Actually, individual views usually handle Gallery separately or at the bottom. 
             If $mediaType is image and there's no thumbnail, show the first photo or full gallery?
             Let's just show the first photo if it's the main media block and no thumbnail.
        --}}
        @if($mediaType == 'image' && !$hasThumbnail && $hasPhotos && $showThumbnail)
             <div class="relative overflow-hidden">
                <img src="{{ asset('storage/' . $model->photos[0]) }}" 
                     alt="{{ $model->title }}"
                     class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-700">
            </div>
        @endif
    </div>
@endif
