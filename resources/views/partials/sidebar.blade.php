@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/admin/home') }}">
                    <i class="fa fa-dashboard"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>

            @php ($unread = App\MessengerTopic::countUnread())
            <li class="{{ $request->segment(2) == 'messenger' ? 'active' : '' }} {{ ($unread > 0 ? 'unread' : '') }}">
                <a href="{{ route('admin.messenger.index') }}">
                    <i class="fa fa-envelope"></i>

                    <span>Messages</span>
                    @if($unread > 0)
                        {{ ($unread > 0 ? '('.$unread.')' : '') }}
                    @endif
                </a>
            </li>
            <style>
                .page-sidebar-menu .unread * {
                    font-weight:bold !important;
                }
            </style>

            @can('internal_notification_access')
            <li>
                <a href="{{ route('admin.internal_notifications.index') }}">
                    <i class="fa fa-briefcase"></i>
                    <span>@lang('global.internal-notifications.title')</span>
                </a>
            </li>@endcan

            @can('comment_access')
            <li>
                <a href="{{ route('admin.comments.index') }}">
                    <i class="fa fa-comments"></i>
                    <span>@lang('global.comments.title')</span>
                </a>
            </li>@endcan
            
            @can('human_reource_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-group"></i>
                    <span>@lang('global.human-reources.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('department_access')
                    <li>
                        <a href="{{ route('admin.departments.index') }}">
                            <i class="fa fa-sitemap"></i>
                            <span>@lang('global.departments.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('employee_access')
                    <li>
                        <a href="{{ route('admin.employees.index') }}">
                            <i class="fa fa-group"></i>
                            <span>@lang('global.employees.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('payee_account_access')
                    <li>
                        <a href="{{ route('admin.payee_accounts.index') }}">
                            <i class="fa fa-calculator"></i>
                            <span>@lang('global.payee-accounts.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('salaries_request_total_access')
                    <li>
                        <a href="{{ route('admin.salaries_request_totals.index') }}">
                            <i class="fa fa-money"></i>
                            <span>@lang('global.salaries-request-totals.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('payslip_access')
                    <li>
                        <a href="{{ route('admin.payslips.index') }}">
                            <i class="fa fa-money"></i>
                            <span>@lang('global.payslips.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('payee_payment_access')
                    <li>
                        <a href="{{ route('admin.payee_payments.index') }}">
                            <i class="fa fa-arrow-circle-left"></i>
                            <span>@lang('global.payee-payments.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('drug_test_access')
                    <li>
                        <a href="{{ route('admin.drug_tests.index') }}">
                            <i class="fa fa-calendar-plus-o"></i>
                            <span>@lang('global.drug-tests.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('violation_access')
                    <li>
                        <a href="{{ route('admin.violations.index') }}">
                            <i class="fa fa-cab"></i>
                            <span>@lang('global.violations.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('asset_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tags"></i>
                    <span>@lang('global.assets.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('vehicle_access')
                    <li>
                        <a href="{{ route('admin.vehicles.index') }}">
                            <i class="fa fa-truck"></i>
                            <span>@lang('global.vehicles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('trailer_access')
                    <li>
                        <a href="{{ route('admin.trailers.index') }}">
                            <i class="fa fa-truck"></i>
                            <span>@lang('global.trailers.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('light_vehicle_access')
                    <li>
                        <a href="{{ route('admin.light_vehicles.index') }}">
                            <i class="fa fa-truck"></i>
                            <span>@lang('global.light-vehicles.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('sale_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-tag"></i>
                    <span>@lang('global.sales.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('time_project_access')
                    <li>
                        <a href="{{ route('admin.time_projects.index') }}">
                            <i class="fa fa-user-plus"></i>
                            <span>@lang('global.time-projects.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('quotation_access')
                    <li>
                        <a href="{{ route('admin.quotations.index') }}">
                            <i class="fa fa-list"></i>
                            <span>@lang('global.quotation.title')</span>
                        </a>
                    </li>@endcan
                    
                    <!--@can('income_expense_calculator_access')
                    <li>
                        <a href="{{ route('admin.income_expense_calculators.index') }}">
                            <i class="fa fa-calculator"></i>
                            <span>@lang('global.income-expense-calculator.title')</span>
                        </a>
                    </li>@endcan-->
                    
                </ul>
            </li>@endcan
            
            @can('procurement_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-buysellads"></i>
                    <span>@lang('global.procurements.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('vendor_access')
                    <li>
                        <a href="{{ route('admin.vendors.index') }}">
                            <i class="fa fa-user-plus"></i>
                            <span>@lang('global.vendors.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('purchase_order_access')
                    <li>
                        <a href="{{ route('admin.purchase_orders.index') }}">
                            <i class="fa fa-buysellads"></i>
                            <span>@lang('global.purchase-orders.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('road_freight_transporter_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-road"></i>
                            <span>@lang('global.road-freight-transporters.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('road_freight_sub_contractor_access')
                            <li>
                                <a href="{{ route('admin.road_freight_sub_contractors.index') }}">
                                    <i class="fa fa-user-plus"></i>
                                    <span>@lang('global.road-freight-sub-contractors.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('vehicle_sc_access')
                            <li>
                                <a href="{{ route('admin.vehicle_scs.index') }}">
                                    <i class="fa fa-truck"></i>
                                    <span>@lang('global.vehicle-sc.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('driver_access')
                            <li>
                                <a href="{{ route('admin.drivers.index') }}">
                                    <i class="fa fa-group"></i>
                                    <span>@lang('global.drivers.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('operation_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-exchange"></i>
                    <span>@lang('global.operations.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('time_entry_access')
                    <li>
                        <a href="{{ route('admin.time_entries.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.time-entries.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('road_freight_sc_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-road"></i>
                            <span>@lang('global.road-freight-sc.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('road_freight_access')
                            <li>
                                <a href="{{ route('admin.road_freights.index') }}">
                                    <i class="fa fa-road"></i>
                                    <span>@lang('global.road-freights.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('machinery_cost_access')
                            <li>
                                <a href="{{ route('admin.machinery_costs.index') }}">
                                    <i class="fa fa-truck"></i>
                                    <span>@lang('global.machinery-costs.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('fuel_cost_access')
                            <li>
                                <a href="{{ route('admin.fuel_costs.index') }}">
                                    <i class="fa fa-battery-full"></i>
                                    <span>@lang('global.fuel-costs.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('loading_instruction_access')
                            <li>
                                <a href="{{ route('admin.loading_instructions.index') }}">
                                    <i class="fa fa-sign-in"></i>
                                    <span>@lang('global.loading-instruction.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('delivery_instruction_access')
                            <li>
                                <a href="{{ route('admin.delivery_instructions.index') }}">
                                    <i class="fa fa-sign-out"></i>
                                    <span>@lang('global.delivery-instruction.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </li>@endcan
                    
                    @can('customer_workshop_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-wrench"></i>
                            <span>@lang('global.customer-workshop.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <!--@can('client_vehicle_access')
                            <li>
                                <a href="{{ route('admin.client_vehicles.index') }}">
                                    <i class="fa fa-truck"></i>
                                    <span>@lang('global.client-vehicle.title')</span>
                                </a>
                            </li>@endcan-->
                            
                            @can('job_request_access')
                            <li>
                                <a href="{{ route('admin.job_requests.index') }}">
                                    <i class="fa fa-won"></i>
                                    <span>@lang('global.job-requests.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('client_job_card_access')
                            <li>
                                <a href="{{ route('admin.client_job_cards.index') }}">
                                    <i class="fa fa-align-justify"></i>
                                    <span>@lang('global.client-job-cards.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </li>@endcan
                    
                    @can('warehousing_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-home"></i>
                            <span>@lang('global.warehousing.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('warehouse_access')
                            <li>
                                <a href="{{ route('admin.warehouses.index') }}">
                                    <i class="fa fa-home"></i>
                                    <span>@lang('global.warehouse.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('receiving_access')
                            <li>
                                <a href="{{ route('admin.receivings.index') }}">
                                    <i class="fa fa-arrow-circle-o-right"></i>
                                    <span>@lang('global.receiving.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('releasing_access')
                            <li>
                                <a href="{{ route('admin.releasings.index') }}">
                                    <i class="fa fa-arrow-circle-o-left"></i>
                                    <span>@lang('global.releasing.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </li>@endcan
                    
                    @can('clearance_and_forwarding_access')
                    <li>
                        <a href="{{ route('admin.clearance_and_forwardings.index') }}">
                            <i class="fa fa-clipboard"></i>
                            <span>@lang('global.clearance-and-forwarding.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('air_freight_access')
                    <li>
                        <a href="{{ route('admin.air_freights.index') }}">
                            <i class="fa fa-plane"></i>
                            <span>@lang('global.air-freight.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('rail_freight_access')
                    <li>
                        <a href="{{ route('admin.rail_freights.index') }}">
                            <i class="fa fa-train"></i>
                            <span>@lang('global.rail-freight.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('sea_freight_access')
                    <li>
                        <a href="{{ route('admin.sea_freights.index') }}">
                            <i class="fa fa-ship"></i>
                            <span>@lang('global.sea-freight.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('time_report_access')
                    <li>
                        <a href="{{ route('admin.time_reports.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.time-reports.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('workshops_non_crud_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-wrench"></i>
                    <span>@lang('global.workshops-non-crud.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('workshop_access')
                    <li>
                        <a href="{{ route('admin.workshops.index') }}">
                            <i class="fa fa-home"></i>
                            <span>@lang('global.workshop.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('part_access')
                    <li>
                        <a href="{{ route('admin.parts.index') }}">
                            <i class="fa fa-gear"></i>
                            <span>@lang('global.parts.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('parts_acquired_access')
                    <li>
                        <a href="{{ route('admin.parts_acquireds.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.parts-acquired.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('inhouse_job_card_access')
                    <li>
                        <a href="{{ route('admin.inhouse_job_cards.index') }}">
                            <i class="fa fa-wrench"></i>
                            <span>@lang('global.inhouse-job-cards.title')</span>
                        </a>
                    </li>@endcan
                    
                    <!--@can('schedule_of_service_access')
                    <li>
                        <a href="{{ route('admin.schedule_of_services.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.schedule-of-services.title')</span>
                        </a>
                    </li>@endcan-->
                    
                </ul>
            </li>@endcan
            
            @can('account_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-money"></i>
                    <span>@lang('global.accounts.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('clients_pmi_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-slideshare"></i>
                            <span>@lang('global.clients-pmi.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('client_account_access')
                            <li>
                                <a href="{{ route('admin.client_accounts.index') }}">
                                    <i class="fa fa-calculator"></i>
                                    <span>@lang('global.client-accounts.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('income_category_access')
                            <li>
                                <a href="{{ route('admin.income_categories.index') }}">
                                    <i class="fa fa-list"></i>
                                    <span>@lang('global.income-category.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('credit_note_access')
                            <li>
                                <a href="{{ route('admin.credit_notes.index') }}">
                                    <i class="fa fa-list"></i>
                                    <span>@lang('global.credit-note.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </li>@endcan
                    
                    @can('vendors_pmi_access')
                    <li class="treeview">
                        <a href="#">
                            <i class="fa fa-group"></i>
                            <span>@lang('global.vendors-pmi.title')</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            @can('vendor_account_access')
                            <li>
                                <a href="{{ route('admin.vendor_accounts.index') }}">
                                    <i class="fa fa-calculator"></i>
                                    <span>@lang('global.vendor-accounts.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('expense_category_access')
                            <li>
                                <a href="{{ route('admin.expense_categories.index') }}">
                                    <i class="fa fa-list"></i>
                                    <span>@lang('global.expense-category.title')</span>
                                </a>
                            </li>@endcan
                            
                            @can('debit_note_access')
                            <li>
                                <a href="{{ route('admin.debit_notes.index') }}">
                                    <i class="fa fa-list"></i>
                                    <span>@lang('global.debit-notes.title')</span>
                                </a>
                            </li>@endcan
                            
                        </ul>
                    </li>@endcan
                    
                    @can('bank_payment_access')
                    <li>
                        <a href="{{ route('admin.bank_payments.index') }}">
                            <i class="fa fa-money"></i>
                            <span>@lang('global.bank-payments.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('income_access')
                    <li>
                        <a href="{{ route('admin.incomes.index') }}">
                            <i class="fa fa-arrow-circle-right"></i>
                            <span>@lang('global.income.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('vendor_bank_payment_access')
                    <li>
                        <a href="{{ route('admin.vendor_bank_payments.index') }}">
                            <i class="fa fa-money"></i>
                            <span>@lang('global.vendor-bank-payments.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('expense_access')
                    <li>
                        <a href="{{ route('admin.expenses.index') }}">
                            <i class="fa fa-arrow-circle-left"></i>
                            <span>@lang('global.expense.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('monthly_report_access')
                    <li>
                        <a href="{{ route('admin.monthly_reports.index') }}">
                            <i class="fa fa-line-chart"></i>
                            <span>@lang('global.monthly-report.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('user_management_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span>@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('permission_access')
                    <li>
                        <a href="{{ route('admin.permissions.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.permissions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('role_access')
                    <li>
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span>@lang('global.roles.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_access')
                    <li>
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span>@lang('global.users.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('user_action_access')
                    <li>
                        <a href="{{ route('admin.user_actions.index') }}">
                            <i class="fa fa-th-list"></i>
                            <span>@lang('global.user-actions.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            @can('setting_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gears"></i>
                    <span>@lang('global.settings.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('route_access')
                    <li>
                        <a href="{{ route('admin.routes.index') }}">
                            <i class="fa fa-road"></i>
                            <span>@lang('global.route.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('operation_type_access')
                    <li>
                        <a href="{{ route('admin.operation_types.index') }}">
                            <i class="fa fa-exchange"></i>
                            <span>@lang('global.operation-type.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('time_work_type_access')
                    <li>
                        <a href="{{ route('admin.time_work_types.index') }}">
                            <i class="fa fa-th"></i>
                            <span>@lang('global.time-work-types.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('truck_attachment_status_access')
                    <li>
                        <a href="{{ route('admin.truck_attachment_statuses.index') }}">
                            <i class="fa fa-truck"></i>
                            <span>@lang('global.truck-attachment-status.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('machinery_type_access')
                    <li>
                        <a href="{{ route('admin.machinery_types.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.machinery-type.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('machinery_size_access')
                    <li>
                        <a href="{{ route('admin.machinery_sizes.index') }}">
                            <i class="fa fa-sort-numeric-asc"></i>
                            <span>@lang('global.machinery-size.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('currency_access')
                    <li>
                        <a href="{{ route('admin.currencies.index') }}">
                            <i class="fa fa-money"></i>
                            <span>@lang('global.currency.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('unit_measurement_access')
                    <li>
                        <a href="{{ route('admin.unit_measurements.index') }}">
                            <i class="fa fa-clock-o"></i>
                            <span>@lang('global.unit-measurements.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan
            
            <!--@can('items_list_access')
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-align-justify"></i>
                    <span>@lang('global.items-lists.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    @can('invoice_item_access')
                    <li>
                        <a href="{{ route('admin.invoice_items.index') }}">
                            <i class="fa fa-align-justify"></i>
                            <span>@lang('global.invoice-items.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('load_description_access')
                    <li>
                        <a href="{{ route('admin.load_descriptions.index') }}">
                            <i class="fa fa-gears"></i>
                            <span>@lang('global.load-descriptions.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('overtime_and_bonus_item_access')
                    <li>
                        <a href="{{ route('admin.overtime_and_bonus_items.index') }}">
                            <i class="fa fa-chevron-up"></i>
                            <span>@lang('global.overtime-and-bonus-items.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('deduction_item_access')
                    <li>
                        <a href="{{ route('admin.deduction_items.index') }}">
                            <i class="fa fa-chevron-down"></i>
                            <span>@lang('global.deduction-items.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('job_card_item_access')
                    <li>
                        <a href="{{ route('admin.job_card_items.index') }}">
                            <i class="fa fa-wrench"></i>
                            <span>@lang('global.job-card-items.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('loading_requirement_access')
                    <li>
                        <a href="{{ route('admin.loading_requirements.index') }}">
                            <i class="fa fa-file-text"></i>
                            <span>@lang('global.loading-requirements.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('received_item_access')
                    <li>
                        <a href="{{ route('admin.received_items.index') }}">
                            <i class="fa fa-home"></i>
                            <span>@lang('global.received-items.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('qualification_access')
                    <li>
                        <a href="{{ route('admin.qualifications.index') }}">
                            <i class="fa fa-graduation-cap"></i>
                            <span>@lang('global.qualifications.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('emergency_contact_access')
                    <li>
                        <a href="{{ route('admin.emergency_contacts.index') }}">
                            <i class="fa fa-address-card"></i>
                            <span>@lang('global.emergency-contacts.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('beneficiary_detail_access')
                    <li>
                        <a href="{{ route('admin.beneficiary_details.index') }}">
                            <i class="fa fa-address-card"></i>
                            <span>@lang('global.beneficiary-details.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('identification_access')
                    <li>
                        <a href="{{ route('admin.identifications.index') }}">
                            <i class="fa fa-address-card-o"></i>
                            <span>@lang('global.identifications.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('non_machine_cost_access')
                    <li>
                        <a href="{{ route('admin.non_machine_costs.index') }}">
                            <i class="fa fa-truck"></i>
                            <span>@lang('global.non-machine-costs.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('client_contact_access')
                    <li>
                        <a href="{{ route('admin.client_contacts.index') }}">
                            <i class="fa fa-address-book"></i>
                            <span>@lang('global.client-contacts.title')</span>
                        </a>
                    </li>@endcan
                    
                    @can('vendor_contact_access')
                    <li>
                        <a href="{{ route('admin.vendor_contacts.index') }}">
                            <i class="fa fa-address-book"></i>
                            <span>@lang('global.vendor-contacts.title')</span>
                        </a>
                    </li>@endcan
                    
                </ul>
            </li>@endcan-->
            

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-line-chart"></i>
                    <span class="title">Generated Reports</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                   <li class="{{ $request->is('/reports/income') }}">
                        <a href="{{ url('/admin/reports/income') }}">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">Income</span>
                        </a>
                    </li>   <li class="{{ $request->is('/reports/expenditure') }}">
                        <a href="{{ url('/admin/reports/expenditure') }}">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">Expenditure</span>
                        </a>
                    </li>   <li class="{{ $request->is('/reports/job-cards') }}">
                        <a href="{{ url('/admin/reports/job-cards') }}">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">Job cards</span>
                        </a>
                    </li>   <li class="{{ $request->is('/reports/fuel-purchases') }}">
                        <a href="{{ url('/admin/reports/fuel-purchases') }}">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">Fuel purchases</span>
                        </a>
                    </li>   <li class="{{ $request->is('/reports/refunds') }}">
                        <a href="{{ url('/admin/reports/refunds') }}">
                            <i class="fa fa-line-chart"></i>
                            <span class="title">Refunds</span>
                        </a>
                    </li>
                </ul>
            </li>

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">@lang('global.app_change_password')</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>

