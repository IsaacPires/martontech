<?php

namespace App\Http\Controllers;

use App\Models\Products;
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

    public function testeSeed()
    {

        $path = storage_path('app/dbFiles/products.json');

        if (!file_exists($path))
        {
            return;
        }

        $products = json_decode(file_get_contents($path), true);

        foreach ($products as $key => $product)
        {
            if (array_key_exists('Fornecedor 1', $product))
            {
                dd();
            }
            Products::create([
                'Name' => array_key_exists('Produto', $product) ? $product['Produto'] : 'NI',
                'AlertQuantity' => array_key_exists(' Qntd. Alerta ', $product) ? $product[' Qntd. Alerta '] : NULL,
                'StockQuantity' => NULL,
                'primary_suppliers_id' => array_key_exists('Fornecedor 1', $product) ? Suppliers::where('Name', 'like', "%{$product['Fornecedor 1']}%")->value('id') : NULL,
                'secondary_supplier_id' => array_key_exists('Fornecedor 2', $product) ? Suppliers::where('Name', 'like', "%{$product['Fornecedor 2']}%")->value('id') : NULL,
                'created_at' => array_key_exists('Data Cadastro', $product) ? date('Y-m-d H:i:s', strtotime(str_replace('/', '-', $product['Data Cadastro']))) : NULL,
            ]);
        }
    }

    public function index()
    {

        $suppliers = $this->suppliers->supplierReport();

        $suppliers = $suppliers->paginate(15);

        $message = session('success.message');

        $params = $_GET;
        unset($params['page']);
        $queryString = http_build_query($params);

        $nextPage = $suppliers->nextPageUrl() ? $suppliers->nextPageUrl() . ($queryString ? '&' . $queryString : '') : null;
        $previusPage = $suppliers->previousPageUrl() ? $suppliers->previousPageUrl() . ($queryString ? '&' . $queryString : '') : null;

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

        $request['ContactPhoneOne'] =  str_replace(['.', '/', '-', ' ', '(', ')'], '', $request['ContactPhoneOne']);
        if (isset($request['ContactPhoneTwo']) && !empty($request['ContactPhoneTwo']))
        {
            $request['ContactPhoneTwo'] =  str_replace(['.', '/', '-', ' ', '(', ')'], '', $request['ContactPhoneTwo']);
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

    public function edit($id)
    {
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
        $suppliers = DB::table('suppliers')
            ->selectRaw('
      id, 
      Name as "Fornecedor",
      Segments as Segmento,
      Cnpj, 
      AddressNumber as "N° do endereço", 
      AddressNeighborhood as Bairro, 
      AddressStreet as Rua,
      AddressCity as Cidade, 
      AddressState as Estado, 
      ContactNameOne as Contato,
      ContactPhoneOne as Telefone,
      ContactEmailOne as Email,
      DATE_FORMAT(created_at, "%d/%m/%Y %H:%i") AS "Data Criação"
      ')
            ->orderByDesc('id');;

        if (!empty($_GET['ordenacao']))
        {
            $suppliers->orderBy('Name', $_GET['ordenacao']);
        }
        else
        {
            $suppliers->orderBy('created_at', 'desc');
        }

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

        $callback = function () use ($suppliers)
        {
            $file = fopen('php://output', 'w');
            if ($suppliers->isNotEmpty())
            {
                $headers = array_keys((array)$suppliers->first());
                fputcsv($file, $headers);
                foreach ($suppliers as $supplier)
                {
                    fputcsv($file, (array)$supplier);
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
