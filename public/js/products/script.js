document.getElementById('AlertQuantity').addEventListener('input', (event) => {
    let value = event.target.value;

    // Substituir ponto por vírgula
    value = value.replace(/\./g, ',');

    // Permitir apenas duas casas decimais após a vírgula
    const regex = /^-?\d*(,\d{0,2})?$/;
    if (!regex.test(value)) {
        value = value.substring(0, value.length - 1);
    }

    event.target.value = value;
});