<?php

namespace App\Http\Controllers\Api\V1;

use App\ClearanceAndForwarding;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreClearanceAndForwardingsRequest;
use App\Http\Requests\Admin\UpdateClearanceAndForwardingsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class ClearanceAndForwardingsController extends Controller
{
    public function index()
    {
        return ClearanceAndForwarding::all();
    }

    public function show($id)
    {
        return ClearanceAndForwarding::findOrFail($id);
    }

    public function update(UpdateClearanceAndForwardingsRequest $request, $id)
    {
        $clearance_and_forwarding = ClearanceAndForwarding::findOrFail($id);
        $clearance_and_forwarding->update($request->all());
        
        $invoiceItems           = $clearance_and_forwarding->invoice_items;
        $currentInvoiceItemData = [];
        foreach ($request->input('invoice_items', []) as $index => $data) {
            if (is_integer($index)) {
                $clearance_and_forwarding->invoice_items()->create($data);
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

        return $clearance_and_forwarding;
    }

    public function store(StoreClearanceAndForwardingsRequest $request)
    {
        $clearance_and_forwarding = ClearanceAndForwarding::create($request->all());
        
        foreach ($request->input('invoice_items', []) as $data) {
            $clearance_and_forwarding->invoice_items()->create($data);
        }

        return $clearance_and_forwarding;
    }

    public function destroy($id)
    {
        $clearance_and_forwarding = ClearanceAndForwarding::findOrFail($id);
        $clearance_and_forwarding->delete();
        return '';
    }
}
