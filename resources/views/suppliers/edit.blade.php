<x-layout title='Editar Fornecedor'>
    <form action='{{route("suppliers.update", ["supplier" => $supplier->id])}}' method="POST">
        @csrf
        @method('PUT')        
        <h3>Infos</h3>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <label for="Name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="Name" name="Name" value='{{$supplier->Name}}' required>
            </div>
            <div class="col-md-4">
                <label for="Segments" class="form-label">Segmento</label>
                <input type="text" class="form-control" id="Segments" name="Segments" value='{{$supplier->Segments}}' required>
            </div>

            <div class="col-md-4">
                <label for="Cnpj" class="form-label">CNPJ</label>
                <input type="text" class="form-control" id="Cnpj" name="Cnpj" value='{{$supplier->Cnpj}}' required>
            </div>
        </div>
        </br>
        <h3>Endereço</h3>
        <hr>
        <div class="row">

            <div class="col-md-4">
                <label for="AddressStreet" class="form-label">Rua</label>
                <input type="text" class="form-control" id="AddressStreet" name="AddressStreet" value='{{$supplier->AddressStreet}}' required>
            </div>

            <div class="col-md-4">
                <label for="AddressNumber" class="form-label">Número</label>
                <input type="text" class="form-control" id="AddressNumber" name="AddressNumber" value='{{$supplier->AddressNumber}}' required>
            </div>

            <div class="col-md-4">
                <label for="AddressNeighborhood" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="AddressNeighborhood" name="AddressNeighborhood" value='{{$supplier->AddressNeighborhood}}' required>
            </div>

            <div class="col-md-4">
                <label for="AddressCity" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="AddressCity" name="AddressCity" value='{{$supplier->AddressCity}}' required>
            </div>

            <div class="col-md-4">
                <label for="AddressState" class="form-label">Estado</label>
                <input type="text" class="form-control" id="AddressState" name="AddressState" value='{{$supplier->AddressState}}' required>
            </div>

            <div class="col-md-4">
                <label for="AddressZipCode" class="form-label">CEP</label>
                <input type="text" class="form-control" id="AddressZipCode" name="AddressZipCode" value='{{$supplier->AddressZipCode}}' required>
            </div>

        </div>
        </br>
        <h3>Contato</h3>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <label for="ContactNameOne" class="form-label">Nome 1</label>
                <input type="text" class="form-control" id="ContactNameOne" name="ContactNameOne" value='{{$supplier->ContactNameOne}}' required>
            </div>

            <div class="col-md-4">
                <label for="ContactPhoneOne" class="form-label">Telefone 1</label>
                <input type="tel" class="form-control" id="ContactPhoneOne" name="ContactPhoneOne" value='{{$supplier->ContactPhoneOne}}' required>
            </div>

            <div class="col-md-4">
                <label for="ContactEmailOne" class="form-label">Email 1</label>
                <input type="email" class="form-control" id="ContactEmailOne" name="ContactEmailOne" value='{{$supplier->ContactEmailOne}}' required>
            </div>

        </div>

        <div class="row">

            <div class="col-md-4">
                <label for="ContactNameTwo" class="form-label">Nome 2 </label>
                <input type="text" class="form-control" id="ContactNameTwo" name="ContactNameTwo" value='{{$supplier->ContactNameTwo}}'>
            </div>

            <div class="col-md-4">
                <label for="ContactPhoneTwo" class="form-label">Telefone 2</label>
                <input type="tel" class="form-control" id="ContactPhoneTwo" name="ContactPhoneTwo" value='{{$supplier->ContactPhoneTwo}}'>
            </div>

            <div class="col-md-4">
                <label for="ContactEmailTwo" class="form-label">Email 2</label>
                <input type="email" class="form-control" id="ContactEmailTwo" name="ContactEmailTwo" value='{{$supplier->ContactEmailTwo}}'>
            </div>

        </div>
        <br>
        <button type="submit" class="btn btn-primary">Atualizar</button>
        <a type="submit" href={{route("suppliers.index")}} class="btn btn-secondary">Voltar</a>

    </form>

</x-layout>