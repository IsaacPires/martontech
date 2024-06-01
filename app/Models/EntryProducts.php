<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EntryProducts extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'products_id',
        'SellerName',
        'WithdrawalAmount',
        'UnitPrice',
        'TotalPrice',
        'Suppliers_id',
        'Brand'
    ];

    public function products()
    {
        return $this->belongsTo(Products::class);
    }
}
