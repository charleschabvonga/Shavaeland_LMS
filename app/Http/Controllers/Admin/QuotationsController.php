<?php

namespace App\Http\Controllers\Admin;

use App\Quotation;
use App\UnitMeasurement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreQuotationsRequest;
use App\Http\Requests\Admin\UpdateQuotationsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class QuotationsController extends Controller
{
    /**
     * Display a listing of Quotation.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('quotation_access')) {
            return abort(401);
        }


                $quotations = Quotation::all();

        return view('admin.quotations.index', compact('quotations'));
    }

    /**
     * Show the form for creating new Quotation.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('quotation_create')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $sales_people = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = Quotation::$enum_status;

        $unit = UnitMeasurement::all();

        $quotation = Quotation::all();
        $quotation_id = $quotation->pluck('id')->last();
        $quotation_number = 'QTE-'.($quotation_id + 1000);
            
        return view('admin.quotations.create', compact('unit', 'quotation_number', 'enum_status', 'clients', 'contact_people', 'sales_people'));
    }

    /**
     * Store a newly created Quotation in storage.
     *
     * @param  \App\Http\Requests\StoreQuotationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreQuotationsRequest $request)
    {
        if (! Gate::allows('quotation_create')) {
            return abort(401);
        }
        $quotation = Quotation::create($request->all());

        for ($i=0; $i < count($request->item_description); $i++) {
            if (isset($request->qty[$i]) && isset($request->unit[$i]) && isset($request->unit_price[$i])) {
                $quotation->invoice_items()->create([
                    'invoice_number_id' => $quotation->id,
                    'item_description' => $request->item_description[$i],
                    'qty' => $request->qty[$i],
                    'unit' => $request->unit[$i],
                    'unit_price' => $request->unit_price[$i],
                    'total' => $request->total[$i]
                ]);
            }
        }

        return redirect()->route('admin.quotations.index');
    }


    /**
     * Show the form for editing Quotation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('quotation_edit')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $sales_people = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $enum_status = Quotation::$enum_status;
            
        $quotation = Quotation::findOrFail($id);

        return view('admin.quotations.edit', compact('quotation', 'enum_status', 'clients', 'contact_people', 'sales_people'));
    }

    /**
     * Update Quotation in storage.
     *
     * @param  \App\Http\Requests\UpdateQuotationsRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateQuotationsRequest $request, $id)
    {
        if (! Gate::allows('quotation_edit')) {
            return abort(401);
        }
        $quotation = Quotation::findOrFail($id);
        $quotation->update($request->all());

        $invoiceItems           = $quotation->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $quotation->invoice_items()->create($data);
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


        return redirect()->route('admin.quotations.index');
    }


    /**
     * Display Quotation.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('quotation_view')) {
            return abort(401);
        }
        
        $clients = \App\TimeProject::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');
        $contact_people = \App\ClientContact::get()->pluck('contact_name', 'id')->prepend(trans('global.app_please_select'), '');
        $sales_people = \App\Employee::get()->pluck('name', 'id')->prepend(trans('global.app_please_select'), '');$invoice_items = \App\InvoiceItem::where('quotation_number_id', $id)->get();$income_categories = \App\IncomeCategory::where('quotation_number_id', $id)->get();

        $quotation = Quotation::findOrFail($id);

        return view('admin.quotations.show', compact('quotation', 'invoice_items', 'income_categories'));
    }


    /**
     * Remove Quotation from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('quotation_delete')) {
            return abort(401);
        }
        $quotation = Quotation::findOrFail($id);
        $quotation->delete();

        return redirect()->route('admin.quotations.index');
    }

    /**
     * Delete all selected Quotation at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('quotation_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Quotation::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }

    public function download($quotation_id)
    {
        $quotation = Quotation::findOrFail($quotation_id);
        $pdf = \PDF::loadView('admin.quotations.pdf', compact('quotation'));
        return $pdf->stream('quotation.pdf');
    }
}
