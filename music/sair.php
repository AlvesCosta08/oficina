<?php
// Inicia a sessão
session_start();

// Encerra a sessão (limpa todas as variáveis de sessão)
session_unset();
session_destroy();

// Redireciona de volta para index.php na raiz do projeto
header('Location: index.php');
exit;
?>
