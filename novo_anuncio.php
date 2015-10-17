<?php session_start(); ?>
<html>
    <head>
            <title> Pedalando :: O seu fórum sobre ciclismo </title>
            <link rel="stylesheet" href="estilo/estilo.css" type="text/css" />
            <link rel="stylesheet" href="estilo/menus.css" type="text/css" />
            <script type="text/javascript" src="scripts/telefone.js"></script>
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    </head>
    <body>
        <script type="text/javascript" src="scripts/telefone.js"></script>
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
                    echo("<h2>Publique seu anúncio: </h2>
                    <form action='scripts/insere_anuncio.php' method='post'>Título: ");
                        if(isset($_GET["erro"])){
                            if ($_GET["erro"]==1)
                                echo("<div id=erro>Não pode ficar em branco</div>");
                        }
                        echo("<input type='text' size='84' name='titulo' /><br /><br />Digite uma descrição mais detalhada: ");
                        if(isset($_GET["erro"])){
                            if ($_GET["erro"]==2)
                                echo("<div id=erro>Não pode ficar em branco</div>");
                        }
                        echo("<br /><textarea name='texto' cols='70' rows='10'></textarea><br /><br/>
                        Telefone: <input type='text' name='telefone' id='telefone' maxlenght='15' /><br /><br />
                        E-mail: <input type='text' name='email' size='60' /><br /><br />
                        <input type='submit' value='Perguntar' />            
                    </form><br>
                    <small>* Título e Descrição obrigatórios</small>");
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