<?php

use App\SchoolClass;
use Illuminate\Database\Seeder;

class SchoolClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SchoolClass::insert([
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
            ['school_id' => '1', 'class' => '3251', 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);

        // factory(SchoolClass::class, 10)->create();
    }
}
