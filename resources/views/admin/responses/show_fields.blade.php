<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $response->id !!}</p>
</div>

<!-- Nomor Field -->
<div class="form-group">
    {!! Form::label('nomor', 'Nomor:') !!}
    <p>{!! $response->nomor !!}</p>
</div>

<!-- Tanggal Field -->
<div class="form-group">
    {!! Form::label('tanggal', 'Tanggal:') !!}
    <p>{!! $response->tanggal !!}</p>
</div>

<!-- Nomor Keberatan Field -->
<div class="form-group">
    {!! Form::label('nomor_keberatan', 'Nomor Keberatan:') !!}
    <p>{!! $response->nomor_keberatan !!}</p>
</div>

<!-- Keterangan Field -->
<div class="form-group">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{!! $response->keterangan !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $response->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $response->updated_at !!}</p>
</div>

