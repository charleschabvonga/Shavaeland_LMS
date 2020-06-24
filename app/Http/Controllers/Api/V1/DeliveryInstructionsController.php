<?php

namespace App\Http\Controllers\Api\V1;

use App\DeliveryInstruction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreDeliveryInstructionsRequest;
use App\Http\Requests\Admin\UpdateDeliveryInstructionsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class DeliveryInstructionsController extends Controller
{
    public function index()
    {
        return DeliveryInstruction::all();
    }

    public function show($id)
    {
        return DeliveryInstruction::findOrFail($id);
    }

    public function update(UpdateDeliveryInstructionsRequest $request, $id)
    {
        $delivery_instruction = DeliveryInstruction::findOrFail($id);
        $delivery_instruction->update($request->all());
        
        $loadDescriptions           = $delivery_instruction->load_descriptions;
        $currentLoadDescriptionData = [];
        foreach ($request->input('load_descriptions', []) as $index => $data) {
            if (is_integer($index)) {
                $delivery_instruction->load_descriptions()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentLoadDescriptionData[$id] = $data;
            }
        }
        foreach ($loadDescriptions as $item) {
            if (isset($currentLoadDescriptionData[$item->id])) {
                $item->update($currentLoadDescriptionData[$item->id]);
            } else {
                $item->delete();
            }
        }

        return $delivery_instruction;
    }

    public function store(StoreDeliveryInstructionsRequest $request)
    {
        $delivery_instruction = DeliveryInstruction::create($request->all());
        
        foreach ($request->input('load_descriptions', []) as $data) {
            $delivery_instruction->load_descriptions()->create($data);
        }

        return $delivery_instruction;
    }

    public function destroy($id)
    {
        $delivery_instruction = DeliveryInstruction::findOrFail($id);
        $delivery_instruction->delete();
        return '';
    }
}
