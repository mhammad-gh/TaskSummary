<?php
namespace App\Services;

use App\Models\Action;
use App\Models\Task;
use Illuminate\Http\Request;


class ActionService
{
    public function storeAction(Request $request, Task $task)
    {
        $validatedData = $request->validate([
            'type' => 'required',
            'time' => 'required|integer',
        ]);

        $action = new Action();
        $action->type = $validatedData['type'];
        $action->time = $validatedData['time'];
        if ($validatedData['type'] == 'action') {
            $action->result = $request->input('result');
        }
        $task->actions()->save($action);

        return redirect()->back();
    }
}
