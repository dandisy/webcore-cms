<!-- Id Field -->
<div class="form-group">
    {!! Form::label('id', 'Id:') !!}
    <p>{!! $exception->id !!}</p>
</div>

<!-- Nomor Field -->
<div class="form-group">
    {!! Form::label('nomor', 'Nomor:') !!}
    <p>{!! $exception->nomor !!}</p>
</div>

<!-- Tanggal Field -->
<div class="form-group">
    {!! Form::label('tanggal', 'Tanggal:') !!}
    <p>{!! $exception->tanggal !!}</p>
</div>

<!-- Nomor Permohonan Field -->
<div class="form-group">
    {!! Form::label('nomor_permohonan', 'Nomor Permohonan:') !!}
    <p>{!! $exception->nomor_permohonan !!}</p>
</div>

<!-- Keterangan Field -->
<div class="form-group">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    <p>{!! $exception->keterangan !!}</p>
</div>

<!-- Created At Field -->
<div class="form-group">
    {!! Form::label('created_at', 'Created At:') !!}
    <p>{!! $exception->created_at !!}</p>
</div>

<!-- Updated At Field -->
<div class="form-group">
    {!! Form::label('updated_at', 'Updated At:') !!}
    <p>{!! $exception->updated_at !!}</p>
</div>

