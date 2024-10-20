<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'status',
        'totalValue',
        'suppliers_id',
        'owner_id',
        'observation',
        'freight',
        'payment_condition'
    ];

    public function owners()
    {
        return $this->belongsTo(Owners::class, 'owner_id');
    }
}
