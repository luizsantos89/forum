<?php session_start(); ?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Pedalando :: O seu fórum sobre ciclismo</title>
        <link rel="stylesheet" type="text/css" href="estilo/estilo.css" />
        <link rel="stylesheet" type="text/css" href="estilo/menus.css" />
        <script type="text/javascript">
            function validaCadastro() {
                nome = document.form1.nome.value;
                apelido = document.form1.apelido.value;
                login = document.form1.login.value;
                senha = document.form1.senha.value;
                senha2 = document.form1.senha2.value;
                rua = document.form1.rua.value;
                numero = document.form1.numero.value;
                bairro = document.form1.bairro.value;
                cidade = document.form1.cidade.value;
                
                if (nome.length < 1) {
                    document.getElementById("msgerro").innerHTML = "Campo Nome obrigatório";
                    document.form1.nome.focus();
                    return false;
                }
                
                if (apelido.length < 1) {
                    document.getElementById("msgerro").innerHTML = "Campo Apelido obrigatório";
                    document.form1.apelido.focus();
                    return false;
                }
                
                if (login.length < 1) {
                    document.getElementById("msgerro").innerHTML = "Campo Login obrigatório";
                    document.form1.login.focus();
                    return false;
                }
                
                if (senha.length < 1) {
                    document.getElementById("msgerro").innerHTML = "Campo Senha obrigatório";
                    document.form1.senha.focus();
                    return false;
                }
                
                if (senha != senha2) {
                    document.getElementById("msgerro").innerHTML = "Senhas não coincidem";
                    document.form1.senha.focus();
                    return false;
                }
                
                if (rua.length < 1) {
                    document.getElementById("msgerro").innerHTML = "Campo Rua obrigatório";
                    document.form1.rua.focus();
                    return false;
                }
                
                if (numero.length < 1) {
                    document.getElementById("msgerro").innerHTML = "Campo Número obrigatório";
                    document.form1.numero.focus();
                    return false;
                }
                
                if (bairro.length < 1) {
                    document.getElementById("msgerro").innerHTML = "Campo Bairro obrigatório";
                    document.form1.bairro.focus();
                    return false;
                }
                
                if (cidade.length < 1) {
                    document.getElementById("msgerro").innerHTML = "Campo Cidade obrigatório";
                    document.form1.cidade.focus();
                    return false;
                }
            }
    </script>
    </head>
    <body>
        <center>
            <div id="pagina">
                <div id="banner">
                    <!-- ImplementaÃ§Ã£o do Logotipo -->
                    <div id="logotipo">
                            <a href="index.php"><img src="imagens/logo.png"  /></a>
                    </div>

                    <!-- ImplementaÃ§Ã£o do algoritmo de busca -->
                    <div id="busca">
                            <form action="index.php" method="get">
                                    <input type="text" size="30" name="busca" />
                                    <input type="submit" value="Buscar" />
                            </form>
                    </div>

                    <!-- ImplementaÃ§Ã£o da Ã¡rea do usuÃ¡rio graficamente-->
                    <div id="area_usuario">
                        <?php
                            include("scripts/usuario.php");
                        ?>
                    </div>
                </div>
            <div id="menus">
                <?php
                    include("scripts/menu.php");
                ?>
            </div>

            <!-- Conteudo da PÃ¡gina -->
            <div id="conteudo">
                <div id="barra_lateral">
                    
                </div>
                <div id="conteudo_pagina">
                    <h3>Cadastre-se para ter acesso total ao site: </h3>
                    <center>
                    <form action="scripts/cadastra_usuario.php" method="post" name="form1" onsubmit="return validaCadastro()">
                        <table>
                            <tr>
                                <td colspan="4">
                                    <center><b>Dados Pessoais e de Acesso:</b></center>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <small>Todos os campos com um asterisco (*) são obrigatórios</small>
                                </td>
                            </tr>
                            <tr>
                                <td>Nome: *</td>
                                <td colspan="4">
                                    <input type="text" size=67" name="nome" maxlength="90" />
                                </td>
                            </tr>
                            <tr>
                                <td>Apelido: *</td>
                                <td>
                                    <input type="text" size="10" name="apelido" maxlength="45" />
                                </td>

                                <td>Senha: *</td>
                                <td>
                                    <input type="password" size="10" name="senha" maxlength="20" />
                                </td>
                            </tr>
                            <tr>
                                <td>Login: *</td>
                                <td>
                                    <input type="text" size="10" name="login" maxlength="15" />
                                </td>

                                <td>Confirme a senha: *</td>
                                <td>
                                    <input type="password" size="10" name="senha2" maxlength="20" />
                                </td>
                            </tr>
                            <tr>
                                <td colspan="4">
                                    <center><b>Endereço:</b></center>
                                </td>
                            </tr>
                            <tr>
                                <td>Rua: *</td>
                                <td colspan="3">
                                    <input type="text" size=67" name="rua" maxlength="90" />
                                </td>
                            </tr>
                            <tr>
                                <td>Número: *</td>
                                <td>
                                    <input type="text" name="numero" size="10" maxlength="5" />
                                </td>
                                
                                <td>Complemento: </td>
                                <td>
                                    <input type="text" name="complemento" size="21" maxlength="50" />
                                </td>
                            </tr>
                            <tr>
                                <td>Bairro: *</td>
                                <td>
                                    <input type="text" name="bairro" size="10" maxlength="100" />
                                </td>
                                
                                <td>Cidade/Estado: *</td>
                                <td>
                                    <input type="text" name="cidade" size="12" maxlength="50" /> |
                                    <?php include("includes/estados.php"); ?>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                   <input type="submit" value="Cadastrar" />
                                </td>
                                <td colspan="3">
                                    <div id="msgerro">
                                        <?php
                                            if(isset($_GET["erro"])) {
                                                echo("Houve um erro, tente novamente!");
                                            }
                                        ?>
                                    </div>
                                </td>
                            </tr>
                        </table>
                    </form>
                    </center>
                </div>
            </div>

            <!-- RodapÃ© da PÃ¡gina -->
            <div id="rodape">
                <?php
                    include("includes/rodape.php");
                ?>
            </div>
        </div>
        </center>
    </body>
</html>