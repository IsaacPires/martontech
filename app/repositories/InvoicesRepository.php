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
                DATE_FORMAT(i.ReceivingDate, '%d/%m/%Y')  AS 'Date Recebimento',
                DATE_FORMAT(i.InvoiceDate, '%d/%m/%Y') AS 'Data NF',
                i.NumberInvoice AS 'N° NF',
                i.NumberInvoiceMarton as 'N° Nf Marton',
                i.DepartureDate as 'Data de Saída',
                i.FinalTransport as 'Transportadora Final',
                i.Material AS 'Material'
            ")
            ->orderBy('i.created_at', 'desc');

        if (!empty($_GET['Client']))
        {
            $invoices->where('i.Client', 'like', '%' . $_GET['Client'] . '%');
        }

        return $invoices;
    }
}
