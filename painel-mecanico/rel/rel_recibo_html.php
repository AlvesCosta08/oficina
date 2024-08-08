<?php
require_once("../../conexao.php");
@session_start();

$id = $_GET['id'];

require_once("data_formatada.php");


//DADOS DO ORÇAMENTO
$query_orc = $pdo->query("SELECT * FROM os where id = '$id' ");
$res_orc = $query_orc->fetchAll(PDO::FETCH_ASSOC);
$cpf_cliente = $res_orc[0]['cliente'];
$veiculo = $res_orc[0]['veiculo'];
$descricao = $res_orc[0]['descricao'];
$obs = $res_orc[0]['obs'];
$valor_orc = $res_orc[0]['valor_mao_obra'];
$valor = $res_orc[0]['valor'];
$mecanico = $res_orc[0]['mecanico'];
$data_orc = $res_orc[0]['data'];
$data_entrega = $res_orc[0]['data_entrega'];
$tipo = $res_orc[0]['tipo'];
$id_orc = $res_orc[0]['id_orc'];
$concluido = $res_orc[0]['concluido'];
$data = $res_orc[0]['data'];

$garantia = $res_orc[0]['garantia'];

$data_entrega = implode('/', array_reverse(explode('-', $data_entrega)));
$data = implode('/', array_reverse(explode('-', $data)));


$valor_orc_f = number_format($valor_orc, 2, ',', '.');
$valor_f = number_format($valor, 2, ',', '.');

$query_mec = $pdo->query("SELECT * FROM mecanicos where cpf = '$mecanico' ");
$res_mec = $query_mec->fetchAll(PDO::FETCH_ASSOC);
$nome_mecanico = $res_mec[0]['nome'];


$query_cli = $pdo->query("SELECT * FROM clientes where cpf = '$cpf_cliente' ");
$res_cli = $query_cli->fetchAll(PDO::FETCH_ASSOC);
$nome_cli = $res_cli[0]['nome'];
$telefone_cli = $res_cli[0]['telefone'];
$endereco_cli = $res_cli[0]['endereco'];
$email_cli = $res_cli[0]['email'];


$query_vei = $pdo->query("SELECT * FROM veiculos where id = '$veiculo' ");
$res_vei = $query_vei->fetchAll(PDO::FETCH_ASSOC);
$marca = $res_vei[0]['marca'] . ' - ' . $res_vei[0]['modelo'];
$placa = $res_vei[0]['placa'];
$cor = $res_vei[0]['cor'];
$ano = $res_vei[0]['ano'];
$km = $res_vei[0]['km'];

?>

<!DOCTYPE html>
<html>

