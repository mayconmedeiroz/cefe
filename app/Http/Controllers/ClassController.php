<?php

namespace CEFE\Http\Controllers;

use CEFE\School;
use CEFE\Sport;
use CEFE\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;

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
                $classes = DB::table('sport_classes')
                    ->where('sport_classes.id', $id)
                    ->select('sport_classes.name')
                    ->first();

                return view('dashboard.teacher.classes.class')->with(compact('classes'));
                break;
            case 4:
                $sports = Sport::all();
                $schools = School::all();
                $classes = DB::table('sport_classes')
                    ->where('sport_classes.id', $id)
                    ->select('sport_classes.name')
                    ->first();

                return view('dashboard.admin.classes.class')->with(compact('classes', 'sports', 'schools'));
                break;
        }
     }

    public function getData($id)
    {
        if (request()->ajax()) {
            $classes = DB::table('students')
                ->join('users', 'users.id', '=', 'students.user_id')
                ->join('student_school_classes', 'students.id', '=', 'student_school_classes.student_id')
                ->join('school_classes', 'student_school_classes.school_class_id', '=', 'school_classes.id')
                ->join('schools', 'school_classes.school_id', '=', 'schools.id')
                ->join('student_classes', function ($join) {
                    $join->on('student_classes.student_id', '=', 'students.id')
                        ->whereNull('student_classes.deleted_at');
                })
                ->select('students.id', 'users.name', 'school_classes.class', 'student_school_classes.class_number', 'schools.acronym')
                ->where('student_classes.sport_class_id', $id)
                ->get();

            return DataTables()->of($classes)
                ->addColumn('action', function ($data) {
                    $button = '<button type="button" name="edit" id="' . $data->id . '" class="edit btn btn-primary btn-sm mx-lg-1"><i class="fas fa-edit"></i></button>';
                    $button .= '<button type="button" name="delete" id="' . $data->id . '" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>';
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
    public function destroy($id, $sportId)
    {
        StudentClass::where('student_id', $id)->where('sport_class_id', $sportId)->delete();
    }
}
