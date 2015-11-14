<?php
//Verifica se o usuário já participa
    $select = "select * from participa";
    $resultado = mysql_query($select);
    
    while ($result = mysql_fetch_assoc($resultado)) {
        if ($id_usuario == $result["id_usuario"] && $id_comunidade == $result["id_comunidade"]){
            $participacao = "sim";
        } 
    }
    if ($id_usuario_criador == $id_usuario){
        
    } else {
        if (isset($participacao)) {
            echo ("<form action='scripts/participar_comunidade.php' method='post'>
                        <input type='hidden' value=$id_comunidade name='id_comunidade' />
                        <input type='hidden' value='nao' name='participar' />
                        <input type='submit' value='Sair' />
                </form>");
        } else { 
            echo ("<form action='scripts/participar_comunidade.php' method='post'>
                        <input type='hidden' value=$id_comunidade name='id_comunidade' />
                        <input type='hidden' value='sim' name='participar' />
                        <input type='submit' value='Participar' />
                </form>");        
        }
    }