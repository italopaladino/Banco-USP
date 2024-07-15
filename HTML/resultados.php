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
<body id="page1">
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
<!-- COLUNA DA ESQUERDA -->
    <div class="flex-wrapper" style="background-color: grey;">
        <div class="filter-forms-result" style="background-color:rgb(202, 231, 204)">
            <div  class="filter-top-forms-result" style="background-color: cadetblue;">
                <span id="filter-forms-label">TÓPICOS DAS INFORMAÇÔES:</span>

            </div>

            <div class="correspondente" id="correspondente">
                <span class="correspondente"> Correspondente:</span>
            </div> </br>

            <div class="titulo-trab" id="titulo-trab">
                <span class="titulo-trab"> Título:</span>
            </div></br>
            <div class="periodico-trab" id="periodico-trab">
                <span class="periodico-trab"> Publicado em:</span>
            </div></br>
            <div class="doi-trab" id="doi-trab">
                <span class="doi-trab"> DOI: </span>
            </div></br>
            <div class="data-trab" id="data-trab">
                <span class="data-trab"> Data da publicacão: </span>
            </div></br></br>

            <div class="keyword-trab" id="keyword-trab">
                <span class="keyword-trab">Palavras chave/Keywords: </span>
            </div></br>

            <div class="coord-ponto" id="coord-ponto">
                <span class="coord-ponto"> Pontos de coletas: </span> 
            </div></br>
            <div class="proxy-trab" id="proxy-trab">
                <span class="proxy-trab"> Proxies Utilizados: </span> 
            </div></br>
            <div class="equip-trab" id="equip-trab">
                <span class="equip-trab"> Equipamento de coleta: </span> 
            </div></br>
            <div class="desc-met" id="desc-met">
                <span class="desc-met"> Descrição dos <u>Métodos:</u> </span> 
            </div></br>
            <div class="desc-met" id="desc-met">
                <span class="desc-met"> Descrição dos <u>Dados:</u> </span> 
            </div></br>
            <div class="tabela-trab" id="tabela-trab">
                <span class="tabela-trab"> Arquivo anexado: </span> 
            </div></br>

        </div>
     
<!-- COLUNA DA DIREITA-->
        <div class="results-consult-result" style="background-color:rgb(202, 231, 204)">
           
           
            <div class="result-consult-forms" style="background-color: cadetblue;">
                <span id="result-fomrs-result">RESULTADOS GERAL DE TUDO </span>
            </div>

            



            <div class="container">
                <div class="row">
                 <div id="ultimosartigos" class="table-responsive">
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
            $sql = "SELECT * FROM infogeral WHERE geralid = :id";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            $infogeral = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se há resultados
            if ($infogeral) {
                // Exibe os detalhes na página resultados.html

            echo "<div class='correspondente-dir' id='correspondente-dir'>" . htmlspecialchars($infogeral['correspondente']) . "</div>";
            echo "<div class='titulo-trab-dir' id='titulo-trab-dir'>" . htmlspecialchars($infogeral['titulo']) . "</div></br>";
            echo "<div class='periodico-trab-dir' id='periodico-trab-dir'>" . htmlspecialchars($infogeral['periodico']) . "</div></br>";
            echo "<div class='doi-trab-dir' id='doi-trab-dir'>" . htmlspecialchars($infogeral['doi']) . "</div></br>";
            echo "<div class='data-trab-dir' id='data-trab-dir'>" . htmlspecialchars($infogeral['data1']) . "</div></br></br>";
            echo "<div class='keyword-trab-dir' id='keyword-trab-dir'>" . htmlspecialchars($infogeral['keywords']) . "</div></br>";
                





            } else {
                echo "<p>Não foram encontrados registros com o ID: $id</p>";
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
                           
                            <!-- Os resultados da consulta serão exibidos aqui -->
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>











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
