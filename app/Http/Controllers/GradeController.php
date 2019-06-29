<?php

namespace CEFE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{

    public function getSportClasses($id)
    {
        $sportClasses = DB::table('sport_classes')
            ->select('sport_classes.id', 'sport_classes.name')
            ->whereNull('sport_classes.deleted_at')
            ->where('sport_classes.vacancies', '>', DB::raw('(SELECT COUNT(*) from `student_classes` WHERE `student_classes`.`sport_class_id` = `sport_classes`.`id`  AND `student_classes`.`deleted_at` IS NULL)'))
            ->where('sport_classes.sport_id',$id)
            ->get();

        return response()->json($sportClasses);
    }

    public function getData($sportClass, $evaluation)
    {
        if(request()->ajax())
        {
            $grades = DB::table('students')
                ->join('users', 'users.id', '=', 'students.user_id')
                ->leftJoin('student_classes', function($join){
                    $join->on('student_classes.student_id', '=', 'students.id')
                        ->whereNull('student_classes.deleted_at');
                })
                ->leftJoin('student_grades', function($join) use ($evaluation){
                    $join->on('student_grades.student_id', '=', 'students.id')
                        ->where('student_grades.evaluation_id', $evaluation);
                })
                ->leftJoin('attendances', 'student_grades.evaluation_id', '=', 'attendances.evaluation_id')
                ->leftJoin('recuperations', 'student_grades.id', '=', 'recuperations.student_grade_id')
                ->select('users.id', 'users.name', 'student_grades.grade', 'attendances.attendance', 'recuperations.grade as recuperation_grade', DB::raw("(SELECT `sport_classes`.`name` FROM `sport_classes`  WHERE `student_classes`.`deleted_at` IS NULL AND `sport_classes`.`id` = `student_classes`.`sport_class_id`) AS `sport_class`"))
                ->whereNull('students.deleted_at')
                ->where('student_classes.sport_class_id', $sportClass)
                ->get();

            return DataTables()->of($grades)
                ->addColumn('grade', function($data){
                    $input = '<input name="grade" id="grade" type="text" class="form-control" placeholder="Nota" value="'.$data->grade.'">';
                    return $input;
                })
                ->addColumn('attendance', function($data){
                    $input = '<input name="attendance" id="attendance" type="text" class="form-control" placeholder="Frequência" value="'.$data->attendance.'">';
                    return $input;
                })
                ->addColumn('recuperation', function($data){
                    $disabled = NULL;
                    if($data->grade >= 6 || $data->grade == 0){$disabled = "disabled";};
                    $input = '<input name="recuperation" id="recuperation" type="text" class="form-control" placeholder="Nota de Recuperação" value="'.$data->recuperation_grade.'"'.$disabled.'/>';
                    return $input;
                })
                ->rawColumns(['recuperation', 'grade', 'attendance'])
                ->make(true);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.grades.grades');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
