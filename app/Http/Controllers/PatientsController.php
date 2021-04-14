<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Patient;

class PatientsController extends Controller
{
    public function index(Patient $patient)
    {


        return response()->json($data);

        // return view('patients.index', compact('patients'));
    }

    public function getAllPatients(){
        $patients = $patient::all();
        $data = [
            'code' => 0,
            'data' => $patients
        ];
    }

    public function create()
    {
        return view('patients.create');
    }
}
