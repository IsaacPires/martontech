<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class SuppliersRepository
{

  public function supplierReport(){
    
    $suppliers = DB::table('suppliers')
    ->selectRaw('id, Name as "Razão Social",
    Segments as Segmento,
    Cnpj, 
    AddressNumber as "Número do endereço", 
    AddressNeighborhood as Bairro, 
    AddressCity as Cidade, 
    AddressState as Estado, 
    ContactNameOne as Nome,
    ContactPhoneOne as Telefone,
    ContactEmailOne as Email
    ')
    ->orderBy('created_at', 'desc');

    if (!empty($_GET['SocialReason']))
    {
        $suppliers->where('Name', 'like', '%' . $_GET['SocialReason'] . '%');
    }

    if (!empty($_GET['Segments']))
    {
        $suppliers->where('Segments', 'like', '%' . $_GET['Segments'] . '%');
    }

    if (!empty($_GET['CNPJ']))
    {
        $suppliers->where('Cnpj', 'like', '%' . $_GET['CNPJ'] . '%');
    }

    if (!empty($_GET['Name']))
    {
        $suppliers->where('ContactNameOne', 'like', '%' . $_GET['Name'] . '%');
    }

    return $suppliers;
  }

}