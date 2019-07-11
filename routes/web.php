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
        Route::post('/students/first_login', 'UserController@firstLogin');
    });

    //Routes available to teacher
    Route::middleware(['teacher'])->group(function () {
        Route::resource('teacher/sport_classes', 'SportClassController');
        Route::post('teacher/sport_classes/update', 'SportClassController@update')->name('sport_classes.update');
        Route::post('teacher/sport_classes/getData', 'SportClassController@getData')->name('sport_classes.getData');
        Route::get('teacher/sport_classes/getSportName/{id}/{classId}', 'SportClassController@getSportName');

        Route::get('teacher/class/{id}', 'ClassController@index')->name('class.index');
        Route::delete('teacher/class/{id}/{sportId}', 'ClassController@destroy')->name('class.destroy');
        Route::resource('teacher/class', 'ClassController');
        Route::post('teacher/class/{id}/getData', 'ClassController@getData')->name('class.getData');

        Route::resource('teacher/grades', 'GradeController');
        Route::post('teacher/grades/getData/{sportClass}/{evaluation}', 'GradeController@getData')->name('grades.getData');
        Route::get('teacher/grades/getSportClasses/{id}', 'GradeController@getSportClasses');
        Route::get('teacher/grades/getEvaluationColumns/{id}', 'GradeController@getEvaluationColumns');
        Route::get('teacher/grades/getLessonData/{sportClass}/{evaluation}', 'GradeController@getLessonData');
        Route::post('teacher/grades/storeLesson/', 'GradeController@storeLesson');
    });

    //Routes available to secretary
    Route::middleware(['secretary'])->group(function () {
        Route::get('secretary/report_cards/', 'ReportCardController@index')->name('report_cards.index');
        Route::get('secretary/report_cards/getSchoolClasses/{schoolId}', 'ReportCardController@getSchoolClasses');
        Route::get('secretary/report_cards/export/{school_year}/{school}/{school_class}/{evaluation}', 'ReportCardController@export')->name('report_cards.export');

        Route::get('secretary/import_students/', 'ImportStudentController@index')->name('import_students.index');
        Route::post('secretary/import_students/', 'ImportStudentController@store');
    });

    //Routes available to employee
    Route::middleware(['employee'])->group(function () {
        Route::resource('admin/sports', 'SportController');
        Route::post('admin/sports/update', 'SportController@update')->name('sports.update');
        Route::post('admin/sports/getData', 'SportController@getData')->name('sports.getData');

        Route::resource('admin/students', 'StudentController');
        Route::post('admin/students/update', 'StudentController@update')->name('students.update');
        Route::post('admin/students/getData', 'StudentController@getData')->name('students.getData');
        Route::get('admin/students/getSportClasses/{id}', 'StudentController@getSportClasses');
        Route::get('admin/students/getSchoolClasses/{id}', 'StudentController@getSchoolClasses');

        Route::resource('admin/teachers', 'TeacherController');
        Route::post('admin/teachers/getData', 'TeacherController@getData')->name('teachers.getData');
        Route::post('admin/teachers/update', 'TeacherController@update')->name('teachers.update');

        Route::resource('admin/employees', 'EmployeeController');
        Route::post('admin/employees/getData', 'EmployeeController@getData')->name('employees.getData');
        Route::post('admin/employees/update', 'EmployeeController@update')->name('employees.update');

        Route::resource('admin/sport_classes', 'SportClassController');
        Route::post('admin/sport_classes/update', 'SportClassController@update')->name('sport_classes.update');
        Route::post('admin/sport_classes/getData', 'SportClassController@getData')->name('sport_classes.getData');
        Route::get('admin/sport_classes/getSportName/{id}/{classId}', 'SportClassController@getSportName');

        Route::get('admin/class/{id}', 'ClassController@index')->name('class.index');
        Route::delete('admin/class/{id}/{sportId}', 'ClassController@destroy')->name('class.destroy');
        Route::resource('admin/class', 'ClassController');
        Route::post('admin/class/{id}/getData', 'ClassController@getData')->name('class.getData');

        Route::resource('admin/grades', 'GradeController');
        Route::post('admin/grades/getData/{sportClass}/{evaluation}', 'GradeController@getData')->name('grades.getData');
        Route::get('admin/grades/getSportClasses/{id}', 'GradeController@getSportClasses');
        Route::get('admin/grades/getEvaluationColumns/{id}', 'GradeController@getEvaluationColumns');
        Route::get('admin/grades/getLessonData/{sportClass}/{evaluation}', 'GradeController@getLessonData');
        Route::post('admin/grades/storeLesson/', 'GradeController@storeLesson');

        Route::get('admin/report_cards/', 'ReportCardController@index')->name('report_cards.index');
        Route::get('admin/report_cards/getSchoolClasses/{schoolId}', 'ReportCardController@getSchoolClasses');
        Route::get('admin/report_cards/export/{school_year}/{school}/{school_class}/{evaluation}', 'ReportCardController@export')->name('report_cards.export');

        Route::get('admin/import_students/', 'ImportStudentController@index')->name('import_students.index');
        Route::post('admin/import_students/', 'ImportStudentController@store');
    });
});