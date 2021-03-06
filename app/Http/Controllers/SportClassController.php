<?php

namespace App\Http\Controllers;

use App\ClassTeacher;
use App\Sport;
use App\SportClass;
use App\StudentClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;
use DataTables;
use Auth;

class SportClassController extends Controller
{
    public function validation($request)
    {
        return Validator::make($request->all(), [
            'sport' => 'required|numeric',
            'name' => 'required|max:20',
            'vacancies' => 'required|numeric|min:0|digits_between:0,4',
            'teachers' => 'required',
            'weekday' => 'required|numeric|between:0,6',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        switch (Auth::user()->level) {
            case 2:
                return view('dashboard.teacher.classes.classes');
                break;
            case 4:
                $sports = Sport::all();
                $teachers = DB::table('users')
                    ->select('users.id', 'users.name')
                    ->where('users.level', 2)
                    ->get();
                return view('dashboard.admin.classes.classes')->with(compact('sports', 'teachers'));
                break;
        }
    }

    public function getData()
    {
        if(request()->ajax())
        {
            if (Auth::user()->level == 4) {
            $classes = DB::table('sport_classes')
                ->leftJoin('class_teachers', function($join){
                    $join->on('class_teachers.class_id', '=', 'sport_classes.id')
                        ->whereNull('class_teachers.deleted_at');
                })
                ->leftJoin('users', function($join){
                    $join->on('users.id', '=', 'class_teachers.teacher_id')
                        ->whereNull('users.deleted_at');
                })
                ->join('sports', 'sport_classes.sport_id', '=', 'sports.id')
                ->select('sport_classes.id', 'sports.name AS sport_name', 'sport_classes.name')
                ->selectRaw('GROUP_CONCAT(`users`.`name` ORDER BY `users`.`name` SEPARATOR ", ") AS teacher_name')
                ->selectRaw('CONCAT(CASE `sport_classes`.`weekday` WHEN 0 THEN "Domingo" WHEN 1 THEN "Segunda-feira" WHEN 2 THEN "Terça-feira" WHEN 3 THEN "Quarta-feira" WHEN 4 THEN "Quinta-feira" WHEN 5 THEN "Sexta-feira" WHEN 6 THEN "Sábado" END, ", ", DATE_FORMAT(`sport_classes`.`start_time`, "%H:%i"), "-", DATE_FORMAT(`sport_classes`.`end_time`, "%H:%i")) AS `sport_time`')
                ->selectRaw('`sport_classes`.`vacancies` - (SELECT COUNT(*) from `student_classes` WHERE `student_classes`.`sport_class_id` = `sport_classes`.`id`  AND `student_classes`.`deleted_at` IS NULL) AS vacancies')
                ->whereNull('sport_classes.deleted_at')
                ->groupBy('class_teachers.class_id')
                ->get();
            } else {
                $classes = DB::table('sport_classes')
                    ->join('class_teachers', function($join){
                        $join->on('class_teachers.class_id', '=', 'sport_classes.id')
                            ->where('class_teachers.teacher_id', Auth::user()->id)
                            ->whereNull('class_teachers.deleted_at');
                    })
                    ->join('users', function($join){
                        $join->on('users.id', '=', 'class_teachers.teacher_id')
                            ->whereNull('users.deleted_at');
                    })
                    ->join('sports', 'sport_classes.sport_id', '=', 'sports.id')
                    ->select('sport_classes.id', 'sports.name AS sport_name', 'sport_classes.name')
                    ->selectRaw('CONCAT(CASE `sport_classes`.`weekday` WHEN 0 THEN "Domingo" WHEN 1 THEN "Segunda-feira" WHEN 2 THEN "Terça-feira" WHEN 3 THEN "Quarta-feira" WHEN 4 THEN "Quinta-feira" WHEN 5 THEN "Sexta-feira" WHEN 6 THEN "Sábado" END, ", ", DATE_FORMAT(`sport_classes`.`start_time`, "%H:%i"), "-", DATE_FORMAT(`sport_classes`.`end_time`, "%H:%i")) AS `sport_time`')
                    ->selectRaw('`sport_classes`.`vacancies` - (SELECT COUNT(*) from `student_classes` WHERE `student_classes`.`sport_class_id` = `sport_classes`.`id`  AND `student_classes`.`deleted_at` IS NULL) AS vacancies')
                    ->whereNull('sport_classes.deleted_at')
                    ->groupBy('class_teachers.class_id')
                    ->get();
            }

            return DataTables()->of($classes)
                ->addColumn('action', function($data){
                    $button = '<a href="/teacher/class/'.$data->id.'" class="view btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>';
                    if(Auth::user()->level == 4){
                        $button = '<a href="/admin/class/'.$data->id.'" class="view btn btn-secondary btn-sm"><i class="fas fa-eye"></i></a>';
                        $button .= '<button type="button" name="edit" id="'.$data->id.'" class="edit btn btn-primary btn-sm mx-lg-1"><i class="fas fa-edit"></i></button>';
                        $button .= '<button type="button" name="delete" id="'.$data->id.'" class="delete btn btn-danger btn-sm"><i class="fas fa-trash-alt"></i></button>';
                    }
                    return $button;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getSportName($id, $classId)
    {
        if ($classId) {
            $sportNumber = DB::table('sport_classes')
                ->select('sport_classes.name', 'sport_classes.sport_id')
                ->where('sport_classes.id', $classId)
                ->orderBy('sport_classes.id', 'desc')
                ->first();
        }

        $lastSportNumber = DB::table('sport_classes')
            ->join('sports', 'sport_classes.sport_id', '=', 'sports.id')
            ->select('sports.acronym')
            ->selectRaw('RIGHT(`sport_classes`.`name`, 2) AS lastSportNumber')
            ->where('sport_classes.sport_id', $id)
            ->orderBy('sport_classes.id', 'desc')
            ->first();

        if (isset($sportNumber) && $id == $sportNumber->sport_id) {
            $result = $sportNumber->name;

        } else if($lastSportNumber) {
            $result = $lastSportNumber->acronym . '-' . str_pad($lastSportNumber->lastSportNumber + 1, 2, 0, STR_PAD_LEFT);
        } else {
            $lastSportNumber = DB::table('sports')
                ->select('sports.acronym')
                ->where('sports.id', $id)
                ->first();

            $result = $lastSportNumber->acronym . '-01';
        }

        return response()->json($result);
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
            return response()->json(['error' => true, 'messages' => $error->errors()->all()]);
        }

        $sport_class = [
            'sport_id' => $request->sport,
            'name' => $this->getSportName($request->sport, false)->getData(),
            'vacancies' => $request->vacancies,
            'weekday' => $request->weekday,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ];

        $sport_class_id = SportClass::create($sport_class);
        $teachers = explode(',', $request->teachers);

        foreach ($teachers as $teacher) {
            $class_teacher = [
                'teacher_id' => $teacher,
                'class_id' => $sport_class_id->id
            ];
            ClassTeacher::create($class_teacher);
        }
        return response()->json(['error' => false, 'messages' => ['Turma adicionada com sucesso.']]);
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
            $data = DB::table('sport_classes')
                ->join('class_teachers', function($join){
                    $join->on('class_teachers.class_id', '=', 'sport_classes.id')
                        ->whereNull('class_teachers.deleted_at');
                })->join('sports', 'sport_classes.sport_id', '=', 'sports.id')
                ->join('users', 'users.id', '=', 'class_teachers.teacher_id')
                ->select('sport_classes.id', 'sports.id as sport_id', 'sport_classes.name', 'sport_classes.vacancies', 'sport_classes.weekday', 'sport_classes.start_time', 'sport_classes.end_time')
                ->selectRaw('GROUP_CONCAT(`users`.`id` ORDER BY `users`.`id` SEPARATOR ", ") AS teachers_id')
                ->where('sport_classes.id', $id)
                ->groupBy('class_teachers.class_id')
                ->first();

            return response()->json($data);
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
            return response()->json(['error' => true, 'messages' => $error->errors()->all()]);

        $sport_class = [
            'sport_id' => $request->sport,
            'vacancies' => $request->vacancies,
            'weekday' => $request->weekday,
            'name' => $this->getSportName($request->sport, $request->id)->getData(),
            'start_time' => $request->start_time,
            'end_time' => $request->end_time
        ];

        ClassTeacher::where('class_id', $request->id)->delete();

        foreach (explode(',', $request->teachers) as $teacher) {
            $class_teacher = [
                'teacher_id' => $teacher,
                'class_id' => $request->id
            ];
            ClassTeacher::create($class_teacher);
        }

        SportClass::whereId($request->id)->update($sport_class);

        return response()->json(['error' => false, 'messages' => ['Turma atualizada com sucesso.']]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        StudentClass::where('sport_class_id', $id)->delete();
        ClassTeacher::where('class_id', $id)->delete();
        SportClass::where('id', $id)->delete();
    }
}
