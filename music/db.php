<?php
require_once('config.php');

date_default_timezone_set('America/Sao_Paulo');

function connect() {
    global $banco, $servidor, $usuario, $senha_bd; // Importando as variáveis globais do arquivo config.php

    try {
        $conn = new PDO("mysql:dbname=$banco;host=$servidor;charset=utf8", $usuario, $senha_bd);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn; // Retorna o objeto PDO se a conexão for bem-sucedida
    } catch (PDOException $e) {
        echo 'Erro ao Conectar com o banco de dados! <p>' . $e->getMessage();
        exit(); // Sai do script se a conexão falhar
    }
}
function disconnect($conn) {
    $conn = null; // Closing the connection
}

?>



