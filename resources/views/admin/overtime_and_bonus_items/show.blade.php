@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.overtime-and-bonus-items.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.overtime-and-bonus-items.fields.item-description')</th>
                            <td field-key='item_description'>{{ $overtime_and_bonus_item->item_description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.overtime-and-bonus-items.fields.unit-price')</th>
                            <td field-key='unit_price'>{{ $overtime_and_bonus_item->unit_price }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.overtime-and-bonus-items.fields.qty')</th>
                            <td field-key='qty'>{{ $overtime_and_bonus_item->qty }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.overtime-and-bonus-items.fields.total')</th>
                            <td field-key='total'>{{ $overtime_and_bonus_item->total }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.overtime-and-bonus-items.fields.unit')</th>
                            <td field-key='unit'>{{ $overtime_and_bonus_item->unit }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.overtime_and_bonus_items.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


