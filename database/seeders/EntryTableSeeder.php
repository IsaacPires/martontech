<?php

namespace Database\Seeders;

use App\Models\EntryProducts;
use App\Models\Products;
use App\Models\Suppliers;
use Illuminate\Database\Seeder;

class EntryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path('app/dbfiles/entry_products.json');

        $datas = json_decode(file_get_contents($path), true);

        foreach ($datas as $data)
        {
            EntryProducts::create([
                'products_id'       => array_key_exists('Products_name', $data) ? Products::where('Name', 'like', "%{$data['Products_name']}%")->value('id') : NULL,
                'SellerName'        => array_key_exists('SellerName', $data) ? $data['SellerName'] : NULL,
                'Suppliers_id'      => array_key_exists('Suppliers_name', $data) ? Suppliers::where('Name', 'like', "%{$data['Suppliers_name']}%")->value('id') : NULL,
                'Brand'             => array_key_exists('Brand', $data) ? $data['Brand'] : NULL,
                'UnitPrice'         => array_key_exists('UnitPrice', $data) && is_numeric($data['UnitPrice']) ? $data['UnitPrice'] : 0.00,
                "WithdrawalAmount"  => array_key_exists('WithdrawalAmount.', $data) ? $data['WithdrawalAmount.'] : NULL,
                'TotalPrice'        => array_key_exists('TotalPrice', $data) && is_numeric($data['TotalPrice']) ? $data['TotalPrice'] : 0.00,
                'created_at'        => array_key_exists('Created_at', $data) ? $this->validarData($data['Created_at']) : now(),
                'updated_at'        => array_key_exists('Created_at', $data) ? $this->validarData($data['Created_at']) : now(),
            ]);
        }
    }

    function validarData($data)
    {
        // Verifica se a data está no formato correto
        if (preg_match('/^\d{2}\/\d{2}\/\d{4} \d{2}:\d{2}:\d{2}\d{0,3}$/', $data)) {
            // Se tiver 3 ou mais dígitos nos segundos, ajusta para 2 dígitos
            if (strlen(substr($data, 17)) > 2) {
                $data = substr($data, 0, 17) . substr($data, 17, 2);
            }
            return date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data)));
        }
        // Se não estiver no formato correto, retorna a data original
        return $data;
    }
}
