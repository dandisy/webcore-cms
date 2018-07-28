<h3>{{ $items['page']['title'] }}</h3>

<div class="table-responsive" style="overflow-x: auto">
  <table class="table table-condensed">
      <tr>
          @foreach ($items['data']->first()->first()->toArray() as $key => $val)
              <th>{{$key}}</th>
          @endforeach
      </tr>

    @foreach ($items['data']->first() as $item)
      <tr>
        @foreach ($item->toArray() as $val)
          <td>{{$val}}</td>
        @endforeach
      </tr>
    @endforeach
  </table>
</div>