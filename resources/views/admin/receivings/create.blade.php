@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.receivings.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">WAREHOUSE GOODS RECEIPT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('date', trans('global.receiving.fields.date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('project_number_id', trans('global.receiving.fields.project-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('project_number_id', $project_numbers, old('project_number_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('project_number_id'))
                        <p class="help-block">
                            {{ $errors->first('project_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('warehouse_id', trans('global.receiving.fields.warehouse').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('warehouse_id', $warehouses, old('warehouse_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('warehouse_id'))
                        <p class="help-block">
                            {{ $errors->first('warehouse_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.receiving.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='prepared_by' value='{{ Auth::user()->name }}' class="form-control" readonly/></td>
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('receipt_number', trans('global.receiving.fields.receipt-number').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='receipt_number' value='{{ $receipt_number }}' class="form-control" readonly required/></td>
                    @if($errors->has('receipt_number'))
                        <p class="help-block">
                            {{ $errors->first('receipt_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('client_id', trans('global.receiving.fields.client').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('contact_person_id', trans('global.receiving.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('received_by_id', trans('global.receiving.fields.received-by').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('received_by_id', $received_bies, old('received_by_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('received_by_id'))
                        <p class="help-block">
                            {{ $errors->first('received_by_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('project_manager_id', trans('global.receiving.fields.project-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_manager_id', $project_managers, old('project_manager_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('project_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('project_manager_id') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                                <legend class="text-center"><span style="color:#CE8F64">WAREHOUSE RECEIVED GOODS</span></legend>
                                <thead>
                                <tr>
                                    <th>@lang('global.received-items.fields.item')</th>
                                    <th>@lang('global.received-items.fields.qty')</th>
                                    <th>@lang('global.received-items.fields.area')</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="warehouse-items">
                                    @foreach(old('received_items', []) as $index => $data)
                                        @include('admin.receivings.received_items_row', [
                                            'index' => $index
                                        ])
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">WAREHOUSING COSTS</span></legend> 
                        <thead>
                        <tr>
                            <th width="25%">@lang('global.receiving.fields.rate')</th>
                            <th width="25%">@lang('global.receiving.fields.days')</th>
                            <th width="25%">@lang('global.receiving.fields.total-area-coverd')</th>
                            <th width="25%">@lang('global.receiving.fields.total-amount')</th>
                        </tr>
                        </thead>
                        <tbody id="invoice-items">
                            <tr id='addr0'>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='rate' placeholder='0.00' class="form-control rate" step="0" min="0"/>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <input type="text" name='days' placeholder='0' class="form-control day" step="0.00" min="0"/>
                                        <div class="input-group-addon">days</div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <input type="text" name='total_area_coverd' placeholder='0' class="form-control area" />
                                        
                                        <div class="input-group-addon">m<sup>2</sup></div>
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="input-group mb-2 mb-sm-0">
                                        <div class="input-group-addon">R</div>
                                        <input type="text" name='total_amount' placeholder='0.00' class="form-control total" readonly/>
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

    <script type="text/html" id="warehouse-items-template">
        @include('admin.receivings.received_items_row',
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
                    var rate = $(this).find('.rate').val();
                    var day = $(this).find('.day').val();
                    var area = $(this).find('.area').val();
                    $(this).find('.total').val((rate*day*area).toFixed(2));
                }
            });
        }
    </script>
@stop