@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.invoice-items.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.invoice-items.fields.item-description')</th>
                            <td field-key='item_description'>{{ $invoice_item->item_description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.invoice-items.fields.unit-price')</th>
                            <td field-key='unit_price'>{{ $invoice_item->unit_price }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.invoice-items.fields.qty')</th>
                            <td field-key='qty'>{{ $invoice_item->qty }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.invoice-items.fields.total')</th>
                            <td field-key='total'>{{ $invoice_item->total }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.invoice_items.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


