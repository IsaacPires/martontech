<?php

namespace App\Http\Controllers;

use App\Mail\notifyCreated;
use App\Models\EntryProducts;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Request as ModelsRequest;
use App\Models\Suppliers;
use Illuminate\Support\Facades\Mail;

class OrderController extends Controller
{

    public function index()
    {

        $successMessage = session('successMessage');

        $orders = DB::table('orders')
            ->selectRaw("
        orders.id,
        CASE
            WHEN orders.status = 'E' THEN 'Enviado'
            WHEN orders.status = 'A' THEN 'Aberto'
            WHEN orders.status = 'N' THEN 'Negado'
            WHEN orders.status = 'AC' THEN 'Compra aprovada'
            WHEN orders.status = 'AP' THEN 'Compra aprovada e recebida'
            ELSE 'N/i'
        END as Status,
        CONCAT('R$ ', REPLACE(REPLACE(FORMAT(MAX(orders.totalValue), 2), ',', ''), '.', ',')) as 'Valor total',
        DATE_FORMAT(MAX(orders.created_at), '%d/%m/%Y') as 'Data Criação',
        suppliers.Name as Fornecedor
    ")
            ->join('suppliers', 'orders.suppliers_id', '=', 'suppliers.id')
            ->groupBy('orders.id', 'orders.status', 'suppliers.Name')
            ->orderByDesc('orders.id');;

        if (!empty($_GET['status']))
        {
            $orders->where('orders.status', '=', $_GET['status']);
        }
        if (!empty($_GET['ids']))
        {
            $orders->where('orders.id', '=', $_GET['ids']);
        }

        if (!empty($_GET['Supplier']))
        {
            $orders->where('orders.suppliers_id', '=', $_GET['Supplier']);
        }
        $retornoPorPage = !empty($_GET['limiter']) ? (int)$_GET['limiter'] :  50;
        $orders = $orders->paginate($retornoPorPage);

        $suppliers = Suppliers::all();
        $nextPage = $orders->nextPageUrl();
        $previusPage = $orders->previousPageUrl();

        $params = !empty($_GET) ? '?' . http_build_query($_GET) : null;
        $exportCsvUrl = route('order.csv', $params);


        return view('orders.index')
            ->with('orders', $orders)
            ->with('suppliers', $suppliers)
            ->with('exportCsvUrl', $exportCsvUrl)
            ->with('successMessage', $successMessage)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage);
    }

    public function accept($id)
    {
        $mRequests = ModelsRequest::where('order_id', $id)->get();

        try
        {
            $orders = Orders::find($id);
            $mRequests = ModelsRequest::where('order_id', $id)->get();

            foreach ($mRequests as $mRequest)
            {
                $entry = new EntryProducts();

                $entry->products_id = $mRequest->product_id;
                $entry->SellerName = 'Via Requisição';
                $entry->Suppliers_id = $mRequest->suppliers_id;
                $entry->Brand = $mRequest->brand;
                $entry->UnitPrice = $mRequest->currentPrice;
                $entry->WithdrawalAmount = $mRequest->quantity;
                $entry->TotalPrice = $mRequest->totalValue;

                $entry->save();

                $product = Products::find($mRequest->product_id);
                $product->StockQuantity += $mRequest->quantity;
                $product->save();
            }
            $orders->status = 'AP';
            $orders->save();

            $message = 'Estoque atualizado com sucesso';
        }
        catch (\Throwable $th)
        {
            $message = "Erro encontrado no sistema: " . $th->getMessage();
        }


        return redirect('/order')
            ->with("successMessage", $message);
    }

    public function update(Orders $order)
    {
        $order->status = 'E';
        $order->save();
        $message = 'Requisição de compra criada com sucesso';

        //$notify = new notifyCreated();

        //Mail::to(['isaacpires1005@gmail.com', 'isaac.alves.1005@gmail.com'])->send($notify);

        return redirect('/order')
            ->with("successMessage", $message);

        try
        {
        }
        catch (\Throwable $th)
        {
            return redirect('/order')
                ->with("successMessage", 'Falha ao atualizar requisição');
        }
    }


    public function destroy(Request $request)
    {


        try
        {

            $orders = Orders::findOrFail($request->input('delete_id'));

            if ($orders->status == 'AP')
            {
                return redirect('/order')
                    ->with("successMessage", "Está requisição já foi aprovada.");
            }


            $request = ModelsRequest::where('order_id', $request->input('delete_id'));

            if (!empty($request))
            {
                $request->delete();
            }

            $orders->delete();

            return redirect('/order')
                ->with("successMessage", "Requisição removida com sucesso!");
        }
        catch (\Throwable $th)
        {
            return redirect('/order')
                ->with("successMessage", "Falha na remoção da requisição.");
        }
    }

    public function edit(Orders $order)
    {

        try
        {
            if ($order->status != 'AP')
            {

                $order->status = 'A';
                $order->save();
            }
            else
            {
                return redirect('/order')
                    ->with("successMessage", "Está requisição já foi aprovada.");
            }

            return redirect('/request/create')
                ->with("successMessage", "Requisição reaberta.");
        }
        catch (\Throwable $th)
        {
            return redirect('/request/create')
                ->with("successMessage", "Falha ao reabrir a requisição.");
        }
    }

    public function csv()
    {
        $orders = DB::table('orders')
            ->selectRaw("
            orders.id AS id , 
            suppliers.Name as Fornecedor,
            case
                when orders.status = 'E' THEN 'Enviado'
                when orders.status = 'A' THEN 'Aberto'
                when orders.status = 'N' THEN 'Negado'
                when orders.status = 'AC' THEN 'Aguardado Confirmação'
                when orders.status = 'AP' THEN 'Aprovado'
                Else 'N/i'
            end as Status,
            REPLACE(REPLACE(FORMAT(MAX(orders.totalValue), 2), ',', ''), '.', ',') as 'Valor total',
            DATE_FORMAT(MAX(orders.created_at), '%d/%m/%Y') as 'Data Criação'
        ")
            ->join('requests', 'orders.id', '=', 'requests.order_id')
            ->join('suppliers', 'suppliers.id', '=', 'requests.suppliers_id')
            ->orderByDesc('orders.id')
            ->groupBy('orders.id', 'suppliers.Name', 'orders.status');

        if (!empty($_GET['status']))
        {
            $orders->where('orders.status', '=', $_GET['status']);
        }

        $orders = $orders->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="Requisicoes.csv"',
        ];

        $callback = function () use ($orders)
        {
            $file = fopen('php://output', 'w');
            if ($orders->isNotEmpty())
            {
                $headers = array_keys((array)$orders->first());
                fputcsv($file, $headers);
                foreach ($orders as $order)
                {
                    fputcsv($file, (array)$order);
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
