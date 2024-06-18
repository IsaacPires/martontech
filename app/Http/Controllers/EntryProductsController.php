<?php

namespace App\Http\Controllers;

use App\Models\EntryProducts;
use App\Models\Products;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EntryProductsController extends Controller
{
    public function index()
    {
        $entryProducts = DB::table('entry_products')
            ->selectRaw("
            entry_products.id,
            products.name AS 'Produto',
            suppliers.Name as Fornecedor,
            entry_products.Brand as 'Infos Adicionais',
            entry_products.SellerName AS 'Colaborador',
            CONCAT('R$ ', REPLACE(FORMAT(entry_products.UnitPrice, 2), '.', ',')) AS 'Preço por unidade',
            REPLACE(entry_products.WithdrawalAmount, '.', ',') as 'Qntd. de entrada',
            CONCAT('R$ ', REPLACE(FORMAT(entry_products.TotalPrice, 2), '.', ',')) AS 'Preço total',
            DATE_FORMAT(entry_products.created_at, '%d/%m/%Y %H:%i') AS 'Data Criação'

        ")
            ->leftJoin('products', 'entry_products.products_id', '=', 'products.id')
            ->leftJoin('suppliers', 'entry_products.Suppliers_id', '=', 'suppliers.id')->orderBy('entry_products.created_at', 'DESC')
            ->orderByDesc('id');

        if (!empty($_GET['SellerName']))
        {
            $entryProducts->where('entry_products.SellerName', 'like', '%' . $_GET['SellerName'] . '%');
        }

        if (!empty($_GET['product']))
        {
            $entryProducts->where('entry_products.products_id', '=', $_GET['product']);
        }

        if (!empty($_GET['supplier']))
        {
            $entryProducts->where('entry_products.Suppliers_id', '=', $_GET['supplier']);
        }
        $retornoPorPage = !empty($_GET['limiter']) ? (int)$_GET['limiter'] :  50;

        $entryProducts = $entryProducts->paginate($retornoPorPage);

        $products = Products::all();
        $suppliers = Suppliers::all();

        $message = session('success.message');

        $params = $_GET;
        unset($params['page']);
        $queryString = http_build_query($params);

        $nextPage = $entryProducts->nextPageUrl() ? $entryProducts->nextPageUrl() . ($queryString ? '&' . $queryString : '') : null;
        $previousPage = $entryProducts->previousPageUrl() ? $entryProducts->previousPageUrl() . ($queryString ? '&' . $queryString : '') : null;

        $exportCsvUrl = route('entry_products.csv', $params);

        return view('entry_products.index')
            ->with('entryProducts', $entryProducts)
            ->with('products', $products)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previousPage)
            ->with('successMessage', $message)
            ->with('suppliers', $suppliers)
            ->with('exportCsvUrl',  $exportCsvUrl);
    }

    public function create()
    {
        $products = Products::all();
        $suppliers = Suppliers::all();

        return view('entry_products.create')
            ->with('products', $products)
            ->with('suppliers', $suppliers);
    }

    public function store(Request $request)
    {
        $request['TotalPrice'] = str_replace(',', '.', $request['TotalPrice']);
        $request['UnitPrice'] = str_replace(',', '.', $request['UnitPrice']);
        $request['WithdrawalAmount'] = str_replace(',', '.', $request['WithdrawalAmount']);

        EntryProducts::create($request->except('_token'));

        $products = Products::findOrFail($request->products_id);
        $products->StockQuantity += $request->WithdrawalAmount;
        $products->primary_suppliers_id = $request->Suppliers_id;
        $products->update($request->except('_token'));



        return redirect('/entry_products')
            ->with("success.message", "Entrada adicionada com sucesso!");
    }

    public function destroy(int $request)
    {
        $entry = EntryProducts::findOrFail($request);
        $entry->delete();

        return redirect('/entry_products')
            ->with("success.message", "entrada excluída com sucesso!");
    }

    public function edit($id)
    {
        $entryProduct = EntryProducts::findOrFail($id);
        $products = Products::all();
        return view('entry_products.edit')
            ->with('entryProducts', $entryProduct)
            ->with('products', $products);
    }


    public function update(Request $request, $id)
    {
        $entry = EntryProducts::findOrFail($id);
        $product = Products::findOrFail($entry->products_id);

        $request['UnitPrice'] = str_replace(',', '.', $request['UnitPrice']);
        $request['TotalPrice'] = str_replace(',', '.', $request['TotalPrice']);
        $request['WithdrawalAmount'] = str_replace(',', '.', $request['WithdrawalAmount']);

        $result =  $request->WithdrawalAmount - $entry->WithdrawalAmount;

        $product->StockQuantity += $result;

        if (!empty($request->suppliers))
        {
            $product->primary_suppliers_id = $request->suppliers;
        }

        $product->save();

        $entry->update($request->all());

        return redirect('/entry_products')
            ->with("success.message", "Entrada atualizada com sucesso!");
    }

    public function csv()
    {
        $entryProducts = DB::table('entry_products')
            ->selectRaw("
                entry_products.id,
                products.name AS 'Produto',
                entry_products.SellerName AS 'Vendedor',
                entry_products.UnitPrice AS 'Preço por unidade',
                entry_products.WithdrawalAmount AS 'Quantidade de entrada',
                entry_products.TotalPrice AS 'Preço total',
                DATE_FORMAT(entry_products.created_at, '%d/%m/%Y %H:%i') AS 'Data Criação'
            ")->leftJoin("products", "entry_products.products_id", "=", "products.id")
            ->orderByDesc('entry_products.id');;

        if (!empty($_GET['SellerName']))
        {
            $entryProducts->where('entry_products.SellerName', 'like', '%' . $_GET['SellerName'] . '%');
        }

        if (!empty($_GET['product']))
        {
            $entryProducts->where('entry_products.products_id', '=', $_GET['product']);
        }

        $entryProducts = $entryProducts->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="Entradas.csv"',
        ];

        $callback = function () use ($entryProducts)
        {
            $file = fopen('php://output', 'w');
            if ($entryProducts->isNotEmpty())
            {
                $headers = array_keys((array)$entryProducts->first());
                fputcsv($file, $headers);
                foreach ($entryProducts as $entry)
                {
                    fputcsv($file, (array)$entry);
                }
            }
            else
            {
                fputcsv($file, ['No data available']);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
