<?php

namespace App\Http\Controllers;

use App\User;
use App\School;
use App\Sport;
use App\SportClass;
use App\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClassController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        switch (Auth::user()->level) {
            case 2:
                $classes = SportClass::findOrFail($id, ['name']);

                return view('dashboard.teacher.classes.class')->with(compact('classes'));
                break;
            case 4:
                $sports = Sport::all();
                $schools = School::all();
                $classes = SportClass::findOrFail($id, ['name']);

                return view('dashboard.admin.classes.class')->with(compact('classes', 'sports', 'schools'));
                break;
        }
     }

    public function getData($id)
    {
        $classes = User::with(['studentSchoolClass.school:id,acronym', 'studentClass:name'])
            ->select('users.id', 'users.name')
            ->whereHas('studentClass', function($query) use($id) {
                $query->where('sport_class_id', $id);
            });

        return DataTables()->of($classes)->make(true);
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @param  int  $sportId
     * @return \Illuminate\Http\Response
     */
    public function destroy($sportId, $id)
    {
        StudentClass::where('student_id', $id)
            ->where('sport_class_id', $sportId)
            ->delete();
    }
}
