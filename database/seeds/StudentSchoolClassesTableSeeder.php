<?php

use App\StudentSchoolClass;
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
            ['student_id' => '4', 'school_class_id' => '1', 'class_number' => '43', 'school_year_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);
    }
}
