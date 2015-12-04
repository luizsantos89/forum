<?php
    if (!isset($_GET["altera"])) {
        echo("<h3>Visualize seus dados e altere o que quiser ! ;D </h3>");
    }
?>
<center>
<form action="scripts/altera_usuario.php" method="post" name="form1" onsubmit="return validaCadastro()">
    <table>
        <tr>
            <td colspan="4">
                <center><b>Dados Pessoais e de Acesso:</b></center>
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <?php
                    if (isset($_GET["altera"])) {
                        echo("<small>Alteração realizada com sucesso! </small>");
                    }
                    echo("<small>Última Alteração em: $data_alteracao às $hora_alteracao</small>");
                ?>
            </td>
        </tr>
        <tr>
        <?php
            echo('
            <td>Nome:</td>
            <td colspan="4">
                <input type="text" size=60" name="nome" class="input_transp" maxlength="90" value="'.$nome.'"/>
            </td>
        </tr>
        <tr>
            <td>Apelido:</td>
            <td>
                <input type="text" size="10" name="apelido" class="input_transp" value='.$apelido.' maxlength="45" />
            </td>
            
            <td>Login:</td>
            <td>
                <input type="text" size="10" name="login" class="input_transp" value='.$login.' maxlength="15" />
            </td>
        </tr>
        <tr>
            <td colspan="4">
                <center><b>Endereço:</b></center>
            </td>
        </tr>
        <tr>
            <td>Rua:</td>
            <td colspan="3">
                <input type="text" size=60" name="rua" class="input_transp" value="'.$rua.'" maxlength="90" />
            </td>
        </tr>
        <tr>
            <td>Número:</td>
            <td>
                <input type="text" name="numero" size="10" class="input_transp" value="'.$numero.'" maxlength="5" />
            </td>

            <td>Complemento: </td>
            <td>
                <input type="text" name="complemento" size="21" class="input_transp" value="'.$complemento.'" maxlength="50" />
            </td>
        </tr>
        <tr>
            <td>Bairro:</td>
            <td>
                <input type="text" name="bairro" size="10" class="input_transp" value="'.$bairro.'" maxlength="100" />
            </td>

            <td>Cidade/Estado:</td>
            <td>
                <input type="text" name="cidade" size="12" class="input_transp" value="'.$cidade.'" maxlength="50" /> |');
                include("includes/estados.php"); 
                echo(' 
            </td>
        </tr>
        <tr>');
            if (!isset($_GET["altera"])) {
                    echo('<td>
               <input type="submit" value="Alterar perfil" />
                </td>
                </form>
                <form action="scripts/excluir_perfil.php" method="post">
                <td>
                    <input type="submit" value="Excluir perfil" class="excluirperfil" />
                </td>
                <td colspan="2">');
            }
                if(isset($_GET["erro"])) {
                    echo("<div id='msgerro'>Houve um erro, tente novamente!</div>");
                }
            ?>
            <div id="msgerro"></div>
            </td>
        </tr>
    </table>