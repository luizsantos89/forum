<?php
    include("scripts/busca_perguntas_usuario.php");
    $cont = 0;
    while ($pergunta = mysql_fetch_assoc($resultado)){
        echo("<br />");
        if($pergunta["id_usuario"] == $_SESSION["id_usuario"]){
            //echo date('d/m/Y',strtotime($data));
            //$titulo = strtoupper($pergunta["titulo"]);
            //$pergunta = $pergunta["texto"];
            $data = date('d/m/Y',strtotime($pergunta["data_criacao"]));
            $usuario = $pergunta["apelido"];
            $horario = date('H:i:s',strtotime($pergunta["hora_criacao"]));
            //$pergunta["id_pergunta"];
            echo('
                <div id="perguntas">
                    <div id="usuario_pergunta">
                        Criado por: '.$usuario.' <br />
                        Data da criação: '.$data.' <br />
                        Hora da criação: '.$horario.' <br /><br />
                        <a href="scripts/editar_pergunta.php?id_pergunta='.$pergunta["id_pergunta"].'"><img src="imagens/edit.png" title="Editar" /></a>
                        <a href="scripts/deletar_pergunta.php?id_pergunta='.$pergunta["id_pergunta"].'"><img src="imagens/delete.png" title="Deletar" /></a>
                    </div>
                    <div id="conteudo_pergunta">
                    <b><a href="pergunta.php?id_pergunta='.$pergunta["id_pergunta"].'">'.strtoupper($pergunta["titulo"]).'</a></b>
                    <p class="texto">'.$pergunta["texto"].'</p>
                    </div>
                </div>
            ');
            $cont = $cont+1;
        }
        
    }
    
    
    if ($cont == 0) {
        echo("Sem perguntas! <br /><br />
            <a href='nova_pergunta.php'>Vamos começar?</a>
           ");
    }
             
    
?>