<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRecords = [
            ['id'=>2,
            'name'=>'Tuhen',
            'type'=>'vender',
            'vendor_id'=>1,
            'mobile'=>'01848494809',
            'email'=>'tuhen@gmail.com',
            'password'=>'$2a$12$ANj7vLkpiLj9vnk0e6va3uLeDsX3EmdNO2NPLgAIoTAE1.iq.hdOa',
            'image'=>'',
            'status'=>0,]
        ];

        Admin::insert($adminRecords);
    }
}
