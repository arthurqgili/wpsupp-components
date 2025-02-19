@props([
    'avatarSrc', // Path to the client's or admin's avatar
    'name', // Name of the client or admin
    'phone', // Client's phone number
    'content', // Content of the last message
    'sentAt', // Date and time of the last message
    'sender', // Defines whether the message is from 'client' or 'admin'
    'lastSender' // Identifier of the last sender (for sequence control)
])

@php
    // Format the date to extract only the time
    $formattedTime = \Carbon\Carbon::parse($sentAt)->format('H:i');
@endphp

@if($sender === 'client')
    <!-- Structure for Client -->
    @if($lastSender !== 'client')
        <div class="flex gap-xxxs">
            <!-- Avatar for Client -->
            <div class="flex items-start">
                <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="sm" />
            </div>

            <!-- Message Box -->
            <div class="flex flex-col gap-xxxs">
                <div class="max-w-[240px] w-fit bg-black-1 flex flex-col p-xs rounded-xxs">
                    <x-shared.typography.body size="sm" class="text-blue-1">{{ $name }}</x-shared.typography.body>
                    <div class="flex w-full justify-between items-end gap-xs">
                        <!-- Message Content -->
                        <div class="flex-1 min-w-0 break-words">
                            <x-shared.typography.body size="md" class="text-white">
                                {{ $content }}
                            </x-shared.typography.body>
                        </div>
                        <!-- Time -->
                        <div class="whitespace-nowrap">
                            <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <!-- Message Box without Avatar and Name (same sender) -->
        <div class="flex gap-xxxs">
            <div class="flex flex-col gap-xxxs">
                <div class="max-w-[240px] w-fit bg-black-1 flex flex-col p-xs rounded-xxs">
                    <div class="flex w-full justify-between items-end gap-xs">
                        <!-- Message Content -->
                        <div class="flex-1 min-w-0 break-words">
                            <x-shared.typography.body size="md" class="text-white">
                                {{ $content }}
                            </x-shared.typography.body>
                        </div>
                        <!-- Time -->
                        <div class="whitespace-nowrap">
                            <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@else
    <!-- Structure for Admin -->
    @if($lastSender !== 'admin')
        <div class="flex gap-xxxs justify-end">
            <!-- Message Box -->
            <div class="flex flex-col gap-xxxs">
                <div class="max-w-[240px] w-fit bg-black-1 flex flex-col p-xs rounded-xxs">
                    <x-shared.typography.body size="sm" class="text-blue-1">{{ $name }}</x-shared.typography.body>
                    <div class="flex w-full justify-between items-end gap-xs">
                        <!-- Message Content -->
                        <div class="flex-1 min-w-0 break-words">
                            <x-shared.typography.body size="md" class="text-white">
                                {{ $content }}
                            </x-shared.typography.body>
                        </div>
                        <!-- Time -->
                        <div class="whitespace-nowrap">
                            <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Avatar for Admin (after the time div) -->
            <div class="flex items-start">
                <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="sm" />
            </div>
        </div>
    @else
        <!-- Message Box without Avatar and Name (same sender) -->
        <div class="flex gap-xxxs justify-end">
            <div class="flex flex-col gap-xxxs">
                <div class="max-w-[240px] w-fit bg-black-1 flex flex-col p-xs rounded-xxs">
                    <div class="flex w-full justify-between items-end gap-xs">
                        <!-- Message Content -->
                        <div class="flex-1 min-w-0 break-words">
                            <x-shared.typography.body size="md" class="text-white">
                                {{ $content }}
                            </x-shared.typography.body>
                        </div>
                        <!-- Time -->
                        <div class="whitespace-nowrap">
                            <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endif
