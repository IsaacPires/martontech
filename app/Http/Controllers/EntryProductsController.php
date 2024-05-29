<?php

namespace App\Http\Controllers;

use App\Models\EntryProducts;
use App\Models\Products;
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
                entry_products.SellerName AS 'Vendedor',
                entry_products.UnitPrice AS 'Preço por unidade',
                entry_products.WithdrawalAmount AS 'Quantidade de entrada',
                entry_products.TotalPrice AS 'Preço total'
            ")
            ->leftJoin("products", "entry_products.products_id", "=", "products.id");

        if (!empty($_GET['SellerName']))
        {
            $entryProducts->where('entry_products.SellerName', 'like', '%' . $_GET['SellerName'] . '%');
        }

        if (!empty($_GET['product']))
        {
            $entryProducts->where('entry_products.products_id', '=', $_GET['product']);
        }

        $entryProducts = $entryProducts->paginate(15);

        $products = Products::all();

        $nextPage = $entryProducts->nextPageUrl();
        $previusPage = $entryProducts->previousPageUrl();
        $message = session('success.message');

        $params = !empty($_GET) ? '?' . http_build_query($_GET) : null;
        $exportCsvUrl = route('entry_products.csv', $params);

        return view('entry_products.index')
            ->with('entryProducts', $entryProducts)
            ->with('products', $products)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage)
            ->with('successMessage', $message)
            ->with('exportCsvUrl',  $exportCsvUrl);
    }

    public function create()
    {
        $products = Products::all();

        return view('entry_products.create')->with('products', $products);;
    }

    public function store(Request $request)
    {
        $entryProducts = EntryProducts::create($request->except('_token'));

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
                entry_products.TotalPrice AS 'Preço total'
            ")->leftJoin("products", "entry_products.products_id", "=", "products.id");

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
