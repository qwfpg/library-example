@for ($i = 1; $i <= 5; $i++)
    @if ($i <= $rating)
        <i class="fa fa-star checked"></i>
    @else
        <i class="fa fa-star"></i>
    @endif
@endfor
