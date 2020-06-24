@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.job-cards.title')</h3>
    
    {!! Form::model($job_card, ['method' => 'PUT', 'route' => ['admin.job_cards.update', $job_card->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
        
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_number', trans('global.job-cards.fields.project-number').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-project_number">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-project_number">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('project_number[]', $project_numbers, old('project_number') ? old('project_number') : $job_card->project_number->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-project_number' , 'required' => '']) !!}
                    <p class="help-block">Transaction No.</p>
                    @if($errors->has('project_number'))
                        <p class="help-block">
                            {{ $errors->first('project_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('job_card_number', trans('global.job-cards.fields.job-card-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('job_card_number', old('job_card_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated']) !!}
                    <p class="help-block">Auto Generated</p>
                    @if($errors->has('job_card_number'))
                        <p class="help-block">
                            {{ $errors->first('job_card_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('client_type', trans('global.job-cards.fields.client-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_type', $enum_client_type, old('client_type'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Client type</p>
                    @if($errors->has('client_type'))
                        <p class="help-block">
                            {{ $errors->first('client_type') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('client_id', trans('global.job-cards.fields.client').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2']) !!}
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
                    {!! Form::label('contact_person_id', trans('global.job-cards.fields.contact-person').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('client_vehicle_reg_no_id', trans('global.job-cards.fields.client-vehicle-reg-no').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_vehicle_reg_no_id', $client_vehicle_reg_nos, old('client_vehicle_reg_no_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Vehicle reg no</p>
                    @if($errors->has('client_vehicle_reg_no_id'))
                        <p class="help-block">
                            {{ $errors->first('client_vehicle_reg_no_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('maintenance_type', trans('global.job-cards.fields.maintenance-type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('maintenance_type', $enum_maintenance_type, old('maintenance_type'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">Maintenance type</p>
                    @if($errors->has('maintenance_type'))
                        <p class="help-block">
                            {{ $errors->first('maintenance_type') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('road_freight_number_id', trans('global.job-cards.fields.road-freight-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('road_freight_number_id', $road_freight_numbers, old('road_freight_number_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Road freight No.</p>
                    @if($errors->has('road_freight_number_id'))
                        <p class="help-block">
                            {{ $errors->first('road_freight_number_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vehicle_type', trans('global.job-cards.fields.vehicle-type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('vehicle_type', $enum_vehicle_type, old('vehicle_type'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">Vehicle type</p>
                    @if($errors->has('vehicle_type'))
                        <p class="help-block">
                            {{ $errors->first('vehicle_type') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('vehicle_id', trans('global.job-cards.fields.vehicle').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('vehicle_id', $vehicles, old('vehicle_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">vehicle_reg_no</p>
                    @if($errors->has('vehicle_id'))
                        <p class="help-block">
                            {{ $errors->first('vehicle_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('repair_center_id', trans('global.job-cards.fields.repair-center').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('repair_center_id', $repair_centers, old('repair_center_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">Repair center</p>
                    @if($errors->has('repair_center_id'))
                        <p class="help-block">
                            {{ $errors->first('repair_center_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('workshop_manager_id', trans('global.job-cards.fields.workshop-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('workshop_manager_id', $workshop_managers, old('workshop_manager_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Workshop manager</p>
                    @if($errors->has('workshop_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('workshop_manager_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('technician', trans('global.job-cards.fields.technician').'*', ['class' => 'control-label']) !!}
                    <button type="button" class="btn btn-primary btn-xs" id="selectbtn-technician">
                        {{ trans('global.app_select_all') }}
                    </button>
                    <button type="button" class="btn btn-primary btn-xs" id="deselectbtn-technician">
                        {{ trans('global.app_deselect_all') }}
                    </button>
                    {!! Form::select('technician[]', $technicians, old('technician') ? old('technician') : $job_card->technician->pluck('id')->toArray(), ['class' => 'form-control select2', 'multiple' => 'multiple', 'id' => 'selectall-technician' , 'required' => '']) !!}
                    <p class="help-block">Technician(s)</p>
                    @if($errors->has('technician'))
                        <p class="help-block">
                            {{ $errors->first('technician') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('remarks', trans('global.job-cards.fields.remarks').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('remarks', old('remarks'), ['class' => 'form-control ', 'placeholder' => 'Remarks']) !!}
                    <p class="help-block">Remarks</p>
                    @if($errors->has('remarks'))
                        <p class="help-block">
                            {{ $errors->first('remarks') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('subtotal', trans('global.job-cards.fields.subtotal').'', ['class' => 'control-label']) !!}
                    {!! Form::text('subtotal', old('subtotal'), ['class' => 'form-control', 'placeholder' => '0.00']) !!}
                    <p class="help-block">0.00</p>
                    @if($errors->has('subtotal'))
                        <p class="help-block">
                            {{ $errors->first('subtotal') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('prepared_by', trans('global.job-cards.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    {!! Form::text('prepared_by', old('prepared_by'), ['class' => 'form-control', 'placeholder' => 'Auto Generated']) !!}
                    <p class="help-block">Auto Generated</p>
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('job_type', trans('global.job-cards.fields.job-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('job_type', $enum_job_type, old('job_type'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Job type</p>
                    @if($errors->has('job_type'))
                        <p class="help-block">
                            {{ $errors->first('job_type') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('status', trans('global.job-cards.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Status</p>
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Job card items
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.job-card-items.fields.workshop')</th>
                        <th>@lang('global.job-card-items.fields.part')</th>
                        <th>@lang('global.job-card-items.fields.price')</th>
                        <th>@lang('global.job-card-items.fields.qty')</th>
                        <th>@lang('global.job-card-items.fields.total')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="job-card-items">
                    @forelse(old('job_card_items', []) as $index => $data)
                        @include('admin.job_cards.job_card_items_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($job_card->job_card_items as $item)
                            @include('admin.job_cards.job_card_items_row', [
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

    <script type="text/html" id="job-card-items-template">
        @include('admin.job_cards.job_card_items_row',
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
        $("#selectbtn-project_number").click(function(){
            $("#selectall-project_number > option").prop("selected","selected");
            $("#selectall-project_number").trigger("change");
        });
        $("#deselectbtn-project_number").click(function(){
            $("#selectall-project_number > option").prop("selected","");
            $("#selectall-project_number").trigger("change");
        });
    </script>

    <script>
        $("#selectbtn-technician").click(function(){
            $("#selectall-technician > option").prop("selected","selected");
            $("#selectall-technician").trigger("change");
        });
        $("#deselectbtn-technician").click(function(){
            $("#selectall-technician > option").prop("selected","");
            $("#selectall-technician").trigger("change");
        });
    </script>
@stop