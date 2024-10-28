<?php

namespace Database\Seeders;

use App\Models\Products;
use App\Models\Suppliers;
use App\Models\Tools;
use Illuminate\Database\Seeder;

class ToolsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = storage_path('app/dbfiles/tools.json');

        if (!file_exists($path))
        {
            return;
        }

        $tools = json_decode(file_get_contents($path), true);

        foreach ($tools as $key => $tool)
        {
            dd(date('Y-m-d H:i:s', strtotime($tool['Date'])));
            Tools::create([
                'Name' => array_key_exists('Name', $tool) ? $tool['Name'] : 'NI',
                'Date'        => array_key_exists('Date', $tool) ? date('Y-m-d H:i:s', strtotime($tool['Date'])) : date('Y-m-d H:i:s'),
                'Quantity' => array_key_exists('Quantity', $tool) ? $tool['Quantity'] : 0,
                'Number' => array_key_exists('Number', $tool) ? $tool['Number'] : 'SEM MARCAÇÃO',
                'State' => array_key_exists('State', $tool) ? $tool['State'] : 'NI',
                'Owner' => array_key_exists('Owner', $tool) ? $tool['Owner'] : 'NI',
                'Note' => array_key_exists('Note', $tool) ? $tool['Note'] : 'NI',
                'Obs' => array_key_exists('Obs', $tool) ? $tool['Obs'] : 'NI',
                'Status' => array_key_exists('Status', $tool) ? $tool['Status'] : 'NI',
            ]);
        }
    }
}
