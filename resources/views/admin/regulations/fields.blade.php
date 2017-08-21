<!-- Judul Field -->
<div class="form-group col-sm-6">
    {!! Form::label('judul', 'Judul:') !!}
    {!! Form::text('judul', null, ['class' => 'form-control']) !!}
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['1' => 'pending', '2' => 'publish'], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Keterangan Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('keterangan', 'Keterangan:') !!}
    {!! Form::textarea('keterangan', null, ['class' => 'form-control rte']) !!}
</div>

<!-- File Field -->
<div class="form-group col-sm-6">
    {!! Form::label('file', 'File:') !!}
    <div id="file-thumb">{!! @$regulation ? '<img src="'.$regulation->file.'" style="max-width:100%">' : '' !!}</div>
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
    <a href="{!! route('regulations.index') !!}" class="btn btn-default">Cancel</a>
</div>
