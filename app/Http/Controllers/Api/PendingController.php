<?php 

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Orders;

class PendingController extends Controller
{

    public function accept($id)
    {
        $order = Orders::where('id', $id)->first();

        if ($order) {
            $order->status = 'AC';
    
            if ($order->save())
                return response()->json(['Pedido de compra aprovado com sucesso!'], 200);
            else
                return response()->json(['Ocorreu um erro ao aceitar o pedido!'], 500);
            
        }
    
        return response()->json(['Pedido não encontrado!'], 404);
    }

    public function deny($id)
    {
        $order = Orders::where('id', $id)->first();

        if ($order) {
            $order->status = 'N';
    
            if ($order->save())
                return response()->json(['Pedido Negado com sucesso!'], 200);
            else
                return response()->json(['Ocorreu um erro ao negar o pedido!'], 500);
            
        }
    
        return response()->json(['Pedido não encontrado!'], 404);
    }

}