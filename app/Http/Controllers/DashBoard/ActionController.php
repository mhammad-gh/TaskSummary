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
}
