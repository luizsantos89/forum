<?php
    include("conecta_usuario.php");
    
    echo "Consulta executada com sucesso <br /><br />";        
	
	while ($usuarios = mysql_fetch_assoc($resultado))
	{
		$NomeUsuario = $usuarios["nome"];
		$Apelido = $usuarios["apelido"];
		$senha = $usuarios["senha"];
		$DataCadastro = $usuarios["data_cadastro"];
		$HoraCadastro = $usuarios["hora_cadastro"];
		$Login = $usuarios["id_usuario"]; 
		echo "<b> Nome: </b> $NomeUsuario <br />";
		echo "<b> Usuário desde: </b> $DataCadastro às $HoraCadastro<br />";
		echo "<b> Usuário: </b> $Login <br />";
		echo "<b> Senha: </b> $senha <br /><br /><br />";		 
	}
    $usuario = $_COOKIE["usuario"];
    setcookie("usuario",$usuario,time()+3600);
    echo $_COOKIE["usuario"];
    unset($_COOKIE["usuario"]);
    echo $_COOKIE["usuario"];
    
    
                //  setcookie("conta",$numconta,time()+60*60*24*5);
    
    //setcookie("conta",$conta,time()-60*60*24*5);
?>
