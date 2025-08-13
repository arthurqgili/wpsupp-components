@props(['media'])

{{--
  Image Message Component

  Displays an image thumbnail in a chat bubble. When clicked, it dispatches
  a global Alpine.js event ('open-media-modal') for a parent component
  to open a full-size view of the image in a modal.

  - `src`: Prioritizes a base64 thumbnail for fast loading, falling back
    to the full image URL.
--}}
<div 
    class="w-full relative cursor-pointer overflow-hidden rounded-sm"
    x-data
    x-on:click="$dispatch('open-media-modal', { type: 'image', url: '{{ $media->url }}' })"
>
    @php
        $thumbnailSrc = $media->thumbnail_base64 
            ? "data:{$media->mime_type};base64,{$media->thumbnail_base64}" 
            : $media->url;
    @endphp
    <img class="w-full aspect-[4/3] object-cover bg-black-2  {{ $media->thumbnail_base64 ? 'blur-[4px]' : '' }}" 
         src="{{ $thumbnailSrc }}" 
         alt="Message image">
    <div class="absolute w-full bottom-0 text-right right-0 p-xxs bg-gradient-to-b from-transparent to-black-1/50">
        <x-shared.typography.body size="sm" class="text-white">{{ $media->created_at->format('H:i') }}</x-shared.typography.body>
    </div>
</div>