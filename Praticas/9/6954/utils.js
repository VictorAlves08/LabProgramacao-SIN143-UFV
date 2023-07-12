function validateEmailForm() {
    const email = document.getElementById('email').value;

    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (!regex.test(email)) {
        alert('Por favor, informe um endereço de e-mail válido.');
        return false;
    };

    return true;
}