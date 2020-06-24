@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">@lang('global.app_dashboard')</div>

                <div class="panel-body">
                    <div class="row">
                        @if (config('invoices.logo_file') != '')
                            <div class="col-md-12 text-center">
                                <img src="{{ config('invoices.logo_file') }}" /><br>
                                <h1><span style="color:#CE8F64">DASHBOARD</span></h1>
                                <h4>@lang('global.app_dashboard_text') <span style="color:#CE8F64">{{ Auth::user()->name }}</span>.</h4>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            <div class="row">
         <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added quotations</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.quotation.fields.quotation-number')</th> 
                            <th> @lang('global.quotation.fields.date')</th> 
                            <th> @lang('global.quotation.fields.due-date')</th> 
                            <th> @lang('global.quotation.fields.status')</th> 
                            <th> @lang('global.quotation.fields.subtotal')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($quotations as $quotation)
                            <tr>
                               
                                <td>{{ $quotation->quotation_number }} </td> 
                                <td>{{ $quotation->date }} </td> 
                                <td>{{ $quotation->due_date }} </td> 
                                <td>{{ $quotation->status }} </td> 
                                <td>{{ $quotation->subtotal }} </td> 
                                <td>

                                    @can('quotation_view')
                                    <a href="{{ route('admin.quotations.show',[$quotation->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('quotation_edit')
                                    <a href="{{ route('admin.quotations.edit',[$quotation->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('quotation_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.quotations.destroy', $quotation->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added purchaseorders</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.purchase-orders.fields.purchase-order-number')</th> 
                            <th> @lang('global.purchase-orders.fields.date')</th> 
                            <th> @lang('global.purchase-orders.fields.request-date')</th> 
                            <th> @lang('global.purchase-orders.fields.procurement-date')</th> 
                            <th> @lang('global.purchase-orders.fields.subtotal')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($purchaseorders as $purchaseorder)
                            <tr>
                               
                                <td>{{ $purchaseorder->purchase_order_number }} </td> 
                                <td>{{ $purchaseorder->date }} </td> 
                                <td>{{ $purchaseorder->request_date }} </td> 
                                <td>{{ $purchaseorder->procurement_date }} </td> 
                                <td>{{ $purchaseorder->subtotal }} </td> 
                                <td>

                                    @can('purchase_order_view')
                                    <a href="{{ route('admin.purchase_orders.show',[$purchaseorder->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('purchase_order_edit')
                                    <a href="{{ route('admin.purchase_orders.edit',[$purchaseorder->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('purchase_order_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.purchase_orders.destroy', $purchaseorder->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added roadfreights</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.road-freights.fields.road-freight-number')</th> 
                            <th> @lang('global.road-freights.fields.freight-contract-type')</th> 
                            <th> @lang('global.road-freights.fields.road-freight-income')</th> 
                            <th> @lang('global.road-freights.fields.road-freight-expenses')</th> 
                            <th> @lang('global.road-freights.fields.machinery-costs')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($roadfreights as $roadfreight)
                            <tr>
                               
                                <td>{{ $roadfreight->road_freight_number }} </td> 
                                <td>{{ $roadfreight->freight_contract_type }} </td> 
                                <td>{{ $roadfreight->road_freight_income }} </td> 
                                <td>{{ $roadfreight->road_freight_expenses }} </td> 
                                <td>{{ $roadfreight->machinery_costs }} </td> 
                                <td>

                                    @can('road_freight_view')
                                    <a href="{{ route('admin.road_freights.show',[$roadfreight->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('road_freight_edit')
                                    <a href="{{ route('admin.road_freights.edit',[$roadfreight->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('road_freight_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.road_freights.destroy', $roadfreight->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added timeentries</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.time-entries.fields.operation-number')</th> 
                            <th> @lang('global.time-entries.fields.entry-date')</th> 
                            <th> @lang('global.time-entries.fields.start-time')</th> 
                            <th> @lang('global.time-entries.fields.end-time')</th> 
                            <th> @lang('global.time-entries.fields.status')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($timeentries as $timeentry)
                            <tr>
                               
                                <td>{{ $timeentry->operation_number }} </td> 
                                <td>{{ $timeentry->entry_date }} </td> 
                                <td>{{ $timeentry->start_time }} </td> 
                                <td>{{ $timeentry->end_time }} </td> 
                                <td>{{ $timeentry->status }} </td> 
                                <td>

                                    @can('time_entry_view')
                                    <a href="{{ route('admin.time_entries.show',[$timeentry->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('time_entry_edit')
                                    <a href="{{ route('admin.time_entries.edit',[$timeentry->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('time_entry_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.time_entries.destroy', $timeentry->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>

 <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Recently added inhousejobcards</div>

                <div class="panel-body table-responsive">
                    <table class="table table-bordered table-striped ajaxTable">
                        <thead>
                        <tr>
                            
                            <th> @lang('global.inhouse-job-cards.fields.date')</th> 
                            <th> @lang('global.inhouse-job-cards.fields.vehicle-type')</th> 
                            <th> @lang('global.inhouse-job-cards.fields.mileage')</th> 
                            <th> @lang('global.inhouse-job-cards.fields.job-card-number')</th> 
                            <th> @lang('global.inhouse-job-cards.fields.prepared-by')</th> 
                            <th>&nbsp;</th>
                        </tr>
                        </thead>
                        @foreach($inhousejobcards as $inhousejobcard)
                            <tr>
                               
                                <td>{{ $inhousejobcard->date }} </td> 
                                <td>{{ $inhousejobcard->vehicle_type }} </td> 
                                <td>{{ $inhousejobcard->mileage }} </td> 
                                <td>{{ $inhousejobcard->job_card_number }} </td> 
                                <td>{{ $inhousejobcard->prepared_by }} </td> 
                                <td>

                                    @can('inhouse_job_card_view')
                                    <a href="{{ route('admin.inhouse_job_cards.show',[$inhousejobcard->id]) }}" class="btn btn-xs btn-primary">@lang('global.app_view')</a>
                                    @endcan

                                    @can('inhouse_job_card_edit')
                                    <a href="{{ route('admin.inhouse_job_cards.edit',[$inhousejobcard->id]) }}" class="btn btn-xs btn-info">@lang('global.app_edit')</a>
                                    @endcan

                                    @can('inhouse_job_card_delete')
{!! Form::open(array(
                                        'style' => 'display: inline-block;',
                                        'method' => 'DELETE',
                                        'onsubmit' => "return confirm('".trans("global.app_are_you_sure")."');",
                                        'route' => ['admin.inhouse_job_cards.destroy', $inhousejobcard->id])) !!}
                                    {!! Form::submit(trans('global.app_delete'), array('class' => 'btn btn-xs btn-danger')) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                
</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
 </div>


    </div>
        </div>
    </div>

    
@endsection

