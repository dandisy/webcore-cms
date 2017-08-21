@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Exception
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($exception, ['route' => ['exceptions.update', $exception->id], 'method' => 'patch']) !!}

                        @include('exceptions.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection