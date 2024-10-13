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
            <strong><span class="highlight">Data</span>: 13/10/2024</strong>
        </div>
        <div class="right">
            <strong><span class="highlight">Ordem N°</span> 12345</strong>
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
        </tbody>
    </table>

    <div class="payment-summary" style="display: flex; justify-content: space-between; background-color: white; padding: 10px;">
        <div class="payment-condition">
            <strong>Condição de Pgto:</strong> 30/45/60 DDL
        </div>
        <div class="freight">
            <strong>Frete:</strong> POR NOSSA CONTA
        </div>
        <div class="total">
            <strong>TOTAL:</strong> R$ 3.700,45
        </div>
    </div>

    <hr>

    <div class="payment-summary" style="display: flex; justify-content: space-between; background-color: white; padding: 10px;">
        <div class="payment-condition">
            <strong>Condições Gerais de Fornecimento:</strong>
        </div>
        <div class="freight">
            <strong>Imposto:</strong>
        </div>
        <div class="total">
        </div>
    </div>

    <div class="additional-info">
        <p>Mencionar sempre o número deste documento na nota fiscal / Não serão aceitas notas fiscais com o conteúdo divergente das condições expressas nos documentos de compras / Todas as entregas devem ser atendidas no prazo / Pedidos em atraso poderão ser cancelados sem aviso prévio. / A Marton Tech não se responsabiliza pela entrega de itens não expressos em seus documentos de compras.</p>
        <p>Notas fiscais eletrônicas de (ARQUIVOS XML) deverão ser enviadas para: comercial@martontech.com.br</p>
    </div>

    <div class="observacao">
        <strong>Observações:</strong>
    </div>

    <div class="obs-box">
        <p>Aqui ficam as observações.</p>
    </div>

    <div class="consid">
        <p>Ficamos a disposição para eventuais dúvidas, sugestões ou esclarecimentos.</p>
        <p>Atenciosamente,</p>
    </div>

    <div class="contacts">
    <div class="contact">
        <strong>Airton S. Nakano</strong>
        <p>(15) 98189-2835</p>
        <a href="mailto:asnakano@martontech.com.br">asnakano@martontech.com.br</a>
    </div>
    <div class="contact">
        <strong>Marcio B. Leite</strong>
        <p>(15) 99849-7108</p>
        <a href="mailto:mbruce@martontech.com.br">mbruce@martontech.com.br</a>
    </div>
    <div class="contact">

    </div>
</div>


    


</body>
</html>
