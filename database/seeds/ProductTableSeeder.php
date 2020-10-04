<?php

use Illuminate\Database\Seeder;
use App\Product;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $productRecords=[
           [
               'id'=>1,
               'category_id'=>2,
               'section_id'=>1,
               'product_name'=>'Blue Causual T-shirts',
               'product_code'=>'BT001',
               'product_color'=>'Blue',
               'product_price'=>'1500',
               'product_discount'=>'10',
               'product_weight'=>'200',
               'product_video'=>'',
               'main_image'=>'',
               'description'=>'Test Product',
               'wash_care'=>'',
               'fabric'=>'',
               'pattern'=>'',
               'sleeve'=>'',
               'fit'=>'',
               'occassion'=>'',
               'meta_title'=>'',
               'meta_descrition'=>'',
               'meta_keywords'=>'',
               'is_featured'=>'No',
               'status'=>1,
           ],
           [
            'id'=>2,
            'category_id'=>2,
            'section_id'=>1,
            'product_name'=>'Red causual T-shirts',
            'product_code'=>'R001',
            'product_color'=>'Red',
            'product_price'=>'2500',
            'product_discount'=>'10',
            'product_weight'=>'200',
            'product_video'=>'',
            'main_image'=>'',
            'description'=>'Test Product',
            'wash_care'=>'',
            'fabric'=>'',
            'pattern'=>'',
            'sleeve'=>'',
            'fit'=>'',
            'occassion'=>'',
            'meta_title'=>'',
            'meta_descrition'=>'',
            'meta_keywords'=>'',
            'is_featured'=>'No',
            'status'=>1,  
           ],
          
        ];
        Product::insert($productRecords);
    }
}
