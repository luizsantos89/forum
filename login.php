<?php session_start(); ?>
<html>
	<head>
            <title> Pedalando :: O seu fórum sobre ciclismo </title>
            <link rel="stylesheet" href="estilo/estilo.css" type="text/css" />
            <link rel="stylesheet" href="estilo/menus.css" type="text/css" />
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
            <div id="menus">
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
                                    if(empty($_POST["usuario"]) && empty($_POST["senha"])){                                        
                                        echo("
                                        <div id='login'>
                                            <div id=erro>Campos não podem ficar em branco</div>                                                        
                                            <form action='login.php' method='post'>
                                                Login: <input type='text' name='usuario' /><br/><br/>
                                                Senha: <input type='password' name='senha' /><br /><br />
                                                <input type='submit' value='Entrar' />
                                            </form>
                                        </div>
                                        ");  
                                    } else {
                                        $user = $_POST["usuario"];
                                        $senha = $_POST["senha"];

                                        include("/scripts/conecta_usuario.php");                                

                                        //Comparando as entradas do usuário com os dados do BD
                                        while ($usuarios = mysql_fetch_assoc($resultado))
                                        {
                                            if ($usuarios["login"] == $user){
                                                if ($usuarios["senha"] == $senha){
                                                    $_SESSION["usuario"] = $user;
                                                    $_SESSION["id_usuario"] = $usuarios["id_usuario"];
                                                    $_SESSION["apelido"] = $usuarios["apelido"];
                                                    echo('<script type="text/javascript">location.replace("index.php")</script>');
                                                    } else {
                                                        echo("
                                                        <div id='login'>
                                                            <div id=erro>Usuário/Senha incorreto</div>                                                        
                                                            <form action='login.php' method='post'>
                                                                Login: <input type='text' name='usuario' /><br/><br/>
                                                                Senha: <input type='password' name='senha' /><br /><br />
                                                                <input type='submit' value='Entrar' />
                                                            </form>
                                                        </div>
                                                    ");  
                                                }                                 
                                            } 
                                        }
                                    }
                                }
                                else {
                                    echo("
                                        <div id='login'>
                                            <form action='login.php' method='post'>
                                                Login: <input type='text' name='usuario' /><br/><br/>
                                                Senha: <input type='password' name='senha' /><br /><br />
                                                <input type='submit' value='Entrar' />
                                            </form>
                                        </div>
                                    ");
                                }
                            ?>
			</div>
			
			<!-- Rodapé da Página -->
			<div id="rodape">
				<b>Produzido por: <a href="mailto:luiz.santos89@yahoo.com.br">Luiz Santos</a>, 
				<a href="mailto:gil_ferreirafilho@yahoo.com.br">Gilmar Ferreira</a> e <a href="mailto:glaudem@hotmail.com">Glaudeilson Mendes</a></b> <br >
			</div>
		</div>
		</center>
	</body>
</html>