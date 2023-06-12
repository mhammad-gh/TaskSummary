<?php

namespace App\Http\Controllers\DashBoard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    public function index()
    {
        return view('DashBoard.tasks');
    }
}
