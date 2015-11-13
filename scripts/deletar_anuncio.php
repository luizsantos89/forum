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
                                
                                echo ("<h1>Dados do Anúncio: </h1>                                        
                                <form action='deletar_anuncio.php' method='post'>
                                        Pergunta: <br /><textarea name='titulo' cols='60' rows='1'>$titulo</textarea><br /><br />
                                        Detalhes: <br /><textarea name='texto' cols='60' rows='10'>$texto</textarea></td><br /><br />
                                        Confirma a exclusão? 
                                        <input type='radio' name='confirma' value='sim' />Sim 
                                        <input type='radio' name='confirma' value='nao' />Não <br /><br />
                                        <input type='hidden' name='id_anuncio' value=".$id_anuncio." />
                                        <input type='submit' value='Editar' />
                                </form>");
                            }
                        }
                    }
                    
                    //Verifica se já foi confirmado a edição
                    if (isset($_POST["id_anuncio"])) {
                        if($_POST["confirma"]=="sim") {
                            
                            //Busca as informações das perguntas
                            include("busca_anuncios_usuario.php");
                            
                            //Exibe a pergunta na tela
                            $id_anuncio = (int) $_POST["id_anuncio"];
                            $titulo = $_POST["titulo"];
                            $texto = $_POST["texto"];
                            while ($anuncio = mysql_fetch_assoc($resultado)){ 
                                if($anuncio["id_anuncio"] == $id_anuncio){
                                    $altera = "DELETE from anuncio WHERE id_anuncio = ".$id_anuncio."";
                                    $alterar = mysql_query($altera) or die ("Falha na atualização dos dados");
                                    echo("Deletado com sucesso! <br><br><a href='../meus_anuncios.php'>Voltar para meus anúncios</a>");
                                }
                            }
                            } else {
                                echo("Nada foi alterado");
                                echo("<br><br><a href='../meus_anuncios.php'>Voltar para meus anúncios</a>");
                            }
                        }
                ?>
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