<head>
	<title>Recibo</title>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

	<style>
		@page {
			size: A4;
			margin: 0;

		}

		.cabecalho {
			background-color: #ebebeb;
			padding: 10px;
			margin-bottom: 6px;
			width: 100%;
			height: 100px;
		}

		.titulo {
			margin: 0;
			font-size: 28px;
			font-family: Arial, Helvetica, sans-serif;
			color: #6e6d6d;

		}

		.subtitulo {
			margin: 0;
			font-size: 17px;
			font-family: Arial, Helvetica, sans-serif;
		}

		.areaTotais {
			border: 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right: 25px;
			margin-left: 25px;
			position: absolute;
			right: 20;
		}

		.areaTotal {
			border: 0.5px solid #bcbcbc;
			padding: 15px;
			border-radius: 5px;
			margin-right: 25px;
			margin-left: 25px;
			background-color: #f9f9f9;
			margin-top: 2px;
		}

		.pgto {
			margin: 1px;
		}

		.fonte13 {
			font-size: 12px;
			font-family: Arial, Helvetica, sans-serif;
		}

		.esquerda {
			display: inline;
			width: 50%;
			float: left;
		}

		.direita {
			display: inline;
			width: 50%;
			float: right;
		}

		.table {
			padding: 15px;
			font-family: Verdana, sans-serif;
			margin-top: 20px;
		}

		.texto-tabela {
			font-size: 12px;
		}


		.esquerda_float {

			margin-bottom: 10px;
			float: left;
			display: inline;
		}


		.titulos {
			margin-top: 10px;
		}

		.image {
			margin-top: -10px;
		}

		.margem-direita {
			margin-right: 80px;
		}

		hr {
			margin: 8px;
			padding: 1px;
		}

		body {
			padding: 20px 25px 15px 20px;
		}

		* {
			box-sizing: border-box;
		}

		.receipt-main {
			display: inline-block;
			width: 100%;
			padding: 5px;
			font-size: 12px;
			border: 1px solid #000;
		}

		.receipt-title {
			text-align: center;
			text-transform: uppercase;
			font-size: 18px;
			font-weight: 600;
			margin: 0;
			color: red;
		}

		.receipt-label {
			font-weight: 600;
		}

		.text-large {
			font-size: 16px;
		}

		.receipt-section {
			margin-top: 10px;
			padding: 0px;
		}

		.receipt-footer {
			text-align: center;
			background: #ff0000;
		}

		.receipt-signature {
			height: 80px;
			margin-left: 0px;
			margin: 50px 0;
			padding: 0 50px;
			background: #fff;

			.receipt-line {
				margin-bottom: 10px;
				border-bottom: 1px solid #000;
				margin-left: 0px;
			}

			p {
				text-align: center;
				margin: 0;
			}
		}

		.linha_ass {
			width: 0px;
			margin-left: 232px;
			margin-top: 0px;
		}

		.assinatura {
			font-size: 12px;
			margin-left: 195px;
			margin-top: -10px;
		}

		.texto_quantidade {
			margin-top: 0px;
			margin-left: 0px;
			font-size: 18px;
		}

		.texto-nome-cliente {
			margin-top: 0px;
			margin-left: 0px;
			font-size: 18px;
		}

		.linha_quantidade {
			width: 800px;
			margin-top: -37px;
			margin-left: 101px;
			font-size: 18px;
		}

		.texto-servicos {
			margin-top: -35px;
			margin-left: 0px;
			font-size: 18px;
		}

		.texto-confirmacao {
			margin-top: 0px;
			margin-left: 0px;
			font-size: 18px;
		}

		.garantia {
			margin-top: 0px;
			margin-left: 0px;
			font-size: 18px;
		}

		.linha_servicos {
			width: 800px;
			margin-top: 0px;
			margin-left: 100px;
			font-size: 18px;
		}
	</style>

</head>

