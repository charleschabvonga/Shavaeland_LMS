@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.sea-freight.title')</h3>
    {!! Form::open(['method' => 'POST', 'route' => ['admin.sea_freights.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_number_id', trans('global.sea-freight.fields.project-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('project_number_id', $project_numbers, old('project_number_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">Project No.</p>
                    @if($errors->has('project_number_id'))
                        <p class="help-block">
                            {{ $errors->first('project_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('sea_freight_number', trans('global.sea-freight.fields.sea-freight-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('sea_freight_number', old('sea_freight_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated']) !!}
                    <p class="help-block">Auto Generated</p>
                    @if($errors->has('sea_freight_number'))
                        <p class="help-block">
                            {{ $errors->first('sea_freight_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('client_id', trans('global.sea-freight.fields.client').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">Client</p>
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('contact_person_id', trans('global.sea-freight.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Contact person</p>
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('shipper__or_agent', trans('global.sea-freight.fields.shipper-or-agent').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-shipper__or_agent">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-shipper__or_agent">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('shipper__or_agent[]', $shipper__or_agents, old('shipper__or_agent'), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-shipper__or_agent' , 'required' => '']) !!}
                    <p class="help-block">Shipper/Agent</p>
                    @if($errors->has('shipper__or_agent'))
                        <p class="help-block">
                            {{ $errors->first('shipper__or_agent') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('shipper_or_agent_contact_id', trans('global.sea-freight.fields.shipper-or-agent-contact').'', ['class' => 'control-label']) !!}
                    {!! Form::select('shipper_or_agent_contact_id', $shipper_or_agent_contacts, old('shipper_or_agent_contact_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Contact person</p>
                    @if($errors->has('shipper_or_agent_contact_id'))
                        <p class="help-block">
                            {{ $errors->first('shipper_or_agent_contact_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_manager_id', trans('global.sea-freight.fields.project-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_manager_id', $project_managers, old('project_manager_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Project manager</p>
                    @if($errors->has('project_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('project_manager_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('voyage_number', trans('global.sea-freight.fields.voyage-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('voyage_number', old('voyage_number'), ['class' => 'form-control', 'placeholder' => 'Voyage No.', 'required' => '']) !!}
                    <p class="help-block">Voyage No.</p>
                    @if($errors->has('voyage_number'))
                        <p class="help-block">
                            {{ $errors->first('voyage_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('route_id', trans('global.sea-freight.fields.route').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('route_id', $routes, old('route_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">Route</p>
                    @if($errors->has('route_id'))
                        <p class="help-block">
                            {{ $errors->first('route_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Load descriptions
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.load-descriptions.fields.description')</th>
                        <th>@lang('global.load-descriptions.fields.qty')</th>
                        <th>@lang('global.load-descriptions.fields.weight-volume')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="load-descriptions">
                    @foreach(old('load_descriptions', []) as $index => $data)
                        @include('admin.sea_freights.load_descriptions_row', [
                            'index' => $index
                        ])
                    @endforeach
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="load-descriptions-template">
        @include('admin.sea_freights.load_descriptions_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

            <script>
        $('.add-new').click(function () {
            var tableBody = $(this).parent().find('tbody');
            var template = $('#' + tableBody.attr('id') + '-template').html();
            var lastIndex = parseInt(tableBody.find('tr').last().data('index'));
            if (isNaN(lastIndex)) {
                lastIndex = 0;
            }
            tableBody.append(template.replace(/_INDEX_/g, lastIndex + 1));
            return false;
        });
        $(document).on('click', '.remove', function () {
            var row = $(this).parentsUntil('tr').parent();
            row.remove();
            return false;
        });
        </script>
    <script>
        $("#selectbtn-shipper__or_agent").click(function(){
            $("#selectall-shipper__or_agent > option").prop("selected","selected");
            $("#selectall-shipper__or_agent").trigger("change");
        });
        $("#deselectbtn-shipper__or_agent").click(function(){
            $("#selectall-shipper__or_agent > option").prop("selected","");
            $("#selectall-shipper__or_agent").trigger("change");
        });
    </script>
@stop