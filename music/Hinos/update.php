<?php
session_start();

// Verifica se a variável de sessão 'usuario_id' não está definida
if (!isset($_SESSION['usuario_id'])) {
    // Se não estiver definida, redireciona para a página de login
    header("Location: index.php");
    exit();
}
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['titulo']) && isset($data['autor']) && isset($data['letra']) && isset($data['usuario_id'])) {
    $titulo = $data['titulo'];
    $autor = $data['autor'];
    $letra = $data['letra'];
    $usuario_id = $data['usuario_id'];

    $conn = connect();

    $stmt = $conn->prepare("UPDATE hinos SET titulo = ?, autor = ?, letra = ? WHERE usuario_id = ?");
    $stmt->bind_param("sssi", $titulo, $autor, $letra, $usuario_id); // "sssi" significa que estamos ligando três strings e um inteiro

    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(["message" => "Hino atualizado com sucesso"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Erro ao atualizar hino"]);
    }

    $stmt->close();
    disconnect($conn);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Dados incompletos"]);
}
?>


