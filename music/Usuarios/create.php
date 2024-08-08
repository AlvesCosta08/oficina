<?php
/*session_start();
if (!isset($_SESSION['usuario_id'])) {
    // Se não estiver definida, redireciona para a página de login
    header("Location: index.php");
    exit();
}*/
require_once '../db.php';
header('Content-Type: application/json');

// Lê os dados JSON enviados no corpo da requisição
$data = json_decode(file_get_contents("php://input"), true);

// Verifica se os campos obrigatórios estão presentes
if (isset($data['nome']) && isset($data['email']) && isset($data['senha']) && isset($data['permissao'])) {
    $nome = $data['nome'];
    $email = $data['email'];
    $senha = password_hash($data['senha'], PASSWORD_DEFAULT); // Criptografar a senha
    $permissao = $data['permissao'];

    // Conecta ao banco de dados usando PDO
    $conn = connect();

    // Prepara a consulta SQL para inserir um novo usuário
    $stmt = $conn->prepare("INSERT INTO usuarios(nome, email, senha, permissao) VALUES (:nome, :email, :senha, :permissao)");
    
    // Bind dos parâmetros
    $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);
    $stmt->bindParam(':email', $email, PDO::PARAM_STR);
    $stmt->bindParam(':senha', $senha, PDO::PARAM_STR);
    $stmt->bindParam(':permissao', $permissao, PDO::PARAM_INT);

    // Executa a consulta e verifica se a inserção foi bem-sucedida
    if ($stmt->execute()) {
        http_response_code(201);
        echo json_encode(["message" => "Usuário criado com sucesso"]);
    } else {
        http_response_code(500);
        echo json_encode(["message" => "Erro ao criar usuário"]);
    }

    // Fecha a declaração e a conexão com o banco de dados
    $stmt = null; // Libera os recursos do statement
    disconnect($conn);
} else {
    // Retorna um erro 400 se os dados obrigatórios estiverem faltando
    http_response_code(400);
    echo json_encode(["message" => "Dados incompletos"]);
}
?>





