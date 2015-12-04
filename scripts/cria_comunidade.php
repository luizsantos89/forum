<?php
    session_start();
    if (!isset($_SESSION["id_usuario"])){
       header("Location:../login.php"); 
    }
    
    if (isset($_POST["nome"])) {
        if (empty($_POST["nome"])){
            echo('<script type="text/javascript">location.replace("../nova_comunidade.php?erro=1")</script>');  
        } else {
            $nome_comunidade = $_POST["nome"];
            $descricao = $_POST["texto"];
            
            $id_usuario = $_SESSION["id_usuario"];
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('Y-m-d');
            $hora = date('H:i:s');
            
                   
            //Conecta ao banco e usa a tabela pergunta
            $conexao = mysql_connect("localhost","root","") or print ("Falha na conexao com o servidor");
            mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");

            //Valor de cada variável:
            echo("<b>Título: </b> $nome_comunidade <br />");
            echo("<b>Texto: </b> $descricao <br />");
            echo("<b>id_usuario: </b> $id_usuario <br />");
            echo("<b>Data: </b> $data <br />");
            echo("<b>Hora: </b> $hora <br />");

            //insere os dados na tabela anúncio
            $query = "INSERT INTO comunidade (id_usuario,nome,descricao,data_criacao,hora_criacao)
                VALUES ($id_usuario,'$nome_comunidade', '$descricao','$data','$hora');"; 
            mysql_query($query) or die ("Falha na inserção dos dados");
            
            
        }
    } 
    echo('<script type="text/javascript">location.replace("../minhas_comunidades.php")</script>');  