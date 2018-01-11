<?php

use Illuminate\Database\Seeder;
use App\AccountStatus;

class AccountStatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $status = [
            [
                'id' => '0',
                'name' => 'Inactive'
            ],

            [
                'id' => '1',
                'name' => 'Active'
            ]
        ];


        foreach ($status as $key => $value)
        {
          AccountStatus::create($value);
        }
    }
}
