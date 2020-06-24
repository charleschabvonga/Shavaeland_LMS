@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.received-items.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.received-items.fields.item')</th>
                            <td field-key='item'>{{ $received_item->item }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.received-items.fields.qty')</th>
                            <td field-key='qty'>{{ $received_item->qty }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.received-items.fields.area')</th>
                            <td field-key='area'>{{ $received_item->area }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.received-items.fields.unit')</th>
                            <td field-key='unit'>{{ $received_item->unit }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.received_items.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


