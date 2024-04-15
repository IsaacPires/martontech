<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
  {

    $totalValue = $this->totalValue();
    $alertItens = $this->alertItens();
    $agings     = $this->agings();
    $mostUseds  = $this->mostUsedProducts();

    return view('dashboard.index')
        ->with('totalValue', number_format($totalValue, 2, ',', '.'))
        ->with('alertItens', $alertItens->toarray())
        ->with('agings', $agings->toarray())
        ->with('mostUseds', $mostUseds->toarray());


  }

  private function totalValue()
  {
    $totalValue = Orders::whereMonth('created_at', now()->month)
        ->where('status', 'AP')
        ->sum('totalValue');

    return $totalValue;
  }    

  private function alertItens()
  {
    $alertItens = DB::table('products')
        ->select('Name', 'StockQuantity')
        ->whereRaw('StockQuantity <= AlertQuantity')
        ->take(3)
        ->get();

    return $alertItens;
  }
  private function agings()
  {
    $agings = DB::table('products')
        ->select('products.id', 'products.Name', 'products.StockQuantity', DB::raw('DATE_FORMAT(MAX(sale_products.created_at), "%d/%m/%Y") as last_sold'))
        ->leftJoin('sale_products', 'products.id', '=', 'sale_products.products_id')
        ->groupBy('products.id', 'products.Name', 'products.StockQuantity')
        ->orderBy('last_sold')
        ->take(3)
        ->get();

    return $agings;
  }

  private function mostUsedProducts()
  {
      $mostUsed = DB::table('requests')
          ->select('product_id', 'products.Name', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(totalValue) as total_value'))
          ->leftJoin('products', 'requests.product_id', '=', 'products.id')
          ->whereBetween('requests.created_at', [now()->startOfMonth(), now()])
          ->groupBy('product_id', 'products.Name')
          ->orderByDesc('total_quantity')
          ->take(3)
          ->get();

      return $mostUsed;
  }
}
