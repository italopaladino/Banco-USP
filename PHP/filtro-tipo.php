<?php
require_once 'config.php';

try {
    $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
    // Seleciona o ano e conta quantos registros existem para cada ano
    $sql = "SELECT tipotrabalho AS tipo, COUNT(*) AS quantidade FROM infogeral GROUP BY tipo";
    $stm = $pdo->query($sql);
    $tipostrabalho = $stm->fetchAll(PDO::FETCH_ASSOC);

    // Monta a lsta para
    $filtroHTMLTIPO = "<ul>";
    foreach ($tipostrabalho as $tipotrabalho) {
        $tipo = htmlspecialchars($tipotrabalho['tipo']);
        $quantidade = htmlspecialchars($tipotrabalho['quantidade']);
        $filtroHTMLTIPO .= "<li><a href='detalhe.php?tipo=".$tipo ."'>". $tipo. "($quantidade)</a></li>"; //adiconar link para pesquisa dos anos
    }
    $filtroHTMLTIPO .= "</ul>";

    // Retorna a lista HTML
    echo $filtroHTMLTIPO;

} catch (PDOException $e) {
    echo "Erro: " . $e->getMessage();
} finally {
    if ($pdo) {
        $pdo = null;
    }
}
?>
