<?php
/*session_start();

if (!isset($_SESSION['usuario_id'])) {
    // Se não estiver definida, redireciona para a página de login
    header("Location: index.php");
    exit();
}*/
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id'])) {
    $id = $data['id']; // Corrigido o nome da variável

    $conn = connect();

    $stmt = $conn->prepare("DELETE FROM usuarios WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(["message" => "Usuário deletada com sucesso"]); // Corrigido o texto da mensagem
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

