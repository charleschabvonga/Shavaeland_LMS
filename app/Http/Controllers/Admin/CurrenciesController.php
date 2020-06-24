<?php

namespace App\Http\Controllers\Admin;

use App\Currency;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCurrenciesRequest;
use App\Http\Requests\Admin\UpdateCurrenciesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CurrenciesController extends Controller
{
    /**
     * Display a listing of Currency.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('currency_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('currency_delete')) {
                return abort(401);
            }
            $currencies = Currency::onlyTrashed()->get();
        } else {
            $currencies = Currency::all();
        }

        return view('admin.currencies.index', compact('currencies'));
    }

    /**
     * Show the form for creating new Currency.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('currency_create')) {
            return abort(401);
        }
        return view('admin.currencies.create');
    }

    /**
     * Store a newly created Currency in storage.
     *
     * @param  \App\Http\Requests\StoreCurrenciesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCurrenciesRequest $request)
    {
        if (! Gate::allows('currency_create')) {
            return abort(401);
        }
        $currency = Currency::create($request->all());



        return redirect()->route('admin.currencies.index');
    }


    /**
     * Show the form for editing Currency.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('currency_edit')) {
            return abort(401);
        }
        $currency = Currency::findOrFail($id);

        return view('admin.currencies.edit', compact('currency'));
    }

    /**
     * Update Currency in storage.
     *
     * @param  \App\Http\Requests\UpdateCurrenciesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCurrenciesRequest $request, $id)
    {
        if (! Gate::allows('currency_edit')) {
            return abort(401);
        }
        $currency = Currency::findOrFail($id);
        $currency->update($request->all());



        return redirect()->route('admin.currencies.index');
    }


    /**
     * Display Currency.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('currency_view')) {
            return abort(401);
        }
        $fuel_costs = \App\FuelCost::where('currency_id', $id)->get();$quotations = \App\Quotation::where('currency_id', $id)->get();$vendor_bank_payments = \App\VendorBankPayment::where('currency_id', $id)->get();$bank_payments = \App\BankPayment::where('currency_id', $id)->get();$expenses = \App\Expense::where('currency_id', $id)->get();$client_job_cards = \App\ClientJobCard::where('currency_id', $id)->get();$incomes = \App\Income::where('currency_id', $id)->get();$purchase_orders = \App\PurchaseOrder::where('currency_id', $id)->get();$debit_notes = \App\DebitNote::where('currency_id', $id)->get();$credit_notes = \App\CreditNote::where('currency_id', $id)->get();$income_categories = \App\IncomeCategory::where('currency_id', $id)->get();$expense_categories = \App\ExpenseCategory::where('currency_id', $id)->get();

        $currency = Currency::findOrFail($id);

        return view('admin.currencies.show', compact('currency', 'fuel_costs', 'quotations', 'vendor_bank_payments', 'bank_payments', 'expenses', 'client_job_cards', 'incomes', 'purchase_orders', 'debit_notes', 'credit_notes', 'income_categories', 'expense_categories'));
    }


    /**
     * Remove Currency from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('currency_delete')) {
            return abort(401);
        }
        $currency = Currency::findOrFail($id);
        $currency->delete();

        return redirect()->route('admin.currencies.index');
    }

    /**
     * Delete all selected Currency at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('currency_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = Currency::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore Currency from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('currency_delete')) {
            return abort(401);
        }
        $currency = Currency::onlyTrashed()->findOrFail($id);
        $currency->restore();

        return redirect()->route('admin.currencies.index');
    }

    /**
     * Permanently delete Currency from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('currency_delete')) {
            return abort(401);
        }
        $currency = Currency::onlyTrashed()->findOrFail($id);
        $currency->forceDelete();

        return redirect()->route('admin.currencies.index');
    }
}
