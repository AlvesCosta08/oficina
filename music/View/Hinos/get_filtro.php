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
    <title>Pesquisar</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Font Awesome CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <style>
        body {
            padding: 20px;
            background-color: #f0f8ff; /* Light blue background for calmness */
            font-family: 'Times New Roman', Times, serif;
        }
        .hino-container {
            max-height: 80vh;
            overflow-y: auto;
            padding: 20px;
            background-color: #ffffff; /* White background for content readability */
            border-radius: 8px;
            margin-top: 20px;
            border: 1px solid #ccc;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .card {
            margin-bottom: 20px;
            border: none;
            background-color: #e0f7fa; /* Light cyan background for the cards */
        }
        .card-title {
            font-size: 24px;
            font-weight: bold;
            color: #00796b; /* Teal color for the title to signify calmness and sophistication */
        }
        .card-subtitle {
            color: #004d40; /* Darker teal for the subtitle */
        }
        .card-text {
            white-space: pre-wrap; /* Preserve line breaks */
            font-size: 18px;
            line-height: 1.6;
            font-family: 'Courier New', Courier, monospace; /* Gives a typewriter look */
            color: #37474f; /* Blue-grey for text to ensure readability */
        }
        .action-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 10px;
            margin-bottom: 10px;
        }
        .btn-secondary {
            background-color: #ffcc80; /* Light orange for print button */
            border-color: #ffa726; /* Darker orange border */
            color: #fff;
        }
        .btn-success {
            background-color: #66bb6a; /* Light green for share button */
            border-color: #43a047; /* Darker green border */
            color: #fff;
        }
        .btn-primary {
            background-color: #4fc3f7; /* Light blue for search button */
            border-color: #29b6f6; /* Darker blue border */
            color: #fff;
        }
        .btn-primary:hover, .btn-secondary:hover, .btn-success:hover {
            opacity: 0.9;
        }
        .text-muted {
            color: #607d8b; /* Blue-grey for muted text */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center" style="color: #00796b;"><a href="../../View/Hinos/index.html" class="btn btn-primary w-100 mt-3">
            <i class="fas fa-book"></i>  HINOS
        </a></h1>
        <div class="input-group mb-3">
            <input type="text" id="searchInput" class="form-control" placeholder="Buscar hinos por autor, título ou letra">
            <button class="btn btn-primary" type="button" onclick="searchHinos()">
                <i class="fa fa-search"></i> Buscar
            </button>
        </div>
        <div id="hinoList" class="hino-container">
            <!-- Resultados dos hinos aparecerão aqui -->
        </div>
        <h1 class="text-center" style="color: #00796b;">
            <a href="../../View/Hinos/index.html" class="btn btn-success w-100 mt-3">
                <i class="fas fa-arrow-left me-2"> </i> DASHBOARD
            </a>
       </h1>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <!-- Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function searchHinos() {
        let searchTerm = $('#searchInput').val();

        $.ajax({
            url: '../../Hinos/get_param.php',
            type: 'GET',
            data: { searchTerm: searchTerm },
            dataType: 'json',
            success: function (data) {
                let html = '';
                if (data.length > 0) {
                    data.forEach(function (hino) {
                        html += `
                            <div class="card">
                                <div class="card-body">
                                    <h5 class="card-title">${hino.titulo}</h5>
                                    <h6 class="card-subtitle mb-2 text-muted">${hino.autor}</h6>
                                    <div class="action-buttons">
                                        <button class="btn btn-secondary" onclick="printHino('${hino.titulo}', '${hino.autor}', \`${hino.letra.replace(/'/g, "\\'")}\`)">
                                            <i class="fa fa-print"></i> Imprimir
                                        </button>
                                        <button class="btn btn-success" onclick="shareHino('${hino.titulo}', '${hino.autor}', \`${hino.letra.replace(/'/g, "\\'")}\`)">
                                            <i class="fas fa-share-alt"></i> Compartilhar
                                        </button>
                                    </div>
                                    <p class="card-text">${formatLyrics(hino.letra)}</p>
                                </div>
                            </div>
                        `;
                    });
                } else {
                    html = '<p class="text-center">Nenhum hino encontrado.</p>';
                }
                $('#hinoList').html(html);
            },
            error: function () {
                $('#hinoList').html('<p class="text-center text-danger">Erro ao buscar hinos.</p>');
            }
        });
    }

    function formatLyrics(lyrics) {
        return lyrics.split('\n\n').map(stanza => `<p>${stanza.replace(/\n/g, '<br>')}</p>`).join('');
    }

    function printHino(titulo, autor, letra) {
        let printWindow = window.open('', '_blank');
        printWindow.document.write(`
            <html>
                <head>
                    <title>${titulo}</title>
                    <style>
                        body { font-family: 'Times New Roman', Times, serif; padding: 20px; }
                        h1, h2 { text-align: center; }
                        pre { white-space: pre-wrap; font-family: 'Courier New', Courier, monospace; }
                    </style>
                </head>
                <body>
                    <h1>${titulo}</h1>
                    <h2>${autor}</h2>
                    <pre>${letra}</pre>
                </body>
            </html>
        `);
        printWindow.document.close();
        printWindow.print();
    }

    function shareHino(titulo, autor, letra) {
        let whatsappUrl = `https://wa.me/?text=${encodeURIComponent(titulo + '\n' + autor + '\n\n' + letra)}`;
        window.open(whatsappUrl, '_blank');
    }
</script>

</body>
</html>







