<?php
    if(isset($_GET["id_pergunta"])){
        $id_pergunta = $_GET["id_pergunta"];
        //$id_usuario = $_SESSION["id_usuario"];

        //conexão e seleção da base de dados
        mysql_connect("localhost","root","") or die ("falha na conexao com o bd"); 
        mysql_select_db("forum") or die ("falha na seleção do BD");

        //busca as informações da comunidade
        $query = "SELECT p.*, u.apelido FROM pergunta p 
                                  INNER JOIN usuario u 
                    WHERE p.id_usuario = u.id_usuario 
                      AND p.id_pergunta=".$id_pergunta;
        
        $resultado = mysql_query($query) or die ("Falha na consulta");
        while($pergunta = mysql_fetch_assoc($resultado)) {
            $nome_pergunta = $pergunta["titulo"];
            $data_criacao = $pergunta["data_criacao"];
            $hora_criacao = $pergunta["hora_criacao"];
            $texto = $pergunta["texto"];
            $usuario_criador = $pergunta["apelido"];
            $id_usuario_criador = $pergunta["id_usuario"];
            $apelido = $pergunta["apelido"];
        }
        
       

        echo('<div id="comunidade_selecionada">
                <h1>'.$nome_pergunta.'</h1>');
            
            //Verifica as respostas analisadas
            $query3 = "SELECT * FROM resposta r INNER JOIN usuario u 
                        WHERE r.id_usuario = u.id_usuario AND r.analisada = 1 
                        AND r.id_pergunta = ".$id_pergunta." ORDER BY r.data_criacao,
                        r.hora_criacao DESC";
            
            $resultado_query3 = mysql_query($query3);
            
            echo("<div id='conteudo_comunidade'>
                <div id='descricao_comunidade'>
                    <b>Descrição:</b><br />
                    $texto
                </div>
                <div id='mensagens_comunidade'>");
                    if ($id_usuario_criador != $_SESSION["id_usuario"]) {
                        echo(" <b> Responder: </b>
                            <form action='scripts/publicar_resposta.php' method='post'>
                                <input type='hidden' value='".$id_pergunta."' name='id_pergunta' />
                                <input type='hidden' value='".$apelido."'  name='apelido' />
                                <textarea name='resposta' placeholder='Sabe a resposta? Só preencher aqui ;) ...' cols='42' rows='4'></textarea><br />
                                <input type='submit' value='Responder' />
                            </form><br /><b> Respostas: </b>");
                    } else {
                        echo(" <b> Respostas: </b>");
                    }
                    while($respostas = mysql_fetch_assoc($resultado_query3)) {
                        $nota = $respostas["analisada"];
                        switch ($nota) {
                            case 1 : $analise = "Boa";
                            case 2 : $analise = "Ruim";
                        }
                        echo("<div id='mensagem'>
                                ".$respostas["texto"]."<br/><br />
                                <small> Analisada como $analise pelo usuário <a href='perfil.php?id_usuario=$id_usuario_criador'>$apelido </a></small><br />
                                <small>Postado em: ".date("d/m/Y",  strtotime($respostas["data_criacao"]))." às ".$respostas["hora_criacao"]." 
                                 por: <a href='perfil.php?id_usuario=".$respostas["id_usuario"]."'>".$respostas["apelido"])."</a></small></div>";
                    }
                echo("</div>");//Fechando o div mensagem_comunidade
        echo('</div></div>');//Fechando o div comunidade_selecionada
    }