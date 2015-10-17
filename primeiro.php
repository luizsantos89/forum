<?php
    //Entrando no MySQL
    $conecta = mysql_connect("localhost","root","") or die ("Falha na conexão com o Servidor");
    
    //Criando o Banco de Dados Fórum
    $criandoDB = "CREATE database forum";
    $criar = mysql_query($criandoDB) or die ("Erro na criação do Banco");
    
    //Conecta ao Banco fórum
    mysql_select_db("forum") or die ("Falha na conexão com o banco FORUM");
    
    //Criando a Tabela usuario
    $criandousuario = "CREATE TABLE usuario (
                        id_usuario INT(6) AUTO_INCREMENT PRIMARY KEY,
                        nome VARCHAR(100) NOT NULL,
                        senha VARCHAR(20) NOT NULL,
                        login VARCHAR(15) NOT NULL,
                        apelido VARCHAR(50) NOT NULL,
                        cidade VARCHAR(50) NOT NULL,
                        estado VARCHAR(2) NOT NULL,
                        data_cadastro DATE NOT NULL);";
    $criarUsuario = mysql_query($criandousuario) or die ("Falha na criação da tabela usuário");
    
    //Inserindo 3 usuários de teste 
    echo("Usuário criado: ");
    $insereUsuario1 = "INSERT INTO usuario(nome,senha,login,apelido,cidade,estado,data_cadastro) 
        VALUES ('Luiz Claudio Afonso dos Santos','123456','luizsantos89','Luiz Santos','Juiz de Fora','MG','2015-09-15')";
    $insere1 = mysql_query($insereUsuario1) or die ("Falha na inserção do usuario 1");
    echo("luizsantos89, senha: 123456 <br />");
    
    echo("Usuário criado: ");
    $insereUsuario2 = "INSERT INTO usuario(nome,senha,login,apelido,cidade,estado,data_cadastro) 
        VALUES ('Gilmar Ferreira Filho','123456','gilferreirafilho','Gilmar Ferreira','Santos Dumont','MG','2015-09-16')";
    $insere2 = mysql_query($insereUsuario2) or die ("Falha na inserção do usuario 2");
    echo("gilferreirafilho, senha: 123456 <br />");
    
    echo("Usuário criado: ");
    $insereUsuario3 = "INSERT INTO usuario(nome,senha,login,apelido,cidade,estado,data_cadastro) 
        VALUES ('Glaudeilson Mendes','123456','glaudeilson','Glaudeilson','Santos Dumont','MG','2015-09-17')";
    $insere3 = mysql_query($insereUsuario3) or die ("Falha na inserção do usuario 3");
    echo("glaudeilson, senha: 123456 <br />");
    
    //Criando tabela Perguntas
    $criandoPerguntas = "CREATE TABLE pergunta(
                            id_pergunta INT(10) AUTO_INCREMENT PRIMARY KEY,
                            id_usuario INT(6) NOT NULL REFERENCES usuario(id_usuario),
                            titulo VARCHAR(50) NOT NULL,
                            texto VARCHAR(500) NOT NULL,
                            resposta_pendente INT(1) NOT NULL,
                            data_criacao DATE NOT NULL);";
    $criarPergunta = mysql_query($criandoPerguntas) or die ("Falha na criação da tabela Pergunta");
    
    //Criando tabela Respostas
    $criandoRespostas = "CREATE TABLE resposta(
                            id_pergunta INT(10) NOT NULL REFERENCES pergunta(id_pergunta),
                            id_resposta INT(6) AUTO_INCREMENT PRIMARY KEY,
                            texto VARCHAR(1000) NOT NULL,
                            analisada INT(1) NOT NULL,
                            data_criacao DATE NOT NULL);";
    $criarResposta = mysql_query($criandoRespostas) or die ("Falha na criação da tabela Reposta");
    
    //Criando tabela Anuncios
    $criandoAnuncios = "CREATE TABLE anuncio(
                           id_anuncio INT(6) AUTO_INCREMENT PRIMARY KEY,
                           id_usuario INT(6) NOT NULL REFERENCES usuario(id_usuario),
                           titulo VARCHAR(500) NOT NULL,
                           texto VARCHAR(1000) NOT NULL,
                           data_criacao DATE NOT NULL,                     (32) 9 8495-5545
                           telefone VARCHAR(16) NOT NULL,
                           email VARCHAR(60) NOT NULL);";
    $criarAnuncio = mysql_query($criandoAnuncios) or die ("Falha na criação da tabela Anúncios");
    
    //Criado com sucesso
    echo ("Estrutura criada com sucesso");
    echo ("<a href='index.php'>Ir para o Projeto</a>");
?>
