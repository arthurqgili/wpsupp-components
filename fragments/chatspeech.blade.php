@props([
    'avatarSrc', // Avatar image path
    'name', // Sender name
    'messages' => [], // Array of messages (content, sent_at, media_url, has_media)
    'senderType', // 'client' or 'user'
])

@if($messages)
<div class="flex gap-xxxs {{ $senderType === 'user' ? 'justify-end' : '' }}">
    @if($senderType === 'client')
    <div class="flex items-start">
        <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="sm" />
    </div>
    @endif

    <div class="flex flex-col gap-xxxs {{ $senderType === 'user' ? 'items-end' : '' }} max-w-full">
        @foreach($messages as $message)
        @php
        $formattedTime = \Carbon\Carbon::parse($message['sentAt'])->format('H:i');
        @endphp

        @if (isset($message['has_media']) && $message['has_media'])
            @if (strpos($message['media_url'], '.mp4') !== false)
            <div class="w-full max-w-[240px] min-h-xxxl relative">
                <video id="video_{{ $loop->index }}" class="w-full h-full object-cover rounded-xxs hidden" controls>
                    <source src="{{ $message['media_url'] }}" type="video/mp4">
                </video>
                <div id="overlay_{{ $loop->index }}" class="absolute inset-0 flex items-center justify-center bg-black/50 cursor-pointer rounded-xxs">
                    <span class="material-symbols-outlined text-white text-6xl">play_arrow</span>
                </div>
                <div class="absolute bottom-0 right-0 p-xs">
                    <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                </div>
            </div>
            @else
            <div class="w-full max-w-[240px] min-h-xxxl relative">
                <img class="w-full h-full object-cover rounded-xxs" src="{{ $message['media_url'] }}" alt="Message image">
                <div class="absolute bottom-0 right-0 p-xs">
                    <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                </div>
            </div>
            @endif
        @elseif ($message['content'])
        <div class="max-w-[240px] w-fit bg-black-1 flex flex-col p-xs rounded-xxs">
            <x-shared.typography.body size="sm" class="text-blue-1">{{ $name }}</x-shared.typography.body>
            <div class="flex w-full justify-between items-end gap-xs">
                <div class="flex-1 min-w-0 break-words">
                    <x-shared.typography.body size="md" class="text-white">
                        {{ $message['content'] }}
                    </x-shared.typography.body>
                </div>
                <div class="whitespace-nowrap">
                    <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                </div>
            </div>
        </div>
        @endif
        @endforeach
    </div>

    @if($senderType === 'user')
    <div class="flex items-start">
        <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="sm" />
    </div>
    @endif
</div>
@endif

<script>
document.addEventListener("DOMContentLoaded", function() {
    document.querySelectorAll("[id^='overlay_']").forEach((overlay) => {
        overlay.addEventListener("click", function() {
            const index = overlay.id.split("_")[1];
            const video = document.getElementById("video_" + index);
            
            if (video) {
                overlay.style.display = "none";
                video.classList.remove("hidden");
                video.play();
            }
        });
    });
});
</script>
