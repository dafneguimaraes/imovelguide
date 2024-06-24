function validateForm() {
    const cadastroCorretor = document.forms.cadastroCorretor;
    const cpf = cadastroCorretor.elements.cpf.value;
    const creci = cadastroCorretor.elements.creci.value;
    const nome = cadastroCorretor.elements.nome.value;

    const errorCpf = document.getElementById("errorCpf")
    const errorCreci = document.getElementById("errorCreci")
    const errorNome = document.getElementById("errorNome")

    if (cpf.length != 11) {

        errorCpf.innerHTML = "CPF precisa de 11 caracteres"
        return false
    } else {
        errorCpf.innerHTML = ""
    }

    if (creci.length < 2) {
        errorCreci.innerHTML = "Precisa de ao menos 2 caracteres"
        return false
    } else {
        errorCreci.innerHTML = ""
    }

    if (nome.length < 2) {
        errorNome.innerHTML = "Precisa de ao menos 2 caracteres"
        return false
    } else {
        errorNome.innerHTML = ""
    }

    return true

}
