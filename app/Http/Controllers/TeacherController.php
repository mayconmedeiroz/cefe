<?php

namespace CEFE\Http\Controllers;

use CEFE\ClassTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CEFE\User;
use Validator;
use Hash;

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
        if(request()->ajax())
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

            return DataTables()->of($teachers)
                ->addColumn('action', function($data){
                    $button = '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm mr-lg-2"><i class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>';
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function validation($request)
    {
        $id = $request->hidden_id;
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
            return response()->json(['errors' => $error->errors()->all()]);

        User::create([
            'enrollment' => $request->enrollment,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => '2',
        ]);

        return response()->json(['success' => 'Professor adicionado com sucesso.']);
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
            $data = DB::table('users')
                ->leftJoin('class_teachers', 'users.id', '=', 'class_teachers.teacher_id')
                ->leftJoin('sport_classes', 'class_teachers.class_id', '=', 'sport_classes.id')
                ->select('users.id', 'users.name', 'users.enrollment', 'users.email')
                ->selectRaw('GROUP_CONCAT(`sport_classes`.`name` ORDER BY `sport_classes`.`name` ASC SEPARATOR ", ") AS `sport_class_name`')
                ->where('users.id', $id)
                ->whereNull('users.deleted_at')
                ->whereNull('class_teachers.deleted_at')
                ->groupBy('class_teachers.teacher_id')
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

        if ($this->validation($request)->fails())
            return response()->json(['errors' => $error->errors()->all()]);

        $user = [
            'enrollment' => $request->enrollment,
            'name' => $request->name,
            'email' => $request->email
        ];

        if($request->password) {
            $user['password'] = Hash::make($request->password);
        }

        User::findOrFail($request->hidden_id)->update($user);

        return response()->json(['success' => 'Professor atualizada com sucesso.']);
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
