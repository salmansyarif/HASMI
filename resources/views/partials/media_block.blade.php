@php
    $showThumbnail = $model->show_thumbnail_in_detail ?? true;
    $photoPosition = $model->photo_position ?? 'top';
    $hasVideo = !empty($model->video_url);
    // If media_type is not explicitly defined on model, default to 'video' if video_url is set, else 'image'
    $mediaType = $model->media_type ?? ($hasVideo ? 'video' : 'image');
    $hasPhotos = !empty($model->photos) && is_array($model->photos) && count($model->photos) > 0;
    $hasThumbnail = !empty($model->thumbnail);
@endphp

@if(($photoPosition == $position) && $photoPosition != 'none')
    <div class="media-container mb-10 overflow-hidden rounded-3xl border-2 border-blue-400/40 shadow-2xl animate-scale-in">
        {{-- 1. Video Priority --}}
        @if($hasVideo && ($mediaType == 'video' || empty($model->media_type)))
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
                    @php
                        if (filter_var($videoUrl, FILTER_VALIDATE_URL)) {
                            $srcUrl = $videoUrl;
                        } elseif (Str::startsWith($videoUrl, 'storage/') || Str::startsWith($videoUrl, '/storage/')) {
                            $srcUrl = asset(ltrim($videoUrl, '/'));
                        } else {
                            $srcUrl = asset('storage/' . ltrim($videoUrl, '/'));
                        }
                    @endphp
                    <video controls class="w-full h-full object-contain">
                        <source src="{{ $srcUrl }}" type="video/mp4">
                        Browser anda tidak mendukung tag video.
                    </video>
                @endif
            </div>
        @endif

        {{-- 2. Thumbnail (Only if show_thumbnail_in_detail is true and no video rendered) --}}
        @if($showThumbnail && $hasThumbnail && (!$hasVideo || ($model->media_type ?? '') == 'image'))
            <div class="relative overflow-hidden">
                <img src="{{ method_exists($model, 'getThumbnailUrl') ? $model->getThumbnailUrl() : asset('storage/' . $model->thumbnail) }}" 
                     alt="{{ $model->title }}"
                     class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-700">
            </div>
        @endif

        {{-- 3. Gallery (Fallback if no thumbnail and no video) --}}
        @if(!$hasThumbnail && !$hasVideo && $hasPhotos && $showThumbnail)
             <div class="relative overflow-hidden">
                <img src="{{ asset('storage/' . $model->photos[0]) }}" 
                     alt="{{ $model->title }}"
                     class="w-full h-auto object-cover transform hover:scale-105 transition-transform duration-700">
            </div>
        @endif
    </div>
@endif

