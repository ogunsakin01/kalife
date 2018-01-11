<?php

use Illuminate\Database\Seeder;
use App\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $user = [
        
          [
              'title' => 1,
              'first_name' => 'Jane',
              'last_name' => 'Doe',
              'other_name' => 'Rita',
              'date_of_birth' => '01/10/1992',
              'email' => 'janedoe@gmail.com',
              'phone_number' => '09023223090',
              'address' => 'Lagos',
              'account_status' => '1',
              'gender' => '2',
              'password' => bcrypt('janedoe'),
          ]
      ];
      
      
      foreach ($user as $key => $value)
      {
        User::create($value);
      }

      DB::table('role_user')->truncate();
      DB::table('role_user')->insert(
          [
              [
                  'user_id'=>'1',
                  'role_id'=>'3'
              ]
          ]
      );
    }
}
