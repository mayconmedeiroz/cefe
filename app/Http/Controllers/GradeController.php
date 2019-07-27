<?php

namespace CEFE\Http\Controllers;

use CEFE\Absence;
use CEFE\Evaluation;
use CEFE\Recuperation;
use CEFE\SportClass;
use CEFE\SportClassLesson;
use CEFE\StudentGrade;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

class GradeController extends Controller
{

    public function getSportClasses($id)
    {
        $sportClasses = SportClass::where('sport_classes.sport_id', $id)
            ->get(['sport_classes.id', 'sport_classes.name']);

        return response()->json($sportClasses);
    }

    public function getEvaluationColumns($id)
    {
        $evaluationColumns = Evaluation::findOrFail($id, ['evaluations.attendance', 'evaluations.recuperation']);

        return response()->json($evaluationColumns);
    }

    public function getLessonData($sportClass, $evaluation)
    {
        $lesson = SportClassLesson::where('sport_class_id', $sportClass)
            ->where('evaluation_id', $evaluation)
            ->first();

        return response()->json($lesson);
    }

    public function validation($request)
    {
        $evaluation = Evaluation::FindOrFail($request->evaluation);
        return Validator::make($request->all(),[
            'id' => 'required|numeric',
            'grade' => 'required|numeric|between:0.00,10.00',
            'recuperation_grade' => 'nullable|numeric|between:0.00,10.00',
            'attendance' => 'required_if:'.$evaluation->attendance.',==,1|numeric|between:0,99',
            'evaluation' => 'required|numeric',
        ]);
    }

    public function getData($sportClass, $evaluation)
    {
        if(request()->ajax())
        {
            $grades = DB::table('users')
                ->leftJoin('student_classes', function($join){
                    $join->on('student_classes.student_id', '=', 'users.id')
                        ->whereNull('student_classes.deleted_at');
                })
                ->leftJoin('student_grades', function($join) use ($evaluation){
                    $join->on('student_grades.student_id', '=', 'users.id')
                        ->where('student_grades.evaluation_id', $evaluation);
                })
                ->leftJoin('absences', 'student_grades.id', '=', 'absences.student_grade_id')
                ->leftJoin('recuperations', 'student_grades.id', '=', 'recuperations.student_grade_id')
                ->select('users.id', 'users.name', 'student_grades.grade', 'absences.absences', 'recuperations.grade as recuperation_grade', DB::raw("(SELECT `sport_classes`.`name` FROM `sport_classes`  WHERE `student_classes`.`deleted_at` IS NULL AND `sport_classes`.`id` = `student_classes`.`sport_class_id`) AS `sport_class`"))
                ->whereNull('users.deleted_at')
                ->where('student_classes.sport_class_id', $sportClass);

            return DataTables()->of($grades)
                ->addColumn('grade', function($data){
                    $input = '<input name="grade" type="text" class="form-control grade" value="'.str_replace(".",",", $data->grade).'" required>';
                    return $input;
                })
                ->addColumn('attendance', function($data){
                    $input = '<input name="attendance" type="text" class="form-control attendance" value="'.str_replace(".",",", $data->absences).'" required>';
                    return $input;
                })
                ->addColumn('recuperation', function($data){
                    $disabled = NULL;
                    if($data->grade >= 6 || $data->grade == 0){$disabled = "disabled";};
                    $input = '<input name="recuperation" type="text" class="form-control recuperation" value="'.str_replace(".",",", $data->recuperation_grade).'"'.$disabled.'/>';
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
        switch (Auth::user()->level) {
            case 2:
                $userId = Auth::user()->id;

                $sportClasses = DB::table('sport_classes')
                    ->join('class_teachers', function($join) use($userId) {
                        $join->on('class_teachers.class_id', '=', 'sport_classes.id')
                            ->where('class_teachers.teacher_id', $userId)
                            ->whereNull('class_teachers.deleted_at');
                    })
                    ->get();

                return view('dashboard.teacher.grades.grades')->with(compact('sportClasses'));
                break;
            case 4:
                return view('dashboard.admin.grades.grades');
                break;
        }
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
            ->where('school_year_id', $request->school_year)
            ->first();

        if($studentGrade) {

            $studentGrade = [
                'grade' => $request->grade
            ];

            $gradeId = StudentGrade::where('student_id', $request->id)
                ->where('evaluation_id', $request->evaluation)
                ->where('school_year_id', $request->school_year)
                ->first();

            $gradeId->update($studentGrade);

        } else {
            $studentGrade = [
                'student_id' => $request->id,
                'evaluation_id' => $request->evaluation,
                'grade' => $request->grade,
                'school_year_id' => $request->school_year,
            ];

            $gradeId = StudentGrade::create($studentGrade);
        }

        if($evaluation->attendance) {
            $absences = DB::table('absences')
                ->where('student_grade_id', $gradeId->id)
                ->first();

            if ($absences) {
                $absences = [
                    'absences' => $request->attendance
                ];

                Absence::where('student_grade_id', $gradeId->id)->update($absences);

            } else {
                $absences = [
                    'student_grade_id' => $gradeId->id,
                    'absences' => $request->attendance,
                ];

                Absence::create($absences);
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

    public function storeLesson(Request $request)
    {
        $error = Validator::make($request->all(),[
            'planned_classes' => 'required|numeric',
            'classes_held' => 'required|numeric',
        ]);

        if ($error->fails())
            return response()->json(['errors' => $error->errors()->all()]);

        $lessons = SportClassLesson::where('sport_class_id', $request->sport_class)
                    ->where('evaluation_id', $request->evaluation)
                    ->first();

        if($lessons) {
            $lessons = [
                'planned_classes' => $request->planned_classes,
                'classes_held' => $request->classes_held
            ];

            SportClassLesson::where('sport_class_id', $request->sport_class)
                ->where('evaluation_id', $request->evaluation)
                ->update($lessons);

        } else {
            $lessons = [
                'sport_class_id' => $request->sport_class,
                'evaluation_id' => $request->evaluation,
                'planned_classes' => $request->planned_classes,
                'classes_held' => $request->classes_held,
            ];

            SportClassLesson::create($lessons);
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
