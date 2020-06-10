<?php

use Illuminate\Database\Seeder;

class TermTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\TermType::class, 3)->create();
    }
}
