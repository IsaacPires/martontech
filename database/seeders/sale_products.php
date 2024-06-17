<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\SaleProducts;
use App\Models\Suppliers;
use Illuminate\Database\Seeder;

class sale_products extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pathFile = storage_path('app/dbfiles/saida.json');

        $datas = json_decode(file_get_contents($pathFile), true);

        foreach ($datas as $data) {
            
            SaleProducts::create([
                'products_id' => array_key_exists('Produto', $data) ? Products::where('Name', 'like', "%{$data['Produto']}%")->value('id') : NULL,
                "SellerName" => array_key_exists('SellerName', $data) ? $data['SellerName'] : NULL,
                "WithdrawalAmount" => array_key_exists('WithdrawalAmount', $data) ? $data['WithdrawalAmount'] : NULL,
                'created_at'        => array_key_exists('created_at', $data) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['created_at']))) : now(),
                'updated_at'        => array_key_exists('created_at', $data) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['created_at']))) : now(),
                "FabricationOrder" => array_key_exists('FabricationOrder', $data) ? $data['FabricationOrder'] : NULL,
                "UnitPrice" => array_key_exists('UnitPrice', $data) ? $data['UnitPrice'] : NULL,
                "TotalPrice" => array_key_exists('TotalPrice', $data) ? $data['TotalPrice'] : NULL,

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
