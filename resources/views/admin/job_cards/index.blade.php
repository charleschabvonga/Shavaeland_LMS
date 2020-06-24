@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('job_card_create')
    <p>
        <a href="{{ route('admin.job_cards.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.job_cards.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.job_cards.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
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

            <table class="table table-bordered table-striped {{ count($job_cards) > 0 ? 'datatable' : '' }} @can('job_card_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('job_card_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        
                        <th>@lang('global.job-cards.fields.job-card-number')</th>
                        <th>@lang('global.job-cards.fields.client')</th>
                        <th>@lang('Vehicle reg No.')</th>
                        <th>@lang('global.job-cards.fields.job-type')</th>
                        <th>@lang('global.job-cards.fields.road-freight-number')</th>
                        <th class="text-center">@lang('global.job-cards.fields.status')</th>

                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($job_cards) > 0)
                        @foreach ($job_cards as $job_card)
                            <tr data-entry-id="{{ $job_card->id }}">
                                @can('job_card_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='job_card_number'>{{ $job_card->job_card_number }}</td>
                                <td field-key='client'>{{ $job_card->client->name or '' }}</td>

                                @if ($job_card->vehicle != '')
                                <td field-key='vehicle'>{{ $job_card->vehicle->vehicle_description or '' }}</td>
                                @endif
                                @if ($job_card->client_vehicle_reg_no != '')
                                <td field-key='client_vehicle_reg_no'>{{ $job_card->client_vehicle_reg_no->registration_number or '' }}</td>
                                @endif

                                <td field-key='job_type'>{{ $job_card->job_type }}</td>
                                <td field-key='road_freight_number'>{{ $job_card->road_freight_number->road_freight_number or '' }}</td>

                                @if($job_card->status == 'Job Ongoing')
                                <td class="label-md label-warning text-center" field-key='status'>{{ $job_card->status }}</td>
                                @endif
                                @if($job_card->status == 'Job Complete')
                                <td class="label-md label-success text-center" field-key='status'>{{ $job_card->status }}</td>
                                @endif

                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_cards.restore', $job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_cards.perma_del', $job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('job_card_view')
                                    <a href="{{ route('admin.job_cards.show',[$job_card->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('job_card_edit')
                                    <!--a href="{{ route('admin.job_cards.edit',[$job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a-->
                                    @endcan
                                    @can('job_card_delete')
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_cards.destroy', $job_card->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                    <a href="{{ route('admin.job_cards.download',$job_card->id) }}" class="btn btn-xs btn-warning">View PDF</a>
                                </td>
                                @endif
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
        @can('job_card_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.job_cards.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection