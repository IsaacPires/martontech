<?php

namespace App\Http\Controllers;

use App\Models\Orders;
use App\Models\Products;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
  public function index()
  {

    $firstDayOfMonth =  isset($_GET['data_de']) && !empty($_GET['data_de']) ? Carbon::parse($_GET['data_de'])->startOfDay() : Carbon::now()->startOfMonth();
    $lastDayOfMonth =   isset($_GET['data_ate']) && !empty($_GET['data_de']) ? Carbon::parse($_GET['data_ate'])->endOfDay() : Carbon::now()->endOfMonth();
    
    $totalValue = $this->totalValue($firstDayOfMonth, $lastDayOfMonth);
    $alertItens = $this->alertItens();
    $agings     = $this->agings();
    $mostUseds  = $this->mostUsedProducts($firstDayOfMonth, $lastDayOfMonth);

    return view('dashboard.index')
        ->with('totalValue', number_format($totalValue, 2, ',', '.'))
        ->with('alertItens', $alertItens->toarray())
        ->with('firstDayOfMonth', $firstDayOfMonth->format('Y-m-d'))
        ->with('lastDayOfMonth', $lastDayOfMonth->format('Y-m-d'))
        ->with('agings', $agings->toarray())
        ->with('mostUseds', $mostUseds->toarray());


  }

  private function totalValue($firstDayOfMonth, $lastDayOfMonth)
  {
 
    $totalValue = Orders::whereBetween('created_at', [$firstDayOfMonth, $lastDayOfMonth])
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

  private function mostUsedProducts($firstDayOfMonth, $lastDayOfMonth)
  {
      $mostUsed = DB::table('requests')
          ->select('product_id', 'products.Name', DB::raw('SUM(quantity) as total_quantity'), DB::raw('SUM(totalValue) as total_value'))
          ->leftJoin('products', 'requests.product_id', '=', 'products.id')
          ->whereBetween('requests.created_at', [$firstDayOfMonth, $lastDayOfMonth])
          ->groupBy('product_id', 'products.Name')
          ->orderByDesc('total_quantity')
          ->take(3)
          ->get();

      return $mostUsed;
  }
}
