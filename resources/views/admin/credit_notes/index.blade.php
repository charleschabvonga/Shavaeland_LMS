@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('credit_note_create')
    <p>
        <a href="{{ route('admin.credit_notes.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
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
                        <h1><span style="color:#CE8F64">SALES CREDIT NOTES</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($credit_notes) > 0 ? 'datatable' : '' }} @can('credit_note_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('credit_note_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.credit-note.fields.refund-type')</th>
                        <th>@lang('global.credit-note.fields.client')</th>
                        <th>@lang('global.credit-note.fields.credit-note-number')</th>
                        <th>@lang('global.credit-note.fields.total-amount')</th>
                        <th>@lang('global.credit-note.fields.paid-to-date')</th>
                        <th>@lang('global.credit-note.fields.balance')</th>
                        <th>@lang('global.credit-note.fields.status')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($credit_notes) > 0)
                        @foreach ($credit_notes as $credit_note)
                            <tr data-entry-id="{{ $credit_note->id }}">
                                @can('credit_note_delete')
                                    <td></td>
                                @endcan

                                <td field-key='refund_type'>{{ $credit_note->refund_type }}</td>
                                <td field-key='client'>{{ $credit_note->client->name or '' }}</td>
                                <td field-key='credit_note_number'>{{ $credit_note->credit_note_number }}</td>
                                <td field-key='total_amount'>R {{ number_format($credit_note->total_amount, 2) }}</td>
                                <td field-key='paid_to_date'>R {{ number_format($credit_note->paid_to_date, 2) }}</td>
                                <td field-key='balance'>R {{ number_format($credit_note->balance, 2) }}</td>
                                @if($credit_note->status == 'Draft')
                                <td class="label-md label-default text-center" field-key='payment_status'>{{ $credit_note->status }}</td>
                                @endif
                                @if($credit_note->status == 'Sent')
                                <td class="label-md label-info text-center" field-key='payment_status'>{{ $credit_note->status }}</td>
                                @endif
                                @if($credit_note->status == 'Payment due')
                                <td class="label-md label-danger text-center" field-key='payment_status'>{{ $credit_note->status }}</td>
                                @endif
                                @if($credit_note->status == 'Paid')
                                <td class="label-md label-success text-center" field-key='payment_status'>{{ $credit_note->status }}</td>
                                @endif
                                @if($credit_note->status == 'Partially paid')
                                <td class="label-md label-warning text-center" field-key='payment_status'>{{ $credit_note->status }}</td>
                                @endif
                                @if($credit_note->status == 'Account credited') 
                                <td class="label-md label-success text-center" field-key='payment_status'>{{ $credit_note->status }}</td>
                                @endif
                                @if($credit_note->status == 'Rejected') 
                                <td class="label-md label-danger text-center" field-key='payment_status'>{{ $credit_note->status }}</td>
                                @endif
                                                                <td>
                                    @can('credit_note_view')
                                    <a href="{{ route('admin.credit_notes.show',[$credit_note->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('credit_note_edit')
                                    <a href="{{ route('admin.credit_notes.edit',[$credit_note->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('credit_note_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.credit_notes.destroy', $credit_note->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>

                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="23">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('credit_note_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.credit_notes.mass_destroy') }}';
        @endcan

    </script>
@endsection