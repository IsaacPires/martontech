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
    public function create(){
        
        $successMessage = session('successMessage');
        $orders = orders::where('status', 'A')->latest()->first();
        $requests = '';
        
        if(!empty($orders)){
            $requests = ModelsRequest::with('product')->where('order_id', $orders->id)->get();
        }

        $suppliers = Suppliers::all();
        $products = Products::all();


        return view('request.create')
            ->with('suppliers', $suppliers)
            ->with('products', $products)
            ->with('orders', $orders)
            ->with('successMessage', $successMessage)
            ->with('requests', $requests);

    }

    public function store(Request $request){

        $order = orders::where('status', 'A')->latest()->first();

        if(empty($order)){

            $newOrder = [
                'status'=> 'A',
                'totalValue' => (float) $request->totalValue
            ];

            $order = orders::create($newOrder);
        }else{

            $newTotalValue = $order->totalValue + $request->totalValue;
            $order->totalValue = $newTotalValue;
            $order->save(); 
        }

        $requestData = $request->except('_token');
        $requestData['order_id'] = $order->id;

        ModelsRequest::create($requestData);

        return redirect('/request/create')
        ->with("successMessage", "Pedido de compra adicionado com sucesso!");

    }

    public function destroy(Request $request){

        $request = ModelsRequest::findOrFail($request->input('delete_id'));
        $order = orders::findOrFail($request->order_id);

        $order->totalValue -= $request->totalValue ;

        $order->save();
        $request->delete();

        return redirect('/request/create')
            ->with("successMessage", "Requsição removida com sucesso!");

    }

    public function getProductsBySupplier($id)
    {
        $products = Products::where('primary_suppliers_id', $id)->get();

        if(empty($products)){
            $products = Products::where('secondary_supplier_id', $id)->get();
        }
        
        return response()->json($products);
    }

    public function atualizarPreco($id)
    { 
        $produto = DB::table('requests')
        ->select('currentPrice')
        ->orderBy('created_at', 'desc')
        ->where('product_id', $id)
        ->first();

        if ($produto) {
            $preco = $produto->currentPrice;
        } else {
            $preco = '0.00';
        }

        return response()->json($preco);
    }
}
