@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.identifications.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.identifications.fields.id-type')</th>
                            <td field-key='id_type'>{{ $identification->id_type }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.identifications.fields.id-number')</th>
                            <td field-key='id_number'>{{ $identification->id_number }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.identifications.fields.date-of-birth')</th>
                            <td field-key='date_of_birth'>{{ $identification->date_of_birth }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.identifications.fields.identification')</th>
                            <td field-key='identification's> @foreach($identification->getMedia('identification') as $media)
                                <p class="form-group">
                                    <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} ({{ $media->size }} KB)</a>
                                </p>
                            @endforeach</td>
                        </tr>
                        <tr>
                            <th>@lang('global.identifications.fields.date-obtained')</th>
                            <td field-key='date_obtained'>{{ $identification->date_obtained }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.identifications.fields.expiry-date')</th>
                            <td field-key='expiry_date'>{{ $identification->expiry_date }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.identifications.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
