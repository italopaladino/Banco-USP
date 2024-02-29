// adicionar aluno 
                    
var contadorAutores=0 //variavel globar para controlar numero de autores
function adicionarAutor() {
                        // Container onde os campos de autor serão adicionados
                    
                        var container = document.getElementById("autoresContainer");
                        
                        var novoAutorContainer = document.createElement("div");
                        novoAutorContainer.className = "autor-campo";
                        novoAutorContainer.id="autorContainer" + contadorAutores

            
                        // Criar novos elementos de input
                        var novoCampoNome = document.createElement("input");
                        novoCampoNome.type = "text";
                        novoCampoNome.name = "primeiro" + contadorAutores; // Use um array para coletar vários valores
                        novoCampoNome.placeholder = "Primeiro Nome";
                        novoCampoNome.style.width = "33%";
            
                        var novoCampoSobrenome = document.createElement("input");
                        novoCampoSobrenome.type = "text";
                        novoCampoSobrenome.name = "sobrenome"+ contadorAutores;
                        novoCampoSobrenome.placeholder = "Sobrenome";
                        novoCampoSobrenome.style.width = "33%";
            
                        var novoCampoFiliacao = document.createElement("input");
                        novoCampoFiliacao.type = "text";
                        novoCampoFiliacao.name = "filiaçao";
                        novoCampoFiliacao.placeholder = "Filiação" + contadorAutores;
                        novoCampoFiliacao.style.width = "33%";
                        
                        /*var botaoRemover = document.createElement("button");
                        botaoRemover.type = "button";
                        botaoRemover.textContent = "Remover Autor";
                        botaoRemover.onclick = function() {
                        container.removeChild(novoAutorContainer);
                        }*/
                        
                        // Adicionar os novos campos ao container
                        container.appendChild(novoCampoNome);
                        container.appendChild(novoCampoSobrenome);
                        container.appendChild(novoCampoFiliacao);
                    
                        // Adicionar o botão de remover
                   

                    // Adicionar o novoAutorContainer ao container
                    container.appendChild(novoAutorContainer);
            
                        // Adicionar uma quebra de linha para melhorar a apresentação
                        // container.appendChild(document.createElement("br"));
                                
                    }
                
                function deletarAutor(){
                   var container=document.getElementById("autoresContainer");
                   
                   if (container.children.length>0){
                       var ultimoAutor = container.lastChild;
   
                       container.removeChild(ultimoAutor);
                } else{
                   console.log("Não há mais autores para")
                }
            } 




            
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
        
            function submeterFormulario() {
              // Lógica de envio do formulário
              alert("Formulário submetido com sucesso!");
            }
                 