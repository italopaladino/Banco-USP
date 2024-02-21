document.addEventListener('DOMContentLoaded', function () {
    const registerLink = document.getElementById('registerLink');
    const registerForm = document.getElementById('registerForm');

    registerLink.addEventListener('click', function (event) {
        event.preventDefault();
        registerForm.style.display = 'block';
    });

    const registerButton = document.getElementById('registerButton');
    registerButton.addEventListener('click', function () {
        // Obtenha os dados do formulário
        const newUsername = document.getElementById('newUsername').value;
        const newPassword = document.getElementById('newPassword').value;

        // Crie um objeto FormData para enviar os dados do formulário
        const formData = new FormData();
        formData.append('newUsername', newUsername);
        formData.append('newPassword', newPassword);

        // Use AJAX para enviar os dados para o PHP
        const xhr = new XMLHttpRequest();
        xhr.open('POST', 'register.php', true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                alert(xhr.responseText); // Exiba a resposta do servidor (pode ser 'Registration successful' ou uma mensagem de erro)
            } else {
                alert('Erro ao processar o registro.');
            }
        };
        xhr.send(formData);
    });
});
