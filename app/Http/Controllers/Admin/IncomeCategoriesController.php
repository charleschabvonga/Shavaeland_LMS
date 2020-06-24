<?php

namespace App\Http\Controllers\Admin;

use App\IncomeCategory;
use App\UnitMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreIncomeCategoriesRequest;
use App\Http\Requests\Admin\UpdateIncomeCategoriesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class IncomeCategoriesController extends Controller
{
    /**
     * Display a listing of IncomeCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('income_category_access')) {
            return abort(401);
        }


                $income_categories = IncomeCategory::all();

        return view('admin.income_categories.index', compact('income_categories'));
    }

    /**
     * Show the form for creating new IncomeCategory.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('income_category_create')) {
            return abort(401);
        }
        
        $project_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $quotation_numbers = \App\Quotation::get()->pluck('quotation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = IncomeCategory::$enum_status;

        $unit = UnitMeasurement::all();

        $invoice = IncomeCategory::all();
        $invoice_id = $invoice->pluck('id')->last();
        $invoice_number = 'INV-'.($invoice_id + 1000);
            
        return view('admin.income_categories.create', compact('unit', 'invoice_number', 'enum_status', 'project_types', 'project_numbers', 'clients', 'contact_people', 'account_managers', 'quotation_numbers'));
    }

    /**
     * Store a newly created IncomeCategory in storage.
     *
     * @param  \App\Http\Requests\StoreIncomeCategoriesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreIncomeCategoriesRequest $request)
    {
        if (! Gate::allows('income_category_create')) {
            return abort(401);
        }
        $income_category = IncomeCategory::create($request->all());

        for ($i=0; $i < count($request->item_description); $i++) {
            if (isset($request->qty[$i]) && isset($request->unit[$i]) && isset($request->unit_price[$i])) {
                $income_category->invoice_items()->create([
                    'invoice_number_id' => $income_category->id,
                    'item_description' => $request->item_description[$i],
                    'qty' => $request->qty[$i],
                    'unit' => $request->unit[$i],
                    'unit_price' => $request->unit_price[$i],
                    'total' => $request->total[$i]
                ]);
            }
        }

        return redirect()->route('admin.income_categories.index');
    }


    /**
     * Show the form for editing IncomeCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('income_category_edit')) {
            return abort(401);
        }
        
        $project_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $quotation_numbers = \App\Quotation::get()->pluck('quotation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = IncomeCategory::$enum_status;

        $invoice = IncomeCategory::all();
        $invoice_id = $invoice->pluck('id')->last();
        $invoice_number = 'INV-'.($invoice_id + 1000);
            
        $income_category = IncomeCategory::findOrFail($id);

        return view('admin.income_categories.edit', compact('invoice_number', 'income_category', 'enum_status', 'project_types', 'project_numbers', 'clients', 'contact_people', 'account_managers', 'quotation_numbers'));
    }

    /**
     * Update IncomeCategory in storage.
     *
     * @param  \App\Http\Requests\UpdateIncomeCategoriesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateIncomeCategoriesRequest $request, $id)
    {
        if (! Gate::allows('income_category_edit')) {
            return abort(401);
        }
        $income_category = IncomeCategory::findOrFail($id);
        $income_category->update($request->all());

        $invoiceItems           = $income_category->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $income_category->invoice_items()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentInvoiceItemData[$id] = $data;
            }
        }
        foreach ($invoiceItems as $item) {
            if (isset($currentInvoiceItemData[$item->id])) {
                $item->update($currentInvoiceItemData[$item->id]);
            } else {
                $item->delete();
            }
        }


        return redirect()->route('admin.income_categories.index');
    }


    /**
     * Display IncomeCategory.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('income_category_view')) {
            return abort(401);
        }
        
        $project_types = \App\TimeWorkType::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $project_numbers = \App\TimeEntry::get()->pluck('operation_number', 'id')->prepend(trans('global.app_please_select'), '');
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $account_managers = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $quotation_numbers = \App\Quotation::get()->pluck('quotation_number', 'id')->prepend(trans('global.app_please_select'), '');$invoice_items = \App\InvoiceItem::where('invoice_number_id', $id)->get();$credit_notes = \App\CreditNote::where('invoice_number_id', $id)->get();$incomes = \App\Income::where('invoice_number_id', $id)->get();

        $income_category = IncomeCategory::findOrFail($id);

        return view('admin.income_categories.show', compact('income_category', 'invoice_items', 'credit_notes', 'incomes'));
    }


    /**
     * Remove IncomeCategory from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('income_category_delete')) {
            return abort(401);
        }
        $income_category = IncomeCategory::findOrFail($id);
        $income_category->delete();

        return redirect()->route('admin.income_categories.index');
    }

    /**
     * Delete all selected IncomeCategory at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('income_category_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = IncomeCategory::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function download($income_category_id)
    {
        $income_category = IncomeCategory::findOrFail($income_category_id);
        $pdf = \PDF::loadView('admin.income_categories.pdf', compact('income_category'));
        return $pdf->stream('income_category.pdf');
    }  

}
