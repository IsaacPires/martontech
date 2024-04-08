<?php

namespace App\Http\Controllers;

use App\Models\orders;
use App\Models\Products;
use App\Models\Request as ModelsRequest;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class RequestController extends Controller
{
    public function create(){
        $successMessage = session('successMessage');
        $orders = orders::where('status', 'A')->latest()->first();
        $requests = '';
        
        if(!empty($orders)){
            $requests = ModelsRequest::where('order_id', $orders->id)->get();
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
}
