<?php

return [
	
	'user-management' => [
		'title' => 'User management',
		'fields' => [
		],
	],
	
	'permissions' => [
		'title' => 'Permissions',
		'fields' => [
			'title' => 'Title',
		],
	],
	
	'roles' => [
		'title' => 'Roles',
		'fields' => [
			'title' => 'Title',
			'permission' => 'Permissions',
		],
	],
	
	'users' => [
		'title' => 'Users',
		'fields' => [
			'name' => 'Name',
			'email' => 'Email',
			'password' => 'Password',
			'role' => 'Role',
			'remember-token' => 'Remember token',
			'approved' => 'Approved',
		],
	],
	
	'user-actions' => [
		'title' => 'User actions',
		'created_at' => 'Time',
		'fields' => [
			'user' => 'User',
			'action' => 'Action',
			'action-model' => 'Action model',
			'action-id' => 'Action id',
		],
	],
	
	'operations' => [
		'title' => 'OPERATIONS',
		'fields' => [
		],
	],
	
	'time-work-types' => [
		'title' => 'Work types',
		'fields' => [
			'name' => 'Work type',
		],
	],
	
	'time-projects' => [
		'title' => 'Clients',
		'fields' => [
			'name' => 'Client',
			'client-type' => 'Client type',
			'street-address' => 'Street address',
			'city' => 'City',
			'province' => 'Province',
			'postal-code' => 'Postal code',
			'country' => 'Country',
			'vat-number' => 'Vat No.',
			'website' => 'Website',
			'email' => 'Email',
			'phone-number-1' => 'Phone No 1',
			'phone-number-2' => 'Phone No. 2',
			'fax-number' => 'Fax No.',
		],
	],
	
	'time-entries' => [
		'title' => 'Projects',
		'fields' => [
			'operation-number' => 'Project No.',
			'entry-date' => 'Entry date',
			'work-type' => 'Work type',
			'client' => 'Client',
			'start-time' => 'Start time',
			'end-time' => 'End time',
			'status' => 'Status',
		],
	],
	
	'time-reports' => [
		'title' => 'Reports',
		'fields' => [
		],
	],
	
	'accounts' => [
		'title' => 'ACCOUNTS',
		'fields' => [
		],
	],
	
	'expense-category' => [
		'title' => 'Vendor tax invoices',
		'fields' => [
			'transaction-type' => 'Transaction type',
			'transaction-number' => 'Transaction No.',
			'entry-date' => 'Entry date',
			'due-date' => 'Due date',
			'prepared-by' => 'Processed by',
			'credit-note-number' => 'Vendor tax invoice No.',
			'vendor' => 'Vendor',
			'contact-person' => 'Contact person',
			'account-manager' => 'Account manager',
			'purchase-order-number' => 'Purchase order No.',
			'vendor-purchase-order-number' => 'Vendor sale order No.',
			'upload-document' => 'Upload document',
			'status' => 'Status',
			'terms-and-conditions' => 'Terms & conditions',
			'subtotal' => 'Subtotal',
			'percent-discount' => 'Percent discount',
			'discount-amount' => 'Discount amount',
			'discounted-subtotal' => 'Discounted subtotal',
			'vat' => 'Vat',
			'vat-amount' => 'Vat amount',
			'total-amount' => 'Total amount',
			'paid-to-date' => 'Paid to date',
			'balance' => 'Balance',
			'currency' => 'Currency',
		],
	],
	
	'income-category' => [
		'title' => 'Client tax invoices',
		'fields' => [
			'project-type' => 'Project type',
			'project-number' => 'Project No.',
			'entry-date' => 'Entry date',
			'due-date' => 'Due date',
			'prepared-by' => 'Processed by',
			'invoice-number' => 'Invoice No.',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'account-manager' => 'Account manager',
			'quotation-number' => 'Quote No.',
			'sales-order-number' => 'Sales order No.',
			'status' => 'Status',
			'subtotal' => 'Subtotal',
			'percent-discount' => 'Percent discount',
			'discount-amount' => 'Discount amount',
			'discounted-subtotal' => 'Discounted subtotal',
			'vat' => 'Vat',
			'vat-amount' => 'Vat amount',
			'total-amount' => 'Total amount',
			'paid-to-date' => 'Paid to date',
			'balance' => 'Balance',
			'currency' => 'Currency',
		],
	],
	
	'income' => [
		'title' => 'Income/Debit note pymts',
		'fields' => [
			'entry-date' => 'Entry date',
			'payment-type' => 'Payment type',
			'deposit-transaction-number' => 'Deposit tran No.',
			'prepared-by' => 'Processed by',
			'payment-number' => 'Payment No.',
			'invoice-number' => 'Invoice No.',
			'sales-credit-note-number' => 'Sales credit note No.',
			'client' => 'Client',
			'debit-note-number' => 'Debit note No.',
			'vendor' => 'Vendor',
			'operation-type' => 'Operation type',
			'project-type' => 'Work type',
			'project-number' => 'Operation No.',
			'income-category' => 'Income category',
			'amount' => 'Amount',
			'currency' => 'Currency',
		],
	],
	
	'expense' => [
		'title' => 'Expense/Credit note pymts',
		'fields' => [
			'entry-date' => 'Entry date',
			'payment-type' => 'Payment type',
			'withdrawal-transaction-number' => 'Deposit trans No.',
			'prepared-by' => 'Processed by',
			'payment-number' => 'Payment No.',
			'vendor-credit-note-number' => 'Vendor tax invoice No.',
			'debit-note-number' => 'Debit note No.',
			'vendor' => 'Vendor',
			'client-credit-note-number' => 'Credit note No.',
			'client' => 'Client',
			'operation-type' => 'Operation type',
			'transaction-type' => 'Work type',
			'transaction-number' => 'Operation No.',
			'expense-category' => 'Expense category',
			'amount' => 'Amount',
			'currency' => 'Currency',
		],
	],
	
	'monthly-report' => [
		'title' => 'Monthly report',
		'fields' => [
		],
	],
	
	'internal-notifications' => [
		'title' => 'Notifications',
		'fields' => [
		],
	],
	
	'warehousing' => [
		'title' => 'Warehouses',
		'fields' => [
		],
	],
	
	'vendors-pmi' => [
		'title' => 'VENDORS',
		'fields' => [
		],
	],
	
	'workshops-non-crud' => [
		'title' => 'WORKSHOPS',
		'fields' => [
		],
	],
	
	'items-lists' => [
		'title' => 'Items lists',
		'fields' => [
		],
	],
	
	'human-reources' => [
		'title' => 'HUMAN RESOURCES',
		'fields' => [
		],
	],
	
	'clients-pmi' => [
		'title' => 'CLIENTS',
		'fields' => [
		],
	],
	
	'assets' => [
		'title' => 'ASSETS',
		'fields' => [
		],
	],
	
	'sales' => [
		'title' => 'SALES',
		'fields' => [
		],
	],
	
	'settings' => [
		'title' => 'Settings',
		'fields' => [
		],
	],
	
	'road-freight-sc' => [
		'title' => 'Road freights',
		'fields' => [
		],
	],
	
	'debit-notes' => [
		'title' => 'Debit notes',
		'fields' => [
			'date' => 'Date',
			'refund-type' => 'Refund type',
			'credit-note-payment-number' => 'Credit note pymt No.',
			'transaction-number' => 'Transaction No.',
			'credit-note-number' => 'Credit note No.',
			'withdrawal-transaction-number' => 'Deposit trans No.',
			'vendor' => 'Vendor',
			'contact-person' => 'Contact person',
			'account-manager' => 'Account manager',
			'prepared-by' => 'Processed by',
			'debit-note-number' => 'Debit note No.',
			'status' => 'Status',
			'subtotal' => 'Subtotal',
			'vat' => 'Vat',
			'vat-amount' => 'Vat amount',
			'total-amount' => 'Total amount',
			'paid-to-date' => 'Paid to date',
			'balance' => 'Balance',
			'currency' => 'Currency',
		],
	],
	
	'vendor-bank-payments' => [
		'title' => 'Outbound deposits',
		'fields' => [
			'entry-date' => 'Entry date',
			'withdrawer' => 'Deposit to',
			'payment-mode' => 'Deposit type',
			'prepared-by' => 'Processed by',
			'payment-number' => 'Deposit trans No.',
			'vendor' => 'Vendor',
			'account-number' => 'Account No.',
			'client' => 'Client',
			'client-account-number' => 'Account No.',
			'credit-note-number' => 'Credit Note No. (APR)',
			'amount' => 'Amount',
			'balance' => 'Balance',
			'upload-document' => 'Upload document',
			'currency' => 'Currency',
		],
	],
	
	'vendor-accounts' => [
		'title' => 'Vendor accounts',
		'fields' => [
			'vendor' => 'Vendor',
			'contact-person' => 'Contact person',
			'account-manager' => 'Account manager',
			'account-number' => 'Account No.',
			'status' => 'Status',
		],
	],
	
	'comments' => [
		'title' => 'Comments',
		'fields' => [
			'name' => 'Name',
			'email' => 'Email',
			'comments' => 'Comments',
		],
	],
	
	'machinery-type' => [
		'title' => 'Machinery type',
		'fields' => [
			'machinery-type' => 'Machinery type',
			'attachment' => 'Attachment',
		],
	],
	
	'qualifications' => [
		'title' => 'Qualifications',
		'fields' => [
			'employee-name' => 'Employee name',
			'file' => 'File',
			'institution' => 'Institution',
			'description' => 'Description',
			'date-obtained' => 'Date obtained',
			'expiry-date' => 'Expiry date',
		],
	],
	
	'shipping-address' => [
		'title' => 'Shipping address',
		'fields' => [
		],
	],
	
	'vendor-contacts' => [
		'title' => 'Vendor contacts',
		'fields' => [
			'company-name' => 'Company name',
			'contact-name' => 'Contact name',
			'phone-number' => 'Phone No.',
			'email' => 'Email',
		],
	],
	
	'client-contacts' => [
		'title' => 'Client contacts',
		'fields' => [
			'company-name' => 'Company name',
			'contact-name' => 'Contact name',
			'phone-number' => 'Phone No.',
			'email' => 'Email',
		],
	],
	
	'non-machine-costs' => [
		'title' => 'Non machine costs',
		'fields' => [
			'road-freight-number' => 'Road freight No.',
			'item-description' => 'Item description',
			'qty' => 'Qty',
			'cost' => 'Cost',
			'unit' => 'Unit',
			'total' => 'Total',
		],
	],
	
	'emergency-contacts' => [
		'title' => 'Emergency contacts',
		'fields' => [
			'employee-name' => 'Employee name',
			'name' => 'Contact name',
			'phone1' => 'Phone No. 1',
			'phone' => 'Phone No. 2',
		],
	],
	
	'identifications' => [
		'title' => 'Identifications',
		'fields' => [
			'employee-name' => 'Employee name',
			'id-type' => 'ID type',
			'id-number' => 'ID number',
			'date-of-birth' => 'Date of birth',
			'identification' => 'Identification',
			'date-obtained' => 'Date obtained',
			'expiry-date' => 'Expiry date',
		],
	],
	
	'received-items' => [
		'title' => 'Warehouse items',
		'fields' => [
			'receipt-number' => 'Receipt No.',
			'release-number' => 'Release No.',
			'item' => 'Item',
			'qty' => 'Qty',
			'area' => 'Area (square meters)',
			'unit' => 'Unit',
		],
	],
	
	'operation-type' => [
		'title' => 'Operation type',
		'fields' => [
			'name' => 'Operation type',
		],
	],
	
	'loading-requirements' => [
		'title' => 'Loading requirements',
		'fields' => [
			'loading-instruction-number' => 'Loading instruction No.',
			'item-description' => 'Item description',
			'qty' => 'Qty',
			'unit' => 'Unit',
		],
	],
	
	'job-card-items' => [
		'title' => 'Job card items',
		'fields' => [
			'job-card-items' => 'Job card No.',
			'client-job-card-number' => 'Client job card No.',
			'workshop' => 'Workshop',
			'part' => 'Part',
			'price' => 'Price',
			'qty' => 'Qty',
			'unit' => 'Unit',
			'total' => 'Total',
		],
	],
	
	'deduction-items' => [
		'title' => 'Deduction items',
		'fields' => [
			'item-number' => 'Payslip No.',
			'item-description' => 'Item description',
			'unit-price' => 'Unit price',
			'qty' => 'Qty',
			'total' => 'Total',
			'unit' => 'Unit',
		],
	],
	
	'overtime-and-bonus-items' => [
		'title' => 'Overtime & bonus items',
		'fields' => [
			'item-number' => 'Payslip No.',
			'item-description' => 'Item description',
			'unit-price' => 'Unit price',
			'qty' => 'Qty',
			'total' => 'Total',
			'unit' => 'Unit',
		],
	],
	
	'load-descriptions' => [
		'title' => 'Load descriptions',
		'fields' => [
			'description' => 'Item description',
			'qty' => 'Qty',
			'weight-volume' => 'Weight/Volume',
			'loading-instruction-number' => 'Loading instruction No.',
			'delivery-instruction-number' => 'Delivery instruction No.',
			'air-freight-number' => 'Air freight No.',
			'rail-freight-number' => 'Rail freight No.',
			'sea-freight-number' => 'Sea freight No.',
			'unit' => 'Unit',
		],
	],
	
	'invoice-items' => [
		'title' => 'Item descriptions',
		'fields' => [
			'invoice-number' => 'Invoice No.',
			'bill-number' => 'Bill No.',
			'credit-note-number' => 'Credit note No.',
			'debit-note-number' => 'Debit note No.',
			'clearance-and-forwarding-number' => 'C&F No.',
			'quotation-number' => 'Quotation No.',
			'purchase-order-number' => 'Purchase order No.',
			'item-description' => 'Item description',
			'unit-price' => 'Unit price',
			'qty' => 'Qty',
			'total' => 'Total',
			'unit' => 'Unit',
		],
	],
	
	'truck-attachment-status' => [
		'title' => 'Truck attachment status',
		'fields' => [
			'attachment' => 'Attachment',
		],
	],
	
	'route' => [
		'title' => 'Routes',
		'fields' => [
			'route' => 'Route',
			'distance' => 'Distance',
		],
	],
	
	'vendors' => [
		'title' => 'Vendors',
		'fields' => [
			'name' => 'Vendor',
			'vendor-type' => 'Vendor type',
			'street-address' => 'Street address',
			'city' => 'City',
			'province' => 'Province',
			'postal-code' => 'Postal code',
			'country' => 'Country',
			'vat' => 'Vat No.',
			'website' => 'Website',
			'email' => 'Email',
			'phone-number-1' => 'Tel 1',
			'phone-number-2' => 'Tel 2',
			'fax-number' => 'Fax',
			'tax-clearance-number' => 'Tax clearance No.',
			'tax-clearance' => 'Tax clearance',
			'tax-clearance-expiration-date' => 'Tax clearance expiration date',
			'company-registration-number' => 'Company registration No.',
			'company-registration' => 'Company registration',
			'company-proof-of-residents' => 'Company proof of residents',
			'directors-name' => 'Director/\\\'s name',
			'director-id-number' => 'Director id No.',
			'directors-proof-of-residence' => 'Directors proof of residence',
		],
	],
	
	'credit-note' => [
		'title' => 'Credit notes',
		'fields' => [
			'date' => 'Date',
			'refund-type' => 'Refund type',
			'invoice-payment-number' => 'Invoice payment No.',
			'project-number' => 'Project No.',
			'invoice-number' => 'Invoice No.',
			'bank-reference' => 'Deposit trans No.',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'account-manager' => 'Account manager',
			'prepared-by' => 'Processed by',
			'credit-note-number' => 'Credit note No. ',
			'status' => 'Status',
			'terms-and-conditions' => 'Terms and conditions',
			'subtotal' => 'Subtotal',
			'vat' => 'Vat',
			'vat-amount' => 'Vat amount',
			'total-amount' => 'Total amount',
			'paid-to-date' => 'Paid to date',
			'balance' => 'Balance',
			'currency' => 'Currency',
		],
	],
	
	'vehicles' => [
		'title' => 'Horses',
		'fields' => [
			'vehicle-description' => 'Registration No.',
			'make' => 'Make',
			'model' => 'Model',
			'purchase-date' => 'Purchase date',
			'purchase-price' => 'Purchase price',
			'chasis-number' => 'Chasis No.',
			'engine-number' => 'Engine No.',
			'size' => 'Size',
			'starting-mileage' => 'Starting mileage',
			'next-service-mileage' => 'Next service mileage',
			'next-service-date' => 'Next service date',
			'service-status' => 'Service status',
			'availability' => 'Availability',
			'salvage-value' => 'Salvage value',
			'investment' => 'Investment',
			'depreciation' => 'Depreciation',
			'maintenance' => 'Maintenance',
			'tyre' => 'Tyre',
		],
	],
	
	'road-freight-subcontract' => [
		'title' => 'Road freight (subs)',
		'fields' => [
		],
	],
	
	'drivers' => [
		'title' => 'Transporter drivers',
		'fields' => [
			'vendor' => 'Transporter',
			'subcontractor-number' => 'Subcontractor No.',
			'name' => 'Name',
			'date-of-birth' => 'Date of birth',
			'drivers-license-number' => 'License No.',
			'drivers-license' => 'License',
			'drivers-license-expiry-date' => 'License expiry date',
			'int-drivers-license-no' => 'Int drivers license No.',
			'int-drivers-license' => 'Int drivers license',
			'int-drivers-license-expiry-date' => 'Int drivers license expiry date',
			'drivers-passport-number' => 'Passport No.',
			'drivers-passport' => 'Driver passport',
			'passport-expiry-date' => 'Passport expiry date',
			'sa-phone-number' => 'SA Phone No.',
			'int-phone-number' => 'Int phone No.',
			'police-clearance-expiry-date' => 'Police clearance expiry date',
			'police-clearance' => 'Police clearance',
			'retest-number' => 'Retest No.',
			'retest' => 'Retest',
			'retest-expiry-date' => 'Retest expiry date',
			'status' => 'Status',
		],
	],
	
	'vehicle-sc' => [
		'title' => 'Transporter vehicles',
		'fields' => [
			'vendor' => 'Transporter',
			'subcontractor-number' => 'Subcontractor No.',
			'vehicle-type' => 'Vehicle type',
			'make' => 'Make',
			'model' => 'Model',
			'registration-number' => 'Registration No.',
			'certificate-of-registration' => 'Certificate of registration',
			'certificate-of-fitness-number' => 'Certificate of fitness No.',
			'certificate-of-fitness' => 'Certificate of fitness documents',
			'tracker-pin-details' => 'Tracker login details',
			'tracker-password' => 'Tracker password',
			'expiration-date' => 'Expiration date',
			'service-history-reports' => 'Service history reports',
			'status' => 'Status',
		],
	],
	
	'road-freight-sub-contractors' => [
		'title' => 'Transporter requirements',
		'fields' => [
			'subcontractor-number' => 'Subcontractor No.',
			'vendor' => 'Transporter',
			'git-cover-number' => 'Git cover No.',
			'git-cover' => 'Git cover documents',
			'status' => 'Status',
			'git-expiry-date' => 'Git expiry date',
			'git-status' => 'Git status',
		],
	],
	
	'road-freights' => [
		'title' => 'Road freights',
		'fields' => [
			'project-number' => 'Project No.',
			'road-freight-number' => 'Road freight No.',
			'freight-contract-type' => 'Carrier type',
			'route' => 'Route',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'project-manager' => 'Project manager',
			'driver' => 'Driver',
			'vehicle' => 'Vehicle',
			'trailers' => 'Trailers',
			'subcontractor-number' => 'Subcontractor No.',
			'vendor' => 'Vendor',
			'vendor-contact-person' => 'Contact person',
			'vendor-drivers' => 'Driver(s)',
			'vendor-vehicles' => 'Vehicle(s)',
			'road-freight-income' => 'Road freight income',
			'road-freight-expenses' => 'Road freight expenses',
			'machinery-costs' => 'Machinery costs',
			'breakdown' => 'Breakdown expenses',
			'total-expenses' => 'Total expenses',
			'net-income' => 'Net income',
		],
	],
	
	'violations' => [
		'title' => 'Traffic Violations',
		'fields' => [
			'employee-name' => 'Driver',
			'vehicle-description' => 'Vehicle',
			'trailer' => 'Trailer',
			'road-freight-number' => 'Road freight No.',
			'citation-number' => 'Citation No.',
			'citation-date' => 'Citation date',
			'description' => 'Violation description',
			'location-issued' => 'Location issued',
			'file' => 'File',
			'status' => 'Responsibility status',
			'amount' => 'Amount',
		],
	],
	
	'delivery-instruction' => [
		'title' => 'Delivery instructions',
		'fields' => [
			'road-freight-number' => 'Road freight No.',
			'freight-contract-type' => 'Carrier type',
			'delivery-instruction-number' => 'Delivery inst No.',
			'driver' => 'Driver',
			'vehicle' => 'Vehicle',
			'trailers' => 'Trailers',
			'vendor' => 'Vendor',
			'vendor-driver' => 'Driver',
			'vendor-vehicle-description' => 'Vehicle(s) description',
			'order-number' => 'Order No.',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'project-manager' => 'Project manager',
			'delivery-company-name' => 'Delivery company name',
			'delivery-address' => 'Address',
			'delivery-date-time' => 'Date time',
			'prepared-by' => 'Processed by',
			'status' => 'Status',
		],
	],
	
	'drug-tests' => [
		'title' => 'Drug tests',
		'fields' => [
			'drug-test-number' => 'Drug test No.',
			'employee-name' => 'Employee name',
			'last-annual-drug-test' => 'Last annual drug test date',
			'last-random-drug-test' => 'Last random drug test type',
			'last-physical-exam-date' => 'Last physical exam date',
			'description' => 'Diagnosis description',
			'file' => 'File',
		],
	],
	
	'payee-payments' => [
		'title' => 'Payslip payments',
		'fields' => [
			'entry-date' => 'Entry date',
			'employee' => 'Employee',
			'payslip-number' => 'Payslip No.',
			'batch-number' => 'Batch No.',
			'withdrawal-transaction-number' => 'Deposit trans No.',
			'payee-account-number' => 'Account No.',
			'payee-payment-number' => 'Payment No.',
			'payment-mode' => 'Payment mode',
			'amount' => 'Amount paid',
			'prepared-by' => 'Processed by',
		],
	],
	
	'payslips' => [
		'title' => 'Payslips',
		'fields' => [
			'date' => 'Pay date',
			'starting-date' => 'Starting date',
			'ending-date' => 'Ending date',
			'employee' => 'Employee',
			'batch-number' => 'Batch No.',
			'account-number' => 'Account No.',
			'payslip-number' => 'Payslip No.',
			'status' => 'Status',
			'overtime-and-bonus-total' => 'Gross income',
			'deductions-total' => 'Total Deductions',
			'gross' => 'Taxable income',
			'income-tax' => 'Income tax rate',
			'income-tax-amount' => 'Income tax amount',
			'net-income' => 'Net income',
			'paid-to-date' => 'Paid to date',
			'balance' => 'Balance',
			'prepared-by' => 'Processed by',
		],
	],
	
	'payee-accounts' => [
		'title' => 'Employee accounts',
		'fields' => [
			'employee' => 'Account name',
			'bank' => 'Bank name',
			'account-number' => 'Account No.',
			'branch-code' => 'Branch code',
			'branch' => 'Branch',
			'department' => 'Department',
			'position' => 'Position',
			'status' => 'Status',
			'pymt-measurement-type' => 'Pymt measurement type',
			'wage-rate' => 'Salary/Wage rate',
			'pension-rate' => 'Pension rate',
			'overtime-rate' => 'Overtime rate',
			'public-holiday-rate' => 'Public holiday',
			'medical-aid' => 'Medical aid',
			'sales-rate' => 'Sales rate',
		],
	],
	
	'employees' => [
		'title' => 'Employees',
		'fields' => [
			'name' => 'Name',
			'department' => 'Department',
			'position' => 'Position',
			'start-date' => 'Start date',
			'end-date' => 'End date',
			'status' => 'Status',
			'street-address' => 'Street address',
			'city' => 'City',
			'province' => 'Province',
			'country' => 'Country',
			'sa-mobile' => 'SA mobile No.',
			'int-mobile' => 'Int mobile No.',
			'email' => 'Email',
			'upload-qualifications' => 'Upload qualifications',
			'upload-identification-docs' => 'Upload identification docs',
		],
	],
	
	'departments' => [
		'title' => 'Departments',
		'fields' => [
			'dept-name' => 'Dept name',
			'manager' => 'Manager',
			'street-address' => 'Street address',
			'city' => 'City',
			'province' => 'Province',
			'country' => 'Country',
			'phone-no' => 'Phone No.',
			'extension' => 'Ext.',
			'mobile-number' => 'Mobile No.',
			'email' => 'Email',
		],
	],
	
	'loading-instruction' => [
		'title' => 'Loading instructions',
		'fields' => [
			'road-freight-number' => 'Road freight No.',
			'freight-contract-type' => 'Carrier type',
			'loading-instruction-number' => 'Loading inst No.',
			'driver' => 'Driver',
			'vehicle' => 'Vehicle',
			'trailers' => 'Trailers',
			'vendor' => 'Vendor',
			'vendor-driver' => 'Driver',
			'vendor-vehicle-description' => 'Vehicle(s) description',
			'order-number' => 'Order No.',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'project-manager' => 'Project manager',
			'pick-up-company-name' => 'Pickup company name',
			'pickup-address' => 'Address',
			'pickup-date-time' => 'Date time',
			'prepared-by' => 'Processed by',
			'status' => 'Status',
		],
	],
	
	'workshop' => [
		'title' => 'Workshop centers',
		'fields' => [
			'vendor' => 'Vendor',
			'center-name' => 'Center name',
		],
	],
	
	'air-freight' => [
		'title' => 'Air freights',
		'fields' => [
			'project-number' => 'Project No.',
			'air-freight-number' => 'Air freight No.',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'airline-or-agent' => 'Airline/Agent',
			'airline-or-agent-contact' => 'Contact person',
			'project-manager' => 'Project manager',
			'flight-number' => 'Flight No.',
			'route' => 'Route',
		],
	],
	
	'bank-payments' => [
		'title' => 'Inbound deposits',
		'fields' => [
			'entry-date' => 'Entry date',
			'depositor' => 'Deposit from',
			'payment-mode' => 'Deposit type',
			'prepared-by' => 'Processed by',
			'payment-number' => 'Deposit trans No.',
			'client' => 'Client',
			'account-number' => 'Account No.',
			'vendor' => 'Vendor',
			'vendor-account-number' => 'Account No.',
			'debit-note-number' => 'Debit Note No. (APR)',
			'amount' => 'Amount deposited',
			'balance' => 'Balance',
			'upload-document' => 'Upload document',
			'currency' => 'Currency',
		],
	],
	
	'client-accounts' => [
		'title' => 'Client accounts',
		'fields' => [
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'account-manager' => 'Account manager',
			'account-number' => 'Account No.',
			'status' => 'Status',
		],
	],
	
	'quotation' => [
		'title' => 'Quotations',
		'fields' => [
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'sales-person' => 'Sales person',
			'quotation-number' => 'Quote No.',
			'date' => 'Date',
			'due-date' => 'Due date',
			'status' => 'Status',
			'subtotal' => 'Subtotal',
			'vat' => 'Vat',
			'vat-amount' => 'Vat amount',
			'total-amount' => 'Total amount',
			'prepared-by' => 'Processed by',
			'currency' => 'Currency',
		],
	],
	
	'sea-freight' => [
		'title' => 'Sea freights',
		'fields' => [
			'project-number' => 'Project No.',
			'sea-freight-number' => 'Sea freight No.',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'shipper-or-agent' => 'Shipper/Agent',
			'shipper-or-agent-contact' => 'Contact person',
			'project-manager' => 'Project manager',
			'voyage-number' => 'Voyage No.',
			'route' => 'Route',
		],
	],
	
	'rail-freight' => [
		'title' => 'Rail freights',
		'fields' => [
			'project-number' => 'Project No.',
			'rail-freight-number' => 'Rail freight No.',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'railline-or-agent' => 'Railline/Agent',
			'railline-or-agent-contact' => 'Contact person',
			'project-manager' => 'Project manager',
			'trip-number' => 'Trip No.',
			'route' => 'Route',
		],
	],
	
	'clearance-and-forwarding' => [
		'title' => 'Clearance & forwarding',
		'fields' => [
			'project-number' => 'Project No.',
			'clearance-and-forwarding-number' => 'C&F No.',
			'border-post' => 'Border post',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'agent' => 'Agent',
			'agent-contact' => 'Contact person',
			'project-manager' => 'Project manager',
		],
	],
	
	'parts' => [
		'title' => 'Stores',
		'fields' => [
			'repair-center' => 'Workshop center',
			'part' => 'Part/Accessory',
			'qty' => 'Qty',
			'unit' => 'Unit',
			'status' => 'Status',
		],
	],
	
	'releasing' => [
		'title' => 'Goods collections',
		'fields' => [
			'date' => 'Date',
			'project-number' => 'Project No.',
			'warehouse' => 'Warehouse',
			'release-number' => 'Release No.',
			'prepared-by' => 'Processed by',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'released-by' => 'Released by',
			'project-manager' => 'Project manager',
			'area-coverd' => 'Area covered',
		],
	],
	
	'receiving' => [
		'title' => 'Goods Receipts',
		'fields' => [
			'date' => 'Date',
			'project-number' => 'Project No.',
			'warehouse' => 'Warehouse',
			'receipt-number' => 'Receipt No.',
			'prepared-by' => 'Processed by',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'received-by' => 'Received by',
			'project-manager' => 'Project manager',
			'rate' => 'Rate',
			'days' => 'Number of days',
			'total-area-coverd' => 'Aarea covered',
			'total-amount' => 'Total amount',
		],
	],
	
	'warehouse' => [
		'title' => 'Warehouses',
		'fields' => [
			'vendor' => 'Vendor',
			'center-name' => 'Center name',
			'square-meters' => 'Square meters',
			'available-space' => 'Available space',
		],
	],
	
	'client-job-card' => [
		'title' => 'Client Job cards',
		'fields' => [
		],
	],
	
	'client-vehicle' => [
		'title' => 'Client vehicles',
		'fields' => [
			'client' => 'Client',
			'registration-number' => 'Vehicle reg No.',
			'vehicle-type' => 'Vehicle type',
			'make' => 'Make',
			'model' => 'Model',
			'starting-mileage' => 'Starting mileage',
			'next-service-mileage' => 'Next service mileage',
			'next-service-date' => 'Next service date',
			'status' => 'Status',
		],
	],
	
	'job-cards' => [
		'title' => 'Job cards',
		'fields' => [
		],
	],
	
	'parts-acquired' => [
		'title' => 'Procurements & requests',
		'fields' => [
			'order-number' => 'Order number',
			'prepared-by' => 'Prepared by',
			'date' => 'Date',
			'transaction-type' => 'Transaction type',
			'repair-center' => 'Workshop center',
			'received-by' => 'Received by',
			'dispatched-by' => 'Dispatched by',
			'part' => 'Part/Accessory',
			'qty' => 'Qty',
			'unit' => 'Unit',
			'unit-price' => 'Unit price',
			'total' => 'Total',
		],
	],
	
	'test' => [
		'title' => 'Test',
		'fields' => [
		],
	],
	
	'road-freights-test' => [
		'title' => 'Road freights test',
		'fields' => [
		],
	],
	
	'procurements' => [
		'title' => 'PROCUREMENTS',
		'fields' => [
		],
	],
	
	'internal-notifications' => [
		'title' => 'Notifications',
		'fields' => [
		],
	],
	
	'machinery-size' => [
		'title' => 'Machinery size',
		'fields' => [
			'size' => 'Size',
			'attachment' => 'Attachment',
		],
	],
	
	'income-expense-calculator' => [
		'title' => 'Road freight estimations',
		'fields' => [
			'route' => 'Route',
			'distance' => 'Distance',
			'load-status' => 'Load status',
			'truck-attachment-status' => 'Attachment status',
			'machinery-attachment-type' => 'Attachment type',
			'size' => 'Size',
			'vehicles' => 'Vehicle(s)',
			'purchase-price' => 'Purchase price',
			'salvage-value' => 'Salvage value',
			'avg-investment' => 'Investment',
			'depreciation' => 'Depreciation',
			'insurance' => 'Insurance',
			'license' => 'License',
			'fuel-price' => 'Fuel price',
			'fuel-usage' => 'Fuel usage',
			'fuel' => 'Fuel',
			'fuel-consumption' => 'Fuel consumption',
			'oil-price' => 'Oil price',
			'oil-usage' => 'Oil usage',
			'oil' => 'Oil',
			'oil-consumption' => 'Oil consumption',
			'tyre-price' => 'Tyre price',
			'number-of-tyres' => 'Number of tyres',
			'tyre' => 'Expected tyre cost',
			'repair-maintenance' => 'Repair & maintenance',
			'contigency-factor' => 'Contigency factor',
			'trip-income' => 'Income',
			'other-costs' => 'Other costs',
			'total-costs' => 'Total costs',
			'balance' => 'Balance',
		],
	],
	
	'machinery-costs' => [
		'title' => 'Machinery costs',
		'fields' => [
			'road-freight-number' => 'Road freight No.',
			'route' => 'Route',
			'distance' => 'Distance',
			'load-status' => 'Load status',
			'truck-attachment-status' => 'Attachment status',
			'machinery-attachment-type' => 'Attachment type',
			'size' => 'Size',
			'vehicle-description' => 'Vehicle',
			'purchase-price' => 'Purchase price',
			'salvage-value' => 'Salvage value',
			'avg-investment' => 'Investment',
			'depreciation' => 'Depreciation',
			'insurance' => 'Insurance',
			'license' => 'License',
			'fuel-price' => 'Fuel price',
			'fuel-usage' => 'Fuel usage',
			'fuel' => 'Expected fuel cost',
			'fuel-consumption' => 'Fuel consumption',
			'oil-price' => 'Oil price',
			'oil-usage' => 'Oil usage',
			'oil' => 'Expected oil cost',
			'oil-consumption' => 'Oil consumption',
			'number-of-tyres' => 'Number of tyres',
			'tyre-price' => 'Tyre price',
			'tyre' => 'Expected tyre cost',
			'repair-maintenance' => 'Repair & maintenance',
			'contigency-factor' => 'Contigency factor',
			'total-costs' => 'Total costs',
			'attachment-type' => 'Attachment type',
		],
	],
	
	'road-freight-transporters' => [
		'title' => 'Road freight transporters',
		'fields' => [
		],
	],
	
	'internal-notifications' => [
		'title' => 'Notifications',
		'fields' => [
		],
	],
	
	'internal-notifications' => [
		'title' => 'Notifications',
		'fields' => [
		],
	],
	
	'salaries-request-totals' => [
		'title' => 'Monthly payslip batches',
		'fields' => [
			'batch-number' => 'Batch No.',
			'starting-pay-date' => 'Starting pay date',
			'ending-pay-date' => 'Ending pay date',
			'status' => 'Status',
		],
	],
	
	'fuel-costs' => [
		'title' => 'Fuel purchases',
		'fields' => [
			'receipt-number' => 'Receipt No.',
			'road-freight-number' => 'Road freight No.',
			'vehicle' => 'Vehicle',
			'description' => 'Description',
			'qty' => 'Qty',
			'cost' => 'Cost',
			'unit' => 'Unit',
			'total' => 'Total',
			'currency' => 'Currency',
		],
	],
	
	'schedule-of-service' => [
		'title' => 'Schedule of service',
		'fields' => [
		],
	],
	
	'trailers' => [
		'title' => 'Trailers',
		'fields' => [
			'trailer-type' => 'Trailer type',
			'trailer-description' => 'Description/Reg No.',
			'make' => 'Make',
			'model' => 'Model',
			'availability' => 'Availability',
			'service-status' => 'Service status',
			'chasis-number' => 'Chasis No.',
			'purchase-date' => 'Purchase date',
			'purchase-price' => 'Purchase price',
			'salvage-value' => 'Salvage value',
			'investment' => 'Investment',
			'depreciation' => 'Depreciation',
			'maintenance' => 'Maintenance',
			'tyre' => 'Tyre',
		],
	],
	
	'purchase-orders' => [
		'title' => 'Purchase orders',
		'fields' => [
			'vendor' => 'Vendor',
			'contact-person' => 'Contact person',
			'buyer' => 'Buyer',
			'purchase-order-number' => 'Purchase  order No',
			'date' => 'Order Date',
			'request-date' => 'Request date',
			'procurement-date' => 'Procurement date',
			'quotation-number' => 'Quotation No',
			'subtotal' => 'Subtotal',
			'status' => 'Status',
			'vat' => 'Vat',
			'vat-amount' => 'Vat amount',
			'total-amount' => 'Total amount',
			'prepared-by' => 'Processed by',
			'requested-by' => 'Requested by',
			'hod' => 'HOD',
			'gm' => 'GM',
			'accounts' => 'Accounts',
			'currency' => 'Currency',
		],
	],
	
	'internal-notifications' => [
		'title' => 'Notifications',
		'fields' => [
		],
	],
	
	'light-vehicles' => [
		'title' => 'Vehicles',
		'fields' => [
		],
	],
	
	'beneficiary-details' => [
		'title' => 'Beneficiary details',
		'fields' => [
			'employee-name' => 'Employee name',
			'beneficiary-name' => 'Beneficiary name',
			'id-number' => 'Id No.',
			'address' => 'Address',
			'phone1' => 'Phone No. 1',
			'phone' => 'Phone No. 2',
			'allocation-percentage' => 'Allocation percentage',
		],
	],
	
	'customer-workshop' => [
		'title' => 'Workshops',
		'fields' => [
		],
	],
	
	'job-requests' => [
		'title' => 'Job requests',
		'fields' => [
			'project-number' => 'Project No.',
			'description' => 'Description',
			'workshop-manager' => 'Workshop manager',
			'job-request-number' => 'Job request No.',
			'requested-by' => 'Requested by',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'date' => 'Date',
			'vehicle-type' => 'Vehicle type',
			'vehicle-registration-number' => 'Vehicle reg No.',
			'make' => 'Make',
			'model' => 'Model',
			'mileage' => 'Mileage',
			'next-service-mileage' => 'Next service mileage',
			'next-service-date' => 'Next service date',
			'status' => 'Status',
		],
	],
	
	'customer-job-cards' => [
		'title' => 'Job cards',
		'fields' => [
		],
	],
	
	'client-job-cards' => [
		'title' => 'Job cards',
		'fields' => [
		],
	],
	
	'client-job-cards' => [
		'title' => 'Job cards',
		'fields' => [
		],
	],
	
	'light-vehicles' => [
		'title' => 'Vehicles',
		'fields' => [
			'vehicle-type' => 'Vehicle type',
			'vehicle-description' => 'Registration No.',
			'make' => 'Make',
			'model' => 'Model',
			'purchase-date' => 'Purchase date',
			'purchase-price' => 'Purchase price',
			'chasis-number' => 'Chasis No.',
			'engine-number' => 'Engine No.',
			'size' => 'Size',
			'starting-mileage' => 'Starting mileage',
			'next-service-mileage' => 'Next service mileage',
			'next-service-date' => 'Next service date',
			'service-status' => 'Service status',
			'availability' => 'Availability',
			'salvage-value' => 'Salvage value',
			'investment' => 'Investment',
			'depreciation' => 'Depreciation',
			'maintenance' => 'Maintenance',
			'tyre' => 'Tyre',
		],
	],
	
	'client-job-cards' => [
		'title' => 'Job cards',
		'fields' => [
			'job-request-number' => 'Job request No.',
			'date' => 'Date',
			'job-card-number' => 'Job card No.',
			'prepared-by' => 'Processed by',
			'project-number' => 'Project No.',
			'client' => 'Client',
			'contact-person' => 'Contact person',
			'status' => 'Status',
			'job-type' => 'Job type',
			'repair-center' => 'Repair center',
			'technician' => 'Technician(s)',
			'client-vehicle-reg-no' => 'Vehicle reg No.',
			'remarks' => 'Remarks',
			'instructions' => 'Instructions',
			'subtotal' => 'Subtotal',
			'currency' => 'Currency',
		],
	],
	
	'cust-job-cards' => [
		'title' => 'Job cards',
		'fields' => [
		],
	],
	
	'internal-notifications' => [
		'title' => 'Notifications',
		'fields' => [
		],
	],
	
	'inhouse-job-cards' => [
		'title' => 'Job cards',
		'fields' => [
		],
	],
	
	'job-cards' => [
		'title' => 'Job cards',
		'fields' => [
		],
	],
	
	'inhouse-job-cards' => [
		'title' => 'Inhouse job cards',
		'fields' => [
		],
	],
	
	'inhouse-job-cards' => [
		'title' => 'Job cards',
		'fields' => [
		],
	],
	
	'workshop-job-cards' => [
		'title' => 'Job cards',
		'fields' => [
		],
	],
	
	'currency' => [
		'title' => 'Currency',
		'fields' => [
			'name' => 'Name',
			'symbol' => 'Symbol',
		],
	],
	
	'unit-measurements' => [
		'title' => 'Unit measurements',
		'fields' => [
			'measurement-type' => 'Measurement type',
		],
	],
	
	'inhouse-job-cards' => [
		'title' => 'Job cards',
		'fields' => [
			'date' => 'Date',
			'vehicle-type' => 'Vehicle type',
			'mileage' => 'Mileage',
			'job-card-number' => 'Job card No.',
			'prepared-by' => 'Processed by',
			'project-number' => 'Project No.',
			'client-type' => 'Client type',
			'job-card-type' => 'Job card type',
			'job-type' => 'Job type',
			'repair-center' => 'Workshop center',
			'technician' => 'Technician(s)',
			'vehicle' => 'Vehicle reg No.',
			'trailer' => 'Trailer',
			'light-vehicles' => 'Light vehicle',
			'client-vehicle-reg-no' => 'Vehicle reg No.',
			'road-freight-number' => 'Road freight No.',
			'remarks' => 'Job card remarks',
			'instructions' => 'Job card instructions',
			'subtotal' => 'Subtotal',
			'workshop-manager' => 'Workshop manager',
			'status' => 'Status',
		],
	],
	
	'schedule-of-services' => [
		'title' => 'Schedule of services',
		'fields' => [
			'client-type' => 'Client type',
			'client' => 'Client',
			'job-card-number' => 'Job card No.',
			'vehicle' => 'Vehicle',
			'client-vehicle' => 'Vehicle',
			'description' => 'Description',
			'next-service-mileage' => 'Next service mileage',
			'next-service-date' => 'Next service date',
			'status' => 'Status',
			'schedule-number' => 'Schedule No.',
		],
	],
	
	'employee-designations' => [
		'title' => 'Employee designations',
		'fields' => [
		],
	],
	
	'internal-notifications' => [
		'title' => 'Notifications',
		'fields' => [
		],
	],
	
	'internal-notifications' => [
		'title' => 'Notifications',
		'fields' => [
			'text' => 'Text',
			'link' => 'Link',
			'users' => 'Users',
		],
	],
	'app_create' => 'Create',
	'app_save' => 'Save',
	'app_edit' => 'Edit',
	'app_restore' => 'Restore',
	'app_permadel' => 'Delete Permanently',
	'app_all' => 'All',
	'app_trash' => 'Trash',
	'app_view' => 'View',
	'app_update' => 'Update',
	'app_list' => 'List',
	'app_no_entries_in_table' => 'No entries in table',
	'app_custom_controller_index' => 'Custom controller index.',
	'app_logout' => 'Logout',
	'app_add_new' => 'Add new',
	'app_are_you_sure' => 'Are you sure?',
	'app_back_to_list' => 'Back to list',
	'app_dashboard' => 'Dashboard',
	'app_delete' => 'Delete',
	'app_delete_selected' => 'Delete selected',
	'app_category' => 'Category',
	'app_categories' => 'Categories',
	'app_sample_category' => 'Sample category',
	'app_questions' => 'Questions',
	'app_question' => 'Question',
	'app_answer' => 'Answer',
	'app_sample_question' => 'Sample question',
	'app_sample_answer' => 'Sample answer',
	'app_faq_management' => 'FAQ Management',
	'app_administrator_can_create_other_users' => 'Administrator (can create other users)',
	'app_simple_user' => 'Simple user',
	'app_title' => 'Title',
	'app_roles' => 'Roles',
	'app_role' => 'Role',
	'app_user_management' => 'User management',
	'app_users' => 'Users',
	'app_user' => 'User',
	'app_name' => 'Name',
	'app_email' => 'Email',
	'app_password' => 'Password',
	'app_remember_token' => 'Remember token',
	'app_permissions' => 'Permissions',
	'app_user_actions' => 'User actions',
	'app_action' => 'Action',
	'app_action_model' => 'Action model',
	'app_action_id' => 'Action id',
	'app_time' => 'Time',
	'app_campaign' => 'Campaign',
	'app_campaigns' => 'Campaigns',
	'app_description' => 'Description',
	'app_valid_from' => 'Valid from',
	'app_valid_to' => 'Valid to',
	'app_discount_amount' => 'Discount amount',
	'app_discount_percent' => 'Discount percent',
	'app_coupons_amount' => 'Coupons amount',
	'app_coupons' => 'Coupons',
	'app_code' => 'Code',
	'app_redeem_time' => 'Redeem time',
	'app_coupon_management' => 'Coupon Management',
	'app_time_management' => 'Time management',
	'app_projects' => 'Projects',
	'app_reports' => 'Reports',
	'app_time_entries' => 'Time entries',
	'app_work_type' => 'Work type',
	'app_work_types' => 'Work types',
	'app_project' => 'Project',
	'app_start_time' => 'Start time',
	'app_end_time' => 'End time',
	'app_expense_category' => 'Expense Category',
	'app_expense_categories' => 'Expense Categories',
	'app_expense_management' => 'Expense Management',
	'app_expenses' => 'Expenses',
	'app_expense' => 'Expense',
	'app_entry_date' => 'Entry date',
	'app_amount' => 'Amount',
	'app_income_categories' => 'Income categories',
	'app_monthly_report' => 'Monthly report',
	'app_companies' => 'Companies',
	'app_company_name' => 'Company name',
	'app_address' => 'Address',
	'app_website' => 'Website',
	'app_contact_management' => 'Contact management',
	'app_contacts' => 'Contacts',
	'app_company' => 'Company',
	'app_first_name' => 'First name',
	'app_last_name' => 'Last name',
	'app_phone' => 'Phone',
	'app_phone1' => 'Phone 1',
	'app_phone2' => 'Phone 2',
	'app_skype' => 'Skype',
	'app_photo' => 'Photo (max 8mb)',
	'app_category_name' => 'Category name',
	'app_product_management' => 'Product management',
	'app_products' => 'Products',
	'app_product_name' => 'Product name',
	'app_price' => 'Price',
	'app_tags' => 'Tags',
	'app_tag' => 'Tag',
	'app_photo1' => 'Photo1',
	'app_photo2' => 'Photo2',
	'app_photo3' => 'Photo3',
	'app_calendar' => 'Calendar',
	'app_statuses' => 'Statuses',
	'app_task_management' => 'Task management',
	'app_tasks' => 'Tasks',
	'app_status' => 'Status',
	'app_attachment' => 'Attachment',
	'app_due_date' => 'Due date',
	'app_assigned_to' => 'Assigned to',
	'app_assets' => 'Assets',
	'app_asset' => 'Asset',
	'app_serial_number' => 'Serial number',
	'app_location' => 'Location',
	'app_locations' => 'Locations',
	'app_assigned_user' => 'Assigned (user)',
	'app_notes' => 'Notes',
	'app_assets_history' => 'Assets history',
	'app_assets_management' => 'Assets management',
	'app_slug' => 'Slug',
	'app_content_management' => 'Content management',
	'app_text' => 'Text',
	'app_excerpt' => 'Excerpt',
	'app_featured_image' => 'Featured image',
	'app_pages' => 'Pages',
	'app_axis' => 'Axis',
	'app_show' => 'Show',
	'app_group_by' => 'Group by',
	'app_chart_type' => 'Chart type',
	'app_create_new_report' => 'Create new report',
	'app_no_reports_yet' => 'No reports yet.',
	'app_created_at' => 'Created at',
	'app_updated_at' => 'Updated at',
	'app_deleted_at' => 'Deleted at',
	'app_reports_x_axis_field' => 'X-axis - please choose one of date/time fields',
	'app_reports_y_axis_field' => 'Y-axis - please choose one of number fields',
	'app_select_crud_placeholder' => 'Please select one of your CRUDs',
	'app_select_dt_placeholder' => 'Please select one of date/time fields',
	'app_aggregate_function_use' => 'Aggregate function to use',
	'app_x_axis_group_by' => 'X-axis group by',
	'app_x_axis_field' => 'X-axis field (date/time)',
	'app_y_axis_field' => 'Y-axis field',
	'app_integer_float_placeholder' => 'Please select one of integer/float fields',
	'app_change_notifications_field_1_label' => 'Send email notification to User',
	'app_change_notifications_field_2_label' => 'When Entry on CRUD',
	'app_select_users_placeholder' => 'Please select one of your Users',
	'app_is_created' => 'is created',
	'app_is_updated' => 'is updated',
	'app_is_deleted' => 'is deleted',
	'app_notifications' => 'Notifications',
	'app_notify_user' => 'Notify User',
	'app_when_crud' => 'When CRUD',
	'app_create_new_notification' => 'Create new Notification',
	'app_stripe_transactions' => 'Stripe Transactions',
	'app_upgrade_to_premium' => 'Upgrade to Premium',
	'app_messages' => 'Messages',
	'app_you_have_no_messages' => 'You have no messages.',
	'app_all_messages' => 'All Messages',
	'app_new_message' => 'New message',
	'app_outbox' => 'Outbox',
	'app_inbox' => 'Inbox',
	'app_recipient' => 'Recipient',
	'app_subject' => 'Subject',
	'app_message' => 'Message',
	'app_send' => 'Send',
	'app_reply' => 'Reply',
	'app_calendar_sources' => 'Calendar sources',
	'app_new_calendar_source' => 'Create new calendar source',
	'app_crud_title' => 'Crud title',
	'app_crud_date_field' => 'Crud date field',
	'app_prefix' => 'Prefix',
	'app_label_field' => 'Label field',
	'app_suffix' => 'Sufix',
	'app_no_calendar_sources' => 'No calendar sources yet.',
	'app_crud_event_field' => 'Event label field',
	'app_create_new_calendar_source' => 'Create new Calendar Source',
	'app_edit_calendar_source' => 'Edit Calendar Source',
	'app_client_management' => 'Client management',
	'app_client_management_settings' => 'Client management settings',
	'app_country' => 'Country',
	'app_client_status' => 'Client status',
	'app_clients' => 'Clients',
	'app_client_statuses' => 'Client statuses',
	'app_currencies' => 'Currencies',
	'app_main_currency' => 'Main currency',
	'app_documents' => 'Documents',
	'app_file' => 'File',
	'app_income_source' => 'Income source',
	'app_income_sources' => 'Income sources',
	'app_fee_percent' => 'Fee percent',
	'app_note_text' => 'Note text',
	'app_client' => 'Client',
	'app_start_date' => 'Start date',
	'app_budget' => 'Budget',
	'app_project_status' => 'Project status',
	'app_project_statuses' => 'Project statuses',
	'app_transactions' => 'Transactions',
	'app_transaction_types' => 'Transaction types',
	'app_transaction_type' => 'Transaction type',
	'app_transaction_date' => 'Transaction date',
	'app_currency' => 'Currency',
	'app_current_password' => 'Current password',
	'app_new_password' => 'New password',
	'app_password_confirm' => 'New password confirmation',
	'app_dashboard_text' => 'You are logged in!',
	'app_forgot_password' => 'Forgot your password?',
	'app_remember_me' => 'Remember me',
	'app_login' => 'Login',
	'app_change_password' => 'Change password',
	'app_csv' => 'CSV',
	'app_print' => 'Print',
	'app_excel' => 'Excel',
	'app_copy' => 'Copy',
	'app_colvis' => 'Column visibility',
	'app_pdf' => 'PDF',
	'app_reset_password' => 'Reset password',
	'app_reset_password_woops' => '<strong>Whoops!</strong> There were problems with input:',
	'app_email_line1' => 'You are receiving this email because we received a password reset request for your account.',
	'app_email_line2' => 'If you did not request a password reset, no further action is required.',
	'app_email_greet' => 'Hello',
	'app_email_regards' => 'Regards',
	'app_confirm_password' => 'Confirm password',
	'app_if_you_are_having_trouble' => 'If you’re having trouble clicking the',
	'app_copy_paste_url_bellow' => 'button, copy and paste the URL below into your web browser:',
	'app_please_select' => 'Please select',
	'app_register' => 'Register',
	'app_registration' => 'Registration',
	'app_not_approved_title' => 'You are not approved',
	'app_not_approved_p' => 'Your account is still not approved by administrator. Please, be patient and try again later.',
	'app_there_were_problems_with_input' => 'There were problems with input',
	'app_whoops' => 'Whoops!',
	'app_file_contains_header_row' => 'File contains header row?',
	'app_csvImport' => 'CSV Import',
	'app_csv_file_to_import' => 'CSV file to import',
	'app_parse_csv' => 'Parse CSV',
	'app_import_data' => 'Import data',
	'app_imported_rows_to_table' => 'Imported :rows rows to :table table',
	'app_subscription-billing' => 'Subscriptions',
	'app_subscription-payments' => 'Payments',
	'app_basic_crm' => 'Basic CRM',
	'app_customers' => 'Customers',
	'app_customer' => 'Customer',
	'app_select_all' => 'Select all',
	'app_deselect_all' => 'Deselect all',
	'app_team-management' => 'Teams',
	'app_team-management-singular' => 'Team',
	'global_title' => 'Shavaeland',
];