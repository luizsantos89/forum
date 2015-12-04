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
            #resposta_confirm {
                width: 660px;
                border: 1px;
                padding: 10px;
                border-radius: 8px;
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
                        include("usuario_interno.php");
                    ?>
                </div>
            </div>
            <div id="menus">
                <?php
                    include("menu_interno.php");
                ?>
            </div>

            <!-- Conteudo da Página -->
            <div id="conteudo">
                <div id="barra_lateral">
                    
                </div>
                <div id="conteudo_pagina">
                    <?php 
                        // Verifica se veio da página principal
                    if(isset($_SESSION["usuario"])) {
                        if(isset($_POST["resposta"])) {
                            if(!empty($_POST["resposta"])){
                                //Variáveis necessárias para gravar a resposta
                                $id_pergunta = (int) $_POST["id_pergunta"];
                                $resposta = $_POST["resposta"]; 
                                date_default_timezone_set('America/Sao_Paulo');
                                $data = date('Y-m-d');
                                $hora = date('H:i:s');
                                $id_usuario_resposta = (int) $_SESSION["id_usuario"];
                                $apelido_resposta = $_SESSION["usuario"];

                                //Conecta ao servidor MySQL
                                mysql_connect("localhost","root","") or print 'Sem conexão';

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
                                                                VALUES ($id_usuario_resposta,$id_pergunta,'$resposta', '$data',0,'$hora')";
                                $insere_resp = mysql_query($grava_resposta) or die ("Erro na gravação da resposta");

                                //Grava a pendencia na tabela pergunta
                                $grava_pendencia = "UPDATE pergunta SET resposta_pendente = 1
                                                        WHERE id_pergunta = ".$id_pergunta."";

                                $insere_pendencia = mysql_query($grava_pendencia) or die ("Erro na gravação da pendencia de análise.");

                                //Mensagens de confirmação
                                echo("
                                  <div id='resposta_confirm'>  
                                    <h2> Pergunta: </h2>
                                    ".strtoupper($titulo_pergunta)."<br /><br />
                                    <h3>Sua resposta: </h3>
                                    $resposta</i><br /><br /><br />
                                ");
                                echo("Obrigado por responder ! Assim que for analisada, será postada na página da pergunta! ;D<br /><br /><br /><br />");
                                echo("Voltar para: <a href='../perguntas.php'>Perguntas</a> | <a href='../index.php'>Início</a>");
                                echo('</div>');
                            } else {
                                echo("Não pode ficar em branco!<br /><br />");
                                echo("Voltar para: <a href='../perguntas.php'>Perguntas</a> | <a href='../index.php'>Início</a>");
                            }
                        }
                    } else {
                        $url = $_POST["url"];
                        header("Location:../login.php?url=$url");
                    }
                    ?>
                </div>
            </div>

            <!-- Rodapé da Página -->
            <div id="rodape">
                <b>Produzido por: <a href="mailto:luiz.santos89@yahoo.com.br">Luiz Santos</a> e
                <a href="gil_ferreirafilho@yahoo.com.br">Gilmar Ferreira</a>
            </div>
        </div>
        </center>
    </body>
</html>