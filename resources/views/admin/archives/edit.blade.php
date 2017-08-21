@extends('admin.layouts.app')

@section('content')
    <section class="content-header">
        <h1>
            Archive
        </h1>
   </section>
   <div class="content">
       @include('adminlte-templates::common.errors')
       <div class="box box-primary">
           <div class="box-body">
               <div class="row">
                   {!! Form::model($archive, ['route' => ['archives.update', $archive->id], 'method' => 'patch']) !!}

                        @include('admin.archives.fields')

                   {!! Form::close() !!}
               </div>
           </div>
       </div>
   </div>
@endsection