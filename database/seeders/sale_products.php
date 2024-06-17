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
                'created_at' => array_key_exists('created_at', $data) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['created_at']))) : date('Y-m-d H:i:s'),
                'updated_at' => array_key_exists('created_at', $data) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['created_at']))) : date('Y-m-d H:i:s'),
                "FabricationOrder" => array_key_exists('FabricationOrder', $data) ? $data['FabricationOrder'] : NULL,
                "UnitPrice" => array_key_exists('UnitPrice', $data) ? $data['UnitPrice'] : NULL,
                "TotalPrice" => array_key_exists('TotalPrice', $data) ? $data['TotalPrice'] : NULL,

            ]);
        } 
    }
}
