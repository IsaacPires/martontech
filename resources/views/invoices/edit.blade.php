<x-layout title="Notas Fiscais - Atualizar">
    <form action='{{route("invoices.update", ["invoice" => $invoices->id])}}' method="POST">
        @csrf
        @method('PUT')
        <div class="row">
            <div class="col-md-4">
                <label for="ReceivingDate" class="form-label">Data de Recebimento</label>
                <input type="date" class="form-control" id="ReceivingDate" name="ReceivingDate" value="{{date('Y-m-d', strtotime($invoices->ReceivingDate))}}">
            </div>
            <div class="col-md-4">
                <label for="InvoiceDate" class="form-label">Data Nota Fiscal</label>
                <input type="date" class="form-control" id="InvoiceDate" name="InvoiceDate" value="{{date('Y-m-d', strtotime($invoices->InvoiceDate))}}">
            </div>
            <div class="col-md-4">
                <label for="Client" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="Client" name="Client" value='{{$invoices->Client}}'>
            </div>
            <div class="col-md-4">
                <label for="NumberInvoice" class="form-label">Número da Nota Fiscal</label>
                <input type="text" class="form-control" id="NumberInvoice" name="NumberInvoice" value='{{$invoices->NumberInvoice}}'>
            </div>
            <div class="col-md-4">
                <label for="Material" class="form-label">Material</label>
                <input type="text" class="form-control" id="Material" name="Material" value='{{$invoices->Material}}'>
            </div>
            <div class="col-md-4">
                <label for="DepartureDate" class="form-label">Data de Saída</label>
                <input type="date" class="form-control" id="DepartureDate" name="DepartureDate" value='{{$invoices->DepartureDate}}'>
            </div>
            <div class="col-md-4">
                <label for="NumberInvoiceMarton" class="form-label">Número da Nota Marton</label>
                <input type="text" class="form-control" id="NumberInvoiceMarton" name="NumberInvoiceMarton" value='{{$invoices->NumberInvoiceMarton}}' >
            </div>
            <div class="col-md-4">
                <label for="FinalTransport" class="form-label">Transporte Final</label>
                <input type="text" class="form-control" id="FinalTransport" name="FinalTransport" value='{{$invoices->FinalTransport}}' >
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a type="submit" href='{{route("invoices.index")}}' class="btn btn-secondary">Voltar</a>
    </form>

</x-layout>