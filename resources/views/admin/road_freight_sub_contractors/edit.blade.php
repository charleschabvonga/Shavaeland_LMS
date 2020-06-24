@extends('layouts.app')

@section('content')
    
    {!! Form::model($road_freight_sub_contractor, ['method' => 'PUT', 'route' => ['admin.road_freight_sub_contractors.update', $road_freight_sub_contractor->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

        <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">TRANSPORTER REQUIREMENT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('subcontractor_number', trans('global.road-freight-sub-contractors.fields.subcontractor-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('subcontractor_number', old('subcontractor_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'readonly']) !!}
                    @if($errors->has('subcontractor_number'))
                        <p class="help-block">
                            {{ $errors->first('subcontractor_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('git_status', trans('global.road-freight-sub-contractors.fields.git-status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('git_status', $enum_git_status, old('git_status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('git_status'))
                        <p class="help-block">
                            {{ $errors->first('git_status') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.road-freight-sub-contractors.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('vendor_id', trans('global.road-freight-sub-contractors.fields.vendor').'', ['class' => 'control-label']) !!}
                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('vendor_id'))
                        <p class="help-block">
                            {{ $errors->first('vendor_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('git_cover_number', trans('global.road-freight-sub-contractors.fields.git-cover-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('git_cover_number', old('git_cover_number'), ['class' => 'form-control', 'placeholder' => 'Git cover No.']) !!}
                    @if($errors->has('git_cover_number'))
                        <p class="help-block">
                            {{ $errors->first('git_cover_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('git_expiry_date', trans('global.road-freight-sub-contractors.fields.git-expiry-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('git_expiry_date', old('git_expiry_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('git_expiry_date'))
                        <p class="help-block">
                            {{ $errors->first('git_expiry_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('git_cover', trans('global.road-freight-sub-contractors.fields.git-cover').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('git_cover', old('git_cover')) !!}
                    @if ($road_freight_sub_contractor->git_cover)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $road_freight_sub_contractor->git_cover) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('git_cover', ['class' => 'form-control']) !!}
                    {!! Form::hidden('git_cover_max_size', 4) !!}
                    <p class="help-block">Upload Git cover documents</p>
                    @if($errors->has('git_cover'))
                        <p class="help-block">
                            {{ $errors->first('git_cover') }}
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
            
        });
    </script>
            
@stop