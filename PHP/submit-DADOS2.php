<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Obtendo os dados do formulário
    $secaoAtual1 = $_POST['secaoAtual1'] ?? null;

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