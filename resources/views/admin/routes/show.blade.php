@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.route.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.route.fields.route')</th>
                            <td field-key='route'>{{ $route->route }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.route.fields.distance')</th>
                            <td field-key='distance'>{{ $route->distance }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#road_freights" aria-controls="road_freights" role="tab" data-toggle="tab">Road freights</a></li>
<li role="presentation" class=""><a href="#income_expense_calculator" aria-controls="income_expense_calculator" role="tab" data-toggle="tab">Road freight estimations</a></li>
<li role="presentation" class=""><a href="#income_expense_calculator" aria-controls="income_expense_calculator" role="tab" data-toggle="tab">Road freight estimations</a></li>
<li role="presentation" class=""><a href="#machinery_costs" aria-controls="machinery_costs" role="tab" data-toggle="tab">Machinery costs</a></li>
<li role="presentation" class=""><a href="#machinery_costs" aria-controls="machinery_costs" role="tab" data-toggle="tab">Machinery costs</a></li>
<li role="presentation" class=""><a href="#air_freight" aria-controls="air_freight" role="tab" data-toggle="tab">Air freights</a></li>
<li role="presentation" class=""><a href="#sea_freight" aria-controls="sea_freight" role="tab" data-toggle="tab">Sea freights</a></li>
<li role="presentation" class=""><a href="#rail_freight" aria-controls="rail_freight" role="tab" data-toggle="tab">Rail freights</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="road_freights">
<table class="table table-bordered table-striped {{ count($road_freights) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.road-freights.fields.project-number')</th>
                        <th>@lang('global.road-freights.fields.road-freight-number')</th>
                        <th>@lang('global.road-freights.fields.freight-contract-type')</th>
                        <th>@lang('global.road-freights.fields.route')</th>
                        <th>@lang('global.road-freights.fields.client')</th>
                        <th>@lang('global.road-freights.fields.contact-person')</th>
                        <th>@lang('global.road-freights.fields.project-manager')</th>
                        <th>@lang('global.road-freights.fields.driver')</th>
                        <th>@lang('global.road-freights.fields.vehicles')</th>
                        <th>@lang('global.road-freights.fields.subcontractor-number')</th>
                        <th>@lang('global.road-freights.fields.vendor')</th>
                        <th>@lang('global.road-freights.fields.vendor-contact-person')</th>
                        <th>@lang('global.road-freights.fields.vendor-drivers')</th>
                        <th>@lang('global.road-freights.fields.vendor-vehicles')</th>
                        <th>@lang('global.road-freights.fields.road-freight-income')</th>
                        <th>@lang('global.road-freights.fields.road-freight-expenses')</th>
                        <th>@lang('global.road-freights.fields.machinery-costs')</th>
                        <th>@lang('global.road-freights.fields.breakdown')</th>
                        <th>@lang('global.road-freights.fields.total-expenses')</th>
                        <th>@lang('global.road-freights.fields.net-income')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($road_freights) > 0)
            @foreach ($road_freights as $road_freight)
                <tr data-entry-id="{{ $road_freight->id }}">
                    <td field-key='project_number'>{{ $road_freight->project_number->operation_number or '' }}</td>
                                <td field-key='road_freight_number'>{{ $road_freight->road_freight_number }}</td>
                                <td field-key='freight_contract_type'>{{ $road_freight->freight_contract_type }}</td>
                                <td field-key='route'>{{ $road_freight->route->route or '' }}</td>
                                <td field-key='client'>{{ $road_freight->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $road_freight->contact_person->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $road_freight->project_manager->name or '' }}</td>
                                <td field-key='driver'>
                                    @foreach ($road_freight->driver as $singleDriver)
                                        <span class="label label-info label-many">{{ $singleDriver->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='vehicles'>
                                    @foreach ($road_freight->vehicles as $singleVehicles)
                                        <span class="label label-info label-many">{{ $singleVehicles->vehicle_description }}</span>
                                    @endforeach
                                </td>
                                <td field-key='subcontractor_number'>{{ $road_freight->subcontractor_number->subcontractor_number or '' }}</td>
                                <td field-key='vendor'>{{ $road_freight->vendor->name or '' }}</td>
                                <td field-key='vendor_contact_person'>{{ $road_freight->vendor_contact_person->contact_name or '' }}</td>
                                <td field-key='vendor_drivers'>
                                    @foreach ($road_freight->vendor_drivers as $singleVendorDrivers)
                                        <span class="label label-info label-many">{{ $singleVendorDrivers->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='vendor_vehicles'>
                                    @foreach ($road_freight->vendor_vehicles as $singleVendorVehicles)
                                        <span class="label label-info label-many">{{ $singleVendorVehicles->registration_number }}</span>
                                    @endforeach
                                </td>
                                <td field-key='road_freight_income'>{{ $road_freight->road_freight_income }}</td>
                                <td field-key='road_freight_expenses'>{{ $road_freight->road_freight_expenses }}</td>
                                <td field-key='machinery_costs'>{{ $road_freight->machinery_costs }}</td>
                                <td field-key='breakdown'>{{ $road_freight->breakdown }}</td>
                                <td field-key='total_expenses'>{{ $road_freight->total_expenses }}</td>
                                <td field-key='net_income'>{{ $road_freight->net_income }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freights.restore', $road_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freights.perma_del', $road_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('road_freight_view')
                                    <a href="{{ route('admin.road_freights.show',[$road_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('road_freight_edit')
                                    <a href="{{ route('admin.road_freights.edit',[$road_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('road_freight_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freights.destroy', $road_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="25">@lang('global.app_no_entries_in_table')</td>
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
<div role="tabpanel" class="tab-pane " id="air_freight">
<table class="table table-bordered table-striped {{ count($air_freights) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.air-freight.fields.project-number')</th>
                        <th>@lang('global.air-freight.fields.air-freight-number')</th>
                        <th>@lang('global.air-freight.fields.client')</th>
                        <th>@lang('global.air-freight.fields.contact-person')</th>
                        <th>@lang('global.air-freight.fields.airline-or-agent')</th>
                        <th>@lang('global.air-freight.fields.airline-or-agent-contact')</th>
                        <th>@lang('global.air-freight.fields.project-manager')</th>
                        <th>@lang('global.air-freight.fields.flight-number')</th>
                        <th>@lang('global.air-freight.fields.route')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($air_freights) > 0)
            @foreach ($air_freights as $air_freight)
                <tr data-entry-id="{{ $air_freight->id }}">
                    <td field-key='project_number'>{{ $air_freight->project_number->operation_number or '' }}</td>
                                <td field-key='air_freight_number'>{{ $air_freight->air_freight_number }}</td>
                                <td field-key='client'>{{ $air_freight->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $air_freight->contact_person->contact_name or '' }}</td>
                                <td field-key='airline_or_agent'>
                                    @foreach ($air_freight->airline_or_agent as $singleAirlineOrAgent)
                                        <span class="label label-info label-many">{{ $singleAirlineOrAgent->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='airline_or_agent_contact'>{{ $air_freight->airline_or_agent_contact->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $air_freight->project_manager->name or '' }}</td>
                                <td field-key='flight_number'>{{ $air_freight->flight_number }}</td>
                                <td field-key='route'>{{ $air_freight->route->route or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.air_freights.restore', $air_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.air_freights.perma_del', $air_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('air_freight_view')
                                    <a href="{{ route('admin.air_freights.show',[$air_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('air_freight_edit')
                                    <a href="{{ route('admin.air_freights.edit',[$air_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('air_freight_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.air_freights.destroy', $air_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="sea_freight">
<table class="table table-bordered table-striped {{ count($sea_freights) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.sea-freight.fields.project-number')</th>
                        <th>@lang('global.sea-freight.fields.sea-freight-number')</th>
                        <th>@lang('global.sea-freight.fields.client')</th>
                        <th>@lang('global.sea-freight.fields.contact-person')</th>
                        <th>@lang('global.sea-freight.fields.shipper-or-agent')</th>
                        <th>@lang('global.sea-freight.fields.shipper-or-agent-contact')</th>
                        <th>@lang('global.sea-freight.fields.project-manager')</th>
                        <th>@lang('global.sea-freight.fields.voyage-number')</th>
                        <th>@lang('global.sea-freight.fields.route')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($sea_freights) > 0)
            @foreach ($sea_freights as $sea_freight)
                <tr data-entry-id="{{ $sea_freight->id }}">
                    <td field-key='project_number'>{{ $sea_freight->project_number->operation_number or '' }}</td>
                                <td field-key='sea_freight_number'>{{ $sea_freight->sea_freight_number }}</td>
                                <td field-key='client'>{{ $sea_freight->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $sea_freight->contact_person->contact_name or '' }}</td>
                                <td field-key='shipper__or_agent'>
                                    @foreach ($sea_freight->shipper__or_agent as $singleShipperOrAgent)
                                        <span class="label label-info label-many">{{ $singleShipperOrAgent->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='shipper_or_agent_contact'>{{ $sea_freight->shipper_or_agent_contact->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $sea_freight->project_manager->name or '' }}</td>
                                <td field-key='voyage_number'>{{ $sea_freight->voyage_number }}</td>
                                <td field-key='route'>{{ $sea_freight->route->route or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.sea_freights.restore', $sea_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.sea_freights.perma_del', $sea_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('sea_freight_view')
                                    <a href="{{ route('admin.sea_freights.show',[$sea_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('sea_freight_edit')
                                    <a href="{{ route('admin.sea_freights.edit',[$sea_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('sea_freight_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.sea_freights.destroy', $sea_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
<div role="tabpanel" class="tab-pane " id="rail_freight">
<table class="table table-bordered table-striped {{ count($rail_freights) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.rail-freight.fields.project-number')</th>
                        <th>@lang('global.rail-freight.fields.rail-freight-number')</th>
                        <th>@lang('global.rail-freight.fields.client')</th>
                        <th>@lang('global.rail-freight.fields.contact-person')</th>
                        <th>@lang('global.rail-freight.fields.railline-or-agent')</th>
                        <th>@lang('global.rail-freight.fields.railline-or-agent-contact')</th>
                        <th>@lang('global.rail-freight.fields.project-manager')</th>
                        <th>@lang('global.rail-freight.fields.trip-number')</th>
                        <th>@lang('global.rail-freight.fields.route')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($rail_freights) > 0)
            @foreach ($rail_freights as $rail_freight)
                <tr data-entry-id="{{ $rail_freight->id }}">
                    <td field-key='project_number'>{{ $rail_freight->project_number->operation_number or '' }}</td>
                                <td field-key='rail_freight_number'>{{ $rail_freight->rail_freight_number }}</td>
                                <td field-key='client'>{{ $rail_freight->client->name or '' }}</td>
                                <td field-key='contact_person'>{{ $rail_freight->contact_person->contact_name or '' }}</td>
                                <td field-key='railline_or_agent'>
                                    @foreach ($rail_freight->railline_or_agent as $singleRaillineOrAgent)
                                        <span class="label label-info label-many">{{ $singleRaillineOrAgent->name }}</span>
                                    @endforeach
                                </td>
                                <td field-key='railline_or_agent_contact'>{{ $rail_freight->railline_or_agent_contact->contact_name or '' }}</td>
                                <td field-key='project_manager'>{{ $rail_freight->project_manager->name or '' }}</td>
                                <td field-key='trip_number'>{{ $rail_freight->trip_number }}</td>
                                <td field-key='route'>{{ $rail_freight->route->route or '' }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rail_freights.restore', $rail_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rail_freights.perma_del', $rail_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('rail_freight_view')
                                    <a href="{{ route('admin.rail_freights.show',[$rail_freight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('rail_freight_edit')
                                    <a href="{{ route('admin.rail_freights.edit',[$rail_freight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('rail_freight_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.rail_freights.destroy', $rail_freight->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="14">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.routes.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


