@props(['action', 'method'])

<form class="flex flex-col gap-sm" action="{{ $action }}" method="{{ $method }}">
    @csrf
    {{ $slot }}
</form>
