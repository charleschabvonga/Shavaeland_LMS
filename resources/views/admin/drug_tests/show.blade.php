@extends('layouts.app')

@section('content')

    <div class="panel panel-default">
        <div class="panel-heading">
            @lang('global.app_view')
        </div>

        <div class="panel-body">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br>
                                <h1><span style="color:#CE8F64">DRUG TEST</span></h1>
                                <h4><b>Drug Test No</b>: <span style="color:red">{{ $drug_test->drug_test_number }}</span></h4>
                            </div>
                        @endif
                    </div>

                    <div class="row">
                        <div class="col-xs-4 "></div>
                        
                        <div class="col-xs-4 form-group text-center">
                            @if ($drug_test->employee_name != '')
                                <b>Employee</b>: {{ $drug_test->employee_name->name or '' }}<br>
                            @endif
                            @if ($drug_test->last_annual_drug_test != '')
                                <b>Last annual drug test</b>: {{ $drug_test->last_annual_drug_test }}<br>
                            @endif
                            @if ($drug_test->last_random_drug_test != '')
                                <b>Last random drug test</b>: {{ $drug_test->last_random_drug_test }}<br>
                            @endif
                            @if ($drug_test->last_physical_exam_date != '')
                                <b>Last physical exam date</b>: {{ $drug_test->last_physical_exam_date }}<br>
                            @endif
                            @if ($drug_test->description != '')
                                <b>Description</b>: {{ $drug_test->description }}<br>
                            @endif 
                            @if ($drug_test->getMedia('file') != '')
                                @foreach($drug_test->getMedia('file') as $media)
                                    <b>File</b>: <a href="{{ $media->getUrl() }}" target="_blank">{{ $media->name }} </a>
                                @endforeach<br>
                            @endif
                        </div>

                        <div class="col-xs-4 form-group text-right"></div>
                    </div>

                </div>
            </div><!-- Nav tabs -->

            <p>&nbsp;</p>

            <a href="{{ route('admin.drug_tests.index') }}" class="btn btn-default">@lang('global.app_back_to_list')</a>
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
