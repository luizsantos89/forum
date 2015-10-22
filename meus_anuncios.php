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
                    include("scripts/busca_anuncios_usuario.php");

                    //Exibe as perguntas na tela
                    //echo("<table>");
                    $cont = 0;
                    while ($anuncio = mysql_fetch_assoc($resultado)){ 
                        if($anuncio["id_usuario"] == $_SESSION["id_usuario"]){
                            //echo date('d/m/Y',strtotime($data));
                            $titulo = strtoupper($anuncio["titulo"]);
                            echo ("<table>
                                <tr><td><small>Postado em: ".date('d/m/Y',strtotime($anuncio["data_criacao"]))." às ".date('H:i:s',strtotime($anuncio["hora_criacao"]))." </small></td></tr>
                                <tr><td><b>".$titulo."</b></tr></td>
                                <tr><td><p>".$anuncio["texto"]."</p></tr></td>                                               
                                <tr><td align='right'><a href='scripts/editar_anuncio.php?id_anuncio=".$anuncio["id_anuncio"]." title='Editar anúncio'>Editar</a> | 
                                        <a href='scripts/deletar_anuncio.php?id_anuncio=".$anuncio["id_anuncio"]." title='Deletar anúncio'>Apagar</a></td></tr>
                                </table>
                            ");
                            $cont = $cont+1;
                        }
                    }
                    //echo("</table>");

                    if ($cont == 0) {
                        echo("Sem anúncios! <br /><br />
                            <a href='novo_anuncio.php'>Publicar um anúncio</a>
                           ");
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