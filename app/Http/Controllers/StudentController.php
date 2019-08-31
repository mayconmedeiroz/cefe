<?php

namespace CEFE\Http\Controllers;

use CEFE\Secretary;
use CEFE\SchoolYear;
use CEFE\User;
use CEFE\School;
use CEFE\Sport;
use CEFE\StudentClass;
use CEFE\StudentSchoolClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

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
        $id = $request->id;
        return Validator::make($request->all(), [
            'enrollment' => 'required|max:20|unique:users,enrollment,' . $id,
            'name' => 'required|max:64',
            'email' => 'required|email|max:50|unique:users,email,' . $id,
            'password' => 'required_if:action,add,secadd|max:60',
            'school' => 'required',
            'school_class' => 'required|max:4',
            'class_number' => 'required|max:2',
            'sport_class' => 'required_if:action,add,mod',
        ]);
    }

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

                return view('dashboard.secretary.students.students')->with(compact('school'));
                break;
            case 4:
                $sports = Sport::all();
                $schools = School::all();
                return view('dashboard.admin.students.students')->with(compact('schools', 'sports'));
                break;
        }
    }

    public function getData()
    {
        if(request()->ajax())
        {
            $user = Auth::user();
            if ($user->level == 4) {

                $users = User::with(['studentSchoolClass.school:id,acronym', 'studentClass:name'])
                    ->select('users.id', 'users.enrollment', 'users.name')
                    ->where('users.level',1);

            } else {

                $school = Secretary::where('secretary_id', $user->id)->first();

                $users = User::with(['studentSchoolClass.school:id,acronym', 'studentClass:name'])
                    ->select('users.id', 'users.enrollment', 'users.name')
                    ->where('users.level',1)
                    ->whereHas('studentSchoolClass.school', function($query) use($school) {
                        $query->where('id', $school->school_id);
                    });

            }

            return DataTables()->of($users)->make(true);
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

        if ($error->fails())
            return response()->json(['error' => true, 'messages' => $error->errors()->all()]);

        $userId = User::create([
            'enrollment' => $request->enrollment,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $school_year = SchoolYear::where('school_year', NOW())->first();

        StudentSchoolClass::create([
            'student_id' => $userId->id,
            'school_class_id' => $request->school_class,
            'class_number' => $request->class_number,
            'school_year_id' => $school_year->id,
        ]);

        if (Auth::user()->level == 4) {
            StudentClass::create([
                'student_id' => $userId->id,
                'sport_class_id' => $request->sport_class,
                'school_year_id' => $school_year->id
            ]);
        }

        return response()->json(['error' => false, 'messages' => ['Aluno adicionado com sucesso.']]);
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
        $data = User::with(['studentSchoolClass.school:id,acronym', 'studentClass.sport:id'])
            ->select('users.id', 'users.enrollment', 'users.name', 'users.email')
            ->where('users.id', $id)
            ->first();

        return response()->json($data);
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

        if ($error->fails())
            return response()->json(['error' => true, 'messages' => $error->errors()->all()]);

        $user = [
            'enrollment' => $request->enrollment,
            'name' => $request->name,
            'email' => $request->email,
        ];

        if($request->password) {
            $user['password'] = Hash::make($request->password);
        }

        User::findOrFail($request->id)->update($user);

        StudentSchoolClass::where('student_id', $request->id)->delete();
        $school_year = SchoolYear::where('school_year', NOW())->first();

        StudentSchoolClass::create([
            'student_id' => $request->id,
            'school_class_id' => $request->school_class,
            'class_number' => $request->class_number,
            'school_year_id' => $school_year->id,
        ]);

        $studentClass = StudentClass::where('student_id', $request->id)->first();

        if((!$studentClass || !($studentClass->sport_class_id == $request->sport_class)) && Auth::user()->level == 4)
        {
            if($studentClass){
                $studentClass->delete();
            }

            $newStudentClass = [
                'student_id' => $request->id,
                'sport_class_id' => $request->sport_class,
                'school_year_id' => $school_year->id
            ];

            StudentClass::create($newStudentClass);
        }

        return response()->json(['error' => false, 'messages' => ['Aluno adicionado com sucesso.']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StudentClass::where('student_id', $id)->delete();
        StudentSchoolClass::where('student_id', $id)->delete();
        User::findOrFail($id)->delete();
    }

    public function hasSportClass()
    {
        return User::findOrFail(Auth::user()->id)
            ->withCount('studentClass')
            ->first();
    }
}
