@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('purchase_order_create')
    <p>
        <a href="{{ route('admin.purchase_orders.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">PURCHASE ORDERS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($purchase_orders) > 0 ? 'datatable' : '' }} @can('purchase_order_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('purchase_order_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.purchase-orders.fields.vendor')</th>
                        <th>@lang('global.purchase-orders.fields.purchase-order-number')</th>
                        <th>@lang('global.purchase-orders.fields.date')</th>
                        <th>@lang('global.purchase-orders.fields.total-amount')</th>
                        <th class="text-center">@lang('global.purchase-orders.fields.status')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($purchase_orders) > 0)
                        @foreach ($purchase_orders as $purchase_order)
                            <tr data-entry-id="{{ $purchase_order->id }}">
                                @can('purchase_order_delete')
                                    <td></td>
                                @endcan

                                <td field-key='vendor'>{{ $purchase_order->vendor->name or '' }}</td>
                                <td field-key='purchase_order_number'>{{ $purchase_order->purchase_order_number }}</td>
                                <td field-key='date'>{{ $purchase_order->date }}</td>
                                <td field-key='total_amount'>R{{ number_format($purchase_order->total_amount, 2) }}</td>
                                @if($purchase_order->status == 'Requested')
                                <td class="label-md label-primary text-center" field-key='status'>{{ $purchase_order->status }}</td>
                                @endif
                                @if($purchase_order->status == 'Approved')
                                <td class="label-md label-info text-center" field-key='status'>{{ $purchase_order->status }}</td>
                                @endif
                                @if($purchase_order->status == 'Confirmed')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $purchase_order->status }}</td>
                                @endif
                                @if($purchase_order->status == 'Purchased')
                                <td class="label-md label-success text-center" field-key='status'>{{ $purchase_order->status }}</td>
                                @endif
                                                                <td>
                                    @can('purchase_order_view')
                                    <a href="{{ route('admin.purchase_orders.show',[$purchase_order->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('purchase_order_edit')
                                    <!--a href="{{ route('admin.purchase_orders.edit',[$purchase_order->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                                    @endcan
                                    @can('purchase_order_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.purchase_orders.destroy', $purchase_order->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    <a href="{{ route('admin.purchase_orders.download',$purchase_order->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                                </td>

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
@stop

@section('javascript') 
    <script>
        @can('purchase_order_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.purchase_orders.mass_destroy') }}';
        @endcan

    </script>
@endsection