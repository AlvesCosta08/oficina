<?php
session_start();

// Verifica se a variável de sessão 'usuario_id' não está definida
if (!isset($_SESSION['usuario_id'])) {
    // Se não estiver definida, redireciona para a página de login
    header("Location: index.php");
    exit();
}

//require_once '../db.php';
header('Content-Type: application/json');

// Lê os dados JSON enviados no corpo da requisição
$data = json_decode(file_get_contents("php://input"), true);

// Adiciona registro de log para verificar os dados recebidos
error_log("Dados recebidos: " . print_r($data, true));

// Verifica se os campos obrigatórios estão presentes
if (isset($data['titulo']) && isset($data['autor']) && isset($data['letra']) && isset($data['usuario_id'])) {
    $titulo = $data['titulo'];
    $autor = $data['autor'];
    $letra = $data['letra'];
    $usuario_id = $data['usuario_id'];

    // Conecta ao banco de dados
    $conn = connect();

    // Prepara a consulta SQL para inserir um novo hino
    $stmt = $conn->prepare("INSERT INTO hinos (titulo, autor, letra, usuario_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sssi", $titulo, $autor, $letra, $usuario_id);

    // Executa a consulta e verifica se a inserção foi bem-sucedida
    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(["message" => "Hino criado com sucesso"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Erro ao criar hino"]);

        // Adiciona registro de log para verificar erros no banco de dados
        error_log("Erro ao criar hino: " . $stmt->error);
    }

    // Fecha a declaração e a conexão com o banco de dados
    $stmt->close();
    disconnect($conn);
} else {
    // Retorna um erro 400 se os dados obrigatórios estiverem faltando
    http_response_code(400);
    echo json_encode(["message" => "Dados incompletos"]);

    // Adiciona registro de log para verificar quais campos estão faltando
    error_log("Dados incompletos: " . print_r($data, true));
}
?>



