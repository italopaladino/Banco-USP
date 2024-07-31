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
    <link href="../css/consulta.css" rel="stylesheet" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
                    <li class="nav-item"><a class="nav-link" href="consulta.php" onclick=closeNavbar()>Consulta</a></li>
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
    <div class="flex-wrapper">
        <div class="filter-forms" style="background-color:bisque;">
            <div class="filter-top-forms" style="background-color: cadetblue;">
                <span id="filter-forms-label">Filtros:</span>
            </div>
            <div class="search3">
                <input class="search3" type="text" placeholder="Search here..">
                <button><i class="bi bi-search"></i></button>
            </div>
            <br>
            <form class="form-filter">
                <h1 class="form-tip">Tipo de trabalho</h1>
                <div class="filtro-tipo" id="filtro-tipo">
                    <!-- deixar fixado -->
                </div>
                <h1 class="form-tip">Ano de Publicação</h1>
                <div id="filtro-ano-pub"></div>
                <!-- Lista de anos de publicação será carregada aqui -->
                <h1 class="form-tip">Ano de Coleta</h1>
                <!-- linkar com os anos que tem no banco deixar últimos 5 -->
                <div id="filtro-ano-coleta"></div>
                <h1 class="form-tip">Proxies Utilizados</h1>
                <div class="filtro-proxies" id="filtro-prox"></div>
                <h1 class="form-tip">Tipos de instrumentos</h1>
                <div id="filtro-equi" class="filtro-equi"></div>
                
            </form>

            <h1>Consulta de Registros</h1>

    <!-- Filtros -->
    <label for="yearFilter">Filtrar por Ano de Nascimento:</label>
    <input type="text" id="yearFilter" placeholder="Ex: 2000">

    <label for="vaccineFilter">Filtrar por Vacina:</label>
    <input type="text" id="vaccineFilter" placeholder="Ex: X">

    <button onclick="applyFilters()">Aplicar Filtros</button>

    <!-- Links de Resultados -->
    <div class="resultados">
        <!-- Os links serão preenchidos aqui -->
    </div>
        </div>
        

        <div class="results-consult" style="background-color:antiquewhite">
            <div class="result-consult-forms" style="background-color: cadetblue;">
                <span id="result-fomrs">RESULTADOS DAS BUSCAS</span>
            </div>
            <div class="container">
                <div class="row">
                    <div class="col">
                        <div id="ultimosartigos" class="table-responsive">
                            <!-- Os resultados da consulta serão exibidos aqui -->
                        </div>
                        <div id="loading" style="display:none;">Carregando...</div>
                        
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
    <script>
$(document).ready(function() {
    console.log("jQuery está funcionando.");

    // Função para carregar os filtros
    function carregarFiltros() {
        $.ajax({
            url: "../PHP/filtro-tipo.php",
            type: "GET",
            success: function(response) {
                $("#filtro-tipo").html(response);
            },
            error: function(xhr, status, error) {
                console.error("Erro ao consultar tipos:", status, error);
            }
        });

        $.ajax({
            url: "../PHP/filtro-ano-pub.php",
            type: "GET",
            success: function(response) {
                $("#filtro-ano-pub").html(response);

                // Adicionar evento de clique aos botões de ano
                $(".ano-button").click(function() {
                var ano = $(this).data("ano");
                console.log("Ano selecionado:", ano);  // Adicione esta linha
                carregarResultadosano(ano);
});
            },
            error: function(xhr, status, error) {
                console.error("Erro ao consultar ano de publicação:", status, error);
            }
        });

        $.ajax({
            url: "../PHP/filtro-ano-coleta.php",
            type: "GET",
            success: function(response) {
                $("#filtro-ano-coleta").html(response);
            },
            error: function(xhr, status, error) {
                console.error("Erro ao consultar ano de coleta:", status, error);
            }
        });

        $.ajax({
            url: "../PHP/filtro-prox.php",
            type: "GET",
            success: function(response) {
                $("#filtro-prox").html(response);
            },
            error: function(xhr, status, error) {
                console.error("Erro ao consultar proxies:", status, error);
            }
        });

        $.ajax({
            url: "../PHP/filtro-equi.php",
            type: "GET",
            success: function(response) {
                $("#filtro-equi").html(response);
            },
            error: function(xhr, status, error) {
                console.error("Erro ao consultar equipamentos:", status, error);
            }
        });
    }





    // Função para carregar os resultados
    
   // Função para carregar resultados com base no ano selecionado
function carregarResultadosano(ano) {
    $.ajax({
        url: "../PHP/consulta-ano-pub.php",
        type: "GET",
        data: { ano: ano },
        success: function(response) {
            $("#ultimosartigos").html(response);  // Atualiza a div com o id 'ultimosartigos'
        },
        error: function(xhr, status, error) {
            console.error("Erro ao consultar artigos:", status, error);
        }
    });
}

$(document).ready(function() {
    // Adiciona um listener de clique para cada link de ano
    $(document).on('click', '.filtro-ano-pub a', function(event) {
    event.preventDefault();  // Evita o comportamento padrão do link
    var ano = $(this).data('ano');  // Obtém o valor do ano
    carregarResultadosano(ano);  // Carrega os resultados via AJAX
});

$(document).ready(function() {
    var ano = localStorage.getItem('anoSelecionado');
    if (ano) {
        carregarResultadosano(ano);  // Carrega os resultados do ano armazenado
    }
});
});

    // Carregar filtros ao iniciar a página
    carregarFiltros();

    // Carregar resultados iniciais (opcional)
    carregarResultadosano();
});


        $(document).ready(function(){
            console.log("jQuery está funcionando.");

            // Consulta de artigos
            $.ajax({
                url: "../PHP/consulta-art-geral.php",
                type: "GET",
                success: function(response){
                    $("#ultimosartigos").html(response);
                },
                error: function(xhr, status, error) {
                    console.error("Erro ao consultar artigos:", status, error);
                }
            });
        });




        //tentativa de filtro por JS
        function loadLinks(records) {
    const resultadosDiv = document.querySelector('.ultimosartigos');
    resultadosDiv.innerHTML = ''; // Limpa os links

    records.forEach(record => {
        let link = document.createElement('a');
        link.className = 'link-pesq';
        link.href = `../HTML/resultados.php?id=${record.id}`;
        link.textContent = record.titulo;

        let br = document.createElement('br');
        resultadosDiv.appendChild(link);
        resultadosDiv.appendChild(br);
        resultadosDiv.appendChild(document.createElement('br'));
    });
}

function applyFilters() {
    const yearFilter = document.getElementById('yearFilter').value;
    const vaccineFilter = document.getElementById('vaccineFilter').value;

    let filteredRecords = allRecords;

    if (yearFilter) {
        filteredRecords = filteredRecords.filter(record => {
            return new Date(record.dataNascimento).getFullYear() == yearFilter;
        });
    }

    if (vaccineFilter) {
        filteredRecords = filteredRecords.filter(record => {
            return record.vacinas.includes(vaccineFilter);
        });
    }

    loadLinks(filteredRecords);
}

// Carregar a lista inicialmente com todos os registros
loadLinks(allRecords);


    </script>   
</body>
</html>
