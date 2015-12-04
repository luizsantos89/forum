<?php session_start(); ?>
<html>
    <head>
        <title> Pedalando :: O seu fórum sobre ciclismo </title>
        <link rel="stylesheet" href="../estilo/estilo.css" type="text/css" />
        <link rel="stylesheet" href="../estilo/menus.css" type="text/css" />
        <script type="text/javascript" src="../scripts/telefone.js"></script>
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
                        if(isset($_GET["id_anuncio"])) {
                            $id_anuncio = (int) $_GET["id_anuncio"];                               

                            //Buscar dados da pergunta
                            include("busca_anuncios_usuario.php");


                            //Exibe a pergunta na tela
                            while ($anuncio = mysql_fetch_assoc($resultado)){ 
                                if($anuncio["id_anuncio"] == $id_anuncio){
                                    $texto = $anuncio["texto"];
                                    $titulo = $anuncio["titulo"];
                                    $valor = $anuncio["valor"];
                                    $telefone = $anuncio["telefone"];
                                    $email = $anuncio["email"];

                                    echo ("<h1>Confirme as edições: </h1>
                                    <form action='editar_anuncio.php' method='post'>
                                        <table>
                                            <tr><td>Pergunta: </td><td><input name='titulo' size='60'  value='".$titulo."' /></td></tr>
                                            <tr><td colspan='2'>Detalhes: <br /></td></tr>
                                            <tr><td colspan='2'><textarea name='texto' cols='60' rows='10'>$texto</textarea></td></tr>
                                            <tr><td>E-mail: </td><td><input name='email' size='60'  value='".$email."' /></td></tr>
                                            <tr><td>Telefone: </td><td><input name='telefone' size='60' id='telefone' value='".$telefone."' /></td></tr>
                                            <tr><td>Valor: </td><td>R$<input name='valor' size='57'  value='".$valor."' /></td></tr>
                                            <input type='hidden' name='id_anuncio' value=".$id_anuncio." /></td></tr>
                                            <tr><td colspan='2'><input type='submit' value='Editar' /></td></tr>
                                        </table>
                                    </form>");
                                }
                            }
                        }

                        //Verifica se já foi confirmado a edição
                        if (isset($_POST["id_anuncio"])) {                            
                            //Busca as informações das perguntas
                            include("busca_anuncios_usuario.php");

                            //Exibe a pergunta na tela
                            $id_anuncio = (int) $_POST["id_anuncio"];
                            $titulo = $_POST["titulo"];
                            $texto = $_POST["texto"];    
                            $email = $_POST["email"];
                            $telefone = $_POST["telefone"];
                            $valor = $_POST["valor"];
                            while ($anuncio = mysql_fetch_assoc($resultado)){ 
                                if($anuncio["id_anuncio"] == $id_anuncio){
                                    $altera = "UPDATE anuncio 
                                                    SET titulo='$titulo', texto='$texto',
                                                        email='$email', telefone='$telefone',
                                                        valor=$valor
                                                    WHERE id_anuncio = ".$id_anuncio."";
                                    $alterar = mysql_query($altera) or die ("Falha na atualização dos dados");
                                    echo("Alterado com sucesso! <br><br><a href='../meus_anuncios.php'>Voltar para meus anúncios</a>");
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