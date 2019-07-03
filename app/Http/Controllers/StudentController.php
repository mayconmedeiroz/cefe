<?php

namespace CEFE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use DataTables;
use Hash;
use CEFE\Student;
use CEFE\User;
use CEFE\School;
use CEFE\Sport;
use CEFE\Grade;
use CEFE\StudentClass;
use CEFE\StudentSchoolClass;

class StudentController extends Controller
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

    public function getSchoolClasses($id)
    {
        $schoolClasses = DB::table('school_classes')
            ->select('school_classes.id', 'school_classes.class')
            ->where('school_classes.school_id',$id)
            ->get();

        return response()->json($schoolClasses);
    }

    public function validation($request)
    {
        $id = $request->hidden_id;
        return Validator::make($request->all(), [
            'enrollment' => 'required|max:20|unique:users,enrollment,' . $id,
            'name' => 'required|max:64',
            'email' => 'required|email|max:50|unique:users,email,' . $id,
            'password' => 'required_if:action,==,add|max:60',
            'school' => 'required',
            'school_class' => 'required|max:4',
            'class_number' => 'required|max:2',
            'sport_class' => 'required',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sports = Sport::all();
        $schools = School::all();
        return view('dashboard.students.students')->with(compact('schools', 'sports'));
    }

    public function getData()
    {
        if(request()->ajax())
        {
            $users = DB::table('students')
                ->join('users', 'users.id', '=', 'students.user_id')
                ->join('student_school_classes', 'students.id', '=', 'student_school_classes.student_id')
                ->join('school_classes', 'student_school_classes.school_class_id', '=', 'school_classes.id')
                ->join('schools', 'school_classes.school_id', '=', 'schools.id')
                ->leftJoin('student_classes', function($join){
                    $join->on('student_classes.student_id', '=', 'students.id')
                         ->whereNull('student_classes.deleted_at');
                })
                ->leftJoin('sport_classes', 'sport_classes.id', '=', 'student_classes.sport_class_id')
                ->select('students.id', 'users.enrollment', 'users.name', 'schools.acronym', 'school_classes.class', 'student_school_classes.class_number', DB::raw("(SELECT `sport_classes`.`name` FROM `sport_classes`  WHERE `student_classes`.`deleted_at` IS NULL AND `sport_classes`.`id` = `student_classes`.`sport_class_id`) AS `sport_class`"))
                ->whereNull('students.deleted_at')
                ->get();

            return DataTables()->of($users)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm mr-lg-2"><i class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
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
            return response()->json(['errors' => 'Falha na solicitação, tente novamente!']);
        }

        $user = [
            'enrollment' => $request->enrollment,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ];

        $userId = User::create($user);

        $student = [
            'user_id' => $userId->id,
        ];

        $studentId = Student::create($student);

        $studentSchoolClass = [
            'student_id' => $studentId->id,
            'school_class_id' => $request->school_class,
            'class_number' => $request->class_number,
            'school_year' => NOW(),
        ];

        StudentSchoolClass::create($studentSchoolClass);

        $studentClass = [
            'student_id' => $studentId->id,
            'sport_class_id' => $request->sport_class,
            'school_year' => NOW()
        ];

        StudentClass::create($studentClass);

        return response()->json(['success' => 'Aluno adicionado com sucesso.']);
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
        if(request()->ajax())
        {
            $data = DB::table('students')
                ->join('users', 'users.id', '=', 'students.user_id')
                ->join('student_school_classes', 'students.id', '=', 'student_school_classes.student_id')
                ->join('school_classes', 'student_school_classes.school_class_id', '=', 'school_classes.id')
                ->join('schools', 'school_classes.school_id', '=', 'schools.id')
                ->leftJoin('student_classes', function($join){
                    $join->on('student_classes.student_id', '=', 'students.id')
                        ->whereNull('student_classes.deleted_at');
                })
                ->leftJoin('sport_classes', 'sport_classes.id', '=', 'student_classes.sport_class_id')
                ->leftJoin('sports', 'sports.id', '=', 'sport_classes.sport_id')
                ->select('users.id', 'users.enrollment', 'users.name', 'users.email', 'school_classes.id as class', 'student_school_classes.class_number', 'schools.id as school_name', 'sport_classes.id as sport_class', 'sports.id as sport_id')
                ->where('students.id', $id)
                ->first();

            return response()->json(['data' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $error = $this->validation($request);

        if($error->fails())
        {
            return response()->json(['errors' => $error->errors()->all()]);
        }

        $user = [
            'enrollment' => $request->enrollment,
            'name' => $request->name,
            'email' => $request->email,
        ];

        if($request->password) {
            $user['password'] = Hash::make($request->password);
        }

        User::whereId($request->hidden_id)->update($user);

        $studentSchoolClass = [
            'school_class_id' => $request->school_class,
            'class_number' => $request->class_number,
        ];

        $student_id = Student::where('user_id', $request->hidden_id)->first();

        StudentSchoolClass::where('student_id', $student_id->id)->update($studentSchoolClass);

        $studentClass = StudentClass::where('student_id', $student_id->id)->first();

        if(!$studentClass || !($studentClass->sport_class_id == $request->sport_class))
        {
            if($studentClass){
                $studentClass->delete();
            }

            $newStudentClass = [
                'student_id' => $student_id->id,
                'sport_class_id' => $request->sport_class,
                'school_year' => NOW()
            ];

            StudentClass::create($newStudentClass);
        }

        return response()->json(['success' => 'Aluno atualizada com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $student = Student::findOrFail($id);
        $student->delete();

        $user = User::findOrFail($student->user_id);
        $user->delete();
    }
}
