<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;   

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('products')->insert([

            [
                'name'        => 'Oppo F19',
                'price'       => '25000',
                'description' => 'Oppo smartphone with great selfie camera',
                'category'    => 'mobile',
                'gallery'     => 'https://propakistani.pk/price/wp-content/uploads/2021/04/Oppo-F19-price-1-200x300.png',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Samsung Smart TV',
                'price'       => '60000',
                'description' => '40-inch Samsung Smart LED TV',
                'category'    => 'tv',
                'gallery'     => 'https://images.samsung.com/is/image/samsung/p6pim/pk/qa85qn800cuxmm/gallery/pk-qled-qn800c-qa85qn800cuxmm-thumb-537262889?$216_216_PNG$',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'LG Smart TV',
                'price'       => '50000',
                'description' => '42-inch LG Smart TV with 4K resolution',
                'category'    => 'tv',
                'gallery'     => 'https://www.shophive.com/media/catalog/product/cache/3875881abdd255ac261538b8462285e9/l/g/lg_oled_evo_77_77c4_4k_ai_smart_tv_2025_1_1.jpg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'name'        => 'Panasonic Fridge',
                'price'       => '40000',
                'description' => 'Double door Panasonic refrigerator with fast cooling',
                'category'    => 'fridge',
                'gallery'     => 'https://yasirelectronics.com/wp-content/uploads/2023/01/Panasonic-Refrigerator-With-Top-Mount-Freezer-NR-BC833VSAE-600x600.jpg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            

        ]);
    }
}