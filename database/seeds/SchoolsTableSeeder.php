<?php

use App\School;
use Illuminate\Database\Seeder;

class SchoolsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        School::insert([
            ['name' => 'Escola Técnica Estadual Oscar Tenório', 'acronym' => 'ETEOT', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Escola Técnica Estadual Visconde de Mauá', 'acronym' => 'ETEVM', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Escola Estadual Visconde de Mauá', 'acronym' => 'EEVM', 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);

        // factory(School::class, 10)->create();
    }
}
