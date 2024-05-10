<x-layout title="Fornecedores - Adicionar">
    <form action="{{route('suppliers.store')}}" method="POST">
        @csrf
        <h3>Infos</h3>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <label for="Name" class="form-label">Nome</label>
                <input type="text" class="form-control" id="Name" name="Name" required>
            </div>
            <div class="col-md-4">
                <label for="Segments" class="form-label">Segmento</label>
                <input type="text" class="form-control" id="Segments" name="Segments" required>
            </div>

            <div class="col-md-4">
                <label for="Cnpj" class="form-label">CNPJ</label>
                <input type="text" class="form-control" maxlength='14' id="Cnpj" name="Cnpj" required>
            </div>
        </div>
        </br>
        <h3>Endereço</h3>
        <hr>
        <div class="row">

            <div class="col-md-4">
                <label for="AddressZipCode" class="form-label">CEP</label>
                <input type="text" class="form-control" maxlength='8' id="AddressZipCode" name="AddressZipCode" required>
            </div>
            
            <div class="col-md-4">
                <label for="AddressStreet" class="form-label">Rua</label>
                <input type="text" class="form-control" id="AddressStreet" name="AddressStreet" required>
            </div>

            <div class="col-md-4">
                <label for="AddressNumber" class="form-label">Número</label>
                <input type="number" class="form-control" id="AddressNumber" name="AddressNumber" required>
            </div>

            <div class="col-md-4">
                <label for="AddressNeighborhood" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="AddressNeighborhood" name="AddressNeighborhood" required>
            </div>

            <div class="col-md-4">
                <label for="AddressCity" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="AddressCity" name="AddressCity" required>
            </div>

            <div class="col-md-4">
                <label for="AddressState" class="form-label">Estado(UF)</label>
                <input type="text" class="form-control" maxlength='2' id="AddressState" name="AddressState" required>
            </div>

        </div>
        </br>
        <h3>Contato</h3>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <label for="ContactNameOne" class="form-label">Nome 1</label>
                <input type="text" class="form-control" id="ContactNameOne" name="ContactNameOne" required>
            </div>

            <div class="col-md-4">
                <label for="ContactPhoneOne" class="form-label">Telefone 1</label>
                <input type="tel" maxlength='11' class="form-control" id="ContactPhoneOne" name="ContactPhoneOne" required>
            </div>

            <div class="col-md-4">
                <label for="ContactEmailOne" class="form-label">Email 1</label>
                <input type="email" class="form-control" id="ContactEmailOne" name="ContactEmailOne" required>
            </div>

        </div>

        <div class="row">

            <div class="col-md-4">
                <label for="ContactNameTwo" class="form-label">Nome 2 </label>
                <input type="text" class="form-control" id="ContactNameTwo" name="ContactNameTwo">
            </div>

            <div class="col-md-4">
                <label for="ContactPhoneTwo" class="form-label">Telefone 2</label>
                <input type="tel" maxlength='11' class="form-control" id="ContactPhoneTwo" name="ContactPhoneTwo">
            </div>

            <div class="col-md-4">
                <label for="ContactEmailTwo" class="form-label">Email 2</label>
                <input type="email" class="form-control" id="ContactEmailTwo" name="ContactEmailTwo">
            </div>

        </div>
        <br>
        <button type="submit" class="btn btn-primary">Cadastrar</button>
    </form>

</x-layout>
<script src="{{ asset('js/suppliers/script.js') }}"></script>