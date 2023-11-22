<a {{ $attributes->merge(['class' => 'btn btn-'.$classes]) }} title="{{ $intitule }}">
    <i {{ $attributes->merge(['class' => 'bi '.$icon]) }}></i> 
    {{ $slot }}
</a>