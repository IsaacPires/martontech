<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class SuppliersRepository
{

  public function supplierReport()
  {

    $suppliers = DB::table('suppliers')
      ->selectRaw('
    id, 
    Name as "Fornecedor",
    Segments as Segmento,
    Cnpj, 
    AddressNumber as "N° do endereço", 
    AddressNeighborhood as Bairro, 
    AddressStreet as Rua,
    AddressCity as Cidade, 
    AddressState as Estado, 
    ContactNameOne as Contato,
    ContactPhoneOne as Telefone,
    ContactEmailOne as Email,
    DATE_FORMAT(created_at, "%d/%m/%Y %H:%i") AS "Data Criação"
    ');

    if (!empty($_GET['ordenacao']))
    {
      $suppliers->orderBy('Name', $_GET['ordenacao']);
    }
    else
    {
      $suppliers->orderBy('created_at', 'desc');
    }

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
