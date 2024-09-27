<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class SaleProductsRepository
{
    public function saleProductsReport()
    {
        $saleProducts = DB::table('sale_products', 'sp')
            ->selectRaw("
            sp.id,
            p.Name AS 'Produto',
            sp.SellerName AS 'Colaborador',
            REPLACE( sp.WithdrawalAmount, '.', ',') as 'Quantidade',
            sp.FabricationType AS 'Tipo de Fabricação ',
            sp.TypeProduction AS 'Tipo de Produto',
            sp.FabricationOrder AS 'Ordem de Fabricação',
            CONCAT('R$ ', REPLACE(FORMAT(sp.UnitPrice, 2), '.', ',')) AS 'Preço por unidade',
            CONCAT('R$ ', REPLACE(FORMAT(sp.TotalPrice, 2), '.', ',')) AS 'Preço total',
            DATE_FORMAT(sp.created_at, '%d/%m/%Y %H:%i') AS 'Data Criação'

        ")
            ->leftJoin('products AS p', 'sp.products_id', '=', 'p.id')
            ->orderByDesc('sp.id');

        if (!empty($_GET['fabricationOrder']))
        {
            $saleProducts->where('sp.FabricationOrder', 'like', '%' . $_GET['fabricationOrder'] . '%');
        }
        if (!empty($_GET['FabricationType']))
        {
            $saleProducts->where('sp.FabricationType', '=', $_GET['FabricationType']);
        }

        if (!empty($_GET['TypeProduction']))
        {
            $saleProducts->where('sp.TypeProduction', '=', $_GET['TypeProduction']);
        }

        if (!empty($_GET['product']))
        {
            $saleProducts->where('p.Name', 'like', '%' . $_GET['product'] . '%');
        }

        if (!empty($_GET['SellerName']))
        {
            $saleProducts->where('sp.SellerName', 'like', '%' . $_GET['SellerName'] . '%');
        }

        return $saleProducts;
    }
}
