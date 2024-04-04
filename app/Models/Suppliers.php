<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'Name',
        'Segments',
        'Cnpj',
        'AddressStreet',
        'AddressNumber',
        'AddressNeighborhood',
        'AddressCity',
        'AddressState',
        'AddressZipCode',
        'ContactNameOne',
        'ContactNameTwo',
        'ContactPhoneOne',
        'ContactPhoneTwo',
        'ContactEmailOne',
        'ContactEmailTwo',
    ];

    public function products()
    {
        return $this->hasMany(Products::class, 'suppliers_id');
    }

    public static function booted()
    {
        self::addGlobalScope('ordered', function (Builder $queryBuilder)
        {
            $queryBuilder->orderBy('Name');
        });
    }
}
