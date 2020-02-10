<?php

use Illuminate\Database\Seeder;
use App\Entity\Exercise;

class ExercisesTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(Exercise::class, 20)->create();
    }
}
