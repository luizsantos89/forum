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
                    //Busca as informações do usuario
                    mysql_connect("localhost","root","") or die("Falha na conexão");
                    mysql_select_db("forum") or die ("Falha na seleção da Base de Dados");
                    if(!isset($_SESSION["usuario"])) {
                        $servidor = $_SERVER['SERVER_NAME'];
                        $local = $_SERVER ['REQUEST_URI'];
                        $url = "http://".$servidor.$local;
                        header("Location:login.php?url=$url");
                    }
                    $id_usuario = $_SESSION["id_usuario"];
                    $query = "SELECT * from usuario WHERE id_usuario=$id_usuario" ;
                    $result = mysql_query($query) or die ("Falha na consulta");
                    
                    while ($usuario = mysql_fetch_assoc($result)) {
                        $senha = $usuario["senha"];
                    }
                                        
                    if(isset($_POST["senha"])) {
                        if ($senha == $_POST["senha"]) {
                            //Excluindo os registros do usuário de todas as tabelas do BD
                            $query2 = "DELETE FROM usuario WHERE id_usuario = $id_usuario";
                            mysql_query($query2) or die("Falha na exclusão da tabela usuario");

                            $query3 = "DELETE FROM pergunta WHERE id_usuario = $id_usuario";
                            mysql_query($query3) or die("Falha na exclusão da tabela pergunta");

                            $query4 = "DELETE FROM participa WHERE id_usuario = $id_usuario";
                            mysql_query($query4) or die("Falha na exclusão da tabela participa");

                            $query5 = "DELETE FROM resposta WHERE id_usuario = $id_usuario";
                            mysql_query($query5) or die("Falha na exclusão da tabela resposta");

                            $query6 = "DELETE FROM anuncio WHERE id_usuario = $id_usuario";
                            mysql_query($query6) or die("Falha na exclusão da tabela anuncio");

                            $query7 = "DELETE FROM comunidade WHERE id_usuario = $id_usuario";
                            mysql_query($query7) or die("Falha na exclusão da tabela comunidade");

                            $query8 = "DELETE FROM mensagem WHERE id_usuario = $id_usuario";
                            mysql_query($query8) or die("Falha na exclusão da tabela mensagem");
                            
                            //Destruindo a sessão
                            unset($_SESSION["usuario"]);
                            unset($_SESSION["id_usuario"]);
                            unset($_SESSION["apelido"]);
                            session_destroy();
                            
                            //Redirecionando para  página inicial
                            Header("Location: ../index.php?perfil_excluido");
                        } else {                           
                            echo(" 
                                <form action='excluir_perfil.php' method='post'>    
                                <table>
                                    <tr><td><small>Senha incorreta</small></td></tr>
                                    <tr><td>Para excluir sua conta, confirmar a senha abaixo: </td></tr>
                                    <tr><td>Senha: <input type='password' name='senha' /></td></tr>
                                    <tr><td><input type='submit' value='Excluir minha conta definitivamente' /></td></tr>
                                </table>");
                                }
                    } else {
                        echo(" 
                            <form action='excluir_perfil.php' method='post'>    
                            <table>
                                <tr><td>Para excluir sua conta, confirmar a senha abaixo: </td></tr>
                                <tr><td>Senha: <input type='password' name='senha' /></td></tr>
                                <tr><td><input type='submit' value='Excluir minha conta definitivamente' /></td></tr>
                            </table>");
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