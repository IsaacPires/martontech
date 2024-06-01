<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\SaleProducts;
use App\Repositories\SaleProductsRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaleProductsController extends Controller
{
    private $saleProducts;

    public function __construct(SaleProductsRepository $saleProducts)
    {
        $this->saleProducts = $saleProducts;
    }

    public function index()
    {
        $saleProducts = $this->saleProducts->saleProductsReport();
        $saleProducts = $saleProducts->paginate(15);

        $nextPage = $saleProducts->nextPageUrl();
        $previusPage = $saleProducts->previousPageUrl();
        $message = session('success.message');

        $params = !empty($_GET) ? '?' . http_build_query($_GET) : null;
        $exportCsvUrl = route('sale_products.csv', $params);

        return view('sale_products.index')
            ->with('saleProducts', $saleProducts)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage)
            ->with('successMessage', $message)
            ->with('exportCsvUrl', $exportCsvUrl);
    }

    public function create()
    {
        $products = Products::all();

        return view('sale_products.create')
            ->with('products', $products);
    }

    public function store(Request $request)
    {
        $request['UnitPrice'] = str_replace(',', '.', $request['UnitPrice']);
        $request['TotalPrice'] = str_replace(',', '.', $request['TotalPrice']);
        $request['WithdrawalAmount'] = str_replace(',', '.', $request['WithdrawalAmount']);

        $products = Products::findOrFail($request->products_id);
        $products->StockQuantity -= $request->WithdrawalAmount;
        $products->update($request->except('_token'));


        SaleProducts::create($request->except('_token'));

        return redirect('/sale_products')
            ->with("success.message", "Retirada realizada com sucesso");
    }

    public function destroy(Request $request)
    {
        $saleProducts = SaleProducts::findOrFail($request->input('delete_id'));

        $product = Products::findOrFail($saleProducts->products_id);

        $product->StockQuantity += $saleProducts->WithdrawalAmount;
        $product->save();

        $saleProducts->delete();

        return redirect('/sale_products')
            ->with("success.message", "Retirada removida com sucesso");
    }

    public function edit($id)
    {
        $saleProducts = SaleProducts::find($id);
        $products = Products::all();

        return view('sale_products.edit', ['saleProducts' => $saleProducts])->with('products', $products);
    }

    public function update(Request $request, $id)
    {
        $saleProducts = SaleProducts::findOrFail($id);
        $product = Products::findOrFail($saleProducts->products_id);

        $request['UnitPrice'] = str_replace(',', '.', $request['UnitPrice']);
        $request['TotalPrice'] = str_replace(',', '.', $request['TotalPrice']);
        $request['WithdrawalAmount'] = str_replace(',', '.', $request['WithdrawalAmount']);

        $result =  $request->WithdrawalAmount - $saleProducts->WithdrawalAmount;

        $product->StockQuantity -= $result;
        $product->save();


        $saleProducts->update($request->all());

        return redirect('/sale_products')
            ->with("success.message", "Retirada atualizada com sucesso");
    }

    public function csv()
    {
        $saleProducts = DB::table('sale_products', 'sp')
            ->selectRaw("
            sp.id,
            p.Name AS 'Produto',
            sp.SellerName AS 'Colaborador',
            sp.WithdrawalAmount AS 'Movimentações',
            sp.FabricationOrder AS 'Pedido de fabricação',
            sp.TypeProduction AS 'Tipo de Produto',
            sp.UnitPrice AS 'Preço por unidade',
            sp.TotalPrice AS 'Preço total',
            DATE_FORMAT(sp.created_at, '%d/%m/%Y %H:%i') AS 'Data Criação'
        ")
            ->leftJoin('products AS p', 'sp.products_id', '=', 'p.id')
            ->orderBy('sp.created_at', 'desc');

        if (!empty($_GET['SellerName']))
        {
            $saleProducts->where('sp.SellerName', 'like', '%' . $_GET['SellerName'] . '%');
        }

        $saleProducts = $saleProducts->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="sale_products.csv"',
        ];

        $callback = function () use ($saleProducts)
        {
            $file = fopen('php://output', 'w');
            if ($saleProducts->isNotEmpty())
            {
                $headers = array_keys((array)$saleProducts->first());
                fputcsv($file, $headers);
                foreach ($saleProducts as $sale)
                {
                    fputcsv($file, (array)$sale);
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
