<?php

namespace Database\Seeders;

use App\Models\vendorsBusinessDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorsBusinessDetailsTable extends Seeder
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
                'shop_name' => 'Tuhen Electronics Store',
                'shop_address' => 'Chitagong,GEC',
                'shop_city' => 'Chitagong',
                'shop_state' => 'Chitagong',
                'shop_country' => 'Bangladesh',
                'shop_pincode' => '12345',
                'shop_mobile' => '01848494809',
                'shop_website' => 'tuhenElectronicstore.com',
                'shop_email' => 'tuhen@gmail.com',
                'address_proof' => 'Passport',
                'address_proof_image' => 'test.jpg',
                'business_license_number' => '56711655',
                'gst_number' => '5671111167',
                'pan_number' => '400125678',
            ],
        ];
        vendorsBusinessDetail::insert($venderRecords);
    }
}
