<?php
session_start();
if (!isset($_SESSION['usuario_id'])) {
    // Se não estiver definida, redireciona para a página de login
    header("Location: index.php");
    exit();
}
require_once '../db.php';
header('Content-Type: application/json');

$data = json_decode(file_get_contents("php://input"), true);

if (isset($data['id']) && isset($data['nome']) && isset($data['email']) && isset($data['senha']) && isset($data['permissao'])) {
    $id = $data['id'];
    $nome = $data['nome'];
    $email = $data['email'];
    $senha = password_hash($data['senha'], PASSWORD_DEFAULT); // Criptografar a senha
    $permissao = $data['permissao']; // Novo atributo permissao

    $conn = connect();

    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, email = ?, senha = ?, permissao = ? WHERE id = ?");
    $stmt->bind_param("sssii", $nome, $email, $senha, $permissao, $id); // "sssii" significa que estamos ligando três strings e dois inteiros

    if ($stmt->execute()) {
        http_response_code(200);
        echo json_encode(["message" => "Usuário atualizado com sucesso"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Erro ao atualizar usuário"]);
    }

    $stmt->close();
    disconnect($conn);
} else {
    http_response_code(400);
    echo json_encode(["message" => "Dados incompletos"]);
}
?>


