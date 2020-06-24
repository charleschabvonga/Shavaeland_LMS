@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('quotation_create')
    <p>
        <a href="{{ route('admin.quotations.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
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
                        <h1><span style="color:#CE8F64">QUOTATIONS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($quotations) > 0 ? 'datatable' : '' }} @can('quotation_delete') dt-select @endcan">
                <thead>
                    <tr>
                        @can('quotation_delete')
                            <th style="text-align:center;"><input type="checkbox" id="select-all" /></th>
                        @endcan

                        <th>@lang('global.quotation.fields.client')</th>
                        <th>@lang('global.quotation.fields.quotation-number')</th>
                        <th>@lang('global.quotation.fields.date')</th>
                        <th>@lang('global.quotation.fields.due-date')</th>
                        <th>@lang('global.quotation.fields.total-amount')</th>
                        <th class="text-center">@lang('global.quotation.fields.status')</th>
                                                <th>&nbsp;</th>

                    </tr>
                </thead>
                
                <tbody>
                    @if (count($quotations) > 0)
                        @foreach ($quotations as $quotation)
                            <tr data-entry-id="{{ $quotation->id }}">
                                @can('quotation_delete')
                                    <td></td>
                                @endcan

                                <td field-key='client'>{{ $quotation->client->name or '' }}</td>
                                <td field-key='quotation_number'>{{ $quotation->quotation_number }}</td>
                                <td field-key='date'>{{ $quotation->date }}</td>
                                <td field-key='due_date'>{{ $quotation->due_date }}</td>
                                <td field-key='total_amount'>R {{ number_format($quotation->total_amount,2) }}</td>
                                @if($quotation->status == 'Draft')
                                <td class="label-md label-primary text-center" field-key='status'>{{ $quotation->status }}</td>
                                @endif
                                @if($quotation->status == 'Sent')
                                <td class="label-md label-info text-center" field-key='status'>{{ $quotation->status }}</td>
                                @endif
                                @if($quotation->status == 'Confirmed')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $quotation->status }}</td>
                                @endif
                                @if($quotation->status == 'Unconfirmed')
                                <td class="label-md label-danger text-center" field-key='status'>{{ $quotation->status }}</td>
                                @endif
                                @if($quotation->status == 'Invoiced')
                                <td class="label-md label-success text-center" field-key='status'>{{ $quotation->status }}</td>
                                @endif
                                @if($quotation->status == 'Expired')
                                <td class="label-md label-default text-center" field-key='status'>{{ $quotation->status }}</td>
                                @endif
                                                                <td>
                                    @can('quotation_view')
                                    <a href="{{ route('admin.quotations.show',[$quotation->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('quotation_edit')
                                    <!--a href="{{ route('admin.quotations.edit',[$quotation->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                                    @endcan
                                    @can('quotation_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.quotations.destroy', $quotation->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    <a href="{{ route('admin.quotations.download',$quotation->id) }}" class="btn btn-xs btn-warning">View PDF</a>
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
        @can('quotation_delete')
            window.route_mass_crud_entries_destroy = '{{ route('admin.quotations.mass_destroy') }}';
        @endcan

    </script>
@endsection