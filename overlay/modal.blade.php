@props([
    'title' => 'title',
    'size' => 'xs',
    'padding' => 'xs',
    'modalname' => null,
    'currentStep' => 1,
    'totalSteps' => 1,
    'alwaysOpen' => false,
    'canClose' => true,
])

@php
    $maxWidthClass = match($size) {
        'sm' => 'max-w-screen-sm',
        'md' => 'max-w-screen-md',
        'lg' => 'max-w-screen-lg',
        'xl' => 'max-w-screen-xl',
        default => 'max-w-screen-xs',
    };
    $paddingClass = match($padding) {
        'xxs' => 'p-xxs',
        'sm' => 'p-sm',
        'md' => 'p-md',
        'lg' => 'p-lg',
        default => 'p-xs',
    };
@endphp

@if($alwaysOpen)
    {{-- Modal Always Open (Wizard/Special Cases) --}}
    <div x-data="{ currentStep: {{ $currentStep }}, totalSteps: {{ $totalSteps }}, nextStep() { this.currentStep = this.currentStep >= this.totalSteps ? this.totalSteps : this.currentStep + 1; }, previousStep() { this.currentStep = this.currentStep <= 1 ? 1 : this.currentStep - 1; } }"
         class="fixed top-0 left-0 flex items-center justify-center w-full h-full z-50">

        {{-- Backdrop --}}
        <div class="absolute h-full w-full bg-black/50"></div>

        {{-- Modal Card --}}
        <div class="bg-muted flex flex-col w-full {{ $maxWidthClass }} p-sm gap-sm rounded-sm relative z-10">
            <div class="flex items-center justify-between">
                <x-shared.typography.body class="text-foreground" size="md">{{ $title }}</x-shared.typography.body>

                @if($canClose)
                    <button class="group" type="button" @click="currentStep = 1">
                        <span class="!text-[16px] !leading-[125%] material-symbols-outlined text-foreground group-hover:text-muted-foreground">close</span>
                    </button>
                @endif
            </div>

            <div>
                @if (isset($sidebar))
                    <div class="{{ $paddingClass }}">{{ $sidebar }}</div>
                @endif
                <div class="{{ $paddingClass }}">{{ $slot }}</div>
            </div>

            @if (isset($footer))
                <div class="p-xs">{{ $footer }}</div>
            @endif
        </div>
    </div>
@else
    {{-- Modal controlado por Alpine (código original) --}}
    <template x-shared.if="{{ $modalname }}">
        <div x-data="{ currentStep: {{ $currentStep }}, totalSteps: {{ $totalSteps }}, nextStep() { this.currentStep = this.currentStep >= this.totalSteps ? this.totalSteps : this.currentStep + 1; }, previousStep() { this.currentStep = this.currentStep <= 1 ? 1 : this.currentStep - 1; } }" x-shared.show="{{ $modalname }}"
            class="fixed top-0 left-0 flex items-center justify-center w-full h-full " x-shared.cloak>
            <div class="bg-muted flex flex-col w-full {{ $maxWidthClass }} p-sm gap-sm rounded-sm">
                <div class="flex items-center justify-between">
                    <x-shared.typography.body class="text-foreground" size="md">{{ $title }}</x-shared.typography.body>
                    <button class="group" type="button" @click="{{ $modalname }} = false; currentStep = 1"
                        class="close">
                        <span
                            class="!text-[16px] !leading-[125%] material-symbols-outlined text-foreground group-hover:text-muted-foreground">close</span>
                    </button>
                </div>
                <div>
                    @if (isset($sidebar))
                        <div class="{{ $paddingClass }}">
                            {{ $sidebar }}
                        </div>
                    @endif
                    <div class="{{ $paddingClass }}">
                        {{ $slot }}
                    </div>
                </div>
                @if (isset($footer))
                    <div class="p-xs">
                        {{ $footer }}
                    </div>
                @endif
            </div>
            <div class="absolute h-full w-full bg-black/50 z-[-1]" @click="{{ $modalname }} = false; currentStep = 1">
            </div>
        </div>
    </template>
@endif
