@extends('layouts.app')

@section('content')
    
    {!! Form::model($time_project, ['method' => 'PUT', 'route' => ['admin.time_projects.update', $time_project->id]]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">CLIENT</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('name', trans('global.time-projects.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Client', 'required' => '']) !!}
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('client_type', trans('global.time-projects.fields.client-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('client_type', $enum_client_type, old('client_type'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('client_type'))
                        <p class="help-block">
                            {{ $errors->first('client_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('vat_number', trans('global.time-projects.fields.vat-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('vat_number', old('vat_number'), ['class' => 'form-control', 'placeholder' => 'Vat No.']) !!}
                    @if($errors->has('vat_number'))
                        <p class="help-block">
                            {{ $errors->first('vat_number') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('street_address', trans('global.time-projects.fields.street-address').'', ['class' => 'control-label']) !!}
                    {!! Form::text('street_address', old('street_address'), ['class' => 'form-control', 'placeholder' => 'Street address']) !!}
                    @if($errors->has('street_address'))
                        <p class="help-block">
                            {{ $errors->first('street_address') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('city', trans('global.time-projects.fields.city').'', ['class' => 'control-label']) !!}
                    {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder' => 'City']) !!}
                    @if($errors->has('city'))
                        <p class="help-block">
                            {{ $errors->first('city') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('province', trans('global.time-projects.fields.province').'', ['class' => 'control-label']) !!}
                    {!! Form::text('province', old('province'), ['class' => 'form-control', 'placeholder' => 'Province']) !!}
                    @if($errors->has('province'))
                        <p class="help-block">
                            {{ $errors->first('province') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('postal_code', trans('global.time-projects.fields.postal-code').'', ['class' => 'control-label']) !!}
                    {!! Form::text('postal_code', old('postal_code'), ['class' => 'form-control', 'placeholder' => 'Postal code']) !!}
                    @if($errors->has('postal_code'))
                        <p class="help-block">
                            {{ $errors->first('postal_code') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('country', trans('global.time-projects.fields.country').'', ['class' => 'control-label']) !!}
                    {!! Form::text('country', old('country'), ['class' => 'form-control', 'placeholder' => 'Country']) !!}
                    @if($errors->has('country'))
                        <p class="help-block">
                            {{ $errors->first('country') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('website', trans('global.time-projects.fields.website').'', ['class' => 'control-label']) !!}
                    {!! Form::text('website', old('website'), ['class' => 'form-control', 'placeholder' => 'Website']) !!}
                    @if($errors->has('website'))
                        <p class="help-block">
                            {{ $errors->first('website') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('email', trans('global.time-projects.fields.email').'', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('phone_number_1', trans('global.time-projects.fields.phone-number-1').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone_number_1', old('phone_number_1'), ['class' => 'form-control', 'placeholder' => 'Phone No. 1']) !!}
                    @if($errors->has('phone_number_1'))
                        <p class="help-block">
                            {{ $errors->first('phone_number_1') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('phone_number_2', trans('global.time-projects.fields.phone-number-2').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone_number_2', old('phone_number_2'), ['class' => 'form-control', 'placeholder' => 'Phone No. 2']) !!}
                    @if($errors->has('phone_number_2'))
                        <p class="help-block">
                            {{ $errors->first('phone_number_2') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('fax_number', trans('global.time-projects.fields.fax-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('fax_number', old('fax_number'), ['class' => 'form-control', 'placeholder' => 'Fax No.']) !!}
                    @if($errors->has('fax_number'))
                        <p class="help-block">
                            {{ $errors->first('fax_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">CLIENT CONTACTS</span></legend>
                        <thead>
                        <tr>
                            <th>@lang('global.client-contacts.fields.contact-name')</th>
                            <th>@lang('global.client-contacts.fields.phone-number')</th>
                            <th>@lang('global.client-contacts.fields.email')</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="client-contacts">
                            @forelse(old('client_contacts', []) as $index => $data)
                                @include('admin.time_projects.client_contacts_row', [
                                    'index' => $index
                                ])
                            @empty
                                @foreach($time_project->client_contacts as $item)
                                    @include('admin.time_projects.client_contacts_row', [
                                        'index' => 'id-' . $item->id,
                                        'field' => $item
                                    ])
                                @endforeach
                            @endforelse
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary pull-right add-new">@lang('global.app_add_new')</a>
                </div>
            </div>
            
        </div>
    </div>
    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="client-contacts-template">
        @include('admin.time_projects.client_contacts_row',
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