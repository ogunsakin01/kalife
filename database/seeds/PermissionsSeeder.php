<?php

use Illuminate\Database\Seeder;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            [
                'id' => 1,
                'name' => 'create-user',
                'display_name' => 'Create User',
                'description'  => 'Users can create other users'
            ],

            [
                'id' => 2,
                'name' => 'edit-user',
                'display_name' => 'Edit User',
                'description'  => 'Users can alter other users information'
            ],

            [
                'id' => 3,
                'name' => 'create-vat',
                'display_name' => 'Create Vat',
                'description'  => 'Users can create vat'
            ],

            [
                'id' => 4,
                'name' => 'edit-vat',
                'display_name' => 'Edit Vat',
                'description'  => 'Users can edit vat'
            ],

            [
                'id' => 5,
                'name' => 'create-markup',
                'display_name' => 'Create Markup',
                'description'  => 'Users can create markup'
            ],

            [
                'id' => 6,
                'name' => 'edit-markup',
                'display_name' => 'Edit Markup',
                'description'  => 'Users can edit markup'
            ],

            [
                'id' => 7,
                'name' => 'create-markdown',
                'display_name' => 'Create Markdown',
                'description'  => 'Users can create markdown'
            ],

            [
                'id' => 8,
                'name' => 'edit-markdown',
                'display_name' => 'Edit Markdown',
                'description'  => 'Users can edit markdown'
            ],

            [
                'id' => 9,
                'name' => 'create-travel-packages',
                'display_name' => 'Create Travel Packages',
                'description'  => 'Users can create travel packages'
            ],

            [
                'id' => 10,
                'name' => 'edit-travel-packages',
                'display_name' => 'Edit Travel Packages',
                'description'  => 'Users can edit travel packages'
            ],

            [
                'id' => 11,
                'name' => 'create-banks',
                'display_name' => 'Create Banks',
                'description'  => 'Users can create banks'
            ],

            [
                'id' => 12,
                'name' => 'edit-banks',
                'display_name' => 'Edit Banks',
                'description'  => 'Users can edit banks'
            ],

            [
                'id' => 13,
                'name' => 'own-wallet',
                'display_name' => 'Own Wallet',
                'description'  => 'Users can own wallet'
            ],

            [
                'id' => 14,
                'name' => 'view-all-logs',
                'display_name' => 'View All Logs',
                'description'  => 'Users can view all logs'
            ],

            [
                'id' => 15,
                'name' => 'view-all-bookings',
                'display_name' => 'View All Bookings',
                'description'  => 'Users can view all bookings'
            ],

            [
                'id' => 16,
                'name' => 'frontend',
                'display_name' => 'Can access frontend',
                'description'  => 'Customers can access frontend bookings'
            ],

            [
                'id' => 17,
                'name' => 'backend',
                'display_name' => 'Can access backend',
                'description'  => 'Users can access backend'
            ]






        ];

        foreach($permissions as $key => $value){
            \App\Permission::create($value);
        }
    }
}
