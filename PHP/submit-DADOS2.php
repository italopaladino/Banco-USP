<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta do valor do campo 'secaoAtual' para determinar de qual seção os dados foram submetidos
    $secaoAtual1 = $_POST['secaoAtual1'];
    $secaoAtual2 = $_POST['secaoAtual2'];
    $secaoAtual3 = $_POST['secaoAtual3'];

    echo "Seção atual: " . $secaoAtual1 . "<br>";
    echo "Seção atual: " . $secaoAtual2 . "<br>";
    echo "Seção atual: " . $secaoAtual3 . "<br>";

    // Verifica a seção atual e executa a lógica correspondente
    if ($secaoAtual1) {
        // Coleta dos valores da primeira seção
        $titulo = $_POST['titulo'];
        $email = $_POST['email'];
        $nomeAutor = $_POST['nomeAutor'];
        $filiacao = $_POST['filiacao'];
        $periodico = $_POST['periodico'];
        $doi = $_POST['doi'];
        $volume = $_POST['volume'];
        $data = $_POST['data'];

        echo "Dados da Seção 1:<br>";
        echo "Título: " . $titulo . "<br>";
        echo "E-mail: " . $email . "<br>";
        echo "Nome: " . $nomeAutor . "<br>";
        echo "Filiação: " . $filiacao . "<br>";
        echo "Periódico: " . $periodico . "<br>";
        echo "DÓI: " . $doi . "<br>";
        echo "Volume: " . $volume . "<br>";
        echo "DATA: " . $data . "<br>";
        

        // Chama a função para inserir na tabela da primeira seção
        $resultado1 = inserirSecao1($titulo, $email, $nomeAutor, $filiacao, $periodico, $doi, $volume, $data);

        // Exibe o resultado da inserção da seção 1
        echo $resultado1;

    } elseif ($secaoAtual2) {
        // Coleta dos valores da segunda seção
        $keywords = $_POST['keywords'];
        $highlights = $_POST['highlights'];
        $resumo = $_POST['resumo'];

        echo "Dados da Seção 2:<br>";
        echo "Palavras-chave: " . $keywords . "<br>";
        echo "Highlights: " . $highlights . "<br>";
        echo "Resumo: " . $resumo . "<br>";
        

        // Chama a função para inserir na tabela da segunda seção
        $resultado2 = inserirSecao2($keywords, $highlights, $resumo);

        // Exibe o resultado da inserção da seção 2
        echo $resultado2;

    } elseif ($secaoAtual3) {
        // Coleta dos valores da terceira seção
        $caract = $_POST['caract'];
        $tabelaDado = $_POST['tabelaDado'];

        echo "Dados da Seção 3:<br>";
        echo "Características: " . $caract . "<br>";
        echo "Tabela de Dados: " . $tabelaDado . "<br>";

        // Chama a função para inserir na tabela da terceira seção
        $resultado3 = inserirSecao3($caract, $tabelaDado);

        // Exibe o resultado da inserção da seção 3
        echo $resultado3;
    }
}


// Função para inserir na tabela correspondente à primeira seção
function inserirSecao1($titulo, $email, $nomeAutor, $filiacao, $periodico, $doi, $volume, $data) {
    global $dsn, $user, $pass;

    try {
        $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $sql = "INSERT INTO artigos (titulo, email, nomeAutor, filiacao, periodico, doi, volume, data) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stm = $pdo->prepare($sql);

        $stm->execute([$titulo, $email, $nomeAutor, $filiacao, $periodico, $doi, $volume, $data]);
        return "Inserção na seção 1 OK";
    } catch (PDOException $e) {
        return "Erro ao inserir na seção 1: " . $e->getMessage();
    }
}

// Função para inserir na tabela correspondente à segunda seção
function inserirSecao2($keywords, $highlights, $resumo) {
    global $dsn, $user, $pass;

    try {
        $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $sql = "INSERT INTO artigos2 (keywords, highlights, resumo) VALUES (?, ?, ?)";
        $stm = $pdo->prepare($sql);

        $stm->execute([$keywords, $highlights, $resumo]);
        return "Inserção na seção 2 OK";
    } catch (PDOException $e) {
        return "Erro ao inserir na seção 2: " . $e->getMessage();
    }
}

// Função para inserir na tabela correspondente à terceira seção
function inserirSecao3($caract, $tabelaDado) {
    global $dsn, $user, $pass;

    try {
        $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        $sql = "INSERT INTO artigos3 (caract, tabelaDado) VALUES (?,?)";
        $stm = $pdo->prepare($sql);

        $stm->execute([$caract, $tabelaDado ]);
        return "Inserção na seção 3 OK";
    } catch (PDOException $e) {
        return "Erro ao inserir na seção 3: " . $e->getMessage();
    }
}
?>
