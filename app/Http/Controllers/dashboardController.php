<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class dashboardController extends Controller
{
    function showLandingPage(){
        return(view('home'));
    }

    function showDashboard(){
        return(view('dashboard.dashboard'));
    }
}
