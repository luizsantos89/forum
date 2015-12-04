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
                    <form action="index.php" method="get">
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
                <div id="barra_lateral"></div>
                <div id="conteudo_pagina">
                    <?php 
                        // Verifica se veio da página principal
                        if(isset($_GET["id_comunidade"])) {
                            $id_comunidade = (int) $_GET["id_comunidade"];                               

                            //Buscar dados da pergunta
                            include("busca_comunidades_usuario.php");


                            //Exibe a pergunta na tela
                            while ($comunidade = mysql_fetch_assoc($resultado)){ 
                                if($comunidade["id_comunidade"] == $id_comunidade){
                                    $texto = $comunidade["descricao"];
                                    $titulo = $comunidade["nome"];

                                    echo ("<h1>Confirme as edições: </h1> 
                                        <small>Preencher todos os campos</small><br /><br />
                                    <form action='editar_comunidade.php' method='post'>
                                            Pergunta: <br /><input name='titulo' size='60' value='".$titulo."' /><br /><br />
                                            Detalhes: <br /><textarea name='texto' cols='60' rows='10'>$texto</textarea></td><br /><br />
                                            <input type='hidden' name='id_comunidade' value=".$id_comunidade." />
                                            <input type='submit' value='Editar' />
                                    </form>");
                                }
                            }
                        }

                        //Verifica se já foi confirmado a edição
                        if (isset($_POST["id_comunidade"])) {                            
                            //Busca as informações das perguntas
                            include("busca_comunidades_usuario.php");

                            //Exibe a pergunta na tela
                            $id_comunidade = (int) $_POST["id_comunidade"];
                            $nome = $_POST["titulo"];
                            $descricao = $_POST["texto"];
                            while ($comunidade = mysql_fetch_assoc($resultado)){ 
                                if($comunidade["id_comunidade"] == $id_comunidade){
                                    $altera = "UPDATE comunidade 
                                                    SET nome = '".$nome."', descricao = '".$descricao."' 
                                                    WHERE id_comunidade = ".$id_comunidade."";
                                    $alterar = mysql_query($altera) or die ("Falha na atualização dos dados");
                                    echo("Alterado com sucesso! <br><br><a href='../minhas_comunidades.php'>Voltar para minhas comunidades</a>");
                                }
                            }
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