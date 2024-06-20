<?php
require_once 'config.php';

try {
    $pdo = new PDO ($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $sql = "SELECT * FROM autores";
    $stm = $pdo->query($sql);
    $autores = $stm->fetchAll(PDO::FETCH_ASSOC);
    
 foreach ($autores as $autor) {
    // Cria a frase com os dados do autor, título sublinhado, DOI e data
     $frase = htmlspecialchars($['autor']) . 
                 ", \"<a href='https://doi.org/" . htmlspecialchars($autor['doi']) . "'>" . htmlspecialchars($['titulo']) . 
                 "</a>\", DOI " . htmlspecialchars($infogera['doi']) . ", publicado em " . 
                 htmlspecialchars($infogera['data']) .".";
    
        // Exibe a frase e adiciona duas quebras de linha
        echo $frase . "<br><br>";
}
    
} catch (PDOException $e) {
    echo "Erro:" . $e->getMessage();
} finally {
    if($pdo){
        $pdo = null;
    }
}
?>
