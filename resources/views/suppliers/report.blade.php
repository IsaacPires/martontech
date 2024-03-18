<x-layout title='Relatório Fornecedores'>

<div class="container mt-5">
    <!-- Filtro -->
    <form>
    <div class='row'>
        <div class="col-md-4">
            <label for="filtro" class="form-label">Razão Social:</label>
            <input type="text" class="form-control" id="razaoSocial" placeholder="Digite para filtrar...">
        </div>

        <div class="col-md-4">
            <label for="filtro" class="form-label">Segmento:</label>
            <input type="text" class="form-control" id="Segmento" placeholder="Digite para filtrar...">
        </div>
        <div class="col-md-3">
          <label for="filtro" class="form-label">CNPJ:</label>
          <input type="text" class="form-control" id="CNPJ" placeholder="Digite para filtrar...">
        </div>

        <div class="col-md-4">
          <label for="filtro" class="form-label">Nome:</label>
          <input type="text" class="form-control" id="Nome" placeholder="Digite para filtrar...">
        </div>
      </div>

      <div style='margin-top: 20px;'>
        <button  type="button" class="btn btn-primary">Filtrar</button>
        <button type="button" class="btn btn-success">Exportar</button>
      </div>
    </form>

    <hr>
    
    <!-- Tabela com barra de rolagem -->
      <div class="table-responsive" style="overflow-x: auto;">
        <table class="table" style="margin: 10px 10px 0 0">
            <thead>
                <tr>
                    <th>Razão social</th>
                    <th>Segmento</th>
                    <th>CNPJ</th>
                    <th>Rua</th>
                    <th>Bairro</th>
                    <th>Cidade</th>
                    <th>Estado</th>
                    <th>CEP</th>
                    <th>Nome</th>
                    <th>Telefone 1</th>
                    <th>Email 1</th>
                    <th>Nome 2</th>
                    <th>Telefone 2</th>
                    <th>Email 2</th>
                </tr>
            </thead>
            <tbody>
                <!-- Linhas da tabela -->
                <!-- Exemplo de uma linha -->
                <tr>
                    <td>Sport club internacional</td>
                    <td>Futebol</td>
                    <td>92.894.500/0001-32</td>
                    <td> Av. Padre Cacique</td>
                    <td>Praia de Belas</td>
                    <td>Porto Alegre</td>
                    <td>RS</td>
                    <td>90810-240</td>
                    <td>Inter</td>
                    <td>999999999</td>
                    <td>inter@gmail.com</td>
                    <td>colorado</td>
                    <td>888888888</td>
                    <td>colorado@gmail.com</td>
                </tr>

                <tr>
                  <td>Clube Atlético Mineiro</td>
                  <td>Futebol</td>
                  <td>11.222.333/0001-44</td>
                  <td>Av. Olegário Maciel</td>
                  <td>Lourdes</td>
                  <td>Belo Horizonte</td>
                  <td>MG</td>
                  <td>30180-110</td>
                  <td>Galo</td>
                  <td>987654321</td>
                  <td>galo@example.com</td>
                  <td>atletico</td>
                  <td>999999999</td>
                  <td>atletico@example.com</td>
              </tr>
                <!-- Adicione mais linhas conforme necessário -->
            </tbody>
        </table>
    </div>
    
    <!-- Paginação -->
    <nav style='margin:20px 0 0 0 ;'>
        <ul class="pagination justify-content-center">
            <li class="page-item">
                <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                  <i class="fas fa-caret-left"></i>
                </a>
            </li>
            <li class="page-item">
                <a class="page-link" href="#">
                  <i class="fas fa-caret-right"></i>
                </a>
            </li>
        </ul>
    </nav>
</div>




</x-layout>