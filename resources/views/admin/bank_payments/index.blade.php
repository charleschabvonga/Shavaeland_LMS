@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('bank_payment_create')
    <p>
        <a href="{{ route('admin.bank_payments.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>  
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
                        <h1><span style="color:#CE8F64">INBOUND DEPOSITS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($bank_payments) > 0 ? 'datatable' : '' }} @can('bank_payment_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('bank_payment_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.bank-payments.fields.entry-date')</th>
                        <th>@lang('global.bank-payments.fields.client')</th>
                        <th>@lang('global.bank-payments.fields.vendor')</th>
                        <th>@lang('global.bank-payments.fields.payment-number')</th>
                        <th>@lang('global.bank-payments.fields.amount')</th>
                        <th>@lang('global.bank-payments.fields.balance')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($bank_payments) > 0)
                        @foreach ($bank_payments as $bank_payment)
                            <tr data-entry-id="{{ $bank_payment->id }}">
                                @can('bank_payment_delete')
                                    <td></td>
                                @endcan

                                <td field-key='entry_date'>{{ $bank_payment->entry_date }}</td>
                                <td field-key='client'>{{ $bank_payment->client->name or '' }}</td>
                                <td field-key='vendor'>{{ $bank_payment->vendor->name or '' }}</td>
                                <td field-key='payment_number'>{{ $bank_payment->payment_number }}</td>
                                <td field-key='amount'>R {{ number_format($bank_payment->amount, 2) }}</td>
                                <td field-key='balance'>R {{ number_format($bank_payment->balance, 2) }}</td>
                                                                <td>
                                    @can('bank_payment_view')
                                    <a href="{{ route('admin.bank_payments.show',[$bank_payment->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('bank_payment_edit')
                                    <a href="{{ route('admin.bank_payments.edit',[$bank_payment->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('bank_payment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.bank_payments.destroy', $bank_payment->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
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
        @can('bank_payment_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.bank_payments.mass_destroy') }}';
        @endcan

    </script>
@endsection