<?php

namespace App\Http\Controllers;
use App\Models\Orders;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{

    public function index(){

        $successMessage = session('successMessage');

        $orders = DB::table('orders')
            ->selectRaw("
                orders.id, 
                orders.status as Status,
                orders.totalValue as 'Valor total'
            ")
            ->orderBy('orders.created_at', 'desc');

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

        $order->status = 'F';
        $order->save();

        //add logica de disparo de email
    
        return redirect('/order')
            ->with("successMessage", "Requisição de compra criada com sucesso");
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
