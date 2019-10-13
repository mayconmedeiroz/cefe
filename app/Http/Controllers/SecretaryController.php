<?php

namespace App\Http\Controllers;

use App\School;
use App\Secretary;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class SecretaryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schools = School::all();

        return view('dashboard.admin.secretaries.secretaries')->with(compact('schools'));
    }

    public function getData()
    {
         $teachers = DB::table('users')
            ->select('users.id', 'users.name', 'schools.acronym')
            ->join('secretaries', function($join) {
                $join->on('secretaries.secretary_id', '=' ,'users.id');
                    #->whereNull('secretaries.deleted_at');
            })
            ->join('schools', 'secretaries.school_id', '=', 'schools.id')
            ->whereNull('users.deleted_at')
            ->get();

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
            'school' => 'required|numeric'
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

        $user = User::create([
            'enrollment' => $request->enrollment,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'level' => '3',
        ]);

        Secretary::create([
            'secretary_id' => $user->id,
            'school_id' => $request->school,
        ]);

        return response()->json(['error' => false, 'messages' => ['Secretário adicionado com sucesso.']]);
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
        $data = DB::table('users')
            ->select('users.id', 'users.name', 'users.enrollment', 'users.email', 'schools.id as school')
            ->join('secretaries', function($join) {
                $join->on('secretaries.secretary_id', '=' ,'users.id');
                #->whereNull('secretaries.deleted_at');
            })
            ->join('schools', 'secretaries.school_id', '=', 'schools.id')
            ->where('users.id', $id)
            ->whereNull('users.deleted_at')
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

        Secretary::where('secretary_id', $request->id)->update([
            'school_id' => $request->school,
        ]);

        return response()->json(['error' => false, 'messages' => ['Secretário atualizado com sucesso.']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Secretary::where('secretary_id', $id)->delete();
        User::findOrFail($id)->delete();
    }
}
