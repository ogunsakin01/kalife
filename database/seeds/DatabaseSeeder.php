<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         $this->call(MarkupTypesSeeder::class);
         $this->call(MarkupValueTypeSeeder::class);
         $this->call(RoleSeeder::class);
         $this->call(TitleSeeder::class);
    }
}
