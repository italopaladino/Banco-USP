function abrirPDF() {
    var url = "../assets/termo.pdf";
    window.open(url, "_blank", "toolbar=yes,scrollbars=yes,resizable=yes,top=100,left=100,width=600,height=600");
}

        
document.addEventListener('keydown',handleKeyPress);

function handleKeyPress(event1, dialogAberto) {
    // Verificar se a tecla pressionada é a tecla "Esc" (código 27)
    if (dialogAberto){

    }
    if (event1.keyCode === 27) {
        closeLoginDialog();
    }
}


document.addEventListener('keydown', keysub);
    // Verificar se estamos na página "submit.html"
    function keysub(event){
    var paginaSubmit = verifPag();
    if (paginaSubmit) {
        // Verificar as teclas de avanço específicas para "submit.html"
        if (event.keyCode === 36) { //home
            proximaPagina();  
        } else if (event.keyCode === 35) { //end
            paginaAnterior();
        } else if (event.keyCode === 192) { // '
            exibirResumo();
            exibirDADOS();
        }
    }
}

// Função para verificar se a página atual é "submit.html"
function verifPag() {
    var paginaAtual = window.location.href;
    return paginaAtual.includes("submit.html");
}

//fechar barra de navegação 
function closeNavbar() {
        // Fecha o menu de navegação se estiver aberto
        var navbarResponsive = document.getElementById('navbarResponsive');
        if (navbarResponsive.classList.contains('show')) {
            var navbarToggleBtn = document.getElementById('navbarToggleBtn');
            navbarToggleBtn.click(); // Simula o clique para fechar o menu
        }
    }






//GET THE MODAL (W3-SCHOOL)

var modal = document.getElementById('lg3');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}





// alerta para não funcionar 
function n(){
    window.alert('nao mexe aqui')
}







// SCRIPT PARA PAGINA DE INDEX - LOGIN - TECLA ESC
function openLoginDialog() {
    document.getElementById('loginDialogOverlay').style.display = 'flex';
    document.body.classList.add('dialog-open');
    dialogAberto = true;
    document.addEventListener('keydown', handleKeyPress);
    }

function closeLoginDialog() {
    document.getElementById('loginDialogOverlay').style.display = 'none';
    document.body.classList.remove('dialog-open');
    dialogAberto=false;
}

function performLogin() {
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    // Adicione aqui a lógica de verificação de login em JavaScript
    // Exemplo simples: usuário "admin" e senha "password"
    
    if ($user && password_verify($senha, $user ['senha_hash'])) {
        alert('Login bem-sucedido!');
        closeLoginDialog();
    } else {
        alert('Login falhou! Verifique suas credenciais.');
    }

    return false; // Impede o envio do formulário tradicional
}


                  
var contadorAutores = 0;

