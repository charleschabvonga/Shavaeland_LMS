@extends('layouts.app')

@section('content')
    
    {!! Form::model($vehicle_sc, ['method' => 'PUT', 'route' => ['admin.vehicle_scs.update', $vehicle_sc->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">TRANSPORTER VEHICLE</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group">
                    {!! Form::label('vendor_id', trans('global.vehicle-sc.fields.vendor').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('vendor_id', $vendors, old('vendor_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('vendor_id'))
                        <p class="help-block">
                            {{ $errors->first('vendor_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('subcontractor_number_id', trans('global.vehicle-sc.fields.subcontractor-number').'', ['class' => 'control-label']) !!}
                    {!! Form::select('subcontractor_number_id', $subcontractor_numbers, old('subcontractor_number_id'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('subcontractor_number_id'))
                        <p class="help-block">
                            {{ $errors->first('subcontractor_number_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('vehicle_type', trans('global.vehicle-sc.fields.vehicle-type').'', ['class' => 'control-label']) !!}
                    {!! Form::select('vehicle_type', $enum_vehicle_type, old('vehicle_type'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('vehicle_type'))
                        <p class="help-block">
                            {{ $errors->first('vehicle_type') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('make', trans('global.vehicle-sc.fields.make').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('make', old('make'), ['class' => 'form-control', 'placeholder' => 'Make', 'required' => '']) !!}
                    @if($errors->has('make'))
                        <p class="help-block">
                            {{ $errors->first('make') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('model', trans('global.vehicle-sc.fields.model').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('model', old('model'), ['class' => 'form-control', 'placeholder' => 'Model', 'required' => '']) !!}
                    @if($errors->has('model'))
                        <p class="help-block">
                            {{ $errors->first('model') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('registration_number', trans('global.vehicle-sc.fields.registration-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('registration_number', old('registration_number'), ['class' => 'form-control', 'placeholder' => 'Registration No.', 'required' => '']) !!}
                    @if($errors->has('registration_number'))
                        <p class="help-block">
                            {{ $errors->first('registration_number') }}
                        </p>
                    @endif
                </div>
            </div>
            
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('certificate_of_registration', trans('global.vehicle-sc.fields.certificate-of-registration').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('certificate_of_registration', old('certificate_of_registration')) !!}
                    @if ($vehicle_sc->certificate_of_registration)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $vehicle_sc->certificate_of_registration) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('certificate_of_registration', ['class' => 'form-control']) !!}
                    {!! Form::hidden('certificate_of_registration_max_size', 2) !!}
                    @if($errors->has('certificate_of_registration'))
                        <p class="help-block">
                            {{ $errors->first('certificate_of_registration') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('certificate_of_fitness_number', trans('global.vehicle-sc.fields.certificate-of-fitness-number').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('certificate_of_fitness_number', old('certificate_of_fitness_number'), ['class' => 'form-control', 'placeholder' => 'Certificate of fitness No.', 'required' => '']) !!}
                    @if($errors->has('certificate_of_fitness_number'))
                        <p class="help-block">
                            {{ $errors->first('certificate_of_fitness_number') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('certificate_of_fitness', trans('global.vehicle-sc.fields.certificate-of-fitness').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('certificate_of_fitness', old('certificate_of_fitness')) !!}
                    @if ($vehicle_sc->certificate_of_fitness)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $vehicle_sc->certificate_of_fitness) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('certificate_of_fitness', ['class' => 'form-control']) !!}
                    {!! Form::hidden('certificate_of_fitness_max_size', 2) !!}
                    @if($errors->has('certificate_of_fitness'))
                        <p class="help-block">
                            {{ $errors->first('certificate_of_fitness') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('expiration_date', trans('global.vehicle-sc.fields.expiration-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('expiration_date', old('expiration_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('expiration_date'))
                        <p class="help-block">
                            {{ $errors->first('expiration_date') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('tracker_pin_details', trans('global.vehicle-sc.fields.tracker-pin-details').'*', ['class' => 'control-label']) !!}
                    {!! Form::text('tracker_pin_details', old('tracker_pin_details'), ['class' => 'form-control', 'placeholder' => 'Tracker pin details', 'required' => '']) !!}
                    @if($errors->has('tracker_pin_details'))
                        <p class="help-block">
                            {{ $errors->first('tracker_pin_details') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('tracker_password', trans('global.vehicle-sc.fields.tracker-password').'', ['class' => 'control-label']) !!}
                    {!! Form::text('tracker_password', old('tracker_password'), ['class' => 'form-control', 'placeholder' => 'Tracker password']) !!}
                    @if($errors->has('tracker_password'))
                        <p class="help-block">
                            {{ $errors->first('tracker_password') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('service_history_reports', trans('global.vehicle-sc.fields.service-history-reports').'', ['class' => 'control-label']) !!}
                    {!! Form::hidden('service_history_reports', old('service_history_reports')) !!}
                    @if ($vehicle_sc->service_history_reports)
                        <a href="{{ asset(env('UPLOAD_PATH').'/' . $vehicle_sc->service_history_reports) }}" target="_blank">Download file</a>
                    @endif
                    {!! Form::file('service_history_reports', ['class' => 'form-control']) !!}
                    {!! Form::hidden('service_history_reports_max_size', 2) !!}
                    @if($errors->has('service_history_reports'))
                        <p class="help-block">
                            {{ $errors->first('service_history_reports') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-2 form-group">
                    {!! Form::label('status', trans('global.vehicle-sc.fields.status').'', ['class' => 'control-label']) !!}
                    {!! Form::select('status', $enum_status, old('status'), ['class' => 'form-control select2']) !!}
                    @if($errors->has('status'))
                        <p class="help-block">
                            {{ $errors->first('status') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_update'), ['class' => 'btn btn-danger']) !!}
    {!! Form::close() !!}
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
                        model_name: 'VehicleSc',
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