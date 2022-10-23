<?php

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'shop_id' => '1',
            'name' => '商品A',
            'description' => '商品Aの説明〜',
            'price' => '7000',
            'stock' => '3'
        ]);
        Product::create([
            'shop_id' => '2',
            'name' => '商品B',
            'description' => '商品Bの説明〜',
            'price' => '5000',
            'stock' => '3'
        ]);
        Product::create([
            'shop_id' => '2',
            'name' => '商品C',
            'description' => '商品Cの説明〜',
            'price' => '500000',
            'stock' => '100'
        ]);
    }
}
