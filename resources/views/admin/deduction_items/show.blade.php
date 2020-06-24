@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.deduction-items.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.deduction-items.fields.item-description')</th>
                            <td field-key='item_description'>{{ $deduction_item->item_description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deduction-items.fields.unit-price')</th>
                            <td field-key='unit_price'>{{ $deduction_item->unit_price }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deduction-items.fields.qty')</th>
                            <td field-key='qty'>{{ $deduction_item->qty }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deduction-items.fields.total')</th>
                            <td field-key='total'>{{ $deduction_item->total }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.deduction-items.fields.unit')</th>
                            <td field-key='unit'>{{ $deduction_item->unit }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.deduction_items.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


