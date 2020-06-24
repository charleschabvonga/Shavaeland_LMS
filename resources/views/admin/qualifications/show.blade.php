@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.qualifications.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.qualifications.fields.file')</th>
                            <td field-key='file's> @foreach($qualification->getMedia('file') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('global.qualifications.fields.institution')</th>
                            <td field-key='institution'>{{ $qualification->institution }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.qualifications.fields.description')</th>
                            <td field-key='description'>{{ $qualification->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.qualifications.fields.date-obtained')</th>
                            <td field-key='date_obtained'>{{ $qualification->date_obtained }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.qualifications.fields.expiry-date')</th>
                            <td field-key='expiry_date'>{{ $qualification->expiry_date }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.qualifications.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
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
            
@stop
