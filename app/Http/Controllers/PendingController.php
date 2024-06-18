<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Request as ModelsRequest;
use App\Models\Suppliers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PendingController extends Controller
{
    public function index()
    {

        $orders = DB::table('orders')
            ->selectRaw("
                orders.id, 
                case
                    when orders.status = 'E' THEN 'Enviado'
                    when orders.status = 'A' THEN 'Aberto'
                    when orders.status = 'N' THEN 'Negado'
                    when orders.status = 'AC' THEN 'Compra aprovada'
                    when orders.status = 'AP' THEN 'Compra aprovada e recebida'
                    Else 'N/i'
                end as Status,
                CONCAT('R$ ', FORMAT(orders.totalValue, 2, 'de_DE')) as 'Valor total',
                DATE_FORMAT(orders.created_at, '%d/%m/%Y') as 'Data Criação',
                suppliers.Name as Fornecedor
            ")
            ->join('suppliers', 'orders.suppliers_id', '=', 'suppliers.id')
            ->orderByDesc('orders.id');

        if (!empty($_GET['ids']))
        {
            $orders->where('orders.id', '=', $_GET['ids']);
        }

        if (!empty($_GET['supplier']))
        {
            $orders->where('requests.suppliers_id', '=', $_GET['supplier']);
        }

        if (isset($_GET['status']) && !empty($_GET['status']))
        {
            $orders->where('orders.status', '=', $_GET['status']);
        }

        if (!empty($_GET['Supplier']))
        {
            $orders->where('orders.suppliers_id', '=', $_GET['Supplier']);
        }

        $orders = $orders->paginate(15);

        $suppliers = Suppliers::all();
        $successMessage = session('successMessage');
        $params = $_GET;
        unset($params['page']);
        $queryString = http_build_query($params);

        $nextPage = $orders->nextPageUrl() ? $orders->nextPageUrl() . ($queryString ? '&' . $queryString : '') : null;
        $previusPage = $orders->previousPageUrl() ? $orders->previousPageUrl() . ($queryString ? '&' . $queryString : '') : null;
        $exportCsvUrl = route('pending.csv', $params);

        /*  if(!empty($orders)){
            $requests = ModelsRequest::with('product')->where('order_id', $orders->id)->get();
        } */

        return view('pending.index')
            ->with('orders', $orders)
            ->with('suppliers', $suppliers)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage)
            ->with('exportCsvUrl', $exportCsvUrl)
            ->with('successMessage', $successMessage);
    }

    public function accept(Request $request)
    {

        $order = Orders::where('id', $request->id)->first();
        $order->status = 'AC';

        if ($order->save())
        {
            $message = 'Pedido de compra aprovado com sucesso!';
        }
        else
        {
            $message = 'Ocorreu um erro!';
        }

        return redirect('/pending')->with('successMessage', $message);
    }


    public function deny(Request $request)
    {

        $order = Orders::where('id', $request->id)->first();
        $order->status = 'N';

        if ($order->save())
        {
            $message = 'Pedido de compra negado com sucesso!';
        }
        else
        {
            $message = 'Ocorreu um erro!';
        }

        return redirect('/pending')->with('successMessage', $message);
    }

    public function csv()
    {
        $pending = DB::table('orders')
            ->selectRaw("
            orders.id, 
            case
                when orders.status = 'E' THEN 'Enviado'
                when orders.status = 'A' THEN 'Aberto'
                when orders.status = 'N' THEN 'Negado'
                when orders.status = 'AC' THEN 'Aguardando Confirmação'
                when orders.status = 'AP' THEN 'Aprovado'
                Else 'N/i'
            end as Status,
            FORMAT(orders.totalValue, 2) as 'Valor total',
            DATE_FORMAT(orders.created_at, '%d/%m/%Y') as 'Data Criação' 

        ")
            ->orderByDesc('orders.id');;

        if (isset($_GET['status']) && !empty($_GET['status']))
        {
            $pending->where('orders.status', '=', $_GET['status']);
        }

        $pending = $pending->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="Aprovacoes.csv"',
        ];

        $callback = function () use ($pending)
        {
            $file = fopen('php://output', 'w');
            if ($pending->isNotEmpty())
            {
                $headers = array_keys((array)$pending->first());
                fputcsv($file, $headers);
                foreach ($pending as $pen)
                {
                    fputcsv($file, (array)$pen);
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
