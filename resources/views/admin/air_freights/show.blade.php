@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.air-freight.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.air-freight.fields.project-number')</th>
                            <td field-key='project_number'>{{ $air_freight->project_number->operation_number or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.air-freight.fields.air-freight-number')</th>
                            <td field-key='air_freight_number'>{{ $air_freight->air_freight_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.air-freight.fields.client')</th>
                            <td field-key='client'>{{ $air_freight->client->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.air-freight.fields.contact-person')</th>
                            <td field-key='contact_person'>{{ $air_freight->contact_person->contact_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.air-freight.fields.airline-or-agent')</th>
                            <td field-key='airline_or_agent'>
                                @foreach ($air_freight->airline_or_agent as $singleAirlineOrAgent)
                                    <span class="label label-info label-many">{{ $singleAirlineOrAgent->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.air-freight.fields.airline-or-agent-contact')</th>
                            <td field-key='airline_or_agent_contact'>{{ $air_freight->airline_or_agent_contact->contact_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.air-freight.fields.project-manager')</th>
                            <td field-key='project_manager'>{{ $air_freight->project_manager->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.air-freight.fields.flight-number')</th>
                            <td field-key='flight_number'>{{ $air_freight->flight_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.air-freight.fields.route')</th>
                            <td field-key='route'>{{ $air_freight->route->route or '' }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#load_descriptions" aria-controls="load_descriptions" role="tab" data-toggle="tab">Load descriptions</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="load_descriptions">
<table class="table table-bordered table-striped {{ count($load_descriptions) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.load-descriptions.fields.description')</th>
                        <th>@lang('global.load-descriptions.fields.qty')</th>
                        <th>@lang('global.load-descriptions.fields.weight-volume')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($load_descriptions) > 0)
            @foreach ($load_descriptions as $load_description)
                <tr data-entry-id="{{ $load_description->id }}">
                    <td field-key='description'>{{ $load_description->description }}</td>
                                <td field-key='qty'>{{ $load_description->qty }}</td>
                                <td field-key='weight_volume'>{{ $load_description->weight_volume }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.load_descriptions.restore', $load_description->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.load_descriptions.perma_del', $load_description->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('load_description_view')
                                    <a href="{{ route('admin.load_descriptions.show',[$load_description->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('load_description_edit')
                                    <a href="{{ route('admin.load_descriptions.edit',[$load_description->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('load_description_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.load_descriptions.destroy', $load_description->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="13">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.air_freights.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


