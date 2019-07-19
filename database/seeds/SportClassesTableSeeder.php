<?php

use CEFE\SportClass;
use Illuminate\Database\Seeder;

class SportClassesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        SportClass::insert([
            ['sport_id' => '1', 'name' => 'FUT-01', 'weekday' => '0', 'start_time' => '07:00:00', 'end_time' => '08:40:00', 'vacancies' => '25', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '2', 'name' => 'BAS-01', 'weekday' => '1', 'start_time' => '08:40:00', 'end_time' => '10:20:00', 'vacancies' => '20', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '3', 'name' => 'TEN-01', 'weekday' => '2', 'start_time' => '10:30:00', 'end_time' => '12:00:00', 'vacancies' => '20', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '4', 'name' => 'NAT-01', 'weekday' => '3', 'start_time' => '07:00:00', 'end_time' => '08:40:00', 'vacancies' => '25', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '4', 'name' => 'NAT-02', 'weekday' => '4', 'start_time' => '13:00:00', 'end_time' => '14:40:00', 'vacancies' => '25', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '5', 'name' => 'HAN-01', 'weekday' => '5', 'start_time' => '16:30:00', 'end_time' => '18:00:00', 'vacancies' => '20', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '6', 'name' => 'XAD-01', 'weekday' => '6', 'start_time' => '14:40:00', 'end_time' => '16:30:00', 'vacancies' => '30', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['sport_id' => '7', 'name' => 'ALO-01', 'weekday' => '1', 'start_time' => '10:30:00', 'end_time' => '12:00:00', 'vacancies' => '15', 'created_at' => NOW(), 'updated_at' => NOW()],
        ]);

        // factory(SportClass::class, 10)->create();
    }
}
