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

Route::get('test', function () {
    return \App\SportClass::sport(4)->get();
});

Route::get('/', 'HomeController@index')->name('index');
Route::get('article/{id}', 'ArticleController@show')->name('article.show');
Route::get('blog', 'HomeController@articles')->name('blog');
Route::get('about', 'HomeController@about')->name('about');

Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

Route::prefix('dashboard')->middleware(['auth'])->group(function () {

    //Routes available to all auth users
    Route::get('/', 'UserController@dashboard')->name('dashboard');

    Route::get('report', 'ReportController@report')->name('report');
    Route::post('report', 'ReportController@storeReport');

    Route::get('profile', 'UserController@profile')->name('profile');
    Route::post('updateAvatar', 'UserController@updateAvatar');
    Route::post('updateUser', 'UserController@updateUser');
    Route::post('changePassword', 'UserController@changePassword');

    Route::post('first_login', 'UserController@firstLogin');

    //Routes available to student
    Route::name('student.')->prefix('student')->middleware(['student'])->group(function () {
        Route::resource('enroll', 'EnrollController');
        Route::get('report_card', 'ReportCardController@studentReportCardIndex')->name('studentReportCardIndex');
        Route::get('getStudentReportCard', 'ReportCardController@getStudentReportCard');
        Route::get('request_exchange', 'EnrollController@requestExchange')->name('request_exchange');
    });

    //Routes available to teacher
    Route::name('teacher.')->prefix('teacher')->middleware(['teacher'])->group(function () {
        Route::resource('sport_classes', 'SportClassController');
        Route::post('sport_classes/update', 'SportClassController@update');
        Route::post('sport_classes/getData', 'SportClassController@getData');
        Route::get('sport_classes/getSportName/{id}/{classId}', 'SportClassController@getSportName');

        Route::get('class/{id}', 'ClassController@index')->name('class.index');
        Route::resource('class', 'ClassController');
        Route::delete('class/{id}/{sportId}', 'ClassController@destroy');
        Route::post('class/{id}/getData', 'ClassController@getData');

        Route::resource('grades', 'GradeController');
        Route::post('grades/getData/{sportClass}/{evaluation}', 'GradeController@getData');
        Route::get('grades/getSportClasses/{id}', 'GradeController@getSportClasses');
        Route::get('grades/getEvaluationColumns/{id}', 'GradeController@getEvaluationColumns');
        Route::get('grades/getLessonData/{sportClass}/{evaluation}', 'GradeController@getLessonData');
        Route::post('grades/storeLesson/', 'GradeController@storeLesson');
    });

    //Routes available to secretary
    Route::name('secretary.')->prefix('secretary')->middleware(['secretary'])->group(function () {
        Route::get('report_cards', 'ReportCardController@index')->name('report_cards.index');
        Route::get('report_cards/getSchoolClasses/{schoolId}', 'ReportCardController@getSchoolClasses');
        Route::get('report_cards/export/{school_year}/{school}/{school_class}/{evaluation}', 'ReportCardController@export');

        Route::get('import_students', 'ImportStudentController@index')->name('import_students.index');
        Route::post('import_students', 'ImportStudentController@store');

        Route::resource('students', 'StudentController');
        Route::post('students/update', 'StudentController@update');
        Route::post('students/getData', 'StudentController@getData');
        Route::get('students/getSportClasses/{id}', 'StudentController@getSportClasses');
        Route::get('students/getSchoolClasses/{id}', 'StudentController@getSchoolClasses');
    });

    //Routes available to employee
    Route::name('employee.')->prefix('admin')->middleware(['employee'])->group(function () {

        Route::get('clear-cache', 'HomeController@clearCache');

        Route::resource('sports', 'SportController');
        Route::post('sports/update', 'SportController@update');
        Route::post('sports/getData', 'SportController@getData');

        Route::resource('students', 'StudentController');
        Route::post('students/update', 'StudentController@update');
        Route::post('students/getData', 'StudentController@getData');
        Route::get('students/getSportClasses/{SportId}', 'StudentController@getSportClasses');
        Route::get('students/getSchoolClasses/{SchoolId}', 'StudentController@getSchoolClasses');

        Route::resource('teachers', 'TeacherController');
        Route::post('teachers/getData', 'TeacherController@getData');
        Route::post('teachers/update', 'TeacherController@update');

        Route::resource('secretaries', 'SecretaryController');
        Route::post('secretaries/getData', 'SecretaryController@getData');
        Route::post('secretaries/update', 'SecretaryController@update');

        Route::resource('employees', 'EmployeeController');
        Route::post('employees/getData', 'EmployeeController@getData');
        Route::post('employees/update', 'EmployeeController@update');

        Route::resource('schools', 'SchoolController');
        Route::post('schools/getData', 'SchoolController@getData');
        Route::post('schools/update', 'SchoolController@update');

        Route::resource('sport_classes', 'SportClassController');
        Route::post('sport_classes/update', 'SportClassController@update');
        Route::post('sport_classes/getData', 'SportClassController@getData');
        Route::get('sport_classes/getSportName/{id}/{classId}', 'SportClassController@getSportName');

        Route::get('class/{id}', 'ClassController@index')->name('class.index');
        Route::post('class/{id}/getData', 'ClassController@getData');
        Route::get('class/{sportId}/{id}/edit', 'ClassController@edit')->name('class.edit');
        Route::delete('class/{sportId}{id}', 'ClassController@destroy');

        Route::resource('grades', 'GradeController');
        Route::post('grades/getData/{sportClass}/{evaluation}', 'GradeController@getData');
        Route::get('grades/getSportClasses/{id}', 'GradeController@getSportClasses');
        Route::get('grades/getEvaluationColumns/{id}', 'GradeController@getEvaluationColumns');
        Route::get('grades/getLessonData/{sportClass}/{evaluation}', 'GradeController@getLessonData');
        Route::post('grades/storeLesson', 'GradeController@storeLesson');

        Route::get('report_cards', 'ReportCardController@index')->name('report_cards.index');
        Route::get('report_cards/getSchoolClasses/{schoolId}', 'ReportCardController@getSchoolClasses');
        Route::get('report_cards/export/{school_year}/{school}/{school_class}/{evaluation}', 'ReportCardController@export');

        Route::get('import_students', 'ImportStudentController@index')->name('import_students.index');
        Route::post('import_students', 'ImportStudentController@store');

        Route::resource('articles', 'ArticleController');
        Route::post('articles/update', 'ArticleController@update');
        Route::post('articles/getData', 'ArticleController@getData');
        Route::post('articles/uploadImage', 'ArticleController@uploadImage');

        Route::resource('categories', 'CategoryController');
        Route::post('categories/update', 'CategoryController@update');
        Route::post('categories/getData', 'CategoryController@getData');

        Route::get('school_classes/{id}', 'SchoolClassController@index')->name('school_classes.index');
    });
});
