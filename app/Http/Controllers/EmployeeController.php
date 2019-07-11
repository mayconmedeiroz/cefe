<?php

namespace CEFE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use CEFE\User;
use Validator;
use Hash;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.employees.employees');
    }

    public function getData()
    {
        if(request()->ajax())
        {
            $teachers = DB::table('users')
                ->select('users.id', 'users.name')
                ->where('users.level', '4')
                ->whereNull('users.deleted_at')
                ->get();

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

        if($error->fails())
        {
            return response()->json(['errors' => "Falha na solicitação, tente novamente!"]);
        }

        $user = [
            'enrollment' => $request->enrollment,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => '4',
        ];

        User::create($user);

        return response()->json(['success' => 'Funcionário adicionado com sucesso.']);
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
                ->select('users.id', 'users.name', 'users.enrollment', 'users.email')
                ->where('users.id', $id)
                ->whereNull('users.deleted_at')
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
            'email' => $request->email
        ];

        if($request->password) {
            $user['password'] = Hash::make($request->password);
        }

        User::whereId($request->hidden_id)->update($user);

        return response()->json(['success' => 'Funcionário atualizada com sucesso.']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
    }
}