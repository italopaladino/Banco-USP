<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtendo os dados do formulário
    $secaoAtual1 = $_POST['secaoAtual1'] ?? null;

    $secaoAtual2 = $_POST['secaoAtual2'] ?? null;

    // Conexão com o banco de dados PostgreSQL
    $conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$pass");

    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }

    try {
        // Inicia a transação
        pg_query($conn, 'BEGIN');

        // Verifica se devemos inserir na tabela infogeral
        if ($secaoAtual1) {
            // Obtém os dados do formulário
            $corr = $_POST['correspondente'];
            $email = $_POST['email'];
            $tipoTrabalho = $_POST['tipoTrabalho'];
            $armazenamento = $_POST['armazenamento'];
            $termo = isset($_POST['termo']) ? 'TRUE' : 'FALSE';
            $titulo = $_POST['titulo'];
            $periodico = $_POST['periodico'];
            $linkart = $_POST['linkart'];
            $doi = $_POST['doi'];
            $data1 = $_POST['data1'];
            $keywords = $_POST['keywords'];

            // Preparando e executando a consulta SQL para inserir na tabela infogeral
            $sql1 = "INSERT INTO infogeral (correspondente, email, tipoTrabalho, armazenamento, termo, titulo, periodico, linkart, doi, data1, keywords) 
                     VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11)
                     RETURNING geralID";
            
            $result1 = pg_query_params($conn, $sql1, [
                $corr, $email, $tipoTrabalho, $armazenamento, $termo, $titulo, $periodico, $linkart, $doi, $data1, $keywords
            ]);

            // Verifica se a consulta foi bem-sucedida e obtém o ID do trabalho inserido
            if ($result1) {
                $row = pg_fetch_assoc($result1);
                $trabalhoID = $row['geralid'];

            } else {
                throw new Exception("Erro ao inserir na tabela infogeral: " . pg_last_error($conn));
            }
        } else {
            throw new Exception("Erro: secaoAtual1 não definido.");
        }

        // Loop através dos dados de autores e filiações enviados
        foreach ($_POST['autor'] as $key => $autor) {
            $autor = trim($autor);
            $filiacao = trim($_POST['filiacao'][$key]);
            
            $autor_upper = strtoupper($autor);
            $filiacao_upper = strtoupper($_POST['filiacao'][$key]);

            // Inserir o autor na tabela autores se ainda não existir
            $sql_autor = "INSERT INTO autores (autor) VALUES ($1) ON CONFLICT (autor) DO NOTHING RETURNING autID";
            $result_autor = pg_query_params($conn, $sql_autor, [$autor_upper]);

            // Obter o autorID (seja novo ou existente)
            if ($result_autor && pg_num_rows($result_autor) > 0) {
                $row_autor = pg_fetch_assoc($result_autor);
                $autorID = $row_autor['autid'];
            } else {
                $sql_get_autorid = "SELECT autid FROM autores WHERE autor = $1";
                $result_get_autorid = pg_query_params($conn, $sql_get_autorid, [$autor_upper]);
                $row_autor = pg_fetch_assoc($result_get_autorid);
                $autorID = $row_autor['autid'];
            }

            // Inserir a filiação na tabela filiacao se ainda não existir
            $sql_filiacao = "INSERT INTO filiacao (filiacao) VALUES ($1) ON CONFLICT (filiacao) DO NOTHING RETURNING filiacaoid";
            $result_filiacao = pg_query_params($conn, $sql_filiacao, [$filiacao_upper]);

            // Obter o filiacaoID (seja novo ou existente)
            if ($result_filiacao && pg_num_rows($result_filiacao) > 0) {
                $row_filiacao = pg_fetch_assoc($result_filiacao);
                $filiacaoID = $row_filiacao['filiacaoid'];
            } else {
                $sql_get_filiacaoid = "SELECT filiacaoid FROM filiacao WHERE filiacao = $1";
                $result_get_filiacaoid = pg_query_params($conn, $sql_get_filiacaoid, [$filiacao_upper]);
                $row_filiacao = pg_fetch_assoc($result_get_filiacaoid);
                $filiacaoID = $row_filiacao['filiacaoid'];
            }
                       
            // Inserir associação na tabela trabalhos_autores_filiacao
            $sql_trabalhos_autores = "INSERT INTO trabalhos_autores_filiacao (trabalhoid, autorid, filiacaoid, ordem) VALUES ($1, $2, $3, $4)";
            $result_trabalhos_autores = pg_query_params($conn, $sql_trabalhos_autores, [$trabalhoID, $autorID, $filiacaoID, $key]);

            // Verifica se as inserções foram bem-sucedidas
            if (!$result_trabalhos_autores) {
                throw new Exception("Erro ao inserir associação na tabela trabalhos_autores_filiacao.");
            }
     }

     if ($secaoAtual2) {
        if (
            isset($_POST['ID_amst']) &&
            isset($_POST['latitude']) &&
            isset($_POST['longitude']) &&
            isset($_POST['prof']) &&
            isset($_POST['recuperacao']) &&
            isset($_POST['data'])
        ) {
            foreach ($_POST['ID_amst'] as $key => $ID_amst) {
                // Verifica se todos os campos necessários estão presentes
                if (
                    isset($_POST['latitude'][$key]) &&
                    isset($_POST['longitude'][$key]) &&
                    isset($_POST['prof'][$key]) &&
                    isset($_POST['recuperacao'][$key]) &&
                    isset($_POST['data'][$key])
                ) {
                    // Limpa os valores dos campos
                    $ID_amst = trim($ID_amst);
                    $latitude = trim($_POST['latitude'][$key]);
                    $longitude = trim($_POST['longitude'][$key]);
                    $prof = trim($_POST['prof'][$key]);
                    $recuperacao = trim($_POST['recuperacao'][$key]);
                    $anoColeta = trim($_POST['data'][$key]);
    
                    // Prepara a consulta SQL
                    $sql_pontos = "INSERT INTO pontos_coleta (ID_amst, latitude, longitude, prof, recuperacao, data2, trabalhoid) VALUES ($1, $2, $3, $4, $5, $6,$7)";
                    $result_ponto = pg_query_params($conn, $sql_pontos, [$ID_amst, $latitude, $longitude, $prof, $recuperacao, $anoColeta, $trabalhoID]);
    
                    if (!$result_ponto) {
                        throw new Exception("Erro ao inserir na tabela pontos");
                    }
                } else {
                    throw new Exception("Dados incompletos para o índice $key");
                }
            }
        } else {
            throw new Exception("Campos de entrada ausentes");
        }
    }
    $TSM = isset($_POST['TSM']) ? 1 : 0;
    $PP = isset($_POST['PP']) ? 1 : 0;
    $circ = isset($_POST['circulacao']) ? 1 : 0;
    $org = isset($_POST['org']) ? 1 : 0;
    $inorg = isset($_POST['inorg']) ? 1 : 0;
    $foramplan = isset($_POST['foramplan']) ? 1 : 0;
    $forambent = isset($_POST['forambent']) ? 1 : 0;
    $sealev = isset($_POST['sealev']) ? 1 : 0;
    $co2atm = isset($_POST['co2atm']) ? 1 : 0;
    $cobveg = isset($_POST['cobveg']) ? 1 : 0;
    $rainfall = isset($_POST['rainfall']) ? 1 : 0;
    $stratg = isset($_POST['stratg']) ? 1 : 0;
    $outroProx = $_POST['outroProx'];

    $sql_prox = "INSERT INTO proxys (TSM, PP, circulacao, org, inorg, foramplan,forambent, sealev, co2atm, cobveg, rainfall, stratg, outroprox, trabalhoid)
    VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10, $11,$12,$13, $14)";
    $result_prox = pg_query_params($conn, $sql_prox,[$TSM, $PP,$circ, $org, $inorg, $foramplan, $forambent, $sealev, $co2atm, $cobveg, $rainfall, $stratg, $outroProx, $trabalhoID]);

    if (!$result_prox){
        throw new Exception("Erro ao inserir na tabela proxys");
    }

    $multcorer = isset($_POST['multcorer']) ? 1 : 0;
    $piston = isset($_POST['piston']) ? 1 : 0;
    $gravcorer = isset($_POST['gravcorer']) ? 1 : 0;
    $drilli = isset($_POST['drilli']) ? 1 : 0;
    $gboxcorer = isset($_POST['gboxcorer']) ? 1 : 0;
    $compcorer = isset($_POST['compcorer']) ? 1 : 0;
    $boxcorer = isset($_POST['boxcorer']) ? 1 : 0;
    $corer = isset($_POST['corer']) ? 1 : 0;
    $outroEqui = isset($_POST['outroEqui']) ? 1 : 0;

    $sql_equipamentos = "INSERT INTO equipcoleta (multcorer, piston, gravcorer,drilli, gboxcorer,compcorer, boxcorer, corer, outroEQui, trabalhoid)
    VALUES ($1, $2, $3, $4, $5, $6, $7, $8, $9, $10)";
    $result_equi = pg_query_params($conn, $sql_equipamentos,[$multcorer,$piston, $gravcorer,$drilli, $gboxcorer, $compcorer,$boxcorer, $corer, $outroEqui, $trabalhoID]);

    if (!$result_equi){
        throw new Exception("erro ao inserir na tabela equipamentos");

}

