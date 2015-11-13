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
                    if(isset($_GET["id_pergunta"])) {
                        $id_pergunta = (int) $_GET["id_pergunta"];                               

                        //Buscar dados da pergunta
                        include("busca_perguntas_usuario.php");


                        //Exibe a pergunta na tela
                        while ($pergunta = mysql_fetch_assoc($resultado)){ 
                            if($pergunta["id_pergunta"] == $id_pergunta){
                                $texto = $pergunta["texto"];
                                $titulo = $pergunta["titulo"];
                                
                                echo ("<h1>Dados da Pergunta: </h1>                                        
                                <form action='deletar_pergunta.php' method='post'>
                                        Pergunta: <br /><textarea name='titulo' cols='60' rows='1'>$titulo</textarea><br /><br />
                                        Detalhes: <br /><textarea name='texto' cols='60' rows='10'>$texto</textarea></td><br /><br />
                                        Confirma a exclusão? 
                                        <input type='radio' name='confirma' value='sim' />Sim 
                                        <input type='radio' name='confirma' value='nao' />Não <br /><br />
                                        <input type='hidden' name='id_pergunta' value=".$id_pergunta." />
                                        <input type='submit' value='Editar' />
                                </form>");
                            }
                        }
                    }
                    
                    //Verifica se já foi confirmado a edição
                    if (isset($_POST["id_pergunta"])) {
                        if($_POST["confirma"]=="sim") {
                            
                            //Busca as informações das perguntas
                            include("busca_perguntas_usuario.php");
                            
                            //Exibe a pergunta na tela
                            $id_pergunta = (int) $_POST["id_pergunta"];
                            $titulo = $_POST["titulo"];
                            $texto = $_POST["texto"];
                            while ($pergunta = mysql_fetch_assoc($resultado)){ 
                                if($pergunta["id_pergunta"] == $id_pergunta){
                                    $altera = "DELETE from pergunta WHERE id_pergunta = ".$id_pergunta."";
                                    $alterar = mysql_query($altera) or die ("Falha na atualização dos dados");
                                    echo("Deletado com sucesso! <br><br><a href='../minhas_perguntas.php'>Voltar para minhas perguntas</a>");
                                }
                            }
                            } else {
                                echo("Nada foi alterado");
                                echo("<br><br><a href='../minhas_perguntas.php'>Voltar para minhas perguntas</a>");
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