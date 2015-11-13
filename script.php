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
                        login VARCHAR(20) NOT NULL,
                        apelido VARCHAR(50) NOT NULL,
                        rua VARCHAR(200) NOT NULL,
                        numero VARCHAR(10) NOT NULL,
                        complemento VARCHAR(50) NOT NULL,
                        bairro VARCHAR(100) NOT NULL,
                        cidade VARCHAR(50) NOT NULL,
                        estado VARCHAR(2) NOT NULL,
                        data_cadastro DATE NOT NULL,
                        hora_cadastro TIME NOT NULL,
                        data_ultimo_acesso DATE NOT NULL,
                        hora_ultimo_acesso TIME NOT NULL,
                        data_alteracao DATE,
                        hora_alteracao TIME);";
    $criarUsuario = mysql_query($criandousuario) or die ("Falha na criação da tabela usuário");
    
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('Y-m-d');
    $horario = date('H:i:s');
    echo("Data: $data - Hora: $horario <br /><br />");
    
    //Inserindo 3 usuários de teste 
    echo("Usuário criado: ");
    $insereUsuario1 = "INSERT INTO usuario(nome,senha,login,apelido,cidade,estado,data_cadastro, hora_cadastro) 
        VALUES ('Luiz Claudio Afonso dos Santos','123456','luizsantos89','Luiz Santos','Juiz de Fora','MG','$data','$horario')";
    $insere1 = mysql_query($insereUsuario1) or die ("Falha na inserção do usuario 1");
    echo("luizsantos89, senha: 123456 <br />");
    
    echo("Usuário criado: ");
    $insereUsuario2 = "INSERT INTO usuario(nome,senha,login,apelido,cidade,estado,data_cadastro, hora_cadastro) 
        VALUES ('Gilmar Ferreira Filho','123456','gilferreirafilho','Gilmar Ferreira','Santos Dumont','MG','$data','$horario')";
    $insere2 = mysql_query($insereUsuario2) or die ("Falha na inserção do usuario 2");
    echo("gilferreirafilho, senha: 123456 <br />");
    /*
    echo("Usuário criado: ");
    $insereUsuario3 = "INSERT INTO usuario(nome,senha,login,apelido,cidade,estado,data_cadastro, hora_cadastro) 
        VALUES ('Glaudeilson Mendes','123456','glaudeilson','Glaudeilson','Santos Dumont','MG','$data','$horario')";
    $insere3 = mysql_query($insereUsuario3) or die ("Falha na inserção do usuario 3");
    echo("glaudeilson, senha: 123456 <br /><br />");
    */
    //Criando tabela Perguntas
    $criandoPerguntas = "CREATE TABLE pergunta(
                            id_pergunta INT(10) AUTO_INCREMENT PRIMARY KEY,
                            id_usuario INT(6) NOT NULL REFERENCES usuario(id_usuario),
                            titulo VARCHAR(50) NOT NULL,
                            texto VARCHAR(500) NOT NULL,
                            resposta_pendente INT(1) NOT NULL,
                            data_criacao DATE NOT NULL,
                            hora_criacao TIME NOT NULL,
                            data_alteracao DATE,
                            hora_alteracao TIME);";
    $criarPergunta = mysql_query($criandoPerguntas) or die ("Falha na criação da tabela Pergunta");
    
    //Criando tabela Respostas
    $criandoRespostas = "CREATE TABLE resposta(
                            id_resposta INT(6) AUTO_INCREMENT PRIMARY KEY,
                            id_pergunta INT(10) NOT NULL REFERENCES pergunta(id_pergunta),
                            id_usuario INT(6) NOT NULL REFERENCES usuario(id_usuario),
                            texto VARCHAR(1000) NOT NULL,
                            analisada INT(1) NOT NULL,
                            data_criacao DATE NOT NULL,
                            hora_criacao TIME NOT NULL);";
    $criarResposta = mysql_query($criandoRespostas) or die ("Falha na criação da tabela Reposta");
    
    //Criando tabela Anuncios
    $criandoAnuncios = "CREATE TABLE anuncio(
                           id_anuncio INT(6) AUTO_INCREMENT PRIMARY KEY,
                           id_usuario INT(6) NOT NULL REFERENCES usuario(id_usuario),
                           titulo VARCHAR(500) NOT NULL,
                           texto VARCHAR(1000) NOT NULL,
                           valor REAL(10,2) NOT NULL,
                           data_criacao DATE NOT NULL, 
                           hora_criacao TIME NOT NULL,
                           telefone VARCHAR(16) NOT NULL,
                           email VARCHAR(60) NOT NULL,
                           data_alteracao DATE,
                           hora_alteracao TIME);";
    $criarAnuncio = mysql_query($criandoAnuncios) or die ("Falha na criação da tabela Anúncios");
    
    //Criando a tabela comunidades
    $criandoComunidades = "CREATE TABLE comunidade(
                id_comunidade INT(6) AUTO_INCREMENT PRIMARY KEY,
                id_usuario INT(6) NOT NULL REFERENCES usuario(id_usuario),
                nome VARCHAR(60) NOT NULL,
                descricao VARCHAR(100) NOT NULL,
                data_criacao DATE NOT NULL,
                hora_criacao TIME NOT NULL,
                data_aleracao DATE,
                hora_ateracao TIME);";
    $criarComunidades = mysql_query($criandoComunidades) or die ("Falha na criação da tabela Comunidade");
    
    //Criando a tabela comunidade_usuario
    $criandoRelacionamento = "CREATE TABLE participa(
                id_participa INT(6) AUTO_INCREMENT PRIMARY KEY,
                id_usuario INT(6) NOT NULL REFERENCES usuario(id_usuario),
                id_comunidade INT(6) NOT NULL REFERENCES comunidade(id_comunidade),
                data_ingresso DATE,
                hora_ingresso TIME);";
    $criarRelacionamento = mysql_query($criandoRelacionamento) or die ("Falha na criação da tabela Participa");
    
    //Criando a tabela mensagem
    $criandoMensagem = "CREATE TABLE mensagem(
                id_mensagem INT(6) AUTO_INCREMENT PRIMARY KEY,
                id_comunidade INT(6) NOT NULL REFERENCES comunidade(id_comunidade),
                id_usuario INT(6) NOT NULL REFERENCES usuario(id_usuario),
                mensagem VARCHAR(100) NOT NULL,
                data_postagem DATE,
                hora_postagem TIME);";
    $criarMensagem = mysql_query($criandoMensagem) or die ("Falha na criação da tabela mensagem");
    //Criado com sucesso
    echo ("Estrutura criada com sucesso<br /><br />");
    echo ("<a href='index.php'>Ir para o Projeto</a>");
?>