$carct = $_POST['caract'];
$metut = $_POST['metut'];

$sql_caract = "INSERT INTO caractDado (caract, metut, trabalhoid) VALUES ($1, $2, $3)";
$result_caract = pg_query_params($conn, $sql_caract,[$carct,$metut, $trabalhoID]);





// Verifica se o arquivo foi enviado sem erros
if (isset($_FILES['tabelaDado']) && $_FILES['tabelaDado']['error'] === UPLOAD_ERR_OK) {
    // Nome do arquivo temporário
    $csvFile = $_FILES['tabelaDado']['tmp_name'];

    // Conteúdo do arquivo CSV
    $conteudo = file_get_contents($csvFile);

    // Nome original do arquivo
    $nomeArquivo = $_FILES['tabelaDado']['name'];

    // Prepara a consulta SQL para inserir na tabela arquivos
    $sql_insert = "INSERT INTO arquivos (nome_arquivo, conteudo, trabalhoid) VALUES ($1, $2, $3)";
    $result = pg_query_params($conn, $sql_insert, [$nomeArquivo, $conteudo, $trabalhoID]);



    if ($result) {
        error_log("Arquivo CSV carregado e inserido na tabela arquivos com sucesso.");
    } else {
        error_log( "Erro ao inserir arquivo na tabela arquivos: " . pg_last_error($conn));
    }
} else {
    error_log("Erro no envio do arquivo CSV.");
}




        // Commit da transação
        pg_query($conn, 'COMMIT');
        
        echo "<script>alert('Dados inseridos com sucesso!');</script>";

    } catch (Exception $e) {
        // Rollback da transação em caso de erro
        pg_query($conn, 'ROLLBACK');
        echo "<script>alert('Erro: " . $e->getMessage() . "');</script>";
    }

    // Fechar a conexão
    pg_close($conn);
}
?>