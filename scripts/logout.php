<?php
    session_start();    
    date_default_timezone_set('America/Sao_Paulo');
    $data = date('Y-m-d');
    $hora = date('H:i:s');
    //conecta ao BD
    mysql_connect("localhost","root","") or die ("Falha na conexão com o servidor");
    mysql_select_db("forum") or die ("Falha ao selecionar a Base de Dados");
    
    //atualiza a tabela usuario com data/hora do último acesso
    $query = "UPDATE usuario SET data_ultimo_acesso = '$data', hora_ultimo_acesso = '$hora' 
             WHERE id_usuario = ".$_SESSION["id_usuario"].";" ;
    mysql_query($query) or die ("Falha ao atualizar último acesso do usuário");
    
    //Destruindo a sessão
    unset($_SESSION["usuario"]);
    unset($_SESSION["id_usuario"]);
    unset($_SESSION["apelido"]);
    session_destroy();
    
    //Redirecionando para a página principal
    header("Location:../index.php");
    //echo('<script type="text/javascript">location.replace("../index.php")</script>');
?>
