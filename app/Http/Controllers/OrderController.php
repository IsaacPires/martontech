<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Request as ModelsRequest;


class OrderController extends Controller
{

    public function index(){

        $successMessage = session('successMessage');

        $orders = DB::table('orders')
            ->selectRaw("
                orders.id, 
                case
                    when orders.status = 'E' THEN 'Enviado'
                    when orders.status = 'A' THEN 'Aberto'
                    when orders.status = 'N' THEN 'Negado'
                    when orders.status = 'AP' THEN 'Aprovado'
                    Else 'N/i'
                end as Status,
                FORMAT(orders.totalValue, 2) as 'Valor total',
                DATE_FORMAT(orders.created_at, '%d/%m/%Y') as 'Data Criação' 

            ")
            ->orderBy('orders.created_at', 'desc');

            
        if (!empty($_GET['status']))
        {
            $orders->where('orders.status', '=',  $_GET['status'] );
        }

        $orders = $orders->paginate(15);


        $nextPage = $orders->nextPageUrl();
        $previusPage = $orders->previousPageUrl();

        $params = !empty($_GET) ? '?' . http_build_query($_GET) : null;
        $exportCsvUrl = route('orders.csv', $params);
        


        return view('orders.index')
            ->with('orders', $orders)
            ->with('exportCsvUrl', $exportCsvUrl)
            ->with('successMessage', $successMessage)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage);

    }
    
    public function update(Orders $order){
        
        if($order->status != 'AP'){
            $order->status = 'E';
            $order->save();
            $message = 'Requisição de compra criada com sucesso';
        }else{
            $message = 'Está requisição já foi aprovada.';
        }



        //add logica de disparo de email
    
        return redirect('/order')
            ->with("successMessage", $message);
    }

    
    public function destroy(Request $request){

        $orders = Orders::findOrFail($request->input('delete_id'));

        $request = ModelsRequest::where('order_id', $request->input('delete_id'));

        if(!empty($request)){
            $request->delete();
        }

        $orders->delete();

        return redirect('/order')
            ->with("successMessage", "Requisição removida com sucesso!");

    }

    public function edit(Orders $order)
    {
        $order->status = 'A';
        $order->save();

        return redirect('/request/create')
            ->with("successMessage", "Requisição reaberta.");

    }

    public function csv()
    {
        $products = Orders::query();

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
