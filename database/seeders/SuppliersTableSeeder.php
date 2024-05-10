<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SuppliersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 20; $i++) {
            DB::table('suppliers')->insert([
                'Name' => 'Fornecedor ' . $i,
                'Segments' => 'Segmento ' . $i,
                'Cnpj' => '1234567890123', // CNPJ fictício para exemplo
                'AddressStreet' => 'Rua do Fornecedor ' . $i,
                'AddressNumber' => $i,
                'AddressNeighborhood' => 'Bairro do Fornecedor ' . $i,
                'AddressCity' => 'Cidade do Fornecedor ' . $i,
                'AddressState' => 'UF',
                'AddressZipCode' => '12345678',
                'ContactNameOne' => 'Contato 1 do Fornecedor ' . $i,
                'ContactNameTwo' => 'Contato 2 do Fornecedor ' . $i,
                'ContactPhoneOne' => '1123456789',
                'ContactPhoneTwo' => '1123456789',
                'ContactEmailOne' => 'contato1@fornecedor' . $i . '.com',
                'ContactEmailTwo' => 'contato2@fornecedor' . $i . '.com',
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
