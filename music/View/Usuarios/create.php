<?php
session_start();

// Verifica se a variável de sessão 'usuario_id' não está definida
if (!isset($_SESSION['usuario_id'])) {
    // Se não estiver definida, redireciona para a página de login
    header("Location: index.php");
    exit();
}
 ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulário de Registro</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Registro de Usuário</h2>
        <form id="registrationForm">
            <div class="mb-3">
                <label for="nome" class="form-label">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="senha" class="form-label">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="mb-3">
                <label for="permissao" class="form-label">Permissão:</label>
                <input type="number" class="form-control" id="permissao" name="permissao" required>
            </div>
            <button type="submit" class="btn btn-primary">Registrar</button>
        </form>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            $('#registrationForm').submit(function (event) {
                event.preventDefault();

                var formData = {
                    'nome': $('#nome').val(),
                    'email': $('#email').val(),
                    'senha': $('#senha').val(),
                    'permissao': $('#permissao').val()
                };

                $.ajax({
                    type: 'POST',
                    url: '../../Usuarios/create.php',
                    data: JSON.stringify(formData),
                    contentType: 'application/json',
                    success: function (response) {
                        alert(response.message);
                        // Reset form fields
                        $('#registrationForm')[0].reset();
                    },
                    error: function (xhr, status, error) {
                        alert('Erro ao registrar usuário: ' + xhr.responseText);
                    }
                });
            });
        });
    </script>

</body>

</html>