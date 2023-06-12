<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Models\Action;
use App\Models\Task;
use App\Services\ActionService;
use Illuminate\Http\Request;

class ActionController extends Controller
{
    public function store(Request $request, Task $task,ActionService $Action)
    {
        return $Action->storeAction($request,$task);
    }

    public function newc(request $request)
    {
        $task = Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'frequency' => $request->frequency
        ]);

        $time = 0;
        foreach ($request->actions as $action) {
            $type = $action['type'];
            if ($type === 'reading') {
                $task->actions()->create([
                    'type' => 'reading',
                    'reading' => $action['reading'],
                    'time' => $action['time']
                ]);
                $time += $action['time'];
            } else {
                $task->actions()->create([
                    'type' => 'action',
                    'result' => $action['result'],
                    'time' => $action['time']
                ]);
                $time += $action['time'];
            }
        }

        $task->update(['time' => $time]);

        return redirect()->back()->with('success', 'Task added successfully!');
    }
}
