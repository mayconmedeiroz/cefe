<?php

namespace App\Http\Controllers;

use App\School;
use App\Sport;
use App\SportClass;
use App\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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
        $class = DB::table('users')
            ->leftJoin('student_school_classes', function($join){
                $join->on('student_school_classes.student_id', '=', 'users.id')
                    ->whereNull('student_school_classes.deleted_at');
            })
            ->join('school_classes', 'student_school_classes.school_class_id', '=', 'school_classes.id')
            ->join('schools', 'school_classes.school_id', '=', 'schools.id')
            ->leftJoin('student_classes', function($join){
                $join->on('student_classes.student_id', '=', 'users.id')
                    ->whereNull('student_classes.deleted_at');
            })
            ->join('sport_classes', function($join) use($id){
                $join->on('sport_classes.id', '=', 'student_classes.sport_class_id')
                    ->where('sport_classes.id', $id)
                    ->whereNull('sport_classes.deleted_at');
            })
            ->select('users.id', 'users.name', 'schools.acronym', 'school_classes.class', 'student_school_classes.class_number')
            ->whereNull('users.deleted_at')
            ->get();

        return DataTables()->of($class)->make(true);
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
