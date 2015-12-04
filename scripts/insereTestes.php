<?php
$inserePergunta1 = "INSERT INTO pergunta(id_usuario,titulo,texto, 
         resposta_pendente, data_criacao, hora_criacao)
         VALUE (1,'Qual o melhor quadro TSW, Hunter ou Jump ?',
         'Quero comprar um quadro TSW e fiquei na dúvida entre 
         os Modelos TSW Hunter e Jump, alguém sabe qual é o melhor?',1,'$data','$horario');";
mysql_query($inserePergunta1) or die("Falha na inserção da Primeira Pergunta");

$inserePergunta2 = "INSERT INTO pergunta(id_usuario,titulo,texto, 
         resposta_pendente, data_criacao, hora_criacao)
         VALUE (2,'Quando devo trocar minha corrente?',
         'Já pratico MTB a um ano e tenho dúvidas quanto a durabilidade da 
         corrente da minha corrente, quando devo troca lá?',1,'$data','$horario');";
mysql_query($inserePergunta2) or die("Falha na inserção da Segunda Pergunta");

$inserePergunta3 = "INSERT INTO pergunta(id_usuario,titulo,texto, 
         resposta_pendente, data_criacao, hora_criacao)
         VALUE (3,'Quando devo trocar minha corrente?',
         'Já pratico MTB a um ano e tenho dúvidas quanto a durabilidade da 
         corrente da minha corrente, quando devo troca lá?',1,'$data','$horario');";
mysql_query($inserePergunta3) or die("Falha na inserção da 3 Pergunta");

$insereResp1 = "INSERT INTO resposta (id_pergunta,id_usuario,texto,analisada,data_criacao,hora_criacao)
           VALUES(1,2,'Os dois quadros apresentam ótimo desempenho para 
           quem deseja iniciar no MTB, sua principal diferença está no 
           peso que geralmente varia entre 1500gr para o Jump e 1700gr 
           para Hunter. Aconselho o Jump por ser esteticamente mais bonito 
           e leve, uma vez que linha de quadros Hunter está saindo do mercado.',1,'$data','$horario');";
mysql_query($insereResp1) or die("Falha na inserção da primeira resposta") ;


$insereResp2 = "INSERT INTO resposta (id_pergunta,id_usuario,texto,analisada,data_criacao,hora_criacao)
           VALUES(1,3,'Os quadros TSW são bons, mas dê uma olhada na linha da 
           OGGi; talvez você goste.',1,'$data','$horario');";
mysql_query($insereResp2) or die("Falha na inserção da 2 resposta") ;


$insereResp3 = "INSERT INTO resposta (id_pergunta,id_usuario,texto,analisada,data_criacao,hora_criacao)
           VALUES(1,2,'Particularmente uso o TSW Jump e 
           não me arrependo, você vai fazer uma excelente escolha.',1,'$data','$horario');";
mysql_query($insereResp3) or die("Falha na inserção da 3 resposta") ;


$insereResp4 = "INSERT INTO resposta (id_pergunta,id_usuario,texto,analisada,data_criacao,hora_criacao)
           VALUES(2,1,'Geralmente a vida útil de uma corrente gira em torno 1000 km,
           após isso ela já  não interage em perfeita harmonia com a relação. 
           Claro que uma boa manutenção é essencial para prolongar esse período, 
           trabalho com reparos e já vi correntes que não tinha nem 500km rodados 
           totalmente gastas por falta de limpeza e lubrificação.',1,'$data','$horario');";
mysql_query($insereResp4) or die("Falha na inserção da 4 resposta") ;

$insereComunidade = "INSERT INTO comunidade(id_usuario,nome,descricao, data_criacao, hora_criacao)
                VALUES(1,'Produtos falsos, piratas e réplicas - Liste aqui','Pessoal,

Tomei a iniciativa de criar esse tópico para centralizar as informações.','$data','$horario');";
mysql_query($insereComunidade) or die("Falha na criação da comunidade");

$insereAnuncio1 = "INSERT INTO anuncio (id_usuario,titulo,texto,data_criacao,telefone,email,hora_criacao,valor) 
        VALUES (1,'Scott Scale 70 XL', 'Scott Scale 70 branca com detalhes em vermelho. 
        Bike é de 2011. Possuo manuais e NF de venda (unico dono). Novíssima. 
        Nunca viu trilha. Essa bike é da patroa e que decidiu abandonar, por ora, 
        o esporte. Não tem detalhes nem arranhões mas os pneus foram trocados por 
        lisos e o selim tb por um mais confortável. Componentes Quadro XL (para pessoas
        de 1,85 pra cima) Suspensão Tora 100mm Rodas com aros Alex XC-44 e cubos HM65 
        Trocadores Deore M590 27V PedivelaOctalink 22 32 44 CT SLX Shadow CD Deore 
        Corrente HG53 Cassette HG50 11-32 Freios M446 (180 na frente e 160 atrás) ',
        '2015-12-04','(32) 9116-5242','teste@teste.com.br','12:18:30', 3500);";
mysql_query($insereAnuncio1) or die("Falha na inserção do 1 anuncio");

$insereAnuncio2 = "INSERT INTO anuncio (id_usuario,titulo,texto,data_criacao,telefone,
        email,hora_criacao,valor) VALUES (2,'Bretelle Fox coolmax', 
        'vendoBretelle Fox Bib Short Motivo da venda: ficou pequeno pra mim 
        Tamanho M Tempo de uso: Menos de 1 mês Onde produto se encontra: 
        Juiz de Fora Quilometragem: Menos de 50 km ','2015-12-04','(32) 9116-5242',
        'teste@teste.com.br','12:21:06', 1250)";
mysql_query($insereAnuncio2) or die("Falha na inserção do 2 anúncio");

$insereParticipacao = "INSERT INTO participa (id_comunidade, id_usuario, data_ingresso, hora_ingresso)
          VALUES(1,2,'$data', '$horario');";
mysql_query($insereParticipacao) or die("Falha na inserção da primeira participação");

$insereParticipacao1 = "INSERT INTO participa (id_comunidade, id_usuario, data_ingresso, hora_ingresso)
          VALUES(1,3,'$data', '$horario');";
mysql_query($insereParticipacao1) or die("Falha na inserção da 2 participação");

        
        