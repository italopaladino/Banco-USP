<?php
    require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    function incluir($titulo, $email, $nomeAutor, $filiacao, $periodico,$doi,$volume, $data) {
        global $dsn, $user, $pass;
        $mensagem = "";

        try {
            $pdo = new PDO($dsn, $user, $pass, 
            [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
            // Certifique-se de que os tipos de dados correspondam ao esperado pela tabela
            $sql = "INSERT INTO artigos (titulo, email, nomeAutor, filiacao, periodico, doi, volume, data) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stm = $pdo->prepare($sql);

            
            $stm->execute([$titulo, $email, $nomeAutor, $filiacao, $periodico,$doi,$volume, $data]);
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
    $email = $_POST['email'];
    $nomeAutor = $_POST['nomeAutor'];
    $filiacao = $_POST['filiacao'];
    $periodico = $_POST['periodico'];
    $doi = $_POST['doi'];
    $volume = $_POST['volume']; 
    $data = $_POST['data']; 

    // Chame a função incluir e passe os parâmetros necessários
    $resultado = incluir($titulo, $email, $nomeAutor, $filiacao, $periodico, $doi, $volume, $data);
    echo $resultado; // Exibe a mensagem de retorno da função
}

?>
