@foreach (@$items['page']['presentations'] as $item)
    @if($item['position'] === 'normal/position/main')
        @include('vendor.components.'.$item['component']['view'])
    @endif
@endforeach