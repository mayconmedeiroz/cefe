<?php

namespace CEFE\Http\Controllers;

use Illuminate\Http\Request;
use CEFE\Imports\StudentImport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

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
                $userId = Auth::user()->id;

                $school = DB::table('users')
                    ->select('secretaries.school_id')
                    ->join('secretaries', function($join) use($userId) {
                        $join->where('secretaries.secretary_id', $userId);
                    })
                    ->first();
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
