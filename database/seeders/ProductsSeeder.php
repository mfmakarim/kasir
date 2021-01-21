<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::truncate();

        $products = [
            [
                'nama_barang' => 'Sabun Batang',
                'harga_satuan' => '3000',
                'id' => 1
            ],
            [
                'nama_barang' => 'Mi Instan',
                'harga_satuan' => 2000,
                'id' => 2
            ],
            [
                'nama_barang' => 'Pensil',
                'harga_satuan' => 1000,
                'id' => 3
            ],
            [
                'nama_barang' => 'Kopi Sachet',
                'harga_satuan' => 1500,
                'id' => 4
            ],
            [
                'nama_barang' => 'Air Minum Galon',
                'harga_satuan' => 20000,
                'id' => 5
            ],
        ];

        for($i=0; $i<5; $i++){
            Product::create($products[$i]);
        }
    }
}
