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





                  
var contadorAutores=0 //variavel globar para controlar numero de autores
function adicionarAutor() {
                        // Container onde os campos de autor serão adicionados
                    
                        var container = document.getElementById("autoresContainer");
                        
                        var novoAutorContainer = document.createElement("div");
                        novoAutorContainer.className = "autor-campo";
                        novoAutorContainer.id="autorContainer" + contadorAutores;

            
                        // Criar novos elementos de input
                        var novoCampoNome = document.createElement("input");
                        novoCampoNome.type = "text";
                        novoCampoNome.className="autor-nome";
                        novoCampoNome.name = "coAutor" + contadorAutores ; // Use um array para coletar vários valores
                        novoCampoNome.placeholder = "Nome Completo";
                        novoCampoNome.style.width = "49%";
                        novoCampoNome.style.marginRight = "4.8px";
                        
                       
             
                        var novoCampoFiliacao = document.createElement("input");
                        novoCampoFiliacao.type = "text";
                        novoCampoFiliacao.className="autor-filiacao";
                        novoCampoFiliacao.name = "filiaçao" + contadorAutores;
                        novoCampoFiliacao.placeholder = "Filiação";
                        novoCampoFiliacao.style.width = "49%";
                    
                               
                        // Adicionar os novos campos ao container
                        container.appendChild(novoCampoNome);
                        
                        container.appendChild(novoCampoFiliacao);
                    
                        // Adicionar o botão de remover
                                      
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
                        novoProf.style.width = "10%";
                        novoProf.style.marginRight = "4.8px";
                        novoProf.maxLength=10;

                        var novoRecSed = document.createElement("input");
                        novoRecSed.type = "number";
                        novoRecSed.className="RecSed1";
                        novoRecSed.name = "RecSed1" + coordenadas ; // Use um array para coletar vários valores
                        novoRecSed.placeholder = "Recuperação Sedimentar";
                        novoRecSed.style.width = "10%";
                        novoRecSed.style.marginRight = "4.8px";
                        novoRecSed.maxLength=10;

                        var novoAnoCol = document.createElement("input");
                        novoAnoCol.type = "date";
                        novoAnoCol.className="anoColeta1";
                        novoAnoCol.name = "anoColeta1" + coordenadas ; // Use um array para coletar vários valores
                        novoAnoCol.placeholder = "Ano da coleta";
                        novoAnoCol.style.width = "10%";
                        novoAnoCol.style.marginRight = "4.8px";
                        novoAnoCol.maxLength=10;

                                                

            
                             
                               
                        // Adicionar os novos campos ao container
                        container.appendChild(novoID);
                        container.appendChild(novolatitude);
                        container.appendChild(novolongitude);
                        container.appendChild(novoProf);
                        container.appendChild(novoRecSed);
                        container.appendChild(novoAnoCol);



                 
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
    var summary = document.getElementById("summary");
    var resumo = "";

    //var tipoTrabalho = document.getElementById("tipoTrabalho").value;
    //var armazenamento = document.getElementById("armazenamento").value;

    resumo += "<p><strong>Autor Correspondente:</strong> " + document.getElementById("autorCorr").value + "</p>";
    resumo += "<p><strong>Filicação:</strong> " + document.getElementById("filiacaoCorr").value + "</p>";
    resumo += "<p><strong>E-mail:</strong> " + document.getElementById("email").value + "</p>";
    resumo += "<p><strong>Tipo de trabalho escolhido:</strong> " + document.getElementById("tipoTrabalho").value + "</p>";
    resumo += "<p><strong>Como deseja armazenar os dados? </strong>" + document.getElementById("armazenamento").value +"</p";
    resumo += "<p><strong> Título:</strong> " + document.getElementById("titulo").value + "</p>";
    
    //contagem de autores
    
    resumo += "<p><strong>Co-Autores:</strong> " + document.getElementById("").value + " (" + document.getElementById("filiacao").value + ")</p>";
    for (var i = 0; i < contadorAutores; i++) {
        var coAutor = document.getElementsByClassName("coAutor")[i].value;
        var filiacao = document.getElementsByClassName("coAutor-filiacao")[i].value;
        resumo += "<p><strong>Co-Autor:</strong> " + coAutor + " (" + filiacao + ")</p>";



        
    }
    resumo+="<p><strong>Nome do Periódico:</strong> " + document.getElementById("periodico").value + "</p>";


    resumo+="<p><strong>DOI:</strong> " + document.getElementById("doi").value + "</p>";


    resumo+="<p><strong>Volume da publicação:</strong> " + document.getElementById("volume").value + "</p>";

    resumo+="<p><strong>Data da publicação:</strong> " + document.getElementById("data").value + "</p>";

    resumo += "<p><strong>Palavras-Chave:</strong> " + document.getElementById("keywords").value + "</p>";

    resumo += "<p><strong>Highlights:</strong> " + document.getElementById("highlights").value + "</p>";

    resumo += "<p><strong>Resumo:</strong> " + document.getElementById("resumo").value + "</p>";

    resumo += "<p><strong>Características dos dados:</strong> " + document.getElementById("caract").value + "</p>";

    resumo += "<p><strong>Arquivo:</strong> " + document.getElementById("refef").value + "</p>";

    summary.innerHTML = resumo;
}



function exibirDADOS() {
    var summary = document.getElementById("summary-2");
    var resumo = "";

     
    //contagem de autores
    resumo += "<p><strong>Ponto:</strong> 1 Lat: " + document.getElementById("lat").value + " Long: " + document.getElementById("long").value + "</p>";
    for (var i = 0; i < coordenadas; i++) {
        var latitude = document.getElementsByClassName("lat1")[i].value ;
        var longitude = document.getElementsByClassName("long1")[i].value ;
        
        resumo += "<p><strong> Ponto: </strong> "+(i+2)+"  Lat:" + latitude + " Long:" + longitude + " </p>";
    }
        summary.innerHTML = resumo;

}



