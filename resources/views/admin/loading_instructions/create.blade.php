@extends('layouts.app')

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.loading_instructions.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">LOADING INSTRUCTION</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('road_freight_number_id', trans('global.loading-instruction.fields.road-freight-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('road_freight_number_id', $road_freight_numbers, old('road_freight_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('road_freight_number_id'))
                        <p class="help-block">
                            {{ $errors->first('road_freight_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('freight_contract_type', trans('global.loading-instruction.fields.freight-contract-type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('freight_contract_type', $enum_freight_contract_type, old('freight_contract_type'), ['class' => 'form-control select2 freight_contract_type', 'required' => '']) !!}
                    @if($errors->has('freight_contract_type'))
                        <p class="help-block">
                            {{ $errors->first('freight_contract_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('status', trans('global.loading-instruction.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('loading_instruction_number', trans('global.loading-instruction.fields.loading-instruction-number').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='loading_instruction_number' value='{{ $loading_instruction_number }}' class="form-control" readonly required/></td>
                    @if($errors->has('loading_instruction_number'))
                        <p class="help-block">
                            {{ $errors->first('loading_instruction_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.loading-instruction.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='prepared_by' value='{{ Auth::user()->name }}' class="form-control" readonly/></td>
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
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
                                    {!! Form::label('driver_id', trans('global.loading-instruction.fields.driver').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('driver_id', $drivers, old('driver_id'), ['class' => 'form-control select2 driver_id']) !!}
                                    @if($errors->has('driver_id'))
                                        <p class="help-block">
                                            {{ $errors->first('driver_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('vehicle_id', trans('global.loading-instruction.fields.vehicle').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('vehicle_id', $vehicles, old('vehicle_id'), ['class' => 'form-control select2 vehicle_id']) !!}
                                    @if($errors->has('vehicle_id'))
                                        <p class="help-block">
                                            {{ $errors->first('vehicle_id') }}
                                        </p>
                                    @endif
                                </div>
                                <br><br>
                                <div class="col-xs-12">
                                    {!! Form::label('trailers', trans('global.loading-instruction.fields.trailers').'', ['class' => 'control-label trailers_id']) !!}
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
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('vendor_id', trans('global.loading-instruction.fields.vendor').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2 vendor_id']) !!}
                                    @if($errors->has('vendor_id'))
                                        <p class="help-block">
                                            {{ $errors->first('vendor_id') }}
                                        </p>
                                    @endif
                                </div>
                                <div class="col-xs-6 form-group">
                                    {!! Form::label('vendor_driver_id', trans('global.loading-instruction.fields.vendor-driver').'', ['class' => 'control-label']) !!}
                                    {!! Form::select('vendor_driver_id', $vendor_drivers, old('vendor_driver_id'), ['class' => 'form-control select2 vendor_driver_id']) !!}
                                    @if($errors->has('vendor_driver_id'))
                                        <p class="help-block">
                                            {{ $errors->first('vendor_driver_id') }}
                                        </p>
                                     @endif
                                </div><br><br>
                                <div class="col-xs-12 form-group">
                                    {!! Form::label('vendor_vehicle_description', trans('global.loading-instruction.fields.vendor-vehicle-description').'', ['class' => 'control-label']) !!}
                                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-vendor_vehicle_description">
                                        {{ trans('global.app_select_all') }}
                                    </button>
                                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-vendor_vehicle_description">
                                        {{ trans('global.app_deselect_all') }}
                                    </button>
                                    {!! Form::select('vendor_vehicle_description[]', $vendor_vehicle_descriptions, old('vendor_vehicle_description'), ['class' => 'form-control select2 vendor_vehicle_description_id', 'multiple' => 'multiple', 'id' => 'selectall-vendor_vehicle_description' ]) !!}
                                    @if($errors->has('vendor_vehicle_description'))
                                        <p class="help-block">
                                            {{ $errors->first('vendor_vehicle_description') }}
                                        </p>
                                    @endif
                                </div>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('client_id', trans('global.loading-instruction.fields.client').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('contact_person_id', trans('global.loading-instruction.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('project_manager_id', trans('global.loading-instruction.fields.project-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_manager_id', $project_managers, old('project_manager_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('project_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('project_manager_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('order_number', trans('global.loading-instruction.fields.order-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('order_number', old('order_number'), ['class' => 'form-control', 'placeholder' => 'Order No.']) !!}
                    @if($errors->has('order_number'))
                        <p class="help-block">
                            {{ $errors->first('order_number') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('pick_up_company_name', trans('global.loading-instruction.fields.pick-up-company-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('pick_up_company_name', old('pick_up_company_name'), ['class' => 'form-control', 'placeholder' => 'Pickup company name', 'required' => '']) !!}
                    @if($errors->has('pick_up_company_name'))
                        <p class="help-block">
                            {{ $errors->first('pick_up_company_name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-6 form-group">
                    {!! Form::label('pickup_address_address', trans('global.loading-instruction.fields.pickup-address').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('pickup_address_address', old('pickup_address_address'), ['class' => 'form-control map-input', 'id' => 'pickup_address-input', 'required' => '']) !!}
                    {!! Form::hidden('pickup_address_latitude', 0 , ['id' => 'pickup_address-latitude']) !!}
                    {!! Form::hidden('pickup_address_longitude', 0 , ['id' => 'pickup_address-longitude']) !!}
                    @if($errors->has('pickup_address'))
                        <p class="help-block">
                            {{ $errors->first('pickup_address') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('pickup_date_time', trans('global.loading-instruction.fields.pickup-date-time').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('pickup_date_time', old('pickup_date_time'), ['class' => 'form-control datetime', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('pickup_date_time'))
                        <p class="help-block">
                            {{ $errors->first('pickup_date_time') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">LOAD DESCRIPTIONS</span></legend>
                        <thead>
                        <tr>
                            <th>@lang('global.load-descriptions.fields.description')</th>
                            <th width="15%">@lang('global.load-descriptions.fields.qty')</th>
                            <th width="15%">@lang('global.load-descriptions.fields.weight-volume')</th>
                            <th width="9%">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="load-descriptions">
                            @foreach(old('load_descriptions', []) as $index => $data)
                                @include('admin.loading_instructions.load_descriptions_row', [
                                    'index' => $index
                                ])
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary pull-right add-new">@lang('global.app_add_new')</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">LOADING REQUIREMENTS</span></legend>
                        <thead>
                        <tr>
                            <th>@lang('global.loading-requirements.fields.item-description')</th>
                            <th width="15%">@lang('global.loading-requirements.fields.qty')</th>    
                            <th width="9%">Actions</th>
                        </tr>
                        </thead>
                        <tbody id="loading-requirements">
                            @foreach(old('loading_requirements', []) as $index => $data)
                                @include('admin.loading_instructions.loading_requirements_row', [
                                    'index' => $index
                                ])
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary pull-right add-new">@lang('global.app_add_new')</a>
                </div>
            </div>

            <div id="pickup_address-map-container" style="width:100%;height:200px; ">
                <div style="width: 100%; height: 100%" id="pickup_address-map"></div>
            </div>
            @if(!env('GOOGLE_MAPS_API_KEY'))
                <b>'GOOGLE_MAPS_API_KEY' is not set in the .env</b>
            @endif
            
        </div>
    </div>
    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent
   <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GOOGLE_MAPS_API_KEY') }}&libraries=places&callback=initialize" async defer></script>
   <script src="/adminlte/js/mapInput.js"></script>

    <script type="text/html" id="loading-requirements-template">
        @include('admin.loading_instructions.loading_requirements_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="load-descriptions-template">
        @include('admin.loading_instructions.load_descriptions_row',
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
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
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
        $("#selectbtn-vehicle_description").click(function(){
            $("#selectall-vehicle_description > option").prop("selected","selected");
            $("#selectall-vehicle_description").trigger("change");
        });
        $("#deselectbtn-vehicle_description").click(function(){
            $("#selectall-vehicle_description > option").prop("selected","");
            $("#selectall-vehicle_description").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-vendor_vehicle_description").click(function(){
            $("#selectall-vendor_vehicle_description > option").prop("selected","selected");
            $("#selectall-vendor_vehicle_description").trigger("change");
        });
        $("#deselectbtn-vendor_vehicle_description").click(function(){
            $("#selectall-vendor_vehicle_description > option").prop("selected","");
            $("#selectall-vendor_vehicle_description").trigger("change");
        });
    </script>

    <script>
        //Income category validation
        var selectSeaFreightFreight = document.getElementById("client_id");
        selectSeaFreightFreight.onchange = function() { nameTextField.value = selectSeaFreightFreight.selectedOptions[0].innerText };

        var nameTextField = document.getElementById("pick_up_company_name");
    </script>

    <script>
        $(document).ready(function(){     
            $('.vendor_id').prop('disabled', true);       
            $('.vendor_driver_id').prop('disabled', true);
            $('.vendor_vehicle_description_id').prop('disabled', true);
            $('#selectbtn-vendor_vehicle_description').prop('disabled', true);
            $('#deselectbtn-vendor_vehicle_description').prop('disabled', true);
            

            $('.freight_contract_type').change(function(){
                var selectedOption = $('.freight_contract_type option:selected');
                if(selectedOption.val() === 'Shavaeland'){
                    $('.vendor_id').prop('disabled', true);       
                    $('.vendor_driver_id').prop('disabled', true);
                    $('.vendor_vehicle_description_id').prop('disabled', true);
                    $('#selectbtn-vendor_vehicle_description').prop('disabled', true);
                    $('#deselectbtn-vendor_vehicle_description').prop('disabled', true);

                    $('.driver_id').prop('disabled', false);
                    $('.vehicle_id').prop('disabled', false);
                    $('.trailers_id').prop('disabled', false);
                    $('#selectbtn-trailers').prop('disabled', false);
                    $('#deselectbtn-trailers').prop('disabled', false);                 
                }

                if(selectedOption.val() === 'Subcontractor'){
                    $('.vendor_id').prop('disabled', false);
                    $('.vendor_driver_id').prop('disabled', false);
                    $('.vendor_vehicle_description_id').prop('disabled', false);
                    $('#selectbtn-vendor_vehicle_description').prop('disabled', false);
                    $('#deselectbtn-vendor_vehicle_description').prop('disabled', false);

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