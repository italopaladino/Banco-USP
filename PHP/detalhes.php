<?php
require_once 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        // Conexão ao banco de dados
        $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

        // Valida o ID para evitar SQL Injection
        $sql = "SELECT * FROM infogeral WHERE geralid = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $infogera = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($infogera) {
            // Exibe os detalhes da linha
            echo "<div class='ultimosartigos'>";
            echo "<h2>Detalhes do Registro</h2>";
            echo "<p>Autor: " . htmlspecialchars($infogera['correspondente']) . "</p>";
            echo "<p>Título: " . htmlspecialchars($infogera['titulo']) . "</p>";
            echo "<p>DOI: " . htmlspecialchars($infogera['doi']) . "</p>";
            echo "<p>Data de Publicação: " . htmlspecialchars($infogera['data1']) . "</p>";
            echo "</div>";
            // Adicione outros campos conforme necessário
        } else {
            echo "<div class='ultimosartigos'>Registro não encontrado.</div>";
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
