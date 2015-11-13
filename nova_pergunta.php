<?php session_start(); ?>
<html>
    <head>
            <title> Pedalando :: O seu fórum sobre ciclismo </title>
            <link rel="stylesheet" href="estilo/estilo.css" type="text/css" />
            <link rel="stylesheet" href="estilo/menus.css" type="text/css" />
            <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
            <script type="text/javascript" language="javascript">
                function limita(campo){
                   var tamanho = document.form1[campo].value.length;
                   var tex=document.form1[campo].value;
                   if (tamanho>=5) {
                      document.form1[campo].value=tex.substring(0,499);
                   }
                   return true;
                }
             </script> 
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
                <h2>Publique sua dúvida: </h2>
                <form name='form1' action='scripts/insere_pergunta.php' method='post'>
                    Título:
                    <?php
                    if(isset($_GET["erro"])){
                        if ($_GET["erro"]==1)
                            echo("<div id=erro>Não pode ficar em branco</div>");
                    }?>
                    <input type='text' size='84' name='titulo' />
                    <br /><br />Digite uma descrição mais detalhada:
                    <br />
                    <textarea name='texto' cols='70' rows='10' id='texto' onKeyPress="javascript:limita('texto');">
                    </textarea><br /><br/>
                    <input type='submit' value='Perguntar' />            
                </form><br>
            </div>

            <!-- Rodapé da Página -->
            <div id="rodape">
                    <b>Produzido por: <a href="mailto:luiz.santos89@yahoo.com.br">Luiz Santos</a> e  
                    <a href="gil_ferreirafilho@yahoo.com.br">Gilmar Ferreira</a><br />
            </div>
        </div>
        </center>
    </body>
</html>