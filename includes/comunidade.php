<?php
    if(isset($_GET["id_comunidade"])){
        if (!isset($_SESSION["usuario"])) {
            //Pega a URL atual
            $servidor = $_SERVER['SERVER_NAME'];
            $local = $_SERVER ['REQUEST_URI'];
            $url = "http://".$servidor.$local;
        }
        $id_comunidade = $_GET["id_comunidade"];
        //$id_usuario = $_SESSION["id_usuario"];

        //conexão e seleção da base de dados
        mysql_connect("localhost","root","") or die ("falha na conexao com o bd"); 
        mysql_select_db("forum") or die ("falha na seleção do BD");

        //busca as informações da comunidade
        $query = "SELECT c.*, u.apelido FROM comunidade c 
                                  INNER JOIN usuario u 
                    WHERE c.id_usuario = u.id_usuario 
                      AND c.id_comunidade=".$id_comunidade;
        $resultado = mysql_query($query) or die ("Falha na consulta");
        while($comunidade = mysql_fetch_assoc($resultado)) {
            $nome_comunidade = $comunidade["nome"];
            $data_criacao = $comunidade["data_criacao"];
            $hora_criacao = $comunidade["hora_criacao"];
            $texto = $comunidade["descricao"];
            $usuario_criador = $comunidade["apelido"];
            $id_usuario_criador = $comunidade["id_usuario"];
        }
        
        //busca os usuários daquela comunidade
        $query2 = "SELECT * FROM participa p INNER JOIN usuario u
                   WHERE p.id_usuario = u.id_usuario AND p.id_comunidade = $id_comunidade";
        $resultado2 = mysql_query($query2) or die ("Falha na consulta");

        echo('<div id="comunidade_selecionada">
                <h1>'.$nome_comunidade.'</h1>
                <div id="usuarios_comunidade">');
            $cont = 0;
            while ($usuarios_comunidade = mysql_fetch_assoc($resultado2)){
                $array[$cont]= (string) $usuarios_comunidade["apelido"];
                $link[$cont] = (string) $usuarios_comunidade["id_usuario"];
                $cont++;
            }   
            
            
            echo("<b>Membros (".$cont."):</b><br />");
            for ($i=0;$i<$cont;$i++) {
                if ($cont == 0) {
                    echo("Sem membros <br /><br />");
                }
                if ($link[$i] == $_SESSION["id_usuario"]) {
                    echo("<a href='perfil.php'>".$array[$i]."</a><br />");
                } else {
                    echo("<a href='perfil.php?id_usuario=".$link[$i]."'>".$array[$i]."</a><br />");
                }
            }
                        
            if (isset($_SESSION["id_usuario"])) {
                $id_usuario = $_SESSION["id_usuario"];
            } else {
                $id_usuario = null;
            }
            
            echo("<br />");
            
            include("scripts/verifica_participacao_comunidade.php");
             
            echo("</div>");//Fechando o div usuarios_comunidade
            echo("<div id='conteudo_comunidade'>
                    <div id='descricao_comunidade'>
                        <b>Descrição:</b><br />
                        $texto
                    </div>");
            
            //Verifica as mensagens relativas a esta comunidade
            if ($participacao == "sim") {
                $query3 = "SELECT * FROM mensagem m INNER JOIN usuario u 
                            WHERE m.id_usuario = u.id_usuario AND m.id_comunidade = ".$id_comunidade." ORDER BY m.data_postagem DESC";
                //echo($query3);
                $resultado_query3 = mysql_query($query3);

                echo("<div id='mensagens_comunidade'>    
                        <b>Mensagens:</b>");
                    if (isset($_SESSION["id_usuario"])) {
                        echo("<form action='scripts/publicar_resposta_msg.php' method='post'>
                            <input type='hidden' value=".$id_comunidade." name='id_comunidade' />
                            <textarea name='resposta' placeholder='O que você está pensando ?' cols='50' rows='3'></textarea><br />
                            <input type='submit' value='Postar' />
                        </form>");
                    }
                        if (isset($_SESSION["id_usuario"])) {
                            while($mensagens = mysql_fetch_assoc($resultado_query3)) {
                                echo("<div id='mensagem'>
                                        <b>".$mensagens["mensagem"]."</b><br/>
                                        <small>Postado em: ".date('d/m/Y',  strtotime($mensagens["data_postagem"]))." às ".$mensagens["hora_postagem"]." 
                                         por: <a href='perfil.php?id_usuario=".$mensagens["id_usuario"]."'>".$mensagens["apelido"])."</a></small></div>";
                            }
                        }
                    echo("</div>");//Fechando o div mensagem_comunidade
            }
        echo('</div></div>');//Fechando o div comunidade_selecionada
    }