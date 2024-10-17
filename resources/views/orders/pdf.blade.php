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
        <tr>
            <td class="logo">
                <img style="width:150px" src={{asset("/img/logo_PDF.jpg")}}>
            </td>
            <td width="33%" class="company-info">
                <strong>Marton Tech Industria e Comércio LTDA</strong>
                <p>CNPJ: 19.080.716/0001-74</p>
                <p>Inscrição Municipal: 219.112.881.116</p>
                <p>https://www.martontech.com.br</p>

            </td>
            <td width="33%" class="contact-info">
                <p>Av. Vereador José Angelo Biagione, N°573</p>
                <p>Boituva - SP, 18550-071</p>
                <p>martontech@martontech.com.br</p>
                <p>Telefone: (11) 1234-5678</p>

            </td>
        </tr>

        <tr>
            <td>
                <span class='bold' >Ordem de Compra</span>
            </td>
            <td width="35%" class="company-info">
                <span class='bold'>Data:</span> {{date('d/m/Y')}}

            </td>
            <td width="35%" class="contact-info">
                <span class='bold'>Ordem N°:</span> {{$order->id}}
            </td>
        </tr>

        <!-- Dados do Fornecedor -->
        <tr style="background-color: #b4c6e7;">
            <td>
                <span class='bold'>Dados do Fornecedor:</span>
                <p>Cód: 1234</p>
                <p>Cliente: Fornecedor X</p>
                <p>A/C: Responsável Y</p>
            </td>
            <td>
                <span class='bold'>Endereço:</span>
                <p>Rua Exemplo, 123</p>
                <p>Cidade/Estado: SP</p>
                <p>CEP: 11111-111</p>
            </td>
            <td>
                <span class='bold'>CNPJ:</span> 19.080.716/0001-74
                <p>Email: fornecedor@empresa.com.br</p>
                <p>Telefone: (11) 1234-5678</p>
            </td>
        </tr>

        <!-- Texto de introdução -->
        <tr>
            <td width="100%" colspan="3" style="padding-top: 20px;">
                <span class="bold2">Prezado fornecedor, estamos enviando esta ordem de compra para adquirir os seguintes produtos:</span>
            </td>
        </tr>
        <tr>
            <td colspan="3" style="padding-top: 20px;">
            <table class="table">
                <tr class="table-header">
                    <th class="table-cell">Item</th>
                    <th class="table-cell">Cód.</th>
                    <th class="table-cell">Produto</th>
                    <th class="table-cell">Unid.</th>
                    <th class="table-cell">Qtd.</th>
                    <th class="table-cell">Preço Uni.</th>
                    <th class="table-cell">Preço Tot.</th>
                </tr>
                <tr class="table-row">
                    <td class="table-cell">01</td>
                    <td class="table-cell">486</td>
                    <td class="table-cell">CORRENTE PAS50 38,1X22 PINO OCO</td>
                    <td class="table-cell">M</td>
                    <td class="table-cell">10,00</td>
                    <td class="table-cell">R$ 150,00</td>
                    <td class="table-cell">R$ 1.500,00</td>
                </tr>
                <tr class="table-row">
                    <td class="table-cell">02</td>
                    <td class="table-cell">486</td>
                    <td class="table-cell">CORRENTE PAS50 38,1X22 PINO OCO</td>
                    <td class="table-cell">M</td>
                    <td class="table-cell">15,00</td>
                    <td class="table-cell">R$ 150,00</td>
                    <td class="table-cell">R$ 2.250,00</td>
                </tr>
                <!-- Adicione mais linhas conforme necessário -->
            </table>
            </td>
        </tr>
        <tr>
            <td width="50%" style="padding-top: 20px;">
                <span class='bold2 color-box'>Condição de Pgto.:</span>
            </td>
            <td width="50%" style="padding-top: 20px;">
                <span class='bold2 color-box'>Frete:</span>
            </td>
            <td width="50%" style="padding-top: 20px;">
                <span class='bold2 color-box'>TOTAL:</span>
            </td>
        </tr>

        <tr>
            <td width="50%" style="padding-top: 20px;">
                <span class='bold2'>Condições Gerais de Fornecimento:</span>
            </td>
            <td width="50%" style="padding-top: 20px;">
                <span class='bold2'> Impostos:</span>
            </td>
            <td width="50%" style="padding-top: 20px;">
                <span class='bold2'> </span>
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
                <strong class='bold2' style="color: red;">Observação:</strong>
            </td>
        </tr>

        <!-- Observação adicional -->
        <tr style="background-color: #b4c6e7;">
            <td width="100%" colspan="3" style="padding: 10px;">
                <p>Aqui ficam as observações.</p>
            </td>
        </tr>

        <tr>
            <td width="33%" style="padding-top: 20px;">
                <strong>Airton S. Nakano</strong><br>
                <p>(15) 98189-2835</p>
                <a href="mailto:asnakano@martontech.com.br">asnakano@martontech.com.br</a>
            </td>
            <td width="33%" style="padding-top: 20px; text-align: center;">
                <strong>Marcio B. Leite</strong><br>
                <p>(15) 99849-7108</p>
                <a href="mailto:mbruce@martontech.com.br">mbruce@martontech.com.br</a>
            </td>
        </tr>
    </table>

</body>
</html>
