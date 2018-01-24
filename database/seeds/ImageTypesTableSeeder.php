<?php

use Illuminate\Database\Seeder;
use App\ImageType;

class ImageTypesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $images = [
            [
                'id' => 1,
                'type' => 'Hotel'
            ],

            [
                'id' => 2,
                'type' => 'Attraction'
            ],

            [
                'id' => 3,
                'type' => 'Profile'
            ],
        ];

        foreach ($images as $key => $value)
        {
           ImageType::create($value);
        }
    }
}
