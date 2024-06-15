<?php

namespace Database\Seeders;

use App\Models\Suppliers;
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
        $pathFile = storage_path('app\dbfiles\suplliers.json');

        $datas = json_decode(file_get_contents($pathFile), true);


        foreach ($datas as $data) {

            
        $contactPhoneOne = array_key_exists('ContactPhoneOne', $data) ? str_replace(['(', ')', '-', ' '], '', $data['ContactPhoneOne']) : null;

        if (!is_numeric($contactPhoneOne)) {
            $contactPhoneOne = null;
        }

           Suppliers::create([
            'Name' => array_key_exists('Name', $data) ? $data['Name'] : 'NI',
            'Segments'=> array_key_exists('Segments', $data) ? $data['Segments'] : 'NI',
            'Cnpj'=> array_key_exists('CNPJ', $data) ? str_replace(['/','.', '-'], '', $data['CNPJ']) : '12',
            'AddressStreet'=> array_key_exists('AddressStreet', $data) ? $data['AddressStreet'] : 'NI',
            'AddressNumber'=>array_key_exists('AddressNumber', $data) ? $data['AddressNumber'] : '12',
            'AddressNeighborhood'=>array_key_exists('AddressNeighborhood', $data) ? $data['AddressNeighborhood'] : 'NI',
            'AddressCity'=>array_key_exists('AddressCity', $data) ? $data['AddressCity'] : 'NI',
            'AddressState'=>array_key_exists('AddressState', $data) ? $data['AddressState'] : 'NI',
            'AddressZipCode'=>array_key_exists('AddressZipCode', $data) ? $data['AddressZipCode'] : '12' ,
            'ContactNameOne'=>array_key_exists('ContactNameOne', $data) ? $data['ContactNameOne'] : 'NI',
            'ContactPhoneOne'=> $contactPhoneOne,
            'ContactEmailOne'=> array_key_exists('ContactEmailOne', $data) ? $data['ContactEmailOne'] : 'NI'
           ]);
        } 
    }
}
