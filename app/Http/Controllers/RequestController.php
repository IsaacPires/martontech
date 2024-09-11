<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Owners;
use App\Models\Products;
use App\Models\Request as ModelsRequest;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RequestController extends Controller
{


    public function index($id)
    {
        $requests = DB::table('requests')
            ->selectRaw("
            requests.id,
            products.Name as 'Produto',
            suppliers.Name as Fornecedor,
            CONCAT('R$ ', FORMAT(requests.lastPrice, 2, 'de_DE')) as 'Último Valor',
            CONCAT('R$ ', FORMAT(requests.currentPrice, 2, 'de_DE')) as 'Valor Atual',
            REPLACE(requests.quantity, '.', ',') as 'Quantidade',
            CONCAT('R$ ', FORMAT(requests.totalValue, 2, 'de_DE')) as 'Valor Total',
            requests.brand as 'Info Adicional',
            DATE_FORMAT(requests.created_at, '%d/%m/%Y %H:%i') AS 'Data Criação'
        ")
            ->join('products', 'requests.product_id', '=', 'products.id')
            ->join('suppliers', 'requests.suppliers_id', '=', 'suppliers.id')
            ->where('requests.order_id', '=', $id)
            ->orderByDesc('requests.id')
            ->paginate(15);

        $successMessage = session('successMessage');
        $params = $_GET;
        unset($params['page']);
        $queryString = http_build_query($params);

        $nextPage = $requests->nextPageUrl() ? $requests->nextPageUrl() . ($queryString ? '&' . $queryString : '') : null;
        $previusPage = $requests->previousPageUrl() ? $requests->previousPageUrl() . ($queryString ? '&' . $queryString : '') : null;
        $exportCsvUrl = route('pending.csv', $params);

        return view('request.index')
            ->with('requests', $requests)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage)
            ->with('exportCsvUrl', $exportCsvUrl)
            ->with('successMessage', $successMessage);
    }

    public function create()
    {
        $successMessage = session('successMessage');
        $orders = orders::where('status', 'A')->latest()->first();
        $requests = '';
        $SupRequests = '';

        if (!empty($orders) && $orders->totalValue > '0')
        {
            $requests = ModelsRequest::with('product')->where('order_id', $orders->id)->get();
            $SupRequests = isset($requests[0]->suppliers_id) ? $requests[0]->suppliers_id : $requests;
        }

        $suppliers = Suppliers::all();
        $products = Products::all();
        $owners = Owners::all();



        return view('request.create')
            ->with('suppliers', $suppliers)
            ->with('products', $products)
            ->with('orders', $orders)
            ->with('owners', $owners)
            ->with('successMessage', $successMessage)
            ->with('requests', $requests)
            ->with('SupRequests', $SupRequests);
    }

    public function store(Request $request)
    {
        $order = orders::where('status', 'A')->latest()->first();
       
        $request['currentPrice'] = str_replace(',', '.', $request['currentPrice']);
        $request['totalValue'] = str_replace(',', '.', $request['totalValue']);
        $request['lastPrice'] = str_replace(',', '.', $request['lastPrice']);

        if (empty($order))
        {
            $newOrder = [
                'status' => 'A',
                'totalValue' => (float) $request->totalValue,
                'suppliers_id' => (float) $request->suppliers_id,
                'owner_id' => (integer) $request->owner
            ];
            $order = orders::create($newOrder);
        }
        else
        {
           
            $newTotalValue = (float)$order->totalValue + (float)$request->totalValue;
            $order->totalValue = $newTotalValue;
            $order->save();
        }


        $requestData = $request->except('_token');
        $requestData['order_id'] = $order->id;

        ModelsRequest::create($requestData);

        return redirect('/request/create')
            ->with("successMessage", "Item adicionado com sucesso!");
    }

    public function destroy(Request $request)
    {

        $request = ModelsRequest::findOrFail($request->input('delete_id'));
        $order = orders::findOrFail($request->order_id);

        $order->totalValue -= $request->totalValue;

        $order->save();
        $request->delete();

        return redirect('/request/create')
            ->with("successMessage", "Item removido com sucesso!");
    }
    /* 
    public function getProductsBySupplier($id)
    {
        $products = Products::where('primary_suppliers_id', $id)->get();

        if(empty($products)){
            $products = Products::where('secondary_supplier_id', $id)->get();
        }
        
        return response()->json($products);
    } */

    public function atualizarPreco($id)
    {
        $produto = DB::table('requests')
            ->select('currentPrice')
            ->orderBy('created_at', 'desc')
            ->where('product_id', $id)
            ->first();

        if ($produto)
        {
            $preco = $produto->currentPrice;
        }
        else
        {
            $preco = 0.00;
        }

        return response()->json($preco);
    }

    public function getRequestInfo($order_id)
    {
        // Buscando os campos suppliers_id, currentPrice e quantity baseado no order_id fornecido
        $requests = DB::table('requests')
            ->select('products.Name', 'requests.currentPrice', 'requests.quantity')
            ->join('products', 'requests.id', '=', 'products.id')
            ->where('requests.order_id', $order_id)
            ->orderBy('requests.created_at', 'desc')
            ->get();

        return response()->json($requests);
    }
}
