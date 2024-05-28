<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta do valor do campo 'secaoAtual' para determinar de qual seção os dados foram submetidos
    $secaoAtual1 = $_POST['secaoAtual1'];
    $secaoAtual2 = $_POST['secaoAtual2'];

    // Configurações da conexão com o banco de dados
    $dsn = "host=$host port=$port dbname=$dbname user=$user password=$pass";
    $conn = pg_connect($dsn);

    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }

    // Iniciar transação
    pg_query($conn, 'BEGIN');

    try {
        if ($secaoAtual1) {
            // Coleta dos valores da primeira seção
            $autorCorr = $_POST['autorCorr'];
            $filiacaoCorr = $_POST['filiacaoCorr'];
            $email = $_POST['email'];
            $tipoTrabalho = $_POST['tipoTrabalho'];
            $armazenamento = $_POST['armazenamento'];
            $termo = isset($_POST['termo']) ? 1 : 0;
            $titulo = $_POST['titulo'];
            $periodico = $_POST['periodico'];
            $linkart = $_POST['linkart'];
            $doi = $_POST['doi'];
            $volume = $_POST['volume'];
            $data = $_POST['data'];
            $keywords = $_POST['keywords'];

            $sql1 = "INSERT INTO tabela1 (autorCorr, filiacaoCorr, email, tipo_trabalho, armazenamento, termo, titulo, periodico, linkart, doi, volume, data, keywords) 
                     VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11, $12, $13)";

            $result1 = pg_query_params($conn, $sql1, [
                $autorCorr, $filiacaoCorr, $email, $tipoTrabalho, $armazenamento, $termo, $titulo, $periodico, $linkart, $doi, $volume, $data, $keywords
            ]);

            if (!$result1) {
                throw new Exception("Erro ao inserir na tabela1: " . pg_last_error($conn));
            }
        }

        if ($secaoAtual2) {
            $caract = $_POST['caract'];
            $metut = $_POST['metut'];
            $proxys = isset($_POST['proxys']) ? $_POST['proxys'] : [];

            $sql2 = "INSERT INTO tabela2 (caract, metut, proxys) VALUES ($1, $2, $3)";
            $result2 = pg_query_params($conn, $sql2, [$caract, $metut, json_encode($proxys)]);

            if (!$result2) {
                throw new Exception("Erro ao inserir na tabela2: " . pg_last_error($conn));
            }

            if (isset($_FILES['tabelaDado']) && $_FILES['tabelaDado']['error'] == UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['tabelaDado']['tmp_name'];
                $fileName = $_FILES['tabelaDado']['name'];
                $fileContent = file_get_contents($fileTmpPath);

                if ($fileContent === false) {
                    throw new Exception("Erro ao ler o conteúdo do arquivo CSV.");
                }

                $sql3 = "INSERT INTO arquivos (nome_arquivo, conteudo) VALUES ($1, $2)";
                $result3 = pg_query_params($conn, $sql3, [$fileName, pg_escape_bytea($fileContent)]);

                if (!$result3) {
                    throw new Exception("Erro ao inserir na tabela arquivos: " . pg_last_error($conn));
                }
            } else {
                throw new Exception("Erro no upload do arquivo CSV: " . $_FILES['tabelaDado']['error']);
            }
        }

        // Commit da transação
        pg_query($conn, 'COMMIT');

        echo "Inserção realizada com sucesso!";
    } catch (Exception $e) {
        // Rollback em caso de erro
        pg_query($conn, 'ROLLBACK');
        echo $e->getMessage();
    }

    // Fechar a conexão
    pg_close($conn);
}
?>
