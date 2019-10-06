<?php

namespace App\Http\Controllers;

use App\SportClass;
use App\Student;
use App\StudentClass;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Hash;

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
                if(Auth::user()->updated_at == NULL)
                {
                    return view('dashboard.first_login');
                } else {
                    $userId = Auth::user()->id;

                    $sportClasses = DB::table('sport_classes')
                        ->join('student_classes', function($join) use($userId) {
                            $join->on('student_classes.sport_class_id', '=', 'sport_classes.id')
                                ->where('student_classes.student_id', $userId)
                                ->whereNull('student_classes.deleted_at');
                        })
                        ->get();

                    return view('dashboard.student')->with(compact('sportClasses'));
                }
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

                $school = DB::table('secretaries')
                    ->select('secretaries.school_id')
                    ->where('secretaries.secretary_id', $userId)
                    ->first();

                $student = DB::table('school_classes')
                    ->join('student_school_classes', function($join){
                        $join->on('student_school_classes.school_class_id', '=', 'school_classes.id')
                            ->whereNull('student_school_classes.deleted_at');
                    })
                    ->where('school_classes.school_id', $school->school_id)
                    ->count();

                $studentClass = DB::table('student_classes')
                    ->join('users', function($join){
                        $join->on('users.id', '=', 'student_classes.student_id')
                            ->whereNull('users.deleted_at');
                    })
                    ->join('student_school_classes', function($join){
                        $join->on('student_school_classes.student_id', '=', 'users.id')
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

                $student = User::where('level', 1)->count();
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

    public function firstLogin(Request $request){
        if(!Auth::user()->updated_at)
        {
            $error = Validator::make($request->all(), [
                'email' => 'required|email|unique:users',
                'password' => 'required',
                'confirmation-password' => 'required|same:password'
            ]);

            if($error->fails())
            {
                return response()->json(['errors' => "Falha na solicitação, tente novamente!"]);
            }

            User::findOrFail(Auth::user()->id)->update([
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);

            return response()->json(['success' => "Tudo certo! Você será redirecionado para a página inicial."]);
        }

        return Redirect::back();
    }
}
