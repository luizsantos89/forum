<?php
    session_start();
    if (isset($_SESSION["id_usuario"])){
        if (isset($_POST["id_comunidade"])) {
            $texto = $_POST["resposta"];
            $id_comunidade = $_POST["id_comunidade"];
            $id_usuario = (int) $_SESSION["id_usuario"];
            date_default_timezone_set('America/Sao_Paulo');
            $data = date('Y-m-d');
            $hora = date('H:i:s');

            //Conecta ao servidor MySQL
            mysql_connect("localhost","root","") or print 'Sem conexão';

            //Seleciona a Base de Dados
            mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");

            //insere os dados no banco
            $query = "INSERT INTO mensagem(id_usuario,id_comunidade,mensagem,data_postagem,hora_postagem)
                    VALUES ($id_usuario,$id_comunidade,'$texto','$data','$hora');";
            mysql_query($query) or die ("Erro na inserção da mensagem");

            header("Location:../comunidade.php?id_comunidade=$id_comunidade");

        }
    } else header("Location:../login.php");