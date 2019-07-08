<?php

namespace CEFE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CEFE\Exports\ReportCardExport;
use CEFE\Exports\ReportCardPerSchoolExport;
use Maatwebsite\Excel\Facades\Excel;
use Auth;

class ReportCardController extends Controller
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
        switch (Auth::user()->level) {
        case 3:
            $userId = Auth::user()->id;

            $school = DB::table('users')
                ->select('secretaries.school_id')
                ->join('secretaries', function($join) use($userId) {
                    $join->where('secretaries.secretary_id', $userId);
                })
                ->first();

            return view('dashboard.secretary.report_cards.report_cards')->with(compact('school'));
            break;
        case 4:
            return view('dashboard.admin.report_cards.report_cards');
            break;
        }
    }

    public function export($school_year, $school, $school_class, $evaluation)
    {
        if($school_class != 0) {
            $data = DB::table('evaluations')
                ->select('school_classes.class', 'evaluations.name', 'schools.acronym', 'school_years.school_year')
                ->join('schools', function($join) use($school) {
                    $join->where('schools.id', $school);
                })->join('school_classes',  function($join) use($school_class) {
                    $join->where('school_classes.id', '=', $school_class);
                })
                ->join('school_years', function($join) use($school_year) {
                    $join->where('school_years.id', $school_year);
                })
                ->where('evaluations.id', $evaluation)
                ->first();

            return Excel::download(new ReportCardExport($evaluation, $school, $school_class, $school_year, $data->class)
                ,'Boletim '. $data->school_year .' - '. $data->acronym .' - '. $data->class. ' - '. $data->name.'.xlsx');
        } else {
            $data = DB::table('evaluations')
                ->select('evaluations.name', 'schools.acronym', 'school_years.school_year')
                ->join('schools', function($join) use($school) {
                    $join->where('schools.id', $school);
                })->join('school_years', function($join) use($school_year) {
                    $join->where('school_years.id', $school_year);
                })
                ->where('evaluations.id', $evaluation)
                ->first();

            return Excel::download(new ReportCardPerSchoolExport($evaluation, $school, $school_year)
            ,'Boletim '. $data->school_year .' - '. $data->acronym .' - Todas as Turmas - '. $data->name .'.xlsx');
        }
    }
}
