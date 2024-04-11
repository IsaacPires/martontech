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
                sp.SellerName AS 'Vendedor',
                sp.WithdrawalAmount AS 'Quantidade vendida',
                sp.FabricationOrder AS 'Pedido de fabricação',
                sp.TypeProduction AS 'Tipo de produção',
                sp.UnitPrice AS 'Preço por unidade',
                sp.TotalPrice AS 'Preço total'
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
