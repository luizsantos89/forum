<?php
    session_start();
    if (isset($_POST["titulo"])){
        if(empty($_POST["titulo"])){
            echo('<script type="text/javascript">location.replace("../novo_anuncio.php?erro=1")</script>');  
        } else $titulo = $_POST["titulo"];
        
        if(empty($_POST["texto"])){
            echo('<script type="text/javascript">location.replace("../novo_anuncio.php?erro=2")</script>');  
        } else $texto = $_POST["texto"];
        
        $id_usuario = $_SESSION["id_usuario"];
        $data = date("Y/m/d");
        $telefone = $_POST["telefone"];
        $email = $_POST["email"];
        $hora = date("h:i:s");
                
        //Conecta ao banco e usa a tabela pergunta
        $conexao = mysql_connect("localhost","root","") or print ("Falha na conexao com o servidor");
        mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");

        //Valor de cada variável:
        echo("<b>Título: </b> $titulo <br />");
        echo("<b>Texto: </b> $texto <br />");
        echo("<b>id_usuario: </b> $id_usuario <br />");
        echo("<b>Data: </b> $data <br />");
        echo("<b>Hora: </b> $hora <br />");

        //insere os dados na tabela anúncio
        $query = "INSERT INTO anuncio (id_usuario,titulo,texto,data_criacao,telefone,email)
            VALUES ($id_usuario,'".$titulo."', '".$texto."','".$data."','".$telefone."','".$email."')";
        mysql_query($query) or die ("Falha na inserção dos dados");
        
        echo('<script type="text/javascript">location.replace("../meus_anuncios.php")</script>');
    }
    
?>