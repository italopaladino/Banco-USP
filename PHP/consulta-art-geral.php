<?php
require_once 'config.php';

try {
    $pdo = new PDO ($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $sql = "SELECT * FROM infogeral";
    $stm = $pdo->query($sql);
    $infogeral = $stm->fetchAll(PDO::FETCH_ASSOC);
    
 foreach ($infogeral as $infogera) {
    // Cria a frase com os dados do autor, título sublinhado, DOI e data
     $frase = htmlspecialchars($infogera['autorcorr']) . 
                 ", \"<a href='https://doi.org/" . htmlspecialchars($infogera['doi']) . "'>" . htmlspecialchars($infogera['titulo']) . 
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
