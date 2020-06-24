@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.comments.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.comments.fields.name')</th>
                            <td field-key='name'>{{ $comment->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.comments.fields.email')</th>
                            <td field-key='email'>{{ $comment->email }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.comments.fields.comments')</th>
                            <td field-key='comments'>{!! $comment->comments !!}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.comments.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


