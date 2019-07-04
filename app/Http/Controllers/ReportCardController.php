<?php

namespace CEFE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CEFE\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class reportCardController extends Controller
{
    public function getSchoolClasses($id)
    {
        if(request()->ajax()) {
            $sportClasses = DB::table('school_classes')
                ->select('school_classes.id', 'school_classes.class')
                ->where('school_classes.school_id', $id)
                ->get();

            return response()->json($sportClasses);
        }
    }

    public function index()
    {
        return view('dashboard.reportcards.reportcards');
    }

    public function export($evaluation, $school, $school_class, $school_year)
    {
        $data = DB::table('students')
            ->select('school_classes.class', 'evaluations.name', 'schools.acronym')
            ->join('evaluations', function($join) use($evaluation) {
                $join->where('evaluations.id', $evaluation);
            })
            ->join('schools', function($join) use($school) {
                $join->where('schools.id', $school);
            })
            ->join('school_classes',  function($join) use($school_class) {
                $join->where('school_classes.id', '=', $school_class);
            })
            ->first();

        return Excel::download(new UsersExport($evaluation, $school, $school_class, $school_year, $data->class)
            ,'Boletim - '. $data->acronym .' - '. $data->class. ' - '. $data->name.'.xlsx');
    }
}
