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
  $sql = "select * from pedido as p
  inner join carrinho as c
  on p.nome_clie = c.nome_cli
  where c.feito=1 and
  p.pronto=0";


  $result = $mysqli->query($sql) or die("Falha no Banco: " . $mysqli->error);
  $rows = mysqli_num_rows($result);
  for ($i = 0; $i < $rows; $i++) {


    $pagamento = mysqli_fetch_array($result);


  ?>

    <div class="containerpr">
      <div class="center">
        <div class="item">

          <div class="info">
            <br>
            <p class="tituloProduto" id='nome_cli'>
              <?php echo $pagamento['nome_cli']  ?>
            </p>
            <br>
            <br>
            <p class="nome_produto">
              <?php
              echo  "Nome do produto: " .$pagamento['nome_produto'] ?>
            </p>
            <br>
            <br>
            <p class="observacao">
              <?php
              echo "Observação: " . $pagamento['obs'] ?>
            </p>
            <br>
            <p class="observacao">
              <?php
              echo "Preço: " . $pagamento['preco'] . ",00" ?>
            </p>
            <br>
            <p class="observacao">
              <?php
              echo "Telefone: " . $pagamento['telefone_cli'] ?>
            </p>
            <br>
            <p class="observacao">
              <?php
              echo  "Mesa: " .$pagamento['mesa'] ?>
            </p>
            <br>
            
            <p class="observacao" id='quantidade'>
              <?php echo  "Quantidade: " . $pagamento['quantidade'] ?>
            </p>
            <br>

            <button class="btn" onclick="UpdateTable('<?php echo $pagamento['id_ped']; ?>', 'pedido')">
              Pedido Foi Pago
            </button>
            <br>
          </div>
        </div>

      <?php
    }
      ?>

      <script src='js/jQuery.js'></script>
      <script src='js/attPedido.js'></script>
</body>

</html>