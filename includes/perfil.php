<?php
    if (isset($_GET["id_usuario"])) {
        $id_usuario = $_GET["id_usuario"];
    } else {
        $id_usuario = $_SESSION["id_usuario"];
    }

    //Conexão
    mysql_connect("localhost","root","") or die("Falha na conexão");
    mysql_select_db("forum") or die("Falha na seleção da Base de Dados");
    
    //Busca dos dados
    $query = "SELECT * from usuario WHERE id_usuario=$id_usuario;";
    $resultado = mysql_query($query) or die ("Falha na consulta");
    
    //While para varrer o vetor com os resultados do SQL
    while ($usuario = mysql_fetch_assoc($resultado)) {
        $nome = $usuario["nome"];
        $login = $usuario["login"];
        $apelido = $usuario["apelido"];
        $rua = $usuario["rua"];
        $numero = $usuario["numero"];
        $complemento = $usuario["complemento"];
        $bairro = $usuario["bairro"];
        $cidade = $usuario["cidade"];
        $estado = $usuario["estado"];
        $data_cadastro = date('d/m/Y',strtotime($usuario["data_cadastro"]));
        $hora_cadastro = $usuario["hora_cadastro"];
        $data_alteracao = date('d/m/Y',strtotime($usuario["data_alteracao"]));
        $hora_alteracao = $usuario["hora_alteracao"];
        $data_ultimo_acesso = date('d/m/Y',strtotime($usuario["data_ultimo_acesso"]));
        $hora_ultimo_acesso = $usuario["hora_ultimo_acesso"];
    }
    
    if (isset($_SESSION["id_usuario"])) {
        if ($id_usuario == $_SESSION["id_usuario"]) {
            include("includes/editar_meu_perfil.php");
        } else {
            echo(" 
               <h1>$nome</h1> 
               <h3>($apelido)</h3>
               <small>Usuário desde: $data_cadastro </small> <br /><br />     
               Mora em: <b>$cidade</b> / <b>$estado</b><br /><br />
             ");
            $query2 = "SELECT * from comunidade WHERE id_usuario = $id_usuario;";
            $result = mysql_query($query2);
            //echo($query2);
            $cont = 0;
            while ($comunidades = mysql_fetch_assoc($result)) {
                $comunidades_nome[$cont] = $comunidades["nome"];
                $comunidades_id[$cont] = $comunidades["id_comunidade"];
                $cont++;
            }
            
            if (isset($comunidades_nome) && ($comunidades_nome[0] != null)) {
                echo("Participa das comunidades: <br />");
                for ($i=0; $i<$cont; $i++) {
                    if (isset($comunidades_id)){
                        $id_comunidade = $comunidades_id[$i];
                        echo("<a href='comunidade.php?id_comunidade=".$id_comunidade);
                        echo("'>".$comunidades_nome[$i]."</a><br />");
                    }
                }
            }
            
        }
    } else {
        $servidor = $_SERVER['SERVER_NAME'];
        $local = $_SERVER ['REQUEST_URI'];
        $url = "http://".$servidor.$local;
        header("Location:login.php?url=$url");
    }
    
    
    
    
    
    
    
    