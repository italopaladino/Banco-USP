<?php
require_once 'config.php';

try {
    $pdo = new PDO ($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $sql = "SELECT * FROM infogeral";
    $stm = $pdo->query($sql);
    $infogerals = $stm->fetchAll(PDO::FETCH_ASSOC);
    
 foreach ($infogerals as $infogeral) {
    // Cria a frase com os dados do autor, título sublinhado, DOI e data
     $frase = htmlspecialchars($infogeral['titulo']) . 
                 ", \"<a href='https://" . htmlspecialchars($infogeral['doi']) . "'>" . htmlspecialchars($infogeral['periodico']) . 
                 "</a>\", DOI " . htmlspecialchars($infogeral['doi']) . ", publicado em " . 
                 htmlspecialchars($infogeral['data1']) .".";
    
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
