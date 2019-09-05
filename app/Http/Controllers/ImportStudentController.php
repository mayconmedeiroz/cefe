<?php

namespace CEFE\Http\Controllers;

use CEFE\Secretary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use CEFE\Imports\StudentImport;
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
        switch (Auth::user()->level) {
            case 3:

                $school = Secretary::where('secretary_id', Auth::user()->id)->first(['school_id']);

                return view('dashboard.secretary.students.import_students')->with(compact('school'));
                break;
            case 4:
                return view('dashboard.admin.students.import_students');
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
        Excel::import(new StudentImport($request->school_year, $request->school), $request->file('import_students'));
        return response()->json(['success' => "Usuários importados com sucesso."]);
    }
}
