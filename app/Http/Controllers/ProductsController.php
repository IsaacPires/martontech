<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Suppliers;
use App\Repositories\ProductsRepository;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $products;

    public function __construct(ProductsRepository $products)
    {
        $this->products = $products;
    }

    public function index()
    {
        $products = $this->products->productReport();

        $products = $products->paginate(15);

        foreach ($products as $product) {
            if (is_null($product->Retirada)) {
                $product->Retirada = 'N/I';
            }
        }

        $suppliers = Suppliers::all();

        $nextPage = $products->nextPageUrl();
        $previusPage = $products->previousPageUrl();
        $message = session('success.message');

        $params = !empty($_GET) ? '?' . http_build_query($_GET) : null;
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
        $products = Products::create($request->except('_token'));

        return redirect('/products')
            ->with("success.message", "Fornecedor '$products->Name' adicionada com sucesso!");
    }

    public function destroy(Request $request)
    {
        $products = Products::findOrFail($request->input('delete_id'));
        $products->delete();

        return redirect('/products')
            ->with("success.message", "Fornecedor '$products->Name' removida com sucesso!");
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
        $products = Products::query();

        if (!empty($_GET['ProductName']))
        {
            $products->where('Name', 'like', '%' . $_GET['ProductName'] . '%');
        }

        if (!empty($_GET['Supplier']))
        {
            $products->where('supplier_id', 'like', '%' . $_GET['Supplier'] . '%');
        }

        $products = $products->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products.csv"',
        ];

        $callback = function () use ($products)
        {
            $file = fopen('php://output', 'w');
            $headers = array_keys($products->first()->getAttributes());
            $headers[] = 'Ações';
            fputcsv($file, $headers);
            foreach ($products as $supplier)
            {
                $row = $supplier->toArray();
                $row[] = '';
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}
