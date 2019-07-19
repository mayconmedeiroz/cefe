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
        $this->call([
            UsersTableSeeder::class,
            SchoolYearsTableSeeder::class,
            SchoolsTableSeeder::class,
            SchoolClassesTableSeeder::class,
            SportsTableSeeder::class,
            SportClassesTableSeeder::class,
            ClassTeachersTableSeeder::class,
            StudentSchoolClassesTableSeeder::class,
            StudentClassesTableSeeder::class,
            EvaluationsTableSeeder::class,
            SecretariesTableSeeder::class,
        ]);
    }
}