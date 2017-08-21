<!-- Judul Field -->
<div class="form-group col-sm-6">
    {!! Form::label('judul', 'Judul:') !!}
    {!! Form::text('judul', null, ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>

<!-- Tanggal Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tanggal', 'Tanggal:') !!}
    {!! Form::date('tanggal', null, ['class' => 'form-control']) !!}
</div>

<!-- Jenis Informasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('asal', 'Asal:') !!}
    {!! Form::select('asal', $origin->pluck('nama', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

<!-- Jenis Informasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('jenis_informasi', 'Jenis Informasi:') !!}
    {!! Form::select('jenis_informasi', $category->pluck('nama', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

<!-- Bentuk Informasi Field -->
<div class="form-group col-sm-6">
    {!! Form::label('bentuk_informasi', 'Bentuk Informasi:') !!}
    {{--{!! Form::select('bentuk_informasi', ['1' => 'Dokumen WEB', '2' => 'Dokumen IMAGE', '3' => 'Dokumen PDF', '4' => 'Dokumen OFFICE', '5' => 'Dokumen ZIP', '6' => 'Dokumen MULTI MEDIA'], null, ['class' => 'form-control select2']) !!}--}}
    {!! Form::select('bentuk_informasi', $format->pluck('nama', 'id'), null, ['class' => 'form-control select2']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control rte']) !!}
</div>

<!-- Tag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tag', 'Tag:') !!}
    {!! Form::text('tag', null, ['class' => 'form-control']) !!}
</div>

<!-- File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', 'File:') !!}
    <div id="file-thumb">{!! @$information ? '<img src="'.$information->file.'" style="max-width:100%">' : '' !!}</div>
    <div class="input-group">
        {!! Form::text('file', null, ['class' => 'form-control', 'readonly' => 'readonly']) !!}
        <span class="input-group-btn">
            <a href="{!! url('assets/dialog?filter=all&appendId=file') !!}" class="btn btn-primary filemanager fancybox.iframe" data-fancybox-type="iframe">Choose File</a>
        </span>
    </div>
</div>
<div class="clearfix"></div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('information.index') !!}" class="btn btn-default">Cancel</a>
</div>
