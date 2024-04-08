<x-layout title="Notas Fiscais - Adicionar">
    <form action="{{route('invoices.store')}}" method="POST">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <label for="ReceivingDate" class="form-label">Data de Recebimento</label>
                <input type="date" class="form-control" id="ReceivingDate" name="ReceivingDate" required>
            </div>
            <div class="col-md-4">
                <label for="InvoiceDate" class="form-label">Data Nota Fiscal</label>
                <input type="date" class="form-control" id="InvoiceDate" name="InvoiceDate" required>
            </div>
            <div class="col-md-4">
                <label for="Client" class="form-label">Cliente</label>
                <input type="text" class="form-control" id="Client" name="Client" required>
            </div>
            <div class="col-md-4">
                <label for="NumberInvoice" class="form-label">Número da Nota Fiscal</label>
                <input type="text" class="form-control" id="NumberInvoice" name="NumberInvoice" required>
            </div>
            <div class="col-md-4">
                <label for="Material" class="form-label">Material</label>
                <input type="text" class="form-control" id="Material" name="Material" required>
            </div>
            <div class="col-md-4">
                <label for="DepartureDate" class="form-label">Data de Saída</label>
                <input type="date" class="form-control" id="DepartureDate" name="DepartureDate" required>
            </div>
            <div class="col-md-4">
                <label for="NumberInvoiceMarton" class="form-label">Número da Nota Marton</label>
                <input type="text" class="form-control" id="NumberInvoiceMarton" name="NumberInvoiceMarton" required>
            </div>
            <div class="col-md-4">
                <label for="FinalTransport" class="form-label">Transporte Final</label>
                <input type="text" class="form-control" id="FinalTransport" name="FinalTransport" required>
            </div>
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

</x-layout>