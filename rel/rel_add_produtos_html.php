<?php 
require_once("../conexao.php"); 
@session_start();
require_once("data_formatada.php"); 
?>

<!DOCTYPE html>
<html>
<head>
    <title>Catálogo de Produtos</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <style>

        @page {
            margin: 0px;

        }

        .footer {
            margin-top:20px;
            width:100%;
            background-color: #ebebeb;
            padding:10px;
            position:relative;
            bottom:0;
        }

        .cabecalho {    
            background-color: #ebebeb;
            padding:10px;
            margin-bottom:30px;
            width:100%;
            height:100px;
        }

        .titulo{
            margin:0;
            font-size:28px;
            font-family:Arial, Helvetica, sans-serif;
            color:#6e6d6d;

        }

        .subtitulo{
            margin:0;
            font-size:17px;
            font-family:Arial, Helvetica, sans-serif;
        }

        .areaTotais{
            border : 0.5px solid #bcbcbc;
            padding: 15px;
            border-radius: 5px;
            margin-right:25px;
            margin-left:25px;
            position:absolute;
            right:20;
        }

        .areaTotal{
            border : 0.5px solid #bcbcbc;
            padding: 15px;
            border-radius: 5px;
            margin-right:25px;
            margin-left:25px;
            background-color: #f9f9f9;
            margin-top:2px;
        }

        .pgto{
            margin:1px;
        }

        .fonte13{
            font-size:13px;
        }

        .esquerda{
            display:inline;
            width:50%;
            float:left;
        }

        .direita{
            display:inline;
            width:50%;
            float:right;
        }

        .table{
            padding:15px;
            font-family:Verdana, sans-serif;
            margin-top:20px;
        }

        .texto-tabela{
            font-size:12px;
        }


        .esquerda_float{

            margin-bottom:10px;
            float:left;
            display:inline;
        }


        .titulos{
            margin-top:10px;
        }

        .image{
            margin-top:-20px;
        }

        .margem-direita{
            margin-right: 80px;
        }

        .margem-direita50{
            margin-right: 50px;
        }

        hr{
            margin:8px;
            padding:1px;
        }


        .titulorel{
            margin:0;
            font-size:28px;
            font-family:Arial, Helvetica, sans-serif;
            color:#6e6d6d;

        }

        .margem-superior{
            margin-top:30px;
        }


    </style>

</head>
<body>


    <div class="cabecalho">
        <div class="container">
            <div class="row titulos">
                <div class="col-sm-2 esquerda_float image">    
                    <img src="../img/scar1.png" width="85">
                </div>
                <div class="col-sm-10 esquerda_float">    
                    <h2 class="titulo"><b><?php echo strtoupper($nome_oficina) ?></b></h2>
                    <h6 class="subtitulo"><?php echo $endereco_oficina . ' Tel: '.$telefone_oficina  ?></h6>

                </div>
            </div>
        </div>

    </div>

    <div class="container">

        <div class="row">
            <div class="col-sm-8 esquerda">    
                <span class="titulorel"> Lista de Produtos </span>
            </div>
            <div class="col-sm-4 direita" align="right">    
                <big> <small> Data: <?php echo $data_hoje; ?></small> </big>
            </div>
        </div>


        <hr>

        <!-- Formulário de adição de produto -->
        <form action="adicionar_produto.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="nome">Nome do Produto</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="categoria">Categoria</label>
                <input type="text" class="form-control" id="categoria" name="categoria" required>
            </div>
            <div class="form-group">
                <label for="fornecedor">Fornecedor</label>
                <input type="text" class="form-control" id="fornecedor" name="fornecedor" required>
            </div>
            <div class="form-group">
                <label for="valor_compra">Valor de Compra</label>
                <input type="text" class="form-control" id="valor_compra" name="valor_compra" required>
            </div>
            <div class="form-group">
                <label for="valor_venda">Valor de Venda</label>
                <input type="text" class="form-control" id="valor_venda" name="valor_venda" required>
            </div>
            <div class="form-group">
                <label for="quantidade">Quantidade</label>
                <input type="text" class="form-control" id="quantidade" name="quantidade" required>
            </div>
            <div class="form-group">
                <label for="imagem">Imagem do Produto</label>
                <input type="file" class="form-control-file" id="imagem" name="imagem" required>
            </div>
            <button type="submit" class="btn btn-primary">Adicionar Produto</button>
        </form>
        <!-- Fim do formulário de adição de produto -->

        <hr>

        <div class="row margem-superior">
            <div class="col-md-12">
                <div class="" align="right">
                                
                    <span class="areaTotal"> <b> Total de Produtos : R$ <?php echo $totalProdutos ?> </b> </span>
                </div>

            </div>
        </div>

        <hr>


    </div>


    <div class="footer">
        <p style="font-size:14px" align="center"><?php echo $rodape_relatorios ?></p> 
    </div>




</body>
</html>
