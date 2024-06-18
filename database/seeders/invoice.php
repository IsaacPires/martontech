<?php

namespace Database\Seeders;

use App\Models\Invoices;
use App\Models\Products;
use App\Models\SaleProducts;
use App\Models\Suppliers;
use Illuminate\Database\Seeder;

class invoice extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pathFile = storage_path('app/dbfiles/invoice.json');

        $datas = json_decode(file_get_contents($pathFile), true);

        foreach ($datas as $data) {
            
            Invoices::create([
                'ReceivingDate'       => array_key_exists('ReceivingDate', $data) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['ReceivingDate']))) : date('Y-m-d H:i:s'),
                "InvoiceDate"         => array_key_exists('InvoiceDate', $data) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['InvoiceDate']))) : date('Y-m-d H:i:s'),
                "Client"              => array_key_exists('Client', $data) ? $data['Client'] : NULL,
                'NumberInvoice'       => array_key_exists('NumberInvoice', $data) ? $data['NumberInvoice'] : NULL,
                'Material'            => array_key_exists('Material', $data) ? $data['Material'] : NULL,
                "DepartureDate"       => array_key_exists('DepartureDate', $data) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $data['DepartureDate']))) : date('Y-m-d H:i:s'),
                "NumberInvoiceMarton" => array_key_exists('NumberInvoiceMarton', $data) ? $data['NumberInvoiceMarton'] : NULL,
                "FinalTransport"      => array_key_exists('FinalTransport', $data) ? $data['FinalTransport'] : NULL,
            ]);
        } 
    }


}
