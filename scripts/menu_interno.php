<?php
    if(isset($_SESSION["usuario"])){
    echo('
    <ul>
        <li><a href="../index.php">Principal</a></li>
    </ul>

    <ul>
        <li><a href="../index.php">Minha Conta</a></li>
    </ul>

    <ul><li><a href="../index.php">Fórum</a>
        <ul>
            <li><a href="../minhas_perguntas.php">Minhas Perguntas</a>
            <li><a href="../nova_pergunta.php">Perguntar</a>
            <li><a href="../analise_respostas.php">Analisar Respostas</a>
            <li><a href="../perguntas.php">Outras Perguntas</a>
        </ul>
    </li></ul>

    <ul><li><a href="../index.php">Anúncios</a>
        <ul>
            <li><a href="../meus_anuncios.php">Meus Anúncios</a>
            <li><a href="../novo_anuncio.php">Anunciar</a>
            <li><a href="../anuncios.php">Outros Anúncios</a>
        </ul>
    </li></ul>
    
    <ul><li><a href="../comunidades.php">Comunidades</a>
        <ul>
            <li><a href="../minhas_comunidades.php">Minhas Comunidades</a></li>
            <li><a href="../comunidades.php">Minhas Comunidades</a></li>
            <li><a href="../nova_comunidade.php">Criar uma comunidade</a></li>
        </ul>
    </li></ul>
    
    <ul>
        <li><a href="../scripts/logout.php">Sair</a></li>
    </ul>
    ');
    } else {
        echo('
    <ul>
        <li><a href="../index.php">Principal</a></li>
    </ul>

    <ul><li><a href="../index.php">Perguntas</a></li></ul>

    <ul><li><a href="../index.php">Anúncios</a></li></ul>
    
    <ul><li><a href="../comunidades.php">Comunidades</a></li></ul>
    ');  
    }
?>