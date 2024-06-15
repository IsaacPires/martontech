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
        $path = storage_path('app/dbFiles/products.json');

        if (!file_exists($path))
        {
            return;
        }

        $products = json_decode(file_get_contents($path), true);

        foreach ($products as $key => $product)
        {
            Products::create([
                'Name' => array_key_exists('Produto', $product) ? $product['Produto'] : 'NI',
                'AlertQuantity' => array_key_exists(' Qntd. Alerta ', $product) ? $product[' Qntd. Alerta '] : NULL,
                'StockQuantity' => NULL,
                'primary_suppliers_id' => array_key_exists('Fornecedor 1', $product) ? Suppliers::where('Name', 'like', "%{$product['Fornecedor 1']}%")->value('id') : NULL,
                'secondary_supplier_id' => array_key_exists('Fornecedor 2', $product) ? Suppliers::where('Name', 'like', "%{$product['Fornecedor 2']}%")->value('id') : NULL,
                'created_at' => array_key_exists('Data Cadastro', $product) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $product['Data Cadastro']))) : NULL,
                'updated_at' => array_key_exists('Data Cadastro', $product) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $product['Data Cadastro']))) : NULL,
            ]);
        }
    }
}
