@props([
    'avatarSrc',        // URL of the avatar image
    'name',              // Name of the user
    'messages' => [],    // Array of messages to display
    'senderType',        // Type of sender (user or client)
])

@if($messages)
<div class="flex gap-xxxs {{ $senderType === 'user' ? 'justify-end' : '' }}">
    @if($senderType === 'client')
    <div class="flex items-start">
        <!-- Display client's avatar -->
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
            <!-- Video message with Alpine.js control -->
            <div x-data="{ showVideo: false }" class="w-full max-w-[240px] min-h-xxxl relative">
                <!-- Video player, shown when video is clicked -->
                <video x-show="showVideo" class="w-full h-full object-cover rounded-xxs" controls>
                    <source src="{{ $message['media_url'] }}" type="video/mp4">
                </video>
                <!-- Play button overlay when video is not shown -->
                <div x-show="!showVideo" @click="showVideo = true" class="absolute inset-0 flex items-center justify-center bg-black/50 cursor-pointer rounded-xxs">
                    <span class="material-symbols-outlined text-white text-6xl">play_arrow</span>
                </div>
                <div class="absolute bottom-0 right-0 p-xs">
                    <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                </div>
            </div>
            @else
            <!-- Image message with Lightbox using Alpine.js -->
            <div x-data="{ open: false }" class="w-full max-w-[240px] min-h-xxxl relative">
                <!-- Image thumbnail that opens the lightbox on click -->
                <img @click="open = true" class="w-full h-full object-cover rounded-xxs cursor-pointer" src="{{ $message['media_url'] }}" alt="Message image">
                <div class="absolute bottom-0 right-0 p-xs">
                    <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                </div>

                <!-- Lightbox modal when image is clicked -->
                <div x-show="open" class="fixed inset-0 bg-black-1/90 flex items-center justify-center z-50" @click="open = false" x-transition>
                    <img class="max-w-full max-h-full p-lg" src="{{ $message['media_url'] }}" alt="Full Image">
                </div>
            </div>
            @endif
        @elseif ($message['content'])
        <!-- Text message -->
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
        <!-- Display user's avatar -->
        <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="sm" />
    </div>
    @endif
</div>
@endif
