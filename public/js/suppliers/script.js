
function buscarEndereco(cep) {
    fetch(`/api/via-cep/${cep}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('AddressStreet').value = data.logradouro;
            document.getElementById('AddressNeighborhood').value = data.bairro;
            document.getElementById('AddressCity').value = data.localidade;
            document.getElementById('AddressState').value = data.uf;
        })
        .catch(error => console.error('Erro:', error));
  }


  document.getElementById('AddressZipCode').addEventListener('blur', function() {
    var cep = this.value.replace(/\D/g, '');
    if (cep.length === 8) {
        buscarEndereco(cep); 
    }
});