<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Suppliers;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductsController extends Controller
{
    private $products;

    public function __construct(ProductsRepository $products)
    {
        $this->products = $products;
    }

    public function index()
    {

        $retornoPorPage = !empty($_GET['limiter']) ? (int)$_GET['limiter'] :  50;

        $products = $this->products->productReport();

        $products = $products->paginate($retornoPorPage);

        $suppliers = Suppliers::all();

        $message = session('success.message');

        $params = $_GET;
        unset($params['page']);
        $queryString = http_build_query($params);

        $nextPage = $products->nextPageUrl() ? $products->nextPageUrl() . ($queryString ? '&' . $queryString : '') : null;
        $previusPage = $products->previousPageUrl() ? $products->previousPageUrl() . ($queryString ? '&' . $queryString : '') : null;

        $exportCsvUrl = route('products.csv', $params);

        return view('products.index')
            ->with('products', $products)
            ->with('exportCsvUrl', $exportCsvUrl)
            ->with('successMessage', $message)
            ->with('nextPage', $nextPage)
            ->with('suppliers', $suppliers)
            ->with('previusPage', $previusPage);
    }

    public function create()
    {
        $suppliers = Suppliers::all();

        return view('products.create')
            ->with('suppliers', $suppliers);
    }

    public function store(Request $request)
    {

        $request['AlertQuantity'] = str_replace(',', '.', $request['AlertQuantity']);

        $products = Products::create($request->except('_token'));

        return redirect('/products')
            ->with("success.message", "Fornecedor '$products->Name' adicionada com sucesso!");
    }

    public function destroy(Request $request)
    {
        $products = Products::findOrFail($request->input('delete_id'));
        $products->delete();

        return redirect('/products')
            ->with("success.message", "'$products->Name' removida com sucesso!");
    }

    public function edit($id)
    {
        $products = Products::find($id);

        $suppliers = Suppliers::all();

        return view('products.edit', ['products' => $products])->with('suppliers', $suppliers);
    }

    public function update(Request $request, $id)
    {
        $products = Products::findOrFail($id);
        $products->update($request->all());

        return redirect('/products')
            ->with("success.message", "Fornecedor '$request->Name' atualizado com sucesso!");
    }

    public function csv()
    {
        $products = DB::table('products')
            ->selectRaw("
                products.id, 
                products.Name as 'Nome Produto',
                products.AlertQuantity as 'Qntd. em Alerta',
                products.StockQuantity as 'Qntd. em Estoque',
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
            )
            ->orderByDesc('products.id');;

        if (isset($_GET['ordenacao']) && !empty($_GET['ordenacao']))
        {
            switch ($_GET['ordenacao'])
            {
                case 'Aging':
                    $products->orderBy('products.created_at');
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

        $products = $products->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products.csv"',
        ];

        $callback = function () use ($products)
        {
            $file = fopen('php://output', 'w');
            if ($products->isNotEmpty())
            {
                $headers = array_keys((array)$products->first());
                fputcsv($file, $headers);
                foreach ($products as $product)
                {
                    fputcsv($file, (array)$product);
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
