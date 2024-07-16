<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>ProxyMar Data Base</title>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css"/>
    <link rel="icon" type="image/x-icon" href="../assets/mac.ico" />
    <link href="../css/submit.css" rel="stylesheet"/>
    <link href="../css/styles.css" rel="stylesheet" />
    
    <link href="../css/resultado.css" rel="stylesheet" />

    <script src="../js/add-script.js"></script>
    <script src="../js/script.js"></script>
</head>

   <!-- Navigation -->
   <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top" id="mainNav">
        <div class="container px-4">
            <div class="search1">
                <input style="left: 0%;" id="search1" type="text" name="search" placeholder="Search..">
                <button style="left: 0%;"><i class="bi bi-search"></i></button>
            </div>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation" id="navbarToggleBtn">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="../index.html" onclick=closeNavbar()>Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.html#last-issues" onclick=closeNavbar()>Últimos Artigos</a></li>
                    <li class="nav-item"><a class="nav-link" href="../index.html#contact" onclick=closeNavbar()>Contatos</a></li>
                    <li class="nav-item"><a class="nav-link" href="consulta.html" onclick=closeNavbar()>Consulta</a></li>
                    <li class="nav-item"><a class="nav-link" href="submit.html">Submissão de dados</a></li>
                    <li class="nav-item"><a class="nav-link" href="#" onclick="openLoginDialog(); closeNavbar()">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="novo-user.html" onclick=closeNavbar()>Sing in</a></li>
                </ul>
            </div>
        </div>
    </nav>
    
    <!-- LOGIN POR CAIXA DE DIALOGO -->
    <div id="loginDialogOverlay">
        <div id="loginDialog">
            <img src="../assets/avatar.jpeg" alt="Avatar" class="avatar">
            <br><br>
            <h2>Login</h2><br>
            <form action="../PHP/login.php" method="post">
                <label for="username">Nome:</label><br>
                <input type="text" id="nome" name="nome" required autofocus><br>
                <label for="password">Senha:</label><br>
                <input type="password" id="senha" name="senha" required><br>
                <button class="lgbttn" type="submit">Login</button><br>
            </form>
            <button class="lgbttn" onclick="closeLoginDialog()">Fechar</button>
        </div>
    </div>






    <!-- Pagina de consulta dos dados -->
  <?php
    // Verifica se o parâmetro 'id' foi passado via GET
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        // Inclui o arquivo de configuração do banco de dados
        require_once '../PHP/config.php';

        try {
            // Conexão ao banco de dados usando PDO
            $pdo = new PDO($dsn, $user, $pass, [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        
            // Prepara e executa a consulta SQL com o ID fornecido
            $sql = "
                SELECT 
                    infogeral.correspondente,
                    infogeral.email,
                    infogeral.tipoTrabalho,
                    infogeral.armazenamento,
                    infogeral.termo,
                    infogeral.titulo,
                    infogeral.periodico,
                    infogeral.linkart,
                    infogeral.doi,
                    infogeral.data1,
                    infogeral.keywords,
                    caractDado.caract,
                    caractDado.metut,
                    arquivos.nome_arquivo,
                    arquivos.conteudo,
                    arquivos.uploaded_at,
                    proxys.TSM,
                    proxys.PP,
                    proxys.circulacao,
                    proxys.org,
                    proxys.inorg,
                    proxys.foramplan,
                    proxys.forambent,
                    proxys.seaLev,
                    proxys.co2atm,
                    proxys.cobveg,
                    proxys.rainfall,
                    proxys.stratg,
                    proxys.outroprox
                FROM infogeral
                LEFT JOIN caractDado ON infogeral.geralID = caractDado.trabalhoId
                LEFT JOIN arquivos ON infogeral.geralID = arquivos.trabalhoID
                LEFT JOIN proxys ON infogeral.geralID = proxys.trabalhoID
                WHERE infogeral.geralID = :id";
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $infogeral = $stmt->fetchAll(PDO::FETCH_ASSOC);
        
            // Verifica se há resultados
            if (!empty($infogeral)) {
                foreach ($infogeral as $row) {
                    // Exibe os detalhes na página resultados.html
                    echo "<div id='principal1' style='background-color:grey'><span id='principal1'> RESULTADO DA PESQUISA </span></div>"; // DIV PRINCIPAL
                    
                    echo "<div class='principal2'>"; // DIV SECUNDÁRIA
        
                    echo "<div class='linha' id='coluna-esq-dir'>"; // div corr
                    echo "<div class='coluna' id='colun-esq'><span class='colun-esq'> Correspondente:</span></div>";
                    echo "<div class='coluna' id='colun-dir'>" . htmlspecialchars($row['correspondente']) . "&nbsp;&nbsp; <i>(" . htmlspecialchars($row['email']) . ")</i></div>";
                    echo "</div>"; // div corr
                    
                    echo "<div class='linha' id='coluna-esq-dir'>"; // div tit
                    echo "<div class='coluna' id='colun-esq'><span class='colun-esq'> Título:</span></div>";
                    echo "<div class='coluna' id='colun-dir'>" . htmlspecialchars($row['titulo']) . "</div>";
                    echo "</div>"; // div tit
        
                    echo "<div class='linha' id='coluna-esq-dir'>"; // tipo
                    echo "<div class='coluna' id='colun-esq'><span class='colun-esq'> Tipo de trabalho/ Armazenamento:</span></div>";
                    echo "<div class='coluna' id='colun-dir'>" . htmlspecialchars($row['tipotrabalho']) . "&nbsp;&nbsp; (" . htmlspecialchars($row['armazenamento']) . ")</div>";
                    echo "</div>"; // tipo
                    
                    echo "<div class='linha' id='coluna-esq-dir'>"; // periódico
                    echo "<div class='coluna' id='colun-esq'><span class='colun-esq'> Periódico:</span></div>";
                    echo "<div class='coluna' id='colun-dir'>" . htmlspecialchars($row['periodico']) . "&nbsp;&nbsp; <a href='" . htmlspecialchars($row['linkart']) . "'> Link para o artigo </a></div>";
                    echo "</div>"; // periódico
                    
                    echo "<div class='linha' id='coluna-esq-dir'>"; // doi
                    echo "<div class='coluna' id='colun-esq'><span class='colun-esq'> DOI:</span></div>";
                    echo "<div class='coluna' id='colun-dir'> <a href='https://doi.org/" . htmlspecialchars($row['doi']) . "'>" . htmlspecialchars($row['doi']) . "</a></div>";
                    echo "</div>"; // doi
                    
                    echo "<div class='linha' id='coluna-esq-dir'>"; // data
                    echo "<div class='coluna' id='colun-esq'><span class='colun-esq'> Data da publicação: </span></div>";
                    echo "<div class='coluna' id='colun-dir'>" . htmlspecialchars($row['data1']) . "</div>";
                    echo "</div>"; // data
                    
                    echo "<div class='linha' id='coluna-esq-dir'>"; // keywords
                    echo "<div class='coluna' id='colun-esq'><span class='colun-esq'> Palavras-chave:</span></div>";
                    echo "<div class='coluna' id='colun-dir'>" . htmlspecialchars($row['keywords']) . "</div>";
                    echo "</div>"; // keywords
        
                    echo "<div class='linha' id='coluna-esq-dir'>"; // proxys
                    echo "<span id='principal3'>Proxys analisados:</span>";
                    echo "</div>"; // linha de proxies
                    
                    $proxys = [];
                    if ($row['tsm']) $proxys[] = "Temperatura da Superfície do Mar";
                    if ($row['pp']) $proxys[] = "Produção Primária";
                    if ($row['circulacao']) $proxys[] = "Circulação";
                    if ($row['org']) $proxys[] = "Orgânico";
                    if ($row['inorg']) $proxys[] = "Inorgânico";
                    if ($row['foramplan']) $proxys[] = "Foraminífero Planctônico";
                    if ($row['forambent']) $proxys[] = "Foraminífero Bentônico";
                    if ($row['sealev']) $proxys[] = "Nível do Mar";
                    if ($row['co2atm']) $proxys[] = "CO2 Atmosférico";
                    if ($row['cobveg']) $proxys[] = "Cobertura Vegetal";
                    if ($row['rainfall']) $proxys[] = "Precipitação";
                    if ($row['stratg']) $proxys[] = "Estratigrafia";
                    if ($row['outroprox']) $proxys[] = htmlspecialchars($row['outroprox']);
                    
                    echo "<div class='linha' id='coluna-esq-dir'>"; // prox
                    echo "<div class='coluna' id='colun-esq'><span class='colun-esq'> Proxies utilizados: </span></div>";
                    echo "<div class='coluna' id='colun-dir'>" . implode(", ", $proxys) . "</div>"; // Exibe os proxies em uma linha
                    echo "</div>"; // prox
        
                    echo "</div>"; // DIV SECUNDÁRIA
                    echo "</div>"; // DIV PRINCIPAL
                }
            } else {
                echo "<p>Nenhum registro encontrado para o ID: $id</p>";
            }
        } catch (PDOException $e) {
            echo "Erro: " . $e->getMessage();
        
        } finally {
            // Fecha a conexão com o banco de dados
            if ($pdo) {
                $pdo = null;
            }
        }
    } else {
        echo "<p>ID não especificado.</p>";
    }
    ?>
                           
            



    <!-- Footer -->
    <footer id="contact" class="py-5 bg-dark" style="position: relative;">
        <div class="social">
            <p class="text-white">Copyright &copy; Italo Paladino 2024</p>
            <br><br>
            <a href="https://www.instagram.com/proxymar_iousp/" target="_blank" class="bi bi-instagram"></a>
            <a href="https://sites.usp.br/proxymar/sobre//" target="_blank" class="bi bi-globe2"></a>
            <a href="mailto:italopaladino22@gmail.com" target="_blank" class="bi bi-envelope"></a>
        </div>
    </footer>
    







    <!-- Bootstrap core JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</body>
</html>
