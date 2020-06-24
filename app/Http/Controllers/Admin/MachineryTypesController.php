<?php

namespace App\Http\Controllers\Admin;

use App\MachineryType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreMachineryTypesRequest;
use App\Http\Requests\Admin\UpdateMachineryTypesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class MachineryTypesController extends Controller
{
    /**
     * Display a listing of MachineryType.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('machinery_type_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('machinery_type_delete')) {
                return abort(401);
            }
            $machinery_types = MachineryType::onlyTrashed()->get();
        } else {
            $machinery_types = MachineryType::all();
        }

        return view('admin.machinery_types.index', compact('machinery_types'));
    }

    /**
     * Show the form for creating new MachineryType.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('machinery_type_create')) {
            return abort(401);
        }
        
        $attachments = \App\TruckAttachmentStatus::get()->pluck('attachment', 'id')->prepend(trans('global.app_please_select'), '');

        return view('admin.machinery_types.create', compact('attachments'));
    }

    /**
     * Store a newly created MachineryType in storage.
     *
     * @param  \App\Http\Requests\StoreMachineryTypesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMachineryTypesRequest $request)
    {
        if (! Gate::allows('machinery_type_create')) {
            return abort(401);
        }
        $machinery_type = MachineryType::create($request->all());



        return redirect()->route('admin.machinery_types.index');
    }


    /**
     * Show the form for editing MachineryType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('machinery_type_edit')) {
            return abort(401);
        }
        
        $attachments = \App\TruckAttachmentStatus::get()->pluck('attachment', 'id')->prepend(trans('global.app_please_select'), '');

        $machinery_type = MachineryType::findOrFail($id);

        return view('admin.machinery_types.edit', compact('machinery_type', 'attachments'));
    }

    /**
     * Update MachineryType in storage.
     *
     * @param  \App\Http\Requests\UpdateMachineryTypesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMachineryTypesRequest $request, $id)
    {
        if (! Gate::allows('machinery_type_edit')) {
            return abort(401);
        }
        $machinery_type = MachineryType::findOrFail($id);
        $machinery_type->update($request->all());



        return redirect()->route('admin.machinery_types.index');
    }


    /**
     * Display MachineryType.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('machinery_type_view')) {
            return abort(401);
        }
        
        $attachments = \App\TruckAttachmentStatus::get()->pluck('attachment', 'id')->prepend(trans('global.app_please_select'), '');$trailers = \App\Trailer::where('trailer_type_id', $id)->get();$income_expense_calculators = \App\IncomeExpenseCalculator::where('machinery_attachment_type_id', $id)->get();$machinery_costs = \App\MachineryCost::where('machinery_attachment_type_id', $id)->get();

        $machinery_type = MachineryType::findOrFail($id);

        return view('admin.machinery_types.show', compact('machinery_type', 'trailers', 'income_expense_calculators', 'machinery_costs'));
    }


    /**
     * Remove MachineryType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('machinery_type_delete')) {
            return abort(401);
        }
        $machinery_type = MachineryType::findOrFail($id);
        $machinery_type->delete();

        return redirect()->route('admin.machinery_types.index');
    }

    /**
     * Delete all selected MachineryType at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('machinery_type_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = MachineryType::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore MachineryType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('machinery_type_delete')) {
            return abort(401);
        }
        $machinery_type = MachineryType::onlyTrashed()->findOrFail($id);
        $machinery_type->restore();

        return redirect()->route('admin.machinery_types.index');
    }

    /**
     * Permanently delete MachineryType from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('machinery_type_delete')) {
            return abort(401);
        }
        $machinery_type = MachineryType::onlyTrashed()->findOrFail($id);
        $machinery_type->forceDelete();

        return redirect()->route('admin.machinery_types.index');
    }
}
