<?php

namespace App\Http\Controllers;

use App\HomepageSlider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $sliders = HomepageSlider::all();

        $sportClasses = DB::table('sport_classes')
            ->select('sport_classes.id', 'sport_classes.name', 'sports.name as sport_name')
            ->selectRaw('CONCAT(CASE `sport_classes`.`weekday` WHEN 0 THEN "Domingo" WHEN 1 THEN "Segunda-feira" WHEN 2 THEN "Terça-feira" WHEN 3 THEN "Quarta-feira" WHEN 4 THEN "Quinta-feira" WHEN 5 THEN "Sexta-feira" WHEN 6 THEN "Sábado" END, " das ", DATE_FORMAT(`sport_classes`.`start_time`, "%H:%i"), " às ", DATE_FORMAT(`sport_classes`.`end_time`, "%H:%i")) AS `sport_time`')
            ->join('sports', 'sports.id', '=', 'sport_classes.sport_id')
            ->whereNull('sport_classes.deleted_at')
            ->where('sport_classes.vacancies', '>', DB::raw('(SELECT COUNT(*) from `student_classes` WHERE `student_classes`.`sport_class_id` = `sport_classes`.`id`  AND `student_classes`.`deleted_at` IS NULL)'))
            ->limit('6')
            ->get();

        $posts = DB::table('blog_posts')
            ->select('blog_posts.id', 'blog_posts.title', 'blog_posts.created_at', 'blog_posts.image')
            ->orderBy('id','desc')
            ->limit('4')
            ->get();

        return view('home')->with(compact('sliders', 'sportClasses', 'posts'));
    }

    public function about()
    {
        return view('about');
    }

    public function contact()
    {
        return view('contact');
    }
}
