<?php

namespace CEFE\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EnrollController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (StudentController::hasSportClass() == '0') {
            /*$sportClasses = DB::table('sport_classes')
                ->select('sport_classes.id', 'sport_classes.name', 'sports.name as sport_name')
                ->selectRaw('CONCAT(CASE `sport_classes`.`weekday` WHEN 0 THEN "Domingo" WHEN 1 THEN "Segunda-feira" WHEN 2 THEN "Terça-feira" WHEN 3 THEN "Quarta-feira" WHEN 4 THEN "Quinta-feira" WHEN 5 THEN "Sexta-feira" WHEN 6 THEN "Sábado" END, " das ", DATE_FORMAT(`sport_classes`.`start_time`, "%H:%i"), " às ", DATE_FORMAT(`sport_classes`.`end_time`, "%H:%i")) AS `sport_time`')
                ->join('sports', 'sports.id', '=', 'sport_classes.sport_id')
                ->whereNull('sport_classes.deleted_at')
                ->where('sport_classes.vacancies', '>', DB::raw('(SELECT COUNT(*) from `student_classes` WHERE `student_classes`.`sport_class_id` = `sport_classes`.`id`  AND `student_classes`.`deleted_at` IS NULL)'))
                ->get();*/

            return view('dashboard.student.enroll');//->with(compact('sportClasses'))
        }
        abort(404);
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