<body>


	<div class="cabecalho">
		<div class="container">
			<div class="row titulos">
				<div class="col-sm-2 esquerda_float image">
					<img src="../../img/scar1.png" width="67">
				</div>
				<div class="col-sm-10 esquerda_float">
					<h2 class="titulo"><b><?php echo strtoupper($nome_oficina) ?></b></h2>
					<h6 class="subtitulo"><?php echo $endereco_oficina . ' Tel: ' . $telefone_oficina  ?></h6>

				</div>
			</div>
		</div>

	</div>

	<div class="receipt-main">

		<p class="receipt-title">Recibo</p>

		<div class="receipt-section pull-left">
			<span class="text-large"><strong>Número :</strong></span>
			<span class="receipt-label text-large"><?php echo $id ?></span>
		</div>

		<div class="pull-right receipt-section">
			<span class="text-large receipt-label">R$</span>
			<span class="text-large" style="color: #ff0000;"><b><?php echo $valor ?></b></span>
		</div>

		<div class="clearfix"></div>
		<!--
		<div class="receipt-section">
			<span class="receipt-label">Beneficiário:</span>
			<span>Tabata Ruiz (CPF: 333.333.333-99)</span>
		</div>

		<div class="receipt-section">
			<span class="receipt-label">Responsável:</span>
			<span>Tabata Ruiz (CPF: 333.333.333-99)</span>
		</div>
	    -->
		<div class="receipt-section">
			<p class="texto-nome-cliente">Recebi do(a)Sr.(a) <strong><?php echo $nome_cli; ?></strong><br>
			<p class="texto_quantidade">a quantia de</p>
			<p class="linha_quantidade" style="color: #ff0000;">&nbsp; <strong><?php echo valorPorExtenso($valor); ?></strong>,</p>
			<p class="linha_servicos"><strong>Serviços e Peças</strong> ,</p>
			<p class="texto-servicos">Referente a </p>
			<p class="texto-confirmacao"> pelo que firmamos o presente recibo,dando-lhe plena e total quitação.</p>
			<p class="garantia">Garantia : <strong><?php echo $garantia; ?></strong> dias</p>
		</div>

		<div class="receipt-section">
			<p class="pull-right text-large" style="margin-left: -20px;">Aquiraz , <?php setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'portuguese'); // Define o locale para português do Brasil
																					$data_atual = strftime('%A, %d de %B de %Y'); // Obtém a data atual por extenso
																					echo $data_atual; ?>
			</p>
		</div>

		<div class="clearfix"></div>

		<div class="col-xs-6">
			<p class="linha_ass">Jessica</p>
			<p class="assinatura"><strong>Gerente Administrativo</strong></p>
		</div>
	</div>

</body>

</html>

<?php
function valorPorExtenso($valor)
{
	// Array de extensoes
	$extenso = array(
		"zero",
		"um",
		"dois",
		"três",
		"quatro",
		"cinco",
		"seis",
		"sete",
		"oito",
		"nove",
		"dez",
		"onze",
		"doze",
		"treze",
		"quatorze",
		"quinze",
		"dezesseis",
		"dezessete",
		"dezoito",
		"dezenove"
	);

	// Array de dezenas
	$dezenas = array(
		"vinte",
		"trinta",
		"quarenta",
		"cinquenta",
		"sessenta",
		"setenta",
		"oitenta",
		"noventa"
	);

	// Array de centenas
	$centenas = array(
		"cento",
		"duzentos",
		"trezentos",
		"quatrocentos",
		"quinhentos",
		"seiscentos",
		"setecentos",
		"oitocentos",
		"novecentos"
	);

	// Verifica se o valor é válido
	if ($valor < 0 || $valor >= 1000000) {
		return "Valor inválido";
	}

	// Verifica se o valor é zero
	if ($valor == 0) {
		return "zero reais";
	}

	// Variáveis
	$reais = floor($valor);
	$centavos = round(($valor - $reais) * 100);

	// Texto em extenso
	$texto = "";

	// Parte dos reais
	if ($reais >= 1000) {
		$milhares = floor($reais / 1000);
		$texto .= $extenso[$milhares] . " mil";
		$reais %= 1000;
		if ($reais > 0) {
			$texto .= " e ";
		}
	}

	if ($reais >= 100) {
		$centena = floor($reais / 100);
		$texto .= $centenas[$centena - 1];
		$reais %= 100;
		if ($reais > 0) {
			$texto .= " e ";
		}
	}

	if ($reais >= 20) {
		$dezena = floor($reais / 10);
		$texto .= $dezenas[$dezena - 2];
		$reais %= 10;
		if ($reais > 0) {
			$texto .= " e ";
		}
	}

	if ($reais > 0) {
		$texto .= $extenso[$reais];
	}

	$texto .= " reais";

	// Parte dos centavos
	if ($centavos > 0) {
		$texto .= " e ";
		if ($centavos >= 20) {
			$dezena = floor($centavos / 10);
			$texto .= $dezenas[$dezena - 2];
			$centavos %= 10;
			if ($centavos > 0) {
				$texto .= " e ";
			}
		}
		if ($centavos > 0) {
			$texto .= $extenso[$centavos];
		}
		$texto .= " centavos";
	}

	return $texto;
}
?>