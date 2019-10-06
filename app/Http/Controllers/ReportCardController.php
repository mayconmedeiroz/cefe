<?php

namespace App\Http\Controllers;

use App\School;
use App\SchoolYear;
use App\Secretary;
use App\Evaluation;
use App\SchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Exports\ReportCardExport;
use App\Exports\ReportCardPerSchoolExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;

class ReportCardController extends Controller
{
    public function getSchoolClasses($id)
    {
        $sportClasses = SchoolClass::where('school_classes.school_id', $id)
            ->get(['school_classes.id', 'school_classes.class']);

        return response()->json($sportClasses);
    }

    public function index()
    {
        $schoolYears = SchoolYear::all();
        $evaluations = Evaluation::all();

        switch (Auth::user()->level) {
            case 3:
                $school = Secretary::where('secretary_id', Auth::user()->id)->first(['school_id']);

                return view('dashboard.secretary.report_cards.report_cards')
                    ->with(compact('schoolYears', 'evaluations', 'school'));

                break;
            case 4:
                $schools = School::all();

                return view('dashboard.admin.report_cards.report_cards')
                    ->with(compact('schoolYears', 'evaluations', 'schools'));

                break;
        }
    }

    public function export($school_year, $school, $school_class, $evaluation)
    {
        $data = DB::table('evaluations')
            ->select('evaluations.name', 'schools.acronym', 'school_years.school_year')
            ->join('schools', function ($join) use ($school) {
                $join->where('schools.id', $school);
            })
            ->join('school_years', function ($join) use ($school_year) {
                $join->where('school_years.id', $school_year);
            })
            ->where('evaluations.id', $evaluation)
            ->when($school_class != 0, function ($query) use ($school_class) {
                return $query->addSelect('school_classes.class')
                    ->join('school_classes', function ($join) use ($school_class) {
                        $join->where('school_classes.id', '=', $school_class);
                    });
            })
            ->first();

        if ($school_class != 0) {
            return Excel::download(new ReportCardExport($evaluation, $school, $school_class, $school_year, $data->class),
            'Boletim '.$data->school_year.' - '.$data->acronym.' - '.$data->class.' - '.$data->name.'.xlsx');
        }

        return Excel::download(new ReportCardPerSchoolExport($evaluation, $school, $school_year),
        'Boletim '.$data->school_year.' - '.$data->acronym.' - Todas as Turmas - '.$data->name.'.xlsx');
    }

    public function studentReportCardIndex()
    {
        $school_years = DB::table('users')
            ->join('student_school_classes', 'users.id', '=', 'student_school_classes.student_id')
            ->join('school_years', 'school_years.id', '=', 'student_school_classes.school_year_id')
            ->select('school_years.id', 'school_years.school_year')
            ->where('users.id', Auth::user()->id)
            ->get();

        $evaluations = Evaluation::all();

        return view('dashboard.student.report_cards')->with(compact('school_years', 'evaluations'));
    }

    public function getStudentReportCard(Request $request)
    {
        $grade = DB::table('users')
            ->leftJoin('student_grades', function ($join) use ($request) {
                $join->on('users.id', '=', 'student_grades.student_id')
                    ->where('student_grades.evaluation_id', $request->evaluationId)
                    ->where('student_grades.school_year_id', $request->schoolYearId);
            })
            ->leftJoin('absences', 'student_grades.id', '=', 'absences.student_grade_id')
            ->leftJoin('recuperations', 'student_grades.id', '=', 'recuperations.student_grade_id')
            ->select('student_grades.grade', 'absences.absences', 'recuperations.grade as recuperation_grade')
            ->where('users.id', Auth::user()->id)
            ->first();

        return response()->json($grade);
    }
}
