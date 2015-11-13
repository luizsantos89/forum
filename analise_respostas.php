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
                <div id="barra_lateral">
                    
                </div>
                <div id="conteudo_pagina">
                <?php 
                    //Conecta ao servidor MySQL
                    $conecta = mysql_connect("localhost","root","") or print 'Sem conexão';


                    //Seleciona a Base de Dados
                    mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");

                    //Retorna toda a tabela usuário
                    $consulta = "SELECT * FROM pergunta";
                    $resultado = mysql_query($consulta) or die ("Erro na consulta aos dados");                                                            
                    //Exibe as perguntas na tela
                    //echo("<table>");
                    $cont = 0;
                    while ($pergunta = mysql_fetch_assoc($resultado)){ 
                        /*Verifica as perguntas do usuário e as que tem repostas pendentes de análise */
                        if (($pergunta["id_usuario"] == $_SESSION["id_usuario"]) && ($pergunta["resposta_pendente"] == 1)) {
                            $id_pergunta = $pergunta["id_pergunta"];
                            $titulo_pergunta = $pergunta["titulo"];
                            $texto_pergunta = $pergunta["texto"];

                            /* Verificando todas as respostas sem análise para aquela pergunta */
                            $consulta_resp = "SELECT * FROM resposta r INNER JOIN usuario u 
                                                   WHERE u.id_usuario = r.id_usuario";
                            $query = mysql_query($consulta_resp);
                            while ($resposta = mysql_fetch_assoc($query)) {
                                if (($resposta["id_pergunta"]== $id_pergunta) && ($resposta["analisada"]==0)) {
                                    $id_resposta = $resposta["id_resposta"];
                                    $apelido_respondente = $resposta["apelido"];
                                    $texto_resposta = $resposta["texto"];
                                    $data_resposta = $resposta["data_criacao"];
                                    $hora_resposta = $resposta["hora_criacao"];
                                    echo("
                                        <div id='analise_resposta'>
                                            <div id='usuario_analise'>
                                                <form action='scripts/insere_analise.php' method='post'>
                                                <input type='hidden' name='id_resposta' value=$id_resposta />
                                                <input type='hidden' name='id_pergunta' value=$id_pergunta />
                                                <b>Respondido em: </b><br />".date('d/m/Y',  strtotime($data_resposta))."
                                                às ".date('H:i:s',strtotime($hora_resposta))." <br /> 
                                                <b>Por: </b>$apelido_respondente<br /><br />
                                                <b>Nota: </b> 
                                                <SELECT name='nota'>
                                                    <option value=1>Boa</option>
                                                    <option value=2>Ruim</option>
                                                </SELECT>
                                                <input type='submit' value='Avaliar' />
                                                </form>
                                            </div>
                                            <div id='resposta_analise'>
                                                <h3> Pergunta: $titulo_pergunta </h3>
                                                <b>Resposta: </b><br />$texto_resposta<br /><br />
                                            </div>
                                        </div>
                                    ");
                                    $cont=$cont+1;
                                }
                            }
                        }
                    }


                    if ($cont == 0) {
                        echo("Sem pendências ! <br /><br />
                            <a href='nova_pergunta.php'>Vamos começar?</a>
                           ");
                    }
                ?>
                </div>
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