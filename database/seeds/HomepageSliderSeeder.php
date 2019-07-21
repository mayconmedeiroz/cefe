<?php

use Illuminate\Database\Seeder;
use CEFE\HomepageSlider;

class HomepageSliderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HomepageSlider::insert([
            ['title' => 'Primeiro Slide', 'image' => 'default.jpg', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['title' => 'Segundo Slide', 'image' => 'default.jpg', 'created_at' => NOW(), 'updated_at' => NOW()],
            ['title' => 'Terceiro Slide', 'image' => 'default.jpg', 'created_at' => NOW(), 'updated_at' => NOW()],
            ]);

        // factory(HomepageSlider::class, 10)->create();
    }
}
