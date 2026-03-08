<?php

namespace App\Http\Controllers\Boarder;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class BoarderDashboardController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        return view('boarder.dashboard', compact('user'));
    }

    public function sample()
    {
        $user = auth()->user();
        return view('boarder.sample', compact('user'));
    }
}
