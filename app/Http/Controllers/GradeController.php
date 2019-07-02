<?php

namespace CEFE\Http\Controllers;

use CEFE\Attendance;
use CEFE\Evaluation;
use CEFE\Recuperation;
use CEFE\StudentGrade;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GradeController extends Controller
{

    public function getSportClasses($id)
    {
        if(request()->ajax()) {
            $sportClasses = DB::table('sport_classes')
                ->select('sport_classes.id', 'sport_classes.name')
                ->whereNull('sport_classes.deleted_at')
                ->where('sport_classes.vacancies', '>', DB::raw('(SELECT COUNT(*) from `student_classes` WHERE `student_classes`.`sport_class_id` = `sport_classes`.`id`  AND `student_classes`.`deleted_at` IS NULL)'))
                ->where('sport_classes.sport_id', $id)
                ->get();

            return response()->json($sportClasses);
        }
    }

    public function getEvaluationColumns($id)
    {
        if(request()->ajax()) {
            $evaluationColumns = DB::table('evaluations')
                ->select('evaluations.attendance', 'evaluations.recuperation')
                ->where('evaluations.id', $id)
                ->first();

            return response()->json($evaluationColumns);
        }
    }

    public function validation($request)
    {
        $evaluation = Evaluation::FindOrFail($request->evaluation);
        return Validator::make($request->all(),[
            'id' => 'required|numeric',
            'grade' => 'required|numeric|between:0.00,10.00',
            'recuperation_grade' => 'nullable|numeric|between:0.00,10.00',
            'attendance' => 'required_if:'.$evaluation->attendance.',==,1|numeric|between:0.00,100.00',
            'evaluation' => 'required|numeric',
        ]);
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
                ->leftJoin('attendances', function($join) use ($evaluation){
                    $join->on('attendances.student_id', '=', 'students.id')
                        ->where('attendances.evaluation_id', $evaluation);
                })
                ->leftJoin('recuperations', 'student_grades.id', '=', 'recuperations.student_grade_id')
                ->select('students.id', 'users.name', 'student_grades.grade', 'attendances.attendance', 'recuperations.grade as recuperation_grade', DB::raw("(SELECT `sport_classes`.`name` FROM `sport_classes`  WHERE `student_classes`.`deleted_at` IS NULL AND `sport_classes`.`id` = `student_classes`.`sport_class_id`) AS `sport_class`"))
                ->whereNull('students.deleted_at')
                ->where('student_classes.sport_class_id', $sportClass)
                ->get();

            return DataTables()->of($grades)
                ->addColumn('grade', function($data){
                    $input = '<input name="grade" type="text" class="form-control grade" placeholder="Nota" value="'.str_replace(".",",", $data->grade).'" required>';
                    return $input;
                })
                ->addColumn('attendance', function($data){
                    $input = '<input name="attendance" type="text" class="form-control attendance" placeholder="Frequência" value="'.str_replace(".",",", $data->attendance).'" required>';
                    return $input;
                })
                ->addColumn('recuperation', function($data){
                    $disabled = NULL;
                    if($data->grade >= 6 || $data->grade == 0){$disabled = "disabled";};
                    $input = '<input name="recuperation" type="text" class="form-control recuperation" placeholder="Nota de Recuperação" value="'.str_replace(".",",", $data->recuperation_grade).'"'.$disabled.'/>';
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
        $error = $this->validation($request);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $gradeId = NULL;
        $evaluation = Evaluation::FindOrFail($request->evaluation);

        $studentGrade = DB::table('student_grades')
            ->where('student_id', $request->id)
            ->where('evaluation_id', $request->evaluation)
            ->first();

        if($studentGrade) {

            $studentGrade = [
                'grade' => $request->grade
            ];

            $gradeId = StudentGrade::where('student_id', $request->id)->where('evaluation_id', $request->evaluation)->first();
            $gradeId->update($studentGrade);

        } else {
            $studentGrade = [
                'student_id' => $request->id,
                'evaluation_id' => $request->evaluation,
                'grade' => $request->grade,
                'school_year' => NOW(),
            ];

            $gradeId = StudentGrade::create($studentGrade);
        }

        if($evaluation->attendance) {
            $attendance = DB::table('attendances')
                ->where('student_id', $request->id)
                ->where('evaluation_id', $request->evaluation)
                ->first();

            if ($attendance) {
                $attendance = [
                    'attendance' => $request->attendance
                ];

                Attendance::where('student_id', $request->id)->where('evaluation_id', $request->evaluation)->update($attendance);

            } else {
                $attendance = [
                    'student_id' => $request->id,
                    'evaluation_id' => $request->evaluation,
                    'attendance' => $request->attendance,
                    'school_year' => NOW(),
                ];

                Attendance::create($attendance);
            }
        }

        if(isset($request->recuperation_grade) && $evaluation->recuperation) {
            $recuperation = DB::table('recuperations')
                        ->where('student_grade_id', $gradeId->id)
                        ->first();

            if($recuperation) {
                $recuperationGrade = [
                    'grade' => $request->recuperation_grade
                ];

                Recuperation::where('student_grade_id', $gradeId->id)->update($recuperationGrade);
            } else {
                $recuperationGrade = [
                    'student_grade_id' => $gradeId->id,
                    'grade' => $request->recuperation_grade
                ];

                Recuperation::create($recuperationGrade);
            }
        }

        return response()->json(['success' => 'Notas cadastradas com sucesso.']);
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
