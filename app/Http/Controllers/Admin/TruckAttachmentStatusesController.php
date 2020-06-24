<?php

namespace App\Http\Controllers\Admin;

use App\TruckAttachmentStatus;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\StoreTruckAttachmentStatusesRequest;
use App\Http\Requests\Admin\UpdateTruckAttachmentStatusesRequest;

use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
class TruckAttachmentStatusesController extends Controller
{
    /**
     * Display a listing of TruckAttachmentStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (! Gate::allows('truck_attachment_status_access')) {
            return abort(401);
        }


        if (request('show_deleted') == 1) {
            if (! Gate::allows('truck_attachment_status_delete')) {
                return abort(401);
            }
            $truck_attachment_statuses = TruckAttachmentStatus::onlyTrashed()->get();
        } else {
            $truck_attachment_statuses = TruckAttachmentStatus::all();
        }

        return view('admin.truck_attachment_statuses.index', compact('truck_attachment_statuses'));
    }

    /**
     * Show the form for creating new TruckAttachmentStatus.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (! Gate::allows('truck_attachment_status_create')) {
            return abort(401);
        }
        return view('admin.truck_attachment_statuses.create');
    }

    /**
     * Store a newly created TruckAttachmentStatus in storage.
     *
     * @param  \App\Http\Requests\StoreTruckAttachmentStatusesRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTruckAttachmentStatusesRequest $request)
    {
        if (! Gate::allows('truck_attachment_status_create')) {
            return abort(401);
        }
        $truck_attachment_status = TruckAttachmentStatus::create($request->all());



        return redirect()->route('admin.truck_attachment_statuses.index');
    }


    /**
     * Show the form for editing TruckAttachmentStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (! Gate::allows('truck_attachment_status_edit')) {
            return abort(401);
        }
        $truck_attachment_status = TruckAttachmentStatus::findOrFail($id);

        return view('admin.truck_attachment_statuses.edit', compact('truck_attachment_status'));
    }

    /**
     * Update TruckAttachmentStatus in storage.
     *
     * @param  \App\Http\Requests\UpdateTruckAttachmentStatusesRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTruckAttachmentStatusesRequest $request, $id)
    {
        if (! Gate::allows('truck_attachment_status_edit')) {
            return abort(401);
        }
        $truck_attachment_status = TruckAttachmentStatus::findOrFail($id);
        $truck_attachment_status->update($request->all());



        return redirect()->route('admin.truck_attachment_statuses.index');
    }


    /**
     * Display TruckAttachmentStatus.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (! Gate::allows('truck_attachment_status_view')) {
            return abort(401);
        }
        $machinery_sizes = \App\MachinerySize::where('attachment_id', $id)->get();$machinery_types = \App\MachineryType::where('attachment_id', $id)->get();$income_expense_calculators = \App\IncomeExpenseCalculator::where('truck_attachment_status_id', $id)->get();$machinery_costs = \App\MachineryCost::where('truck_attachment_status_id', $id)->get();

        $truck_attachment_status = TruckAttachmentStatus::findOrFail($id);

        return view('admin.truck_attachment_statuses.show', compact('truck_attachment_status', 'machinery_sizes', 'machinery_types', 'income_expense_calculators', 'machinery_costs'));
    }


    /**
     * Remove TruckAttachmentStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (! Gate::allows('truck_attachment_status_delete')) {
            return abort(401);
        }
        $truck_attachment_status = TruckAttachmentStatus::findOrFail($id);
        $truck_attachment_status->delete();

        return redirect()->route('admin.truck_attachment_statuses.index');
    }

    /**
     * Delete all selected TruckAttachmentStatus at once.
     *
     * @param Request $request
     */
    public function massDestroy(Request $request)
    {
        if (! Gate::allows('truck_attachment_status_delete')) {
            return abort(401);
        }
        if ($request->input('ids')) {
            $entries = TruckAttachmentStatus::whereIn('id', $request->input('ids'))->get();

            foreach ($entries as $entry) {
                $entry->delete();
            }
        }
    }


    /**
     * Restore TruckAttachmentStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        if (! Gate::allows('truck_attachment_status_delete')) {
            return abort(401);
        }
        $truck_attachment_status = TruckAttachmentStatus::onlyTrashed()->findOrFail($id);
        $truck_attachment_status->restore();

        return redirect()->route('admin.truck_attachment_statuses.index');
    }

    /**
     * Permanently delete TruckAttachmentStatus from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function perma_del($id)
    {
        if (! Gate::allows('truck_attachment_status_delete')) {
            return abort(401);
        }
        $truck_attachment_status = TruckAttachmentStatus::onlyTrashed()->findOrFail($id);
        $truck_attachment_status->forceDelete();

        return redirect()->route('admin.truck_attachment_statuses.index');
    }
}
