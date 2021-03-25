<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;

class AgencyController extends Controller
{
    public function index(){
        return view('agency');
    }
}
