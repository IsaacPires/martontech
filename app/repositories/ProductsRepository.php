<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class ProductsRepository
{

    public function productReport()
    {

        $products = DB::table('products')
        ->selectRaw("
            products.id, 
            products.Name as 'Nome Produto',
            products.AlertQuantity as 'Quantidade em Alerta',
            products.StockQuantity as 'Quatidade em Estoque', 
            DATE_FORMAT(MAX(sale_products.created_at), '%d/%m/%Y') as Retirada,
            suppliers.Name as 'Fornecedor'
        ")
        ->leftJoin('suppliers', 'products.suppliers_id', '=', 'suppliers.id')
        ->leftJoin('sale_products', 'products.id', '=', 'sale_products.products_id')
        ->leftJoin('requests', 'products.id', '=', 'requests.product_id')
        ->groupBy(
            'products.id', 
            'products.Name',
            'products.AlertQuantity',
            'products.StockQuantity',
            'suppliers.Name'
        );
        if(isset($_GET['ordenacao']) && !empty($_GET['ordenacao']) ){
            switch ($_GET['ordenacao']) {
                case 'Aging':
                    $products->orderBy('Retirada');
                    break;
                case 'Critícos':
                    $products->whereraw('StockQuantity <= AlertQuantity');
                    break;
                case 'Utilizados':
                    $products->whereBetween('requests.created_at', [now()->startOfMonth(), now()]);
                    break;
                
                default:
                $products->orderBy('products.created_at', 'desc');
                break;
            }

        }else{
            $products->orderBy('products.created_at', 'desc');
        }



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
