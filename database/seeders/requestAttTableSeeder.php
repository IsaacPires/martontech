<?php

namespace Database\Seeders;

use App\Models\Request;
use Illuminate\Database\Seeder;

class requestAttTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path('app/dbfiles/requestAtt.json');

        if (!file_exists($path))
        {
            return;
        }

        $requestAtts = json_decode(file_get_contents($path), true);

        foreach ($requestAtts as $requestAtt)
        {
            Request::create([
                'product_id' => array_key_exists('product_id', $requestAtt) ? $requestAtt['product_id'] : 0,
                'suppliers_id' => array_key_exists('suppliers_id', $requestAtt) ? $requestAtt['suppliers_id'] : 0,
                'brand' => array_key_exists('StockQuantity', $requestAtt) ? $requestAtt['StockQuantity'] : 0,
                'lastPrice' => array_key_exists('lastPrice', $requestAtt) ? $requestAtt['lastPrice'] : 0,
                'currentPrice' => array_key_exists('currentPrice', $requestAtt) ? $requestAtt['currentPrice'] : 0,
                'quantity' => 0,
                'totalValue' => 0,
                'order_id' => 0,

            ]);
        }
    }
}
