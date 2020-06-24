@extends('layouts.app')

@section('content')
    
    {!! Form::model($fuel_cost, ['method' => 'PUT', 'route' => ['admin.fuel_costs.update', $fuel_cost->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">FUEL PURCHASE</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('road_freight_number_id', trans('global.fuel-costs.fields.road-freight-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('road_freight_number_id', $road_freight_numbers, old('road_freight_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('road_freight_number_id'))
                        <p class="help-block">
                            {{ $errors->first('road_freight_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('vehicle_id', trans('global.fuel-costs.fields.vehicle').'', ['class' => 'control-label']) !!}
                    {!! Form::select('vehicle_id', $vehicles, old('vehicle_id'), ['class' => 'form-control select2 vehicle_id']) !!}
                    @if($errors->has('vehicle_id'))
                        <p class="help-block">
                            {{ $errors->first('vehicle_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('receipt_number', trans('global.fuel-costs.fields.receipt-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('receipt_number', old('receipt_number'), ['class' => 'form-control', 'placeholder' => 'receipt_number', 'readonly']) !!}
                    @if($errors->has('receipt_number'))
                        <p class="help-block">
                            {{ $errors->first('receipt_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">ROAD FREIGHT FUEL PURCHASE</span></legend> 
                        <thead>
                        <tr>
                            <th >@lang('global.fuel-costs.fields.description')</th>
                            <th width="15%">@lang('global.fuel-costs.fields.qty')</th>
                            <th width="15%">@lang('global.fuel-costs.fields.cost')</th>
                            <th width="15%">@lang('global.fuel-costs.fields.total')</th>
                        </tr>
                        </thead>
                        <tbody id="invoice-items">
                            <tr id='addr0'>
                                <td>{!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => 'Description']) !!}</td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <input type="text" name='qty' value='{{ $fuel_cost->qty }}' placeholder='0' class="form-control qty" step="0" min="0"/>
                                        <div class="input-group-addon"></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='cost' value='{{ $fuel_cost->cost}}' placeholder='0.00' class="form-control cost" step="0.00" min="0"/>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='total' value='{{ $fuel_cost->total }}' placeholder='0.00' class="form-control total" readonly/>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>  
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script>
        $(document).ready(function(){
            $('#tab_logic tbody').on('keyup change',function(){
                calc();
            });
        });

        function calc(){
            $('#tab_logic tbody tr').each(function(i, element) {
                var html = $(this).html();
                if(html!='')
                {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.cost').val();
                    $(this).find('.total').val((qty*price).toFixed(2));
                }
            });
        }
    </script>
            
@stop

