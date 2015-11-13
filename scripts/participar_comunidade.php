<?php 
    session_start(); 
    if (isset($_SESSION["usuario"])) {        
    } else {
        echo('<script type="text/javascript">location.replace("../login.php")</script>');
    }
    
    if(isset($_POST["participar"])) {
        $id_comunidade = $_POST["id_comunidade"];
        $id_usuario = $_SESSION["id_usuario"];
        $participar = (string) $_POST["participar"];
        echo("Partipar? $participar <br />");
        if($participar == "sim") {
            echo("Entrando na comunidade<br>");
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('Y-m-d');
            $hora = date('H:i:s');

            //imprime as informações na tela
            echo("id_comunidade = $id_comunidade <br />");
            echo("id_usuario = $id_usuario <br />");
            echo("data = $data <br />");
            echo("hora = $hora <br />");

            //conexão e seleção da base de dados
            mysql_connect("localhost","root","") or die ("falha na conexao com o bd"); 
            mysql_select_db("forum") or die ("falha na seleção do BD");

            //query de inserção na base de dados
            $query = "INSERT INTO participa(id_usuario,id_comunidade,data_ingresso,hora_ingresso)
                    VALUES($id_usuario,$id_comunidade,'$data','$hora')";
            mysql_query($query) or die ("Falha na inserção dos dados");
            
            echo ($query);
            //Redireciona para a página da comunidade
            echo('<script type="text/javascript">location.replace("../comunidades.php")</script>');
        }
        if($participar == "nao") {
            echo("Saindo na comunidade<br>");
            //conexão e seleção da base de dados
            mysql_connect("localhost","root","") or die ("falha na conexao com o bd"); 
            mysql_select_db("forum") or die ("falha na seleção do BD");

            //query de inserção na base de dados
            $query2 = "DELETE FROM participa
                    WHERE id_usuario=$id_usuario AND id_comunidade=$id_comunidade;";
            mysql_query($query2) or die ("Falha na inserção dos dados");
            
            
            echo ($query2);
            //Redireciona para a página da comunidade
            echo('<script type="text/javascript">location.replace("../comunidades.php")</script>');
        }
    } else { echo 'Houve uma falha'; }
?>