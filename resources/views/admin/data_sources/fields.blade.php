<!-- Name Field -->
<div class="form-group col-sm-6">
    {!! Form::label('name', 'Name:') !!}
    {!! Form::text('name', null, ['class' => 'form-control']) !!}
</div>

<!-- Description Field -->
<div class="form-group col-sm-12 col-lg-12">
    {!! Form::label('description', 'Description:') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
</div>

<!-- Model Field -->
<div class="form-group col-sm-6">
    {!! Form::label('model', 'Model:') !!}
    {!! Form::select('model', array_merge(['' => NULL], $models), isset($dataSource) ? $dataSource->model : null, ['class' => 'form-control select2']) !!}
</div>

<div class="clearfix"></div>

<div style="padding:15px 15px 0">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">Data Query Definition</h3>
        </div>

        <div class="panel-body">
            <!-- Relational Form Table -->
            <div class="box-body">
                <div class="table-responsive">
                <table class="table table-bordered table-striped table-hover">
                    <tbody>
                        @if(isset($dataQuery))
                        @php
                            $idx = 0;
                            $parent = NULL;
                            $currentIdx = 0;
                            $idxMain = 0;
                            $idxSub = 0;
                        @endphp
                        @foreach($dataQuery as $index => $query)
                            {{-- by dandisy, for now only support 1 level subquery --}}

                            @if(
                                $query['command'] === 'get' or
                                $query['command'] === 'latest' or
                                $query['command'] === 'first' or
                                $query['command'] === 'inRandomOrder'
                            )
                                @php
                                    $fieldGroup = FALSE;
                                    $operator = FALSE;
                                    $value = FALSE;
                                @endphp
                            @elseif(
                                $query['command'] === 'orderByRaw' or
                                $query['command'] === 'offset' or
                                $query['command'] === 'limit' or
                                $query['command'] === 'selectRaw' or
                                $query['command'] === 'whereRaw' or
                                $query['command'] === 'from' or
                                $query['command'] === 'with' or
                                $query['command'] === 'join' or
                                $query['command'] === 'leftJoin' or
                                $query['command'] === 'on' or
                                $query['command'] === 'orOn' or
                                $query['command'] === 'havingRaw' or
                                $query['command'] === 'orHavingRaw' or
                                $query['command'] === 'raw'
                            )
                                @php
                                    $fieldGroup = FALSE;
                                    $operator = FALSE;
                                    $value = TRUE;
                                @endphp
                            @elseif(
                                $query['command'] === 'select' or
                                $query['command'] === 'addSelect' or
                                $query['command'] === 'whereNull' or
                                $query['command'] === 'whereNotNull' or
                                $query['command'] === 'groupBy' or
                                $query['command'] === 'sum' or
                                $query['command'] === 'count' or
                                $query['command'] === 'avg' or
                                $query['command'] === 'max' or
                                $query['command'] === 'min'
                            )
                                @php
                                    $fieldGroup = TRUE;
                                    $operator = FALSE;
                                    $value = FALSE;
                                @endphp
                            @elseif(
                                $query['command'] === 'orderBy' or
                                $query['command'] === 'whereIn' or
                                $query['command'] === 'whereNotIn' or
                                $query['command'] === 'whereBetween' or
                                $query['command'] === 'whereNotBetween'
                            )
                                @php
                                    $fieldGroup = TRUE;
                                    $operator = FALSE;
                                    $value = TRUE;
                                @endphp
                            @else
                                @php
                                    $fieldGroup = TRUE;
                                    $operator = TRUE;
                                    $value = TRUE;
                                @endphp
                            @endif

                            @if($query['parent'])
                                @if($parent == $query['parent'])
                                    @php
                                        $idx+1;
                                        $currentIdx = ($index-1)-$idxSub;
                                    @endphp
                                @else
                                    @php
                                        $currentIdx = $index-1;
                                        $parent = $query['parent'];
                                    @endphp
                                @endif
                                @php
                                    $idxMain+1;
                                    $idxSub+1;
                                @endphp
                                <tr id="query{{$currentIdx}}sub{{$idx}}" class="query{{$currentIdx}}" data-parent="[query{{$currentIdx}}][subquery][sub{{$idx}}]">
                                    <td class="form-group" style="padding-left:30px">
                                        <div class="form-group" style="width: 100%">
                                            {!! Form::label('command', 'Command:') !!}
                                            {!! Form::select('command[query'.$currentIdx.'][subquery][sub'.$idx.'][command]', [
                                                'get' => 'get',
                                                'latest' => 'latest',
                                                'first' => 'first',
                                                'orderBy' => 'orderBy',
                                                'orderByRaw' => 'orderByRaw',
                                                'offset' => 'offset',
                                                'limit' => 'limit',
                                                'select' => 'select',
                                                'addSelect' => 'addSelect',
                                                'selectRaw' => 'selectRaw',
                                                'where' => 'where',
                                                'whereRaw' => 'whereRaw',
                                                'whereNull' => 'whereNull',
                                                'whereNotNull' => 'whereNotNull',
                                                'whereIn' => 'whereIn',
                                                'whereNotIn' => 'whereNotIn',
                                                'orWhere' => 'orWhere',
                                                'from' => 'from',
                                                'with' => 'with',
                                                'join' => 'join',
                                                'leftJoin' => 'leftJoin',
                                                'on' => 'on',
                                                'orOn' => 'orOn',
                                                'groupBy' => 'groupBy',
                                                'having' => 'having',
                                                'havingRaw' => 'havingRaw',
                                                'orHavingRaw' => 'orHavingRaw',
                                                'whereBetween' => 'whereBetween',
                                                'whereNotBetween' => 'whereNotBetween',
                                                'whereDate' => 'whereDate',
                                                'whereMonth' => 'whereMonth',
                                                'whereDay' => 'whereDay',
                                                'whereYear' => 'whereYear',
                                                'whereTime' => 'whereTime',
                                                'whereColumn' => 'whereColumn',
                                                'raw' => 'raw',
                                                'whereExists' => 'whereExists',
                                                'inRandomOrder' => 'inRandomOrder',
                                                'sum' => 'sum',
                                                'count' => 'count',
                                                'avg' => 'avg',
                                                'max' => 'max',
                                                'min' => 'min'
                                            ], $query['command'], ['class' => 'form-control select2 command']) !!}
                                        </div>
                                        <div class="field-group form-group" style="{{$fieldGroup == false ? 'display:none;' : ''}}width: 100%">
                                            {!! Form::label('column', 'Column:') !!}
                                            {!! Form::select('column[query'.$currentIdx.'][subquery][sub'.$idx.'][column][]', $columns, explode(',', $query['column']), ['class' => 'field form-control multi-select', 'multiple']) !!}
                                        </div>
                                    </td>
                                    <td class="form-group">
                                        <div class="operator form-group" style="{{$operator == false ? 'display:none;' : ''}}width: 100%">
                                            {!! Form::label('operator', 'Operator:') !!}
                                            {!! Form::select('operator[query'.$currentIdx.'][subquery][sub'.$idx.'][operator]', [
                                                '' => '',
                                                '=' => '=',
                                                '>' => '>',
                                                '<' => '<',
                                                '>=' => '>=',
                                                '<=' => '<=',
                                                '!=' => '!=',
                                                '<>' => '<>',
                                                'LIKE' => 'LIKE',
                                                'NOT LIKE' => 'NOT LIKE'
                                            ], $query['operator'], ['class' => 'form-control select2']) !!}
                                        </div>
                                        <div class="value form-group" style="{{$value == false ? 'display:none;' : ''}}width: 100%">
                                            {!! Form::label('value', 'Value:') !!}
                                            <textarea class="form-control" name="value[query{{$currentIdx}}][subquery][sub{{$idx}}][value]">{{$query['value']}}</textarea>
                                        </div>
                                    </td>
                                    <td class="form-group">
                                        <div class="form-group" style="width: 100%">
                                            {{--{!! Form::label('action', 'Action:') !!}--}}
                                            {{--<div class="form-group">--}}
                                                <input type="hidden" name="index[query{{$currentIdx}}][subquery][sub{{$idx}}][index]" value="{{$query['id']}}" />
                                                <div class="btn-group-query">
                                                    <div class="form-group">
                                                        <button type="button" class="btn-delete btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                                        <button type="button" class="btn-sub btn btn-info"><i class="fa fa-plus"></i> Sub</button>
                                                    </div>
                                                </div>
                                            {{--</div>--}}
                                        </div>
                                    </td>
                                </tr>
                            @else
                                @php
                                    $currentIdx = $index - $idxMain;
                                    $idxSub = 0;
                                @endphp
                                <tr id="query{{$currentIdx}}" data-parent="[query{{$currentIdx}}]">
                                    <td class="form-group">
                                        <div class="form-group" style="width: 100%">
                                            {!! Form::label('command', 'Command:') !!}
                                            {!! Form::select('command[query'.$currentIdx.'][command]', [
                                                'get' => 'get',
                                                'latest' => 'latest',
                                                'first' => 'first',
                                                'orderBy' => 'orderBy',
                                                'orderByRaw' => 'orderByRaw',
                                                'offset' => 'offset',
                                                'limit' => 'limit',
                                                'select' => 'select',
                                                'addSelect' => 'addSelect',
                                                'selectRaw' => 'selectRaw',
                                                'where' => 'where',
                                                'whereRaw' => 'whereRaw',
                                                'whereNull' => 'whereNull',
                                                'whereNotNull' => 'whereNotNull',
                                                'whereIn' => 'whereIn',
                                                'whereNotIn' => 'whereNotIn',
                                                'orWhere' => 'orWhere',
                                                'from' => 'from',
                                                'with' => 'with',
                                                'join' => 'join',
                                                'leftJoin' => 'leftJoin',
                                                'on' => 'on',
                                                'orOn' => 'orOn',
                                                'groupBy' => 'groupBy',
                                                'having' => 'having',
                                                'havingRaw' => 'havingRaw',
                                                'orHavingRaw' => 'orHavingRaw',
                                                'whereBetween' => 'whereBetween',
                                                'whereNotBetween' => 'whereNotBetween',
                                                'whereDate' => 'whereDate',
                                                'whereMonth' => 'whereMonth',
                                                'whereDay' => 'whereDay',
                                                'whereYear' => 'whereYear',
                                                'whereTime' => 'whereTime',
                                                'whereColumn' => 'whereColumn',
                                                'raw' => 'raw',
                                                'whereExists' => 'whereExists',
                                                'inRandomOrder' => 'inRandomOrder',
                                                'sum' => 'sum',
                                                'count' => 'count',
                                                'avg' => 'avg',
                                                'max' => 'max',
                                                'min' => 'min'
                                            ], $query['command'], ['class' => 'form-control select2 command']) !!}
                                        </div>
                                        <div class="field-group form-group" style="{{$fieldGroup == false ? 'display:none;' : ''}}width: 100%">
                                            {!! Form::label('column', 'Column:') !!}
                                            {!! Form::select('column[query'.$currentIdx.'][column][]', $columns, explode(',', $query['column']), ['class' => 'field form-control multi-select', 'multiple']) !!}
                                        </div>
                                    </td>
                                    <td class="form-group">
                                        <div class="operator form-group" style="{{$operator == false ? 'display:none;' : ''}}width: 100%">
                                            {!! Form::label('operator', 'Operator:') !!}
                                            {!! Form::select('operator[query'.$currentIdx.'][operator]', [
                                                '' => '',
                                                '=' => '=',
                                                '>' => '>',
                                                '<' => '<',
                                                '>=' => '>=',
                                                '<=' => '<=',
                                                '!=' => '!=',
                                                'LIKE' => 'LIKE',
                                                'NOT LIKE' => 'NOT LIKE'
                                            ], $query['operator'], ['class' => 'form-control select2']) !!}
                                        </div>
                                        <div class="value form-group" style="{{$value == false ? 'display:none;' : ''}}width: 100%">
                                            {!! Form::label('value', 'Value:') !!}
                                            <textarea class="form-control" name="value[query{{$currentIdx}}][value]">{{$query['value']}}</textarea>
                                        </div>
                                    </td>
                                    <td class="form-group">
                                        <div class="form-group" style="width: 100%">
                                            {{--{!! Form::label('action', 'Action:') !!}--}}
                                            {{--<div class="form-group">--}}
                                                <input type="hidden" name="index[query{{$currentIdx}}][index]" value="{{$query['id']}}" />
                                                <div class="btn-group-query">
                                                    <div class="form-group">
                                                        <button type="button" class="btn-delete btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                                        <button type="button" class="btn-sub btn btn-info"><i class="fa fa-plus"></i> Sub</button>
                                                    </div>
                                                </div>
                                            {{--</div>--}}
                                        </div>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        @endif

                        @if(empty($dataQuery))
                        <tr id="query0" data-parent="[query0]">
                            <td class="form-group">
                                <div class="form-group" style="width: 100%">
                                    {!! Form::label('command', 'Command:') !!}
                                    {!! Form::select('command[query0][command]', [
                                        'get' => 'get',
                                        'latest' => 'latest',
                                        'first' => 'first',
                                        'orderBy' => 'orderBy',
                                        'orderByRaw' => 'orderByRaw',
                                        'offset' => 'offset',
                                        'limit' => 'limit',
                                        'select' => 'select',
                                        'addSelect' => 'addSelect',
                                        'selectRaw' => 'selectRaw',
                                        'where' => 'where',
                                        'whereRaw' => 'whereRaw',
                                        'whereNull' => 'whereNull',
                                        'whereNotNull' => 'whereNotNull',
                                        'whereIn' => 'whereIn',
                                        'whereNotIn' => 'whereNotIn',
                                        'orWhere' => 'orWhere',
                                        'from' => 'from',
                                        'with' => 'with',
                                        'join' => 'join',
                                        'leftJoin' => 'leftJoin',
                                        'on' => 'on',
                                        'orOn' => 'orOn',
                                        'groupBy' => 'groupBy',
                                        'having' => 'having',
                                        'havingRaw' => 'havingRaw',
                                        'orHavingRaw' => 'orHavingRaw',
                                        'whereBetween' => 'whereBetween',
                                        'whereNotBetween' => 'whereNotBetween',
                                        'whereDate' => 'whereDate',
                                        'whereMonth' => 'whereMonth',
                                        'whereDay' => 'whereDay',
                                        'whereYear' => 'whereYear',
                                        'whereTime' => 'whereTime',
                                        'whereColumn' => 'whereColumn',
                                        'raw' => 'raw',
                                        'whereExists' => 'whereExists',
                                        'inRandomOrder' => 'inRandomOrder',
                                        'sum' => 'sum',
                                        'count' => 'count',
                                        'avg' => 'avg',
                                        'max' => 'max',
                                        'min' => 'min'
                                    ], null, ['class' => 'form-control select2 command']) !!}
                                </div>
                                <div class="field-group form-group" style="width: 100%">
                                {!! Form::label('column', 'Column:') !!}
                                {!! Form::select('column[query0][column][]', [], null, ['class' => 'field form-control multi-select', 'multiple']) !!}
                                </div>
                            </td>
                            <td class="form-group">
                                <div class="operator form-group" style="width: 100%">
                                    {!! Form::label('operator', 'Operator:') !!}
                                    {!! Form::select('operator[query0][operator]', [
                                        '' => '',
                                        '=' => '=',
                                        '>' => '>',
                                        '<' => '<',
                                        '>=' => '>=',
                                        '<=' => '<=',
                                        '!=' => '!=',
                                        '<>' => '<>',
                                        'LIKE' => 'LIKE',
                                        'NOT LIKE' => 'NOT LIKE'
                                    ], null, ['class' => 'form-control select2']) !!}
                                </div>
                                <div class="value form-group" style="width: 100%">
                                    {!! Form::label('value', 'Value:') !!}
                                    <textarea class="form-control" name="value[query0][value]"></textarea>
                                </div>
                            </td>
                            <td class="form-group">
                                <div class="form-group" style="width: 100%">
                                    {{--{!! Form::label('action', 'Action:') !!}--}}
                                    {{--<div class="form-group" style="width: 100%">--}}
                                        <div class="btn-group-query">
                                            <div class="form-group">
                                                <button type="button" class="btn-delete btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                                <button type="button" class="btn-sub btn btn-info"><i class="fa fa-plus"></i> Sub</button>
                                            </div>
                                        </div>
                                    {{--</div>--}}
                                </div>
                            </td>
                        </tr>
                        @endif
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2"></th>
                            <th>
                                <div class="form-group">
                                    <button type="button" class="form-control btn-add-query btn btn-primary"><i class="fa fa-plus"></i> Query</button>
                                </div>
                            </th>
                        </tr>
                    </tfoot>
                </table>
                </div>
            </div>
            <!-- End Relational Form Table -->

            <div class="box-body column-alias" style="{{isset($columnAlias) ? (count($columnAlias) > 0 ? 'border:1px solid rgb(210, 214, 222);' : '') : ''}}position:relative;margin-top:15px;padding-top:30px">
                @if(isset($columnAlias))
                    @if(count($columnAlias) > 0)
                    <div class="title" style="position:absolute;top:-12px">
                        <b style="padding:10px;background-color:white">Columns Formating</b>
                    </div>
                    @else
                    <div class="title" style="display:none;position:absolute;top:-12px">
                        <b style="padding:10px;background-color:white">Columns Formating</b>
                    </div>
                    @endif
                @else
                <div class="title" style="display:none;position:absolute;top:-12px">
                    <b style="padding:10px;background-color:white">Columns Formating</b>
                </div>
                @endif

                <div id="column-alias">
                    @if(isset($columnAlias))
                        @foreach($columnAlias as $index => $item)
                        <div class="form-group col-sm-6">
                            <label for="column[{{$index}}]-alias">{{$item->name}} :</label>
                            <input name="alias[{{$index}}][index]" type="hidden" value="{{$item->id}}">
                            <div class="input-group">
                                <span class="input-group-addon">Alias</span>
                                <input class="form-control column-alias" name="alias[{{$index}}][alias]" type="text" placeholder="Format column data" value="{{$item->alias ? : NULL}}" id="column[{{$index}}]-alias">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Edit</span>
                                <input class="form-control column-edit" name="alias[{{$index}}][edit]" type="text" placeholder="Edit column data" value="{{$item->edit ? : NULL}}" id="column[{{$index}}]-edit">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Filter</span>
                                <input class="form-control column-filter" name="alias[{{$index}}][filter]" type="text" placeholder="Filter column data" value="{{$item->filter ? : NULL}}" id="column[{{$index}}]-filter">
                            </div>
                            <div class="col-sm-6 no-padding">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <input name="alias[{{$index}}][un_search]" type="checkbox"{{$item->un_search ? 'checked="checked"' : NULL}} id="column[{{$index}}]-search">
                                    </div>
                                    <span class="form-control column-search">Unsearchable Column</span>
                                </div>
                            </div>
                            <div class="col-sm-6 no-padding">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <input name="alias[{{$index}}][html]" type="checkbox"{{$item->html ? 'checked="checked"' : NULL}} id="column[{{$index}}]-html">
                                    </div>
                                    <span class="form-control column-html">Render Data as HTML</span>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Submit Field -->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
    <a href="{!! route('admin.dataSources.index') !!}" class="btn btn-default">Cancel</a>
</div>

@section('scripts')
<!-- Relational Form table -->
<script>
    // data query definition
    var idx = $('tbody tr').length - 1;

    $('.btn-add-query').on('click', function() {
        idx++;
        var queryForm = `
            <tr id="query`+idx+`" data-parent="[query`+idx+`]">
                <td class="form-group">
                    <div class="form-group" style="width: 100%">
                        {!! Form::label('command', 'Command:') !!}
                        {!! Form::select('command[query`+idx+`][command]', [
                            'get' => 'get',
                            'latest' => 'latest',
                            'first' => 'first',
                            'orderBy' => 'orderBy',
                            'orderByRaw' => 'orderByRaw',
                            'offset' => 'offset',
                            'limit' => 'limit',
                            'select' => 'select',
                            'addSelect' => 'addSelect',
                            'selectRaw' => 'selectRaw',
                            'where' => 'where',
                            'whereRaw' => 'whereRaw',
                            'whereNull' => 'whereNull',
                            'whereNotNull' => 'whereNotNull',
                            'whereIn' => 'whereIn',
                            'whereNotIn' => 'whereNotIn',
                            'orWhere' => 'orWhere',
                            'from' => 'from',
                            'with' => 'with',
                            'join' => 'join',
                            'leftJoin' => 'leftJoin',
                            'on' => 'on',
                            'orOn' => 'orOn',
                            'groupBy' => 'groupBy',
                            'having' => 'having',
                            'havingRaw' => 'havingRaw',
                            'orHavingRaw' => 'orHavingRaw',
                            'whereBetween' => 'whereBetween',
                            'whereNotBetween' => 'whereNotBetween',
                            'whereDate' => 'whereDate',
                            'whereMonth' => 'whereMonth',
                            'whereDay' => 'whereDay',
                            'whereYear' => 'whereYear',
                            'whereTime' => 'whereTime',
                            'whereColumn' => 'whereColumn',
                            'raw' => 'raw',
                            'whereExists' => 'whereExists',
                            'inRandomOrder' => 'inRandomOrder',
                            'sum' => 'sum',
                            'count' => 'count',
                            'avg' => 'avg',
                            'max' => 'max',
                            'min' => 'min'
                        ], null, ['class' => 'form-control select2 command']) !!}
                    </div>
                    <div class="field-group form-group" style="width: 100%">
                        {!! Form::label('column', 'Column:') !!}
                        {!! Form::select('column[query`+idx+`][column][]', [], null, ['class' => 'field form-control multi-select', 'multiple']) !!}
                    </div>
                </td>
                <td class="form-group">
                    <div class="operator form-group" style="width: 100%">
                        {!! Form::label('operator', 'Operator:') !!}
                        {!! Form::select('operator[query`+idx+`][operator]', [
                            '' => '',
                            '=' => '=',
                            '>' => '>',
                            '<' => '<',
                            '>=' => '>=',
                            '<=' => '<=',
                            '!=' => '!=',
                            '<>' => '<>',
                            'LIKE' => 'LIKE',
                            'NOT LIKE' => 'NOT LIKE'
                        ], null, ['class' => 'form-control select2']) !!}
                    </div>
                    <div class="value form-group" style="width: 100%">
                        {!! Form::label('value', 'Value:') !!}
                        <textarea class="form-control" name="value[query`+idx+`][value]"></textarea>
                    </div>
                </td>
                <td class="form-group">
                    <div class="form-group" style="width: 100%">
                        <div class="btn-group-query">
                            <div class="form-group">
                                <button type="button" class="btn-delete btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                <button type="button" class="btn-sub btn btn-info"><i class="fa fa-plus"></i> Sub</button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        `;

        $('tbody').append(queryForm);

        fillField($('#query'+idx+' .field'));
    });

    $(document).on('click', '.btn-sub', function() {
        var el = $(this).parents('tr').attr('id');
        var parent = $(this).parents('tr').data('parent');
        var idx = $('.'+el).length - 1;

        idx++;
        var sub = 'sub'+idx;

        var subQueryForm = `
            <tr id="`+el+sub+`" class="`+el+`" data-parent="`+parent+`[subquery][`+sub+`]">
                <td class="form-group" style="padding-left:30px">
                    <div class="form-group" style="width: 100%">
                        {!! Form::label('command', 'Command:') !!}
                        {!! Form::select('command`+parent+`[subquery][`+sub+`][command]', [
                            'get' => 'get',
                            'latest' => 'latest',
                            'first' => 'first',
                            'orderBy' => 'orderBy',
                            'orderByRaw' => 'orderByRaw',
                            'offset' => 'offset',
                            'limit' => 'limit',
                            'select' => 'select',
                            'addSelect' => 'addSelect',
                            'selectRaw' => 'selectRaw',
                            'where' => 'where',
                            'whereRaw' => 'whereRaw',
                            'whereNull' => 'whereNull',
                            'whereNotNull' => 'whereNotNull',
                            'whereIn' => 'whereIn',
                            'whereNotIn' => 'whereNotIn',
                            'orWhere' => 'orWhere',
                            'from' => 'from',
                            'with' => 'with',
                            'join' => 'join',
                            'leftJoin' => 'leftJoin',
                            'on' => 'on',
                            'orOn' => 'orOn',
                            'groupBy' => 'groupBy',
                            'having' => 'having',
                            'havingRaw' => 'havingRaw',
                            'orHavingRaw' => 'orHavingRaw',
                            'whereBetween' => 'whereBetween',
                            'whereNotBetween' => 'whereNotBetween',
                            'whereDate' => 'whereDate',
                            'whereMonth' => 'whereMonth',
                            'whereDay' => 'whereDay',
                            'whereYear' => 'whereYear',
                            'whereTime' => 'whereTime',
                            'whereColumn' => 'whereColumn',
                            'raw' => 'raw',
                            'whereExists' => 'whereExists',
                            'inRandomOrder' => 'inRandomOrder',
                            'sum' => 'sum',
                            'count' => 'count',
                            'avg' => 'avg',
                            'max' => 'max',
                            'min' => 'min'
                        ], null, ['class' => 'form-control select2 command']) !!}
                    </div>
                    <div class="field-group form-group" style="width: 100%">
                        {!! Form::label('column', 'Column:') !!}
                        {!! Form::select('column`+parent+`[subquery][`+sub+`][column][]', [], null, ['class' => 'field form-control multi-select', 'multiple']) !!}
                    </div>
                </td>
                <td class="form-group">
                    <div class="operator form-group" style="width: 100%">
                        {!! Form::label('operator', 'Operator:') !!}
                        {!! Form::select('operator`+parent+`[subquery][`+sub+`][operator]', [
                            '' => '',
                            '=' => '=',
                            '>' => '>',
                            '<' => '<',
                            '>=' => '>=',
                            '<=' => '<=',
                            '!=' => '!=',
                            '<>' => '<>',
                            'LIKE' => 'LIKE',
                            'NOT LIKE' => 'NOT LIKE'
                        ], null, ['class' => 'form-control select2']) !!}
                    </div>
                    <div class="value form-group" style="width: 100%">
                        {!! Form::label('value', 'Value:') !!}
                        <textarea class="form-control value" name="value`+parent+`[subquery][`+sub+`][value]"></textarea>
                    </div>
                </td>
                <td class="form-group">
                    <div class="form-group" style="width: 100%">
                        <div class="btn-group-query">
                            <div class="form-group">
                                <button type="button" class="btn-delete btn btn-danger"><i class="glyphicon glyphicon-trash"></i></button>
                                <button type="button" class="btn-sub btn btn-info"><i class="fa fa-plus"></i> Sub</button>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        `;

        if(!$('.'+el).length) {
            $('#' + el).after(subQueryForm);
        } else {
            $('.'+el).last().after(subQueryForm);
        }

        fillField($('#'+el+sub+' .field'));
    });

    $(document).on('click', '.btn-delete', function() {
        var actionDelete = confirm('Are you sure?');
        if(actionDelete) {
            $(this).parents('tr').remove();
        }
    });
    // end data query definition
</script>
<!-- End Relational Form table -->

<script>
    $('#model').on('change', function() {
        fillField($('.field'));
    });

    function fillField(el) {
        var selectEl = $(el).parents('tr').find('.select2');
        var model = $('#model').val();

        var joinModel = [];

        $.each($('.command'), function(index, item) {
            if($(item).val() === 'join' || $(item).val() === 'leftJoin') {
                joinModel.push($(item).parents('tr').find('.value textarea').val());
            }
        });

        $.ajax({
            type: 'GET',
            url: '{{url("getTableColumn")}}',
            data: {model: model, joinModel: joinModel}
        }).done(function(res) {
            el.empty();
            $.each(res, function(index, value) {
                el.append('<option value="'+value+'">'+value+'</option>');
            });

            el.multiSelect('refresh');

            el.multiSelect({
                keepOrder: true,
                selectableHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search...'>",
                selectionHeader: "<input type='text' class='search-input form-control' autocomplete='off' placeholder='Search...'>",
                afterInit: function(ms){
                    var that = this,
                        $selectableSearch = that.$selectableUl.prev(),
                        $selectionSearch = that.$selectionUl.prev(),
                        selectableSearchString = '#'+that.$container.attr('id')+' .ms-elem-selectable:not(.ms-selected)',
                        selectionSearchString = '#'+that.$container.attr('id')+' .ms-elem-selection.ms-selected';

                    that.qs1 = $selectableSearch.quicksearch(selectableSearchString)
                        .on('keydown', function(e){
                            if (e.which === 40){
                                that.$selectableUl.focus();
                                return false;
                            }
                        });

                    that.qs2 = $selectionSearch.quicksearch(selectionSearchString)
                        .on('keydown', function(e){
                            if (e.which == 40){
                                that.$selectionUl.focus();
                                return false;
                            }
                        });
                },
                afterSelect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                },
                afterDeselect: function(){
                    this.qs1.cache();
                    this.qs2.cache();
                }
            });

            selectEl.select2();
        });
    }

    // addition for multiSelect orderable
    $(document).on('click', '.ms-elem-selectable', function () {
        var columnOrderEl = $(this).parents('.field-group').find('.column-order');

        if(columnOrderEl.length > 0) {
            var elValue = columnOrderEl.val();
            columnOrderEl.val(elValue ? elValue+','+$(this).find('span').text() : $(this).find('span').text())
        } else {
            console.log($(this).parents('.field-group'));
            $(this).parents('.field-group').append('<input type="hidden" class="column-order" name="columnOrder'+$(this).parents('tr').data('parent')+'[columnOrder]" value="'+$(this).find('span').text()+'" />');
        }
    });

    $(document).on('click', '.ms-elem-selection', function () {
        var thisValue = $(this).find('span').text();
        var columnOrderEl = $(this).parents('.field-group').find('.column-order');

        columnOrderEl.val(columnOrderEl.val().replace(','+thisValue, ''));
        columnOrderEl.val(columnOrderEl.val().replace(',,', ','));
    });
    // end addition for multiSelect orderable

    // handling data columns
    @if(isset($columnAlias))
        var columnAlias = @json($columnAlias);
    @else
        var columnAlias = [];
    @endif

    $(document).on('change', 'tbody tr .command', function() {
        var val = $(this).val();

        if(
            val === 'get' ||
            val === 'latest' ||
            val === 'first' ||
            val === 'inRandomOrder'
        ) {
            $(this).parents('tr').find('.field-group').hide();
            $(this).parents('tr').find('.operator').hide();
            $(this).parents('tr').find('.value').hide();
        } else if (
            val === 'orderByRaw' ||
            val === 'offset' ||
            val === 'limit' ||
            val === 'selectRaw' ||
            val === 'whereRaw' ||
            val === 'from' ||
            val === 'with' ||
            val === 'join' ||
            val === 'leftJoin' ||
            val === 'on' ||
            val === 'orOn' ||
            val === 'havingRaw' ||
            val === 'orHavingRaw' ||
            val === 'raw'
        ) {
            $(this).parents('tr').find('.field-group').hide();
            $(this).parents('tr').find('.operator').hide();
            $(this).parents('tr').find('.value').show();
        } else if (
            val === 'select' ||
            val === 'addSelect' ||
            val === 'whereNull' ||
            val === 'whereNotNull' ||
            val === 'groupBy' ||
            val === 'sum' ||
            val === 'count' ||
            val === 'avg' ||
            val === 'max' ||
            val === 'min'
        ) {
            $(this).parents('tr').find('.field-group').show();
            $(this).parents('tr').find('.operator').hide();
            $(this).parents('tr').find('.value').hide();
        } else if (
            val === 'orderBy' ||
            val === 'whereIn' ||
            val === 'whereNotIn' ||
            val === 'whereBetween' ||
            val === 'whereNotBetween'
        ) {
            $(this).parents('tr').find('.field-group').show();
            $(this).parents('tr').find('.operator').hide();
            $(this).parents('tr').find('.value').show();
        } else {
            $(this).parents('tr').find('.field-group').show();
            $(this).parents('tr').find('.operator').show();
            $(this).parents('tr').find('.value').show();
        }

        getAllDataColumn($(this), $(this).val() === 'select');
    });

    $(document).on('change', 'tbody tr .field', function() {
        if($(this).parents('tr').find('.command').val() === 'select') {
            $('#column-alias').empty();
            if($(this).val()) {
                $.each($(this).val(), function(index, value) {
                    var obj = findObjectByKey(columnAlias, 'name', value);
                    if(obj) {
                        $('#column-alias').append(`
                            <div class="form-group col-sm-6">
                                <label for="column[`+index+`]-alias">`+value+` :</label>
                                <input name="alias[`+index+`][index]" type="hidden" value="`+obj.id+`">
                                <input name="alias[`+index+`][name]" type="hidden" value="`+value+`">
                                <div class="input-group">
                                    <span class="input-group-addon">Alias</span>
                                    <input class="form-control column-alias" name="alias[`+index+`][alias]" type="text"`+(obj.alias ? ' value="'+obj.alias+'"' : ' placeholder="Column alias"')+`" id="column[`+index+`]-alias">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">Edit</span>
                                    <input class="form-control column-edit" name="alias[`+index+`][edit]" type="text"`+(obj.edit ? ' value="'+obj.edit+'"' : ' placeholder="Edit column data"')+`" id="column[`+index+`]-edit">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">Filter</span>
                                    <input class="form-control column-filter" name="alias[`+index+`][filter]" type="text"`+(obj.filter ? ' value="'+obj.filter+'"' : ' placeholder="Edit column data"')+`" id="column[`+index+`]-filter">
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <input name="alias[`+index+`][un_search]" type="checkbox"`+(obj.un_search ? ' checked="checked"' : '')+` id="column[`+index+`]-search">
                                        </div>
                                        <span class="form-control column-search">Unsearchable Column</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <input name="alias[`+index+`][html]" type="checkbox"`+(obj.html ? ' checked="checked"' : '')+` id="column[`+index+`]-html">
                                        </div>
                                        <span class="form-control column-html">Render Data as HTML</span>
                                    </div>
                                </div>
                            </div>
                        `);
                    } else {                        
                        $('#column-alias').append(`
                            <div class="form-group col-sm-6">
                                <label for="column[`+index+`]-alias">`+value+` :</label>
                                <input name="alias[`+index+`][name]" type="hidden" value="`+value+`">
                                <input name="alias[`+index+`][select]" type="hidden" value="1">
                                <div class="input-group">
                                    <span class="input-group-addon">Alias</span>
                                    <input class="form-control column-alias" name="alias[`+index+`][alias]" type="text" placeholder="Column alias" id="column[`+index+`]-alias">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">Edit</span>
                                    <input class="form-control column-edit" name="alias[`+index+`][edit]" type="text" placeholder="Edit column data" id="column[`+index+`]-edit">
                                </div>
                                <div class="input-group">
                                    <span class="input-group-addon">Filter</span>
                                    <input class="form-control column-filter" name="alias[`+index+`][filter]" type="text" placeholder="Filter column data" id="column[`+index+`]-filter">
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <input name="alias[`+index+`][un_search]" type="checkbox" id="column[`+index+`]-search">
                                        </div>
                                        <span class="form-control column-search">Unsearchable Column</span>
                                    </div>
                                </div>
                                <div class="col-sm-6 no-padding">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <input name="alias[`+index+`][html]" type="checkbox" id="column[`+index+`]-html">
                                        </div>
                                        <span class="form-control column-html">Render Data as HTML</span>
                                    </div>
                                </div>
                            </div>
                        `);
                    }
                });

                if($('#column-alias .form-group').length > 0) {
                    $('.column-alias .title').show();

                    $('.column-alias').css('border', '1px solid #d2d6de');
                }
            } else {
                getAllDataColumn($(this), !$(this).val());
            }
        }
    });

    function getAllDataColumn(el, condition) {
        var model = $('#model').val();

        var joinModel = [];

        $.each($('.command'), function(index, item) {
            if($(item).val() === 'join' || $(item).val() === 'leftJoin') {
                joinModel.push($(item).parents('tr').find('.value textarea').val());
            }
        });

        if(condition) {
            $.ajax({
                type: 'GET',
            url: '{{url("getTableColumn")}}',
                data: {model: model, joinModel: joinModel}
            }).done(function(res) {
                $.each(res, function(index, value) {                    
                    $('#column-alias').append(`
                        <div class="form-group col-sm-6">
                            <label for="column[`+index+`]-alias">`+value+` :</label>
                            <input name="alias[`+index+`][name]" type="hidden" value="`+value+`">
                            <div class="input-group">
                                <span class="input-group-addon">Alias</span>
                                <input class="form-control column-alias" name="alias[`+index+`][alias]" type="text" placeholder="Column alias" id="column[`+index+`]-alias">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Edit</span>
                                <input class="form-control column-edit" name="alias[`+index+`][edit]" type="text" placeholder="Edit column data" id="column[`+index+`]-edit">
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Filter</span>
                                <input class="form-control column-filter" name="alias[`+index+`][filter]" type="text" placeholder="Filter column data" id="column[`+index+`]-filter">
                            </div>
                            <div class="col-sm-6 no-padding">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <input name="alias[`+index+`][un_search]" type="checkbox" id="column[`+index+`]-search">
                                    </div>
                                    <span class="form-control column-search">Unsearchable Column</span>
                                </div>
                            </div>
                            <div class="col-sm-6 no-padding">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <input name="alias[`+index+`][html]" type="checkbox" id="column[`+index+`]-html">
                                    </div>
                                    <span class="form-control column-html">Render Data as HTML</span>
                                </div>
                            </div>
                        </div>
                    `);
                });

                if($('#column-alias .form-group').length > 0) {
                    $('.column-alias .title').show();

                    $('.column-alias').css('border', '1px solid #d2d6de');
                }
            });
        }
    }
    // end handling data columns

    $(document).on('keyup', '.column-alias', function () {
        $(this).parents('.form-group').find('.column-edit').val($(this).val());
    });

    function findObjectByKey(array, key, value) {
        for (var i = 0; i < array.length; i++) {
            if (array[i][key] === value) {
                return array[i];
            }
        }
        return null;
    }
</script>
@endsection
