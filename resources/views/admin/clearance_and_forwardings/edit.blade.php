@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.clearance-and-forwarding.title')</h3>
    
    {!! Form::model($clearance_and_forwarding, ['method' => 'PUT', 'route' => ['admin.clearance_and_forwardings.update', $clearance_and_forwarding->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_number_id', trans('global.clearance-and-forwarding.fields.project-number').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('clearance_and_forwarding_number', trans('global.clearance-and-forwarding.fields.clearance-and-forwarding-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('clearance_and_forwarding_number', old('clearance_and_forwarding_number'), ['class' => 'form-control', 'placeholder' => 'Auto Generated']) !!}
                    <p class="help-block">Auto Generated</p>
                    @if($errors->has('clearance_and_forwarding_number'))
                        <p class="help-block">
                            {{ $errors->first('clearance_and_forwarding_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('border_post', trans('global.clearance-and-forwarding.fields.border-post').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('border_post', old('border_post'), ['class' => 'form-control', 'placeholder' => 'Border post', 'required' => '']) !!}
                    <p class="help-block">Border post</p>
                    @if($errors->has('border_post'))
                        <p class="help-block">
                            {{ $errors->first('border_post') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('client_id', trans('global.clearance-and-forwarding.fields.client').'*', ['class' => 'control-label']) !!}
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
                    {!! Form::label('contact_person_id', trans('global.clearance-and-forwarding.fields.contact-person').'', ['class' => 'control-label']) !!}
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
                    {!! Form::label('agent_id', trans('global.clearance-and-forwarding.fields.agent').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('agent_id', $agents, old('agent_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    <p class="help-block">Agent</p>
                    @if($errors->has('agent_id'))
                        <p class="help-block">
                            {{ $errors->first('agent_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('agent_contact_id', trans('global.clearance-and-forwarding.fields.agent-contact').'', ['class' => 'control-label']) !!}
                    {!! Form::select('agent_contact_id', $agent_contacts, old('agent_contact_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Contact person</p>
                    @if($errors->has('agent_contact_id'))
                        <p class="help-block">
                            {{ $errors->first('agent_contact_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('project_manager_id', trans('global.clearance-and-forwarding.fields.project-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_manager_id', $project_managers, old('project_manager_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Project manager</p>
                    @if($errors->has('project_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('project_manager_id') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            Item descriptions
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-striped">
                <thead>
                <tr>
                    <th>@lang('global.invoice-items.fields.item-description')</th>
                        <th>@lang('global.invoice-items.fields.unit-price')</th>
                        <th>@lang('global.invoice-items.fields.qty')</th>
                        <th>@lang('global.invoice-items.fields.total')</th>
                        
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody id="item-descriptions">
                    @forelse(old('invoice_items', []) as $index => $data)
                        @include('admin.clearance_and_forwardings.invoice_items_row', [
                            'index' => $index
                        ])
                    @empty
                        @foreach($clearance_and_forwarding->invoice_items as $item)
                            @include('admin.clearance_and_forwardings.invoice_items_row', [
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

    <script type="text/html" id="item-descriptions-template">
        @include('admin.clearance_and_forwardings.invoice_items_row',
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
@stop