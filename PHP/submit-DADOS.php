<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    require_once 'config.php';

    function incluir($titulo, $doi, $volume, $email,$nomeAutor, $periodico,$filiacao,$data) {
        global $dsn, $user, $pass;
        $mensagem = "";

        try {
            $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            // Certifique-se de que os tipos de dados correspondam ao esperado pela tabela
            $sql = "INSERT INTO artigos VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stm = $pdo->prepare($sql);
            // Removido o casting para int onde não é necessário
            $stm->execute([(int)$titulo, $doi, $volume, (int)$email,$nomeAutor, (int)$periodico,(int)$filiacao,$data]);
            $mensagem = "Inserção OK";
        } catch (PDOException $e) {
            $mensagem = "Erro ao incluir: " . $e->getMessage();
        } catch (Exception $e) {
            $mensagem = $e->getMessage();
        } finally {
            if ($pdo) {
                $pdo = null;
            }
        }
        return $mensagem;
    }

    // Coleta dos valores do formulário
    $titulo = $_POST['titulo'];
    $doi = $_POST['doi'];
    $volume = $_POST['volume'];
    $email = $_POST['email'];
    $nomeAutor = $_POST['nomeAutor'];
    $periodico = $_POST['periodico'];
    $filiacao = $_POST['filiacao']; 
    $data = $_POST['data'];

    // Chame a função incluir e passe os parâmetros necessários
    $resultado = incluir($titulo, $email, $nomeAutor, $filiacao, $periodico, $doi, $volume, $data);
    echo $resultado; // Exibe a mensagem de retorno da função
}

?>
