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
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">

    <!-- Seu CSS Personalizado -->
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        h2 {
            font-family: 'Roboto', sans-serif;
            font-weight: 700;
            color: #4CAF50;
            /* Ajuste a cor conforme desejado */
        }

        form {
            max-width: 400px;
            margin: 0 auto;
        }

        input,
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            box-sizing: border-box;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
        }

        .message {
            margin-top: 20px;
            padding: 10px;
        }

        .error {
            background-color: #f44336;
            color: white;
        }
    </style>
</head>

<body>

    <header class="bg-primary text-white p-3">
        <div class="container">
            <h1 class="mb-0"><i class="fas fa-book"></i> Caderno Digital</h1>
        </div>
    </header>

    <main class="container mt-5">
        <section class="row justify-content-center">
            <article class="col-lg-6">
                <h2 class="mb-4 text-center">Formulário de Criação de Hino</h2>
                <form id="hinoForm">
                    <div class="mb-3">
                        <label for="titulo" class="form-label">Título</label>
                        <input type="text" id="titulo" class="form-control" placeholder="Título" required>
                    </div>
                    <div class="mb-3">
                        <label for="autor" class="form-label">Autor</label>
                        <input type="text" id="autor" class="form-control" placeholder="Autor" required>
                    </div>
                    <div class="mb-3">
                        <label for="letra" class="form-label">Letra</label>
                        <textarea id="letra" class="form-control" placeholder="Letra" rows="6" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="usuario_id" class="form-label">ID do Usuário</label>
                        <input type="text" id="usuario_id" class="form-control" placeholder="ID do Usuário" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100"><i class="fas fa-music me-2"></i>CADASTRAR HINO
                    </button>
                    <a href="../../View/Hinos/index.html"  type="submit" class="btn btn-primary w-100 mt-3">
                        <i class="fas fa-arrow-left me-2"> </i> DASHBOARD
                    </a>

                </form>
                <div id="message" class="message mt-3"></div>
            </article>
        </section>
    </main>

    <footer class="text-center mt-5">
        <p>&copy; 2024 Criação de Hinos. Todos os direitos reservados.</p>
    </footer>

    <!-- Bootstrap 5 JavaScript (opcional, apenas se precisar de funcionalidades JS) -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>

    <script>
        document.getElementById('hinoForm').addEventListener('submit', function (event) {
            event.preventDefault();

            var titulo = document.getElementById('titulo').value;
            var autor = document.getElementById('autor').value;
            var letra = document.getElementById('letra').value;
            var usuario_id = document.getElementById('usuario_id').value;

            var data = {
                titulo: titulo,
                autor: autor,
                letra: letra,
                usuario_id: usuario_id
            };

            fetch('../../Hinos/create.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(data)
            })
                .then(response => response.json())
                .then(data => {
                    if (data.message) {
                        showMessage(data.message, 'success');
                    } else {
                        showMessage('Erro desconhecido', 'error');
                    }
                })
                .catch(error => {
                    showMessage('Erro ao criar hino', 'error');
                    console.error('Erro:', error);
                });
        });

        function showMessage(message, type) {
            var messageDiv = document.getElementById('message');
            messageDiv.textContent = message;
            messageDiv.className = 'message ' + type;
        }
    </script>

</body>

</html>



