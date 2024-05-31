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
        CONCAT(
            SUBSTRING(Cnpj, 1, 2), ".", 
            SUBSTRING(Cnpj, 3, 3), ".", 
            SUBSTRING(Cnpj, 6, 3), "/", 
            SUBSTRING(Cnpj, 9, 4), "-", 
            SUBSTRING(Cnpj, 13, 2)
        ) as Cnpj,
        AddressNumber as "N° do endereço", 
        AddressNeighborhood as Bairro, 
        AddressStreet as Rua,
        AddressCity as Cidade, 
        AddressState as Estado, 
        ContactNameOne as Contato,
        CONCAT(
            "(", SUBSTRING(ContactPhoneOne, 1, 2), ") ", 
            SUBSTRING(ContactPhoneOne, 3, 5), "-", 
            SUBSTRING(ContactPhoneOne, 8, 4)
        ) as Telefone,
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
