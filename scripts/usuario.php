<?php
    if (isset($_COOKIE["usuario"]))
        echo("Bem vindo, ".$_COOKIE["usuario"].' | 
                <form action="index.php" method="post">
                     <input type="hidden" name="sair" />
                     <input type="submit" value="Sair" />
                </form>');
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
