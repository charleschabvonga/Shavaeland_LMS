@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.qualifications.title')</h3>
    
    {!! Form::model($qualification, ['method' => 'PUT', 'route' => ['admin.qualifications.update', $qualification->id], 'files' => true,]) !!}

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_edit')
        </div>

        <div class="panel-body">
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('employee_name_id', trans('global.qualifications.fields.employee-name').'', ['class' => 'control-label']) !!}
                    {!! Form::select('employee_name_id', $employee_names, old('employee_name_id'), ['class' => 'form-control select2']) !!}
                    <p class="help-block">Select the employee name</p>
                    @if($errors->has('employee_name_id'))
                        <p class="help-block">
                            {{ $errors->first('employee_name_id') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('file', trans('global.qualifications.fields.file').'', ['class' => 'control-label']) !!}
                    {!! Form::file('file[]', [
                        'multiple',
                        'class' => 'form-control file-upload',
                        'data-url' => route('admin.media.upload'),
                        'data-bucket' => 'file',
                        'data-filekey' => 'file',
                        ]) !!}
                    <p class="help-block">Upload employee qualification file(s)</p>
                    <div class="photo-block">
                        <div class="progress-bar form-group">&nbsp;</div>
                        <div class="files-list">
                            @foreach($qualification->getMedia('file') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                    <a href="#" class="btn btn-xs btn-danger remove-file">Remove</a>
                                    <input type="hidden" name="file_id[]" value="{{ $media->id }}">
                                </p>
                            @endforeach
                        </div>
                    </div>
                    @if($errors->has('file'))
                        <p class="help-block">
                            {{ $errors->first('file') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('institution', trans('global.qualifications.fields.institution').'', ['class' => 'control-label']) !!}
                    {!! Form::text('institution', old('institution'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('institution'))
                        <p class="help-block">
                            {{ $errors->first('institution') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('description', trans('global.qualifications.fields.description').'', ['class' => 'control-label']) !!}
                    {!! Form::text('description', old('description'), ['class' => 'form-control', 'placeholder' => '']) !!}
                    <p class="help-block"></p>
                    @if($errors->has('description'))
                        <p class="help-block">
                            {{ $errors->first('description') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('date_obtained', trans('global.qualifications.fields.date-obtained').'', ['class' => 'control-label']) !!}
                    {!! Form::text('date_obtained', old('date_obtained'), ['class' => 'form-control date', 'placeholder' => 'Select the date']) !!}
                    <p class="help-block">Select the date</p>
                    @if($errors->has('date_obtained'))
                        <p class="help-block">
                            {{ $errors->first('date_obtained') }}
                        </p>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12 form-group">
                    {!! Form::label('expiry_date', trans('global.qualifications.fields.expiry-date').'', ['class' => 'control-label']) !!}
                    {!! Form::text('expiry_date', old('expiry_date'), ['class' => 'form-control date', 'placeholder' => 'Select the date']) !!}
                    <p class="help-block">Select the date</p>
                    @if($errors->has('expiry_date'))
                        <p class="help-block">
                            {{ $errors->first('expiry_date') }}
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
                        model_name: 'Qualification',
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