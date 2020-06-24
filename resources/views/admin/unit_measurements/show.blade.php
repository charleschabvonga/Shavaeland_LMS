@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.unit-measurements.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.unit-measurements.fields.measurement-type')</th>
                            <td field-key='measurement_type'>{{ $unit_measurement->measurement_type }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.unit_measurements.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


