<?php

use App\Sport;
use Illuminate\Database\Seeder;

class SportsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Sport::insert([
            ['name' => 'Futebol', 'acronym' => 'FUT', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Basquetebol', 'acronym' => 'BAS', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Tênis', 'acronym' => 'TEN', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Natação', 'acronym' => 'NAT', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Handebol', 'acronym' => 'HAN', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Xadrez', 'acronym' => 'XAD', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Alongamento', 'acronym' => 'ALO', 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);

        // factory(Sport::class, 10)->create();
    }
}
