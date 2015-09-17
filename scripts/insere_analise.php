<?php
    if (isset($_POST["sair"])) {
        unset ($_COOKIE["usuario"]);
        unset ($_COOKIE["id_usuario"]);
    }
?>
<html>
    <head>
        <title> Pedalando :: O seu fórum sobre ciclismo </title>
        <link rel="stylesheet" href="../estilo.css" type="text/css" />
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
                    <form action="../index.php" method="get">
                        <input type="text" size="30" name="busca" />
                        <input type="submit" value="Buscar" />
                    </form>
                </div>

                <!-- Implementação da área do usuário graficamente-->
                <div id="area_usuario">
                    <?php
                        if (isset($_COOKIE["usuario"]))
                            echo("Bem vindo, ".$_COOKIE["usuario"].' | 
                                    <form action="index.php" method="post">
                                         <input type="hidden" name="sair" />
                                         <input type="submit" value="Sair" />
                                    </form>');
                        else {
                            echo("
                            <form action='../login.php' method='post'>
                                User: <input type='text' name='usuario' size='8' /><br />
                                Senha: <input type='password' name='senha' size='8' /><br />
                                <input type='submit' value='Entrar' />
                            </form>
                            ");
                            }	
                    ?>
                </div>
            </div>
            <div id="barra_menus">
                <?php
                    echo('
                    <ul>
                        <li><a href="../index.php">Principal</a>
                        <li><a href="../minhas_perguntas.php">Minhas Perguntas</a>
                        <li><a href="../nova_pergunta.php">Perguntar</a>
                        <li><a href="../analise_respostas.php">Analisar Respostas</a>
                        <li><a href="../perguntas.php">Perguntas de Outros Usuários</a>
                    </ul>
                    ');
                ?>
            </div>

            <!-- Conteudo da Página -->
            <div id="conteudo">
                <?php 
                    if(isset($_POST["nota"])) {
                        //Definir as variáveis do método POST
                        $nota = (int) $_POST["nota"];
                        $id_resposta = (int) $_POST["id_resposta"];
                        $id_pergunta = (int) $_POST["id_pergunta"];

                        //Conecta ao servidor MySQL
                        $conecta = mysql_connect("localhost","root","") or print 'Sem conexão';

                        //Seleciona a Base de Dados
                        mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");

                        //Altera na tabela resposta o item analisada para a nota dada
                        $atualiza_resposta = "UPDATE resposta SET analisada = $nota
                                                    WHERE id_resposta = $id_resposta";
                        mysql_query($atualiza_resposta);

                        /*Verificar se a pergunta daquela resposta tem mais respostas sem análise*/
                        $consulta_pergunta = "SELECT * FROM pergunta WHERE id_pergunta = $id_pergunta";
                        $query2 = mysql_query($consulta_pergunta);
                        $cont = 0;
                        while ($verifica_pergunta = mysql_fetch_assoc($query2)) {
                            $query3 = "SELECT * FROM resposta WHERE id_pergunta = $id_pergunta";
                            $consul_resp = mysql_query($query3);
                            while($resposta = mysql_fetch_assoc($consul_resp)){
                                if ($resposta["analisada"]!=0) $cont = $cont + 1;
                            }
                        }
                        
                        
                        if ($cont==0) {
                            $query4 = "UPDATE pergunta SET resposta_pendente = 0 where id_pergunta=$id_pergunta";
                            mysql_query($query4);
                        }

                        echo('<script type="text/javascript">location.replace("../analise_respostas.php")</script>');
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