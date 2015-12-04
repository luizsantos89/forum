<?php 
    session_start(); 
    
    
    if(isset($_POST["participar"])) {
        $id_comunidade = $_POST["id_comunidade"];
        $id_usuario = $_SESSION["id_usuario"];
        $participar = (string) $_POST["participar"];
        $url = "comunidade.php?id_comunidade=$id_comunidade";
        if (isset($_SESSION["id_usuario"])){ 
            if($participar == "sim") {
                date_default_timezone_set('America/Sao_Paulo');
                $data = date('Y-m-d');
                $hora = date('H:i:s');

                /*/*imprime as informações na tela
                echo("id_comunidade = $id_comunidade <br />");
                echo("id_usuario = $id_usuario <br />");
                echo("data = $data <br />");
                echo("hora = $hora <br />");*/

                //conexão e seleção da base de dados
                mysql_connect("localhost","root","") or die ("falha na conexao com o bd"); 
                mysql_select_db("forum") or die ("falha na seleção do BD");

                //query de inserção na base de dados
                $query = "INSERT INTO participa(id_usuario,id_comunidade,data_ingresso,hora_ingresso)
                        VALUES($id_usuario,$id_comunidade,'$data','$hora')";
                mysql_query($query) or die ("Falha na inserção dos dados");

                //Redireciona para a página da comunidade
                echo('<script type="text/javascript">location.replace("../comunidade.php?id_comunidade='.$id_comunidade.'")</script>');
            }
            if($participar == "nao") {
                //conexão e seleção da base de dados
                mysql_connect("localhost","root","") or die ("falha na conexao com o bd"); 
                mysql_select_db("forum") or die ("falha na seleção do BD");

                //query de inserção na base de dados
                $query2 = "DELETE FROM participa
                        WHERE id_usuario=$id_usuario AND id_comunidade=$id_comunidade;";
                mysql_query($query2) or die ("Falha ao sair da comunidade");
                
                //apaga as mensagens postadas na comunidade pelo usuario
                $query3 = "DELETE FROM mensagem 
                          WHERE id_usuario=$id_usuario AND id_comunidade=$id_comunidade;";
                mysql_query($query3) or die ("Falha ao apagar as mensagens");


                //Redireciona para a página da comunidade
                echo('<script type="text/javascript">location.replace("../comunidade.php?id_comunidade='.$id_comunidade.'")</script>');
            }
        } else {
           Header("location: ../login.php?url=$url"); 
        }
    } else { echo 'Houve uma falha'; }
?>