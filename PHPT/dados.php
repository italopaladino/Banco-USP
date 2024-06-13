<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once 'config.php';

// Conexão com o banco de dados
$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

if (!$conn) {
    die(json_encode(["error" => "Connection failed: " . pg_last_error()]));
}

// Recuperar todos os dados
$sql = "SELECT caract, metut, proxys FROM caractdado ORDER BY id DESC";
$result = pg_query($conn, $sql);

if (!$result) {
    die(json_encode(["error" => "Ocorreu um erro ao executar a consulta: " . pg_last_error()]));
}

$data = [];
while ($row = pg_fetch_assoc($result)) {
    $row['caract'] = htmlspecialchars($row['caract']);
    $row['metut'] = htmlspecialchars($row['metut']);
    $row['proxys'] = json_decode($row['proxys']);
    
    if (json_last_error() !== JSON_ERROR_NONE) {
        die(json_encode(["error" => "Erro ao decodificar JSON: " . json_last_error_msg()]));
    }

    $data[] = $row;
}

pg_close($conn);

header('Content-Type: application/json');
echo json_encode($data);
?>
