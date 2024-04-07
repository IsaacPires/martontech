<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProductsRepository
{

    public function productReport()
    {

        $products = DB::table('products')
            ->selectRaw('
                products.id, 
                products.Name as "Nome Produto",
                products.AlertQuantity as "Quantidade em Alerta",
                products.StockQuantity as "Quatidade em Estoque", 
                suppliers.Name as "Fornecedor"
            ')
            ->leftJoin('suppliers', 'products.suppliers_id', '=', 'suppliers.id')
            ->orderBy('products.created_at', 'desc');

        if (!empty($_GET['ProductName']))
        {
            $products->where('products.Name', 'like', '%' . $_GET['ProductName'] . '%');
        }

        if (!empty($_GET['Supplier']))
        {
            $products->where('products.suppliers_id', '=', $_GET['Supplier']);
        }

        return $products;
    }
}
