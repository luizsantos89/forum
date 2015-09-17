<?php
    unset($_COOKIE["usuario"]);
    if(isset($_COOKIE["usuario"]))
        echo "Ainda tem cookie";
    else echo "Não tem mais";
    echo('<a href="../index.php">Voltar</a>');
    //echo('<script type="text/javascript">location.replace("../index.php")</script>');
?>
