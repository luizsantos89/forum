<?php
    session_start();    
    unset($_SESSION["usuario"]);
    unset($_SESSION["id_usuario"]);
    unset($_SESSION["apelido"]);
    session_destroy();
    header("Location:../index.php");
    //echo('<script type="text/javascript">location.replace("../index.php")</script>');
?>
