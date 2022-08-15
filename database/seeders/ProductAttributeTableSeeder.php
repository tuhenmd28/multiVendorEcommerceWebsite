<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\ProductAttribute;
class ProductAttributeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productAttribute = [
            ['id'=>1,"product_id"=>3,"size"=>'small','price'=>400,'stock'=>30,"SKU"=>'TAA46-S','status'=>1],
            ['id'=>2,"product_id"=>3,"size"=>'medium','price'=>500,'stock'=>20,"SKU"=>'TAA46-M','status'=>1],
            ['id'=>3,"product_id"=>3,"size"=>'large','price'=>600,'stock'=>50,"SKU"=>'TAA46-L','status'=>1],
        ];
        ProductAttribute::insert($productAttribute);
    }
}
