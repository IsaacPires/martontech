<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'products_id',
        'SellerName',
        'WithdrawalAmount',
        'FabricationOrder',
        'TypeProduction',
        'UnitPrice',
        'TotalPrice',
        'FabricationType'
    ];

    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}
