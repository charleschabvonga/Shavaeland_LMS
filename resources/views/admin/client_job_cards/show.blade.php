@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.client-job-cards.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.client-job-cards.fields.job-request-number')</th>
                            <td field-key='job_request_number'>{{ $client_job_card->job_request_number->job_request_number or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.date')</th>
                            <td field-key='date'>{{ $client_job_card->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.job-card-number')</th>
                            <td field-key='job_card_number'>{{ $client_job_card->job_card_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.prepared-by')</th>
                            <td field-key='prepared_by'>{{ $client_job_card->prepared_by }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.project-number')</th>
                            <td field-key='project_number'>{{ $client_job_card->project_number->operation_number or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.client')</th>
                            <td field-key='client'>{{ $client_job_card->client->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.contact-person')</th>
                            <td field-key='contact_person'>{{ $client_job_card->contact_person->contact_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.status')</th>
                            <td field-key='status'>{{ $client_job_card->status }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.job-type')</th>
                            <td field-key='job_type'>{{ $client_job_card->job_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.repair-center')</th>
                            <td field-key='repair_center'>{{ $client_job_card->repair_center->center_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.technician')</th>
                            <td field-key='technician'>
                                @foreach ($client_job_card->technician as $singleTechnician)
                                    <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                @endforeach
                            </td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.client-vehicle-reg-no')</th>
                            <td field-key='client_vehicle_reg_no'>{{ $client_job_card->client_vehicle_reg_no->vehicle_registration_number or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.vehicle-type')</th>
                            <td field-key='vehicle_type'>{{ isset($client_job_card->client_vehicle_reg_no) ? $client_job_card->client_vehicle_reg_no->vehicle_type : '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.remarks')</th>
                            <td field-key='remarks'>{!! $client_job_card->remarks !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.instructions')</th>
                            <td field-key='instructions'>{!! $client_job_card->instructions !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.client-job-cards.fields.subtotal')</th>
                            <td field-key='subtotal'>{{ $client_job_card->subtotal }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
<ul class="nav nav-tabs" role="tablist">
    
<li role="presentation" class="active"><a href="#job_card_items" aria-controls="job_card_items" role="tab" data-toggle="tab">Job card items</a></li>
</ul>

<!-- Tab panes -->
<div class="tab-content">
    
<div role="tabpanel" class="tab-pane active" id="job_card_items">
<table class="table table-bordered table-striped {{ count($job_card_items) > 0 ? 'datatable' : '' }}">
    <thead>
        <tr>
            <th>@lang('global.job-card-items.fields.workshop')</th>
                        <th>@lang('global.job-card-items.fields.part')</th>
                        <th>@lang('global.job-card-items.fields.price')</th>
                        <th>@lang('global.job-card-items.fields.qty')</th>
                        <th>@lang('global.job-card-items.fields.total')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
        </tr>
    </thead>

    <tbody>
        @if (count($job_card_items) > 0)
            @foreach ($job_card_items as $job_card_item)
                <tr data-entry-id="{{ $job_card_item->id }}">
                    <td field-key='workshop'>{{ $job_card_item->workshop }}</td>
                                <td field-key='part'>{{ $job_card_item->part }}</td>
                                <td field-key='price'>{{ $job_card_item->price }}</td>
                                <td field-key='qty'>{{ $job_card_item->qty }}</td>
                                <td field-key='total'>{{ $job_card_item->total }}</td>
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_card_items.restore', $job_card_item->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_card_items.perma_del', $job_card_item->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('job_card_item_view')
                                    <a href="{{ route('admin.job_card_items.show',[$job_card_item->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('job_card_item_edit')
                                    <a href="{{ route('admin.job_card_items.edit',[$job_card_item->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('job_card_item_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.job_card_items.destroy', $job_card_item->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                </tr>
            @endforeach
        @else
            <tr>
                <td colspan="12">@lang('global.app_no_entries_in_table')</td>
            </tr>
        @endif
    </tbody>
</table>
</div>
</div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.client_job_cards.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop

@section('javascript')
    @parent

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
            });
            
        });
    </script>
            
@stop
