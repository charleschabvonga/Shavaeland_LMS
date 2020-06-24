@extends('layouts.app')

@section('content')
    <h3 class="page-title">@lang('global.emergency-contacts.title')</h3>

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body table-responsive">
            <div class="row">
                <div class="col-md-6">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th>@lang('global.emergency-contacts.fields.name')</th>
                            <td field-key='name'>{{ $emergency_contact->name }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.emergency-contacts.fields.phone1')</th>
                            <td field-key='phone1'>{{ $emergency_contact->phone1 }}</td>
                        </tr>
                        <tr>
                            <th>@lang('global.emergency-contacts.fields.phone')</th>
                            <td field-key='phone'>{{ $emergency_contact->phone }}</td>
                        </tr>
                    </table>
                </div>
            </div>

            <p>&nbsp;</p>

            <a href="{{ route('admin.emergency_contacts.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
        </div>
    </div>
@stop


