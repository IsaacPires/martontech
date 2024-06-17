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
        $path = storage_path('app/dbFiles/entry_products.json');

        if (!file_exists($path))
        {
            return;
        }

        $entryProducts = json_decode(file_get_contents($path), true);

        foreach ($entryProducts as $key => $entryProduct)
        {
            EntryProducts::create([
                'products_id'       => array_key_exists('Products_name', $entryProduct) ? Products::where('Name', 'like', "%{$entryProduct['Products_name']}%")->value('id') : NULL,
                'SellerName'        => array_key_exists('SellerName', $entryProduct) ? $entryProduct['SellerName'] : NULL,
                'Suppliers_id'      => array_key_exists('Suppliers_name', $entryProduct) ? Suppliers::where('Name', 'like', "%{$entryProduct['Suppliers_name']}%")->value('id') : NULL,
                'Brand'             => array_key_exists('Brand', $entryProduct) ? $entryProduct['Brand'] : NULL,
                'UnitPrice'         => array_key_exists('UnitPrice', $entryProduct) && is_numeric($entryProduct['UnitPrice']) ? $entryProduct['UnitPrice'] : 0.00,
                "WithdrawalAmount"  => array_key_exists('WithdrawalAmount.', $entryProduct) ? $entryProduct['WithdrawalAmount.'] : NULL,
                'TotalPrice'        => array_key_exists('TotalPrice', $entryProduct) && is_numeric($entryProduct['TotalPrice']) ? $entryProduct['TotalPrice'] : 0.00,
                'created_at'        => array_key_exists('Created_at', $entryProduct) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $entryProduct['Created_at']))) : date('Y-m-d H:i:s'),
                'updated_at'        => array_key_exists('Created_at', $entryProduct) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $entryProduct['Created_at']))) : date('Y-m-d H:i:s')
            ]);
        }
    }
}
