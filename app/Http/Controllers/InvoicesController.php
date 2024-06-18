<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Repositories\InvoicesRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvoicesController extends Controller
{
    private $invoices;

    public function __construct(InvoicesRepository $invoices)
    {
        $this->invoices = $invoices;
    }

    public function index()
    {
        $retornoPorPage = !empty($_GET['limiter']) ? (int)$_GET['limiter'] :  50;

        $invoices = $this->invoices->invoicesReport();
        $invoices = $invoices->paginate($retornoPorPage);

        $message = session('success.message');

        $params = $_GET;
        unset($params['page']);
        $queryString = http_build_query($params);

        $nextPage = $invoices->nextPageUrl() ? $invoices->nextPageUrl() . ($queryString ? '&' . $queryString : '') : null;
        $previusPage = $invoices->previousPageUrl() ? $invoices->previousPageUrl() . ($queryString ? '&' . $queryString : '') : null;

        $exportCsvUrl = route('invoices.csv', $params);

        return view('invoices.index')
            ->with('invoices', $invoices)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage)
            ->with('successMessage', $message)
            ->with('exportCsvUrl', $exportCsvUrl);
    }

    public function create()
    {
        return view('invoices.create');
    }

    public function store(Request $request)
    {

        try
        {
            Invoices::create($request->except('_token'));

            return redirect('/invoices')
                ->with("success.message", "NF gerada com sucesso");
        }
        catch (\Throwable $th)
        {
            return redirect('/invoices')
                ->with("success.message", "Erro ao adicionar a nota fiscal.");
        }
    }

    public function destroy(Request $request)
    {

        try
        {
            $invoices = Invoices::findOrFail($request->input('delete_id'));
            $invoices->delete();

            return redirect('/invoices')
                ->with("success.message", "Invoice removida com sucesso");
        }
        catch (\Throwable $th)
        {
            return redirect('/invoices')
                ->with("success.message", "Erro ao apagar registro");
        }
    }

    public function edit($id)
    {
        $invoices = Invoices::find($id);

        return view('invoices.edit', ['invoices' => $invoices]);
    }

    public function update(Request $request, $id)
    {
        try
        {
            $invoices = Invoices::findOrFail($id);
            $invoices->update($request->all());

            return redirect('/invoices')
                ->with("success.message", "NF atualizada com sucesso");
        }
        catch (\Throwable $th)
        {
            return redirect('/invoices')
                ->with("success.message", "Nota fiscal não pode ser atualizada.");
        }
    }

    public function csv()
    {
        $invoices = DB::table('invoices', 'i')
            ->selectRaw("
            i.id,
            i.Client AS 'Cliente',
            DATE_FORMAT(i.ReceivingDate, '%d/%m/%Y')  AS 'Date Recebimento',
            DATE_FORMAT(i.InvoiceDate, '%d/%m/%Y') AS 'Data NF',
            i.NumberInvoice AS 'N° NF',
            i.NumberInvoiceMarton as 'N° Nf Marton',
            i.DepartureDate as 'Data de Saída',
            i.FinalTransport as 'Transportadora Final',
            i.Material AS 'Material',
            DATE_FORMAT(i.created_at, '%d/%m/%Y %H:%i') AS 'Data Criação'
        ")
            ->orderByDesc('i.id');

        if (!empty($_GET['Client']))
        {
            $invoices->where('i.Client', 'like', '%' . $_GET['Client'] . '%');
        }

        if (!empty($_GET['nfCliente']))
        {
            $invoices->where('i.NumberInvoice', '=', $_GET['nfCliente']);
        }

        if (!empty($_GET['nfMarton']))
        {
            $invoices->where('i.NumberInvoiceMarton', '=', $_GET['nfMarton']);
        }

        if (!empty($_GET['material']))
        {
            $invoices->where('i.Material', 'like', '%' . $_GET['material'] . '%');
        }

        $invoices = $invoices->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="invoices.csv"',
        ];

        $callback = function () use ($invoices)
        {
            $file = fopen('php://output', 'w');
            if ($invoices->isNotEmpty())
            {
                $headers = array_keys((array)$invoices->first());
                fputcsv($file, $headers);
                foreach ($invoices as $invoice)
                {
                    fputcsv($file, (array)$invoice);
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
