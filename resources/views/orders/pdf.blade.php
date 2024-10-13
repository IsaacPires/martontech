<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página da Empresa</title>
    <link rel="stylesheet" href={{asset("/css/pdf/style.css")}}>
</head>
<body>

<table width="100%">
        <!-- Header -->
        <tr>
            <td  class="logo">
                <img src={{asset("/img/logo_PDF.jpg")}}>
            </td>
            <td width="35%" class="company-info">
                <p>Marton Tech Industria e Comércio LTDA</p>
                <p>CNPJ: 19.080.716/0001-74</p>
                <p>Inscrição Municipal: 123456789</p>
            </td>
            <td width="35%" class="contact-info">
                <p>Endereço: Rua Exemplo, 123, Cidade - Estado</p>
                <p>Email: contato@empresa.com.br</p>
                <p>Telefone: (11) 1234-5678</p>
            </td>
        </tr>

        <tr>
            <td>
                <span class='bold' >Ordem de Compra</span>
            </td>
            <td width="35%" class="company-info">
                <span class='bold'>Data:</span> 13/10/2024
            </td>
            <td width="35%" class="contact-info">
                <span class='bold'>Ordem N°:</span> 12345
            </td>
        </tr>

        <!-- Dados do Fornecedor -->
        <tr style="background-color: #b4c6e7;">
            <td>
                <strong>Dados do Fornecedor:</strong>
                <p>Cód: 1234</p>
                <p>Cliente: Fornecedor X</p>
                <p>A/C: Responsável Y</p>
            </td>
            <td>
                <strong>Endereço:</strong>
                <p>Rua Exemplo, 123</p>
                <p>Cidade/Estado: SP</p>
                <p>CEP: 11111-111</p>
            </td>
            <td>
                <strong>CNPJ:</strong> 19.080.716/0001-74
                <p>Email: fornecedor@empresa.com.br</p>
                <p>Telefone: (11) 1234-5678</p>
            </td>
        </tr>

        <!-- Texto de introdução -->
        <tr>
            <td width="100%" colspan="3" style="padding-top: 20px;">
                <strong>Prezado fornecedor, estamos enviando esta ordem de compra para adquirir os seguintes produtos:</strong>
            </td>
        </tr>

        <!-- Condições Gerais e Impostos -->
        <tr>
            <td width="50%" class="left" style="padding-top: 20px;">
                <strong>Condições Gerais de Fornecimento:</strong>
            </td>
            <td width="50%" class="right" style="text-align: left;">
                <strong>Impostos:</strong>
            </td>
        </tr>

        <!-- Detalhes das condições e impostos -->
        <tr style="background-color: #b4c6e7;">
            <td width="100%" colspan="3" style="padding: 10px;">
                <p>Mencionar sempre o número deste documento na nota fiscal / Não serão aceitas notas fiscais com o conteúdo divergente das condições expressas nos documentos de compras / Todas as entregas devem ser atendidas no prazo / Pedidos em atraso poderão ser cancelados sem aviso prévio. / A Marton Tech não se responsabiliza pela entrega de itens não expressos em seus documentos de compras.</p>
                <p>Notas fiscais eletrônicas de (ARQUIVOS XML) deverão ser enviadas para: <a href="mailto:comercial@martontech.com.br">comercial@martontech.com.br</a></p>
            </td>
        </tr>

        <!-- Observação -->
        <tr>
            <td width="100%" colspan="3" style="padding-top: 10px;">
                <strong style="color: red;">Observação:</strong>
            </td>
        </tr>

        <!-- Observação adicional -->
        <tr style="background-color: #b4c6e7;">
            <td width="100%" colspan="3" style="padding: 10px;">
                <p>Aqui ficam as observações.</p>
            </td>
        </tr>

        <!-- Contatos -->
        <tr>
            <td width="50%" style="padding-top: 20px;">
                <strong>Airton S. Nakano</strong><br>
                <p>(15) 98189-2835</p>
                <a href="mailto:asnakano@martontech.com.br">asnakano@martontech.com.br</a>
            </td>
            <td width="50%" style="padding-top: 20px; text-align: right;">
                <strong>Marcio B. Leite</strong><br>
                <p>(15) 99849-7108</p>
                <a href="mailto:mbruce@martontech.com.br">mbruce@martontech.com.br</a>
            </td>
        </tr>
    </table>

</body>
</html>
