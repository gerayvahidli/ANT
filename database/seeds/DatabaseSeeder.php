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
         $this->call(ArticlesTableSeeder::class);
        $this->call(TermTypesTableSeeder::class);
        $this->call(TermsTableSeeder::class);
        $this->call(FaqsTableSeeder::class);
    }
}
