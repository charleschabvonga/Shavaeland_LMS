@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.loading-requirements.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.loading-requirements.fields.item-description')</th>
                            <td field-key='item_description'>{{ $loading_requirement->item_description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.loading-requirements.fields.qty')</th>
                            <td field-key='qty'>{{ $loading_requirement->qty }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.loading_requirements.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