function adicionarAutor() {
    // Container onde os campos de autor serão adicionados
    var container = document.getElementById("autoresContainer");
    
    // Criar um novo contêiner para o autor
    var novoAutorContainer = document.createElement("div");
    novoAutorContainer.className = "autor-campo";
    novoAutorContainer.id = "autorContainer" + contadorAutores;
    
    // Criar novo campo de input para o nome
    var novoCampoNome = document.createElement("input");
    novoCampoNome.type = "text";
    novoCampoNome.className = "coautor";
    novoCampoNome.name = "coAutor" + contadorAutores; // Use um array para coletar vários valores
    novoCampoNome.placeholder = "Nome Completo";
    novoCampoNome.style.width = "49%";
    novoCampoNome.style.marginRight = "4.8px";
    
    // Criar novo campo de input para a filiação
    var novoCampoFiliacao = document.createElement("input");
    novoCampoFiliacao.type = "text";
    novoCampoFiliacao.className = "cofiliacao";
    novoCampoFiliacao.name = "filiaça2" + contadorAutores;
    novoCampoFiliacao.placeholder = "Filiação";
    novoCampoFiliacao.style.width = "49%";
    
    // Adicionar os novos campos ao contêiner do autor
    novoAutorContainer.appendChild(novoCampoNome);
    novoAutorContainer.appendChild(novoCampoFiliacao);
    
    // Adicionar o contêiner do autor ao contêiner principal
    container.appendChild(novoAutorContainer);

    container.appendChild(document.createElement("br"));
    
    // Incrementar o contador de autores
    contadorAutores++;  
}
                
                    
                    function deletarAutor() {
                        var container = document.getElementById("autoresContainer");
                        
                        // Verifica se há mais de três campos de autor para excluir e pelo menos um autor deve permanecer
                        if (container.children.length > 0) {
                            // Remove os três últimos filhos do container
                            for (var i = 0; i < 2; i++) {
                                var ultimoAutor = container.lastChild;

                                container.removeChild(ultimoAutor);
                            }
                    
                            // Decrementa o contador de autores
                            contadorAutores--;
                            
                        } else {
                            // Se houver menos de três campos de autor, exiba um alerta informando que pelo menos um autor deve ser mantido
                            window.alert(" Não existe mais campos para serem removidos ");
                        }
                    }


                    function removerTODOSAutores() {
                        var container = document.getElementById("autoresContainer");
                        while (container.lastChild) {
                            container.removeChild(container.lastChild);                          
                        }
                        contadorAutores=0; // Resetar o contador

                        setTimeout(function() { //timeout, é o tempo pra executar alguma coisa antes que o alert apreça
        window.alert("Todas as linhas removidas!!");
    }, 0);
}
                    



// CAMPO PARA ADICIONAR COORDENADAS MANUALMENTE 

var coordenadas=0 //variavel globar para controlar numero de autores
function adicionarCoordenadas() {
                        // Container onde os campos de autor serão adicionados
                    
                        var container = document.getElementById("coordenadas");
                        
                        var novoCoordenadas = document.createElement("div");

                        novoCoordenadas.className = "coordenadas-campo";
                        novoCoordenadas.id="coordenadas" + coordenadas;
                        


            
                        // Criar novos elementos de input
                        var novoID = document.createElement("input");
                        novoID.type = "text";
                        novoID.className="ID1";
                        novoID.name = "ID1" + coordenadas ; // Use um array para coletar vários valores
                        novoID.placeholder = "ID";
                        novoID.style.width = "10%";
                        novoID.style.marginRight = "4.8px";
                        novoID.maxLength=10;
                    
                        var novolatitude = document.createElement("input");
                        novolatitude.type = "text";
                        novolatitude.className = "lat1";
                        novolatitude.name = "lat1" + coordenadas;
                        novolatitude.placeholder = "Latitude:   -YY.YYYYY";
                        novolatitude.style.width = "20%";
                        novolatitude.style.marginRight = "4.8px";
                        novolatitude.maxLength=10;

                        var novolongitude = document.createElement("input");
                        novolongitude.type = "text";
                        novolongitude.className = "long1";
                        novolongitude.name = "longitude" + coordenadas;
                        novolongitude.placeholder = "Longitude:   -YY.YYYYY";
                        novolongitude.style.width = "20%";
                        novolongitude.style.marginRight = "4.8px";
                        novolongitude.maxLength=10;

                        var novoProf = document.createElement("input");
                        novoProf.type = "text";
                        novoProf.className="prof1";
                        novoProf.name = "prof1" + coordenadas ; // Use um array para coletar vários valores
                        novoProf.placeholder = "Profundidade";
                        novoProf.style.width = "8%";
                        novoProf.style.marginRight = "4.8px";
                        novoProf.maxLength=10;

                        var novoRecSed = document.createElement("input");
                        novoRecSed.type = "number";
                        novoRecSed.className="RecSed1";
                        novoRecSed.name = "RecSed1" + coordenadas ; // Use um array para coletar vários valores
                        novoRecSed.placeholder = "Recuperação Sedimentar";
                        novoRecSed.style.width = "20%";
                        novoRecSed.style.marginRight = "4.8px";
                        
                        novoRecSed.maxLength=10;

                        var novoAnoCol = document.createElement("input");
                        var valorOriginal = document.getElementById("anoColeta").value;

                        novoAnoCol.type = "date";
                        novoAnoCol.className="anoColeta1";
                        novoAnoCol.name = "anoColeta1" + coordenadas ; // Use um array para coletar vários valores
                        novoAnoCol.placeholder = "Ano da coleta";
                        novoAnoCol.style.width = "10%";
                        novoAnoCol.style.marginRight = "4.8px";
                        novoAnoCol.maxLength=10;
                        novoAnoCol.value=valorOriginal;
                                                

            
                             
                               
                        // Adicionar os novos campos ao container
                        container.appendChild(novoID);
                        container.appendChild(novolatitude);
                        container.appendChild(novolongitude);
                        container.appendChild(novoProf);
                        container.appendChild(novoRecSed);
                        container.appendChild(novoAnoCol);



                 
                        container.appendChild(document.createElement("br"));
                        container.appendChild(document.createElement("br"));
                                      
                    coordenadas++;                               
                    }
                
                    
                    function deletarCoordenadas() {
                        var container = document.getElementById("coordenadas");
                        
                        // Verifica se há mais de três campos de autor para excluir e pelo menos um autor deve permanecer
                        if (container.children.length > 8) {
                            // Remove últimos filhos do container
                            for (var i = 0; i < 7; i++) {
                                var ultimaCoord = container.lastChild;
                                container.removeChild(ultimaCoord);
                            }
                    
                            // Decrementa o contador de autores
                            coordenadas--;
                        } else {
                            // Se houver menos um campos pontos, exiba um alerta informando que pelo menos um autor deve ser mantido
                            window.alert("Ao menos um ponto precisa ser inserido");
                        }
                    }

                    function removerTODAScoordenadas() {
                        var container = document.getElementById("coordenadas");
                        if (container.children.length > 8) {
                            // Remove todos os filhos do container exceto os primeiros 8
                            while (container.children.length > 8) {
                                container.removeChild(container.lastChild);
                            }
                            coordenadas = 0; // Resetar o contador
                    
                            setTimeout(function() { //timeout, é o tempo pra executar alguma coisa antes que o alert apreça
                                window.alert("Todas as linhas removidas!!");
                            }, 0);
                        } else {
                            window.alert("Não há coordenadas adicionadas para remover!");
                        }
                    }

