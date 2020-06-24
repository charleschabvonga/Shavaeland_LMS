@extends('layouts.app')

@section('content')
    
    {!! Form::model($employee, ['method' => 'PUT', 'route' => ['admin.employees.update', $employee->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">EMPLOYEE</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('name', trans('global.employees.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Name', 'required' => '']) !!}
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-4 form-group">
                    {!! Form::label('department', trans('global.employees.fields.department').'', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-department">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-department">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('department[]', $departments, old('department') ? old('department') : $employee->department->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-department' ]) !!}
                    @if($errors->has('department'))
                        <p class="help-block">
                            {{ $errors->first('department') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('position', trans('global.employees.fields.position').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('position', $enum_position, old('position'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('position'))
                        <p class="help-block">
                            {{ $errors->first('position') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('status', trans('global.employees.fields.status').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('end_date', trans('global.employees.fields.end-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('end_date', old('end_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('end_date'))
                        <p class="help-block">
                            {{ $errors->first('end_date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('start_date', trans('global.employees.fields.start-date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('start_date', old('start_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('start_date'))
                        <p class="help-block">
                            {{ $errors->first('start_date') }}
                        </p>
                    @endif
                </div>
            </div>
           
            <div class="row">
                <div class="col-xs-6 form-group">
                    {!! Form::label('street_address', trans('global.employees.fields.street-address').'', ['class' => 'control-label']) !!}
                    {!! Form::text('street_address', old('street_address'), ['class' => 'form-control', 'placeholder' => 'Street address']) !!}
                    @if($errors->has('street_address'))
                        <p class="help-block">
                            {{ $errors->first('street_address') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('city', trans('global.employees.fields.city').'', ['class' => 'control-label']) !!}
                    {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder' => 'City']) !!}
                    @if($errors->has('city'))
                        <p class="help-block">
                            {{ $errors->first('city') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('province', trans('global.employees.fields.province').'', ['class' => 'control-label']) !!}
                    {!! Form::text('province', old('province'), ['class' => 'form-control', 'placeholder' => 'Province']) !!}
                    @if($errors->has('province'))
                        <p class="help-block">
                            {{ $errors->first('province') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('country', trans('global.employees.fields.country').'', ['class' => 'control-label']) !!}
                    {!! Form::text('country', old('country'), ['class' => 'form-control', 'placeholder' => 'Country']) !!}
                    @if($errors->has('country'))
                        <p class="help-block">
                            {{ $errors->first('country') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('email', trans('global.employees.fields.email').'', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('int_mobile', trans('global.employees.fields.int-mobile').'', ['class' => 'control-label']) !!}
                    {!! Form::text('int_mobile', old('int_mobile'), ['class' => 'form-control', 'placeholder' => 'Int mobile No.']) !!}
                    @if($errors->has('int_mobile'))
                        <p class="help-block">
                            {{ $errors->first('int_mobile') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('sa_mobile', trans('global.employees.fields.sa-mobile').'', ['class' => 'control-label']) !!}
                    {!! Form::text('sa_mobile', old('sa_mobile'), ['class' => 'form-control', 'placeholder' => 'SA mobile No.']) !!}
                    @if($errors->has('sa_mobile'))
                        <p class="help-block">
                            {{ $errors->first('sa_mobile') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">EMERGENCY CONTACTS</span></legend>
                        <thead>
                        <tr>
                            <th>@lang('global.emergency-contacts.fields.name')</th>
                            <th>@lang('global.emergency-contacts.fields.phone1')</th>
                            <th>@lang('global.emergency-contacts.fields.phone')</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="emergency-contacts">
                            @forelse(old('emergency_contacts', []) as $index => $data)
                                @include('admin.employees.emergency_contacts_row', [
                                    'index' => $index
                                ])
                            @empty
                                @foreach($employee->emergency_contacts as $item)
                                    @include('admin.employees.emergency_contacts_row', [
                                        'index' => 'id-' . $item->id,
                                        'field' => $item
                                    ])
                                @endforeach
                            @endforelse
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary pull-right add-new">@lang('global.app_add_new')</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">BENEFICIARY DETAILS</span></legend>
                        <thead>
                            <tr>
                                <th>@lang('global.beneficiary-details.fields.beneficiary-name')</th>
                                    <th>@lang('global.beneficiary-details.fields.id-number')</th>
                                    <th>@lang('global.beneficiary-details.fields.address')</th>
                                    <th>@lang('global.beneficiary-details.fields.phone1')</th>
                                    <th>@lang('global.beneficiary-details.fields.phone')</th>
                                    <th>@lang('global.beneficiary-details.fields.allocation-percentage')</th>
                                    
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody id="beneficiary-details">
                                @forelse(old('beneficiary_details', []) as $index => $data)
                                    @include('admin.employees.beneficiary_details_row', [
                                        'index' => $index
                                    ])
                                @empty
                                    @foreach($employee->beneficiary_details as $item)
                                        @include('admin.employees.beneficiary_details_row', [
                                            'index' => 'id-' . $item->id,
                                            'field' => $item
                                        ])
                                    @endforeach
                                @endforelse
                            </tbody>
                        </table>
                        <a href="#" class="btn btn-primary pull-right add-new">@lang('global.app_add_new')</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">QUALIFICATIONS</span></legend>
                        <thead>
                        <tr>
                            <th>@lang('global.qualifications.fields.institution')</th>
                            <th>@lang('global.qualifications.fields.description')</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="qualifications">
                            @forelse(old('qualifications', []) as $index => $data)
                                @include('admin.employees.qualifications_row', [
                                    'index' => $index
                                ])
                            @empty
                                @foreach($employee->qualifications as $item)
                                    @include('admin.employees.qualifications_row', [
                                        'index' => 'id-' . $item->id,
                                        'field' => $item
                                    ])
                                @endforeach
                            @endforelse
                        </tbody>
                    </table>
                    <div class="col-xs-4 form-group">
                        {!! Form::label('upload_qualifications', trans('global.employees.fields.upload-qualifications').'', ['class' => 'control-label']) !!}
                        {!! Form::hidden('upload_qualifications', old('upload_qualifications')) !!}
                        @if ($employee->upload_qualifications)
                            <a href="{{ asset(env('UPLOAD_PATH').'/' . $employee->upload_qualifications) }}" target="_blank">Download file</a>
                        @endif
                        {!! Form::file('upload_qualifications', ['class' => 'form-control']) !!}
                        {!! Form::hidden('upload_qualifications_max_size', 4) !!}
                        <p class="help-block">Upload qualifications</p>
                        @if($errors->has('upload_qualifications'))
                            <p class="help-block">
                                {{ $errors->first('upload_qualifications') }}
                            </p>
                        @endif
                    </div>
                    <a href="#" class="btn btn-primary pull-right add-new">@lang('global.app_add_new')</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">IDENTIFICATIONS</span></legend>
                        <thead>
                        <tr>
                            <th>@lang('global.identifications.fields.id-type')</th>
                            <th>@lang('global.identifications.fields.id-number')</th>
                            <th>@lang('global.identifications.fields.expiry-date')</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="identifications">
                            @forelse(old('identifications', []) as $index => $data)
                                @include('admin.employees.identifications_row', [
                                    'index' => $index
                                ])
                            @empty
                                @foreach($employee->identifications as $item)
                                    @include('admin.employees.identifications_row', [
                                        'index' => 'id-' . $item->id,
                                        'field' => $item
                                    ])
                                @endforeach
                            @endforelse
                        </tbody>
                    </table>
                    <div class="col-xs-4 form-group">
                        {!! Form::label('upload_identification_docs', trans('global.employees.fields.upload-identification-docs').'', ['class' => 'control-label']) !!}
                        {!! Form::hidden('upload_identification_docs', old('upload_identification_docs')) !!}
                        @if ($employee->upload_identification_docs)
                            <a href="{{ asset(env('UPLOAD_PATH').'/' . $employee->upload_identification_docs) }}" target="_blank">Download file</a>
                        @endif
                        {!! Form::file('upload_identification_docs', ['class' => 'form-control']) !!}
                        {!! Form::hidden('upload_identification_docs_max_size', 4) !!}
                        <p class="help-block">Upload identification docs</p>
                        @if($errors->has('upload_identification_docs'))
                            <p class="help-block">
                                {{ $errors->first('upload_identification_docs') }}
                            </p>
                        @endif
                    </div>
                    <a href="#" class="btn btn-primary pull-right add-new">@lang('global.app_add_new')</a>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="qualifications-template">
        @include('admin.employees.qualifications_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="emergency-contacts-template">
        @include('admin.employees.emergency_contacts_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="identifications-template">
        @include('admin.employees.identifications_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="beneficiary-details-template">
        @include('admin.employees.beneficiary_details_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

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
            
            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>
    <script>
        $("#selectbtn-department").click(function(){
            $("#selectall-department > option").prop("selected","selected");
            $("#selectall-department").trigger("change");
        });
        $("#deselectbtn-department").click(function(){
            $("#selectall-department > option").prop("selected","");
            $("#selectall-department").trigger("change");
        });
    </script>
@stop