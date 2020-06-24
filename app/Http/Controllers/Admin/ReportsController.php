<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Income;
use App\Expense;
use App\InhouseJobCard;
use App\FuelCost;
use App\CreditNote;
use Carbon\Carbon; 

class ReportsController extends Controller
{
    public function income(Request $request)
    {
         if ($request->has('date_filter')) { 
              $parts = explode(' - ' , $request->input('date_filter')); 
              $date_from = Carbon::createFromFormat(config('app.date_format'), $parts[0])->format('Y-m-d');
              $date_to = Carbon::createFromFormat(config('app.date_format'), $parts[1])->format('Y-m-d');
         } else { 
              $date_from = new Carbon('last Monday');
              $date_to = new Carbon('this Sunday');
         } 
        $reportTitle = 'Income';
        $reportLabel = 'SUM';
        $chartType   = 'bar';

        $results = Income::where('entry_date', '>=', $date_from)->where('entry_date', '<=', $date_to)->get()->sortBy('entry_date')->groupBy(function ($entry) {
            if ($entry->entry_date instanceof \Carbon\Carbon) {
                return \Carbon\Carbon::parse($entry->entry_date)->format('Y-m');
            }
            try {
               return \Carbon\Carbon::createFromFormat(config('app.date_format'), $entry->entry_date)->format('Y-m');
            } catch (\Exception $e) {
                 return \Carbon\Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $entry->entry_date)->format('Y-m');
            }        })->map(function ($entries, $group) {
            return $entries->sum('amount');
        });

        return view('admin.reports', compact('reportTitle', 'results', 'chartType', 'reportLabel'));
    }

    public function expenditure(Request $request)
    {
         if ($request->has('date_filter')) { 
              $parts = explode(' - ' , $request->input('date_filter')); 
              $date_from = Carbon::createFromFormat(config('app.date_format'), $parts[0])->format('Y-m-d');
              $date_to = Carbon::createFromFormat(config('app.date_format'), $parts[1])->format('Y-m-d');
         } else { 
              $date_from = new Carbon('last Monday');
              $date_to = new Carbon('this Sunday');
         } 
        $reportTitle = 'Expenditure';
        $reportLabel = 'SUM';
        $chartType   = 'bar';

        $results = Expense::where('entry_date', '>=', $date_from)->where('entry_date', '<=', $date_to)->get()->sortBy('entry_date')->groupBy(function ($entry) {
            if ($entry->entry_date instanceof \Carbon\Carbon) {
                return \Carbon\Carbon::parse($entry->entry_date)->format('Y-m');
            }
            try {
               return \Carbon\Carbon::createFromFormat(config('app.date_format'), $entry->entry_date)->format('Y-m');
            } catch (\Exception $e) {
                 return \Carbon\Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $entry->entry_date)->format('Y-m');
            }        })->map(function ($entries, $group) {
            return $entries->sum('amount');
        });

        return view('admin.reports', compact('reportTitle', 'results', 'chartType', 'reportLabel'));
    }

    public function jobCards(Request $request)
    {
         if ($request->has('date_filter')) { 
              $parts = explode(' - ' , $request->input('date_filter')); 
              $date_from = Carbon::createFromFormat(config('app.date_format'), $parts[0])->format('Y-m-d');
              $date_to = Carbon::createFromFormat(config('app.date_format'), $parts[1])->format('Y-m-d');
         } else { 
              $date_from = new Carbon('last Monday');
              $date_to = new Carbon('this Sunday');
         } 
        $reportTitle = 'Job cards';
        $reportLabel = 'SUM';
        $chartType   = 'bar';

        $results = InhouseJobCard::where('created_at', '>=', $date_from)->where('created_at', '<=', $date_to)->get()->sortBy('created_at')->groupBy(function ($entry) {
            if ($entry->created_at instanceof \Carbon\Carbon) {
                return \Carbon\Carbon::parse($entry->created_at)->format('Y-m');
            }
            try {
               return \Carbon\Carbon::createFromFormat(config('app.date_format'), $entry->created_at)->format('Y-m');
            } catch (\Exception $e) {
                 return \Carbon\Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $entry->created_at)->format('Y-m');
            }        })->map(function ($entries, $group) {
            return $entries->sum('subtotal');
        });

        return view('admin.reports', compact('reportTitle', 'results', 'chartType', 'reportLabel'));
    }

    public function fuelPurchases(Request $request)
    {
         if ($request->has('date_filter')) { 
              $parts = explode(' - ' , $request->input('date_filter')); 
              $date_from = Carbon::createFromFormat(config('app.date_format'), $parts[0])->format('Y-m-d');
              $date_to = Carbon::createFromFormat(config('app.date_format'), $parts[1])->format('Y-m-d');
         } else { 
              $date_from = new Carbon('last Monday');
              $date_to = new Carbon('this Sunday');
         } 
        $reportTitle = 'Fuel purchases';
        $reportLabel = 'SUM';
        $chartType   = 'bar';

        $results = FuelCost::where('created_at', '>=', $date_from)->where('created_at', '<=', $date_to)->get()->sortBy('created_at')->groupBy(function ($entry) {
            if ($entry->created_at instanceof \Carbon\Carbon) {
                return \Carbon\Carbon::parse($entry->created_at)->format('Y-m');
            }
            try {
               return \Carbon\Carbon::createFromFormat(config('app.date_format'), $entry->created_at)->format('Y-m');
            } catch (\Exception $e) {
                 return \Carbon\Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $entry->created_at)->format('Y-m');
            }        })->map(function ($entries, $group) {
            return $entries->sum('qty');
        });

        return view('admin.reports', compact('reportTitle', 'results', 'chartType', 'reportLabel'));
    }

    public function refunds(Request $request)
    {
         if ($request->has('date_filter')) { 
              $parts = explode(' - ' , $request->input('date_filter')); 
              $date_from = Carbon::createFromFormat(config('app.date_format'), $parts[0])->format('Y-m-d');
              $date_to = Carbon::createFromFormat(config('app.date_format'), $parts[1])->format('Y-m-d');
         } else { 
              $date_from = new Carbon('last Monday');
              $date_to = new Carbon('this Sunday');
         } 
        $reportTitle = 'Refunds';
        $reportLabel = 'SUM';
        $chartType   = 'bar';

        $results = CreditNote::where('date', '>=', $date_from)->where('date', '<=', $date_to)->get()->sortBy('date')->groupBy(function ($entry) {
            if ($entry->date instanceof \Carbon\Carbon) {
                return \Carbon\Carbon::parse($entry->date)->format('Y-m');
            }
            try {
               return \Carbon\Carbon::createFromFormat(config('app.date_format'), $entry->date)->format('Y-m');
            } catch (\Exception $e) {
                 return \Carbon\Carbon::createFromFormat(config('app.date_format') . ' H:i:s', $entry->date)->format('Y-m');
            }        })->map(function ($entries, $group) {
            return $entries->sum('paid_to_date');
        });

        return view('admin.reports', compact('reportTitle', 'results', 'chartType', 'reportLabel'));
    }

}
