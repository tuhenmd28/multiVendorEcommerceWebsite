<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $products = [
            ['id'=>1,'section_id'=>2,'category_id'=>5,'brand_id'=>4,'vendor_id'=>1,'admin_id'=>0,'admin_type'=>'vendor','product_name'=>'Xiaomi 12 Pro','product_code'=>'X12PRO','product_color'=>'blue','product_price'=>99999,'product_discount'=>10,'product_weight'=>285,'product_image'=>'','product_video'=>'','description'=>'','meta_title'=>'','meta_keyword'=>'','meta_description'=>'','is_featured'=>'Yes','status'=>1],
            ['id'=>2,'section_id'=>1,'category_id'=>6,'brand_id'=>1,'vendor_id'=>0,'admin_id'=>1,'admin_type'=>'superadmin','product_name'=>'red casul T-Shirt','product_code'=>'RTS','product_color'=>'red','product_price'=>999,'product_discount'=>20,'product_weight'=>300,'product_image'=>'','product_video'=>'','description'=>'','meta_title'=>'','meta_keyword'=>'','meta_description'=>'','is_featured'=>'Yes','status'=>1]
        ];
        Product::insert($products);
    }
}
