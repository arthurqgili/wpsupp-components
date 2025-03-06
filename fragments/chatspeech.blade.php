@props([
    'avatarSrc', // URL do avatar
    'name', // Nome do usuário
    'messages' => [], // Array de mensagens
    'senderType', // Tipo do remetente ('user' ou 'client')
])

@if($messages)
<div class="flex flex-col gap-xs {{ $senderType === 'user' ? 'justify-end' : '' }}">
    @php
        $groupedTextMessages = [];
    @endphp

    @foreach($messages as $index => $message)
        @php
            $formattedTime = \Carbon\Carbon::parse($message['sentAt'])->format('H:i');
            $isTextMessage = !isset($message['has_media']) || !$message['has_media'];
            $nextMessageIsText = isset($messages[$index + 1]) && (!isset($messages[$index + 1]['has_media']) || !$messages[$index + 1]['has_media']);
        @endphp

        @if($isTextMessage)
            @php
                $groupedTextMessages[] = $message;
            @endphp
        @endif

        @if(!$isTextMessage || !$nextMessageIsText || $index === count($messages) - 1)
            @if(count($groupedTextMessages))
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
                                        <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
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
                    $groupedTextMessages = [];
                @endphp
            @endif

            @if(!$isTextMessage)
                <div class="flex gap-xxxs {{ $senderType === 'user' ? 'justify-end' : '' }}">
                    @if($senderType === 'client')
                        <div class="flex items-start">
                            <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="xs" />
                        </div>
                    @endif
                    <div class="flex flex-col gap-xxxs {{ $senderType === 'user' ? 'items-end' : '' }} max-w-full">
                        @if($message['media_type'] === 'video')
                            <!-- Vídeo como thumbnail com overlay de play -->
                            <div class="w-full max-w-[240px] min-h-xxxl relative cursor-pointer" data-video-url="{{ $message['media_url'] }}">
                                <img class="w-full h-full object-cover rounded-xxs aspect-[4/3]" src="{{ $message['thumbnail_url'] }}" alt="Video thumbnail">
                                <div class="absolute inset-0 flex items-center justify-center bg-black/50 rounded-xxs">
                                    <span class="material-symbols-outlined text-white text-4xl">play_arrow</span>
                                </div>
                                <div class="absolute bottom-0 right-0 p-xs">
                                    <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                                </div>
                            </div>

                        @elseif($message['media_type'] === 'audio')
                            <!-- Mensagem de áudio -->
                            <x-shared.fragments.chataudio 
                                :avatarSrc="$avatarSrc"
                                :name="$name"
                                :audioSrc="$message['media_url']"
                                :sentAt="$message['sentAt']"
                                :senderType="$senderType" 
                            />
                        @else
                            <!-- Mensagem com imagem -->
                            <div class="w-full max-w-[240px] min-h-xxxl relative">
                                <img class="w-full h-full object-cover rounded-xxs aspect-[4/3]" src="{{ $message['media_url'] }}" alt="Message image">
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
