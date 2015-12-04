<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pedalando :: O seu fórum sobre ciclismo</title>
        <link rel="stylesheet" type="text/css" href="../estilo/estilo.css" />
        <link rel="stylesheet" type="text/css" href="../estilo/menus.css" />
    </head>
    <body>
            <center>
            <div id="pagina">
                <div id="banner">
                    <!-- ImplementaÃ§Ã£o do Logotipo -->
                    <div id="logotipo">
                            <a href="../index.php"><img src="../imagens/logo.png"  /></a>
                    </div>

                    <!-- ImplementaÃ§Ã£o do algoritmo de busca -->
                    <div id="busca">
                            <form action="index.php" method="get">
                                    <input type="text" size="30" name="busca" />
                                    <input type="submit" value="Buscar" />
                            </form>
                    </div>

                    <!-- ImplementaÃ§Ã£o da Ã¡rea do usuÃ¡rio graficamente-->
                    <div id="area_usuario">
                        <?php
                            include("usuario_interno.php");
                        ?>
                    </div>
                </div>
            <div id="menus">
                <?php
                    include("menu.php");
                ?>
            </div>

            <!-- Conteudo da PÃ¡gina -->
            <div id="conteudo">
                <div id="barra_lateral">
                    
                </div>
                <div id="conteudo_pagina">
                <?php
                    if(isset($_SESSION["usuario"])) {
                        $nome = $_POST["nome"];
                        $apelido = $_POST["apelido"];
                        $login = $_POST["login"];
                        $rua = $_POST["rua"];
                        $numero = $_POST["numero"];
                        $complemento = $_POST["complemento"];
                        if (empty($complemento)) {
                            $complemento = " ";
                        }
                        $bairro = $_POST["bairro"];
                        $cidade = $_POST["cidade"];
                        $estado = $_POST["estado"];
                        date_default_timezone_set('America/Sao_Paulo');
                        $data = date('Y-m-d');
                        $hora = date('H:i:s');
                        $id_usuario = $_SESSION["id_usuario"];

                        //Conexão ao banco de dados
                        mysql_connect("localhost","root","") or die ("Falha na conexão com o servidor");
                        mysql_select_db("forum") or die ("Falha na seleção da base de dados");

                        //Atualizando as informações no Banco de Dados
                        $query = "UPDATE usuario 
                                    SET nome='$nome',apelido='$apelido',login='$login',rua='$rua', 
                                        numero='$numero',complemento='$complemento',bairro='$bairro',
                                        cidade='$cidade',estado='$estado',data_alteracao='$data',
                                            hora_alteracao='$hora'
                                    WHERE id_usuario = ".$id_usuario.";";
                        echo($query);
                        mysql_query($query) or die ("Falha na atualização");
                        Header("Location: ../perfil.php?altera");
                    } else {
                        echo("Sessão expirada! Favor fazer login novamente!<br /><br />");
                        echo("<a href='login.php?url=perfil.php'>Login</a>");
                    }
                ?>
                </div>
            </div>

            <!-- RodapÃ© da PÃ¡gina -->
            <div id="rodape">
                <?php
                    include("../includes/rodape.php");
                ?>
            </div>
        </div>
        </center>
    </body>
</html>