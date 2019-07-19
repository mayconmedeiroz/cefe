<?php

use CEFE\ClassTeacher;
use Illuminate\Database\Seeder;

class ClassTeachersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClassTeacher::insert([
            ['teacher_id' => '5', 'class_id' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '6', 'class_id' => '2', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '7', 'class_id' => '3', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '8', 'class_id' => '4', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '9', 'class_id' => '4', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '9', 'class_id' => '5', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '10', 'class_id' => '6', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '11', 'class_id' => '7', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['teacher_id' => '12', 'class_id' => '8', 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);

        // factory(ClassTeacher::class, 10)->create();
    }
}
