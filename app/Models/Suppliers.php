<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    use HasFactory;

    protected $fillable = [
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
}
