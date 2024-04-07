<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    use HasFactory;

    protected $fillable = [
        'ReceivingDate',
        'InvoiceDate',
        'Client',
        'NumberInvoice',
        'Material',
        'DepartureDate',
        'NumberInvoiceMarton',
        'FinalTransport'
    ];
}
