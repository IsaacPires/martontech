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
        ->leftJoin('Suppliers as s', 't.suppliers_id', '=', 's.id')
        ->selectRaw("
        m.id,
        t.Name AS 'Ferramenta',
        s.Name AS 'Fornecedor',
        m.quantity as 'Quant. defeito',
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

        $request['value'] = str_replace(',', '.', $request->value);
        $tools = Tools::find($request->tools_id);

        $tools->state = $request->State;
        $tools->save();
        
        

        if(Maintenance::create($request->except(['_token'])))
            $message = "Ferramenta '$request->Name' adicionada à manutenção!";
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
        
        if($tools->update($request->all()))
            $message = "Ferramenta atualizado com sucesso!";
        else
            $message = "Erro ao editar ferramenta.";

        return redirect('/maintenances')
            ->with("message", $message);
    }




}
