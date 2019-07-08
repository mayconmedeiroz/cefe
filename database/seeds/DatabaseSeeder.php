<?php

use Illuminate\Database\Seeder;
use CEFE\User;
use CEFE\Sport;
use CEFE\Student;
use CEFE\School;
use CEFE\Teacher;
use CEFE\SportClass;
use CEFE\ClassTeacher;
use CEFE\StudentClass;
use CEFE\Grade;
use CEFE\SchoolClass;
use CEFE\StudentSchoolClass;
use CEFE\Evaluation;
use CEFE\SchoolYear;
use CEFE\Secretary;
use Faker\Factory as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->CreateUsers();
        $this->CreateSchoolYear();
        $this->CreateSchools();
        $this->CreateSports();
        $this->CreateSportClasses();
        $this->CreateClassTeachers();
        $this->CreateStudents();
        $this->CreateStudentSchoolClasses();
        $this->CreateStudentClasses();
        $this->CreateEvaluations();
    }

    private function CreateUsers()
    {
        $users = [
            ['enrollment' => '191000.40.1000', 'name' => 'Maycon Medeiros', 'email' => 'Maycon@admin.com', 'password' => Hash::make('123'), 'level' => '3', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '191000.40.1001', 'name' => 'Andrey Dario', 'email' => 'Andrey@admin.com', 'password' => Hash::make('123'), 'level' => '3', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '191000.40.1002', 'name' => 'Arthur Xavier', 'email' => 'Arthur@admin.com', 'password' => Hash::make('123'), 'level' => '3', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '191000.40.1003', 'name' => 'Aluno', 'email' => 'user@user.com', 'password' => Hash::make('123'), 'level' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1000', 'name' => 'Paulo de Aguiar', 'email' => 'futebol@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1001', 'name' => 'Carolina Grego', 'email' => 'basquetebol@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1002', 'name' => 'Sérgio Saraiva', 'email' => 'tenis@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1003', 'name' => 'Vitória Flores', 'email' => 'nat1@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1004', 'name' => 'Francisco Batista', 'email' => 'nat2@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.105', 'name' => 'Allison Salazar', 'email' => 'handebol@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1006', 'name' => 'Paulo Lovato	', 'email' => 'xadrez@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.1007', 'name' => 'Luciano Medina', 'email' => 'alongamento@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
       ];
        User::insert($users);


        $faker = Faker::create('pt_BR');

        /*for($i = 12 ; $i <= 100 ; $i++){
            DB::table('users')->insert([
                'enrollment' => '190210.45.'.(10000+$i),
                'name' => $faker->firstName() . ' ' . $faker->lastName(),
                'email' => $faker->unique()->freeEmail(),
                'password' => Hash::make('123'),
                'level' => '1',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
        */
    }

    private function CreateSports()
    {
        $sports = [
            ['name' => 'Futebol', 'acronym' => 'FUT', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Basquetebol', 'acronym' => 'BAS', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Tênis', 'acronym' => 'TEN', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Natação', 'acronym' => 'NAT', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Handebol', 'acronym' => 'HAN', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Xadrez', 'acronym' => 'XAD', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Alongamento', 'acronym' => 'ALO', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];
        Sport::insert($sports);
    }

    private function CreateSchools()
    {
        $schools = [
            ['name' => 'Escola Técnica Estadual Oscar Tenório', 'acronym' => 'ETEOT', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Escola Técnica Estadual Visconde de Mauá', 'acronym' => 'ETEVM', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Escola Estadual Visconde de Mauá', 'acronym' => 'EEVM', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];
        School::insert($schools);

        $schoolClass = [
            // All ETEOT classes
            ['school_id' => '1', 'class' => '1151', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '1201', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '1202', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '1203', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '1231', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '1232', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '1241', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '2101', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '2102', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '2131', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '2232', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '2151', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '2241', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '3101', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '3102', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '3231', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '3232', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '3241', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '3242', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '3251', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['school_id' => '1', 'class' => '3111', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];
        SchoolClass::insert($schoolClass);


        $secretary = [
            ['secretary_id' => 1, 'school_id' => 1, 'created_at' => NOW(), 'updated_at' => NOW()]
        ];

        Secretary::insert($secretary);
    }

    private function CreateStudents()
    {
        $students = [
            ['user_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '3', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '4', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];
        Student::insert($students);

        /*$faker = Faker::create('pt_BR');

        for($i = 12 ; $i <= 100; $i++){
            DB::table('students')->insert([
                'user_id' => (1+$i),
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
    */

    }

    private function CreateSportClasses()
    {
        $sport_classes = [
            ['sport_id' => '1', 'name' => 'FUT-01', 'weekday' => '0', 'start_time' => '07:00:00', 'end_time' => '08:40:00', 'vacancies' => '25', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '2', 'name' => 'BAS-01', 'weekday' => '1', 'start_time' => '08:40:00', 'end_time' => '10:20:00', 'vacancies' => '20', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '3', 'name' => 'TEN-01', 'weekday' => '2', 'start_time' => '10:30:00', 'end_time' => '12:00:00', 'vacancies' => '20', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '4', 'name' => 'NAT-01', 'weekday' => '3', 'start_time' => '07:00:00', 'end_time' => '08:40:00', 'vacancies' => '25', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '4', 'name' => 'NAT-02', 'weekday' => '4', 'start_time' => '13:00:00', 'end_time' => '14:40:00', 'vacancies' => '25', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '5', 'name' => 'HAN-01', 'weekday' => '5', 'start_time' => '16:30:00', 'end_time' => '18:00:00', 'vacancies' => '20', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '6', 'name' => 'XAD-01', 'weekday' => '6', 'start_time' => '14:40:00', 'end_time' => '16:30:00', 'vacancies' => '30', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '7', 'name' => 'ALO-01', 'weekday' => '1', 'start_time' => '10:30:00', 'end_time' => '12:00:00', 'vacancies' => '15', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];
        SportClass::insert($sport_classes);
    }

    private function CreateClassTeachers()
    {
        $class_teachers = [
            ['teacher_id' => '5', 'class_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '6', 'class_id' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '7', 'class_id' => '3', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '8', 'class_id' => '4', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '9', 'class_id' => '4', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '9', 'class_id' => '5', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '10', 'class_id' => '6', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '11', 'class_id' => '7', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '12', 'class_id' => '8', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];
        ClassTeacher::insert($class_teachers);
    }

    private function CreateStudentClasses()
    {
        $student_clasees = [
            ['student_id' => '1', 'sport_class_id' => '1', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '2', 'sport_class_id' => '1', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '3', 'sport_class_id' => '1', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '4', 'sport_class_id' => '1', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];

        StudentClass::insert($student_clasees);

        /*$faker = Faker::create('pt_BR');

        for($i = 5 ; $i <= 93; $i++){
            DB::table('student_classes')->insert([
                'student_id' => ($i),
                'sport_class_id' => $faker->numberBetween(2,8),
                'school_year_id' => '1',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
        */
    }

    private function CreateGrades()
    {
        $grades = [
            ['student_id' => '1', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '2', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '3', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '4', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];

        Grade::insert($grades);

        /*$faker = Faker::create('pt_BR');

        for($i = 1 ; $i <= 93; $i++){
            DB::table('student_classes')->insert([
                'student_id' => ($i),
                'sport_class_id' => $faker->numberBetween(1,7),
                'school_year_id' => '1'
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }*/
    }

    private function CreateStudentSchoolClasses()
    {
        $studentSchoolClass = [
            ['student_id' => '1', 'school_class_id' => '1', 'class_number' => '13', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '2', 'school_class_id' => '1', 'class_number' => '18', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '3', 'school_class_id' => '1', 'class_number' => '14', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '4', 'school_class_id' => '1', 'class_number' => '1', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];

        StudentSchoolClass::insert($studentSchoolClass);

        /*$faker = Faker::create('pt_BR');

        for($i = 5 ; $i <= 93; $i++){
            DB::table('student_school_classes')->insert([
                'student_id' => ($i),
                'school_class_id' => $faker->numberBetween(1,21),
                'class_number' => $faker->numberBetween(1,50),
                'school_year_id' => '1',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }
        */
    }

    private function CreateEvaluations()
    {
        $evaluations = [
            ['name' => 'Trimestre 1', 'attendance' => '1', 'recuperation' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Trimestre 2', 'attendance' => '1', 'recuperation' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Trimestre 3', 'attendance' => '1', 'recuperation' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Recuperação Final', 'attendance' => '0', 'recuperation' => '0', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];

        Evaluation::insert($evaluations);
    }

    private function CreateSchoolYear()
    {
        $school_year = [
            ['school_year' => NOW(), 'created_at' => NOW(), 'updated_at' => NOW()],
        ];

        SchoolYear::insert($school_year);
    }
}