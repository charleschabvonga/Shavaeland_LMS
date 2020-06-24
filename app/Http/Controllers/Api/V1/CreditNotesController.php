<?php

namespace App\Http\Controllers\Api\V1;

use App\CreditNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreCreditNotesRequest;
use App\Http\Requests\Admin\UpdateCreditNotesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class CreditNotesController extends Controller
{
    public function index()
    {
        return CreditNote::all();
    }

    public function show($id)
    {
        return CreditNote::findOrFail($id);
    }

    public function update(UpdateCreditNotesRequest $request, $id)
    {
        $credit_note = CreditNote::findOrFail($id);
        $credit_note->update($request->all());
        
        $invoiceItems           = $credit_note->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $credit_note->invoice_items()->create($data);
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

        return $credit_note;
    }

    public function store(StoreCreditNotesRequest $request)
    {
        $credit_note = CreditNote::create($request->all());
        
        foreach ($request->input('invoice_items', []) as $data) {
            $credit_note->invoice_items()->create($data);
        }

        return $credit_note;
    }

    public function destroy($id)
    {
        $credit_note = CreditNote::findOrFail($id);
        $credit_note->delete();
        return '';
    }
}
