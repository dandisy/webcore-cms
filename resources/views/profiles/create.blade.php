@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Profile
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        @include('flash::message')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['url' => 'profiles/store']) !!}

                        @include('profiles.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
