<?php

require_once 'config.php';


function testarConexaoPostgreSQL($host, $port, $dbname, $user, $pass) {
    $dsn = "pgsql:host=$host;port=$port;dbname=$dbname;user=$user;password=$pass";
    
    try {
        $pdo = new PDO($dsn);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Conexão bem-sucedida!";
    } catch (PDOException $e) {
        echo "Falha na conexão: " . $e->getMessage();
    }
}


// Teste da conexão
testarConexaoPostgreSQL($host, $port, $dbname, $user, $pass);

$dsn=null;
?>
