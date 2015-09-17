<?php
    include("conecta_usuario.php");
    while ($usuarios = mysql_fetch_array($resultado)) {
        if(isset($_COOKIE["id_usuario"]) && $_COOKIE["id_usuario"] == $usuarios["id_usuario"]) {
                $nome = $usuarios["nome"];
                $apelido = $usuarios["apelido"];
                $localidade = $usuarios["cidade"]."/".$usuarios["estado"];
            }
    }
    
    echo ("
       <h4> $nome </h4>
           <b> $apelido </b><br />
               <b> $localidade </b><br />

    ");
?>
