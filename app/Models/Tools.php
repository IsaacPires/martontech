<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tools extends Model
{
    use HasFactory;

    protected $fillable = [
        'Name',
        'Date',
        'Suppliers_id',
        'Quantity',
        'Number',
        'State',
        'Owner',
        'Note',
        'Status'
    ];
}
