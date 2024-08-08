<?php 
require_once("../conexao.php"); 
@session_start();

$dataInicial      = $_POST['dataInicial'];
$dataFinal        = $_POST['dataFinal'];
$fornecedor       = $_POST['fornecedor'];


$html = file_get_contents($url."rel/rel_compras_html.php?dataInicial=$dataInicial&dataFinal=$dataFinal&fornecedor=$fornecedor");
echo $html;


?>