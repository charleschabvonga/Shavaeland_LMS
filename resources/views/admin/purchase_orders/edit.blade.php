@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.purchase-orders.title')</h3>
    
    {!! Form::model($purchase_order, ['method' => 'PUT', 'route' => ['admin.purchase_orders.update', $purchase_order->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vendor_id', trans('global.purchase-orders.fields.vendor').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">Vendor</p>
                    @if($errors->has('vendor_id'))
                        <p class="help-block">
                            {{ $errors->first('vendor_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('contact_person_id', trans('global.purchase-orders.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Contact person</p>
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('buyer_id', trans('global.purchase-orders.fields.buyer').'', ['class' => 'control-label']) !!}
                    {!! Form::select('buyer_id', $buyers, old('buyer_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Buyer</p>
                    @if($errors->has('buyer_id'))
                        <p class="help-block">
                            {{ $errors->first('buyer_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('purchase_order_number', trans('global.purchase-orders.fields.purchase-order-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('purchase_order_number', old('purchase_order_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated', 'required' => '']) !!}
                    <p class="help-block">Auto Generated</p>
                    @if($errors->has('purchase_order_number'))
                        <p class="help-block">
                            {{ $errors->first('purchase_order_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('date', trans('global.purchase-orders.fields.date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    <p class="help-block">YYYY-MM-DD</p>
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('request_date', trans('global.purchase-orders.fields.request-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('request_date', old('request_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    <p class="help-block">YYYY-MM-DD</p>
                    @if($errors->has('request_date'))
                        <p class="help-block">
                            {{ $errors->first('request_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('procurement_date', trans('global.purchase-orders.fields.procurement-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('procurement_date', old('procurement_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    <p class="help-block">YYYY-MM-DD</p>
                    @if($errors->has('procurement_date'))
                        <p class="help-block">
                            {{ $errors->first('procurement_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('subtotal', trans('global.purchase-orders.fields.subtotal').'', ['class' => 'control-label']) !!}
                    {!! Form::text('subtotal', old('subtotal'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    <p class="help-block">0.00</p>
                    @if($errors->has('subtotal'))
                        <p class="help-block">
                            {{ $errors->first('subtotal') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('status', trans('global.purchase-orders.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Status</p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vat', trans('global.purchase-orders.fields.vat').'', ['class' => 'control-label']) !!}
                    {!! Form::text('vat', old('vat'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    <p class="help-block">0.00</p>
                    @if($errors->has('vat'))
                        <p class="help-block">
                            {{ $errors->first('vat') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vat_amount', trans('global.purchase-orders.fields.vat-amount').'', ['class' => 'control-label']) !!}
                    {!! Form::text('vat_amount', old('vat_amount'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    <p class="help-block">0.00</p>
                    @if($errors->has('vat_amount'))
                        <p class="help-block">
                            {{ $errors->first('vat_amount') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('total_amount', trans('global.purchase-orders.fields.total-amount').'', ['class' => 'control-label']) !!}
                    {!! Form::text('total_amount', old('total_amount'), ['class' => 'form-control', 'placeholder' => 'Total amount']) !!}
                    <p class="help-block">Total amount</p>
                    @if($errors->has('total_amount'))
                        <p class="help-block">
                            {{ $errors->first('total_amount') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('prepared_by', trans('global.purchase-orders.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    {!! Form::text('prepared_by', old('prepared_by'), ['class' => 'form-control', 'placeholder' => 'Auto Generated']) !!}
                    <p class="help-block">Auto Generated</p>
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('requested_by', trans('global.purchase-orders.fields.requested-by').'', ['class' => 'control-label']) !!}
                    {!! Form::text('requested_by', old('requested_by'), ['class' => 'form-control', 'placeholder' => 'Requested by']) !!}
                    <p class="help-block">Requested by</p>
                    @if($errors->has('requested_by'))
                        <p class="help-block">
                            {{ $errors->first('requested_by') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('hod', trans('global.purchase-orders.fields.hod').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('hod', 0) !!}
                    {!! Form::checkbox('hod', 1, old('hod', old('hod')), []) !!}
                    <p class="help-block">HOD</p>
                    @if($errors->has('hod'))
                        <p class="help-block">
                            {{ $errors->first('hod') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('gm', trans('global.purchase-orders.fields.gm').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('gm', 0) !!}
                    {!! Form::checkbox('gm', 1, old('gm', old('gm')), []) !!}
                    <p class="help-block">GM</p>
                    @if($errors->has('gm'))
                        <p class="help-block">
                            {{ $errors->first('gm') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('accounts', trans('global.purchase-orders.fields.accounts').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('accounts', 0) !!}
                    {!! Form::checkbox('accounts', 1, old('accounts', old('accounts')), []) !!}
                    <p class="help-block">Accounts</p>
                    @if($errors->has('accounts'))
                        <p class="help-block">
                            {{ $errors->first('accounts') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Item descriptions
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.invoice-items.fields.item-description')</th>
                        <th>@lang('global.invoice-items.fields.unit-price')</th>
                        <th>@lang('global.invoice-items.fields.qty')</th>
                        <th>@lang('global.invoice-items.fields.total')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="item-descriptions">
                    @forelse(old('invoice_items', []) as $index => $data)
                        @include('admin.purchase_orders.invoice_items_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($purchase_order->invoice_items as $item)
                            @include('admin.purchase_orders.invoice_items_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="item-descriptions-template">
        @include('admin.purchase_orders.invoice_items_row',
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
@stop