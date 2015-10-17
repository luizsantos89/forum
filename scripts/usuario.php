<?php
    if (isset($_SESSION["usuario"]))
        echo("Bem vindo, ".$_SESSION["apelido"].' | <a href="scripts/logout.php">Sair</a>');
    else {
        echo("<center><table>
        <form action='login.php' method='post'>
            <tr><td>Usuário:</td><td> <input type='text' name='usuario' size='8' /></td></tr>
            <tr><td>Senha: </td><td><input type='password' name='senha' size='8' /></td></tr>
            <tr><td></td><td align='right'><input type='submit' value='Entrar' /></td></tr>
        </form></table></center>
        ");
        }	
?>
