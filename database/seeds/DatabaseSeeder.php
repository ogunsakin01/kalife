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
         $this->call(GenderSeeder::class);
         $this->call(AccountStatusSeeder::class);
         $this->call(UserSeeder::class);
         $this->call(AirlineSeeder::class);
         $this->call(AirportSeeder::class);
         $this->call(EquipmentSeeder::class);
         $this->call(HotelAmenitySeeder::class);
         $this->call(HotelAreaSeeder::class);
         $this->call(HotelRoomSeeder::class);
         $this->call(HotelSeeder::class);
         $this->call(BankSeeder::class);
         $this->call(BankDetailsSeeder::class);
         $this->call(PermissionsSeeder::class);
    }
}
