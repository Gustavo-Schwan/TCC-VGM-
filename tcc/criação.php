<?php

include_once('conexao.php');
if (isset($_POST['enviar'])) {

  // INSERE UM NOVO PRODUTO

  $nome = $_POST["nome"];
  $descricao = $_POST["descricao"];
  $preco = $_POST["preco"];


  //SALVA A FOTO MANDANDO PARA UMA PASTA E SALVANDO SEU DIRECIONAMENTO
  if (isset($_FILES["picture__input"])) {
    $extensao = strtolower(pathinfo($_FILES['picture__input']['name'], PATHINFO_EXTENSION));

    $nomefoto = md5($_FILES['picture__input']['name']) . time() . '.' . $extensao;

    $diretorio = "img/";

    move_uploaded_file($_FILES['picture__input']['tmp_name'], $diretorio . $nomefoto) or die('fudeo');
  } else {
    $msg = "se fudeo";
  }


  // VERIFICA SE NÃO HA NENHUMA INSERCÃO COM O MSM NOME 
  $sql = "select count(*) as total from produto where nome_pro = '$nome'";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);

  if ($row['total'] == 1) {
    $_SESSION['lanche_existe'] = true;
    header('Location: criação.php');
    exit;
  }

  $result_produto = "INSERT INTO produto (img,nome_pro,descricao,preco) VALUES ('$nomefoto','$nome', '$descricao','$preco')";
  $resultado_produto = mysqli_query($conn, $result_produto);



  //se inserir com sucesso 
  // apresenta msg caso der certo 
  if (mysqli_insert_id($conn)) {
    $_SESSION['msg'] = "<p style='color:green;'> Lanche cadastrado com sucesso </p>";
    //redireciona para arquivo indexe
    header("Location: produtos.php");
  } else {
    $_SESSION['msg'] = "<p style='color:red;'> Lanche não foi cadastrado </p>";
    header("Location: criação.php");
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<meta http-equiv="X-UA-Compatible" content="ie=edge" />
<title>Cadastro de Produtos</title>
<link rel="stylesheet" href="css/styles.css" />
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
  <!-- CADASTRO PARA INSERÇÃO DO PRODUTO -->
  <div class="content">
    <div class="center">
      <div id="main-container">
        <h1>Insira as Informações do lanche</h1>
        <form id="register-form" method="POST" action="criação.php" enctype="multipart/form-data">
          <div class="full-box">
            <label class="picture" name="imgm" for="picture__input" tabIndex="0">
              <span class="picture__image"></span>
            </label>

            <input type="file" name="picture__input" id="picture__input">
            <div class="full-box">
              <label for="nome">Nome do lanche</label>
              <input type="text" name="nome" id="nome" placeholder="Digite seu nome completo" data-required data-min-length="3" data-max-length="25" />
            </div>
            <div class="full-box">
              <strong>Coloque a composição do lanches:
                <textarea name="descricao" id="txta" cols="52" rows="8" style="resize: none; width: 100%;"></textarea><br></strong>
            </div>


            <div class="full-box">
              <label for="preco">Preço</label>
              <input type="text" name="preco" id="preco" placeholder="Digite o valor do produto" data-required />

            </div>

          </div>


          <div class="full-box">
            <div class="action">
              <button class="button_Env" type="submit" name="enviar" value="Enviar">Enviar
              </button>
            </div>
          </div>

      </div>
      </form>
    </div>
    <p class="error-validation template"></p>
    <script src="js/scripts.js"></script>
  </div>
  </div>
  </form>

  </div>
</body>

</html>