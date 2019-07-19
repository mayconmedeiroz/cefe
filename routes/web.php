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

Route::any('test', function () {
    $query = \CEFE\User::where('level', '2')->with('classTeachers');
    return $query->get();
});

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

        Route::resource('secretary/students', 'StudentController');
        Route::post('secretary/students/update', 'StudentController@update')->name('students.update');
        Route::post('secretary/students/getData', 'StudentController@getData')->name('students.getData');
        Route::get('secretary/students/getSportClasses/{id}', 'StudentController@getSportClasses');
        Route::get('secretary/students/getSchoolClasses/{id}', 'StudentController@getSchoolClasses');
    });

    //Routes available to employee
    Route::prefix('admin')->middleware(['employee'])->group(function () {
        Route::resource('sports', 'SportController');
        Route::post('sports/update', 'SportController@update')->name('sports.update');
        Route::post('sports/getData', 'SportController@getData')->name('sports.getData');

        Route::resource('students', 'StudentController');
        Route::post('students/update', 'StudentController@update')->name('students.update');
        Route::post('students/getData', 'StudentController@getData')->name('students.getData');
        Route::get('students/getSportClasses/{SportId}', 'StudentController@getSportClasses');
        Route::get('students/getSchoolClasses/{SchoolId}', 'StudentController@getSchoolClasses');

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

        Route::get('import_students/', 'ImportStudentController@index')->name('import_students.index');
        Route::post('import_students/', 'ImportStudentController@store');
    });
});