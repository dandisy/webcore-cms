@extends('vendor.themes.normal.master')

@section('content')
    @if($items['page']['presentations'])
        <div class="col-sm-12">
            @include('vendor.themes.normal.position.top')
        </div>

        @include('vendor.themes.normal.position.left')

        @include('vendor.themes.normal.position.main_right')

        <div class="col-sm-12">
            @include('vendor.themes.normal.position.main')
        </div>
    @else
        <div class="col-sm-12">
            @include('vendor.themes.normal.position.widgets.top')
        </div>

        @include('vendor.themes.normal.position.widgets.left')

        <div class="col-sm-12">
            @include('vendor.themes.normal.position.widgets.main')
        </div>

        @include('vendor.themes.normal.position.widgets.right')

        <div class="col-sm-12">
            @include('vendor.themes.normal.position.widgets.bottom')
        </div>
    @endif
@endsection