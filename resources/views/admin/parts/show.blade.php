@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">
                    
                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" />
                                <h1><span style="color:#CE8F64">PARTS & ACCESSORIES INVENTORIES</span></h1>
                                <h4><b>Part/Accessory</b>: <span style="color:red">{{ $part->part }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 "></div>
                        <div class="col-xs-4 form-group text-center">
                            <b>Center name</b>: {{ $part->repair_center->center_name or '' }}<br>
                            <b>Qty</b>: {{ $part->qty }} {{ $part->unit->measurement_type or '' }}<br>
                        </div>
                        <div class="col-xs-4 form-group text-right"></div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">PARTS PURCHASED</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('global.parts-acquired.fields.repair-center')</th>
                                            <th>@lang('global.parts-acquired.fields.date')</th>
                                            <th>@lang('global.parts-acquired.fields.part')</th>
                                            <th>@lang('global.parts-acquired.fields.qty')</th>
                                            <th>@lang('global.parts-acquired.fields.unit')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($parts_acquireds) > 0)
                                                @foreach ($parts_acquireds as $item)
                                                    @if($item->transaction_type == 'Procurement')
                                                    <tr>
                                                        <td class="text-left">{{ $item->repair_center->center_name or '' }}</td>
                                                        <td class="text-left">{{ $item->date }}</td>
                                                        <td class="text-left">{{ $item->part->part }}</td>
                                                        <td class="text-left">{{ number_format($item->qty, 2) }}</td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">PARTS REQUESTED</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('global.parts-acquired.fields.repair-center')</th>
                                            <th>@lang('global.parts-acquired.fields.date')</th>
                                            <th>@lang('global.parts-acquired.fields.part')</th>
                                            <th>@lang('global.parts-acquired.fields.qty')</th>
                                            <th>@lang('global.parts-acquired.fields.unit')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($parts_acquireds) > 0)
                                                @foreach ($parts_acquireds as $item)
                                                    @if($item->transaction_type == 'Request')
                                                    <tr>
                                                        <td class="text-left">{{ $item->repair_center->center_name or '' }}</td>
                                                        <td class="text-left">{{ $item->date }}</td>
                                                        <td class="text-left">{{ $item->part->part }}</td>
                                                        <td class="text-left">{{ number_format($item->qty, 2) }}</td>
                                                    </tr>
                                                    @endif
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="16">@lang('global.app_no_entries_in_table')</td>
                                                </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div><!-- Nav tabs --> 

            <a href="{{ route('admin.parts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


