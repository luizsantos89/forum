<?php
//Conecta ao servidor MySQL
$conecta = mysql_connect("localhost","root","") or print 'Sem conexão';

//Seleciona a Base de Dados
mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");

/*Busca as perguntas de todos os outros usuários*/
$selecao = "SELECT * FROM usuario u INNER JOIN anuncio a WHERE u.id_usuario = a.id_usuario";
$query = mysql_query($selecao) or die ("Falha na consulta dos dados");
while ($anuncio = mysql_fetch_assoc($query)){ 
    //Compara o usuário logado atualmente e o usuário das perguntas
    $id_usuario = (int) $anuncio["id_usuario"];
    $data = date('d/m/Y',strtotime($anuncio["data_criacao"]));
    $horario = date('H:i:s',strtotime($anuncio["hora_criacao"]));
    $telefone = $anuncio["telefone"];
    $email = $anuncio["email"];
    $valor = $anuncio["valor"];
    if (isset($_SESSION["id_usuario"])) {
        $id_usuario_logado = (int) $_SESSION["id_usuario"];
        if ($id_usuario == $id_usuario_logado) {  
            $apelido = $anuncio["apelido"];
            $id_usuario_pergunta = $anuncio["id_usuario"];
            $id_anuncio = (int) $anuncio["id_anuncio"];
            echo ('<div id="outros_anuncios">
                <div id="usuario_outros_anuncios">
                    Criado por: '.$apelido.' <br />
                    Data da criação: '.$data.' <br />
                    Hora da criação: '.$horario.' <br /><br/>
                    <h3>Contatos Cadastrados: </h3>
                    Telefone: '.$telefone.' <br />
                    E-mail: '.$email.' <br />');
            if ($valor != 0)
                    echo('<h2>R$ '.$valor.'</h2>');
            echo('<br /><br />
                <a href="scripts/editar_anuncio.php?id_anuncio='.$id_anuncio.'"><img src="imagens/edit.png" title="Editar" /></a>
                <a href="scripts/deletar_anuncio.php?id_anuncio='.$id_anuncio.'"><img src="imagens/delete.png" title="Deletar" /></a>
                <br/></div>
                <div id="conteudo_outros_anuncios">
                    <b>'.strtoupper($anuncio["titulo"]).'</b>
                    <p class="texto">'.$anuncio["texto"].'</p>
                </div>
            </div>');
        }
    } else {
        $apelido = $anuncio["apelido"];
        $id_usuario_pergunta = $anuncio["id_usuario"];
        $id_anuncio = (int) $anuncio["id_anuncio"];
        echo ('<div id="outras_perguntas">
            <div id="usuario_outras_perguntas">
                Criado por: '.$apelido.' <br />
                Data da criação: '.$data.' <br />
                Hora da criação: '.$horario.' 
                <br />
            </div>
            <div id="conteudo_outras_perguntas">
                <b>'.strtoupper($anuncio["titulo"]).'</b>
                <p class="texto">'.$anuncio["texto"].'</p>
                <form action="scripts/publicar_resposta.php" method="post">
                    <input type="hidden" value='.$id_pergunta.' name="id_pergunta" />
                    <input type="hidden" value='.$apelido.' name="apelido" />
                    <textarea name="resposta" placeholder="Sabe a resposta? Só preencher aqui ;) ..." cols="42" rows="4"></textarea><br />
                    <input type="submit" value="Responder" />
                </form>
            </div>
        </div>');
    }
}