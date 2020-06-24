@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">

                    <p class='pull-right'>
                        <a href="{{ route('admin.warehouses.download',$warehouse->id) }}" class="btn btn btn-warning">View Warehouse Inventories in PDF</a>
                    </p>

                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br>
                                <h1><span style="color:#CE8F64">WAREHOUSE CENTER</span></h1>
                                <h4><b>Warehouse Center</b>: <span style="color:red">{{ $warehouse->center_name }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 "></div>
                        <div class="col-xs-4 form-group text-center">
                            <b>Vendor</b>: {{ $warehouse->vendor->name or '' }}<br>
                            <b>Square meters</b>: {{ number_format($warehouse->square_meters, 2) }} m<sup>2</sup> <br>
                            <b>Available space</b>: {{ number_format($warehouse->available_space, 2) }} m<sup>2</sup>
                        </div>
                        <div class="col-xs-4 text-right"></div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 form-group">
                            <div class="panel panel-default">
                                <div class="panel-body">
                                    <table class="table table-bordered table-striped">
                                        <legend class="text-center"><span style="color:#CE8F64">INVENTORY ON HAND</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('Receipt No.')</th>
                                            <th>@lang('Item')</th>
                                            <th>@lang('Qty')</th>
                                            <th>@lang('Area covered')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($warehouse->received_items) > 0)
                                                @foreach ($warehouse->received_items as $item)
                                                    @if($item->qty > 0)
                                                        <tr>
                                                            <td>{{ $item->receipt_number->receipt_number or '' }}</td>
                                                            <td>{{ $item->item }}</td>
                                                            <td>{{ $item->qty }}</td>
                                                            <td>{{ number_format($item->area, 2) }} m<sup>2</sup> </td>
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
                                        <legend class="text-center"><span style="color:#CE8F64">RECEIPTS</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('global.receiving.fields.project-number')</th>
                                            <th>@lang('global.receiving.fields.receipt-number')</th>
                                            <th>@lang('global.receiving.fields.client')</th>
                                            <th>@lang('global.receiving.fields.received-by')</th>
                                            <th>@lang('global.releasing.fields.date')</th>
                                            <th>@lang('global.receiving.fields.total-area-coverd')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($receivings) > 0)
                                                @foreach ($receivings as $receiving)
                                                    <tr>
                                                        <td field-key='project_number'>{{ $receiving->project_number->operation_number or '' }}</td>
                                                        <td field-key='receipt_number'>{{ $receiving->receipt_number }}</td>
                                                        <td field-key='client'>{{ $receiving->client->name or '' }}</td>
                                                        <td field-key='received_by'>{{ $receiving->received_by->name or '' }}</td>
                                                        <td field-key='received_by'>{{ $receiving->date }}</td>
                                                        <td field-key='total_area_coverd'>{{ number_format($receiving->total_area_coverd, 2) }} m<sup>2</sup> </td>
                                                    </tr>
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
                                        <legend class="text-center"><span style="color:#CE8F64">COLLECTED</span></legend>
                                        <thead>
                                        <tr>
                                            <th>@lang('global.releasing.fields.project-number')</th>
                                            <th>@lang('global.releasing.fields.release-number')</th>
                                            <th>@lang('global.releasing.fields.client')</th>
                                            <th>@lang('global.releasing.fields.released-by')</th>
                                            <th>@lang('global.releasing.fields.date')</th>
                                            <th>@lang('global.releasing.fields.area-coverd')</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @if (count($releasings) > 0)
                                                @foreach ($releasings as $releasing)
                                                    <tr>
                                                        <td field-key='project_number'>{{ $releasing->project_number->operation_number or '' }}</td>
                                                        <td field-key='release_number'>{{ $releasing->release_number }}</td>
                                                        <td field-key='client'>{{ $releasing->client->name or '' }}</td>
                                                        <td field-key='released_by'>{{ $releasing->released_by->name or '' }}</td>
                                                        <td field-key='date_time_received'>{{ $releasing->date }}</td>
                                                        <td field-key='area_coverd'>{{ number_format($releasing->area_coverd, 2) }} m<sup>2</sup> </td>
                                                    </tr>
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
<ul class="nav nav-tabs" role="tablist">
<li role="presentation" class="active"><a href="#receiving" aria-controls="receiving" role="tab" data-toggle="tab">Receiving</a></li>
<li role="presentation" class=""><a href="#releasing" aria-controls="releasing" role="tab" data-toggle="tab">Releasing</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">

