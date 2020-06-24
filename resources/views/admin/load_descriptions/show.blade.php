@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.load-descriptions.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.load-descriptions.fields.description')</th>
                            <td field-key='description'>{{ $load_description->description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.load-descriptions.fields.qty')</th>
                            <td field-key='qty'>{{ $load_description->qty }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.load-descriptions.fields.weight-volume')</th>
                            <td field-key='weight_volume'>{{ $load_description->weight_volume }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.load_descriptions.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


