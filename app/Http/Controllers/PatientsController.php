<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PatientsController extends Controller
{
    public function create()
    {
        return view('patients.create');
    }
}
