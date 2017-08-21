@extends('layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Request
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($request, ['route' => ['requests.update', $request->id], 'method' => 'patch']) !!}

                        @include('requests.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection