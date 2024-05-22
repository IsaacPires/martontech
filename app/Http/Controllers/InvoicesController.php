<?php

namespace App\Http\Controllers;

use App\Models\Invoices;
use App\Repositories\InvoicesRepository;
use Illuminate\Http\Request;

class InvoicesController extends Controller
{
    private $invoices;

    public function __construct(InvoicesRepository $invoices)
    {
        $this->invoices = $invoices;
    }

    public function index()
    {
        $invoices = $this->invoices->invoicesReport();
        $invoices = $invoices->paginate(15);

        $nextPage = $invoices->nextPageUrl();
        $previusPage = $invoices->previousPageUrl();
        $message = session('success.message');

        $params = !empty($_GET) ? '?' . http_build_query($_GET) : null;
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

        try {
            Invoices::create($request->except('_token'));

            return redirect('/invoices')
                ->with("success.message", "NF gerada com sucesso");
        } catch (\Throwable $th) {
            return redirect('/invoices')
            ->with("success.message", "Erro ao adicionar a nota fiscal.");
        }
      
    }

    public function destroy(Request $request)
    {

        try {
            $invoices = Invoices::findOrFail($request->input('delete_id'));
            $invoices->delete();

            return redirect('/invoices')
            ->with("success.message", "Invoice removida com sucesso");
        } catch (\Throwable $th) {
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
        try {
            $invoices = Invoices::findOrFail($id);
            $invoices->update($request->all());
    
            return redirect('/invoices')
                ->with("success.message", "NF atualizada com sucesso");
        } catch (\Throwable $th) {
            return redirect('/invoices')
                ->with("success.message", "Nota fiscal não pode ser atualizada.");
        }
       
    }

    public function csv()
    {
        $invoices = Invoices::query();

        if (!empty($_GET['Client']))
        {
            $invoices->where('i.Client', 'like', '%' . $_GET['Client'] . '%');
        }

        $invoices = $invoices->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="invoices.csv"',
        ];

        $callBack = function () use ($invoices)
        {
            $file = fopen('php://output', 'w');
            $headers = array_keys($invoices->first()->getAttributes());
            $headers[] = 'Ações';
            fputcsv($file, $headers);
            foreach ($invoices as $invoice)
            {
                $row = $invoice->toArray();
                $row[] = '';
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callBack, 200, $headers);
    }
}
