@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.rail-freight.title')</h3>
    
    {!! Form::model($rail_freight, ['method' => 'PUT', 'route' => ['admin.rail_freights.update', $rail_freight->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_number_id', trans('global.rail-freight.fields.project-number').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('rail_freight_number', trans('global.rail-freight.fields.rail-freight-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('rail_freight_number', old('rail_freight_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated']) !!}
                    <p class="help-block">Auto Generated</p>
                    @if($errors->has('rail_freight_number'))
                        <p class="help-block">
                            {{ $errors->first('rail_freight_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('client_id', trans('global.rail-freight.fields.client').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('contact_person_id', trans('global.rail-freight.fields.contact-person').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('railline_or_agent', trans('global.rail-freight.fields.railline-or-agent').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-railline_or_agent">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-railline_or_agent">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('railline_or_agent[]', $railline_or_agents, old('railline_or_agent') ? old('railline_or_agent') : $rail_freight->railline_or_agent->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-railline_or_agent' , 'required' => '']) !!}
                    <p class="help-block">Railline/Agent</p>
                    @if($errors->has('railline_or_agent'))
                        <p class="help-block">
                            {{ $errors->first('railline_or_agent') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('railline_or_agent_contact_id', trans('global.rail-freight.fields.railline-or-agent-contact').'', ['class' => 'control-label']) !!}
                    {!! Form::select('railline_or_agent_contact_id', $railline_or_agent_contacts, old('railline_or_agent_contact_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Contact person</p>
                    @if($errors->has('railline_or_agent_contact_id'))
                        <p class="help-block">
                            {{ $errors->first('railline_or_agent_contact_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_manager_id', trans('global.rail-freight.fields.project-manager').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('trip_number', trans('global.rail-freight.fields.trip-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('trip_number', old('trip_number'), ['class' => 'form-control', 'placeholder' => 'Trip No.']) !!}
                    <p class="help-block">Trip No.</p>
                    @if($errors->has('trip_number'))
                        <p class="help-block">
                            {{ $errors->first('trip_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('route_id', trans('global.rail-freight.fields.route').'*', ['class' => 'control-label']) !!}
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
                    @forelse(old('load_descriptions', []) as $index => $data)
                        @include('admin.rail_freights.load_descriptions_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($rail_freight->load_descriptions as $item)
                            @include('admin.rail_freights.load_descriptions_row', [
                                'index' => 'id-' . $item->id,
                                'field' => $item
                            ])
                        @endforeach
                    @endforelse
                </tbody>
            </table>
            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="load-descriptions-template">
        @include('admin.rail_freights.load_descriptions_row',
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
        $("#selectbtn-railline_or_agent").click(function(){
            $("#selectall-railline_or_agent > option").prop("selected","selected");
            $("#selectall-railline_or_agent").trigger("change");
        });
        $("#deselectbtn-railline_or_agent").click(function(){
            $("#selectall-railline_or_agent > option").prop("selected","");
            $("#selectall-railline_or_agent").trigger("change");
        });
    </script>
@stop