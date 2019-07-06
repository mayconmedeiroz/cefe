<?php
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', 'HomeController@index');
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::middleware(['auth'])->group(function () {

    //Routes available to all auth users
    Route::get('dashboard', 'UserController@dashboard')->name('dashboard');
    Route::get('profile', 'UserController@profile')->name('profile');
    Route::post('updateAvatar', 'UserController@updateAvatar');
    Route::post('updateUser', 'UserController@updateUser');
    Route::post('changePassword', 'UserController@changePassword');


    //Routes available to student
    Route::middleware(['student'])->group(function () {

    });

    //Routes available to teacher
    Route::middleware(['teacher'])->group(function () {

    });
    //Routes available to employee
    Route::middleware(['employee'])->group(function () {
        Route::resource('sports', 'SportController');
        Route::post('sports/update', 'SportController@update')->name('sports.update');
        Route::post('sports/getData', 'SportController@getData')->name('sports.getData');

        Route::resource('students', 'StudentController');
        Route::post('students/update', 'StudentController@update')->name('students.update');
        Route::post('students/getData', 'StudentController@getData')->name('students.getData');
        Route::get('students/getSportClasses/{id}', 'StudentController@getSportClasses');
        Route::get('students/getSchoolClasses/{id}', 'StudentController@getSchoolClasses');

        Route::resource('teachers', 'TeacherController');
        Route::post('teachers/getData', 'TeacherController@getData')->name('teachers.getData');
        Route::post('teachers/update', 'TeacherController@update')->name('teachers.update');

        Route::resource('employees', 'EmployeeController');
        Route::post('employees/getData', 'EmployeeController@getData')->name('employees.getData');
        Route::post('employees/update', 'EmployeeController@update')->name('employees.update');

        Route::resource('sport_classes', 'SportClassController');
        Route::post('sport_classes/update', 'SportClassController@update')->name('sport_classes.update');
        Route::post('sport_classes/getData', 'SportClassController@getData')->name('sport_classes.getData');
        Route::get('sport_classes/getSportName/{id}/{classId}', 'SportClassController@getSportName');

        Route::get('class/{id}', 'ClassController@index')->name('class.index');
        Route::delete('class/{id}/{sportId}', 'ClassController@destroy')->name('class.destroy');
        Route::resource('class', 'ClassController');
        Route::post('class/{id}/getData', 'ClassController@getData')->name('class.getData');

        Route::resource('grades', 'GradeController');
        Route::post('grades/getData/{sportClass}/{evaluation}', 'GradeController@getData')->name('grades.getData');
        Route::get('grades/getSportClasses/{id}', 'GradeController@getSportClasses');
        Route::get('grades/getEvaluationColumns/{id}', 'GradeController@getEvaluationColumns');
        Route::get('grades/getLessonData/{sportClass}/{evaluation}', 'GradeController@getLessonData');
        Route::post('grades/storeLesson/', 'GradeController@storeLesson');

        Route::get('report_cards/', 'ReportCardController@index')->name('report_cards.index');
        Route::get('report_cards/getSchoolClasses/{schoolId}', 'ReportCardController@getSchoolClasses');
        Route::get('report_cards/export/{school_year}/{school}/{school_class}/{evaluation}', 'ReportCardController@export')->name('report_cards.export');
    });
});