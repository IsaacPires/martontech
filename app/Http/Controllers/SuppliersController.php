<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use App\Repositories\SuppliersRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SuppliersController extends Controller
{
    private $suppliers;
    public function __construct(SuppliersRepository $suppliers)
    {
        $this->suppliers = $suppliers;        
    }

    public function index()
    {

        $suppliers = $this->suppliers->supplierReport();
        
        $suppliers = $suppliers->paginate(15);

        $nextPage = $suppliers->nextPageUrl();
        $previusPage = $suppliers->previousPageUrl();
        $message = session('success.message');

        $params = !empty($_GET) ? '?' . http_build_query($_GET) : null ;
        $exportCsvUrl = route('suppliers.csv', $params);

        return view('suppliers.index')
            ->with('suppliers', $suppliers)
            ->with('exportCsvUrl', $exportCsvUrl)
            ->with('successMessage', $message)
            ->with('nextPage', $nextPage)
            ->with('previusPage', $previusPage);
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $request['Cnpj'] =  str_replace(['.', '/', '-'], '', $request['Cnpj']);

        $request['ContactPhoneOne'] =  str_replace(['.', '/', '-',' ', '(', ')'], '', $request['ContactPhoneOne']);
        if(isset($request['ContactPhoneTwo']) && !empty($request['ContactPhoneTwo']) ){
            $request['ContactPhoneTwo'] =  str_replace(['.', '/', '-',' ', '(', ')'], '', $request['ContactPhoneTwo']);

        }

        $supplier = Suppliers::create($request->except('_token'));

        return redirect('/suppliers')
            ->with("success.message", "Fornecedor '$supplier->Name' adicionada com sucesso!");
    }

    public function destroy(Request $request)
    {
        $supplier = Suppliers::findOrFail($request->input('delete_id'));
        $supplier->delete();

        return redirect('/suppliers')
            ->with("success.message", "Fornecedor '$supplier->Name' removida com sucesso!");
    }

    public function edit($id){
        $supplier = Suppliers::find($id);

        return view('suppliers.edit', ['supplier' => $supplier]);
    }

    public function update(Request $request, $id)
    {
        $supplier = Suppliers::findOrFail($id);
        $supplier->update($request->all());
        
        return redirect('/suppliers')
            ->with("success.message", "Fornecedor '$request->Name' atualizado com sucesso!");

    }


    public function csv()
    {
        $suppliers = Suppliers::query();
    
        if (!empty($_GET['SocialReason']))
        {  
            $suppliers->where('Name', 'like', '%' . $_GET['SocialReason'] . '%');
        }

        if (!empty($_GET['Segments']))
        {
            $suppliers->where('Segments', 'like', '%' . $_GET['Segments'] . '%');
        }
    
        if (!empty($_GET['CNPJ']))
        {
            $suppliers->where('Cnpj', 'like', '%' . $_GET['CNPJ'] . '%');
        }
    
        if (!empty($_GET['Name']))
        {
            $suppliers->where('ContactNameOne', 'like', '%' . $_GET['Name'] . '%');
        }

        $suppliers = $suppliers->get();
    
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="suppliers.csv"',
        ];
    
        $callback = function () use ($suppliers) {
            $file = fopen('php://output', 'w');
            $headers = array_keys($suppliers->first()->getAttributes());
            $headers[] = 'Ações';
            fputcsv($file, $headers);
            foreach ($suppliers as $supplier) {
                $row = $supplier->toArray();
                $row[] = '';
                fputcsv($file, $row);
            }
            fclose($file);
        };
    
        return response()->stream($callback, 200, $headers);
    }
}
