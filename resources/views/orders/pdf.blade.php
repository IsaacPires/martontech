<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página da Empresa</title>
    <link rel="stylesheet" href={{asset("/css/pdf/style.css")}}>
</head>
<body>
    <header class="header">
        <div class="logo">
        <img src={{asset("/img/logo_PDF.jpg")}}>
        </div>
        <div class="company-info">
            <p>Marton Tech Industria e Comércio LTDA</p>
            <p>CNPJ: 19.080.716/0001-74</p>
            <p>Inscrição Municipal: 123456789</p>
        </div>
        <div class="contact-info">
            <p>Endereço: Rua Exemplo, 123, Cidade - Estado</p>
            <p>Email: contato@empresa.com.br</p>
            <p>Telefone: (11) 1234-5678</p>
        </div>
    </header>

    <div class="purchase-order">
        <div class="left">
            <h3>Ordem de Compra</h3>
        </div>
        <div class="center">
            <p><span class="highlight">Data</span>: 13/10/2024</p>
        </div>
        <div class="right">
            <p><span class="highlight">Ordem N°</span> 12345</p>
        </div>
    </div>

    <div class="supplier-info">
        <div class="left">
            <p><strong>Dados do Fornecedor:</strong></p>
            <p>Cód: 12345</p>
            <p>Cliente: Nome do Fornecedor</p>
            <p>A/C: Responsável</p>
        </div>
        <div class="center">
            <p>Rua Exemplo, 123</p>
            <p>Cidade/Estado: SP</p>
            <p>CEP: 11111-111</p>
        </div>
        <div class="right">
            <p>CNPJ: 00.000.000/0001-00</p>
            <p>Email: fornecedor@empresa.com.br</p>
            <p>Tel: (11) 9876-5432</p>
        </div>
    </div>

    <div class="order-message">
        <div class="left">
            <p><strong>Prezado fornecedor, estamos enviando esta ordem de compra para adquirir os seguintes produtos:</strong></p>
        </div>
        <div class="right">
            <p>Requisição: 1111</p>
        </div>
    </div>

    <table class="product-table">
        <thead>
            <tr>
                <th>Item</th>
                <th>Cód.</th>
                <th>Produto</th>
                <th>Unid.</th>
                <th>Qtd.</th>
                <th>Preço Uni.</th>
                <th>Preço Tot.</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>01</td>
                <td>486</td>
                <td>CORRENTE PASSO 38,1X22 PINO OCO</td>
                <td>M</td>
                <td>10,00</td>
                <td>R$ 150,00</td>
                <td>R$ 1.500,00</td>
            </tr>
            <tr>
                <td>02</td>
                <td>486</td>
                <td>CORRENTE PASSO 38,1X22 PINO OCO</td>
                <td>M</td>
                <td>15,00</td>
                <td>R$ 150,00</td>
                <td>R$ 2.250,00</td>
            </tr>
            <!-- Adicione mais linhas conforme necessário -->
        </tbody>
    </table>

</body>
</html>
