@props([
    'avatarSrc', // Avatar URL
    'name', // Sender's name
    'audioSrc', // Audio file URL
    'sentAt', // Message sent time
    'senderType', // 'client' or 'user'
])

@php
    $formattedTime = \Carbon\Carbon::parse($sentAt)->format('H:i'); // Format sent time
    $isClient = $senderType === 'client'; // Check if sender is a client
    $uniqueId = uniqid('audio_'); // Generate unique ID for each audio
@endphp

<div class="w-[240px] bg-black-1 flex flex-col gap-xxs p-xs rounded-sm">
    <x-shared.typography.body size="sm" class="text-blue-1">{{ $name }}</x-shared.typography.body>

    <!-- First line: Avatar and audio player (waveform) -->
    <div class="flex h-md {{ $isClient ? 'flex-row' : 'flex-row-reverse' }}">
        <x-shared.fragments.useravatar src="{{ $avatarSrc }}" size="md" />

        <div class="flex flex-col flex-1">
            <div class="flex items-center {{ $isClient ? 'justify-start pl-xxs' : 'justify-end pr-xxs' }}">
                <button id="playButton_{{ $uniqueId }}" class="play-button">
                    <x-shared.fragments.icon 
                        icon="play_arrow" 
                        type="outlined" 
                        fill="true" 
                        class="text-white text-sm" 
                    />
                </button>

                <div id="waveform_{{ $uniqueId }}" class="w-full"></div>
            </div>
        </div>
    </div>

    <!-- Second line: Timer and formatted time -->
    <div class="flex justify-between text-gray-3 pl-md">
        <span id="currentTime_{{ $uniqueId }}" class="font-raleway font-[400] text-[10px] text-gray-1">0:00</span>
        <x-shared.typography.body size="sm">{{ $formattedTime }}</x-shared.typography.body>
    </div>
</div>

<audio id="audioPlayer_{{ $uniqueId }}" class="hidden">
    <source src="{{ $audioSrc }}" type="audio/mp3">
</audio>

<script>
   document.addEventListener('DOMContentLoaded', function () {
    const audioSrc = "{{ $audioSrc }}";
    if (!audioSrc) {
        console.error("Invalid audio URL.");
        return;
    }

    const uniqueId = "{{ $uniqueId }}";

    const wavesurfer = WaveSurfer.create({
        container: `#waveform_${uniqueId}`,
        waveColor: '#FFFFFF',
        progressColor: '#7BAEF9',
        height: 24,
        barWidth: 2,
        cursorWidth: 0,
        cursorColor: '#0000FF',
        responsive: true,
    });

    wavesurfer.load(audioSrc);

    const playButton = document.getElementById(`playButton_${uniqueId}`);
    const currentTimeElement = document.getElementById(`currentTime_${uniqueId}`);

    function formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const sec = Math.floor(seconds % 60);
        return `${minutes}:${sec < 10 ? '0' : ''}${sec}`;
    }

    wavesurfer.on('audioprocess', function () {
        const currentTime = wavesurfer.getCurrentTime();
        currentTimeElement.textContent = formatTime(currentTime);
    });

    wavesurfer.on('ready', function () {
        const duration = wavesurfer.getDuration();
        currentTimeElement.textContent = formatTime(duration);
    });

    playButton.addEventListener('click', function() {
        wavesurfer.play();
    });
});
</script>
