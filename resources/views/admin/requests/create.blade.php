@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Permohonan Informasi
        </h1>
    </section>
    <div class="content">
        @include('adminlte-templates::common.errors')
        <div class="box box-primary">

            <div class="box-body">
                <div class="row">
                    {!! Form::open(['route' => 'requests.store']) !!}

                        @include('admin.requests.fields')

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
