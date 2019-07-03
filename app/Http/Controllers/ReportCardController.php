<?php

namespace CEFE\Http\Controllers;

use Illuminate\Http\Request;

class reportCardController extends Controller
{
    public function index()
    {
        return view('dashboard.reportcards.reportcards');
    }
}
