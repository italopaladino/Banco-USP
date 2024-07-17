<?php
// Inclui o arquivo de configuração do banco de dados
require_once 'config.php';

// Verifica se o ID foi passado como parâmetro via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Conexão ao banco de dados usando PDO
        $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        // Prepara e executa a consulta SQL com o ID fornecido
        $sql = "SELECT nome_arquivo, conteudo FROM arquivos WHERE trabalhoID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            $nome_arquivo = htmlspecialchars($row['nome_arquivo']);
            $conteudo = $row['conteudo']; // Supondo que o conteúdo já esteja no formato CSV

            // Definir os cabeçalhos para download do arquivo
            header('Content-Type: text/csv');
            header('Content-Disposition: attachment; filename="' . $nome_arquivo . '"');
            header('Pragma: no-cache');
            header('Expires: 0');

            // Exibir o conteúdo do CSV
            echo $conteudo;
            exit;
        } else {
            echo "Arquivo não encontrado.";
        }
    } catch (PDOException $e) {
        echo "Erro ao conectar ao banco de dados: " . $e->getMessage();
    }
} else {
    echo "ID não especificado.";
}
?>
