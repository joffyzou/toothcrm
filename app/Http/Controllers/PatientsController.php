<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Patient;

class PatientsController extends Controller
{
    public function index(Patient $patient)
    {
        return view('patients.index');
    }

    public function getAllPatients(Patient $patient){
        $patients = $patient::paginate(19);
        $data = [
            'code' => 0,
            'data' => $patients
        ];

        return response()->json($data);
    }

    public function create()
    {
        return view('patients.create');
    }

    public function show()
    {

    }
}
