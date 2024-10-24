<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = [
        'tools_id',
        'return_date',
        'defect',
        'quantity',
        'value',
        'output_date',
        'obs'
    ];
}
