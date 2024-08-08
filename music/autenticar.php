<?php
session_start(); // Inicia a sessão
require_once('db.php');

// Verifica se os dados foram submetidos via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Dados recebidos via POST (supondo que você já os validou e sanitizou)
    $nome = $_POST['nome'];
    $senha = $_POST['senha'];

    // Supondo que $conn seja seu objeto PDO já inicializado e conectado ao banco de dados

    try {
        // Preparando a consulta SQL para buscar a senha correspondente ao nome de usuário fornecido
        $sql = "SELECT id, nome, senha, permissao FROM usuarios WHERE nome = :nome";
        $conn = connect();
        // Preparando a declaração SQL
        $stmt = $conn->prepare($sql);

        // Vinculando os parâmetros
        $stmt->bindParam(':nome', $nome, PDO::PARAM_STR);

        // Executando a consulta
        $stmt->execute();

        // Verificando se encontrou algum usuário
        if ($stmt->rowCount() > 0) {
            // Usuário encontrado
            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

            // Verifica se a senha fornecida corresponde à senha armazenada
            if (password_verify($senha, $usuario['senha'])) {
                // Senha correta, armazena os dados do usuário na sessão
                $_SESSION['usuario_id'] = $usuario['id'];
                $_SESSION['usuario_nome'] = $usuario['nome'];
                $_SESSION['usuario_permissao'] = $usuario['permissao'];

                // Verifica a permissão do usuário para redirecionamento
                if ($usuario['permissao'] == 1) {
                    // Se a permissão for 1, redireciona para a página de usuários
                    header('Location: View/Usuarios/index.php');
                    exit;
                } elseif ($usuario['permissao'] == 0) {
                    // Se a permissão for 0, redireciona para a página de hinos
                    header('Location: View/Hinos/index.php');
                    exit;
                } else {
                    // Caso a permissão não seja nem 0 nem 1, trata o caso conforme necessário
                    echo "Permissão inválida.";
                    exit;
                }
            } else {
                // Senha incorreta
                echo "Nome de usuário ou senha inválidos.";
            }
        } else {
            // Usuário não encontrado
            echo "Nome de usuário ou senha inválidos.";
        }
    } catch (PDOException $e) {
        // Tratamento de erros de PDO, se necessário
        echo "Erro ao executar a consulta: " . $e->getMessage();
    }
}
?>

















