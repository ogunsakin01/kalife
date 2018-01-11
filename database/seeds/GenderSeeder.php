<?php

use Illuminate\Database\Seeder;
use App\Gender;

class GenderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $gender = [
          [
              'type' => 'Male'
          ],

          [
              'type' => 'Female'
          ]
        ];

        foreach ($gender as $key => $value)
        {
          Gender::create($value);
        }
    }
}
