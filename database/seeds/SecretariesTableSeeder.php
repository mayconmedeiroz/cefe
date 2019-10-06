<?php

use App\Secretary;
use Illuminate\Database\Seeder;

class SecretariesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Secretary::insert([
            ['secretary_id' => 1, 'school_id' => 1, 'created_at' => NOW(), 'updated_at' => NOW()]
        ]);
    }
}
