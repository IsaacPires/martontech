<?php

namespace App\Http\Controllers;

use App\Models\Products;
use App\Models\Suppliers;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    private $products;

    public function __construct(Products $products)
    {
        $this->product = $products;
    }

    public function index()
    {
        return view('products.index');
    }

    public function create()
    {
        $suppliers = Suppliers::all();

        return view('products.create')
            ->with('suppliers', $suppliers);
    }

    public function store(Request $request)
    {
        $products = Products::create($request->except('_token'));

        return redirect('/products');
    }
}
