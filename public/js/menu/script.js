const mobileScreen = window.matchMedia("(max-width: 990px)");

document.addEventListener("DOMContentLoaded", function() {

    $('.select2').select2({
        tags: true
    });

    const dashboardNavDropdownToggles = document.querySelectorAll(".dashboard-nav-dropdown-toggle");
    dashboardNavDropdownToggles.forEach(function(toggle) {
        toggle.addEventListener("click", function() {
            const dropdown = toggle.closest(".dashboard-nav-dropdown");
            dropdown.classList.toggle("show");

            const subDropdowns = dropdown.querySelectorAll(".dashboard-nav-dropdown");
            subDropdowns.forEach(function(subDropdown) {
                subDropdown.classList.remove("show");
            });

            const siblings = toggle.parentElement.parentElement.children;
            for (let sibling of siblings) {
                if (sibling !== toggle.parentElement) {
                    sibling.classList.remove("show");
                }
            }
        });
    });

    const menuToggleApp = document.querySelector("#menu-toggle-app")
    const menuToggleNav = document.querySelector("#menu-toggle-nav") ;
    
    document.addEventListener("click", e => {
        if(e.target.id == menuToggleApp.id || e.target.id == menuToggleNav.id ){
            if (mobileScreen.matches) {
                const dashboardNav = document.querySelector(".dashboard-nav");
                dashboardNav.classList.toggle("mobile-show");
            } else {
                const dashboard = document.querySelector(".dashboard");
                dashboard.classList.toggle("dashboard-compact");
            } 
        }

    });

    var deleteButtons = document.querySelectorAll('.delete-button');
    var deleteModal = document.getElementById('deleteModal');
    var deleteForm = document.getElementById('deleteForm');
    var deleteIdInput = document.getElementById('deleteId');
    var path = window.location.pathname;
    
    if (path.charAt(0) === '/') {
        path = path.substring(1);
    }    
    
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var productId = this.getAttribute('data-id');
            var url = '/'+ path +'/' + productId;
            deleteIdInput.value = productId;
            deleteForm.setAttribute('action', url);
            deleteModal.style.display = 'block';
        });
    });
    
    var closeButtons = document.querySelectorAll('.close');
    closeButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            deleteModal.style.display = 'none';
        });
    });


    /* ///////////////////// Modal De request /////////////////

    var showNamesButtons = document.querySelectorAll('.showNamesButton');
    var namesModal = document.getElementById('namesModal');
    var namesList = document.getElementById('namesList');
    var closeNamesModalButtons = document.querySelectorAll('.closeNamesModal');

    if (showNamesButtons.length === 0) {
        console.error('Nenhum botão com a classe .showNamesButton foi encontrado.');
        return;
    }

    showNamesButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Limpa a lista atual
            namesList.innerHTML = '';

            // Obtém o ID do botão
            var orderId = this.dataset.id;

            // Faz a solicitação AJAX
            fetch('/get-request-info/' + orderId)
                .then(response => response.json())
                .then(data => {
                    // Adiciona cada item à tabela
                    data.forEach(function(item) {
                        // Formata o preço atual para incluir "R$" na frente
                        var currentPriceFormatted = 'R$ ' + parseFloat(item.currentPrice).toFixed(2);

                        // Cria uma nova linha na tabela
                        var row = document.createElement('tr');

                        // Cria células na linha para cada campo
                        var supplierIdCell = document.createElement('td');
                        var currentPriceCell = document.createElement('td');
                        var quantityCell = document.createElement('td');

                        // Define o texto de cada célula com os valores correspondentes
                        supplierIdCell.textContent = item.Name;
                        currentPriceCell.textContent = currentPriceFormatted; // Preço formatado
                        quantityCell.textContent = item.quantity;

                        // Adiciona as células à linha
                        row.appendChild(supplierIdCell);
                        row.appendChild(currentPriceCell);
                        row.appendChild(quantityCell);

                        // Adiciona a linha à tabela
                        namesList.appendChild(row);
                    });

                    // Exibe o modal
                    namesModal.style.display = 'block';
                })
                .catch(error => {
                    console.error('Erro ao buscar os dados:', error);
                });
        });
    });

    closeNamesModalButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            // Fecha o modal
            namesModal.style.display = 'none';
        });
    });

    // Fecha o modal quando clicar fora dele
    window.addEventListener('click', function(event) {
        if (event.target === namesModal) {
            namesModal.style.display = 'none';
        }
    }); */

});



