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
    <title>Lista de Usuários</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Lista de Usuários</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Permissão</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody id="userList"></tbody>
        </table>
    </div>

    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function () {
            // Função para carregar a lista de usuários via AJAX
            function loadUserList() {
                $.ajax({
                    type: 'GET',
                    url: '../../Usuarios/get.php',
                    dataType: 'json',
                    success: function (response) {
                        $('#userList').empty();
                        response.forEach(function (user) {
                            var row = '<tr>';
                            row += '<td>' + user.id + '</td>';
                            row += '<td>' + user.nome + '</td>';
                            row += '<td>' + user.email + '</td>';
                            row += '<td>' + user.permissao + '</td>';
                            row += '<td>';
                            row += '<a href="../../Usuarios/update.php" class="btn btn-primary btn-sm editUser" data-id="' + user.id + '">Editar</a>';
                            row += '<a href="../../Usuarios/delete.php" class="btn btn-danger btn-sm deleteUser" data-id="' + user.id + '">Excluir</a>';
                            row += '</td>';
                            row += '</tr>';
                            $('#userList').append(row);
                        });
                    },
                    error: function (xhr, status, error) {
                        alert('Erro ao carregar lista de usuários: ' + xhr.responseText);
                    }
                });
            }

            // Carregar lista de usuários quando a página é carregada
            loadUserList();

            // Evento de clique para excluir usuário
            $(document).on('click', '.deleteUser', function () {
                var userId = $(this).data('id');
                if (confirm('Tem certeza que deseja excluir este usuário?')) {
                    $.ajax({
                        type: 'POST',
                        url: '../../Usuarios/delete.php',
                        data: { id: userId },
                        success: function (response) {
                            alert(response.message);
                            loadUserList(); // Recarregar lista após exclusão
                        },
                        error: function (xhr, status, error) {
                            alert('Erro ao excluir usuário: ' + xhr.responseText);
                        }
                    });
                }
            });

            // Evento de clique para editar usuário (substitua o link "#" por sua página de edição)
            $(document).on('click', '.editUser', function () {
                var userId = $(this).data('id');
                // Redirecionar para a página de edição, passando o ID do usuário como parâmetro
                window.location.href = '../../Usuarios/update.php?id=' + userId;
            });
        });
    </script>
</body>

</html>