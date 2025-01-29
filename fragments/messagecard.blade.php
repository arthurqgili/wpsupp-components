@props([
    'avatarSrc',           // Avatar path
    'name',                // Client's name
    'phone',               // Client's phone number
    'content',             // Last message content
    'sentAt',              // Timestamp for date/time
    'alertBullet' => false,// Show alert bullet
    'hasMedia' => false,   // Message has media
    'mediaType' => null,   // Media type ('image', 'audio', 'video', 'attachment')
    'mediaDuration' => null,// Media duration (audio/video)
    'current_agent_id' => null, // Assigned user for message
    'isVerified' => false, // User verification
    'active' => false,     // Active state for card
])

@php
    // Formatting date/time
    $now = \Carbon\Carbon::now();
    $dateTime = \Carbon\Carbon::parse($sentAt);
    $formattedTimestamp = $dateTime->isToday() 
        ? $dateTime->format('H:i') 
        : ($dateTime->isYesterday() 
            ? 'Ontem' 
            : ($dateTime->diffInDays($now) < 7 
                ? $dateTime->translatedFormat('l') 
                : $dateTime->format('d/m/Y')));

    // Simplify weekday names
    if ($formattedTimestamp != 'Ontem' && !preg_match('/\d{2}\/\d{2}\/\d{4}/', $formattedTimestamp)) {
        $formattedTimestamp = str_replace(
            ['segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado', 'domingo'],
            ['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado', 'domingo'],
            $formattedTimestamp
        );
    }

    // Set agent tag text
    $tagText = $current_agent_id ? $current_agent_id : null;

    // Default message when no content and agent assigned
    $defaultMessage = (!$hasMedia && empty($content) && $current_agent_id)
        ? "O atendimento foi atribuído a $current_agent_id."
        : null;

    // Format media duration (audio/video)
    if ($mediaType === 'audio' || $mediaType === 'video') {
        $duration = $mediaDuration;
        $formattedMediaDuration = gmdate("i:s", $duration);
    }
@endphp

<div class="py-md px-lg {{ $active ? 'bg-black-3 cursor-default' : 'hover:bg-black-2 cursor-pointer' }} flex items-center justify-between gap-xs border-b border-black-3">
    <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="lg" :verified="$isVerified" />

    <div class="flex gap-xs flex-col flex-grow">
        <div class="flex gap-xs items-center">
            <x-shared.typography.label size="md" class="text-white" id="client-name">
                {{ $name }}
            </x-shared.typography.label>
            <x-shared.typography.body size="md" class="text-gray-3" id="client-phone">
                {{ $phone }}
            </x-shared.typography.body>
        </div>

        @if ($hasMedia)
            <div class="flex items-center gap-xxxs">
                @if ($mediaType === 'image')
                    <span class="material-symbols-outlined !text-gray-3 !text-xs">broken_image</span>
                    <x-shared.typography.body size="md" class="text-gray-3" id="media-type">Foto</x-shared.typography.body>
                @elseif ($mediaType === 'audio')
                    <span class="material-symbols-outlined !text-gray-3 !text-xs">mic</span>
                    <x-shared.typography.body size="md" class="text-gray-3" id="media-type">{{ $formattedMediaDuration }}</x-shared.typography.body>
                @elseif ($mediaType === 'video')
                    <span class="material-symbols-outlined !text-gray-3 !text-xs">videocam</span>
                    <x-shared.typography.body size="md" class="text-gray-3" id="media-type">{{ $formattedMediaDuration }}</x-shared.typography.body>
                @elseif ($mediaType === 'attachment')
                    <span class="material-symbols-outlined !text-gray-3 !text-xs">attach_file</span>
                    <x-shared.typography.body size="md" class="text-gray-3" id="media-type">Anexo</x-shared.typography.body>
                @endif
            </div>
        @elseif (!empty($content))
            <x-shared.typography.body size="md" class="text-gray-3 max-w-44 truncate" id="last-message">
                {{ e($content) }}
            </x-shared.typography.body>
        @elseif ($defaultMessage)
            <x-shared.typography.body size="md" class="text-gray-3 max-w-44" id="assigned-message">
                {{ $defaultMessage }}
            </x-shared.typography.body>
        @endif
    </div>

    <div class="flex flex-col w-16 items-center gap-xs">
        <x-shared.typography.body size="md" class="text-gray-3" id="message-timestamp">
            {{ $formattedTimestamp }}
        </x-shared.typography.body>

        @if ($alertBullet)
            <x-shared.fragments.alertbullet :color="'blue-1'" />
        @endif

        @if ($tagText)
            <x-shared.fragments.usertag size="xs" class="text-blue-2" id="user-tag">
                {{ $tagText }}
            </x-shared.fragments.usertag>
        @endif
    </div>
</div>
