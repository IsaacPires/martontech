<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'AlertQuantity',
        'StockQuantity',
        'primary_suppliers_id',
        'secondary_supplier_id',
    ];

    public function supliers()
    {
        return $this->belongsTo(Suppliers::class);
    }

    public function saleProducts()
    {
        return $this->hasMany(SaleProducts::class);
    }
}
