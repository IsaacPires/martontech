<form action="{{route('suppliers.store')}}" method="POST">
    @csrf
    <div>
        <div>
            <label for="Name">Nome Fornecedor</label>
            <input autofocus type="text" name="Name" id="Name">
        </div>
        <div>
            <label for="Segments">Segmento</label>
            <input type="text" name="Segments" id="Segments">
        </div>
        <div>
            <label for="Cnpj">CNPJ</label>
            <input type="number" name="Cnpj" id="Cnpj">
        </div>
        <div>
            <label for="AddressStreet">Endereco</label>
            <input type="text" name="AddressStreet" id="AddressStreet">
        </div>
        <div>
            <input type="text" name="AddressNeighborhood" id="AddressNeighborhood">
        </div>
        <div>
            <input type="text" name="AddressNumber" id="AddressNumber">
        </div>
        <div>
            <input type="text" name="AddressCity" id="AddressCity">
        </div>
        <div>
            <input type="text" name="AddressState" id="AddressState">
        </div>
        <div>
            <input type="text" name="AddressZipCode" id="AddressZipCode">
        </div>
        <div>
            <label for="ContactNameOne">Nome Contato</label>
            <input type="text" name="ContactNameOne" id="ContactNameOne">
        </div>
        <div>
            <label for="ContactPhoneOne">Telefone</label>
            <input type="text" name="ContactPhoneOne" id="ContactPhoneOne">
        </div>
        <div>
            <label for="ContactEmailOne">Email</label>
            <input type="text" name="ContactEmailOne" id="ContactEmailOne">
        </div>
        <div>
            <label for="ContactNameTwo">Nome Contato 2</label>
            <input type="text" name="ContactNameTwo" id="ContactNameTwo">
        </div>
        <div>
            <label for="ContactPhoneTwo">Telefone 2</label>
            <input type="text" name="ContactPhoneTwo" id="ContactPhoneTwo">
        </div>
        <div>
            <label for="ContactEmailTwo">Email 2</label>
            <input type="text" name="ContactEmailTwo" id="ContactEmailTwo">
        </div>
    </div>
    <button type="submit">Adicionar</button>
</form>