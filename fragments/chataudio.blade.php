@props(['media'])

{{--
  Audio Player Component (v3 - Alpine v2 Compatible)
--}}
<div
    class="w-full bg-black-1 flex flex-col gap-xxs p-xs rounded-sm relative"
    x-data="{
        isInitialized: false,
        wavesurfer: null,
        isPlaying: false,
        currentTime: '0:00',
        duration: '0:00',
        audioUrl: '{{ $media->url }}',

        init() {
            if (this.isInitialized) return;

            try {
                // ... (a lógica de criação do wavesurfer continua a mesma)
                this.wavesurfer = WaveSurfer.create({
                    container: this.$refs.waveform,
                    waveColor: '#C6C6C5',
                    progressColor: '#FAFAFA',
                    height: 48,
                    barWidth: 2,
                    barGap: 2,
                    cursorWidth: 0,
                    responsive: true,
                });

                this.wavesurfer.load(this.audioUrl);

                this.wavesurfer.on('ready', () => {
                    this.duration = this.formatTime(this.wavesurfer.getDuration());
                    this.currentTime = this.formatTime(0);
                });
                this.wavesurfer.on('audioprocess', () => {
                    this.currentTime = this.formatTime(this.wavesurfer.getCurrentTime());
                });
                this.wavesurfer.on('finish', () => {
                    this.isPlaying = false;
                    this.wavesurfer.seekTo(0);
                });
                this.wavesurfer.on('error', (e) => console.error('WaveSurfer error:', e));

                this.isInitialized = true;
            } catch (error) {
                console.error('Failed to create WaveSurfer instance:', error);
            }
        },

        togglePlay() {
            if (!this.wavesurfer) return;
            this.wavesurfer.playPause();
            this.isPlaying = this.wavesurfer.isPlaying();
        },
        
        formatTime(seconds) {
            const date = new Date(null);
            date.setSeconds(seconds);
            return date.toISOString().substr(14, 5);
        },
    }"
    x-init="init()"
    x-on:livewire:before-element-remove="if (wavesurfer) wavesurfer.destroy()"
>
    {{-- O HTML interno do player não muda --}}
    <div class="flex items-center gap-xs">
        <button class="flex items-center justify-center w-lg h-xl" x-on:click="togglePlay()">
            <template x-if="!isPlaying">
                <x-shared.fragments.icon icon="play_arrow" type="outlined" fill="true" class="!text-white !text-[32px]" />
            </template>
            <template x-if="isPlaying">
                <x-shared.fragments.icon icon="pause" type="outlined" fill="true" class="!text-white !text-[32px]" />
            </template>
        </button>  
        <div x-ref="waveform" class="w-full cursor-pointer"></div>
        <div class="flex w-[calc(100%-40px)] absolute right-0 bottom-0 justify-between p-xxs">
            <x-shared.typography.body size="sm" class="text-gray-3">
                <span x-text="currentTime"></span>
            </x-shared.typography.body>
            <x-shared.typography.body size="sm" class="text-gray-3">
                {{ $media->created_at->format('H:i') }}
            </x-shared.typography.body>
        </div>
    </div>
</div>