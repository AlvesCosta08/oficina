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

if (isset($data['id_categoria'])) {
    $id_categoria = $data['id_categoria']; // Corrigido o nome da variável

    $conn = connect();

    $stmt = $conn->prepare("DELETE FROM Categorias WHERE id_categoria = ?");
    $stmt->bind_param("i", $id_categoria);

    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(["message" => "Categoria deletada com sucesso"]); // Corrigido o texto da mensagem
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Erro ao deletar categoria"]);
    }

    $stmt->close();
    disconnect($conn);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Dados incompletos"]);
}
?>

