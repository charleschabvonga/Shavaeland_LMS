<?php

Route::group(['prefix' => '/v1', 'namespace' => 'Api\V1', 'as' => 'api.'], function () {

        Route::resource('comments', 'CommentsController', ['except' => ['create', 'edit']]);

        Route::resource('departments', 'DepartmentsController', ['except' => ['create', 'edit']]);

        Route::resource('employees', 'EmployeesController', ['except' => ['create', 'edit']]);

        Route::resource('payee_accounts', 'PayeeAccountsController', ['except' => ['create', 'edit']]);

        Route::resource('salaries_request_totals', 'SalariesRequestTotalsController', ['except' => ['create', 'edit']]);

        Route::resource('payslips', 'PayslipsController', ['except' => ['create', 'edit']]);

        Route::resource('payee_payments', 'PayeePaymentsController', ['except' => ['create', 'edit']]);

        Route::resource('drug_tests', 'DrugTestsController', ['except' => ['create', 'edit']]);

        Route::resource('violations', 'ViolationsController', ['except' => ['create', 'edit']]);

        Route::resource('vehicles', 'VehiclesController', ['except' => ['create', 'edit']]);

        Route::resource('trailers', 'TrailersController', ['except' => ['create', 'edit']]);

        Route::resource('light_vehicles', 'LightVehiclesController', ['except' => ['create', 'edit']]);

        Route::resource('time_projects', 'TimeProjectsController', ['except' => ['create', 'edit']]);

        Route::resource('quotations', 'QuotationsController', ['except' => ['create', 'edit']]);

        Route::resource('income_expense_calculators', 'IncomeExpenseCalculatorsController', ['except' => ['create', 'edit']]);

        Route::resource('vendors', 'VendorsController', ['except' => ['create', 'edit']]);

        Route::resource('purchase_orders', 'PurchaseOrdersController', ['except' => ['create', 'edit']]);

        Route::resource('road_freight_sub_contractors', 'RoadFreightSubContractorsController', ['except' => ['create', 'edit']]);

        Route::resource('vehicle_scs', 'VehicleScsController', ['except' => ['create', 'edit']]);

        Route::resource('drivers', 'DriversController', ['except' => ['create', 'edit']]);

        Route::resource('time_entries', 'TimeEntriesController', ['except' => ['create', 'edit']]);

        Route::resource('road_freights', 'RoadFreightsController', ['except' => ['create', 'edit']]);

        Route::resource('machinery_costs', 'MachineryCostsController', ['except' => ['create', 'edit']]);

        Route::resource('fuel_costs', 'FuelCostsController', ['except' => ['create', 'edit']]);

        Route::resource('loading_instructions', 'LoadingInstructionsController', ['except' => ['create', 'edit']]);

        Route::resource('delivery_instructions', 'DeliveryInstructionsController', ['except' => ['create', 'edit']]);

        Route::resource('client_vehicles', 'ClientVehiclesController', ['except' => ['create', 'edit']]);

        Route::resource('job_requests', 'JobRequestsController', ['except' => ['create', 'edit']]);

        Route::resource('client_job_cards', 'ClientJobCardsController', ['except' => ['create', 'edit']]);

        Route::resource('warehouses', 'WarehousesController', ['except' => ['create', 'edit']]);

        Route::resource('receivings', 'ReceivingsController', ['except' => ['create', 'edit']]);

        Route::resource('releasings', 'ReleasingsController', ['except' => ['create', 'edit']]);

        Route::resource('clearance_and_forwardings', 'ClearanceAndForwardingsController', ['except' => ['create', 'edit']]);

        Route::resource('air_freights', 'AirFreightsController', ['except' => ['create', 'edit']]);

        Route::resource('rail_freights', 'RailFreightsController', ['except' => ['create', 'edit']]);

        Route::resource('sea_freights', 'SeaFreightsController', ['except' => ['create', 'edit']]);

        Route::resource('workshops', 'WorkshopsController', ['except' => ['create', 'edit']]);

        Route::resource('parts', 'PartsController', ['except' => ['create', 'edit']]);

        Route::resource('parts_acquireds', 'PartsAcquiredsController', ['except' => ['create', 'edit']]);

        Route::resource('client_accounts', 'ClientAccountsController', ['except' => ['create', 'edit']]);

        Route::resource('income_categories', 'IncomeCategoriesController', ['except' => ['create', 'edit']]);

        Route::resource('credit_notes', 'CreditNotesController', ['except' => ['create', 'edit']]);

        Route::resource('vendor_accounts', 'VendorAccountsController', ['except' => ['create', 'edit']]);

        Route::resource('expense_categories', 'ExpenseCategoriesController', ['except' => ['create', 'edit']]);

        Route::resource('debit_notes', 'DebitNotesController', ['except' => ['create', 'edit']]);

        Route::resource('bank_payments', 'BankPaymentsController', ['except' => ['create', 'edit']]);

        Route::resource('incomes', 'IncomesController', ['except' => ['create', 'edit']]);

        Route::resource('vendor_bank_payments', 'VendorBankPaymentsController', ['except' => ['create', 'edit']]);

        Route::resource('expenses', 'ExpensesController', ['except' => ['create', 'edit']]);

        Route::resource('routes', 'RoutesController', ['except' => ['create', 'edit']]);

        Route::resource('operation_types', 'OperationTypesController', ['except' => ['create', 'edit']]);

        Route::resource('time_work_types', 'TimeWorkTypesController', ['except' => ['create', 'edit']]);

        Route::resource('truck_attachment_statuses', 'TruckAttachmentStatusesController', ['except' => ['create', 'edit']]);

        Route::resource('machinery_types', 'MachineryTypesController', ['except' => ['create', 'edit']]);

        Route::resource('machinery_sizes', 'MachinerySizesController', ['except' => ['create', 'edit']]);

        Route::resource('invoice_items', 'InvoiceItemsController', ['except' => ['create', 'edit']]);

        Route::resource('load_descriptions', 'LoadDescriptionsController', ['except' => ['create', 'edit']]);

        Route::resource('overtime_and_bonus_items', 'OvertimeAndBonusItemsController', ['except' => ['create', 'edit']]);

        Route::resource('deduction_items', 'DeductionItemsController', ['except' => ['create', 'edit']]);

        Route::resource('job_card_items', 'JobCardItemsController', ['except' => ['create', 'edit']]);

        Route::resource('loading_requirements', 'LoadingRequirementsController', ['except' => ['create', 'edit']]);

        Route::resource('received_items', 'ReceivedItemsController', ['except' => ['create', 'edit']]);

        Route::resource('qualifications', 'QualificationsController', ['except' => ['create', 'edit']]);

        Route::resource('emergency_contacts', 'EmergencyContactsController', ['except' => ['create', 'edit']]);

        Route::resource('beneficiary_details', 'BeneficiaryDetailsController', ['except' => ['create', 'edit']]);

        Route::resource('identifications', 'IdentificationsController', ['except' => ['create', 'edit']]);

        Route::resource('non_machine_costs', 'NonMachineCostsController', ['except' => ['create', 'edit']]);

        Route::resource('client_contacts', 'ClientContactsController', ['except' => ['create', 'edit']]);

        Route::resource('vendor_contacts', 'VendorContactsController', ['except' => ['create', 'edit']]);

        Route::resource('currencies', 'CurrenciesController', ['except' => ['create', 'edit']]);

        Route::resource('inhouse_job_cards', 'InhouseJobCardsController', ['except' => ['create', 'edit']]);

        Route::resource('unit_measurements', 'UnitMeasurementsController', ['except' => ['create', 'edit']]);

        Route::resource('schedule_of_services', 'ScheduleOfServicesController', ['except' => ['create', 'edit']]);

});
