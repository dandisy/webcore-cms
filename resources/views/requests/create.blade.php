@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Request
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['url' => 'requests/store']) !!}

                        @include('requests.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
