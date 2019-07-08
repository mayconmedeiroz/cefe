<?php

namespace CEFE\Http\Controllers;

use Illuminate\Http\Request;
use CEFE\Sport;
use CEFE\SportClass;
use CEFE\StudentClass;
use CEFE\ClassTeacher;
use Validator;
use DataTables;

class SportController extends Controller
{
    public function validation($request)
    {
        return Validator::make($request->all(), [
            'name' => 'required|max:20|unique:sports,name,' . $request->hidden_id,
            'acronym' => 'required|max:10|unique:sports,acronym,' . $request->hidden_id
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
        if(request()->ajax())
        {
            return DataTables()->of(Sport::latest()->get())
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

        $result = [
            'name'    => $request->name,
            'acronym' => $request->acronym
        ];

        Sport::create($result);
        return response()->json(['success' => 'Modalidade adicionada com sucesso.']);
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
            $data = Sport::findOrFail($id);
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
            return response()->json(['errors' => "Falha na solicitação, tente novamente!"]);
        }

        $result = [
            'name'    => $request->name,
            'acronym' => $request->acronym
        ];

        Sport::whereId($request->hidden_id)->update($result);
        return response()->json(['success' => 'Modalidade atualizada com sucesso.']);
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
            SportClass::findOrFail($sportClass->id)->delete();
        }

        Sport::findOrFail($id)->delete();

    }
}
