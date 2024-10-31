<?php

namespace App\Http\Controllers;

use App\Models\Maintenance;
use App\Models\Suppliers;
use App\Models\Tools;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MaintenanceController extends Controller
{

    public function __construct()
    {
    
    }

    public function index()
    {

        $retornoPorPage = !empty($_GET['limiter']) ? (int)$_GET['limiter'] :  50;

        $maintenance = DB::table('maintenances', 'm')
        ->leftJoin('tools as t', 't.id', '=', 'm.tools_id')
        ->leftJoin('suppliers as s', 't.suppliers_id', '=', 's.id')
        ->selectRaw("
        m.id,
        t.Name AS 'Ferramenta',
        s.Name AS 'Fornecedor',
        t.Owner as 'Responsável',
        m.technical_assistance as 'Assistência Técnica',
        DATE_FORMAT(m.output_date, '%d/%m/%Y') AS 'Data de saída',
        DATE_FORMAT(m.return_date, '%d/%m/%Y') AS 'Data de retorno',
        t.Number AS 'N°',
        m.defect AS 'Defeito',
        m.value as 'Valor',
        m.obs AS 'Obs'")
        ->orderByDesc('m.id');

        if (!empty($_GET['toolsName']))
        {
            $maintenance->where('t.Name', 'like', '%' . $_GET['toolsName'] . '%');
        }

        if (!empty($_GET['number']))
        {
            $maintenance->where('t.Number', 'like', '%' . $_GET['number'] . '%');
        }

        if (!empty($_GET['owner']))
        {
            $maintenance->where('t.Owner', 'like', '%' . $_GET['owner'] . '%');
        }



        $maintenance = $maintenance->paginate($retornoPorPage);

        $message = session('message');

        $params = $_GET;
        unset($params['page']);
        $queryString = http_build_query($params);

        $nextPage = $maintenance->nextPageUrl() ? $maintenance->nextPageUrl() . ($queryString ? '&' . $queryString : '') : null;
        $previusPage = $maintenance->previousPageUrl() ? $maintenance->previousPageUrl() . ($queryString ? '&' . $queryString : '') : null;

        $exportCsvUrl = route('tools.csv', $params);

        return view('maintenances.index')
            ->with('maintenance', $maintenance)
            ->with('exportCsvUrl', $exportCsvUrl)
            ->with('successMessage', $message)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage);
    }

    
    public function create($id)
    {
        $tools = Tools::findOrFail($id);

        return view('maintenances.create')
        ->with('tools', $tools);
    }

    public function store(Request $request)
    {
        //$request['value'] = str_replace(',', '.', $request->value);
        $tools = Tools::find($request->tools_id);

        $tools->state = $request->State;
        $tools->save();

        if(Maintenance::create($request->except(['_token'])))
            $message = "Ferramenta '$tools->Name' adicionada à manutenção!";
        else
            $message = "Erro ao cadastrar a Ferramenta na manutenção.";


        return redirect('/tools')
            ->with("message", $message);
    }



    public function edit($id)
    {
        $maintenance = Maintenance::find($id);
        $tool = Tools::find($maintenance->tools_id);
        return view('maintenances.edit', ['maintenance' => $maintenance, 'tool' => $tool]);
    }

    public function destroy(Request $request)
    {
        $tool = Maintenance::findOrFail($request->input('delete_id'));
        if($tool->delete())
            $message = "Ferramenta com defeito removida com sucesso!";
        else
            $message = "Erro ao deletar ferramenta.";

        return redirect('/maintenances')
            ->with("message", $message);
    }

    public function update(Request $request, $id)
    {

        $request['value'] = str_replace(',', '.', $request->value);

        $tools = Maintenance::findOrFail($id);

        $maintenance = Maintenance::findOrFail($id);

        $maintenance->update($request->all());

        if($tools->update($request->all()))
            $message = "Ferramenta atualizado com sucesso!";
        else
            $message = "Erro ao editar ferramenta.";

        return redirect('/maintenances')
            ->with("message", $message);
    }

    public function csv()
    {
        $maintenance = DB::table('maintenances', 'm')
            ->leftJoin('tools as t', 't.id', '=', 'm.tools_id')
            ->leftJoin('suppliers as s', 't.suppliers_id', '=', 's.id')
            ->selectRaw("
            m.id,
            t.Name AS 'Ferramenta',
            s.Name AS 'Fornecedor',
            t.Owner as 'Responsável',
            DATE_FORMAT(m.output_date, '%d/%m/%Y') AS 'Data de saída',
            DATE_FORMAT(m.return_date, '%d/%m/%Y') AS 'Data de retorno',
            t.Number AS 'N°',
            m.defect AS 'Defeito',
            m.value as 'Valor',
            m.obs AS 'Obs'
        ")
        ->orderByDesc('t.id');

        if (!empty($_GET['toolsName']))
        {
            $maintenance->where('t.Name', 'like', '%' . $_GET['toolsName'] . '%');
        }

        if (!empty($_GET['number']))
        {
            $maintenance->where('t.Number', 'like', '%' . $_GET['number'] . '%');
        }

        $maintenance = $maintenance->get();

        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="ferramentas.csv"',
        ];

        $callback = function () use ($maintenance)
        {
            $file = fopen('php://output', 'w');
            if ($maintenance->isNotEmpty())
            {
                $headers = array_keys((array)$maintenance->first());
                fputcsv($file, $headers);
                foreach ($maintenance as $value)
                {
                    fputcsv($file, (array)$value);
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
