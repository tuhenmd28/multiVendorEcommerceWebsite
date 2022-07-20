<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Vendor;
class VendorTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $vendorRecords = [
            [
                'id' => 1,
                'name' => 'Tuhen',
                'address' => 'South Islamabad',
                'state' => 'Chittagong',
                'city' => 'Chandpur',
                'country' => 'Bangladesh', 
                'pincode' => '56789',
                'mobile' => '01848494809',
                'email' => 'tuhen@gmail.com',
                'status' => 0
            ]
        ];
        Vendor::insert($vendorRecords);
    }
}
