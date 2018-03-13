<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<div class="clearfix"></div>

<!-- Title Field -->
<div class="form-group col-sm-6">
    {!! Form::label('title', 'Title:') !!}
    {!! Form::text('title', null, ['class' => 'form-control']) !!}
</div>

<!-- Slug Field -->
<div class="form-group col-sm-6">
    {!! Form::label('slug', 'Slug:') !!}
    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
</div>

<!-- Summary Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('summary', 'Summary:') !!}
    {!! Form::textarea('summary', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control rte']) !!}
</div>

<!-- Tag Field -->
<div class="form-group col-sm-6">
    {!! Form::label('tag', 'Tag:') !!}
    {!! Form::text('tag', null, ['class' => 'form-control']) !!}
</div>

<!-- Version Field -->
<div class="form-group col-sm-6">
    {!! Form::label('version', 'Version:') !!}
    {!! Form::text('version', null, ['class' => 'form-control']) !!}
</div>

<!-- Language Field -->
<div class="form-group col-sm-6">
    {!! Form::label('language', 'Language:') !!}
    {!! Form::text('language', null, ['class' => 'form-control']) !!}
</div>

<!-- Template Field -->
<div class="form-group col-sm-6">
    {!! Form::label('template', 'Template:') !!}
    {!! Form::select('template', $themes, null, ['class' => 'form-control select2']) !!}
</div>

<div class="clearfix"></div>

<div style="padding:15px 15px 0">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Presentation Definition</h3>
        </div>

        <div class="panel-body">
            <!-- Relational Form Table -->
            <div class="box-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Media</th>
                            <th>Component ID</th>
                            <th>Position</th>
                            <th>Order</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($presentation))
                        @foreach($presentation as $index =>  $present)
                        <tr>
                            <td class="form-group" style="width:13%">
                                {!! Form::select('media[present'.$index.'][media]', ['Desktop' => 'Desktop', 'Mobile' => 'Mobile', 'TV Screen' => 'TV Screen'], $present['media'], ['class' => 'form-control select2']) !!}
                            </td>
                            <td class="form-group" style="width:40%">
                                {!! Form::select('component_id[present'.$index.'][component_id]', $component->pluck('name', 'id'), $present['component_id'], ['class' => 'form-control select2']) !!}
                            </td>
                            <td class="form-group" style="width:27%">
                                {!! Form::select('position[present'.$index.'][position]', $themes, $present['position'], ['class' => 'form-control select2']) !!}
                            </td>
                            <td class="form-group" style="width:10%">
                                {!! Form::number('order[present'.$index.'][order]', $present['order'], ['class' => 'form-control']) !!}
                            </td>
                            <td class="form-group" style="width:10%">
                                <input type="hidden" name="index[present{{$index}}][index]" value="{{ $present['id'] }}" />
                                <a href="{{ url('admin/dataSources/'.$present['component']['data_source_id'].'/edit') }}" class="btn btn-default btn-xs"><span>DS</span></a>
                                <a href="{{ url('admin/components/'.$present['component_id'].'/edit') }}" class="btn btn-default btn-xs"><span>UI</span></a>
                                <button type="button" class="btn-delete btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button>
                            </td>
                        </tr>
                        @endforeach
                        @endif

                        @if(empty($presentation))
                        <tr class="empty-data">
                            <td class="text-center" colspan="5">
                                <span>No data available in table</span>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3"></th>
                            <th colspan="2">
                                <div class="form-group">
                                    <button type="button" class="btn btn-add-presentation btn-danger form-control">Add View Component</button>
                                </div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
            <!-- End Relational Form Table -->
        </div>
    </div>
</div>

<!-- Status Field -->
<div class="form-group col-sm-6">
    {!! Form::label('status', 'Status:') !!}
    {!! Form::select('status', ['pending' => 'Pending', 'publish' => 'Publish'], null, ['class' => 'form-control select2']) !!}
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.pages.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<!-- Relational Form table -->
<script>
    var idx = $('tbody tr').length - 1;

    $('.btn-add-presentation').on('click', function() {
        idx++;

        if($('.empty-data').length > 0) {
            $('.empty-data').hide();
        }

        var presentationForm = `
            <tr id="present`+idx+`">
                <td class="form-group" style="width:13%">
                    {!! Form::select('media[present`+idx+`][media]', ['Desktop' => 'Desktop', 'Mobile' => 'Mobile', 'TV Screen' => 'TV Screen'], null, ['class' => 'form-control select2']) !!}
                </td>
                <td class="form-group" style="width:40%">
                    {!! Form::select('component_id[present`+idx+`][component_id]', $component->pluck('name', 'id'), null, ['class' => 'form-control select2']) !!}
                </td>
                <td class="form-group" style="width:27%">
                    {!! Form::select('position[present`+idx+`][position]', $themes, null, ['class' => 'form-control select2']) !!}
                </td>
                <td class="form-group" style="width:10%">
                    {!! Form::number('order[present`+idx+`][order]', null, ['class' => 'form-control']) !!}
                </td>
                <td class="form-group" style="width:10%">
                    <button type="button" class="btn-delete btn btn-danger btn-xs"><i class="glyphicon glyphicon-trash"></i></button>
                </td>
            </tr>
        `;

        $('tbody').append(presentationForm);

        $('#present'+idx+' .select2').select2();
    });

    $(document).on('click', '.btn-delete', function() {
        var actionDelete = confirm('Are you sure?');
        if(actionDelete) {
            $(this).parents('tr').remove();

            if($('tbody tr').length == 0) {
                $('.empty-data').show();
            }
        }
    });
</script>
<!-- End Relational Form table -->
@endsection
