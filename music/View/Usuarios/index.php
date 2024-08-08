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
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="../../assets/css/footer.css">
</head>

<body>

    <header class="bg-primary text-white p-3">
        <div class="container">
            <h1 class="mb-0"><i class="fas fa-book"></i> Gestão Usuários</h1>
        </div>
    </header>
    
    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 bg-light border-right p-3 d-md-block d-none">
                <ul class="nav flex-column">
                    <li class="nav-item mb-2">
                        <a class="nav-link text-dark" href="../Hinos/index.php"><i class="fas fa-home"></i> Home</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-dark" href="../Hinos/create.php"><i class="fas fa-user-plus"></i> Cadastro de Hinos</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-dark" href="../Hinos/get_filtro.php"><i class="fas fa-eye"></i> Visualizar Hinos</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-dark" href="../Usuarios/create.php"><i class="fas fa-user-plus"></i> Cadastro Usuários</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-dark" href="../Usuarios/get.php"><i class="fas fa-eye"></i></i> Visualizar Usuários</a>
                    </li>
                    <li class="nav-item mb-2">
                        <a class="nav-link text-dark" href="../../sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                    </li>
                </ul>
            </nav>
    
            <nav class="navbar navbar-expand-md navbar-light bg-light d-md-none d-block">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Menu</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-item mb-2">
                                <a class="nav-link text-dark" href="../Hinos/index.php"><i class="fas fa-home"></i>
                                    Home</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link text-dark" href="../Hinos/create.php"><i class="fas fa-user-plus"></i> Cadastro</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link text-dark" href="../Hinos/get_filtro.php"><i class="fas fa-eye"></i> Visualizar</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link text-dark" href="#"><i class="fas fa-cogs"></i> Settings</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link text-dark" href="#"><i class="fas fa-user"></i> Profile</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link text-dark" href="#"><i class="fas fa-folder"></i> Projects</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link text-dark" href="#"><i class="fas fa-comments"></i> Messages</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link text-dark" href="#"><i class="fas fa-calendar"></i> Calendar</a>
                            </li>
                            <li class="nav-item mb-2">
                                <a class="nav-link text-dark" href="../../sair.php"><i class="fas fa-sign-out-alt"></i> Sair</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
    
            <main class="col-md-10 p-4">
                <h2>Overview</h2>
                <div class="row">
                    <div class="col-md-4 mb-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-chart-bar"></i> Sales</h5>
                                <p class="card-text">This month: $10,000</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-white bg-info">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-users"></i> Users</h5>
                                <p class="card-text">New users: 200</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 mb-4">
                        <div class="card text-white bg-danger">
                            <div class="card-body">
                                <h5 class="card-title"><i class="fas fa-exclamation-triangle"></i> Alerts</h5>
                                <p class="card-text">Open alerts: 5</p>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
    
    <footer class="bg-dark text-white p-3">
        <div class="container">
            <p class="mb-0">© 2024 Dashboard. Todos os direitos reservados.</p>
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
</body>

</html>