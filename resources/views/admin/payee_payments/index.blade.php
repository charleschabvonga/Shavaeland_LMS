@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('payee_payment_create')
    <p>
        <a href="{{ route('admin.payee_payments.create') }}" class="btn btn-success">@lang('global.app_add_new')</a> 
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
                        <h1><span style="color:#CE8F64">PAYSLIP PAYMENTS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($payee_payments) > 0 ? 'datatable' : '' }} @can('payee_payment_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('payee_payment_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.payee-payments.fields.entry-date')</th>
                        <th>@lang('global.payee-payments.fields.employee')</th>
                        <th>@lang('global.payee-payments.fields.payslip-number')</th>
                        <th>@lang('global.payee-payments.fields.payee-payment-number')</th>
                        <th>@lang('global.payee-payments.fields.amount')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($payee_payments) > 0)
                        @foreach ($payee_payments as $payee_payment)
                            <tr data-entry-id="{{ $payee_payment->id }}">
                                @can('payee_payment_delete')
                                    <td></td>
                                @endcan

                                <td field-key='entry_date'>{{ $payee_payment->entry_date }}</td>
                                <td field-key='employee'>{{ $payee_payment->employee->name or '' }}</td>
                                <td field-key='payslip_number'>{{ $payee_payment->payslip_number->payslip_number or '' }}</td>
                                <td field-key='payee_payment_number'>{{ $payee_payment->payee_payment_number }}</td>
                                <td field-key='amount'>R {{ number_format($payee_payment->amount, 2) }}</td>
                                                                <td>
                                    @can('payee_payment_view')
                                    <a href="{{ route('admin.payee_payments.show',[$payee_payment->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('payee_payment_edit')
                                    <a href="{{ route('admin.payee_payments.edit',[$payee_payment->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('payee_payment_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.payee_payments.destroy', $payee_payment->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

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
@stop

@section('javascript') 
    <script>
        @can('payee_payment_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.payee_payments.mass_destroy') }}';
        @endcan

    </script>
@endsection