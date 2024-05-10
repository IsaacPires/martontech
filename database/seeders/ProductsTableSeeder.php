<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Obtém todos os IDs dos fornecedores
        $supplierIds = DB::table('suppliers')->pluck('id')->toArray();

        for ($i = 1; $i <= 50; $i++) {
            $supplierId = $supplierIds[array_rand($supplierIds)]; // Seleciona um ID de fornecedor aleatoriamente

            DB::table('products')->insert([
                'Name' => 'Produto ' . $i,
                'AlertQuantity' => rand(1, 10),
                'StockQuantity' => rand(0, 100),
                'suppliers_id' => $supplierId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
