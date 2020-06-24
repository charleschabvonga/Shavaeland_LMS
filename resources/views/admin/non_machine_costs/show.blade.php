@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.non-machine-costs.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.non-machine-costs.fields.item-description')</th>
                            <td field-key='item_description'>{{ $non_machine_cost->item_description }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.non-machine-costs.fields.qty')</th>
                            <td field-key='qty'>{{ $non_machine_cost->qty }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.non-machine-costs.fields.cost')</th>
                            <td field-key='cost'>{{ $non_machine_cost->cost }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.non-machine-costs.fields.total')</th>
                            <td field-key='total'>{{ $non_machine_cost->total }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.non_machine_costs.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


