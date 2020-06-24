<?php

namespace App\Http\Controllers\Api\V1;

use App\LoadingInstruction;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreLoadingInstructionsRequest;
use App\Http\Requests\Admin\UpdateLoadingInstructionsRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class LoadingInstructionsController extends Controller
{
    public function index()
    {
        return LoadingInstruction::all();
    }

    public function show($id)
    {
        return LoadingInstruction::findOrFail($id);
    }

    public function update(UpdateLoadingInstructionsRequest $request, $id)
    {
        $loading_instruction = LoadingInstruction::findOrFail($id);
        $loading_instruction->update($request->all());
        
        $loadingRequirements           = $loading_instruction->loading_requirements;
        $currentLoadingRequirementData = [];
        foreach ($request->input('loading_requirements', []) as $index => $data) {
            if (is_integer($index)) {
                $loading_instruction->loading_requirements()->create($data);
            } else {
                $id                          = explode('-', $index)[1];
                $currentLoadingRequirementData[$id] = $data;
            }
        }
        foreach ($loadingRequirements as $item) {
            if (isset($currentLoadingRequirementData[$item->id])) {
                $item->update($currentLoadingRequirementData[$item->id]);
            } else {
                $item->delete();
            }
        }
        $loadDescriptions           = $loading_instruction->load_descriptions;
        $currentLoadDescriptionData = [];
        foreach ($request->input('load_descriptions', []) as $index => $data) {
            if (is_integer($index)) {
                $loading_instruction->load_descriptions()->create($data);
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

        return $loading_instruction;
    }

    public function store(StoreLoadingInstructionsRequest $request)
    {
        $loading_instruction = LoadingInstruction::create($request->all());
        
        foreach ($request->input('loading_requirements', []) as $data) {
            $loading_instruction->loading_requirements()->create($data);
        }
        foreach ($request->input('load_descriptions', []) as $data) {
            $loading_instruction->load_descriptions()->create($data);
        }

        return $loading_instruction;
    }

    public function destroy($id)
    {
        $loading_instruction = LoadingInstruction::findOrFail($id);
        $loading_instruction->delete();
        return '';
    }
}
