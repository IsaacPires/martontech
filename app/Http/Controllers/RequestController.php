<?php

namespace App\Http\Controllers;

use App\Models\Orders;
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
            requests.product_id as 'Produto',
            requests.suppliers_id as Fornecedor,
            FORMAT(requests.lastPrice, 2) as 'último Valor',
            FORMAT(requests.currentPrice, 2) as 'Valor Atual',
            requests.quantity as Qntd,
            requests.totalValue as 'Valor Total',
            DATE_FORMAT(requests.created_at, '%d/%m/%Y %H:%i') AS 'Data Criação'
        ")
            ->where('requests.order_id', '=', $id)
            ->orderBy('requests.created_at', 'desc')
            ->paginate(15);

        $nextPage = $requests->nextPageUrl();
        $previusPage = $requests->previousPageUrl();
        $successMessage = session('successMessage');

        $params = !empty($_GET) ? '?' . http_build_query($_GET) : null;
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

        return view('request.create')
            ->with('suppliers', $suppliers)
            ->with('products', $products)
            ->with('orders', $orders)
            ->with('successMessage', $successMessage)
            ->with('requests', $requests)
            ->with('SupRequests', $SupRequests);
    }

    public function store(Request $request)
    {
        $order = orders::where('status', 'A')->latest()->first();

        if (empty($order))
        {
            $newOrder = [
                'status' => 'A',
                'totalValue' => (float) $request->totalValue
            ];

            $order = orders::create($newOrder);
        }
        else
        {

            $newTotalValue = $order->totalValue + $request->totalValue;
            $order->totalValue = $newTotalValue;
            $order->save();
        }
        $request['currentPrice'] = str_replace(',', '.', $request['currentPrice']);
        $request['totalValue'] = str_replace(',', '.', $request['totalValue']);

        $requestData = $request->except('_token');
        $requestData['order_id'] = $order->id;

        ModelsRequest::create($requestData);

        return redirect('/request/create')
            ->with("successMessage", "Pedido de compra adicionado com sucesso!");
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
            $preco = '0.00';
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
