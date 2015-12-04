function validaCadastro() {
    nome = document.form1.nome.value;
    apelido = document.form1.apelido.value;
    login = document.form1.login.value;
    senha = document.form1.senha.value;
    senha2 = document.form1.senha2.value;
    rua = document.form1.rua.value;
    numero = document.form1.numero.value;
    complemento = document.form1.complemento.value;
    bairro = document.form1.bairro.value;
    cidade = document.form1.cidade.value;
    estado = document.form1.estado.value;
    
    alert(nome);
    
    if (nome.length < 5) {
        document.form1.nome.focus();
        document.getElementById("msgerro").innerHTML="Nome não pode ter menos de 5 caracteres";
        return false;
    }
    
    if (apelido.length < 5) {
        document.form1.apelido.focus();
        document.getElementById("msgerro").innerHTML="Apelido não pode ter menos de 5 caracteres";
        return false;
    }
    
    if (login.length < 5) {
        document.form1.login.focus();
        document.getElementById("msgerro").innerHTML="Login não pode ter menos de 5 caracteres";
        return false;
    }
    
    if (senha != senha2) {
        document.form1.login.focus();
        document.getElementById("msgerro").innerHTML="Senhas não coincidem";
        return false;
    }
    
    if ((rua.length<1) || (numero.length<1) || (cidade.length<1) || (estado.length < 1)) {rua = document.form1.rua.value;
        document.form1.rua.focus();
        document.getElementById("msgerro").innerHTML="Endereço deve estar completo";
        return false;
    }
    
    return false;
}