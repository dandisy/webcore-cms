@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Regulasi
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'regulations.store']) !!}

                        @include('admin.regulations.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
