<?php

use App\Evaluation;
use Illuminate\Database\Seeder;

class EvaluationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Evaluation::insert([
            ['name' => 'Trimestre 1', 'attendance' => '1', 'recuperation' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Trimestre 2', 'attendance' => '1', 'recuperation' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Trimestre 3', 'attendance' => '1', 'recuperation' => '1', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['name' => 'Recuperação Final', 'attendance' => '0', 'recuperation' => '0', 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);

        // factory(Evaluation::class, 10)->create();
    }
}
