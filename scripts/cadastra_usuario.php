<?php
    if(isset($_POST["senha"])) {
        $nome = $_POST["nome"];
        $apelido = $_POST["apelido"];
        $login = $_POST["login"];
        $senha = $_POST["senha"];
        $rua = $_POST["rua"];
        $numero = $_POST["numero"];
        $complemento = $_POST["complemento"];
        if (empty($complemento)) {
            $complemento = " ";
        }
        $bairro = $_POST["bairro"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];
        date_default_timezone_set('America/Sao_Paulo');
        $data = date('Y-m-d');
        $hora = date('H:i:s');
        
        /*
        if ((empty($_POST["nome"])) || (empty($_POST["apelido"])) 
                || (empty($_POST["login"])) || (empty($_POST["senha"])) 
                || (empty($_POST["rua"])) || (empty($_POST["numero"]))
                || (empty($_POST["bairro"])) || (empty($_POST["cidade"]))
                || (empty($_POST["estado"]))){
            Header("Location:../cadastro.php?erro");
        }*/
        
        
        
        //Conexão ao banco de dados
        mysql_connect("localhost","root","") or die ("Falha na conexão com o servidor");
        mysql_select_db("forum") or die ("Falha na seleção da base de dados");
        
        //Query com a inserção no Banco
        $query = "INSERT INTO usuario(apelido, login, senha, nome, rua, numero, bairro, complemento,
                 cidade, estado, hora_cadastro, data_cadastro, hora_ultimo_acesso, data_ultimo_acesso) 
                 VALUES ('$apelido','$login','$senha','$nome','$rua','$numero','$bairro', 
                 '$complemento','$cidade','$estado','$hora','$data','$hora','$data');";
        
        echo("<br />$query<br /><br />");
        
        mysql_query($query) or die ("Falha na inserção de dados no Banco");
        Header("Location: ../login.php?request=cadastro");
        
    }