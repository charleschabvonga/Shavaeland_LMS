<?php

namespace App\Http\Controllers\Api\V1;

use App\DebitNote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDebitNotesRequest;
use App\Http\Requests\Admin\UpdateDebitNotesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DebitNotesController extends Controller
{
    public function index()
    {
        return DebitNote::all();
    }

    public function show($id)
    {
        return DebitNote::findOrFail($id);
    }

    public function update(UpdateDebitNotesRequest $request, $id)
    {
        $debit_note = DebitNote::findOrFail($id);
        $debit_note->update($request->all());
        
        $invoiceItems           = $debit_note->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $debit_note->invoice_items()->create($data);
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

        return $debit_note;
    }

    public function store(StoreDebitNotesRequest $request)
    {
        $debit_note = DebitNote::create($request->all());
        
        foreach ($request->input('invoice_items', []) as $data) {
            $debit_note->invoice_items()->create($data);
        }

        return $debit_note;
    }

    public function destroy($id)
    {
        $debit_note = DebitNote::findOrFail($id);
        $debit_note->delete();
        return '';
    }
}
