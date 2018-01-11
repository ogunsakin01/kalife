git commit -m "[] description" <?php

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
              'name' => 'Customer',
              'display_name' => 'Customer',
              'description' => '',
          ],

          [
              'name' => 'Agent',
              'display_name' => 'Agent',
              'description' => '',
          ],

          [
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
