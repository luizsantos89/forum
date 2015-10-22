<?php
    session_start();
    if (isset($_POST["titulo"])){
        if(empty($_POST["titulo"])){
            echo('<script type="text/javascript">location.replace("../nova_pergunta.php?erro=1")</script>');  
        } else $titulo = $_POST["titulo"];
        
        if(empty($_POST["texto"])){
            echo('<script type="text/javascript">location.replace("../nova_pergunta.php?erro=2")</script>');  
        } else $texto = $_POST["texto"];
        
        $id_usuario = $_SESSION["id_usuario"];
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');
        $hora = date('H:i:s');
        
        if(!empty($_POST["titulo"]) && !empty($_POST["texto"])) {
            //Conecta ao banco e usa a tabela pergunta
            $conexao = mysql_connect("localhost","root","") or print ("Falha na conexao com o servidor");
            mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");

            //Valor de cada variável:
            echo("<b>Título: </b> $titulo <br />");
            echo("<b>Texto: </b> $texto <br />");
            echo("<b>id_usuario: </b> $id_usuario <br />");
            echo("<b>Data: </b> $data <br />");
            echo("<b>Hora: </b> $hora <br />");

            //insere os dados na tabela pergunta
            $query = "INSERT INTO pergunta(id_usuario, titulo, texto, data_criacao,resposta_pendente,hora_criacao)  
                      VALUES ($id_usuario, '$titulo', '$texto', '$data',0,'$hora');";
            $insere = mysql_query($query) or die ("Erro na gravação dos dados");
            echo('<script type="text/javascript">location.replace("../minhas_perguntas.php")</script>');    
        }
    }

?>