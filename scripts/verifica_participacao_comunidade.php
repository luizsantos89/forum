<?php
//Verifica se o usuário já participa
    $select = "select * from participa";
    $resultado = mysql_query($select);
    if(isset($_GET["url"])) {
        $url = $_GET["url"]; 
    } else {
        $url = null;
    }
    
    while ($result = mysql_fetch_assoc($resultado)) {
        if ($id_usuario == $result["id_usuario"] && $id_comunidade == $result["id_comunidade"]){
            $participacao = "sim";
        } else {
            $participacao = "nao";
        }
    }
    //echo("Usuario criador: $id_usuario_criador <br /> Usuário logado: $id_usuario <br />");
    if ($id_usuario_criador == $id_usuario){
        echo("<small>Você é o dono!</small>");
    } else {
        if ($participacao == "sim") {
            echo ("<form action='scripts/participar_comunidade.php' method='post'>
                        <input type='hidden' value=$id_comunidade name='id_comunidade' />
                        <input type='hidden' value='nao' name='participar' />
                        <input type='hidden' value=$url name='url /> 
                        <input type='submit' value='Sair' />
                </form>");
        } else { 
            echo ("<form action='scripts/participar_comunidade.php' method='post'>
                        <input type='hidden' value=$id_comunidade name='id_comunidade' />
                        <input type='hidden' value='sim' name='participar' />
                        <input type='hidden' value=$url name='url /> 
                        <input type='submit' value='Participar' />
                </form>");        
        }
    }