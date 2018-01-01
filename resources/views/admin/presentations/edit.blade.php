@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Presentation
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($presentation, ['route' => ['admin.presentations.update', $presentation->id], 'method' => 'patch']) !!}

                        @include('admin.presentations.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection