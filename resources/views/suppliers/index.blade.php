<x-layout title="Fornecedores">
    <form>
        <h3>Infos</h3>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="col-md-4">
                <label for="segmento" class="form-label">Segmento</label>
                <input type="text" class="form-control" id="segmento" name="segmento" required>
            </div>

              <div class="col-md-4">
                <label for="cnpj" class="form-label">CNPJ</label>
                <input type="text" class="form-control" id="cnpj" name="cnpj" required>
            </div>
        </div>
        </br>
        <h3>Endereço</h3>
        <hr>
        <div class="row">

            <div class="col-md-4">
                <label for="rua" class="form-label">Rua</label>
                <input type="text" class="form-control" id="rua" name="rua" required>
            </div>
    
            <div class="col-md-4">
                <label for="bairro" class="form-label">Bairro</label>
                <input type="text" class="form-control" id="bairro" name="bairro" required>
            </div>

            <div class="col-md-4">
                <label for="cidade" class="form-label">Cidade</label>
                <input type="text" class="form-control" id="cidade" name="cidade" required>
            </div>

            <div class="col-md-4">
                <label for="estado" class="form-label">Estado</label>
                <input type="text" class="form-control" id="estado" name="estado" required>
            </div>

            <div class="col-md-4">
                <label for="cep" class="form-label">CEP</label>
                <input type="text" class="form-control" id="cep" name="cep" required>
            </div>

        </div>
        </br>
        <h3>Contato</h3>
        <hr>
        <div class="row">
            <div class="col-md-4">
                <label for="nomeContato" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nomeContato" name="nomeContato" required>
            </div>

            <div class="col-md-4">
                <label for="telefone1" class="form-label">Telefone 1</label>
                <input type="tel" class="form-control" id="telefone1" name="telefone1" required>
            </div>

            <div class="col-md-4">
                <label for="email1" class="form-label">Email 1</label>
                <input type="email" class="form-control" id="email1" name="email1" required>
            </div>

        </div>

        <div class="row">

            <div class="col-md-4">
                <label for="nomeContato" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nomeContato" name="nomeContato" required>
            </div>

            <div class="col-md-4">
                <label for="telefone2" class="form-label">Telefone 2</label>
                <input type="tel" class="form-control" id="telefone2" name="telefone2">
            </div>
            
            <div class="col-md-4">
                <label for="email2" class="form-label">Email 2</label>
                <input type="email" class="form-control" id="email2" name="email2">
            </div>

        </div>
        <br>
        <button type="submit" class="btn btn-primary">Enviar</button>
    </form>

</x-layout>