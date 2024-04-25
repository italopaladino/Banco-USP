<?php

require_once 'config php';
function incluir ($tiulo,$email,$primeiro,$sobrenome,$filiaçao, $periodico, $doi, $volume,$data){
global $dsn, $user, $pass;
$mensagem="";

try{
    $pdo = new PDO($dsn,$user,$pass,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);

$sql = "INSERT INTO test VALUES (?,?,?,?,?,?,?,?)";
$stm = $pdo->prepare ($sql);
$stm ->execute([$tiulo,$email,$primeiro,$sobrenome,$filiaçao, $periodico, $doi, $volume,$data]);
$mensagem = " Inserção OK"
}
catch (PDOException $e){
    $mensagem = "Erro ao incluir";
}
finally {
    if ($pdo){
        $pdo=null;
    }
}
return $mensagem;
}

?>