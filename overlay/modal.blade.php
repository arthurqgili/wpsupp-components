@props([
    'title' => 'title',
    'size' => 'xs',
    'padding' => 'xs',
    'modalname' => null,
    'currentStep' => 1,
    'totalSteps' => 1,
])

<template x-if="{{ $modalname }}">
    <div x-data="{ currentStep: {{ $currentStep }}, totalSteps: {{ $totalSteps }}, nextStep() { this.currentStep = this.currentStep >= this.totalSteps ? this.totalSteps : this.currentStep + 1; }, previousStep() { this.currentStep = this.currentStep <= 1 ? 1 : this.currentStep - 1; } }" x-show="{{ $modalname }}"
        class="fixed top-0 left-0 flex items-center justify-center w-full h-full " x-cloak>
        <div class="bg-black-2 flex flex-col w-full max-w-screen-{{ $size }} p-sm gap-sm rounded-sm">
            <div class="flex items-center justify-between">
                <x-typography.body class="text-white" size="md">{{ $title }}</x-typography.body>
                <button class="group" type="button" @click="{{ $modalname }} = false; currentStep = 1"
                    class="close">
                    <span
                        class="!text-[16px] !leading-[125%] material-symbols-outlined text-white group-hover:text-gray-3">close</span>
                </button>
            </div>
            <div>
                @if (isset($sidebar))
                    <div class="p-{{ $padding }}">
                        {{ $sidebar }}
                    </div>
                @endif
                <div class="p-{{ $padding }}">
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
