<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Models\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ToolsController extends Controller
{

    public function __construct()
    {
    
    }


    public function index()
    {

        $retornoPorPage = !empty($_GET['limiter']) ? (int)$_GET['limiter'] :  50;

        $tools = DB::table('tools', 't')
            ->leftJoin('suppliers as s', 't.suppliers_id', '=', 's.id')
            ->selectRaw("
                t.id,
                t.Name AS 'Ferramenta',
                s.Name AS 'Fornecedor',
                t.Owner AS 'Responsável',
                DATE_FORMAT(t.Date, '%d/%m/%Y') AS 'Data',
                t.Quantity AS 'Quantidade',
                t.Number AS 'N°',
                t.State AS 'Estado',
                t.Status AS 'Status'
            ")
            ->orderByDesc('t.id');

        if (!empty($_GET['toolsName']))
        {
        $tools->where('t.Name', 'like', '%' . $_GET['toolsName'] . '%');
        }

        if (!empty($_GET['number']))
        {
            $tools->where('t.Number', 'like', '%' . $_GET['number'] . '%');
        }

        if (!empty($_GET['owner']))
        {
            $tools->where('t.Owner', 'like', '%' . $_GET['owner'] . '%');
        }

        if (!empty($_GET['State']))
        {
            $tools->where('t.State', 'like', '%' . $_GET['State'] . '%');
        }

        
        if (!empty($_GET['Status']))
        {
            $tools->where('t.Status', 'like', '%' . $_GET['Status'] . '%');
        }

        $tools = $tools->paginate($retornoPorPage);

        $message = session('message');

        $params = $_GET;
        unset($params['page']);
        $queryString = http_build_query($params);

        $nextPage = $tools->nextPageUrl() ? $tools->nextPageUrl() . ($queryString ? '&' . $queryString : '') : null;
        $previusPage = $tools->previousPageUrl() ? $tools->previousPageUrl() . ($queryString ? '&' . $queryString : '') : null;

        $exportCsvUrl = route('tools.csv', $params);

        return view('tools.index')
            ->with('tools', $tools)
            ->with('exportCsvUrl', $exportCsvUrl)
            ->with('successMessage', $message)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage);
    }
    
    public function create()
    {
        $suppliers = Suppliers::all();

        return view('tools.create')        
            ->with('suppliers', $suppliers);
        
    }

    public function store(Request $request)
    {
        if($tools = Tools::create($request->except('_token')))
            $message = "Ferramenta '$tools->Name' adicionada com sucesso!";
        else
            $message = "Erro ao cadastrar a Ferramenta.";


        return redirect('/tools')
            ->with("message", $message);
    }

    public function destroy(Request $request)
    {
        $tool = Tools::findOrFail($request->input('delete_id'));
        if($tool->delete())
            $message = "Ferramenta '$tool->Name' removida com sucesso!";
        else
            $message = "Erro ao deletar ferramenta.";

        return redirect('/tools')
            ->with("message", $message);
    }

    public function edit($id)
    {
        $tools = Tools::find($id);
        $suppliers = Suppliers::all();

        return view('tools.edit')
        ->with('tools', $tools)
        ->with('suppliers', $suppliers);
        
    }

    public function update(Request $request, $id)
    {
        $tools = Tools::findOrFail($id);
        
        if($tools->update($request->all()))
            $message = "Ferramenta '$request->Name' atualizado com sucesso!";
        else
            $message = "Erro ao editar ferramenta.";

        return redirect('/tools')
            ->with("message", $message);
    }

    public function csv()
    {
        $tools = DB::table('tools', 't')
        ->leftJoin('suppliers as s', 't.suppliers_id', '=', 's.id')
        ->selectRaw("
            t.id,
            t.Name AS 'Ferramenta',
            s.Name AS 'Fornecedor',
            t.Owner AS 'Responsável',
            DATE_FORMAT(t.Date, '%d/%m/%Y') AS 'Data',
            t.Quantity AS 'Quantidade',
            t.Number AS 'N°',
            t.State AS 'Estado',
            t.Status AS 'Status'
        ")
        ->orderByDesc('t.id');

        if (!empty($_GET['toolsName']))
        {
            $tools->where('Name', 'like', '%' . $_GET['toolsName'] . '%');
        }

        if (!empty($_GET['number']))
        {
            $tools->where('t.Number', 'like', '%' . $_GET['number'] . '%');
        }

        if (!empty($_GET['owner']))
        {
            $tools->where('Owner', 'like', '%' . $_GET['owner'] . '%');
        }


        if (!empty($_GET['State']))
        {
            $tools->where('State', 'like', '%' . $_GET['State'] . '%');
        }

        
        if (!empty($_GET['Status']))
        {
            $tools->where('Status', 'like', '%' . $_GET['Status'] . '%');
        }

        $tools = $tools->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="ferramentas.csv"',
        ];

        $callback = function () use ($tools)
        {
            $file = fopen('php://output', 'w');
            if ($tools->isNotEmpty())
            {
                $headers = array_keys((array)$tools->first());
                fputcsv($file, $headers);
                foreach ($tools as $product)
                {
                    fputcsv($file, (array)$product);
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


    public function changeOwner()
    {
        $tools = Tools::select('Owner') 
        ->distinct('owner')
        ->get();
        $msg = session('msg');
        return view('tools.change')
            ->with('tools', $tools)
            ->with('msg', $msg);
        }

    public function savechangeOwner(Request $request)
    {
        if(Tools::where('Owner', "$request->responsavel_old")->update(['Owner' => "$request->responsavel_new"]))
            $msg = "As ferramentas do responsável '$request->responsavel_old' foram alteradas para '$request->responsavel_new'.";
        else
            $msg = "Falha ao alterar responsável.";
        

        return redirect('/tools/change')->with('msg', $msg);

    }

}
