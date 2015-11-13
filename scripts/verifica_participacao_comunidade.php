<?php
//Verifica se o usuário já participa
    $query_participa = "SELECT * FROM participa WHERE id_usuario = $id_usuario AND id_comunidade = $id_comunidade";
    $consulta_participa = mysql_query($query_participa) or die ("Falha na consulta da participação");

    if (empty($consulta_participa)) {
        echo ("<form action='scripts/participar_comunidade.php' method='post'>
                    <input type='hidden' value=$id_comunidade name='id_comunidade' />
                    <input type='hidden' value='sim' name='participar' />
                    <input type='submit' value='Participar' />
            </form>");
    } else {
        echo ("<form action='scripts/participar_comunidade.php' method='post'>
                    <input type='hidden' value=$id_comunidade name='id_comunidade' />
                    <input type='hidden' value='nao' name='participar' />
                    <input type='submit' value='Sair' />
            </form>");
    }