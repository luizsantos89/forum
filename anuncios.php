<?php session_start(); ?>
<html>
    <head>
        <title> Pedalando :: O seu fórum sobre ciclismo </title>
            <link rel="stylesheet" href="estilo/estilo.css" type="text/css" />
            <link rel="stylesheet" href="estilo/menus.css" type="text/css" />
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <center>
        <div id="pagina">
            <div id="banner">
                <!-- Implementação do Logotipo -->
                <div id="logotipo">
                    <a href="index.php"><img src="imagens/logo.png"  /></a>
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
                        include("scripts/usuario.php");
                    ?>
                </div>
            </div>
            <div id="menus">
                <?php
                    include("scripts/menu.php");
                ?>
            </div>

            <!-- Conteudo da Página -->
            <div id="conteudo">
                <?php 
                    //Conecta ao servidor MySQL
                    $conecta = mysql_connect("localhost","root","") or print 'Sem conexão';

                    //Seleciona a Base de Dados
                    mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");
                    
                    /*Busca as perguntas de todos os outros usuários*/
                    $selecao = "SELECT * FROM usuario u INNER JOIN anuncio a WHERE u.id_usuario = a.id_usuario";
                    $query = mysql_query($selecao) or die ("Falha na consulta dos dados");
                    while ($anuncio = mysql_fetch_assoc($query)){ 
                        //Compara o usuário logado atualmente e o usuário das perguntas
                        $id_usuario = (int) $anuncio["id_usuario"];
                        $id_usuario_logado = (int) $_SESSION["id_usuario"];
                        if ($id_usuario != $id_usuario_logado) {  
                            $apelido = $anuncio["apelido"];
                            $id_anuncio = (int) $anuncio["id_anuncio"];
                            echo ("<div id='perguntas'>
                            <small>Criado em: ".date('d/m/Y',strtotime($anuncio["data_criacao"]))." às ".date('H:i:s',strtotime($anuncio["hora_criacao"]))."<br>Por ".$apelido."</small><br /><br/>
                            <b>".$anuncio["titulo"]."</b><br />
                            <p>".$anuncio["texto"]."</p><br />
                            <b>Entre em contato com o anunciante: </b><br/>
                            <p>Telefone: ".$anuncio["telefone"]." <br />
                            E-mail: ".$anuncio["email"]." </p>
                            </div>");
                            }
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