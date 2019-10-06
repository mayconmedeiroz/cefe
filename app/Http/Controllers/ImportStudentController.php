<?php

namespace App\Http\Controllers;

use App\SchoolYear;
use App\Secretary;
use App\School;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Imports\StudentImport;
use Maatwebsite\Excel\Facades\Excel;

class ImportStudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $school_years = SchoolYear::get(['id', 'school_year']);

        switch (Auth::user()->level) {
            case 3:

                $school = Secretary::where('secretary_id', Auth::user()->id)->first(['school_id']);

                return view('dashboard.secretary.students.import_students')->with(compact('school_years', 'school'));
                break;
            case 4:

                $schools = School::get();

                return view('dashboard.admin.students.import_students')->with(compact('school_years', 'schools'));
                break;
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            Excel::import(new StudentImport($request->school_year, $request->school), $request->file('import_students'));

            return response()->json(['error' => false, 'messages' => "Estudantes importados com sucesso."]);

        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $message = '';

            foreach ($failures as $failure) {
                $message .= 'Erro na linha ' . $failure->row() . ' do excel. ' . implode($failure->errors(), '. ') . '<br/>';
            }

            return response()->json(['error' => true, 'messages' => $message]);
        }
    }
}
