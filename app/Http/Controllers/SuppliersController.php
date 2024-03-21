<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index()
    {
        $query = Suppliers::query();

        if (!empty($_GET['SocialReason']))
        {
            $query->where('Name', 'like', '%' . $_GET['SocialReason'] . '%');
        }

        if (!empty($_GET['Segments']))
        {
            $query->where('Segments', 'like', '%' . $_GET['Segments'] . '%');
        }

        if (!empty($_GET['CNPJ']))
        {
            $query->where('Cnpj', 'like', '%' . $_GET['CNPJ'] . '%');
        }

        if (!empty($_GET['Name']))
        {
            $query->where('ContactNameOne', 'like', '%' . $_GET['Name'] . '%');
        }

        $suppliers = $query->paginate(15);

        $nextPage = $suppliers->nextPageUrl();
        $previusPage = $suppliers->previousPageUrl();
        $message = session('success.message');

        return view('suppliers.index')
            ->with('suppliers', $suppliers)
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
        $supplier = Suppliers::create($request->except('_token'));

        return redirect('/suppliers')
            ->with("success.message", "Fornecedor '$supplier->Name' adicionada com sucesso!");
    }

    public function destroy(Request $request)
    {
        $supplier = Suppliers::findOrFail($request->input('supplier_id'));
        $supplier->delete();

        return redirect('/suppliers')
            ->with("success.message", "Fornecedor '$supplier->Name' removida com sucesso!");
    }
}
