<?php

use App\SchoolYear;
use Illuminate\Database\Seeder;

class SchoolYearsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SchoolYear::insert([
            ['school_year' => NOW(), 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);

        // factory(SchoolYear::class, 10)->create();
    }
}
