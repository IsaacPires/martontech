<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\Suppliers;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path('app/dbfiles/products.json');

        if (!file_exists($path))
        {
            return;
        }

        $products = json_decode(file_get_contents($path), true);

        foreach ($products as $key => $product)
        {
            Products::create([
                'id' => array_key_exists('id', $product) ? $product['id'] : 'NI',
                'Name' => array_key_exists('Name', $product) ? $product['Name'] : 'NI',
                'AlertQuantity' => array_key_exists('AlertQuantity', $product) ? $product['AlertQuantity'] : 0,
                'StockQuantity' => array_key_exists('StockQuantity', $product) ? $product['StockQuantity'] : 0,
                'primary_suppliers_id' => array_key_exists('primary_suppliers_id', $product) && $product['primary_suppliers_id']    != 'NULL' ? $product['primary_suppliers_id'] : NULL,
                'secondary_supplier_id' => array_key_exists('secondary_supplier_id', $product) && $product['secondary_supplier_id'] != 'NULL' ? $product['secondary_supplier_id'] : NULL,
            ]);
        }
    }
}
