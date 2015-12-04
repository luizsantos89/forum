<?php
//Pega a URL atual
$servidor = $_SERVER['SERVER_NAME'];
$local = $_SERVER ['REQUEST_URI'];
$url = "http://".$servidor.$local;

//Conecta ao servidor MySQL
$conecta = mysql_connect("localhost","root","") or print 'Sem conexão';

//Seleciona a Base de Dados
mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");

/*Busca as perguntas de todos os outros usuários*/
$selecao = "SELECT * FROM usuario u INNER JOIN pergunta p WHERE u.id_usuario = p.id_usuario";
$query = mysql_query($selecao) or die ("Falha na consulta dos dados");
while ($pergunta = mysql_fetch_assoc($query)){ 
    //Compara o usuário logado atualmente e o usuário das perguntas
    $id_usuario = (int) $pergunta["id_usuario"];
    $data = date('d/m/Y',strtotime($pergunta["data_criacao"]));
    $horario = date('H:i:s',strtotime($pergunta["hora_criacao"]));
    if (isset($_SESSION["id_usuario"])) {
        $id_usuario_logado = (int) $_SESSION["id_usuario"];
        if ($id_usuario != $id_usuario_logado) {  
            $apelido = $pergunta["apelido"];
            $id_usuario_pergunta = $pergunta["id_usuario"];
            $id_pergunta = (int) $pergunta["id_pergunta"];
            echo ('<div id="outras_perguntas">
                <div id="usuario_outras_perguntas">
                    Criado por: '.$apelido.' <br />
                    Data da criação: '.$data.' <br />
                    Hora da criação: '.$horario.' <br />
                </div>
                <div id="conteudo_outras_perguntas">
                    <b><a href="pergunta.php?id_pergunta='.$pergunta["id_pergunta"].'">'.strtoupper($pergunta["titulo"]).'</a></b>
                    <p class="texto">'.$pergunta["texto"].'</p>
                    <form action="scripts/publicar_resposta.php" method="post">
                        <input type="hidden" value='.$id_pergunta.' name="id_pergunta" />
                        <input type="hidden" value='.$apelido.' name="apelido" />
                        <textarea name="resposta" placeholder="Sabe a resposta? Só preencher aqui ;) ..." cols="42" rows="4"></textarea><br />
                        <input type="submit" value="Responder" />
                    </form>
                </div>
            </div>');
        }
    } else {
        $apelido = $pergunta["apelido"];
        $id_usuario_pergunta = (int) $pergunta["id_usuario"];
        $id_pergunta = (int) $pergunta["id_pergunta"];
        echo ('<div id="outras_perguntas">
            <div id="usuario_outras_perguntas">
                Criado por: '.$apelido.' <br />
                Data da criação: '.$data.' <br />
                Hora da criação: '.$horario.' <br />
            </div>
            <div id="conteudo_outras_perguntas">
                <b>'.strtoupper($pergunta["titulo"]).'</b>
                <p class="texto">'.$pergunta["texto"].'</p>
                <form action="scripts/publicar_resposta.php" method="post">
                    <input type="hidden" value='.$id_pergunta.' name="id_pergunta" />
                    <input type="hidden" value='.$apelido.' name="apelido" />
                    <input type="hidden" value='.$url.' name="url" />
                    <textarea name="resposta" placeholder="Sabe a resposta? Só preencher aqui ;) ..." cols="42" rows="4"></textarea><br />
                    <input type="submit" value="Responder" />
                </form>
            </div>
        </div>');
    }
}