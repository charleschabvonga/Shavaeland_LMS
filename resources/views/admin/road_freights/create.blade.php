@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.road_freights.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">ROAD FREIGHT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('project_number_id', trans('global.road-freights.fields.project-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('project_number_id', $project_numbers, old('project_number_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('project_number_id'))
                        <p class="help-block">
                            {{ $errors->first('project_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('route_id', trans('global.road-freights.fields.route').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('route_id', $routes, old('route_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('route_id'))
                        <p class="help-block">
                            {{ $errors->first('route_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('project_manager_id', trans('global.road-freights.fields.project-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_manager_id', $project_managers, old('project_manager_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('project_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('project_manager_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('road_freight_number', trans('global.road-freights.fields.road-freight-number').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='road_freight_number' value='{{ $road_freight_number }}' class="form-control" readonly required/></td>
                    @if($errors->has('road_freight_number'))
                        <p class="help-block">
                            {{ $errors->first('road_freight_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('road_freight_income', trans('global.road-freights.fields.road-freight-income').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('road_freight_income', old('road_freight_income'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    @if($errors->has('road_freight_income'))
                        <p class="help-block">
                            {{ $errors->first('road_freight_income') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('freight_contract_type', trans('global.road-freights.fields.freight-contract-type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('freight_contract_type', $enum_freight_contract_type, old('freight_contract_type'), ['class' => 'form-control select2 freight_contract_type', 'required' => '']) !!}
                    @if($errors->has('freight_contract_type'))
                        <p class="help-block">
                            {{ $errors->first('freight_contract_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('client_id', trans('global.road-freights.fields.client').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('contact_person_id', trans('global.road-freights.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-6 form-group">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                            <legend class="text-center"><span style="color:#CE8F64">SHAVAELAND INFO</span></legend>
                            <div class="col-xs-6 form-group">
                                {!! Form::label('driver_id', trans('global.road-freights.fields.driver').'', ['class' => 'control-label']) !!}
                                {!! Form::select('driver_id', $drivers, old('driver_id'), ['class' => 'form-control select2 driver_id']) !!}
                                @if($errors->has('driver_id'))
                                    <p class="help-block">
                                        {{ $errors->first('driver_id') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-xs-6 form-group">
                                {!! Form::label('vehicle_id', trans('global.road-freights.fields.vehicle').'', ['class' => 'control-label']) !!}
                                {!! Form::select('vehicle_id', $vehicles, old('vehicle_id'), ['class' => 'form-control select2 vehicle_id']) !!}
                                @if($errors->has('vehicle_id'))
                                    <p class="help-block">
                                        {{ $errors->first('vehicle_id') }}
                                    </p>
                                @endif
                            </div>
                            <br>
                            <div class="col-xs-12 form-group">
                                {!! Form::label('trailers', trans('global.road-freights.fields.trailers').'', ['class' => 'control-label']) !!}
                                <button type="button" class="btn btn-primary btn-xs" id="selectbtn-trailers">
                                    {{ trans('global.app_select_all') }}
                                </button>
                                <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-trailers">
                                    {{ trans('global.app_deselect_all') }}
                                </button>
                                {!! Form::select('trailers[]', $trailers, old('trailers'), ['class' => 'form-control select2 trailers_id', 'multiple' => 'multiple', 'id' => 'selectall-trailers' ]) !!}
                                @if($errors->has('trailers'))
                                    <p class="help-block">
                                        {{ $errors->first('trailers') }}
                                    </p>
                                @endif
                            </div>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xs-6 form-group">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                            <legend class="text-center"><span style="color:#CE8F64">SUBCONTRACTOR INFO</span></legend>
                            <div class="col-xs-6">
                                {!! Form::label('vendor_id', trans('global.road-freights.fields.vendor').'', ['class' => 'control-label']) !!}
                                {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2 vendor_id']) !!}
                                @if($errors->has('vendor_id'))
                                    <p class="help-block">
                                        {{ $errors->first('vendor_id') }}
                                    </p>
                                @endif<br><br>
                                {!! Form::label('vendor_contact_person_id', trans('global.road-freights.fields.vendor-contact-person').'', ['class' => 'control-label']) !!}
                                {!! Form::select('vendor_contact_person_id', $vendor_contact_people, old('vendor_contact_person_id'), ['class' => 'form-control select2 vendor_contact_person_id']) !!}
                                @if($errors->has('vendor_contact_person_id'))
                                    <p class="help-block">
                                        {{ $errors->first('vendor_contact_person_id') }}
                                    </p>
                                @endif
                            </div>
                            <div class="col-xs-6">
                                {!! Form::label('vendor_drivers', trans('global.road-freights.fields.vendor-drivers').'', ['class' => 'control-label']) !!}
                                <button type="button" class="btn btn-primary btn-xs" id="selectbtn-vendor_drivers">
                                    {{ trans('global.app_select_all') }}
                                </button>
                                <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-vendor_drivers">
                                    {{ trans('global.app_deselect_all') }}
                                </button>
                                {!! Form::select('vendor_drivers[]', $vendor_drivers, old('vendor_drivers'), ['class' => 'form-control select2 vendor_drivers_id', 'multiple' => 'multiple', 'id' => 'selectall-vendor_drivers' ]) !!}
                                @if($errors->has('vendor_drivers'))
                                    <p class="help-block">
                                        {{ $errors->first('vendor_drivers') }}
                                    </p>
                                @endif<br><br>
                                {!! Form::label('vendor_vehicles', trans('global.road-freights.fields.vendor-vehicles').'', ['class' => 'control-label']) !!}
                                <button type="button" class="btn btn-primary btn-xs" id="selectbtn-vendor_vehicles">
                                    {{ trans('global.app_select_all') }}
                                </button>
                                <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-vendor_vehicles">
                                    {{ trans('global.app_deselect_all') }}
                                </button>
                                {!! Form::select('vendor_vehicles[]', $vendor_vehicles, old('vendor_vehicles'), ['class' => 'form-control select2 vendor_vehicles_id', 'multiple' => 'multiple', 'id' => 'selectall-vendor_vehicles' ]) !!}
                                @if($errors->has('vendor_vehicles'))
                                    <p class="help-block">
                                        {{ $errors->first('vendor_vehicles') }}
                                    </p>
                                @endif
                            </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">ROAD FREIGHT EXPENSES</span></legend>
                        <thead>
                        <tr>
                            <th>@lang('global.non-machine-costs.fields.item-description')</th>
                            <th width="13%">@lang('global.non-machine-costs.fields.qty')</th>
                            <th width="15%">@lang('global.non-machine-costs.fields.cost')</th>
                            <th width="15%">@lang('global.non-machine-costs.fields.total')</th>
                            <th width="9%"></th>
                        </tr>
                        </thead>
                        <tbody id="non-machine-costs">
                            @foreach(old('non_machine_costs', []) as $index => $data)
                                @include('admin.road_freights.non_machine_costs_row', [
                                    'index' => $index
                                ])
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary pull-right add-new">@lang('global.app_add_new')</a>
                </div>
            </div>

        </div>
    </div>
    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="non-machine-costs-template">
        @include('admin.road_freights.non_machine_costs_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

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
        $("#selectbtn-driver").click(function(){
            $("#selectall-driver > option").prop("selected","selected");
            $("#selectall-driver").trigger("change");
        });
        $("#deselectbtn-driver").click(function(){
            $("#selectall-driver > option").prop("selected","");
            $("#selectall-driver").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-vehicles").click(function(){
            $("#selectall-vehicles > option").prop("selected","selected");
            $("#selectall-vehicles").trigger("change");
        });
        $("#deselectbtn-vehicles").click(function(){
            $("#selectall-vehicles > option").prop("selected","");
            $("#selectall-vehicles").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-vendor_drivers").click(function(){
            $("#selectall-vendor_drivers > option").prop("selected","selected");
            $("#selectall-vendor_drivers").trigger("change");
        });
        $("#deselectbtn-vendor_drivers").click(function(){
            $("#selectall-vendor_drivers > option").prop("selected","");
            $("#selectall-vendor_drivers").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-vendor_vehicles").click(function(){
            $("#selectall-vendor_vehicles > option").prop("selected","selected");
            $("#selectall-vendor_vehicles").trigger("change");
        });
        $("#deselectbtn-vendor_vehicles").click(function(){
            $("#selectall-vendor_vehicles > option").prop("selected","");
            $("#selectall-vendor_vehicles").trigger("change");
        });
    </script>

    <script>
        $(document).ready(function(){            
            $('.vendor_id').prop('disabled', true);
            $('.vendor_contact_person_id').prop('disabled', true);
            $('.vendor_drivers_id').prop('disabled', true);
            $('.vendor_vehicles_id').prop('disabled', true);
            $('#selectbtn-vendor_drivers').prop('disabled', true);
            $('#deselectbtn-vendor_drivers').prop('disabled', true);
            $('#selectbtn-vendor_vehicles').prop('disabled', true);
            $('#deselectbtn-vendor_vehicles').prop('disabled', true);

            $('.freight_contract_type').change(function(){
                var selectedOption = $('.freight_contract_type option:selected');
                if(selectedOption.val() === 'Shavaeland'){
                    $('.vendor_id').prop('disabled', true);
                    $('.vendor_contact_person_id').prop('disabled', true);
                    $('.vendor_drivers_id').prop('disabled', true);
                    $('.vendor_vehicles_id').prop('disabled', true);
                    $('#selectbtn-vendor_drivers').prop('disabled', true);
                    $('#deselectbtn-vendor_drivers').prop('disabled', true);
                    $('#selectbtn-vendor_vehicles').prop('disabled', true);
                    $('#deselectbtn-vendor_vehicles').prop('disabled', true);

                    $('.driver_id').prop('disabled', false);
                    $('.vehicle_id').prop('disabled', false);
                    $('.trailers_id').prop('disabled', false);
                    $('#selectbtn-trailers').prop('disabled', false);
                    $('#deselectbtn-trailers').prop('disabled', false);                
                }

                if(selectedOption.val() === 'Subcontractor'){
                    $('.vendor_id').prop('disabled', false);
                    $('.vendor_contact_person_id').prop('disabled', false);
                    $('.vendor_drivers_id').prop('disabled', false);
                    $('.vendor_vehicles_id').prop('disabled', false);
                    $('#selectbtn-vendor_drivers').prop('disabled', false);
                    $('#deselectbtn-vendor_drivers').prop('disabled', false);
                    $('#selectbtn-vendor_vehicles').prop('disabled', false);
                    $('#deselectbtn-vendor_vehicles').prop('disabled', false);

                    $('.driver_id').prop('disabled', true);
                    $('.vehicle_id').prop('disabled', true);
                    $('.trailers_id').prop('disabled', true);
                    $('#selectbtn-trailers').prop('disabled', true);
                    $('#deselectbtn-trailers').prop('disabled', true);   
                }
            });
        });
    </script>
@stop