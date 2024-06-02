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
            sp.FabricationOrder AS 'Ordem de Fabricação ',
            sp.TypeProduction AS 'Tipo de Produto',
            CONCAT('R$ ', REPLACE(FORMAT(sp.UnitPrice, 2), '.', ',')) AS 'Preço por unidade',
            CONCAT('R$ ', REPLACE(FORMAT(sp.TotalPrice, 2), '.', ',')) AS 'Preço total',
            DATE_FORMAT(sp.created_at, '%d/%m/%Y %H:%i') AS 'Data Criação'

        ")
        ->leftJoin('products AS p', 'sp.products_id', '=', 'p.id')
        ->orderBy('sp.created_at', 'desc');

        if (!empty($_GET['SellerName']))
        {
            $saleProducts->where('sp.SellerName', 'like', '%' . $_GET['SellerName'] . '%');
        }

        return $saleProducts;
    }
}
