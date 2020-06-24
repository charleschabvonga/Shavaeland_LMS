@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')

    @can('inhouse_job_card_create')
    <p>
        <a href="{{ route('admin.inhouse_job_cards.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
        
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.inhouse_job_cards.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.inhouse_job_cards.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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
                        <h1><span style="color:#CE8F64">JOB CARDS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($inhouse_job_cards) > 0 ? 'datatable' : '' }} @can('inhouse_job_card_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('inhouse_job_card_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.inhouse-job-cards.fields.job-card-number')</th>
                        <th>@lang('Vehicle reg No.')</th>
                        <th>@lang('global.inhouse-job-cards.fields.job-type')</th>
                        <th class="text-center">@lang('global.inhouse-job-cards.fields.status')</th>

                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($inhouse_job_cards) > 0)
                        @foreach ($inhouse_job_cards as $inhouse_job_card)
                            <tr data-entry-id="{{ $inhouse_job_card->id }}">
                                @can('inhouse_job_card_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='job_card_number'>{{ $inhouse_job_card->job_card_number }}</td>

                                <td field-key='vehicle'> {{ $inhouse_job_card->vehicle->vehicle_description or '' }} {{ $inhouse_job_card->client_vehicle_reg_no->registration_number or '' }} {{ $inhouse_job_card->trailer->trailer_description or ''}} {{ $inhouse_job_card->light_vehicles->vehicle_description or '' }}</td>
                               

                                <td field-key='job_type'>{{ $inhouse_job_card->job_type }}</td>
                                

                                @if($inhouse_job_card->status == 'Job Ongoing')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $inhouse_job_card->status }}</td>
                                @endif
                                @if($inhouse_job_card->status == 'Job Complete')
                                <td class="label-md label-success text-center" field-key='status'>{{ $inhouse_job_card->status }}</td>
                                @endif
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.inhouse_job_cards.restore', $inhouse_job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.inhouse_job_cards.perma_del', $inhouse_job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('inhouse_job_card_view')
                                    <a href="{{ route('admin.inhouse_job_cards.show',[$inhouse_job_card->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('inhouse_job_card_edit')
                                    <!--a href="{{ route('admin.inhouse_job_cards.edit',[$inhouse_job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                                    @endcan
                                    @can('inhouse_job_card_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.inhouse_job_cards.destroy', $inhouse_job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    <a href="{{ route('admin.inhouse_job_cards.download',$inhouse_job_card->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="24">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('inhouse_job_card_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.inhouse_job_cards.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection