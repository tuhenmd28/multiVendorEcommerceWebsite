<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\vendorsBankDetail;
class venderBankDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $venderRecords = [
            [
                'id' => 1,
                'vendor_id' => 1,
                'account_holder_name' => 'Md Tuhen Prodan',
                'bank_name' => 'Bnak Asia',
                'account_number' => '23546765567',
                'bank_ifsc_code' => '676756776',
            ],
        ];
        vendorsBankDetail::insert($venderRecords);
    }
}
