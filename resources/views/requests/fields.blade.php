<!-- Nomor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nomor', 'Nomor:') !!}
    {!! Form::text('nomor', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal', 'Tanggal:') !!}
    {!! Form::text('tanggal', null, ['class' => 'form-control date']) !!}
</div>

<!-- Nama Pengguna Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nama_pengguna', 'Nama Pengguna:') !!}
    {!! Form::text('nama_pengguna', null, ['class' => 'form-control']) !!}
</div>

<!-- Nomor Identitas Pengguna Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nomor_identitas_pengguna', 'Nomor Identitas Pengguna:') !!}
    {!! Form::text('nomor_identitas_pengguna', null, ['class' => 'form-control']) !!}
</div>

<!-- Telepon Field -->
<div class="form-group col-sm-6">
    {!! Form::label('telepon', 'Telepon:') !!}
    {!! Form::number('telepon', null, ['class' => 'form-control']) !!}
</div>

<!-- Email Field -->
<div class="form-group col-sm-6">
    {!! Form::label('email', 'Email:') !!}
    {!! Form::text('email', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control rte']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('requests.index') !!}" class="btn btn-default">Cancel</a>
</div>