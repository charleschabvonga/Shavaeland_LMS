@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.job-requests.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.job-requests.fields.project-number')</th>
                            <td field-key='project_number'>{{ $job_request->project_number->operation_number or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.description')</th>
                            <td field-key='description'>{!! $job_request->description !!}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.workshop-manager')</th>
                            <td field-key='workshop_manager'>{{ $job_request->workshop_manager->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.job-request-number')</th>
                            <td field-key='job_request_number'>{{ $job_request->job_request_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.requested-by')</th>
                            <td field-key='requested_by'>{{ $job_request->requested_by }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.client')</th>
                            <td field-key='client'>{{ $job_request->client->name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.contact-person')</th>
                            <td field-key='contact_person'>{{ $job_request->contact_person->contact_name or '' }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.date')</th>
                            <td field-key='date'>{{ $job_request->date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.vehicle-type')</th>
                            <td field-key='vehicle_type'>{{ $job_request->vehicle_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.vehicle-registration-number')</th>
                            <td field-key='vehicle_registration_number'>{{ $job_request->vehicle_registration_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.make')</th>
                            <td field-key='make'>{{ $job_request->make }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.model')</th>
                            <td field-key='model'>{{ $job_request->model }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.mileage')</th>
                            <td field-key='mileage'>{{ $job_request->mileage }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.next-service-mileage')</th>
                            <td field-key='next_service_mileage'>{{ $job_request->next_service_mileage }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.next-service-date')</th>
                            <td field-key='next_service_date'>{{ $job_request->next_service_date }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-requests.fields.status')</th>
                            <td field-key='status'>{{ $job_request->status }}</td>
                        </tr>
                    </table>
                </div>
            </div><!-- Nav tabs -->
            <ul class="nav nav-tabs" role="tablist">
    
    <li role="presentation" class="active"><a href="#client_job_cards" aria-controls="client_job_cards" role="tab" data-toggle="tab">Job cards</a></li>
    <li role="presentation" class=""><a href="#client_job_cards" aria-controls="client_job_cards" role="tab" data-toggle="tab">Job cards</a></li>
    </ul>
    
    <!-- Tab panes -->
    <div class="tab-content">
        
    <div role="tabpanel" class="tab-pane active" id="client_job_cards">
    <table class="table table-bordered table-striped {{ count($client_job_cards) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.client-job-cards.fields.job-request-number')</th>
                            <th>@lang('global.client-job-cards.fields.date')</th>
                            <th>@lang('global.client-job-cards.fields.job-card-number')</th>
                            <th>@lang('global.client-job-cards.fields.prepared-by')</th>
                            <th>@lang('global.client-job-cards.fields.project-number')</th>
                            <th>@lang('global.client-job-cards.fields.client')</th>
                            <th>@lang('global.client-job-cards.fields.contact-person')</th>
                            <th>@lang('global.client-job-cards.fields.status')</th>
                            <th>@lang('global.client-job-cards.fields.job-type')</th>
                            <th>@lang('global.client-job-cards.fields.repair-center')</th>
                            <th>@lang('global.client-job-cards.fields.technician')</th>
                            <th>@lang('global.client-job-cards.fields.client-vehicle-reg-no')</th>
                            <th>@lang('global.client-job-cards.fields.remarks')</th>
                            <th>@lang('global.client-job-cards.fields.instructions')</th>
                            <th>@lang('global.client-job-cards.fields.subtotal')</th>
                            <th>@lang('global.client-job-cards.fields.currency')</th>
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
                        <td field-key='job_request_number'>{{ $client_job_card->job_request_number->job_request_number or '' }}</td>
                                    <td field-key='date'>{{ $client_job_card->date }}</td>
                                    <td field-key='job_card_number'>{{ $client_job_card->job_card_number }}</td>
                                    <td field-key='prepared_by'>{{ $client_job_card->prepared_by }}</td>
                                    <td field-key='project_number'>{{ $client_job_card->project_number->operation_number or '' }}</td>
                                    <td field-key='client'>{{ $client_job_card->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $client_job_card->contact_person->contact_name or '' }}</td>
                                    <td field-key='status'>{{ $client_job_card->status }}</td>
                                    <td field-key='job_type'>{{ $client_job_card->job_type }}</td>
                                    <td field-key='repair_center'>{{ $client_job_card->repair_center->center_name or '' }}</td>
                                    <td field-key='technician'>
                                        @foreach ($client_job_card->technician as $singleTechnician)
                                            <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='client_vehicle_reg_no'>{{ $client_job_card->client_vehicle_reg_no->vehicle_registration_number or '' }}</td>
                                    <td field-key='remarks'>{!! $client_job_card->remarks !!}</td>
                                    <td field-key='instructions'>{!! $client_job_card->instructions !!}</td>
                                    <td field-key='subtotal'>{{ $client_job_card->subtotal }}</td>
                                    <td field-key='currency'>{{ $client_job_card->currency->name or '' }}</td>
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
                                        @can('client_job_card_edit')
                                        <a href="{{ route('admin.client_job_cards.edit',[$client_job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('client_job_card_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_job_cards.destroy', $client_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="21">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    <div role="tabpanel" class="tab-pane " id="client_job_cards">
    <table class="table table-bordered table-striped {{ count($client_job_cards) > 0 ? 'datatable' : '' }}">
        <thead>
            <tr>
                <th>@lang('global.client-job-cards.fields.job-request-number')</th>
                            <th>@lang('global.client-job-cards.fields.date')</th>
                            <th>@lang('global.client-job-cards.fields.job-card-number')</th>
                            <th>@lang('global.client-job-cards.fields.prepared-by')</th>
                            <th>@lang('global.client-job-cards.fields.project-number')</th>
                            <th>@lang('global.client-job-cards.fields.client')</th>
                            <th>@lang('global.client-job-cards.fields.contact-person')</th>
                            <th>@lang('global.client-job-cards.fields.status')</th>
                            <th>@lang('global.client-job-cards.fields.job-type')</th>
                            <th>@lang('global.client-job-cards.fields.repair-center')</th>
                            <th>@lang('global.client-job-cards.fields.technician')</th>
                            <th>@lang('global.client-job-cards.fields.client-vehicle-reg-no')</th>
                            <th>@lang('global.client-job-cards.fields.remarks')</th>
                            <th>@lang('global.client-job-cards.fields.instructions')</th>
                            <th>@lang('global.client-job-cards.fields.subtotal')</th>
                            <th>@lang('global.client-job-cards.fields.currency')</th>
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
                        <td field-key='job_request_number'>{{ $client_job_card->job_request_number->job_request_number or '' }}</td>
                                    <td field-key='date'>{{ $client_job_card->date }}</td>
                                    <td field-key='job_card_number'>{{ $client_job_card->job_card_number }}</td>
                                    <td field-key='prepared_by'>{{ $client_job_card->prepared_by }}</td>
                                    <td field-key='project_number'>{{ $client_job_card->project_number->operation_number or '' }}</td>
                                    <td field-key='client'>{{ $client_job_card->client->name or '' }}</td>
                                    <td field-key='contact_person'>{{ $client_job_card->contact_person->contact_name or '' }}</td>
                                    <td field-key='status'>{{ $client_job_card->status }}</td>
                                    <td field-key='job_type'>{{ $client_job_card->job_type }}</td>
                                    <td field-key='repair_center'>{{ $client_job_card->repair_center->center_name or '' }}</td>
                                    <td field-key='technician'>
                                        @foreach ($client_job_card->technician as $singleTechnician)
                                            <span class="label label-info label-many">{{ $singleTechnician->name }}</span>
                                        @endforeach
                                    </td>
                                    <td field-key='client_vehicle_reg_no'>{{ $client_job_card->client_vehicle_reg_no->vehicle_registration_number or '' }}</td>
                                    <td field-key='remarks'>{!! $client_job_card->remarks !!}</td>
                                    <td field-key='instructions'>{!! $client_job_card->instructions !!}</td>
                                    <td field-key='subtotal'>{{ $client_job_card->subtotal }}</td>
                                    <td field-key='currency'>{{ $client_job_card->currency->name or '' }}</td>
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
                                        @can('client_job_card_edit')
                                        <a href="{{ route('admin.client_job_cards.edit',[$client_job_card->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                        @endcan
                                        @can('client_job_card_delete')
    {!! Form::open(array(
                                            'style' => 'display: inline-block;',
                                            'method' => 'DELETE',
                                            'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                            'route' => ['admin.client_job_cards.destroy', $client_job_card->id])) !!}
                                        {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                        {!! Form::close() !!}
                                        @endcan
                                    </td>
                                    @endif
                    </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="21">@lang('global.app_no_entries_in_table')</td>
                </tr>
            @endif
        </tbody>
    </table>
    </div>
    </div>
    
                <p>&nbsp;</p>
    
                <a href="{{ route('admin.job_requests.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
    