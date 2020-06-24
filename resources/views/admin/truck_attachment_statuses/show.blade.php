@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.truck-attachment-status.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.truck-attachment-status.fields.attachment')</th>
                            <td field-key='attachment'>{{ $truck_attachment_status->attachment }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#machinery_size" aria-controls="machinery_size" role="tab" data-toggle="tab">Machinery size</a></li>
<li role="presentation" class=""><a href="#machinery_type" aria-controls="machinery_type" role="tab" data-toggle="tab">Machinery type</a></li>
<li role="presentation" class=""><a href="#income_expense_calculator" aria-controls="income_expense_calculator" role="tab" data-toggle="tab">Road freight estimations</a></li>
<li role="presentation" class=""><a href="#machinery_costs" aria-controls="machinery_costs" role="tab" data-toggle="tab">Machinery costs</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="machinery_size">
<table class="table table-bordered table-striped {{ count($machinery_sizes) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.machinery-size.fields.size')</th>
                        <th>@lang('global.machinery-size.fields.attachment')</th>
                        <th>@lang('global.machinery-size.fields.machinery-type')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($machinery_sizes) > 0)
            @foreach ($machinery_sizes as $machinery_size)
                <tr data-entry-id="{{ $machinery_size->id }}">
                    <td field-key='size'>{{ $machinery_size->size }}</td>
                                <td field-key='attachment'>{{ $machinery_size->attachment->attachment or '' }}</td>
                                <td field-key='machinery_type'>{{ $machinery_size->machinery_type->machinery_type or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_sizes.restore', $machinery_size->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_sizes.perma_del', $machinery_size->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('machinery_size_view')
                                    <a href="{{ route('admin.machinery_sizes.show',[$machinery_size->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('machinery_size_edit')
                                    <a href="{{ route('admin.machinery_sizes.edit',[$machinery_size->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('machinery_size_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_sizes.destroy', $machinery_size->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="8">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="machinery_type">
<table class="table table-bordered table-striped {{ count($machinery_types) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.machinery-type.fields.machinery-type')</th>
                        <th>@lang('global.machinery-type.fields.attachment')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($machinery_types) > 0)
            @foreach ($machinery_types as $machinery_type)
                <tr data-entry-id="{{ $machinery_type->id }}">
                    <td field-key='machinery_type'>{{ $machinery_type->machinery_type }}</td>
                                <td field-key='attachment'>{{ $machinery_type->attachment->attachment or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_types.restore', $machinery_type->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_types.perma_del', $machinery_type->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('machinery_type_view')
                                    <a href="{{ route('admin.machinery_types.show',[$machinery_type->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('machinery_type_edit')
                                    <a href="{{ route('admin.machinery_types.edit',[$machinery_type->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('machinery_type_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_types.destroy', $machinery_type->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="7">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="income_expense_calculator">
<table class="table table-bordered table-striped {{ count($income_expense_calculators) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.income-expense-calculator.fields.return-load-status')</th>
                        <th>@lang('global.income-expense-calculator.fields.fuel-price')</th>
                        <th>@lang('global.income-expense-calculator.fields.oil-price')</th>
                        <th>@lang('global.income-expense-calculator.fields.route')</th>
                        <th>@lang('global.income-expense-calculator.fields.distance')</th>
                        <th>@lang('global.income-expense-calculator.fields.truck-attachment-status')</th>
                        <th>@lang('global.income-expense-calculator.fields.machinery-attachment-type')</th>
                        <th>@lang('global.income-expense-calculator.fields.size')</th>
                        <th>@lang('global.income-expense-calculator.fields.vehicles')</th>
                        <th>@lang('global.income-expense-calculator.fields.purchase-price')</th>
                        <th>@lang('global.income-expense-calculator.fields.fuel-usage')</th>
                        <th>@lang('global.income-expense-calculator.fields.salvage-value')</th>
                        <th>@lang('global.income-expense-calculator.fields.avg-investment')</th>
                        <th>@lang('global.income-expense-calculator.fields.depreciation')</th>
                        <th>@lang('global.income-expense-calculator.fields.insurance')</th>
                        <th>@lang('global.income-expense-calculator.fields.license')</th>
                        <th>@lang('global.income-expense-calculator.fields.repair-maintenance')</th>
                        <th>@lang('global.income-expense-calculator.fields.fuel')</th>
                        <th>@lang('global.income-expense-calculator.fields.fuel-consumption')</th>
                        <th>@lang('global.income-expense-calculator.fields.oil')</th>
                        <th>@lang('global.income-expense-calculator.fields.tyre')</th>
                        <th>@lang('global.income-expense-calculator.fields.contigency-factor')</th>
                        <th>@lang('global.income-expense-calculator.fields.subtotal')</th>
                        <th>@lang('global.income-expense-calculator.fields.total-costs')</th>
                        <th>@lang('global.income-expense-calculator.fields.trip-income')</th>
                        <th>@lang('global.income-expense-calculator.fields.balance')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($income_expense_calculators) > 0)
            @foreach ($income_expense_calculators as $income_expense_calculator)
                <tr data-entry-id="{{ $income_expense_calculator->id }}">
                    <td field-key='return_load_status'>{{ $income_expense_calculator->return_load_status }}</td>
                                <td field-key='fuel_price'>{{ $income_expense_calculator->fuel_price }}</td>
                                <td field-key='oil_price'>{{ $income_expense_calculator->oil_price }}</td>
                                <td field-key='route'>{{ $income_expense_calculator->route->route or '' }}</td>
                                <td field-key='distance'>{{ $income_expense_calculator->distance->distance or '' }}</td>
                                <td field-key='truck_attachment_status'>{{ $income_expense_calculator->truck_attachment_status->attachment or '' }}</td>
                                <td field-key='machinery_attachment_type'>{{ $income_expense_calculator->machinery_attachment_type->machinery_type or '' }}</td>
                                <td field-key='size'>{{ $income_expense_calculator->size->size or '' }}</td>
                                <td field-key='vehicles'>{{ $income_expense_calculator->vehicles->vehicle_description or '' }}</td>
                                <td field-key='purchase_price'>{{ $income_expense_calculator->purchase_price }}</td>
                                <td field-key='fuel_usage'>{{ $income_expense_calculator->fuel_usage }}</td>
                                <td field-key='salvage_value'>{{ $income_expense_calculator->salvage_value }}</td>
                                <td field-key='avg_investment'>{{ $income_expense_calculator->avg_investment }}</td>
                                <td field-key='depreciation'>{{ $income_expense_calculator->depreciation }}</td>
                                <td field-key='insurance'>{{ $income_expense_calculator->insurance }}</td>
                                <td field-key='license'>{{ $income_expense_calculator->license }}</td>
                                <td field-key='repair_maintenance'>{{ $income_expense_calculator->repair_maintenance }}</td>
                                <td field-key='fuel'>{{ $income_expense_calculator->fuel }}</td>
                                <td field-key='fuel_consumption'>{{ $income_expense_calculator->fuel_consumption }}</td>
                                <td field-key='oil'>{{ $income_expense_calculator->oil }}</td>
                                <td field-key='tyre'>{{ $income_expense_calculator->tyre }}</td>
                                <td field-key='contigency_factor'>{{ $income_expense_calculator->contigency_factor }}</td>
                                <td field-key='subtotal'>{{ $income_expense_calculator->subtotal }}</td>
                                <td field-key='total_costs'>{{ $income_expense_calculator->total_costs }}</td>
                                <td field-key='trip_income'>{{ $income_expense_calculator->trip_income }}</td>
                                <td field-key='balance'>{{ $income_expense_calculator->balance }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_expense_calculators.restore', $income_expense_calculator->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_expense_calculators.perma_del', $income_expense_calculator->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('income_expense_calculator_view')
                                    <a href="{{ route('admin.income_expense_calculators.show',[$income_expense_calculator->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('income_expense_calculator_edit')
                                    <a href="{{ route('admin.income_expense_calculators.edit',[$income_expense_calculator->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('income_expense_calculator_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.income_expense_calculators.destroy', $income_expense_calculator->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="31">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="machinery_costs">
<table class="table table-bordered table-striped {{ count($machinery_costs) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.machinery-costs.fields.road-freight-number')</th>
                        <th>@lang('global.machinery-costs.fields.fuel-price')</th>
                        <th>@lang('global.machinery-costs.fields.oil-price')</th>
                        <th>@lang('global.machinery-costs.fields.return-load-status')</th>
                        <th>@lang('global.machinery-costs.fields.route')</th>
                        <th>@lang('global.machinery-costs.fields.distance')</th>
                        <th>@lang('global.machinery-costs.fields.machinery')</th>
                        <th>@lang('global.machinery-costs.fields.truck-attachment-status')</th>
                        <th>@lang('global.machinery-costs.fields.machinery-attachment-type')</th>
                        <th>@lang('global.machinery-costs.fields.size')</th>
                        <th>@lang('global.machinery-costs.fields.purchase-price')</th>
                        <th>@lang('global.machinery-costs.fields.fuel-usage')</th>
                        <th>@lang('global.machinery-costs.fields.salvage-value')</th>
                        <th>@lang('global.machinery-costs.fields.avg-investment')</th>
                        <th>@lang('global.machinery-costs.fields.depreciation')</th>
                        <th>@lang('global.machinery-costs.fields.insurance')</th>
                        <th>@lang('global.machinery-costs.fields.license')</th>
                        <th>@lang('global.machinery-costs.fields.repair-maintenance')</th>
                        <th>@lang('global.machinery-costs.fields.fuel')</th>
                        <th>@lang('global.machinery-costs.fields.fuel-consumption')</th>
                        <th>@lang('global.machinery-costs.fields.oil')</th>
                        <th>@lang('global.machinery-costs.fields.tyre')</th>
                        <th>@lang('global.machinery-costs.fields.contigency-factor')</th>
                        <th>@lang('global.machinery-costs.fields.total-costs')</th>
                        <th>@lang('global.machinery-costs.fields.trip-income')</th>
                        <th>@lang('global.machinery-costs.fields.balance')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($machinery_costs) > 0)
            @foreach ($machinery_costs as $machinery_cost)
                <tr data-entry-id="{{ $machinery_cost->id }}">
                    <td field-key='road_freight_number'>{{ $machinery_cost->road_freight_number->road_freight_number or '' }}</td>
                                <td field-key='fuel_price'>{{ $machinery_cost->fuel_price }}</td>
                                <td field-key='oil_price'>{{ $machinery_cost->oil_price }}</td>
                                <td field-key='return_load_status'>{{ $machinery_cost->return_load_status }}</td>
                                <td field-key='route'>{{ $machinery_cost->route->route or '' }}</td>
                                <td field-key='distance'>{{ $machinery_cost->distance->distance or '' }}</td>
                                <td field-key='machinery'>
                                    @foreach ($machinery_cost->machinery as $singleMachinery)
                                        <span class="label label-info label-many">{{ $singleMachinery->vehicle_description }}</span>
                                    @endforeach
                                </td>
                                <td field-key='truck_attachment_status'>{{ $machinery_cost->truck_attachment_status->attachment or '' }}</td>
                                <td field-key='machinery_attachment_type'>{{ $machinery_cost->machinery_attachment_type->machinery_type or '' }}</td>
                                <td field-key='size'>{{ $machinery_cost->size->size or '' }}</td>
                                <td field-key='purchase_price'>{{ $machinery_cost->purchase_price }}</td>
                                <td field-key='fuel_usage'>{{ $machinery_cost->fuel_usage }}</td>
                                <td field-key='salvage_value'>{{ $machinery_cost->salvage_value }}</td>
                                <td field-key='avg_investment'>{{ $machinery_cost->avg_investment }}</td>
                                <td field-key='depreciation'>{{ $machinery_cost->depreciation }}</td>
                                <td field-key='insurance'>{{ $machinery_cost->insurance }}</td>
                                <td field-key='license'>{{ $machinery_cost->license }}</td>
                                <td field-key='repair_maintenance'>{{ $machinery_cost->repair_maintenance }}</td>
                                <td field-key='fuel'>{{ $machinery_cost->fuel }}</td>
                                <td field-key='fuel_consumption'>{{ $machinery_cost->fuel_consumption }}</td>
                                <td field-key='oil'>{{ $machinery_cost->oil }}</td>
                                <td field-key='tyre'>{{ $machinery_cost->tyre }}</td>
                                <td field-key='contigency_factor'>{{ $machinery_cost->contigency_factor }}</td>
                                <td field-key='total_costs'>{{ $machinery_cost->total_costs }}</td>
                                <td field-key='trip_income'>{{ $machinery_cost->trip_income }}</td>
                                <td field-key='balance'>{{ $machinery_cost->balance }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_costs.restore', $machinery_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_costs.perma_del', $machinery_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('machinery_cost_view')
                                    <a href="{{ route('admin.machinery_costs.show',[$machinery_cost->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('machinery_cost_edit')
                                    <a href="{{ route('admin.machinery_costs.edit',[$machinery_cost->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('machinery_cost_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.machinery_costs.destroy', $machinery_cost->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="31">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.truck_attachment_statuses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


