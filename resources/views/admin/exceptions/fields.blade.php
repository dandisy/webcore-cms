<!-- Nomor Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nomor', 'Nomor:') !!}
    {!! Form::text('nomor', null, ['class' => 'form-control']) !!}
</div>

<!-- Tanggal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal', 'Tanggal:') !!}
    {!! Form::date('tanggal', null, ['class' => 'form-control']) !!}
</div>

<!-- Nomor Permohonan Field -->
<div class="form-group col-sm-6">
    {!! Form::label('nomor_permohonan', 'Nomor Permohonan:') !!}
    {!! Form::text('nomor_permohonan', null, ['class' => 'form-control']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control rte']) !!}
</div>

<!-- Verification Field -->
<div class="col-sm-12">
    {!! Form::label('verified', 'Verification:') !!}
    <div class="form-group">
        <label class="form-group col-sm-4">
            {!! Form::radio('verified', 1) !!} Terima
        </label>
        <label class="form-group col-sm-4">
            {!! Form::radio('verified', 0) !!} Tolak
        </label>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('exceptions.index') !!}" class="btn btn-default">Cancel</a>
</div>
