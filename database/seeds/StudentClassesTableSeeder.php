<?php

use Illuminate\Database\Seeder;
use CEFE\StudentClass;

class StudentClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentClass::insert([
            ['student_id' => '4', 'sport_class_id' => '1', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);
    }
}
