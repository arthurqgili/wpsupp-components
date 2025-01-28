@props([
    'avatarSrc',           // Path to the avatar
    'name',                // Client's name
    'phone',               // Client's phone number
    'content',             // Content of the last message
    'sentAt',              // Timestamp for displaying time or date
    'alertBullet' => false,// Defines if the alert bullet is shown
    'hasMedia' => false,   // Whether the message has media
    'mediaType' => null,   // Media type: 'image', 'audio', 'video', 'attachment'
    'mediaDuration' => null,// Duration for media (audio/video)
    'current_agent_id' => null, // Assigned user for the "assigned" message type
    'isVerified' => false, // New prop to check if the user is verified
])

@php
    // Formatting the date or time
    $now = \Carbon\Carbon::now();
    $dateTime = \Carbon\Carbon::parse($sentAt);
    $formattedTimestamp = $dateTime->isToday()
        ? $dateTime->format('H:i') // Only time if it's today
        : ($dateTime->isYesterday()
            ? 'Ontem' // Yesterday
            : ($dateTime->diffInDays($now) < 7
                ? $dateTime->translatedFormat('l') // Day of the week
                : $dateTime->format('d/m/Y'))); // Full date for more than 7 days

    // Remove '-feira' from weekday names
    if ($formattedTimestamp != 'Ontem' && !preg_match('/\d{2}\/\d{2}\/\d{4}/', $formattedTimestamp)) {
        $formattedTimestamp = str_replace(
            ['segunda-feira', 'terça-feira', 'quarta-feira', 'quinta-feira', 'sexta-feira', 'sábado', 'domingo'],
            ['segunda', 'terça', 'quarta', 'quinta', 'sexta', 'sábado', 'domingo'],
            $formattedTimestamp
        );
    }

    // Set tag text based on current_agent_id
    $tagText = $current_agent_id ? $current_agent_id : null;

    // Check for the message to display if there's no last message but current_agent_id is set
    $defaultMessage = (!$hasMedia && empty($content) && $current_agent_id)
        ? "O atendimento foi atribuído a $current_agent_id."
        : null;

    // Format media duration for audio/video (convert seconds to minutes:seconds)
    if ($mediaType === 'audio' || $mediaType === 'video') {
        $duration = $mediaDuration; // Assuming $mediaDuration is the duration in seconds
        $formattedMediaDuration = gmdate("i:s", $duration); // Format to "minutes:seconds"
    }
@endphp

<div class="py-md px-lg hover:bg-blue-hover cursor-pointer flex items-center justify-between gap-xs border-b border-black-3">
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
                    <x-shared.typography.body size="md" class="text-gray-3" id="media-type">
                        {{ $formattedMediaDuration }} 
                    </x-shared.typography.body>
                @elseif ($mediaType === 'video')
                    <span class="material-symbols-outlined !text-gray-3 !text-xs">videocam</span>
                    <x-shared.typography.body size="md" class="text-gray-3" id="media-type">
                        {{ $formattedMediaDuration }} 
                    </x-shared.typography.body>
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
            <x-shared.typography.body size="md" class="text-gray-3 max-w-44 " id="assigned-message">
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
            <x-shared.fragments.usertag size="xs" type="active" class="text-blue-2" id="user-tag">
                {{ $tagText }}
            </x-shared.fragments.usertag>
        @endif
    </div>
</div>
