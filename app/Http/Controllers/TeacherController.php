<?php

namespace App\Http\Controllers;

use App\User;
use App\ClassTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.teachers.teachers');
    }

    public function getData()
    {
        $teachers = DB::table('users')
            ->leftJoin('class_teachers', 'users.id', '=', 'class_teachers.teacher_id')
            ->leftJoin('sport_classes', 'class_teachers.class_id', '=', 'sport_classes.id')
            ->select('users.id', 'users.name')
            ->selectRaw('GROUP_CONCAT(`sport_classes`.`name` ORDER BY `sport_classes`.`name` ASC SEPARATOR ", ") AS `sport_class_name`')
            ->where('users.level', '2')
            ->whereNull('users.deleted_at')
            ->whereNull('class_teachers.deleted_at')
            ->groupBy('users.id');

        return DataTables()->of($teachers)->make(true);
    }

    public function validation($request)
    {
        $id = $request->id;
        return Validator::make($request->all(), [
            'enrollment' => 'required|max:20|unique:users,enrollment,' . $id,
            'name' => 'required|max:64',
            'email' => 'required|email|max:50|unique:users,email,' . $id,
            'password' => 'required_if:action,==,add|max:60',
        ]);
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

        if ($this->validation($request)->fails())
            return response()->json(['error' => true, 'messages' => $error->errors()->all()]);


        User::create([
            'enrollment' => $request->enrollment,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => '2',
        ]);

        return response()->json(['error' => false, 'messages' => ['Professor adicionado com sucesso.']]);
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
        $data = User::findOrFail($id, ['users.id', 'users.name', 'users.enrollment', 'users.email']);

        return response()->json($data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $error = $this->validation($request);

        if ($this->validation($request)->fails())
            return response()->json(['error' => true, 'messages' => $error->errors()->all()]);

        $user = [
            'enrollment' => $request->enrollment,
            'name' => $request->name,
            'email' => $request->email
        ];

        if($request->password) {
            $user['password'] = Hash::make($request->password);
        }

        User::findOrFail($request->id)->update($user);

        return response()->json(['error' => false, 'messages' => ['Professor atualizado com sucesso.']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        ClassTeacher::where('teacher_id', $id)->delete();
        User::findOrFail($id)->delete();
    }
}
