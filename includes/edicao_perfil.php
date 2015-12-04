<?php
    if(!isset($_SESSION["id_usuario"])){
        //Pega URL atual
        $servidor = $_SERVER['SERVER_NAME'];
        $local = $_SERVER ['REQUEST_URI'];
        $url = "http://".$servidor.$local;
    } 
    if (!isset($_GET["id_usuario"])) {
        $id_usuario = $_SESSION["id_usuario"];
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');
        $hora = date('H:i:s');
        if(isset($_POST["senha_atual"])) {
            //Conecta ao servidor MySQL
            $conecta = mysql_connect("localhost","root","") or print 'Sem conexão';
            mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");

            //Pega a senha do usuário
            $query = "SELECT senha FROM usuario WHERE id_usuario = $id_usuario";
            $resultado = mysql_query($query) or die ("Falha na consulta");

            while ($senha = mysql_fetch_assoc($resultado)) {
                $senha = $senha["senha"];
                $senha_atual = $_POST["senha_atual"];
                $senha_nova = $_POST["senha_nova"];

                if($senha_atual == $senha) {
                    if ($senha_atual != $senha_nova) {
                        $query2 = "UPDATE usuario
                                    SET senha='$senha_nova', data_alteracao='$data', hora_alteracao='$hora'
                                    WHERE id_usuario = $id_usuario";
                        mysql_query($query2) or die("Falha na atualização");
                        echo("<small>Senha alterada com sucesso!</small>");
                    } else {
                        echo("<small>Senhas atual e nova são idênticas! Sem alterações!");
                    }
                } else {
                    echo("<small>Senha atual incorreta! Sem alterações!</small>");
                }
            }
        } else {
            echo("<br /><br /><br /><br /><br /><br /><br /><br />");
            echo("Para alterar a senha, utilize o formulário abaixo: <br /><br />");
            echo(" <form action='perfil.php' method='post'>
                Senha atual: <input type='password' name='senha_atual' /><br />
                Senha nova: <input type='password' name='senha_nova' /><br /><br />
                <input type='submit' value='Alterar' />
            </form/>");
        }
    }
    
    
    
    
    
    
    
    
    
    
    