@extends('layouts.app')

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => ['admin.drug_tests.store'], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_create')
        </div>
        
        <div class="panel-body">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">DRUG TEST</span></h1>
                    </div>
                @endif
            </div>

            <div class="row">
                <div class="col-xs-2 form-group pull-right">
                    {!! Form::label('drug_test_number', trans('global.drug-tests.fields.drug-test-number').'', ['class' => 'control-label']) !!}
                    <td class="text-center"><input type="text" name='drug_test_number' value='{{ $drug_test_number }}' class="form-control" readonly required/></td>
                    @if($errors->has('drug_test_number'))
                        <p class="help-block">
                            {{ $errors->first('drug_test_number') }}
                        </p>
                    @endif
                </div>
            </div>

            <div class="row">
                <div class="col-xs-3 form-group">
                    {!! Form::label('employee_name_id', trans('global.drug-tests.fields.employee-name').'*', ['class' => 'control-label']) !!}
                    {!! Form::select('employee_name_id', $employee_names, old('employee_name_id'), ['class' => 'form-control select2', 'required' => '']) !!}
                    @if($errors->has('employee_name_id'))
                        <p class="help-block">
                            {{ $errors->first('employee_name_id') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('last_annual_drug_test', trans('global.drug-tests.fields.last-annual-drug-test').'', ['class' => 'control-label']) !!}
                    {!! Form::text('last_annual_drug_test', old('last_annual_drug_test'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('last_annual_drug_test'))
                        <p class="help-block">
                            {{ $errors->first('last_annual_drug_test') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('last_random_drug_test', trans('global.drug-tests.fields.last-random-drug-test').'', ['class' => 'control-label']) !!}
                    {!! Form::text('last_random_drug_test', old('last_random_drug_test'), ['class' => 'form-control', 'placeholder' => 'Last random drug test type']) !!}
                    @if($errors->has('last_random_drug_test'))
                        <p class="help-block">
                            {{ $errors->first('last_random_drug_test') }}
                        </p>
                    @endif
                </div>
                <div class="col-xs-3 form-group">
                    {!! Form::label('last_physical_exam_date', trans('global.drug-tests.fields.last-physical-exam-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('last_physical_exam_date', old('last_physical_exam_date'), ['class' => 'form-control date', 'placeholder' => 'YYYY-MM-DD']) !!}
                    @if($errors->has('last_physical_exam_date'))
                        <p class="help-block">
                            {{ $errors->first('last_physical_exam_date') }}
                        </p>
                    @endif
                </div>
            </div>
            
            
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('global.drug-tests.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::textarea('description', old('description'), ['class' => 'form-control ', 'placeholder' => 'Diagnosis description']) !!}
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-3 form-group pull-right">
                    {!! Form::label('file', trans('global.drug-tests.fields.file').'', ['class' => 'control-label']) !!}
                    {!! Form::file('file[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'file',
                        'data-filekey' => 'file',
                        ]) !!}
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list"></div>
                    </div>
                    @if($errors->has('file'))
                        <p class="help-block">
                            {{ $errors->first('file') }}
                        </p>
                    @endif
                </div>
            </div>
            
        </div>
    </div>

    {!! Form::submit(trans('global.app_save'), ['class' => 'btn btn-danger']) !!}
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
                        model_name: 'DrugTest',
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