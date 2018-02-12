<?php

use Illuminate\Database\Seeder;
use App\Role;
class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $roles = [

          [
              'id' => 1,
              'name' => 'Customer',
              'display_name' => 'Customer',
              'description' => '',
          ],

          [
              'id' => 2,
              'name' => 'Agent',
              'display_name' => 'Agent',
              'description' => '',
          ],

          [   'id' => 3,
              'name' => 'Super Admin',
              'display_name' => 'Super Admin',
              'description' => '',
          ]
      ];

      foreach ($roles as $key => $value)
      {
        Role::create($value);
      }
    }
}