<div role="tabpanel" class="tab-pane active" id="receiving">
<table class="table table-bordered table-striped {{ count($receivings) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.receiving.fields.project-number')</th>
            <th>@lang('global.receiving.fields.receipt-number')</th>
            <th>@lang('global.receiving.fields.client')</th>
            <th>@lang('global.receiving.fields.received-by')</th>
            <th>@lang('global.releasing.fields.date')</th>
            <th>@lang('global.receiving.fields.total-area-coverd')</th>
            @if( request('show_deleted') == 1 )
            <th>&nbsp;</th>
            @else
            <th>&nbsp;</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @if (count($receivings) > 0)
            @foreach ($receivings as $receiving)
                <tr data-entry-id="{{ $receiving->id }}">
                    <td field-key='project_number'>{{ $receiving->project_number->operation_number or '' }}</td>
                    <td field-key='receipt_number'>{{ $receiving->receipt_number }}</td>
                    <td field-key='client'>{{ $receiving->client->name or '' }}</td>
                    <td field-key='received_by'>{{ $receiving->received_by->name or '' }}</td>
                    <td field-key='total_area_coverd'>{{ number_format($receiving->total_area_coverd, 2) }} m<sup>2</sup></td>
                    <td field-key='prepared_by'>{{ $receiving->date }}</td>
                    @if( request('show_deleted') == 1 )
                    <td>
                        {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'POST',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.receivings.restore', $receiving->id])) !!}
                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                        {!! Form::close() !!}
                                                        {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.receivings.perma_del', $receiving->id])) !!}
                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                                                    </td>
                    @else
                    <td>
                        @can('receiving_view')
                        <a href="{{ route('admin.receivings.show',[$receiving->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                        @endcan
                        @can('receiving_edit')
                        <!--a href="{{ route('admin.receivings.edit',[$receiving->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                        @endcan
                        @can('receiving_delete')
                        <!--{!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.receivings.destroy', $receiving->id])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}-->
                        @endcan
                        <a href="{{ route('admin.receivings.download',$receiving->id) }}" class="btn btn-xs btn-warning">View PDF</a>
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
    
<div role="tabpanel" class="tab-pane" id="releasing">
<table class="table table-bordered table-striped {{ count($releasings) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th width="20%">@lang('global.releasing.fields.project-number')</th>
            <th>@lang('global.releasing.fields.release-number')</th>
            <th>@lang('global.releasing.fields.client')</th>
            <th>@lang('global.releasing.fields.released-by')</th>
            <th>@lang('global.releasing.fields.date')</th>
            <th>@lang('global.releasing.fields.area-coverd')</th>
            @if( request('show_deleted') == 1 )
            <th>&nbsp;</th>
            @else
            <th>&nbsp;</th>
            @endif
        </tr>
    </thead>

    <tbody>
        @if (count($releasings) > 0)
            @foreach ($releasings as $releasing)
                <tr data-entry-id="{{ $releasing->id }}">
                    <td field-key='project_number'>{{ $releasing->project_number->operation_number or '' }}</td>
                    <td field-key='release_number'>{{ $releasing->release_number }}</td>
                    <td field-key='client'>{{ $releasing->client->name or '' }}</td>
                    <td field-key='released_by'>{{ $releasing->released_by->name or '' }}</td>
                    <td field-key='date_time_received'>{{ $releasing->date }}</td>
                    <td field-key='area_coverd'>{{ number_format($releasing->area_coverd, 2) }} m<sup>2</sup> </td>
                    @if( request('show_deleted') == 1 )
                    <td>
                        {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'POST',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.releasings.restore', $releasing->id])) !!}
                        {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                        {!! Form::close() !!}
                                                        {!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.releasings.perma_del', $releasing->id])) !!}
                        {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}
                                                    </td>
                    @else
                    <td>
                        @can('releasing_view')
                        <a href="{{ route('admin.releasings.show',[$releasing->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                        @endcan
                        @can('releasing_edit')
                        <!--a href="{{ route('admin.releasings.edit',[$releasing->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                        @endcan
                        @can('releasing_delete')
                        <!--{!! Form::open(array(
                            'style' => 'display: inline-block;',
                            'method' => 'DELETE',
                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                            'route' => ['admin.releasings.destroy', $releasing->id])) !!}
                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                        {!! Form::close() !!}-->
                        @endcan
                        <a href="{{ route('admin.releasings.download',$releasing->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                    </td>
                    @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="15">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.warehouses.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


