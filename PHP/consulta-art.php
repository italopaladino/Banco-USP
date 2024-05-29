<?php
require_once 'config.php';

try {
    $pdo = new PDO ($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    $sql = "SELECT * FROM infogeral";
    $stm = $pdo->query($sql);
    $infogeral = $stm->fetchAll(PDO::FETCH_ASSOC);
    
    
    $contador = 0; // Inicializa o contador

    // Itera sobre as linhas, começando do final
    for ($i = count($infogeral) - 1; $i >= 0; $i--) {
        $infogera = $infogeral[$i]; // Obtém a linha atual
    
        // Cria a frase com os dados do autor, título sublinhado, DOI e data
        $frase = htmlspecialchars($infogera['autorcorr']) . 
                 ", \"<u>" . htmlspecialchars($infogera['titulo']) . 
                 "</u>\", DOI " . htmlspecialchars($infogera['doi']) . ", publicado em " . 
                 htmlspecialchars($infogera['data']) .".";
    
        // Exibe a frase e adiciona duas quebras de linha
        echo $frase . "<br><br>";
    
        // Incrementa o contador
        $contador++;
    
        // Verifica se o contador atingiu três, se sim, interrompe o loop
        if ($contador >= 3) {
            break;
        }
    }
    
} catch (PDOException $e) {
    echo "Erro:" . $e->getMessage();
} finally {
    if($pdo){
        $pdo = null;
    }
}
?>
