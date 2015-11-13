<?php
//Conecta ao servidor MySQL
$conecta = mysql_connect("localhost","root","") or print 'Sem conexão';

//Seleciona a Base de Dados
mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");

/*Busca as comunidades de todos os outros usuários*/
$selecao = "SELECT c.*, u.apelido FROM usuario u INNER JOIN comunidade c WHERE u.id_usuario = c.id_usuario";

$query = mysql_query($selecao) or die ("Falha na consulta dos dados");
$cont = 0;
while ($comunidade = mysql_fetch_assoc($query)){ 
    //Compara o usuário logado atualmente e o usuário das comunidades
    $id_usuario = (int) $comunidade["id_usuario"];
    $data = date('d/m/Y',strtotime($comunidade["data_criacao"]));
    $horario = date('H:i:s',strtotime($comunidade["hora_criacao"]));
    if (isset($_SESSION["id_usuario"])) {
        $id_usuario_logado = (int) $_SESSION["id_usuario"];
        if ($id_usuario != $id_usuario_logado) {  
            $apelido = $comunidade["apelido"];
            $id_usuario_comunidade = $comunidade["id_usuario"];
            $id_comunidade = (int) $comunidade["id_comunidade"];
            $nome_comunidade= $comunidade["nome"];
            $descricao_comunidade = $comunidade["descricao"];
            echo ('<div id="outros_anuncios">
                <div id="usuario_outros_anuncios">
                    Criado por: '.$apelido.' <br />
                    Data da criação: '.$data.' <br />
                    Hora da criação: '.$horario.' <br /><br/>');            
            echo('</div>
                <div id="conteudo_outros_anuncios">
                    <b><a href="comunidade.php?id_comunidade='.$id_comunidade.'">'.strtoupper($nome_comunidade).'</a></b>
                    <p class="texto">'.$descricao_comunidade.'</p></div>
            </div><br />');
        }
    } else { 
        $apelido = $comunidade["apelido"];
        $id_usuario_comunidade = $comunidade["id_usuario"];
        $id_comunidade = (int) $comunidade["id_comunidade"];
        $nome_comunidade= $comunidade["nome"];
        $descricao_comunidade = $comunidade["descricao"];
        echo ('<div id="outros_anuncios">
            <div id="usuario_outros_anuncios">
                Criado por: '.$apelido.' <br />
                Data da criação: '.$data.' <br />
                Hora da criação: '.$horario.' <br /><br/>');            
        echo('</div>
            <div id="conteudo_outros_anuncios">
                <b><a href="comunidade.php?id_comunidade='.$id_comunidade.'">'.strtoupper($nome_comunidade).'</a></b>
                <p class="texto">'.$descricao_comunidade.'</p></div>
        </div><br />');
    }
}