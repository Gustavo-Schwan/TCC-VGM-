<?php

include_once('conexao.php');







?>

<!DOCTYPE html>
<html id='html' lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style_co.css">
  <title>Cozinha</title>
</head>

<body>
  <script src='js/attPedido.js'></script>

  <div style="text-align:center" class="header">
    <ul class="menu">
      <li><a href="pagamento.php">Pagamento</a></li>
      <li><a href="cozinha.php">Cozinha</a></li>
      <li><a href="produtos.php">Produtos</a></li>
      <li><a href="criação.php">Criação</a></li>
      <li><a href="sair.php">Sair</a></li>

    </ul>
  </div>


  <?php
  $sql = "select * from carrinho
  where feito=0";

  $result = $mysqli->query($sql) or die("Falha no Banco: " . $mysqli->error);
  $rows = mysqli_num_rows($result);
  for ($i = 0; $i < $rows; $i++) {


    $cliente = mysqli_fetch_array($result);


  ?>

    <div class="containerpr">
      <div class="center">
        <div class="item">

          <div class="info">
            <br>
            <p class="tituloProduto" id='nome_cli'>
              <?php echo $cliente['nome_cli']  ?>
            </p>
            <br>
            <br>
            <p class="nome_produto">
              <?php
              echo  "Lanche: " .$cliente['nome_produto'] ?>
            </p>
            <br>
            <br>
            <p class="observacao">
              <?php
              echo  "Observacao: " .$cliente['obs'] ?>
            </p>
            <br>
            <p class="preco" id='quantidade'>
              <?php echo   "Quantidade: " .$cliente['quantidade'] ?>
            </p>
            <br>

            <button class="btn" onclick="UpdateTable('<?php echo $cliente['cod_carrinho']; ?>', 'carrinho')">
              Pedido Foi Feito
            </button>

            <br>
          </div>
        </div>

      <?php
    }
      ?>


      <script src='js/jQuery.js'></script>
</body>

</html>