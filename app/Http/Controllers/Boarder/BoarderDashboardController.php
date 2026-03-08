<?php

namespace App\Http\Controllers\Boarder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BoarderDashboardController extends Controller
{
    //
    public function index()
    {
        return view('boarder.dashboard');
    }

    public function sample()
    {
        return view('boarder.sample');
    }
}
