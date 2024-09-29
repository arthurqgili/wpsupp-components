@props(['label', 'value' => '', 'id', 'type', 'name', 'hidden' => false, 'autocomplete' => 'off'])

<div class="flex flex-col gap-xs items-start group relative {{ $hidden ? 'hidden' : '' }}" x-data="{ showPassword: false }">
    <label for="{{ $id }}">
        <x-shared.typography.label
            class="text-black-1 dark:text-white group-hover:text-blue-2 group-focus-within:text-blue-1 dark:group-focus-within:text-blue-1"
            size="md">{{ $label }}</x-shared.typography.label>
    </label>
    <input :type="showPassword ? 'text' : '{{ $type }}'" id="{{ $id }}"
        class="font-raleway font-[400] text-[12px] placeholder-gray-3 rounded-sm bg-transparent border text-black-1 group-hover:border-blue-2 group-focus-within:border-blue-1 dark:group-focus-within:border-blue-1 dark:text-white focus-visible:outline-0 border-black-1 dark:border-white px-sm h-lg w-full"
        name="{{ $name }}" value="{{ $value }}" placeholder="" autocomplete="{{ $autocomplete }}">

    <!-- Conditional rendering for password field -->
    @if ($type === 'password')
        <button @click="showPassword = !showPassword" type="button"
            class="absolute bottom-0 right-0 flex items-center h-lg mr-sm focus-visible:outline-0 text-black-1 dark:text-white hover:text-blue-2 dark:hover:text-blue-2 dark:focus-visible:text-blue-1 focus-visible:text-blue-4">
            <span class="material-symbols-outlined !text-[16px] !leading-[125%]"
                x-text="showPassword ? 'visibility_off' : 'visibility'"></span>
        </button>
    @endif
</div>
