<?php
    if (isset($_POST["usuario"])) {
        $conecta = mysql_connect("localhost","root","") or print 'Sem conexão';
        mysql_select_db("forum") or die("Não foi possível selecionar o Banco de Dados");
        $data = date("Y/m/d");
        $hora = time();
        $nome = $_POST["nome"];        
        $login = $_POST["login"];
        $apelido = $_POST["apelido"];
        $senha = $_POST["senha"];
        $cidade = $_POST["cidade"];
        $estado = $_POST["estado"];
        $consulta = "INSERT INTO usuario (nome, login, apelido, senha, cidade, estado, 
            data_cadastro, hora_cadastro) values ($nome,$login,$senha,$cidade,$estado,$data,$hora);";
        $resultado = mysql_query($consulta) or die ("Erro na consulta aos dados");	
        $usuarios = mysql_fetch_assoc($resultado);
        echo("<a href='testeBD.php'>Visualizar</a>;");
    } else {
	echo ("
            <form action='cadastra.php' method='post'>
                Nome: <input type='text' size='40' maxlenght='100' name='nome' /><br />
                Login: <input type='login' size='15' maxlenght='15' name='login' /><br />
                Apelido: <input type='text' size='20' maxlenght='50' name='apelido' /><br />
                Senha: <input type='password' size='8' maxlenght='20' name='senha' /><br />
                Cidade: <input type='text' size='20' maxlenght='50' name='cidade' /><br />
                Estado: <input type='text' size='2' maxlenght='2' name='estado' /><br />
                <input type=submit value='Gravar' />
            </form>
	");
	}
?>
