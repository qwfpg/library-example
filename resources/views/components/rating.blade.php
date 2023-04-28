@for ($i = 1; $i <= 5; $i++)
    @if ($i <= $rating)
        <i style="font-style: normal">⭐</i>

    @else
        <i style="font-style: normal">☆</i>
    @endif
@endfor
