<?php

include_once('conexao.php');






?>
<!DOCTYPE html>
<html id='html' lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="css/style_pro.css">
  <title>Pedido</title>
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
  <div class="containerpr">

  <?php
  $sql = "select * from produto LIMIT 0, 100 ";
  $result = $mysqli->query($sql) or die("Falha no Banco: " . $mysqli->error);
  $rows = mysqli_num_rows($result);
  for ($i = 0; $i < $rows; $i++) {

    $lanche = mysqli_fetch_array($result);

  ?>

    
      <div class="center">
        <div class="item">
          <br>
          <img src=<?php echo  "img/" . $lanche['img'] ?> class="imagem" id='img_<?php echo $lanche['id_pro']; ?>'>
          <div class="info">
            <p class="tituloProduto" id='nome_<?php echo $lanche['id_pro']; ?>'>
              <?php echo $lanche['nome_pro'] ?>
            </p>
            <br>
            <br>
            <textarea class="descricao" rows="5" cols="33" readonly="true" style="resize: none" >
              <?php echo  $lanche['descricao'] ?>
            </textarea>
            <br>
           
            <p class="preco" id='preco_<?php echo $lanche['id_pro']; ?>'>
              <?php echo "R$".$lanche['preco'].",00"; ?>
            </p>
            <br>
            <label>
              <input type="number" class='quantidade' value='1' id='quantidade_<?php echo $lanche['id_pro']; ?>' />
            </label>
            <br>
            <input type='text' placeholder="Observação" class='obs' id='obs_<?php echo $lanche['id_pro']; ?>' />
            <br>
            <button class='btn' onclick="puxaInfos(<?php echo $lanche['id_pro']; ?>)">Adicionar ao carrinho</button>


          </div>
        </div>
        </div>

      <?php
    }
      ?>

<div class="containerpr">
<div class="center">
        
      <div class='output' id='output'>
        <div id='itens'>

        </div>
        <div class='footer' id='footer'>
          <div class='inputs'>
            <input id='nome' type='text' placeholder="Nome" />
            <input type="number" id='mesa' placeholder="Mesa" />
            <input id='numero' type='text' placeholder="Numero de Telefone" />
          </div>
          <div>
          <h1 > Valor total: R$</h2>
              <span id='valorTotal'>0.00</span>
              <button class="btn" id='enviar'>Enviar Pedido</button>

          </div>
        </div>
      </div>
      </div>
    </div>
    <script>
      //puxa o botão de enviar pedido e aguarda ser clicado
      btn = document.getElementById('enviar')
      btn.addEventListener('click', () => {

        //quando clicado, puxa a lista dos produtos dentro do carrinho
        lista = document.querySelectorAll('.itemPedido')


        //e para cada um
        lista.forEach(element => {

          const lanches = Array(element)
          const tags = element.childNodes
          const div = tags[2].childNodes
          const precoItem = tags[4].children[0].innerText
          console.log(precoItem)
          console.log(tags)
          //puxa as informações necessarias 
          let id = tags[0].innerText
          let quantidade = tags[3].innerText
          let obs = div[1].innerText
          const nome_pro = document.getElementById('nome_' + id).innerHTML
          const nome = document.getElementById('nome').value

          //caso nao hover obs, nao deixa enviar nulo
          if (obs == '') {
            obs = "S/Obs"
          }

          //e envia para o php
          $.post("carrinho/addCarrinho.php", {
              id_pro: id,
              nome: nome,
              nome_pro: nome_pro,
              quantidade: quantidade,
              obs: obs,
              precoItem: precoItem
            },
            (retorno) => {

              //se ocorrer algum erro, retorno ao usuario
              if (retorno !== "") {
                alert(retorno)
                return
              }
            })


        })

        //puxa os inputs do pedido
        const nomeInput = document.getElementById('nome')
        const mesaInput = document.getElementById('mesa')
        const numeroInput = document.getElementById('numero')

        //e seus valores
        const nome = nomeInput.value
        const mesa = mesaInput.value
        const numero = numeroInput.value

        //e em seguida reseta seus valores
        nomeInput.value = ""
        mesaInput.value = ""
        numeroInput.value = ''

        //puxa o valor total
        const valorFinal = document.getElementById("valorTotal").innerText

        //e envia ao php
        $.post("carrinho/addPedido.php", {
            nome: nome,
            telefone: numero,
            preco: valorFinal,
            mesa: mesa
          },
          (retorno) => {
            //se houver erro, retorna ao usuario
            if (retorno !== "") {
              alert(retorno)
              return
            }

            //caso contrario puxa a lista
            const content = document.getElementById('itens')
            //e apaga
            content.innerText = ""

            //puxa o valor total
            const span = document.getElementById('valorTotal')
            //e reseta 
            span.innerText = '0,00'
          })
      });
    </script>
    <script src='js/carrinho.js'></script>
    <script src='js/jQuery.js'></script>
</body>

</html>