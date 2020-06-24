@inject('request', 'Illuminate\Http\Request')
@extends('layouts.app')

@section('content')
    @can('drug_test_create')
    <p>
        <a href="{{ route('admin.drug_tests.create') }}" class="btn btn-success">@lang('global.app_add_new')</a>
    </p>
    @endcan

    <p>
        <ul class="list-inline">
            <li><a href="{{ route('admin.drug_tests.index') }}" style="{{ request('show_deleted') == 1 ? '' : 'font-weight: 700' }}">@lang('global.app_all')</a></li> |
            <li><a href="{{ route('admin.drug_tests.index') }}?show_deleted=1" style="{{ request('show_deleted') == 1 ? 'font-weight: 700' : '' }}">@lang('global.app_trash')</a></li>
        </ul>
    </p>
    

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_list')
        </div>

        <div class="panel-body table-responsive">

            <div class="row">
                @if (config('invoices.logo_file') != '')
                    <div class="col-md-12 text-center">
                        <img src="{{ config('invoices.logo_file') }}" /><br>
                        <h1><span style="color:#CE8F64">DRUG TESTS</span></h1>
                    </div>
                @endif
            </div>

            <table class="table table-bordered table-striped {{ count($drug_tests) > 0 ? 'datatable' : '' }} @can('drug_test_delete') @if ( request('show_deleted') != 1 ) dt-select @endif @endcan">
                <thead>
                    <tr>
                        @can('drug_test_delete')
                            @if ( request('show_deleted') != 1 )<th style="text-align:center;"><input type="checkbox" id="select-all" /></th>@endif
                        @endcan

                        <th>@lang('global.drug-tests.fields.drug-test-number')</th>
                        <th>@lang('global.drug-tests.fields.employee-name')</th>
                        <th>@lang('global.drug-tests.fields.last-annual-drug-test')</th>
                        <th>@lang('global.drug-tests.fields.last-random-drug-test')</th>
                        <th>@lang('global.drug-tests.fields.last-physical-exam-date')</th>
                        @if( request('show_deleted') == 1 )
                        <th>&nbsp;</th>
                        @else
                        <th>&nbsp;</th>
                        @endif
                    </tr>
                </thead>
                
                <tbody>
                    @if (count($drug_tests) > 0)
                        @foreach ($drug_tests as $drug_test)
                            <tr data-entry-id="{{ $drug_test->id }}">
                                @can('drug_test_delete')
                                    @if ( request('show_deleted') != 1 )<td></td>@endif
                                @endcan

                                <td field-key='drug_test_number'>{{ $drug_test->drug_test_number }}</td>
                                <td field-key='employee_name'>{{ $drug_test->employee_name->name or '' }}</td>
                                <td field-key='last_annual_drug_test'>{{ $drug_test->last_annual_drug_test }}</td>
                                <td field-key='last_random_drug_test'>{{ $drug_test->last_random_drug_test }}</td>
                                <td field-key='last_physical_exam_date'>{{ $drug_test->last_physical_exam_date }}</td>
                                
                                @if( request('show_deleted') == 1 )
                                <td>
                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'POST',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.drug_tests.restore', $drug_test->id])) !!}
                                    {!! Form::submit(trans('global.app_restore'), array('class' => 'btn btn-xs btn-success')) !!}
                                    {!! Form::close() !!}
                                                                    {!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.drug_tests.perma_del', $drug_test->id])) !!}
                                    {!! Form::submit(trans('global.app_permadel'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                                                </td>
                                @else
                                <td>
                                    @can('drug_test_view')
                                    <a href="{{ route('admin.drug_tests.show',[$drug_test->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan
                                    @can('drug_test_edit')
                                    <a href="{{ route('admin.drug_tests.edit',[$drug_test->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan
                                    @can('drug_test_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.drug_tests.destroy', $drug_test->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                                @endif
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="12">@lang('global.app_no_entries_in_table')</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
@stop

@section('javascript') 
    <script>
        @can('drug_test_delete')
            @if ( request('show_deleted') != 1 ) window.route_mass_crud_entries_destroy = '{{ route('admin.drug_tests.mass_destroy') }}'; @endif
        @endcan

    </script>
@endsection