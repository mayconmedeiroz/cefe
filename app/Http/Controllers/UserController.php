<?php

namespace CEFE\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
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
        return view('dashboard.main');
    }

    public function profile(){
        return view('dashboard.users.profile');
    }
}