@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Informasi
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($information, ['route' => ['information.update', $information->id], 'method' => 'patch']) !!}

                        @include('admin.information.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection