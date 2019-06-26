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
        $this->CreateSports();
        $this->CreateSchools();
        $this->CreateTeachers();
        $this->CreateSportClasses();
        $this->CreateClassTeachers();
        $this->CreateStudents();
        $this->CreateStudentClasses();
        $this->CreateGrades();
    }

    private function CreateUsers()
    {
        $users = [
            ['enrollment' => '191000.40.10000', 'name' => 'Maycon Medeiros', 'email' => 'Maycon@admin.com', 'password' => Hash::make('123'), 'level' => '3', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '191000.40.10001', 'name' => 'Andrey Dario', 'email' => 'Andrey@admin.com', 'password' => Hash::make('123'), 'level' => '3', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '191000.40.10002', 'name' => 'Arthur Xavier', 'email' => 'Arthur@admin.com', 'password' => Hash::make('123'), 'level' => '3', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '191000.40.10003', 'name' => 'Aluno', 'email' => 'user@user.com', 'password' => Hash::make('123'), 'level' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.10000', 'name' => 'Paulo de Aguiar', 'email' => 'futebol@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.10001', 'name' => 'Carolina Grego', 'email' => 'basquetebol@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.10002', 'name' => 'Sérgio Saraiva', 'email' => 'tenis@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.10003', 'name' => 'Vitória Flores', 'email' => 'nat1@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.10004', 'name' => 'Francisco Batista', 'email' => 'nat2@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.10005', 'name' => 'Allison Salazar', 'email' => 'handebol@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.10006', 'name' => 'Paulo Lovato	', 'email' => 'xadrez@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['enrollment' => '190210.45.10007', 'name' => 'Luciano Medina', 'email' => 'alongamento@cefe.com', 'password' => Hash::make('123'), 'level' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
       ];
        User::insert($users);

        /*$faker = Faker::create('pt_BR');

        for($i = 12 ; $i <= 100 ; $i++){
            DB::table('users')->insert([
                'enrollment' => '190210.45.'.(10000+$i),
                'name' => $faker->firstName() . ' ' . $faker->lastName(),
                'email' => $faker->unique()->freeEmail(),
                'password' => Hash::make('123'),
                'level' => '1',
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }*/
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
    }

    private function CreateStudents()
    {
        $students = [
            ['user_id' => '1', 'school_id' => '1', 'class' => '3251', 'class_number' => '9', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '2', 'school_id' => '1', 'class' => '3251', 'class_number' => '11', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '3', 'school_id' => '3', 'class' => '3251', 'class_number' => '6', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '4', 'school_id' => '2', 'class' => '2151', 'class_number' => '17', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];
        Student::insert($students);

        /*$faker = Faker::create('pt_BR');

        for($i = 12 ; $i <= 100; $i++){
            DB::table('students')->insert([
                'user_id' => (1+$i),
                'school_id' => $faker->numberBetween(1,3),
                'class' => $faker->randomElement(['1151', '2151', '3251']),
                'class_number' => $faker->numberBetween(1,30),
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }*/


    }

    private function CreateTeachers()
    {
        $teachers = [
            ['user_id' => '5', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '6', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '7', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '8', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '9', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '10', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '11', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['user_id' => '12', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];
        Teacher::insert($teachers);
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
            ['teacher_id' => '1', 'class_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '2', 'class_id' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '3', 'class_id' => '3', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '4', 'class_id' => '4', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '5', 'class_id' => '4', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '5', 'class_id' => '5', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '6', 'class_id' => '6', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '7', 'class_id' => '7', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '8', 'class_id' => '8', 'created_at' => NOW(), 'updated_at' => NOW()],
        ];
        ClassTeacher::insert($class_teachers);


    }

    private function CreateStudentClasses()
    {
        $student_clasees = [
            ['student_id' => '1', 'sport_class_id' => '1', 'school_year' => NOW(), 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '2', 'sport_class_id' => '1', 'school_year' => NOW(), 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '3', 'sport_class_id' => '1', 'school_year' => NOW(), 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '4', 'sport_class_id' => '1', 'school_year' => NOW(), 'created_at' => NOW(), 'updated_at' => NOW()],
        ];

        StudentClass::insert($student_clasees);

        /*$faker = Faker::create('pt_BR');

        for($i = 1 ; $i <= 93; $i++){
            DB::table('student_classes')->insert([
                'student_id' => ($i),
                'sport_class_id' => $faker->numberBetween(1,7),
                'school_year' => NOW(),
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }*/
    }

    private function CreateGrades()
    {
        $grades = [
            ['student_id' => '1', 'school_year' => NOW(), 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '2', 'school_year' => NOW(), 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '3', 'school_year' => NOW(), 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '4', 'school_year' => NOW(), 'created_at' => NOW(), 'updated_at' => NOW()],
        ];

        Grade::insert($grades);

        /*$faker = Faker::create('pt_BR');

        for($i = 1 ; $i <= 93; $i++){
            DB::table('student_classes')->insert([
                'student_id' => ($i),
                'sport_class_id' => $faker->numberBetween(1,7),
                'school_year' => NOW(),
                'created_at' => NOW(),
                'updated_at' => NOW(),
            ]);
        }*/
    }
}