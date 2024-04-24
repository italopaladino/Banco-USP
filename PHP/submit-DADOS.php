<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {


/*    $host = "localhost";
    $port = 5432;
    $user = "postgres";
    $pass = "postgre";
    $name = "postgres";

$dsn ="pgsql:host=$host;port=$port;dbname=$name";
*/

require_once 'config.php';

try {
        $db = new PDO($dsn, $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


        $newTitulo =$_POST ['newTitulo'];
        $newDoi = $_POST ['newDoi'];
        $newVolume = $_POST ['newVolume'];
        $newData = $_POST ['$newData'];
        
$query = "INSERT INTO artigos (titulo, doi, volume, data) VALUES (:titulo, :doi, :volume, :data)";
$stmt = $db->prepare($query);


if ($stmt){
    $stmt ->bindParam(':titulo', $newTitulo, PDO::PARAM_STR);
    $stmt ->bindParam(':doi', $newDoi,PDO::PARAM_STR);
    $stmt -> bindParam(':newVolume', $newVolume, PDO::PARAM_STR);
    $stmt -> bindParam(':newData', $newData,PDO::PARAM_STR);


$stmt ->execute();

    echo 'Deu certo';
}else{
    echo ' Erro a preparar consulta';
}
}catch (PDOException $e){
    echo 'Erro de conexão:' .$e->getMessage();
}
}
$db=null;
?>