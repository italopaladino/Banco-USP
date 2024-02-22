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
        if (event.keyCode === 16) { //shift
            proximaPagina();  
        } else if (event.keyCode === 17) { //crtl
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
                        novoCampoNome.name = "primeiro" ; // Use um array para coletar vários valores
                        novoCampoNome.placeholder = "Primeiro Nome";
                        novoCampoNome.style.width = "33%";
                        novoCampoNome.style.marginRight = "4.8px";
                        
                       
            
                        var novoCampoSobrenome = document.createElement("input");
                        novoCampoSobrenome.type = "text";
                        novoCampoSobrenome.className = " autor-sobrenome";
                        novoCampoSobrenome.name = "sobrenome";
                        novoCampoSobrenome.placeholder = "Sobrenome";
                        novoCampoSobrenome.style.width = "33%";
                        novoCampoSobrenome.style.marginRight = "4.8px";

            
                        var novoCampoFiliacao = document.createElement("input");
                        novoCampoFiliacao.type = "text";
                        novoCampoFiliacao.className="autor-filiacao";
                        novoCampoFiliacao.name = "filiaçao";
                        novoCampoFiliacao.placeholder = "Filiação";
                        novoCampoFiliacao.style.width = "33%";
                    
                               
                        // Adicionar os novos campos ao container
                        container.appendChild(novoCampoNome);
                        container.appendChild(novoCampoSobrenome);
                        container.appendChild(novoCampoFiliacao);
                    
                        // Adicionar o botão de remover
                                      
                    contadorAutores++;                               
                    }
                
                    
                    function deletarAutor() {
                        var container = document.getElementById("autoresContainer");
                        
                        // Verifica se há mais de três campos de autor para excluir e pelo menos um autor deve permanecer
                        if (container.children.length > 3) {
                            // Remove os três últimos filhos do container
                            for (var i = 0; i < 3; i++) {
                                var ultimoAutor = container.lastChild;
                                container.removeChild(ultimoAutor);
                            }
                    
                            // Decrementa o contador de autores
                            contadorAutores--;
                        } else {
                            // Se houver menos de três campos de autor, exiba um alerta informando que pelo menos um autor deve ser mantido
                            window.alert("Ao menos um autor tem que ser inserido ");
                        }
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
                        var novolatitude = document.createElement("input");
                        novolatitude.type = "text";
                        novolatitude.className="lat1";
                        novolatitude.name = "latitude" + coordenadas ; // Use um array para coletar vários valores
                        novolatitude.placeholder = "Latitute:   -XX.XXXXX";
                        novolatitude.style.width = "33%";
                        novolatitude.style.marginRight = "4.8px";
                        novolatitude.maxLength=10;
                        
                        
                       
                                          
                       
            
                        var novolongitude = document.createElement("input");
                        novolongitude.type = "text";
                        novolongitude.className = "long1";
                        novolongitude.name = "longitude" + coordenadas;
                        novolongitude.placeholder = "Longitude:   -YY.YYYYY";
                        novolongitude.style.width = "33%";
                        novolongitude.style.marginRight = "4.8px";
                        novolongitude.maxLength=10;
                                                

            
                             
                               
                        // Adicionar os novos campos ao container
                        container.appendChild(novolatitude);
                        container.appendChild(novolongitude);

                 
                        container.appendChild(document.createElement("br"));
                                      
                    coordenadas++;                               
                    }
                
                    
                    function deletarCoordenadas() {
                        var container = document.getElementById("coordenadas");
                        
                        // Verifica se há mais de três campos de autor para excluir e pelo menos um autor deve permanecer
                        if (container.children.length > 3) {
                            // Remove os três últimos filhos do container
                            for (var i = 0; i < 3; i++) {
                                var ultimaCoord = container.lastChild;
                                container.removeChild(ultimaCoord);
                            }
                    
                            // Decrementa o contador de autores
                            coordenadas--;
                        } else {
                            // Se houver menos de três campos de autor, exiba um alerta informando que pelo menos um autor deve ser mantido
                            window.alert("Ao menos um ponto precisa ser inserido");
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
        






            //FAZER FUNCIONAR ESSE COMPARATIVO comparativo entre os emails -- Novo-USER
      
                    function validateForm() {
                        var email = document.getElementById('email').value;
                        var confirmEmail = document.getElementById('confirmEmail').value;
                
                        if (email !== confirmEmail) {
                            alert('Os endereços de e-mail não coincidem.');
                            return false;
                        }
                
                        // Restante da lógica do formulário ou envio para o servidor
                        // ...
                
                        return true;
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

    resumo += "<p><strong>Título:</strong> " + document.getElementById("titulo").value + "</p>";
    resumo += "<p><strong>E-mail:</strong> " + document.getElementById("email").value + "</p>";
    
    //contagem de autores
    resumo += "<p><strong>Autor-Correspondente:</strong> " + document.getElementById("primeiro").value + " " + document.getElementById("sobrenome").value + " (" + document.getElementById("filiacao").value + ")</p>";
    for (var i = 0; i < contadorAutores; i++) {
        var primeiroNome = document.getElementsByClassName("autor-nome")[i].value;
        var sobrenome = document.getElementsByClassName("autor-sobrenome")[i].value;
        var filiacao = document.getElementsByClassName("autor-filiacao")[i].value;
        resumo += "<p><strong>Co-Autor:</strong> " + primeiroNome + " " + sobrenome + " (" + filiacao + ")</p>";
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



