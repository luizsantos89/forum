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
                    <form action="index.php" method="get">
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
                                
                                echo ("<h1>Confirme as edições: </h1>                                        
                                <form action='editar_pergunta.php' method='post'>
                                        Pergunta: <br /><textarea name='titulo' cols='60' rows='1' placeholder='".$titulo."'></textarea><br /><br />
                                        Detalhes: <br /><textarea name='texto' cols='60' rows='10' placeholder='".$texto."'></textarea></td><br /><br />
                                        Confirma a edição? 
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
                                    $altera = "UPDATE pergunta 
                                                    SET titulo = '".$titulo."', texto = '".$texto."' 
                                                    WHERE id_pergunta = ".$id_pergunta."";
                                    $alterar = mysql_query($altera) or die ("Falha na atualização dos dados");
                                    echo("Alterado com sucesso! <br><br><a href='../minhas_perguntas.php'>Voltar para minhas perguntas</a>");
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
                <b>Produzido por: <a href="mailto:luiz.santos89@yahoo.com.br">Luiz Santos</a>, 
                <a href="gil_ferreirafilho@yahoo.com.br">Gilmar Ferreira</a> e <a href="mailto:glaudem@hotmail.com">Glaudeilson Mendes</a></b> <br >
            </div>
        </div>
        </center>
    </body>
</html>