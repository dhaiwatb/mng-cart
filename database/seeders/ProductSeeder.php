<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'name' => 'Product 1',
                'price' => 200.00
            ],
            [
                'name' => 'Product 2',
                'price' => 300.00
            ],
            [
                'name' => 'Product 3',
                'price' => 400.00
            ],
            [
                'name' => 'Product 2',
                'price' => 500.00
            ],
        ];

        foreach($products as $product){
            Product::create($product);
        }
    }
}