// SCRIPT PARA PASSAR AS PAFINAS DO FORMULÁRIO SUBMIT.HTML
 let currentPage = 1;

            function proximaPagina() {
              // Validação ou lógica adicional pode ser adicionada aqui
        
              // Oculta a seção atual
              document.getElementById(`section${currentPage}`).classList.remove('active');
        
              // Atualiza a página atual
              currentPage++;
        
              // Exibe a próxima seção
              document.getElementById(`section${currentPage}`).classList.add('active');
            }
        
            function paginaAnterior() {
              // Validação ou lógica adicional pode ser adicionada aqui
        
              // Oculta a seção atual
              document.getElementById(`section${currentPage}`).classList.remove('active');
        
              // Atualiza a página atual
              currentPage--;
        
              // Exibe a seção anterior
              document.getElementById(`section${currentPage}`).classList.add('active');
            }
        
 
            



 // pagina de LOGIN ---  funções do botões
                    function registro() {
                        window.location.href='novo-user.html'
                    }
                    function inicio(){
                        window.location.href='index.html'
                    }





// resumo da pagina no final SUBMIT--


function exibirResumo() {
    var summary1 = document.getElementById("summary-1");
    var resumo = "";

    // Recuperar os valores dos campos do formulário
    var autorCorrValue = document.getElementById("autorCorr").value;
    resumo += "<p" + (autorCorrValue ? '' : ' class="texto-vermelho"') + "><strong>Autor Correspondente:</strong> " + autorCorrValue + "</p>";

    var filiacaoValue = document.getElementById("filiacaoCorr").value;
    resumo += "<p" + (filiacaoValue ? '' : ' class="texto-vermelho"') + "><strong>Filiação:</strong> " + filiacaoValue + "</p>";

    var emailCorr = document.getElementById("email").value;
    resumo += "<p" + (emailCorr ? '' : ' class="texto-vermelho"') + "><strong>E-mail:</strong> " + emailCorr + "</p>";

    var tipoTrabalho = document.getElementById("tipoTrabalhoSelecao").value;
    resumo += "<p" + (tipoTrabalho ? '' : ' class="texto-vermelho"') + "><strong>Tipo de trabalho escolhido:</strong> " + tipoTrabalho + "</p>";

    var armazenamentoSel = document.getElementById("armazenamentoSelecao").value;
    resumo += "<p" + (armazenamentoSel ? '' : ' class="texto-vermelho"') + "><strong>Como deseja armazenar os dados? </strong>" + armazenamentoSel + "</p>";

    var titulo = document.getElementById("titulo").value;
    resumo += "<p" + (titulo ? '' : ' class="texto-vermelho"') + "><strong>Título:</strong> " + titulo + "</p>";

    // Adicionar informações dos coautores
    for (var i = 0; i < contadorAutores; i++) {
        var coAutorNome = document.getElementsByClassName("coautor")[i].value;
        var coAutorFiliacao = document.getElementsByClassName("cofiliacao")[i].value;
        resumo += "<p><strong>Co-Autor:</strong> " + coAutorNome + " (" + coAutorFiliacao + ")</p>";
    }

    var periodico = document.getElementById("periodico").value;
    resumo += "<p" + (periodico ? '' : ' class="texto-vermelho"') + "><strong>Nome do Periódico:</strong> " + periodico + "</p>";

    var linkart = document.getElementById("linkart").value;
    resumo += "<p" + (linkart ? '' : ' class="texto-vermelho"') + "><strong>Link para o Artigo:</strong> " + linkart + "</p>";

    var doi1 = document.getElementById("doi").value;
    resumo += "<p" + (doi1 ? '' : ' class="texto-vermelho"') + "><strong>DOI:</strong> " + doi1 + "</p>";

    var datap = document.getElementById("data").value;
    resumo += "<p" + (datap ? '' : ' class="texto-vermelho"') + "><strong>Data da publicação:</strong> " + datap + "</p>";

    var keywords1 = document.getElementById("keywords").value;
    resumo += "<p" + (keywords1 ? '' : ' class="texto-vermelho"') + "><strong>Palavras-Chave:</strong> " + keywords1 + "</p>";

    // Exibir o resumo no elemento summary1
    summary1.innerHTML = resumo;
}




