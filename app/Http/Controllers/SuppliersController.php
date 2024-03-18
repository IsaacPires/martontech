<?php

namespace App\Http\Controllers;

use App\Models\Suppliers;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index()
    {
        $suppliers = Suppliers::query()->paginate(5);
        $message = session('success.message');

        $nextPage = $suppliers->nextPageUrl();
        $previusPage = $suppliers->previousPageUrl();

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

        return redirect('/')
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
