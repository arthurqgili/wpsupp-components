@props([
    'avatarSrc',
    'name',
    'message',
    'senderType',
])

{{--
  Message Bubble Router Component

  This component acts as a router. It inspects the incoming `$message` object
  to determine if it contains media.

  - If media is present, it uses a `@switch` to delegate rendering to the
    appropriate component (`chatimage`, `chataudio`, `chatvideo`).
  - If no media is present, it renders a standard text message bubble.
--}}
@php
    // Check if the media collection is not empty.
    $hasMedia = $message->media->isNotEmpty();
    // If it has media, get the first item from the collection.
    $media = $hasMedia ? $message->media->first() : null;
@endphp

<div class="flex gap-xs w-full {{ $senderType === 'user' ? 'flex-row-reverse' : 'justify-start' }}">
    <div class="flex items-start">
        <x-shared.fragments.useravatar :src="$avatarSrc" size="sm" />
    </div>

    <div class="flex {{ $senderType === 'user' ? 'justify-end' : '' }} max-w-[320px] w-full">
        @if ($hasMedia)
            @switch($media->type)
                @case(\App\Enums\MediaType::VIDEO)
                    <x-shared.fragments.chatvideo :media="$media" />
                    @break
                @case(\App\Enums\MediaType::AUDIO)
                    <x-shared.fragments.chataudio :media="$media" />
                    @break
                @default
                    <x-shared.fragments.chatimage :media="$media" />
            @endswitch
        @else
            <div class="max-w-[320px] w-fit bg-black-1 flex flex-col p-xs rounded-sm">
                <x-shared.typography.body size="sm" class="text-blue-1">{{ $name }}</x-shared.typography.body>
                <div class="flex w-full justify-between items-end gap-xs">
                    <div class="flex-1 min-w-0 break-words">
                        <x-shared.typography.body size="md" class="text-white">
                            {{ $message->content }}
                        </x-shared.typography.body>
                    </div>
                    <div class="whitespace-nowrap mb-[-4px] mr-[-4px]">
                        <x-shared.typography.body size="sm" class="text-gray-3">
                            {{ $message->created_at->format('H:i') }}
                        </x-shared.typography.body>
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>