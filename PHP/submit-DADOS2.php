<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $secaoAtual1 = $_POST['secaoAtual1'] ?? null;
    $secaoAtual2 = $_POST['secaoAtual2'] ?? null;

    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }

    try {
        pg_query($conn, 'BEGIN');

        $trabalhoID = null;

        
        if ($secaoAtual1) {
            $corr = $_POST['correspondente'];
            $email = $_POST['email'];
            $tipoTrabalho = $_POST['tipoTrabalho'];
            $armazenamento = $_POST['armazenamento'];
            $termo = isset($_POST['termo']) ? 'TRUE' : 'FALSE';
            $titulo = $_POST['titulo'];
            $periodico = $_POST['periodico'];
            $linkart = $_POST['linkart'];
            $doi = $_POST['doi'];
            
            $data = $_POST['data1'];

            // Verificar se a data é válida
            if (!strtotime($data)) {
                throw new Exception("Data inválida: $data");
            }
            
            // Remover a conversão strtotime(), pois a data já está no formato adequado
            $dataFormatada = date('Y-m-d', strtotime($data));
            
            // Agora $dataFormatada contém a data no formato 'YYYY-MM-DD'



            

            $keywords = $_POST['keywords'];

            // Preparando e executando a consulta SQL
            $sql1 = "INSERT INTO infogeral (correspondente, email, tipotrabalho, armazenamento, termo, titulo, periodico, linkart, doi, data1, keywords) VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11) RETURNING geralID";
            
            $result1 = pg_query_params($conn, $sql1, [
                $corr, $email, $tipoTrabalho, $armazenamento, $termo, $titulo, $periodico, $linkart, $doi, $data, $keywords
            ]);

            // Verificando se a consulta foi bem-sucedida
            if (!$result1) {
                throw new Exception("Erro ao inserir na tabela infogeral: " . pg_last_error($conn));
            }

            $row = pg_fetch_assoc($result1);
            $trabalhoID = $row['geralID'];
        }
        
        if (isset($_POST['autor']) && isset($_POST['filiacao'])) {
            $autores = $_POST['autor'];
            $filiacoes = $_POST['filiacao'];

            if (!$trabalhoID) {
                throw new Exception("O ID do trabalho não foi definido.");
            }

            if (count($autores) !== count($filiacoes)) {
                throw new Exception("O número de autores e afiliações não correspondem.");
            }

            foreach ($autores as $index => $autor) {
                $filiacao = $filiacoes[$index];

                // Verifique se o autor já existe
                $sqlCheckAutor = 'SELECT autID FROM autores WHERE autor = $1';
                $resultCheckAutor = pg_query_params($conn, $sqlCheckAutor, array($autor));

                if (!$resultCheckAutor) {
                    throw new Exception("Erro ao verificar a existência do autor: " . pg_last_error($conn));
                }

                if (pg_num_rows($resultCheckAutor) > 0) {
                    // Se o autor já existe, obtenha o ID
                    $row = pg_fetch_assoc($resultCheckAutor);
                    $autorID = $row['autID'];
                } else {
                    // Se o autor não existe, insira o autor
                    $sqlInsertAutor = 'INSERT INTO autores (autor) VALUES ($1) RETURNING autID';
                    $resultInsertAutor = pg_query_params($conn, $sqlInsertAutor, array($autor));

                    if (!$resultInsertAutor) {
                        throw new Exception("Erro ao inserir na tabela autores: " . pg_last_error($conn));
                    }

                    $row = pg_fetch_assoc($resultInsertAutor);
                    $autorID = $row['autID'];
                }

                // Verifique se a filiação já existe
                $sqlCheckFiliacao = 'SELECT filiacaoID FROM filiacao WHERE filiacao = $1';
                $resultCheckFiliacao = pg_query_params($conn, $sqlCheckFiliacao, array($filiacao));

                if (!$resultCheckFiliacao) {
                    throw new Exception("Erro ao verificar a existência da filiação: " . pg_last_error($conn));
                }

                if (pg_num_rows($resultCheckFiliacao) > 0) {
                    // Se a filiação já existe, obtenha o ID
                    $row = pg_fetch_assoc($resultCheckFiliacao);
                    $filiacaoID = $row['filiacaoID'];
                } else {
                    // Se a filiação não existe, insira a filiação
                    $sqlInsertFiliacao = 'INSERT INTO filiacao (filiacao) VALUES ($1) RETURNING filiacaoID';
                    $resultInsertFiliacao = pg_query_params($conn, $sqlInsertFiliacao, array($filiacao));

                    if (!$resultInsertFiliacao) {
                        throw new Exception("Erro ao inserir na tabela filiacao: " . pg_last_error($conn));
                    }

                    $row = pg_fetch_assoc($resultInsertFiliacao);
                    $filiacaoID = $row['filiacaoID'];
                }

                // Associe o autor ao trabalho
                $sqlAssocTrabalhoAutor = 'INSERT INTO trabalhos_autores (trabalhoID, autorID, ordem) VALUES ($1, $2, $3)';
                $resultAssocTrabalhoAutor = pg_query_params($conn, $sqlAssocTrabalhoAutor, array($trabalhoID, $autorID, $index + 1));

                if (!$resultAssocTrabalhoAutor) {
                    throw new Exception("Erro ao inserir na tabela trabalhos_autores: " . pg_last_error($conn));
                }

                // Associe o autor à filiação
                $sqlAssocAutorFiliacao = 'INSERT INTO autores_filiacoes (autorID, filiacaoID) VALUES ($1, $2)';
                $resultAssocAutorFiliacao = pg_query_params($conn, $sqlAssocAutorFiliacao, array($autorID, $filiacaoID));

                if (!$resultAssocAutorFiliacao) {
                    throw new Exception("Erro ao inserir na tabela autores_filiacoes: " . pg_last_error($conn));
                }
            }
        }

        if ($secaoAtual2) {
            if (
                isset($_POST['ID_amst']) && isset($_POST['latitude']) && isset($_POST['longitude']) && 
                isset($_POST['prof']) && isset($_POST['recuperacao']) && isset($_POST['data'])
            ) {
                $ID_amst = $_POST['ID_amst'];
                $latitude = $_POST['latitude'];
                $longitude = $_POST['longitude'];
                $prof = $_POST['prof'];
                $recuperacao = $_POST['recuperacao'];
                $data = $_POST['data2'];
        
                if (
                    count($ID_amst) !== count($latitude) || count($latitude) !== count($longitude) ||
                    count($longitude) !== count($prof) || count($prof) !== count($recuperacao) ||
                    count($recuperacao) !== count($data)
                ) {
                    throw new Exception("O número de elementos nos arrays não correspondem.");
                }
        
                $sql3 = 'INSERT INTO pontos_coleta (ID_amst, latitude, longitude, prof, recuperacao, data, trabalhoID) VALUES ($1, $2, $3, $4, $5, $6, $7)';
        
                foreach ($ID_amst as $index => $id) {
                    $lat = $latitude[$index];
                    $long = $longitude[$index];
                    $profundidade = $prof[$index];
                    $rec = $recuperacao[$index];
                    $datacoleta = $data[$index];
        
                    $result3 = pg_query_params($conn, $sql3, array($id, $lat, $long, $profundidade, $rec, $datacoleta, $trabalhoID));
        
                    if (!$result3) {
                        throw new Exception("Erro ao inserir na tabela pontos_coleta: " . pg_last_error($conn));
                    }
                }
            }
        }

        // Aqui estão as outras partes do seu código que foram omitidas para brevidade
        
        pg_query($conn, 'COMMIT');
        echo "<script> alert ('Dados inseridos com sucesso!');</script>";

    } catch (Exception $e) {
        pg_query($conn, 'ROLLBACK');
        echo "<script> alert ('" . $e->getMessage() . "');</script>";
    }

    pg_close($conn);
}

?>