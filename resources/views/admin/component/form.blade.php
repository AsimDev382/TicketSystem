{{-- with form data --}}

@props([
    'method' => 'POST',
    'action' => ''
])

<form action="{{ $action }}" method="{{ $method === 'GET' ? 'GET' : 'POST' }}" {{ $attributes }}>
@csrf
    @unless (in_array($method, ['GET', 'POST']))
        @method($method)
    @endunless
    {{ $slot }}
</form>

{{-- with form data --}}

{{-- <x-form action="abc" method="GET or POST or DELETE or PUT">
</x-form> --}}
