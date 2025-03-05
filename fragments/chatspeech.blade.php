@props([
'avatarSrc', // URL of the avatar
'name', // User's name
'messages' => [], // Array of messages
'senderType', // Sender type ('user' or 'client')
])

@if($messages)
<div class="flex flex-col gap-xs {{ $senderType === 'user' ? 'justify-end' : '' }}">
    @php
    // Initialize an array to group consecutive text messages
    $groupedTextMessages = [];
    @endphp

    @foreach($messages as $index => $message)
    @php
    // Format the message timestamp (HH:mm)
    $formattedTime = \Carbon\Carbon::parse($message['sentAt'])->format('H:i');
    
    // Check if the current message is a text message
    $isTextMessage = !isset($message['has_media']) || !$message['has_media'];
    
    // Check if the next message is also a text message
    $nextMessageIsText = isset($messages[$index + 1]) && (!isset($messages[$index + 1]['has_media']) || !$messages[$index + 1]['has_media']);
    @endphp

    @if($isTextMessage)
    @php
    // Add the text message to the group
    $groupedTextMessages[] = $message;
    @endphp
    @endif

    @if(!$isTextMessage || !$nextMessageIsText || $index === count($messages) - 1)
    @if(count($groupedTextMessages))
    <!-- Grouped text messages -->
    <div class="flex gap-xxxs {{ $senderType === 'user' ? 'justify-end' : '' }}">
        @if($senderType === 'client')
        <div class="flex items-start">
            <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="xs" />
        </div>
        @endif
        <div class="flex flex-col gap-xxxs {{ $senderType === 'user' ? 'items-end' : '' }} max-w-full">
            @foreach($groupedTextMessages as $textMessage)
            <div class="max-w-[240px] w-fit bg-black-1 flex flex-col p-xs rounded-xxs">
                <x-shared.typography.body size="sm" class="text-blue-1">{{ $name }}</x-shared.typography.body>
                <div class="flex w-full justify-between items-end gap-xs">
                    <div class="flex-1 min-w-0 break-words">
                        <x-shared.typography.body size="md" class="text-white">
                            {{ $textMessage['content'] }}
                        </x-shared.typography.body>
                    </div>
                    <div class="whitespace-nowrap">
                        <x-shared.typography.body size="sm" class="text-gray-3">{{ \Carbon\Carbon::parse($textMessage['sentAt'])->format('H:i') }}</x-shared.typography.body>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @if($senderType === 'user')
        <div class="flex items-start">
            <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="xs" />
        </div>
        @endif
    </div>
    @php
    // Reset the grouped messages array after rendering
    $groupedTextMessages = [];
    @endphp
    @endif

    @if(!$isTextMessage)
    <!-- Media message (video, audio, or image) -->
    <div class="flex gap-xxxs {{ $senderType === 'user' ? 'justify-end' : '' }}">
        @if($senderType === 'client')
        <div class="flex items-start">
            <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="xs" />
        </div>
        @endif
        <div class="flex flex-col gap-xxxs {{ $senderType === 'user' ? 'items-end' : '' }} max-w-full">
            @if(strpos($message['media_url'], '.mp4') !== false)
            <!-- Video message -->
            <div x-data="{ showControls: false, paused: true }" class="w-full max-w-[240px] min-h-xxxl relative">
                <video
                    x-ref="video"
                    class="w-full h-full object-cover rounded-xxs"
                    :controls="showControls"
                    @play="showControls = true; paused = false"
                    @pause="paused = true"
                    @loadedmetadata="$refs.video.currentTime = 0"
                    poster="">
                    <source src="{{ $message['media_url'] }}" type="video/mp4">
                </video>

                <!-- Play icon (visible when paused) -->
                <div
                    x-show="paused"
                    class="absolute inset-0 flex items-center justify-center cursor-pointer rounded-xxs"
                    @click="$refs.video.play(); showControls = true; paused = false">
                    <span class="material-symbols-outlined text-white text-4xl">play_arrow</span>
                </div>

                <!-- Timestamp at the bottom right corner -->
                <div class="absolute bottom-0 right-0 p-xs">
                    <x-shared.typography.body size="sm" class="text-gray-3">
                        {{ $formattedTime }}
                    </x-shared.typography.body>
                </div>
            </div>

            @elseif(strpos($message['media_url'], '.mp3') !== false)
            <!-- Audio message -->
            <x-shared.fragments.chataudio 
                :avatarSrc="$avatarSrc"
                :name="$name"
                :audioSrc="$message['media_url']"
                :sentAt="$message['sentAt']"
                :senderType="$senderType" 
            />
            @else
            <!-- Image message -->
            <div class="w-full max-w-[240px] min-h-xxxl relative">
                <img class="w-full h-full object-cover rounded-xxs" src="{{ $message['media_url'] }}" alt="Message image">
                <div class="absolute bottom-0 right-0 p-xs">
                    <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                </div>
            </div>
            @endif
        </div>
        @if($senderType === 'user')
        <div class="flex items-start">
            <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="xs" />
        </div>
        @endif
    </div>
    @endif
    @endif
    @endforeach
</div>
@endif
