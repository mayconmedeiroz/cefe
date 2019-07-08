<?php

namespace CEFE\Http\Controllers;

use CEFE\SportClass;
use CEFE\Student;
use CEFE\StudentClass;
use CEFE\StudentSchoolClass;
use CEFE\User;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;
use Validator;
use Illuminate\Support\Facades\Storage;
use Hash;

class UserController extends Controller
{
    public function updateAvatar(Request $request){
        $error = Validator::make($request->all(), [
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if($error->fails())
        {
            return response()->json([
                'message'   => $error->errors()->all(),
                'className'  => 'alert-danger'
            ]);
        }

        $user = Auth::user();

        if($user->avatar != 'default.jpg') {
            Storage::delete("avatars/{$user->avatar}");
        }

        $avatarName = $user->id.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
        $request->avatar->storeAs('avatars',$avatarName);
        $user->avatar = $avatarName;
        $user->save();

        return response()->json([
            'message'   => 'Avatar atualizado com sucesso.',
            'imageUrl' => 'storage/avatars/' . $user->avatar,
            'className'  => 'alert-success',
        ]);
    }

    public function updateUser(Request $request){
        $user = Auth::user();

        $error = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,id,{$user->id}',
            'password' => 'required',
        ]);

        if (!(Hash::check($request->get('password'), $user->password))) {
            return response()->json([
                'message'   => 'Senha incorreta.',
                'className'  => 'alert-danger'
            ]);
        }

        if($error->fails())
        {
            return response()->json([
                'message'   => $error->errors()->all(),
                'className'  => 'alert-danger'
            ]);
        }

        $user->email = $request->email;
        $user->save();

        return response()->json([
            'message'   => 'Usuário atualizado com sucesso.',
            'className'  => 'alert-success',
        ]);
    }

    public function changePassword(Request $request){
        $error = Validator::make($request->all(), [
            'current' => 'required',
            'new-password' => 'required',
            'confirmation-password' => 'required|same:new-password'
        ]);

        if($error->fails())
        {
            return response()->json([
                'message'   => $error->errors()->all(),
                'className'  => 'alert-danger'
            ]);
        }

        $user = Auth::user();

        if (!(Hash::check($request->get('current'), $user->password))) {
            return response()->json([
                'message'   => 'Senha incorreta.',
                'className'  => 'alert-danger'
            ]);
        }

        if(strcmp($request->get('current'), $request->get('new-password')) == 0){
            return response()->json([
                'message'   => 'A senha antiga é igual a senha nova.',
                'className'  => 'alert-danger'
            ]);
        }

        if($error->fails())
        {
            return response()->json([
                'message'   => $error->errors()->all(),
                'className'  => 'alert-danger'
            ]);
        }

        $user->password = Hash::make($request->get('new-password'));
        $user->save();

        return response()->json([
            'message'   => 'Usuário atualizado com sucesso.',
            'className'  => 'alert-success',
        ]);
    }

    public function dashboard()
    {
        switch (Auth::user()->level) {
            case 1:
                return view('dashboard.student');
                break;
            case 2:
                $userId = Auth::user()->id;

                $sportClasses = DB::table('sport_classes')
                    ->join('class_teachers', function($join) use($userId) {
                        $join->on('class_teachers.class_id', '=', 'sport_classes.id')
                            ->where('class_teachers.teacher_id', $userId)
                            ->whereNull('class_teachers.deleted_at');
                    })
                    ->get();
                return view('dashboard.teacher')->with(compact('sportClasses'));
                break;
            case 3:
                $userId = Auth::user()->id;

                $school = DB::table('users')
                    ->select('secretaries.school_id')
                    ->join('secretaries', function($join) use($userId) {
                        $join->where('secretaries.secretary_id', $userId);
                    })
                    ->first();

                $student = DB::table('school_classes')
                    ->join('student_school_classes', function($join){
                        $join->on('student_school_classes.school_class_id', '=', 'school_classes.id')
                            ->whereNull('student_school_classes.deleted_at');
                    })
                    ->where('school_classes.school_id', $school->school_id)
                    ->count();

                $studentClass = DB::table('student_classes')
                    ->join('students', function($join){
                        $join->on('students.id', '=', 'student_classes.student_id')
                            ->whereNull('students.deleted_at');
                    })
                    ->join('student_school_classes', function($join){
                        $join->on('student_school_classes.student_id', '=', 'students.id')
                            ->whereNull('student_school_classes.deleted_at');
                    })
                    ->join('school_classes', function($join) use($school){
                        $join->on('student_school_classes.school_class_id', '=', 'school_classes.id')
                            ->where('school_classes.school_id', $school->school_id);
                    })
                    ->count();

                return view('dashboard.secretary')->with(compact('student', 'studentClass'));
                break;
            case 4:
                $student = Student::count();
                $studentClass = StudentClass::count();
                $teachers = User::where('level', 2)->count();
                $sportClass = SportClass::count();

                return view('dashboard.admin')->with(compact('student', 'studentClass', 'teachers', 'sportClass'));
                break;
        }
    }

    public function profile(){
        return view('dashboard.users.profile');
    }
}