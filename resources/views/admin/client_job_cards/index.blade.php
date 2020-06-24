@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('client_job_card_create')
    <p>
        <a href="{{ route('admin.client_job_cards.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.client_job_cards.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.client_job_cards.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">JOB CARD</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($client_job_cards) > 0 ? 'datatable' : '' }} @can('client_job_card_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('client_job_card_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.client-job-cards.fields.job-card-number')</th>
                        <th>@lang('global.client-job-cards.fields.client-vehicle-reg-no')</th>
                        <th>@lang('global.client-job-cards.fields.job-type')</th>
                        <th>@lang('global.client-job-cards.fields.status')</th>

                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($client_job_cards) > 0)
                        @foreach ($client_job_cards as $client_job_card)
                            <tr data-entry-id="{{ $client_job_card->id }}">
                                @can('client_job_card_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='job_card_number'>{{ $client_job_card->job_card_number }}</td>
                                <td field-key='client_vehicle_reg_no'>{{ $client_job_card->client_vehicle_reg_no->vehicle_registration_number or '' }}</td>
                                <td field-key='job_type'>{{ $client_job_card->job_type }}</td>
                                <td field-key='status'>{{ $client_job_card->status }}</td>

                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_job_cards.restore', $client_job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_job_cards.perma_del', $client_job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('client_job_card_view')
                                    <a href="{{ route('admin.client_job_cards.show',[$client_job_card->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    <!--@can('client_job_card_edit')
                                    <a href="{{ route('admin.client_job_cards.edit',[$client_job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan-->
                                    @can('client_job_card_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.client_job_cards.destroy', $client_job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    <a href="{{ route('admin.client_job_cards.download',$client_job_card->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="20">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('client_job_card_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.client_job_cards.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection