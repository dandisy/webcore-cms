@extends('layouts.app')

@section('css')
    <style>
        table textarea.form-control {
            height: 234px;
        }
        tbody tr td {
            position: relative;
        }
        tbody .btn-group-query {
            position: absolute;
            bottom: 8px;
            /*padding: 0 8px;*/
            width: 100%;
            right: 0;
        }
        tbody .btn-group-query .form-group {
            padding-right: 0;
            margin-left: 0;
        }
        table .select2 {
            width: 100% !important;
        }
        tbody tr td:first-child,
        tbody tr td:nth-child(2) {
            width: 43%;
        }
        tbody tr td:nth-child(3) {
            width: 14%;
        }
        .input-group {
            width: 100%;
        }
        .input-group-addon {
            width: 13%;
            text-align: left;
        }
        .input-group .form-control {
            width: 100%;
        }
        #column-alias .input-group {
            margin-bottom: 5px;
        }
    </style>
@endsection

@section('content')
    <section class="content-header">
        <h1>
            Data Source
        </h1>
        {{--<h1 class="pull-left">
            Data Source
        </h1>
        <div class="pull-right">            
            <!-- Version Field -->
            <div class="btn-group">
                <button type="button" class="btn btn-default">Version</button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Version 1</a></li>
                    <li><a href="#">Version 2</a></li>
                    <li><a href="#">Version 3</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Version Default</a></li>
                </ul>
            </div>

            <!-- Language Field -->
            <div class="btn-group">
                <button type="button" class="btn btn-default">Language</button>
                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a href="#">Language 1</a></li>
                    <li><a href="#">Language 2</a></li>
                    <li><a href="#">Language 3</a></li>
                    <li class="divider"></li>
                    <li><a href="#">Language Default</a></li>
                </ul>
            </div>
        </div>
        <div class="clearfix"></div>--}}
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'admin.dataSources.store']) !!}

                        @include('admin.data_sources.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
