<?php
namespace App\Http\Controllers\Admin;

use App\TimeEntry;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TimeReportsController extends Controller
{
    public function index(Request $r)
    {
        $from = Carbon::parse($r->query('from', Carbon::now()));
        $to   = Carbon::parse($r->query('to', Carbon::now()))->endOfDay();

        $projects = TimeEntry::with('project')
            ->whereBetween('start_time', [$from, $to])
            ->get();

        $work_types = TimeEntry::with('work_type')
            ->whereBetween('start_time', [$from, $to])
            ->get();

        $projects_time = [];
        foreach ($projects as $project) {
            $begin = Carbon::parse($project->start_time, 'Europe/Vilnius');
            $end   = Carbon::parse($project->end_time, 'Europe/Vilnius');
            if (!isset($projects_time[$project->project_number])) {
                $projects_time[$project->project_number] = [
                    'name' => $project->project_number,
                    'time' => $begin->diffInSeconds($end),
                ];
            } else {
                $projects_time[$project->project_number]['time'] += $begin->diffInSeconds($end);
            }
        }

        $work_type_time = [];
        foreach ($work_types as $work_type) {
            $begin = Carbon::parse($work_type->start_time, 'Europe/Vilnius');
            $end   = Carbon::parse($work_type->end_time, 'Europe/Vilnius');
            $diff  = $begin->diffInSeconds($end);
            if (!isset($work_type_time[$work_type->work_type->id])) {
                $work_type_time[$work_type->work_type->id] = [
                    'name' => $work_type->work_type->name,
                    'time' => $begin->diffInSeconds($end),
                ];
            } else {
                $work_type_time[$work_type->work_type->id]['time'] += $begin->diffInSeconds($end);
            }
        }

        return view('admin.time_reports.index', compact(
            'projects_time',
            'work_type_time'
        ));
    }
}
