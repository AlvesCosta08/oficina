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

$searchTerm = '%' . $_GET['searchTerm'] . '%'; // Prepare the search term for a LIKE query

$sql = "SELECT * FROM hinos WHERE autor LIKE ? OR titulo LIKE ? OR letra LIKE ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('sss', $searchTerm, $searchTerm, $searchTerm);
$stmt->execute();
$result = $stmt->get_result();

$hinos = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $hinos[] = $row;
    }
} else {
    http_response_code(404); // Define a 404 response code if no hymns match the search
}

disconnect($conn);

echo json_encode($hinos);
?>

