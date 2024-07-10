<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Conexão ao banco de dados
        $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        // Valida o ID para evitar SQL Injection
        $sql = "SELECT * FROM infogeral WHERE geralID = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $infogera = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($infogera) {
            // Exibe os detalhes da linha
            echo "<h2>Detalhes do Registro</h2>";
            echo "<p>Autor: " . htmlspecialchars($infogera['correspondente']) . "</p>";
            echo "<p>Título: " . htmlspecialchars($infogera['titulo']) . "</p>";
            echo "<p>DOI: " . htmlspecialchars($infogera['doi']) . "</p>";
            echo "<p>Data de Publicação: " . htmlspecialchars($infogera['data1']) . "</p>";
            // Adicione outros campos conforme necessário
        } else {
            echo "Registro não encontrado.";
        }

    } catch (PDOException $e) {
        echo "Erro: " . $e->getMessage();
    } finally {
        if ($pdo) {
            $pdo = null;
        }
    }
} else {
    echo "ID não especificado.";
}
?>
