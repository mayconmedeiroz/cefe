<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UsersTableSeeder::class,
            SchoolYearsTableSeeder::class,
            SchoolsTableSeeder::class,
            SchoolClassesTableSeeder::class,
            SportsTableSeeder::class,
            SportClassesTableSeeder::class,
            ClassTeachersTableSeeder::class,
            StudentSchoolClassesTableSeeder::class,
            StudentClassesTableSeeder::class,
            EvaluationsTableSeeder::class,
            SecretariesTableSeeder::class,
            #ArticleSeeder::class,
            HomepageSliderSeeder::class,
        ]);
    }
}
