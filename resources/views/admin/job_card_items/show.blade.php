@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.job-card-items.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.job-card-items.fields.workshop')</th>
                            <td field-key='workshop'>{{ $job_card_item->workshop }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-card-items.fields.part')</th>
                            <td field-key='part'>{{ $job_card_item->part }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-card-items.fields.price')</th>
                            <td field-key='price'>{{ $job_card_item->price }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-card-items.fields.qty')</th>
                            <td field-key='qty'>{{ $job_card_item->qty }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-card-items.fields.unit')</th>
                            <td field-key='unit'>{{ $job_card_item->unit }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.job-card-items.fields.total')</th>
                            <td field-key='total'>{{ $job_card_item->total }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.job_card_items.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


