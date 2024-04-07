<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class InvoicesRepository
{
    public function invoicesReport()
    {
        $invoices = DB::table('invoices', 'i')
            ->selectRaw("
                i.id,
                i.Client AS 'Cliente',
                i.ReceivingDate AS 'Date Recebimento',
                i.InvoiceDate AS 'Data NF',
                i.NumberInvoice AS 'Número NF',
                i.Material AS 'Material',
                i.DepartureDate AS 'Data de Saída',
                i.NumberInvoiceMarton AS 'Número NF Marton',
                i.FinalTransport AS 'Transporte Final'
            ")
            ->orderBy('i.created_at', 'desc');

        return $invoices;
    }
}
