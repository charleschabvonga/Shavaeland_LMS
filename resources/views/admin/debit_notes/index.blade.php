@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('debit_note_create')
    <p>
        <a href="{{ route('admin.debit_notes.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
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
                        <h1><span style="color:#CE8F64">DEBIT NOTES</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($debit_notes) > 0 ? 'datatable' : '' }} @can('debit_note_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('debit_note_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.debit-notes.fields.refund-type')</th>
                        <th>@lang('global.debit-notes.fields.vendor')</th>
                        <th>@lang('global.debit-notes.fields.debit-note-number')</th>
                        <th>@lang('global.debit-notes.fields.total-amount')</th>
                        <th>@lang('global.debit-notes.fields.paid-to-date')</th>
                        <th>@lang('global.debit-notes.fields.balance')</th>
                        <th class="text-center">@lang('global.debit-notes.fields.status')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($debit_notes) > 0)
                        @foreach ($debit_notes as $debit_note)
                            <tr data-entry-id="{{ $debit_note->id }}">
                                @can('debit_note_delete')
                                    <td></td>
                                @endcan

                                <td field-key='refund_type'>{{ $debit_note->refund_type }}</td>
                                <td field-key='vendor'>{{ $debit_note->vendor->name or '' }}</td>
                                <td field-key='debit_note_number'>{{ $debit_note->debit_note_number }}</td>
                                <td field-key='total_amount'>R {{ number_format($debit_note->total_amount, 2) }}</td>
                                <td field-key='paid_to_date'>R {{ number_format($debit_note->paid_to_date, 2) }}</td>
                                <td field-key='balance'>R {{ number_format($debit_note->balance, 2) }}</td>                             
                                @if($debit_note->payment_status == 'Draft')
                                <td class="label-md label-default text-center" field-key='payment_payment_status'>{{ $debit_note->payment_status }}</td>
                                @endif
                                @if($debit_note->payment_status == 'Sent')
                                <td class="label-md label-info text-center" field-key='payment_payment_status'>{{ $debit_note->payment_status }}</td>
                                @endif
                                @if($debit_note->payment_status == 'Payment due')
                                <td class="label-md label-danger text-center" field-key='payment_payment_status'>{{ $debit_note->payment_status }}</td>
                                @endif
                                @if($debit_note->payment_status == 'Paid')
                                <td class="label-md label-success text-center" field-key='payment_payment_status'>{{ $debit_note->payment_status }}</td>
                                @endif
                                @if($debit_note->payment_status == 'Partially paid')
                                <td class="label-md label-warning text-center" field-key='payment_payment_status'>{{ $debit_note->payment_status }}</td>
                                @endif
                                @if($debit_note->payment_status == 'Account debited') 
                                <td class="label-md label-success text-center" field-key='payment_payment_status'>{{ $debit_note->payment_status }}</td>
                                @endif
                                @if($debit_note->payment_status == 'Rejected') 
                                <td class="label-md label-danger text-center" field-key='payment_payment_status'>{{ $debit_note->payment_status }}</td>
                                @endif
                                                                <td>
                                    @can('debit_note_view')
                                    <a href="{{ route('admin.debit_notes.show',[$debit_note->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('debit_note_edit')
                                    <a href="{{ route('admin.debit_notes.edit',[$debit_note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('debit_note_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.debit_notes.destroy', $debit_note->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="22">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('debit_note_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.debit_notes.mass_destroy') }}';
        @endcan

    </script>
@endsection