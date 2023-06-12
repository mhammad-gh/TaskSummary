<?php
namespace App\Services;

use App\Models\Task;
use Illuminate\Http\Request;

class SummaryService
{
    public function getTask()
    {
        $dailyTasks = Task::where('frequency_type', 'daily')->get();
        $weeklyTasks = Task::where('frequency_type', 'weekly')->get();
        $monthlyTasks = Task::where('frequency_type', 'monthly')->get();
        $All = Task::all()->sum('time');
        $Count = Task::all()->count();

        // Get all ids for each frequency type and sum their time
        $dailySummary = $dailyTasks->groupBy('frequency_type')->map(function ($grouped) {
            return [
                'total_time' => $grouped->sum('time'),
                'tasks' => $grouped
            ];
        });
        $weeklySummary = $weeklyTasks->groupBy('frequency_type')->map(function ($grouped) {
            return [
                'total_time' => $grouped->sum('time'),
                'tasks' => $grouped
            ];
        });
        $monthlySummary = $monthlyTasks->groupBy('frequency_type')->map(function ($grouped) {
            return [
                'total_time' => $grouped->sum('time'),
                'tasks' => $grouped
            ];
        });

        return view('DashBoard.tasks', compact('Count','All','dailySummary', 'weeklySummary', 'monthlySummary'));

    }

    public function storeTask(Request $request)
    {
        $task = new Task();
        $task->title = $request->input('title');
        $task->frequency_type = $request->input('frequency_type');
        $task->time = $request->input('time');
        $task->save();

        return redirect()->route('tasks.index');
    }
}
