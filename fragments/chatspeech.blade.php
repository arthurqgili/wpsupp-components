@props([
    'avatarSrc',        // URL do avatar
    'name',             // Nome do usuário
    'messages' => [],   // Array de mensagens
    'senderType',       // Tipo do remetente ('user' ou 'client')
])

@if($messages)
    <div class="flex flex-col gap-xxxs {{ $senderType === 'user' ? 'justify-end' : '' }}">
        @foreach($messages as $message)
            @php
                $formattedTime = \Carbon\Carbon::parse($message['sentAt'])->format('H:i');
            @endphp

            <div class="flex gap-xxxs {{ $senderType === 'user' ? 'justify-end' : '' }}">

                <!-- Se o remetente for o 'client', exibe o avatar -->
                @if($senderType === 'client')
                    <div class="flex items-start">
                        <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="xs" />
                    </div>
                @endif

                <!-- Bloco de mensagens -->
                <div class="flex flex-col gap-xxxs {{ $senderType === 'user' ? 'items-end' : '' }} max-w-full">
                    
                    <!-- Verifica se a mensagem possui mídia -->
                    @if(isset($message['has_media']) && $message['has_media'])
                        @if(strpos($message['media_url'], '.mp4') !== false)
                            <!-- Mensagem de vídeo -->
                            <div class="w-full max-w-[240px] min-h-xxxl relative">
                                <video x-show="showVideo" class="w-full h-full object-cover rounded-xxs" controls>
                                    <source src="{{ $message['media_url'] }}" type="video/mp4">
                                </video>

                            </div>
                        @elseif(strpos($message['media_url'], '.mp3') !== false)
                            <!-- Mensagem de áudio -->
                            <x-shared.fragments.chataudio :avatarSrc="$avatarSrc" :name="$name" :audioSrc="$message['media_url']" :sentAt="$message['sentAt']" :senderType="$senderType" />
                        @else
                            <!-- Imagem -->
                            <div class="w-full max-w-[240px] min-h-xxxl relative">
                                <img class="w-full h-full object-cover rounded-xxs" src="{{ $message['media_url'] }}" alt="Imagem da mensagem">
                                <div class="absolute bottom-0 right-0 p-xs">
                                    <x-shared.typography.body size="sm" class="text-gray-3">{{ $formattedTime }}</x-shared.typography.body>
                                </div>
                            </div>
                        @endif
                    @elseif ($message['content'])
                        <!-- Mensagem de texto -->
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
                </div>

                <!-- Se o remetente for o 'user', exibe o avatar -->
                @if($senderType === 'user')
                    <div class="flex items-start">
                        <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="xs" />
                    </div>
                @endif
            </div> <!-- Fim do container da mensagem -->
        @endforeach
    </div>
@endif
