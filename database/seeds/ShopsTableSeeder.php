<?php

use Illuminate\Database\Seeder;
use App\Models\Shop;

class ShopsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::create([
            'user_id' => '1',
            'name' => 'CAFE A',
            'description' => 'cafe Aの説明〜',
        ]);
        Shop::create([
            'user_id' => '2',
            'name' => 'CAFE B',
            'description' => 'cafe Bの説明〜',
        ]);
    }
}
