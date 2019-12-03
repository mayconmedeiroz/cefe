<?php

namespace App\Http\Controllers;

use App\SchoolYear;
use App\Sport;
use App\SportClass;
use App\StudentClass;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
        if (User::withCount('studentClass')->findOrFail(Auth::id())->student_class_count == 0) {

            $teachers = User::where('level', 2)->get(['id', 'name']);
            $sports = Sport::all(['id', 'name']);

            $sportClasses = SportClass::sportToEnroll($request->sport)
                ->select('sport_classes.id', 'sport_classes.name', 'sports.name as sport_name')
                ->selectRaw('CONCAT(CASE `sport_classes`.`weekday` WHEN 0 THEN "Domingo" WHEN 1 THEN "Segunda-feira" WHEN 2 THEN "Terça-feira" WHEN 3 THEN "Quarta-feira" WHEN 4 THEN "Quinta-feira" WHEN 5 THEN "Sexta-feira" WHEN 6 THEN "Sábado" END, " das ", DATE_FORMAT(`sport_classes`.`start_time`, "%H:%i"), " às ", DATE_FORMAT(`sport_classes`.`end_time`, "%H:%i")) AS `sport_time`')
                ->selectRaw('GROUP_CONCAT(`users`.`name` ORDER BY `users`.`name` ASC SEPARATOR ", ") AS `teacher_name`')
                ->teacher($request->teacher)
                ->weekday($request->weekday)
                ->startTime($request->starttime)
                ->endTime($request->endtime)
                ->groupBy('sport_classes.id')
                ->where('sport_classes.vacancies', '>', DB::raw('(SELECT COUNT(*) from `student_classes` WHERE `student_classes`.`sport_class_id` = `sport_classes`.`id`  AND `student_classes`.`deleted_at` IS NULL)'))
                ->paginate();

            return view('dashboard.student.enroll')->with(compact(['teachers', 'sportClasses', 'sports']));
        }
        return redirect('/dashboard');
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
        if (User::withCount('studentClass')->findOrFail(Auth::id())->student_class_count == 0) {

            $school_year = SchoolYear::where('school_year', NOW())->first();

            StudentClass::create([
                'student_id' => Auth::id(),
                'sport_class_id' => $request->id,
                'school_year_id' => $school_year->id
            ]);

            return response()->json(['error' => false]);
        }
        abort(404);
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
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function requestExchange()
    {
        if (StudentController::hasSportClass() == '1') {
            return view('dashboard.student.request_exchange');
        }
        abort(404);
    }
}
