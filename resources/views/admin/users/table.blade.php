@section('css')
    @include('admin.layouts.datatables_css')
@endsection

{!! $dataTable->table(['width' => '100%']) !!}

@section('scripts')
    @include('admin.layouts.datatables_js')
    {!! $dataTable->scripts() !!}
@endsection