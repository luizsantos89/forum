<html>
	<head>
		<title> Pedalando :: O seu fórum sobre ciclismo </title>
		<link rel="stylesheet" href="estilo.css" type="text/css" />
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
                <meta name="author" content="netbeans"/> 
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
                                if(isset($_POST["usuario"])) {
                                    //Lendo as entradas do usuário
                                    //Lê as informações do formulário
                                    $user = $_POST["usuario"];
                                    $senha = $_POST["senha"];
    
                                    include("/scripts/conecta_usuario.php");                                
                                    
                                    //Comparando as entradas do usuário com os dados do BD
                                    while ($usuarios = mysql_fetch_assoc($resultado))
                                    {
                                        if ($usuarios["login"] == $user){
                                            if ($usuarios["senha"] == $senha){
                                                setcookie("usuario", $usuarios["apelido"], time()+36000);
                                                setcookie("id_usuario", $usuarios["id_usuario"], time() + 36000);
                                                echo('<script type="text/javascript">location.replace("index.php")</script>');
                                                }                                         
                                        } 
                                    }
                                }
                                else {
                                    echo("
                                        <form action='login.php' method='post'>
                                            Usuário: <input type='text' name='usuario' /><br />
                                            Senha: <input type='password' name='senha' /><br />
                                            <input type='submit' value='Entrar' />
                                        </form>
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