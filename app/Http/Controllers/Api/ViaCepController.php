<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class ViaCepController extends Controller
{
   public function retornaEndereco($cep)
   {
      $cep = str_replace(['.', '-'], '', $cep);
      $url = "https://viacep.com.br/ws/{$cep}/json/";
      
      try {
          $response = file_get_contents($url);
  
          if ($response === false) {
              throw new Exception("Erro ao obter dados do CEP.");
          }
          return $response;
      } catch (Exception $e) {
          return json_encode(['error' => $e->getMessage()]);
      }
    
   }
}
