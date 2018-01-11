<?php

use Illuminate\Database\Seeder;
use App\Bank;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $banks = [
          [
              'bank_name' => 'Citibank'
          ],
          [
              'bank_name' => 'Diamond Bank'
          ],
          [
              'bank_name' => 'Dynamic Standard Bank'
          ],
          [
              'bank_name' => 'Development Financial Pruben Bank'
          ],
          [
              'bank_name' => 'Ecobank Nigeria'
          ],
          [
              'bank_name' => 'Fidelity Bank Nigeria'
          ],
          [
              'bank_name' => 'First Bank of Nigeria'
          ],
          [
              'bank_name' => 'First City Monument Bank'
          ],
          [
              'bank_name' => 'Guaranty Trust Bank'
          ],
          [
              'bank_name' => 'Heritage Bank plc'
          ],
          [
              'bank_name' => 'Keystone Bank'
          ],
          [
              'bank_name' => 'Providus Bank plc'
          ],
          [
              'bank_name' => 'Skye Bank'
          ],
          [
              'bank_name' => 'Stanbic IBTC Bank Nigeria Limited'
          ],
          [
              'bank_name' => 'Standard Chartered Bank'
          ],
          [
              'bank_name' => 'Sterling Bank'
          ],
          [
              'bank_name' => 'Suntrust Bank Nigeria Limited'
          ],
          [
              'bank_name' => 'Union Bank of Nigeria'
          ],
          [
              'bank_name' => 'United Bank for Africa'
          ],
          [
              'bank_name' => 'Unity Bank plc'
          ],
          [
              'bank_name' => 'Wema Bank'
          ],
          [
              'bank_name' => 'Zenith Bank'
          ]
      ];

      foreach ($banks as $key => $value)
        Bank::create($value);
    }
}
