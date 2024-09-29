<x-shared.typography.label class="text-red-1" size="md">

    @if ($errors->any())
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    {{ $slot }}
</x-shared.typography.label>
