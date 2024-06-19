<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta do valor do campo 'secaoAtual' para determinar de qual seção os dados foram submetidos
    $secaoAtual1 = $_POST['secaoAtual1'] ?? null;
    $secaoAtual2 = $_POST['secaoAtual2'] ?? null;

    // Conexão com o banco de dados
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }

    try {
        // Iniciar transação
        pg_query($conn, 'BEGIN');

        if ($secaoAtual1) {
            // Coleta dos valores da primeira seção
            $corr = $_POST['correspondente'];
            $filiacaoCorr = $_POST['filiacaoCorr'];
            $email = $_POST['email'];
            $tipoTrabalho = $_POST['tipoTrabalho'];
            $armazenamento = $_POST['armazenamento'];
            $termo = isset($_POST['termo']) ? 1 : 0;
            $titulo = $_POST['titulo'];
            $periodico = $_POST['periodico'];
            $linkart = $_POST['linkart'];
            $doi = $_POST['doi'];
            $data = $_POST['data'];
            $keywords = $_POST['keywords'];

            $sql1 = "INSERT INTO infogeral (correspondente, filiacaocorr, email, tipotrabalho, armazenamento, termo, titulo, periodico, linkart, doi, data, keywords) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12)";
            
            $result1 = pg_query_params($conn, $sql1, [
                $corr, $filiacaoCorr, $email, $tipoTrabalho, $armazenamento, $termo, $titulo, $periodico, $linkart, $doi, $data, $keywords
            ]);
 
            if (!$result1) {
                throw new Exception("Erro ao inserir na tabela1: " . pg_last_error($conn));
            }
        }
        
        if (isset($_POST['autor']) && isset($_POST['filiacao'])) {
            $autores = $_POST['autor'];
            $filiacoes = $_POST['filiacao'];
        
            // Verifique se os arrays têm o mesmo tamanho
            if (count($autores) !== count($filiacoes)) {
                throw new Exception("O número de autores e filiações não correspondem.");
            }
        
            // Prepare a consulta SQL
            $sql2 = 'INSERT INTO autores (autor, filiacao) VALUES ($1, $2)';
        
            foreach ($autores as $index => $autor) {
                $filiacao = $filiacoes[$index];
                
                // Execute a consulta para cada autor
                $result2 = pg_query_params($conn, $sql2, array($autor, $filiacao));
        
                if (!$result2) {
                    throw new Exception("Erro ao inserir na tabela autores: " . pg_last_error($conn));
                }
            }
        
            echo "Autores inseridos com sucesso!";
        } else {
            echo "Nenhum autor ou filiação foi enviado.";
        }




        if ($secaoAtual2) {
            $caract = $_POST['caract'];
            $metut = $_POST['metut'];
           

            $sql3 = "INSERT INTO caractdado (caract, metut) VALUES ($1, $2)";
            $result3 = pg_query_params($conn, $sql3, [$caract, $metut]);

            if (!$result3) {
                throw new Exception("Erro ao inserir na caractdado: " . pg_last_error($conn));
            }





            $multcore = isset($_POST['multcore']) ? 1 : 0;
            $piston = isset($_POST['piston']) ? 1 : 0;
            $gravcore = isset($_POST['gravcore']) ? 1 : 0;
            $drilli = isset($_POST['drilli']) ? 1 : 0;
            $gboxcore = isset($_POST['gboxcore']) ? 1 : 0;
            $compcore = isset($_POST['compcore']) ? 1 : 0;
            $boxcore = isset($_POST['boxcore']) ? 1 : 0;
            $corer = isset($_POST['corer']) ? 1 : 0;
            $outroequi= $_POST['outroEqui'];

            $sql4 = 'INSERT INTO equipcoleta (multcore, pinston, gravcore, drilli, gboxcore, compcore, boxcore, corer, outroEqui) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9)';
            $result4 = pg_query_params($conn, $sql4, [$multcore, $piston, $gravcore, $drilli, $gboxcore,$compcore, $boxcore,$corer,$outroequi]);

            if (!$result4){
                throw new Exception("Erro ao inserir a tabela proxy:". pg_last_error($conn));

            }
            $tsm = isset($_POST['TSM']) ? 1 : 0;
            $pp = isset($_POST['PP']) ? 1 : 0;
            $circ = isset($_POST['circulacao']) ? 1 : 0;
            $org = isset($_POST['org']) ? 1 : 0;
            $inorg = isset($_POST['inorg']) ? 1 : 0;
            $foramplan = isset($_POST['foramplan']) ? 1 : 0;
            $forambent = isset($_POST['forambent']) ? 1 : 0;
            $sealev = isset($_POST['sealev']) ? 1 : 0;
            $c02atm = isset($_POST['co2atm']) ? 1 : 0;
            $cobveg = isset($_POST['cobveg']) ? 1 : 0;
            $rainfall = isset($_POST['cobveg']) ? 1 : 0;
            $stratg = isset($_POST['stratg']) ? 1 : 0;
            $outroprox = $_POST['outroProx'];

            $sql5 = 'INSERT INTO proxys (tsm, pp, circocean, org, inorg, foramplt, forambent, sealev, co2, cobertveg, rainfall, estratigrafia, outprox) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13)';
            $result5 = pg_query_params($conn, $sql5, [$tsm, $pp, $circ,$org, $inorg,$foramplan, $forambent, $sealev, $c02atm, $cobveg, $rainfall,$stratg, $outroprox]);

            if (!$result5){
                throw new Exception("Erro ao inserir a tabela proxy:". pg_last_error($conn));

            }
           

            if (isset($_FILES['tabelaDado'])) {
                if ($_FILES['tabelaDado']['error'] == UPLOAD_ERR_OK) {
                    $fileTmpPath = $_FILES['tabelaDado']['tmp_name'];
                    $fileName = $_FILES['tabelaDado']['name'];
                    $fileContent = file_get_contents($fileTmpPath);

                    $sql6 = "INSERT INTO arquivos (nome_arquivo, conteudo) VALUES ($1, $2)";
                    $result6 = pg_query_params($conn, $sql6, [$fileName, pg_escape_bytea($fileContent)]);

                    if (!$result5) {
                        throw new Exception("Erro ao inserir na tabela arquivos: " . pg_last_error($conn));
                    }
                } else {
                    throw new Exception("Erro no Upload do arquivo CSV: " . $_FILES['tabelaDado']['error']);
                }
            } else {
                throw new Exception("Arquivo CSV não enviado.");
            }
        }





        pg_query($conn, 'COMMIT');

           
    }catch (Exception $e) {
        pg_query($conn, 'ROLLBACK');
        echo "<script> alert ('{$e->getMessage()}');</script>";
    }

    pg_close($conn);
}
?>