@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.client_job_cards.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">JOB CARD</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('date', trans('global.client-job-cards.fields.date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('job_request_number_id', trans('global.client-job-cards.fields.job-request-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('job_request_number_id', $job_request_numbers, old('job_request_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('job_request_number_id'))
                        <p class="help-block">
                            {{ $errors->first('job_request_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('project_number_id', trans('global.client-job-cards.fields.project-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_number_id', $project_numbers, old('project_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('project_number_id'))
                        <p class="help-block">
                            {{ $errors->first('project_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('job_card_number', trans('global.client-job-cards.fields.job-card-number').'', ['class' => 'control-label']) !!}
                    <input type="text" name='job_card_number' value='{{ $job_card_number }}' class="form-control" readonly required/>
                    @if($errors->has('job_card_number'))
                        <p class="help-block">
                            {{ $errors->first('job_card_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.client-job-cards.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    <input type="text" name='prepared_by' value='{{ Auth::user()->name }}' class="form-control" readonly/>
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('client_id', trans('global.client-job-cards.fields.client').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('contact_person_id', trans('global.client-job-cards.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('job_type', trans('global.client-job-cards.fields.job-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('job_type', $enum_job_type, old('job_type'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('job_type'))
                        <p class="help-block">
                            {{ $errors->first('job_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('repair_center_id', trans('global.client-job-cards.fields.repair-center').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('repair_center_id', $repair_centers, old('repair_center_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('repair_center_id'))
                        <p class="help-block">
                            {{ $errors->first('repair_center_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('technician', trans('global.client-job-cards.fields.technician').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-technician">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-technician">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('technician[]', $technicians, old('technician'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-technician' , 'required' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('technician'))
                        <p class="help-block">
                            {{ $errors->first('technician') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('client_vehicle_reg_no_id', trans('global.client-job-cards.fields.client-vehicle-reg-no').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_vehicle_reg_no_id', $client_vehicle_reg_nos, old('client_vehicle_reg_no_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('client_vehicle_reg_no_id'))
                        <p class="help-block">
                            {{ $errors->first('client_vehicle_reg_no_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('status', trans('global.client-job-cards.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>



            <div class="row">
                <div class="col-xs-6 form-group">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                            <legend class="text-center"><span style="color:#CE8F64">JOB CARD INSTRUCTIONS</span></legend> 
                                <div class="col-xs-12 form-group">
                                    {!! Form::textarea('instructions', old('instructions'), ['class' => 'form-control ', 'placeholder' => 'Job card instructions', 'rows'=> '7']) !!}
                                    @if($errors->has('instructions'))
                                        <p class="help-block">
                                            {{ $errors->first('instructions') }}
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
                            <legend class="text-center"><span style="color:#CE8F64">JOB CARD REMARKS</span></legend>
                            <div class="col-xs-12 form-group">
                                {!! Form::textarea('remarks', old('remarks'), ['class' => 'form-control ', 'placeholder' => 'Job card remarks', 'rows'=> '7']) !!}
                                @if($errors->has('remarks'))
                                    <p class="help-block">
                                        {{ $errors->first('remarks') }}
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
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active"><a href="#quotation_number_items" aria-controls="quotation_number_items" role="tab" data-toggle="tab">Workshop items</a></li>
                        </ul>
                        <thead>
                        <tr>
                            <th>@lang('#')</th>
                            <th width="20%">@lang('global.job-card-items.fields.workshop')</th>
                            <th width="26%">@lang('global.job-card-items.fields.part')</th>
                            <th width="15%">@lang('global.job-card-items.fields.qty')</th>
                            <th width="9%">@lang('unit')</th>
                            <th width="15%">@lang('global.job-card-items.fields.price')</th>
                            <th width="15%">@lang('global.job-card-items.fields.total')</th>
                            <th width="9%">@lang('')</th>
                        </tr>
                        </thead>
                        <tbody id="invoice-items">
                            <tr id='addr0'>
                                <td>1</td>
                                <td>
                                    <select name="workshop[]" class="form-control" id="workshop">
                                        @foreach($workshops as $workshop)
                                            <option value="{{ $workshop->center_name }}"> {{ $workshop->center_name }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td>
                                    <select name="part[]" class="form-control">
                                        @foreach($parts as $part)
                                            <option value="{{ $part->part }}"> {{ $part->part }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <input type="text" name='qty[]' placeholder='0' class="form-control qty" step="0" min="0"/>
                                    </div>
                                </td>
                                <td>
                                    <select name="unit[]" class="form-control" id="unit">
                                        @foreach($unit as $unit)
                                            <option value="{{ $unit->measurement_type }}"> {{ $unit->measurement_type }} </option>
                                        @endforeach
                                    </select>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='price[]' placeholder='0.00' class="form-control price" step="0.00" min="0"/>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='total[]' placeholder='0.00' class="form-control total" readonly/>
                                    </div>
                                </td>
                                <td class="text-center"><a href="#" class="remove btn btn-xs btn-danger">@lang('Delete')</a></td>
                            </tr>
                            <tr id='addr1'></tr>
                        </tbody>
                    </table>

                    <div class="row">
                        <div class="col-md-1 form-group pull-right"></div>
                        <div class="pull-right col-md-4">
                            <table class="table" id="tab_logic_total">
                                <tbody>
                                <tr>
                                    <th class="text-right" width="31%">Sub Total</th>
                                    <td class="text-center">
                                        <div class="input-group mb-2 mb-sm-0">
                                            <div class="input-group-addon">R</div>
                                            <input type="text" name='subtotal' placeholder='0.00' class="form-control subtotal" id="subtotal" readonly/>
                                        </div>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <input type="button" id="add_row" class="btn btn-primary float-left" value="Add Row" />
                            <input type="button" id='delete_row' class="float-right btn btn-info" value="Delete Row" /><br><br>
                        </div>
                    </div>
                    
                </div>
            </div>

        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="job-card-items-template">
        @include('admin.client_job_cards.job_card_items_row',
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
        $("#selectbtn-technician").click(function(){
            $("#selectall-technician > option").prop("selected","selected");
            $("#selectall-technician").trigger("change");
        });
        $("#deselectbtn-technician").click(function(){
            $("#selectall-technician > option").prop("selected","");
            $("#selectall-technician").trigger("change");
        });
    </script>

<script>
        //Income category validation
        var selectRepairCenter = document.getElementById("repair_center_id");
        selectRepairCenter.onchange = function() { nameTextField.value = selectRepairCenter.selectedOptions[0].innerText };

        var nameTextField = document.getElementById("workshop");
    </script>

    <script>
        $(document).ready(function(){            
            $('.road_freight_number_id').prop('disabled', true);
            $('.vehicle_id').prop('disabled', true);

            $('.client_type').change(function(){
                var selectedOption = $('.client_type option:selected');
                if(selectedOption.val() === 'Customer'){  
                    $('.client_vehicle_reg_no_id').prop('disabled', false);
                    $('.road_freight_number_id').prop('disabled', true);
                    $('.vehicle_id').prop('disabled', true);      
                }

                if(selectedOption.val() === 'Department'){
                    $('.client_vehicle_reg_no_id').prop('disabled', true);
                    $('.vehicle_id').prop('disabled', false);
                }

                $('.job_type').change(function(){
                    var selectedOption1 = $('.job_type option:selected');
                    if(selectedOption1.val() === 'Scheduled'){  
                        $('.road_freight_number_id').prop('disabled', true);                
                    }

                    if(selectedOption1.val() === 'Breakdown'){
                        $('.road_freight_number_id').prop('disabled', false);
                    }
                });
            });

            
        });
    </script>

    <script>
        $(document).ready(function(){
            var i=1;
            $("#add_row").click(function(){b=i-1;
                $('#addr'+i).html($('#addr'+b).html()).find('td:first-child').html(i+1);
                $('#tab_logic').append('<tr id="addr'+(i+1)+'"></tr>');
                i++;
            });
            $("#delete_row").click(function(){
                if(i>1){
                    $("#addr"+(i-1)).html('');
                    i--;
                }
                calc();
            });

            $('#tab_logic tbody').on('keyup change',function(){
                calc();
            });
            
        });

        function calc()
        {
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();
                if(html!='')
                {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    $(this).find('.total').val((qty*price).toFixed(2));

                    calc_total();
                }
            });
        }

        function calc_total()
        {
            total=0;
            $('.total').each(function() {
                total += parseInt($(this).val());
            });
            $('#subtotal').val(total.toFixed(2));
        }
    </script>
@stop