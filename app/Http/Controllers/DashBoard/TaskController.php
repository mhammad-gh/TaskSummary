<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use App\Models\Task;
use App\Services\SummaryService;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(SummaryService $Task)
    {
       return $Task->getTask();
    }

    public function store(Request $request,SummaryService $Task)
    {
       return $Task->storeTask($request);
    }
}
