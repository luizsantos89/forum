<?php session_start(); ?>
<html>
    <head>
        <title> Pedalando :: O seu fórum sobre ciclismo </title>
            <link rel="stylesheet" href="../estilo/estilo.css" type="text/css" />
            <link rel="stylesheet" href="../estilo/menus.css" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <style>
            th {
                font-size: 12pt;
                font-family: Arial;
                padding-bottom: 10px;
            }
            td {
                padding: 0 15px 0 15px;
            }
        </style>
    </head>
    <body>
        <center>
        <div id="pagina">
            <div id="banner">
                <!-- Implementação do Logotipo -->
                <div id="logotipo">
                    <a href="../index.php"><img src="../imagens/logo.png"  /></a>
                </div>

                <!-- Implementação do algoritmo de busca -->
                <div id="busca">
                    <form action="../index.php" method="get">
                        <input type="text" size="30" name="busca" />
                        <input type="submit" value="Buscar" />
                    </form>
                </div>

                <!-- Implementação da área do usuário graficamente-->
                <div id="area_usuario">
                    <?php
                        if (isset($_SESSION["usuario"]))
                            echo("Bem vindo, ".$_SESSION["usuario"].' | 
                                    <form action="../index.php" method="post">
                                         <input type="hidden" name="sair" />
                                         <input type="submit" value="Sair" />
                                    </form>');
                        else {
                            echo("
                            <form action='../login.php' method='post'>
                                User: <input type='text' name='usuario' size='8' /><br />
                                Senha: <input type='password' name='senha' size='8' /><br />
                                <input type='submit' value='Entrar' />
                            </form>
                            ");
                            }	
                    ?>
                </div>
            </div>
            <div id="menus">
                <?php
                    echo('
                    <ul>
                        <li><a href="../index.php">Principal</a>
                        <li><a href="../minhas_perguntas.php">Minhas Perguntas</a>
                        <li><a href="../nova_pergunta.php">Perguntar</a>
                        <li><a href="../analise_respostas.php">Analisar Respostas</a>
                        <li><a href="../perguntas.php">Perguntas de Outros Usuários</a>
                    </ul>
                    ');
                ?>
            </div>

            <!-- Conteudo da Página -->
            <div id="conteudo">
                <?php 
                    // Verifica se veio da página principal
                    if(isset($_POST["resposta"])) {
                        //Variáveis necessárias para gravar a resposta
                        $id_pergunta = (int) $_POST["id_pergunta"];
                        $resposta = $_POST["resposta"]; 
                        date_default_timezone_set('America/Sao_Paulo');
                        $data = date('Y-m-d');
                        $hora = date('H:i:s');
                        $id_usuario_resposta = (int) $_SESSION["id_usuario"];
                        $apelido_resposta = $_SESSION["usuario"];
                        
                        //Conecta ao servidor MySQL
                        $conect = mysql_connect("localhost","root","") or print 'Sem conexão';

                        //Seleciona a Base de Dados
                        mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");
                        
                        //Pegando as informações da pergunta e o usuário que a fez
                        $consulta_completa = "SELECT * FROM usuario u INNER JOIN pergunta p
                                             WHERE u.id_usuario = p.id_usuario";
                        $resultado_completo = mysql_query($consulta_completa);
                        while ($criaVar = mysql_fetch_assoc($resultado_completo)){
                            if ($criaVar["id_pergunta"] == $id_pergunta) {
                                $apelido = $criaVar["apelido"];
                                $id_usuario_pergunta = (int) $criaVar["id_usuario"];
                                $titulo_pergunta = $criaVar["titulo"];
                                $texto_pergunta = $criaVar["texto"];
                            }
                        }
                        
                        //Grava os dados na tabela resposta
                        $grava_resposta = "INSERT INTO resposta(id_usuario,id_pergunta,texto,data_criacao,analisada, hora_criacao) 
                                                        VALUES ($id_usuario_resposta,$id_pergunta,'$resposta', '$data',0,$hora)";
                        $insere_resp = mysql_query($grava_resposta) or die ("Erro na gravação da resposta");
                        
                        //Grava a pendencia na tabela pergunta
                        $grava_pendencia = "UPDATE pergunta SET resposta_pendente = 1
                                                WHERE id_pergunta = ".$id_pergunta."";
                        
                        $insere_pendencia = mysql_query($grava_pendencia) or die ("Erro na gravação da pendencia de análise.");
                        
                        //Mensagens de confirmação
                        echo(" <h2> Pergunta: </h2>
                            <b>$titulo_pergunta</b><br />
                            <p>$texto_pergunta</p>
                            <h2>Sua resposta: </h2>
                            <b><i>$resposta</i></b><br /><br />
                        ");
                        echo("Obrigado por responder, assim que analisada pelo usuário ".$apelido." nós te avisaremos <br /><br />");
                        echo("Voltar para: <a href='../perguntas.php'>Perguntas</a> | <a href='../index.php'>Início</a>");
                         
                    }
                ?>
            </div>

            <!-- Rodapé da Página -->
            <div id="rodape">
                <b>Produzido por: <a href="mailto:luiz.santos89@yahoo.com.br">Luiz Santos</a>, 
                <a href="gil_ferreirafilho@yahoo.com.br">Gilmar Ferreira</a> e <a href="mailto:glaudem@hotmail.com">Glaudeilson Mendes</a></b> <br >
            </div>
        </div>
        </center>
    </body>
</html>