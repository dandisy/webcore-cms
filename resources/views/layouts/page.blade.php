@extends('layouts.master')

<div class="top-menu">
    <pre>
        {{ print_r($menu) }}
    </pre>
</div>

@section('content')
    <div class="container">
        <div class="row">
            @if($pageContent)
                {!! print_r($pageContent) !!}
            @else
                <div class="main-content no-content">
                    <div class="page-title">
                        <h3>{{ $slug }}</h3>
                    </div>

                    <div class="panel">
                        <div class="panel-body">
                            <h2>Tidak ada konten!</h2>
                            <p>Buat dan tulis konten halaman ini.</p>
                        </div>
                    </div>
                </div>
            @endif         
        </div><!-- /row -->
    </div><!-- /container -->
@endsection