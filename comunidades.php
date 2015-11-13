<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pedalando :: O seu fórum sobre ciclismo</title>
        <link rel="stylesheet" type="text/css" href="estilo/estilo.css" />
        <link rel="stylesheet" type="text/css" href="estilo/menus.css" />
    </head>
    <body>
        <center>
        <div id="pagina">
            <div id="banner">
                <!-- ImplementaÃ§Ã£o do Logotipo -->
                <div id="logotipo">
                        <a href="index.php"><img src="imagens/logo.png"  /></a>
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
                        include("scripts/usuario.php");
                    ?>
                </div>
            </div>
            <div id="menus">
                <?php
                    include("scripts/menu.php");
                ?>
            </div>

            <!-- Conteudo da PÃ¡gina -->
            <div id="conteudo">
                <div id="barra_lateral">
                    
                </div>
                <div id="conteudo_pagina">
                    <?php
                        include("includes/comunidades.php");
                    ?>
                </div>
            </div>

            <!-- RodapÃ© da PÃ¡gina -->
            <div id="rodape">
                <?php
                    include("includes/rodape.php");
                ?>
            </div>
        </div>
        </center>
    </body>
</html>