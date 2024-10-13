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
            <img src="/img/logo_PDF.jpg">
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
    <hr>

    <section class="order-info">
        <div class="left">
            <span>Ordem de Compra</span>
        </div>
        <div class="middle">
            <span>Data: </span>13/10/2024
        </div>
        <div class="right">
            <span>Ordem N°: </span>12345
        </div>
    </section>

    <section class="supplier-info" style="background-color: #b4c6e7;">
        <div class="left">
            <p><strong>Dados do Fornecedor:</strong></p>
            <p>Cód: 1234</p>
            <p>Cliente: Fornecedor X</p>
            <p>A/C: Responsável Y</p>
        </div>
        <div class="middle">
            <p><strong>Endereço:</strong></p>
            <p>Rua Exemplo, 123</p>
            <p>Cidade/Estado: SP</p>
            <p>CEP: 11111-111</p>
        </div>
        <div class="right">
            <p><strong>CNPJ:</strong> 19.080.716/0001-74</p>
            <p>Email: fornecedor@empresa.com.br</p>
            <p>Telefone: (11) 1234-5678</p>
        </div>
    </section>

    <section class="order-text">
        <div class="left">
            <p><strong>Prezado fornecedor, estamos enviando esta ordem de compra para adquirir os seguintes produtos:</strong></p>
        </div>
        <div class="right">
            <p><strong>Requisição: 1111</strong></p>
        </div>
    </section>

    <section class="table-section">
        <!-- Aqui vai a tabela dos produtos -->
    </section>

    <section class="footer-info">
        <div class="left">
            <p><strong>Condições Gerais de Fornecimento:</strong></p>
        </div>
        <div class="right">
            <p><strong>Impostos:</strong></p>
        </div>
        <div class="conditions">
            <p>Mencionar sempre o número deste documento na nota fiscal / Não serão aceitas notas fiscais com o conteúdo divergente das condições expressas nos documentos de compras / Todas as entregas devem ser atendidas no prazo / Pedidos em atraso poderão ser cancelados sem aviso prévio. / A Marton Tech não se responsabiliza pela entrega de itens não expressos em seus documentos de compras.</p>
            <p>Notas fiscais eletrônicas de (ARQUIVOS XML) deverão ser enviadas para: comercial@martontech.com.br</p>
        </div>
    </section>

    <section class="observation">
        <strong>Observação:</strong>
    </section>

    <section class="additional-info">
        <p>Aqui ficam as observações.</p>
    </section>

    <section class="contacts">
        <table>
            <tr>
                <td>
                    <strong>Airton S. Nakano</strong>
                    <p>(15) 98189-2835</p>
                    <a href="mailto:asnakano@martontech.com.br">asnakano@martontech.com.br</a>
                </td>
                <td>
                    <strong>Marcio B. Leite</strong>
                    <p>(15) 99849-7108</p>
                    <a href="mailto:mbruce@martontech.com.br">mbruce@martontech.com.br</a>
                </td>
            </tr>
        </table>
    </section>

</body>
</html>
