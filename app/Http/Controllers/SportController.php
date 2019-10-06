<?php

namespace App\Http\Controllers;

use App\Sport;
use App\SportClass;
use App\StudentClass;
use App\ClassTeacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SportController extends Controller
{
    public function validation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|max:20|unique:sports,name,' . $request->id,
            'acronym' => 'required|max:10|unique:sports,acronym,' . $request->id
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.admin.sports.sports');
    }

    public function getData()
    {
        return DataTables()->of(Sport::latest()->get())->make(true);
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
            return response()->json(['error' => true, 'messages' => $error->errors()->all()]);

        Sport::create([
            'name'    => $request->name,
            'acronym' => $request->acronym
        ]);

        return response()->json(['error' => false, 'messages' => ['Modalidade adicionado com sucesso.']]);
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
        $data = Sport::findOrFail($id);
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

        if($error->fails())
            return response()->json(['error' => true, 'messages' => $error->errors()->all()]);

        Sport::findOrFail($request->id)->update([
            'name'    => $request->name,
            'acronym' => $request->acronym
        ]);

        return response()->json(['error' => false, 'messages' => ['Modalidade atualizado com sucesso.']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sportClasses = SportClass::where('sport_id', $id)->get();

        foreach ($sportClasses as $sportClass) {
            StudentClass::where('sport_class_id', $sportClass->id)->delete();
            ClassTeacher::where('class_id', $sportClass->id)->delete();
            $sportClass->delete();
        }

        Sport::findOrFail($id)->delete();
    }
}
