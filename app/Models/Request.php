<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Request extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'suppliers_id',
        'brand',
        'lastPrice',
        'currentPrice',
        'quantity',
        'totalValue',
        'order_id'
    ];

    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    public function suppliers()
    {
        return $this->belongsTo(Suppliers::class, 'suppliers_id');
    }
}
