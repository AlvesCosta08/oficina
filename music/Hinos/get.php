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
$conn = connect();

$sql = "SELECT * FROM hinos";
$result = $conn->query($sql);

$hinos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hinos[] = $row;
    }
} else {
    http_response_code(404); // Define um código de resposta 404 se não houver clientes
}

disconnect($conn);

echo json_encode($hinos);
?>

