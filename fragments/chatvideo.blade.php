@props(['media'])

{{--
  Inline Video Player Component

  Displays a video thumbnail in a chat bubble. When the user clicks the thumbnail,
  it is replaced by an HTML5 video player that autoplays the content directly
  within the bubble.

  - `x-data="{ isPlaying: false }"`: Manages the toggle state between the
    thumbnail view and the video player view.
--}}
<div class="w-full h-auto relative aspect-video bg-black-2 rounded-sm overflow-hidden"
     x-data="{ isPlaying: false }">
    <div 
        x-show="!isPlaying"
        x-on:click="isPlaying = true"
        class="w-full h-full cursor-pointer"
    >
        <img class="w-full h-full object-cover rounded-sm bg-black-2 blur-[4px]" 
             src="{{ $media->thumbnail_base64 ? 'data:' . $media->mime_type . ';base64,' . $media->thumbnail_base64 : 'https://placehold.co/240x240/000000/FFF?text=video' }}" 
             alt="Video thumbnail">
        
        {{-- Overlay com ícone de Play --}}
        <div class="absolute inset-0 flex items-center justify-center bg-black-1/50 rounded-xxs">
            <x-shared.fragments.icon type="outlined" fill icon="play_arrow" class="!text-white !text-[32px]" />
        </div>
        
        {{-- Timestamp --}}
        <div class="absolute w-full bottom-0 text-right right-0 p-xxs bg-gradient-to-b from-transparent to-black-1/50">
            <x-shared.typography.body size="sm" class="text-white">{{ $media->created_at->format('H:i') }}</x-shared.typography.body>
        </div>
    </div>

    {{-- PLAYER DE VÍDEO (visível quando isPlaying é true) --}}
    <div x-show="isPlaying" style="display: none;">
        <video 
            class="w-full h-full rounded-sm"  
            src="{{ $media->url }}" 
            controls 
            autoplay
            preload="auto"
        >
            Seu navegador não suporta o player de vídeo.
        </video>
    </div>
</div>