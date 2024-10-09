document.getElementById('value').addEventListener('input', function (e) {
    // Remove tudo que não é número ou vírgula
    this.value = this.value.replace(/[^0-9,]/g, '');
    
    if ((this.value.match(/,/g) || []).length > 1) {
        this.value = this.value.split(',').slice(0, 2).join(',').replace(/,/g, (m, offset, string) => offset === string.indexOf(',') ? m : '');
    }
});