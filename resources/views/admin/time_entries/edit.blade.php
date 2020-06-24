@extends('layouts.app')

@section('content')
    
    {!! Form::model($time_entry, ['method' => 'PUT', 'route' => ['admin.time_entries.update', $time_entry->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">PROJECT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('entry_date', trans('global.time-entries.fields.entry-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('entry_date', old('entry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('entry_date'))
                        <p class="help-block">
                            {{ $errors->first('entry_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('operation_number', trans('global.time-entries.fields.operation-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('operation_number', old('operation_number'), ['class' => 'form-control', 'placeholder' => 'Project No.', 'readonly']) !!}
                    @if($errors->has('operation_number'))
                        <p class="help-block">
                            {{ $errors->first('operation_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('work_type', trans('global.time-entries.fields.work-type').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-work_type">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-work_type">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('work_type[]', $work_types, old('work_type') ? old('work_type') : $time_entry->work_type->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-work_type' ]) !!}
                    @if($errors->has('work_type'))
                        <p class="help-block">
                            {{ $errors->first('work_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('client_id', trans('global.time-entries.fields.client').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('start_time', trans('global.time-entries.fields.start-time').'', ['class' => 'control-label']) !!}
                    {!! Form::text('start_time', old('start_time'), ['class' => 'form-control datetime', 'placeholder' => 'YYYY-MM-DD HH:MM:SS', 'readonly']) !!}
                    @if($errors->has('start_time'))
                        <p class="help-block">
                            {{ $errors->first('start_time') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('end_time', trans('global.time-entries.fields.end-time').'', ['class' => 'control-label']) !!}
                    {!! Form::text('end_time', old('end_time'), ['class' => 'form-control datetime', 'placeholder' => 'YYYY-MM-DD HH:MM:SS']) !!}
                    @if($errors->has('end_time'))
                        <p class="help-block">
                            {{ $errors->first('end_time') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('status', trans('global.time-entries.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2', 'disabled']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>

    <script>
        $("#selectbtn-work_type").click(function(){
            $("#selectall-work_type > option").prop("selected","selected");
            $("#selectall-work_type").trigger("change");
        });
        $("#deselectbtn-work_type").click(function(){
            $("#selectall-work_type > option").prop("selected","");
            $("#selectall-work_type").trigger("change");
        });
    </script>
            
@stop