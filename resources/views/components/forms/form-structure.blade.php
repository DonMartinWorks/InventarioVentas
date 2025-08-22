@props(['route', 'method' => 'POST', 'formMethod' => null])

<form action="{{ $route }}" method="{{ $method }}">
    @csrf

    @if ($formMethod)
        @method($formMethod)
    @endif

    {{ $slot }}
</form>
