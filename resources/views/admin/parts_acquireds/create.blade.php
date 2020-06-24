@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.parts_acquireds.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">PART/ACCESSORY PROCUREMENT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.parts-acquired.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='prepared_by' value='{{ Auth::user()->name }}' class="form-control" readonly/></td>
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('order_number', trans('global.parts-acquired.fields.order-number').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='order_number' value='{{ $order_number }}' class="form-control" readonly required/></td>
                    @if($errors->has('order_number'))
                        <p class="help-block">
                            {{ $errors->first('order_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('date', trans('global.parts-acquired.fields.date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('transaction_type', trans('global.parts-acquired.fields.transaction-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('transaction_type', $enum_transaction_type, old('transaction_type'), ['class' => 'form-control select2 transaction_type_id']) !!}
                    @if($errors->has('transaction_type'))
                        <p class="help-block">
                            {{ $errors->first('transaction_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('repair_center_id', trans('global.parts-acquired.fields.repair-center').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('repair_center_id', $repair_centers, old('repair_center_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('repair_center_id'))
                        <p class="help-block">
                            {{ $errors->first('repair_center_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('dispatched_by_id', trans('global.parts-acquired.fields.dispatched-by').'', ['class' => 'control-label']) !!}
                    {!! Form::select('dispatched_by_id', $dispatched_by, old('dispatched_by_id'), ['class' => 'form-control select2 dispatched_by_id']) !!}
                    @if($errors->has('dispatched_by_id'))
                        <p class="help-block">
                            {{ $errors->first('dispatched_by_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('received_by_id', trans('global.parts-acquired.fields.received-by').'', ['class' => 'control-label']) !!}
                    {!! Form::select('received_by_id', $received_by, old('received_by_id'), ['class' => 'form-control select2 received_by_id']) !!}
                    @if($errors->has('received_by_id'))
                        <p class="help-block">
                            {{ $errors->first('received_by_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">PART/ACCESSORY ITEM</span></legend> 
                        <thead>
                        <tr>
                            <th >@lang('global.parts-acquired.fields.part')</th>
                            <th width="15%">@lang('global.parts-acquired.fields.qty')</th>
                            <th width="15%">@lang('global.parts-acquired.fields.unit-price')</th>
                            <th width="15%">@lang('global.parts-acquired.fields.unit')</th>
                            <th width="15%">@lang('global.parts-acquired.fields.total')</th>
                        </tr>
                        </thead>
                        <tbody id="invoice-items">
                            <tr id='addr0'>
                                <td>{!! Form::select('part_id', $parts, old('part_id'), ['class' => 'form-control select2', 'required' => '']) !!}</td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <input type="text" name='qty' placeholder='0' class="form-control qty" step="0" min="0"/>
                                        <div class="input-group-addon"></div>
                                    </div>
                                </td>
                                <td>{!! Form::select('unit_id', $units, old('unit_id'), ['class' => 'form-control select2']) !!}</td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='unit_price' placeholder='0.00' class="form-control unit_price" step="0.00" min="0"/>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='total' placeholder='0.00' class="form-control total" readonly/>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
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
                    var price = $(this).find('.unit_price').val();
                    $(this).find('.total').val((qty*price).toFixed(2));
                }
            });
        }
    </script>

    <script>
        $(document).ready(function(){            
            $('.dispatched_by_id').prop('disabled', true);        

            $('.transaction_type_id').change(function(){
                var selectedOption = $('.transaction_type_id option:selected');
                if(selectedOption.val() === 'Procurement'){
                    $('.dispatched_by_id').prop('disabled', true);  
                    $('.received_by_id').prop('disabled', false);                
                }

                if(selectedOption.val() === 'Request'){
                    $('.dispatched_by_id').prop('disabled', false); 
                    $('.received_by_id').prop('disabled', false);
                }
            });
        });
    </script>            
@stop