<div class="top-content" style="position:relative">
    @include('vendor.themes.normal.position.top_left_float')
    
    @foreach (@$items['page']['presentations'] as $item)
        @if($item['position'] === 'normal/position/top')
            @include('vendor.components.'.$item['component']['view'])
        @endif
    @endforeach
</div>