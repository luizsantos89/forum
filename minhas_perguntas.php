<html>
	<head>
		<title> Pedalando :: O seu fórum sobre ciclismo </title>
		<link rel="stylesheet" href="estilo.css" type="text/css" />
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
			<div id="barra_menus">
                    <?php
                        include("scripts/menu.php");
                    ?>
			</div>
			
			<!-- Conteudo da Página -->
			<div id="conteudo">
                            <?php 
                                include("scripts/busca_perguntas_usuario.php");
                                                                                                
                                //Exibe as perguntas na tela
                                //echo("<table>");
                                $cont = 0;
                                while ($pergunta = mysql_fetch_assoc($resultado)){ 
                                    if($pergunta["id_usuario"] == $_COOKIE["id_usuario"]){
                                        //echo date('d/m/Y',strtotime($data));
                                        echo ("<table>
                                            <tr><td><small>Postado em: ".date('d/m/Y',strtotime($pergunta["data_criacao"]))."</small></td></tr>
                                            <tr><td><b>".$pergunta["titulo"]."</b></tr></td>
                                            <tr><td><p>".$pergunta["texto"]."</p></tr></td>                                               
                                            <tr><td><a href='scripts/editar_pergunta.php?id_pergunta=".$pergunta["id_pergunta"]." title='Editar pergunta'><img src='imagens/edit.png' /></a>
                                                    <a href='scripts/deletar_pergunta.php?id_pergunta=".$pergunta["id_pergunta"]." title='Deletar pergunta'><img src='imagens/delete.png' /></a></td></tr>
                                            </table>
                                        ");
                                        $cont = $cont+1;
                                    }
                                }
                                //echo("</table>");
                                
                                if ($cont == 0) {
                                    echo("Sem perguntas! <br /><br />
                                        <a href='nova_pergunta.php'>Vamos começar?</a>
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