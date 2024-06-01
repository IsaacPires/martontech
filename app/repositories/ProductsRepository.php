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
            REPLACE(products.AlertQuantity, '.', ',') as 'Qntd. em Alerta',
            REPLACE(products.StockQuantity, '.', ',') as 'Qntd. em Estoque',
            s.Name as 'Fornecedor um',
            s2.Name as 'Fornecedor dois',
            DATE_FORMAT(products.created_at, '%d/%m/%Y %H:%i') AS 'Data Criação'
        ")
        ->leftJoin('suppliers AS s', 'products.primary_suppliers_id', '=', 's.id')
        ->leftJoin('suppliers AS s2', 'products.secondary_supplier_id', '=', 's2.id')
        ->leftJoin('sale_products', 'products.id', '=', 'sale_products.products_id')
        ->leftJoin('requests', 'products.id', '=', 'requests.product_id')
        ->groupBy(
            'products.id',
            'products.Name',
            'products.AlertQuantity',
            'products.StockQuantity',
            's.Name',
            's2.Name',
            'products.created_at'
        );

        if (isset($_GET['ordenacao']) && !empty($_GET['ordenacao']))
        {
            switch ($_GET['ordenacao'])
            {
                case 'Aging':
                    $products->orderBy('Retirada');
                    break;
                case 'Criticos':
                    $products->whereraw('StockQuantity <= AlertQuantity');
                    break;
                case 'Utilizados':
                    $products->whereBetween('requests.created_at', [now()->startOfMonth(), now()]);
                    break;

                default:
                    $products->orderBy('products.created_at', 'desc');
                    break;
            }
        }
        else
        {
            $products->orderBy('products.created_at', 'desc');
        }



        if (!empty($_GET['ProductName']))
        {
            $products->where('products.Name', 'like', '%' . $_GET['ProductName'] . '%');
        }

        if (!empty($_GET['Supplier']))
        {
            $supplierId = $_GET['Supplier'];
            $products->where(function ($query) use ($supplierId)
            {
                $query->where('products.primary_suppliers_id', '=', $supplierId)
                    ->orWhere('products.secondary_supplier_id', '=', $supplierId);
            });
        }

        return $products;
    }
}
