@props(['label', 'value' => '', 'id', 'type', 'name', 'hidden' => false, 'autocomplete' => 'off', 'variation' => 'default', 'placeholder' => ''])

<!-- Variação Message -->
@if ($variation === 'chatMessage')
    <div class="flex flex-col gap-xs items-start group relative {{ $hidden ? 'hidden' : '' }}">
        <input
            id="{{ $id }}"
            type="{{ $type }}"
            name="{{ $name }}"
            placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            {{ $attributes->merge(['class' => 'font-raleway font-[400] text-[12px] placeholder-muted-foreground bg-raised text-foreground border-0 rounded-sm h-xl px-sm w-full focus:border-0 focus:outline-0 focus:ring-0']) }}
        >
    </div>
@else
    <!-- Variação Default -->
    <div class="flex flex-col gap-xs items-start group relative {{ $hidden ? 'hidden' : '' }}" x-data="{ showPassword: false }">
        <!-- Label -->
        <label for="{{ $id }}">
            <x-shared.typography.label
                class="text-foreground dark:text-foreground group-hover:text-brand-hover group-focus-within:text-primary dark:group-focus-within:text-primary"
                size="md">{{ $label }}</x-shared.typography.label>
        </label>
        
        <!-- Input Padrão -->
        <input
            :type="showPassword ? 'text' : '{{ $type }}'"
            id="{{ $id }}"
            name="{{ $name }}"
            value="{{ $value }}"
            placeholder="{{ $placeholder }}"
            autocomplete="{{ $autocomplete }}"
            {{ $attributes->merge(['class' => 'font-raleway font-[400] text-[12px] placeholder-muted-foreground rounded-sm bg-transparent border text-foreground group-hover:border-primary-hover group-focus-within:border-primary dark:group-focus-within:border-primary dark:text-foreground focus-visible:outline-0 border-border dark:border-border px-sm h-lg w-full']) }}>

        <!-- Condicional para o campo de senha -->
        @if ($type === 'password')
            <button @click="showPassword = !showPassword" type="button"
                class="absolute bottom-0 right-0 flex items-center h-lg mr-sm focus-visible:outline-0 text-foreground dark:text-foreground hover:text-brand-hover dark:hover:text-brand-hover dark:focus-visible:text-primary focus-visible:text-primary-active">
                <span class="material-symbols-outlined !text-[16px] !leading-[125%]"
                    x-text="showPassword ? 'visibility_off' : 'visibility'"></span>
            </button>
        @endif
    </div>
@endif