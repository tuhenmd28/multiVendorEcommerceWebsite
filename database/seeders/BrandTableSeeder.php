<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Brand;
class BrandTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $brands = [
            ['id'=>1,'name'=>"Alum","image"=>"","status"=>1],
            ['id'=>2,'name'=>"samsung","image"=>"","status"=>1],
            ['id'=>3,'name'=>"LG","image"=>"","status"=>1],
            ['id'=>4,'name'=>"MI","image"=>"","status"=>1],
            ['id'=>5,'name'=>"Lenovo","image"=>"","status"=>1],
            ['id'=>6,'name'=>"Apple","image"=>"","status"=>1],
        ];
        Brand::insert($brands);
    }
}
