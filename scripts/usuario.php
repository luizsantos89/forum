<?php
    if (isset($_SESSION["usuario"]))
        echo("Bem vindo, <a href='index.php'>".$_SESSION["apelido"].'</a> | <a href="scripts/logout.php">Sair</a>');
    else {        
        echo("<a href='login.php'>Entre </a> ou <a href='login.php'>Cadastre-se</a>");
        
        /*
        echo("<center>
         * <table>
        <form action='login.php' method='post'>
            <tr><td>Usuário:</td><td> <input type='text' name='usuario' size='8' /></td></tr>
            <tr><td>Senha: </td><td><input type='password' name='senha' size='8' /></td></tr>
            <tr><td></td><td align='right'><input type='submit' value='Entrar' /></td></tr>
        </form></table></center>
        ");*/
        }	
?>
