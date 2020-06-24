@extends('layouts.app')

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.vendors.store']]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">VENDOR</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('name', trans('global.vendors.fields.name').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('name', old('name'), ['class' => 'form-control', 'placeholder' => 'Vendor', 'required' => '']) !!}
                    @if($errors->has('name'))
                        <p class="help-block">
                            {{ $errors->first('name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('vendor_type', trans('global.vendors.fields.vendor-type').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('vendor_type', $enum_vendor_type, old('vendor_type'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('vendor_type'))
                        <p class="help-block">
                            {{ $errors->first('vendor_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('vat', trans('global.vendors.fields.vat').'', ['class' => 'control-label']) !!}
                    {!! Form::text('vat', old('vat'), ['class' => 'form-control', 'placeholder' => 'Vat No.']) !!}
                    @if($errors->has('vat'))
                        <p class="help-block">
                            {{ $errors->first('vat') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-4 form-group">
                    {!! Form::label('street_address', trans('global.vendors.fields.street-address').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('street_address', old('street_address'), ['class' => 'form-control', 'placeholder' => 'Street address', 'required' => '']) !!}
                    @if($errors->has('street_address'))
                        <p class="help-block">
                            {{ $errors->first('street_address') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('city', trans('global.vendors.fields.city').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('city', old('city'), ['class' => 'form-control', 'placeholder' => 'City', 'required' => '']) !!}
                    @if($errors->has('city'))
                        <p class="help-block">
                            {{ $errors->first('city') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('province', trans('global.vendors.fields.province').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('province', old('province'), ['class' => 'form-control', 'placeholder' => 'Province/State', 'required' => '']) !!}
                    @if($errors->has('province'))
                        <p class="help-block">
                            {{ $errors->first('province') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('postal_code', trans('global.vendors.fields.postal-code').'', ['class' => 'control-label']) !!}
                    {!! Form::text('postal_code', old('postal_code'), ['class' => 'form-control', 'placeholder' => 'Postal code']) !!}
                    @if($errors->has('postal_code'))
                        <p class="help-block">
                            {{ $errors->first('postal_code') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('country', trans('global.vendors.fields.country').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('country', old('country'), ['class' => 'form-control', 'placeholder' => 'Country', 'required' => '']) !!}
                    @if($errors->has('country'))
                        <p class="help-block">
                            {{ $errors->first('country') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('website', trans('global.vendors.fields.website').'', ['class' => 'control-label']) !!}
                    {!! Form::text('website', old('website'), ['class' => 'form-control', 'placeholder' => 'Website']) !!}
                    @if($errors->has('website'))
                        <p class="help-block">
                            {{ $errors->first('website') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('email', trans('global.vendors.fields.email').'', ['class' => 'control-label']) !!}
                    {!! Form::email('email', old('email'), ['class' => 'form-control', 'placeholder' => 'Email']) !!}
                    @if($errors->has('email'))
                        <p class="help-block">
                            {{ $errors->first('email') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('phone_number_1', trans('global.vendors.fields.phone-number-1').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('phone_number_1', old('phone_number_1'), ['class' => 'form-control', 'placeholder' => 'Tel 1', 'required' => '']) !!}
                    @if($errors->has('phone_number_1'))
                        <p class="help-block">
                            {{ $errors->first('phone_number_1') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('phone_number_2', trans('global.vendors.fields.phone-number-2').'', ['class' => 'control-label']) !!}
                    {!! Form::text('phone_number_2', old('phone_number_2'), ['class' => 'form-control', 'placeholder' => 'Tel 2']) !!}
                    @if($errors->has('phone_number_2'))
                        <p class="help-block">
                            {{ $errors->first('phone_number_2') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('fax_number', trans('global.vendors.fields.fax-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('fax_number', old('fax_number'), ['class' => 'form-control', 'placeholder' => 'Fax']) !!}
                    @if($errors->has('fax_number'))
                        <p class="help-block">
                            {{ $errors->first('fax_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('directors_name', trans('global.vendors.fields.directors-name').'', ['class' => 'control-label']) !!}
                    {!! Form::text('directors_name', old('directors_name'), ['class' => 'form-control', 'placeholder' => 'Directors name']) !!}
                    @if($errors->has('directors_name'))
                        <p class="help-block">
                            {{ $errors->first('directors_name') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('director_id_number', trans('global.vendors.fields.director-id-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('director_id_number', old('director_id_number'), ['class' => 'form-control', 'placeholder' => 'Director id No.']) !!}
                    @if($errors->has('director_id_number'))
                        <p class="help-block">
                            {{ $errors->first('director_id_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('directors_proof_of_residence', trans('global.vendors.fields.directors-proof-of-residence').'', ['class' => 'control-label']) !!}
                    {!! Form::file('directors_proof_of_residence[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'directors_proof_of_residence',
                        'data-filekey' => 'directors_proof_of_residence',
                        ]) !!}
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('directors_proof_of_residence'))
                        <p class="help-block">
                            {{ $errors->first('directors_proof_of_residence') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('tax_clearance_number', trans('global.vendors.fields.tax-clearance-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('tax_clearance_number', old('tax_clearance_number'), ['class' => 'form-control', 'placeholder' => 'Tax clearance No.']) !!}
                    @if($errors->has('tax_clearance_number'))
                        <p class="help-block">
                            {{ $errors->first('tax_clearance_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('tax_clearance', trans('global.vendors.fields.tax-clearance').'', ['class' => 'control-label']) !!}
                    {!! Form::file('tax_clearance[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'tax_clearance',
                        'data-filekey' => 'tax_clearance',
                        ]) !!}
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('tax_clearance'))
                        <p class="help-block">
                            {{ $errors->first('tax_clearance') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('tax_clearance_expiration_date', trans('global.vendors.fields.tax-clearance-expiration-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('tax_clearance_expiration_date', old('tax_clearance_expiration_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('tax_clearance_expiration_date'))
                        <p class="help-block">
                            {{ $errors->first('tax_clearance_expiration_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('company_registration_number', trans('global.vendors.fields.company-registration-number').'', ['class' => 'control-label']) !!}
                    {!! Form::text('company_registration_number', old('company_registration_number'), ['class' => 'form-control', 'placeholder' => 'Company registration No.']) !!}
                    @if($errors->has('company_registration_number'))
                        <p class="help-block">
                            {{ $errors->first('company_registration_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('company_registration', trans('global.vendors.fields.company-registration').'', ['class' => 'control-label']) !!}
                    {!! Form::file('company_registration[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'company_registration',
                        'data-filekey' => 'company_registration',
                        ]) !!}
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('company_registration'))
                        <p class="help-block">
                            {{ $errors->first('company_registration') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('company_proof_of_residents', trans('global.vendors.fields.company-proof-of-residents').'', ['class' => 'control-label']) !!}
                    {!! Form::file('company_proof_of_residents[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'company_proof_of_residents',
                        'data-filekey' => 'company_proof_of_residents',
                        ]) !!}
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('company_proof_of_residents'))
                        <p class="help-block">
                            {{ $errors->first('company_proof_of_residents') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">VENDOR CONTACTS</span></legend>
                        <thead>
                        <tr>
                            <th>@lang('global.vendor-contacts.fields.contact-name')</th>
                            <th>@lang('global.vendor-contacts.fields.phone-number')</th>
                            <th>@lang('global.vendor-contacts.fields.email')</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="vendor-contacts">
                            @foreach(old('vendor_contacts', []) as $index => $data)
                                @include('admin.vendors.vendor_contacts_row', [
                                    'index' => $index
                                ])
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary pull-right add-new">@lang('global.app_add_new')</a>
                </div>
            </div>

            <div class="panel panel-default">
                <div class="panel-body">
                    <table class="table table-bordered table-striped" id="tab_logic">
                        <legend class="text-center"><span style="color:#CE8F64">VENDOR REQUIREMENTS</span></legend>
                        <thead>
                        <tr>
                            <th>@lang('global.road-freight-sub-contractors.fields.subcontractor-number')</th>
                                <th>@lang('global.road-freight-sub-contractors.fields.git-cover-number')</th>
                                
                            <th>Actions</th>
                        </tr>
                        </thead>
                        <tbody id="transporter-requirements">
                            @foreach(old('road_freight_sub_contractors', []) as $index => $data)
                                @include('admin.vendors.road_freight_sub_contractors_row', [
                                    'index' => $index
                                ])
                            @endforeach
                        </tbody>
                    </table>
                    <a href="#" class="btn btn-primary pull-right add-new">@lang('global.app_add_new')</a>
                </div>
            </div>
            
        </div>
    </div>       

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
@stop

@section('javascript')
    @parent

    <script type="text/html" id="vendor-contacts-template">
        @include('admin.vendors.vendor_contacts_row',
                [
                    'index' => '_INDEX_',
                ])
               </script > 

    <script type="text/html" id="transporter-requirements-template">
        @include('admin.vendors.road_freight_sub_contractors_row',
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
            
            $('.date').datetimepicker({
                format: "{{ config('app.date_format_moment') }}",
                locale: "{{ App::getLocale() }}",
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
    <script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.iframe-transport.js') }}"></script>
    <script src="{{ asset('adminlte/plugins/fileUpload/js/jquery.fileupload.js') }}"></script>
    <script>
        $(function () {
            $('.file-upload').each(function () {
                var $this = $(this);
                var $parent = $(this).parent();

                $(this).fileupload({
                    dataType: 'json',
                    formData: {
                        model_name: 'Vendor',
                        bucket: $this.data('bucket'),
                        file_key: $this.data('filekey'),
                        _token: '{{ csrf_token() }}'
                    },
                    add: function (e, data) {
                        data.submit();
                    },
                    done: function (e, data) {
                        $.each(data.result.files, function (index, file) {
                            var $line = $($('<p/>', {class: "form-group"}).html(file.name + ' (' + file.size + ' bytes)').appendTo($parent.find('.files-list')));
                            $line.append('<a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>');
                            $line.append('<input type="hidden" name="' + $this.data('bucket') + '_id[]" value="' + file.id + '"/>');
                            if ($parent.find('.' + $this.data('bucket') + '-ids').val() != '') {
                                $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + ',');
                            }
                            $parent.find('.' + $this.data('bucket') + '-ids').val($parent.find('.' + $this.data('bucket') + '-ids').val() + file.id);
                        });
                        $parent.find('.progress-bar').hide().css(
                            'width',
                            '0%'
                        );
                    }
                }).on('fileuploadprogressall', function (e, data) {
                    var progress = parseInt(data.loaded / data.total * 100, 10);
                    $parent.find('.progress-bar').show().css(
                        'width',
                        progress + '%'
                    );
                });
            });
            $(document).on('click', '.remove-file', function () {
                var $parent = $(this).parent();
                $parent.remove();
                return false;
            });
        });
    </script>
@stop