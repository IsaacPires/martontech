<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendingController extends Controller
{
    public function index(){

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
            ->orderBy('orders.created_at', 'desc')
            ->where('orders.status', '!=', 'A');

            
        if (!empty($_GET['status']))
        {
            $orders->where('orders.status', '=',  $_GET['status'] );
        }

        $orders = $orders->paginate(15);

        $nextPage = $orders->nextPageUrl();
        $previusPage = $orders->previousPageUrl();
        $successMessage = session('successMessage');

        $params = !empty($_GET) ? '?' . http_build_query($_GET) : null;
        $exportCsvUrl = route('pending.csv', $params);

       /*  if(!empty($orders)){
            $requests = ModelsRequest::with('product')->where('order_id', $orders->id)->get();
        } */

        return view('pending.index')
            ->with('orders', $orders)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage)
            ->with('exportCsvUrl', $exportCsvUrl)
            ->with('successMessage', $successMessage);

    }

    public function csv()
    {
        $orders = Orders::where('status', 'E')->paginate(15);

        if (!empty($_GET['ProductName']))
        {
            $orders->where('Name', 'like', '%' . $_GET['ProductName'] . '%');
        }

        if (!empty($_GET['Supplier']))
        {
            $orders->where('supplier_id', 'like', '%' . $_GET['Supplier'] . '%');
        }

        $orders = $orders->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="products.csv"',
        ];

        $callback = function () use ($orders)
        {
            $file = fopen('php://output', 'w');
            $headers = array_keys($orders->first()->getAttributes());
            $headers[] = 'Ações';
            fputcsv($file, $headers);
            foreach ($orders as $supplier)
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
