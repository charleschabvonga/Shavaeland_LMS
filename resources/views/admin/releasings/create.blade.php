@extends('layouts.app')

@section('content')
    {!! Form::open(['method' => 'POST', 'route' => ['admin.releasings.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">WAREHOUSE GOODS COLLECTION</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('date', trans('global.releasing.fields.date').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('date', old('date'), ['class' => 'form-control datetime', 'placeholder' => 'YYYY-MM-DD', 'required' => '']) !!}
                    @if($errors->has('date'))
                        <p class="help-block">
                            {{ $errors->first('date') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('project_number_id', trans('global.releasing.fields.project-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('project_number_id', $project_numbers, old('project_number_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('project_number_id'))
                        <p class="help-block">
                            {{ $errors->first('project_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('warehouse_id', trans('global.releasing.fields.warehouse').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('warehouse_id', $warehouses, old('warehouse_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('warehouse_id'))
                        <p class="help-block">
                            {{ $errors->first('warehouse_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('prepared_by', trans('global.releasing.fields.prepared-by').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='prepared_by' value='{{ Auth::user()->name }}' class="form-control" readonly/></td>
                    @if($errors->has('prepared_by'))
                        <p class="help-block">
                            {{ $errors->first('prepared_by') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('release_number', trans('global.releasing.fields.release-number').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='release_number' value='{{ $release_number }}' class="form-control" readonly required/></td>
                    @if($errors->has('release_number'))
                        <p class="help-block">
                            {{ $errors->first('release_number') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('client_id', trans('global.releasing.fields.client').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('client_id', $clients, old('client_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('client_id'))
                        <p class="help-block">
                            {{ $errors->first('client_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('contact_person_id', trans('global.releasing.fields.contact-person').'', ['class' => 'control-label']) !!}
                    {!! Form::select('contact_person_id', $contact_people, old('contact_person_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('contact_person_id'))
                        <p class="help-block">
                            {{ $errors->first('contact_person_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('released_by_id', trans('global.releasing.fields.released-by').'', ['class' => 'control-label']) !!}
                    {!! Form::select('released_by_id', $released_bies, old('released_by_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('released_by_id'))
                        <p class="help-block">
                            {{ $errors->first('released_by_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('project_manager_id', trans('global.releasing.fields.project-manager').'', ['class' => 'control-label']) !!}
                    {!! Form::select('project_manager_id', $project_managers, old('project_manager_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('project_manager_id'))
                        <p class="help-block">
                            {{ $errors->first('project_manager_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('area_coverd', trans('global.releasing.fields.area-coverd').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('area_coverd', old('area_coverd'), ['class' => 'form-control', 'placeholder' => 'Area covered', 'required' => '']) !!}
                    @if($errors->has('area_coverd'))
                        <p class="help-block">
                            {{ $errors->first('area_coverd') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-12 form-group">
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <table class="table table-bordered table-striped">
                                <legend class="text-center"><span style="color:#CE8F64">WAREHOUSE COLLECTED GOODS</span></legend>
                                <thead>
                                <tr>
                                    <th>@lang('global.received-items.fields.item')</th>
                                        <th>@lang('global.received-items.fields.qty')</th>
                                        <th>@lang('global.received-items.fields.area')</th>
                                        
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody id="warehouse-items">
                                    @foreach(old('received_items', []) as $index => $data)
                                        @include('admin.releasings.received_items_row', [
                                            'index' => $index
                                        ])
                                    @endforeach
                                </tbody>
                            </table>
                            <a href="#" class="btn btn-success pull-right add-new">@lang('global.app_add_new')</a>
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="warehouse-items-template">
        @include('admin.releasings.received_items_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script src="{{ url('adminlte/plugins/datetimepicker/moment-with-locales.min.js') }}"></script>
    <script src="{{ url('adminlte/plugins/datetimepicker/bootstrap-datetimepicker.min.js') }}"></script>
    <script>
        $(function(){
            moment.updateLocale('{{ App::getLocale() }}', {
                week: { dow: 1 } // Monday is the first day of the week
            });
            
            $('.datetime').datetimepicker({
                format: "{{ config('app.datetime_format_moment') }}",
                locale: "{{ App::getLocale() }}",
                sideBySide: true,
            });
            
        });
    </script>
            
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