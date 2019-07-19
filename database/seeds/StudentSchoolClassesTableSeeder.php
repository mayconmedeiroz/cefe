<?php

use CEFE\StudentSchoolClass;
use Illuminate\Database\Seeder;

class StudentSchoolClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        StudentSchoolClass::insert([
            ['student_id' => '1', 'school_class_id' => '1', 'class_number' => '13', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '2', 'school_class_id' => '1', 'class_number' => '18', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '3', 'school_class_id' => '1', 'class_number' => '14', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['student_id' => '4', 'school_class_id' => '1', 'class_number' => '1', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);
    }
}
