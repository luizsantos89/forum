<?php
    //session_start();
    //Conexão com o Banco de Dados
    include("scripts/conecta_usuario.php");
    date_default_timezone_set('America/Sao_Paulo');    

    if (isset($_SESSION["usuario"])) {
        //Busca os dados da estrutura usuário
        $id_usuario = (int) $_SESSION["id_usuario"];
        while ($usuarios = mysql_fetch_assoc($resultado)){
            if ($usuarios["id_usuario"] == $id_usuario){
                $usuario = $_SESSION["apelido"];
                $hora = $usuarios["hora_cadastro"];
                $data = $usuarios["data_cadastro"];
                echo("Bem vindo, <a href='perfil.php'>".$usuario.'</a> 
                | <a href="scripts/logout.php">Sair</a><br />');
       
                echo("<small>Usuário desde: ".date('d/m/Y',strtotime($data))." - " 
                .date('H:i:s',strtotime($hora))."</small>");
                
            }
        }
        //Mostra mensagem de boas-vindas ao usuário
        
    } else {        
        //echo("<a href='login.php'>Entre </a> ou <a href='login.php'>Cadastre-se</a>");
        
        echo("<center>
        <table>
        <form action='login.php' method='post'>
            <tr><td>Usuário:</td><td> <input type='text' name='usuario' size='16' /></td></tr>
            <tr><td>Senha: </td><td><input type='password' name='senha' size='16' /></td></tr>
            <tr><td align='center'><input type='submit' value='Entrar' /></td>
        </form>
        <form action='cadastro.php' method='post'>
            <td align='center'><input type='submit' value='Cadastrar' /></td></tr>
        </form>
        </table></center>
        ");
        }


































/*
    if (isset($_SESSION["usuario"]))
        echo("Bem vindo, <a href='index.php'>".$_SESSION["apelido"].'</a> | <a href="scripts/logout.php">Sair</a>');
    else {        
        //echo("<a href='login.php'>Entre </a> ou <a href='login.php'>Cadastre-se</a>");
        
        echo("<center>
        <table>
        <form action='login.php' method='post'>
            <tr><td>Usuário:</td><td> <input type='text' name='usuario' size='16' /></td></tr>
            <tr><td>Senha: </td><td><input type='password' name='senha' size='16' /></td></tr>
            <tr><td align='center'><input type='submit' value='Entrar' /></td>
        </form>
        <form action='index.php' method='get'>
            <td align='center'><input type='submit' value='Cadastrar' /></td></tr>
        </form>
        </table></center>
        ");
        }	
?>
*/