function exibirDADOS() {
    var summary2 = document.getElementById("summary-2");
    var resumo = "";

    // Adicionar informações do ponto 1
    resumo += "<p><strong>Ponto:</strong> 1 ID: " + document.getElementById("ID").value + " Latitude: " + document.getElementById("lat").value + " Longitude: " + document.getElementById("long").value + 
    " Profundidade: " + document.getElementById("prof").value + " Recuperação: " + document.getElementById("RecSed").value + " Data da Coleta: " + document.getElementById("anoColeta").value + "</p>";

    // Adicionar informações dos pontos adicionais
    for (var i = 0; i < coordenadas; i++) {
        var ID = document.getElementsByClassName("ID1")[i].value;
        var latitude = document.getElementsByClassName("lat1")[i].value;
        var longitude = document.getElementsByClassName("long1")[i].value;
        var prof = document.getElementsByClassName("prof1")[i].value;
        var RecSed = document.getElementsByClassName("RecSed1")[i].value;
        var anoColeta = document.getElementsByClassName("anoColeta1")[i].value;

        resumo += "<p><strong>Ponto:</strong> " + (i + 2) + " ID: " + ID + " Latitude: " + latitude + " Longitude: " + longitude + 
        " Profundidade: " + prof + " Recuperação: " + RecSed + " Data da Coleta: " + anoColeta + "</p>";
    }

    var caract = document.getElementById("caract").value;
    resumo += "<p" + (caract ? '' : ' class="texto-vermelho"') + "><strong>Características inseridas:</strong> " + caract + "</p>";

    var mett1 = document.getElementById("metut").value;
    resumo += "<p" + (mett1 ? '' : ' class="texto-vermelho"') + "><strong>Métodos Utilizados:</strong> " + mett1 + "</p>";

    // Verificar proxies selecionados
    var proxySummary = "";
    if (document.getElementById("TSM").checked) {
        proxySummary += "TSM (Temperatura da Superfície do Mar), ";
    }
    if (document.getElementById("PP").checked) {
        proxySummary += "Produtividade Primária, ";
    }
    if (document.getElementById("circulacao").checked) {
        proxySummary += "Circulação Oceânica, ";
    }
    
    if (document.getElementById("org").checked) {
        proxySummary += "Marcadores Orgânicos, ";
    }
    if (document.getElementById("inorg").checked) {
        proxySummary += "Marcadores Inorgânicos, ";
    }
    if (document.getElementById("foramplan").checked) {
        proxySummary += "Foraminíferos Planctônicos, ";
    }
    if (document.getElementById("forambent").checked) {
        proxySummary += "Foraminíferos Bentônnicos, ";
    }
    if (document.getElementById("sealev").checked) {
        proxySummary += "Nível do Mar, ";
    }
    if (document.getElementById("co2atm").checked) {
        proxySummary += "CO<sub>2</sub> Atmosférico, ";
    }
    if (document.getElementById("cobveg").checked) {
        proxySummary += "Cobertura Vegetal, ";
    }
    if (document.getElementById("rainfall").checked) {
        proxySummary += "Precipitação, ";
    }
    if (document.getElementById("stratg").checked) {
        proxySummary += "Estratigrafia, ";
    }
    // Remover a vírgula extra no final, se houver
    if (proxySummary.slice(-2) === ', ') {
        proxySummary = proxySummary.slice(0, -2);
    }

    resumo += "<p" + (proxySummary ? '' : ' class="texto-vermelho"') + "><strong>Proxie(s) Selecionado(s):</strong> " + proxySummary + "</p>";

    var outroprox = document.getElementById("outroProx").value;
    resumo += "<p" + (outroprox ? '' : ' class="texto-vermelho"') + "><strong> Outro proxy:</strong> " + outroprox+ "</p>";
    
    var refef1 = document.getElementById("refef").value;
    resumo += "<p" + (refef1 ? '' : ' class="texto-vermelho"') + "><strong>Arquivo:</strong> " + refef1 + "</p>";



    //equipamentos 
    var coleta = "";
    if (document.getElementById("multcore").checked) {
        coleta += "MultiCorer, ";
    }
    if (document.getElementById("piston").checked) {
        coleta += "Piston Corer, ";
    }
    if (document.getElementById("gravcore").checked) {
        coleta += "Gravity Corer, ";
    }
    
    if (document.getElementById("drilli").checked) {
        coleta += "Drilling, ";
    }
    if (document.getElementById("gboxcore").checked) {
        coleta += "Giant box corer, ";
    }
    if (document.getElementById("compcore").checked) {
        coleta += "Composite Corer, ";
    }
    if (document.getElementById("boxcore").checked) {
        coleta += "Box Corer, ";
    }
    if (document.getElementById("corer").checked) {
        coleta += "Corer, ";
    }
    // Remover a vírgula extra no final, se houver
    if (coleta.slice(-2) === ', ') {
        coleta = coleta.slice(0, -2);
    }

    resumo += "<p" + (coleta ? '' : ' class="texto-vermelho"') + "><strong>Equipamento(s) Selecionado(s):</strong> " + coleta + "</p>";

    var outroequip = document.getElementById("outroEqui").value;
    resumo += "<p" + (outroequip ? '' : ' class="texto-vermelho"') + "><strong> Outro equipamento:</strong> " + outroequip+ "</p>";
    
    // Exibir o resumo no elemento summary2
    summary2.innerHTML = resumo;
}




