<?php
require_once 'config.php';

try {
    $pdo = new PDO ($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $sql = "SELECT * FROM artigos";
    $stm = $pdo->query($sql);
    $artigos = $stm->fetchAll(PDO::FETCH_ASSOC);
    
    
    echo "<table class='table'>";
    echo "<thead><tr><th>Título</th><th>Email</th><th>Nome do Autor</th><th>Filiação</th><th>Periódico</th><th>DOI</th><th>Volume</th><th>Data</th></tr></thead>";
    echo "<tbody>";

    // Formata os resultados como HTML

    foreach ($artigos as $artigo) {
        echo "<tr>";
        echo "<td>" . $artigo['titulo'] . "</td>";
        echo "<td>" . $artigo['email'] . "</td>";
        echo "<td>" . $artigo['nomeautor'] ."</td>"; // Corrigido de $artigos para $artigo
        echo "<td>" . $artigo['filiacao'] ."</td>"; // Corrigido de $artigos para $artigo
        echo "<td>" . $artigo['periodico'] ."</td>"; // Corrigido de $artigos para $artigo
        echo "<td>" . $artigo['doi'] ."</td>"; // Corrigido de $artigos para $artigo
        echo "<td>" . $artigo['volume'] ."</td>"; // Corrigido de $artigos para $artigo
        echo "<td>" . $artigo['data'] ."</td>"; // Corrigido de $artigos para $artigo
        echo "</tr>";
    }
    echo "</table>";

} catch (PDOException $e) {
    echo "Erro:" . $e->getMessage();
} finally {
    if($pdo){
        $pdo = null;
    }
}
?>
