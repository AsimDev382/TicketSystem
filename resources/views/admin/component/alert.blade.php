{{-- <div class="alert alert-{{ $type ?? 'danger' }} w-100">
    {{ $message }}
</div> --}}

{{-- <div {{ $attributes->merge(['class' => 'w-100 alert alert-'.$type]) }}>
    {{ $message }}
</div> --}}

{{-- conditional base dismissible --}}
<div {{ $attributes->class(['alert-dismissible fade show', $dismissible])->merge(['class' => 'w-100 alert alert-'.$type, 'role' => $attributes->prepends('alert')]) }}>
    {{ $message }}

    @if($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    @endif
</div>

{{-- Show html code --}}
{{-- <div {{ $attribute->merge(['class' => 'w-100 alert alert-'.$type]) }}>
    {{ $slot }}
</div> --}}
