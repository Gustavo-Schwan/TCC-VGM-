  <?php

  include_once('conexao.php');
  if (isset($_POST['enviar'])) {

    // MANDA OS DADOS PRO BANCO

    $nome = $_POST["nome"];
    $cargo = $_POST["cargo"];
    $endereco = $_POST["endereco"];
    $telefone = $_POST["telefone"];
    $cpf = $_POST["cpf"];
    $rg = $_POST["rg"];

    // VERIFICA SE SO TEM UM USUARIO POR CPF
    $sql = "select count(*) as total from usuario where cpf = '$cpf'";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);

    if ($row['total'] == 1) {
      $_SESSION['usuario_existe'] = true;
      echo '<script>alert("Usuario com CPF ja cadastrado");</script>';
      header("Refresh: 0");
      exit;
    }

    $result_usuario = "INSERT INTO usuario (nome,cargo,endereco,telefone,cpf,rg) VALUES ('$nome','$cargo', '$endereco','$telefone','$cpf','$rg')";
    $resultado_usuario = mysqli_query($conn, $result_usuario);



    //se inserir com sucesso 
    // apresenta msg caso der certo 
    if (mysqli_insert_id($conn)) {
      $_SESSION['msg'] = "<p style='color:green;'> Usuario cadastrado com sucesso </p>";
      //redireciona para arquivo indexe
      header("Location: Index.php");
    } else {
      $_SESSION['msg'] = "<p style='color:red;'> Usuario não foi cadastrado </p>";
      header("Location: cadastro.php");
    }
  }
  ?>
  <!DOCTYPE html>
  <html lang="en">
  <div class="content">
    <div class="center">

      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <title>Cadastro</title>
      <link rel="stylesheet" href="css/styles.css" />
      </head>

      <body>
        <!-- FORMULARIO PRA CADASTRO -->
        <div id="main-container">
          <h1>Cadastre-se acessar o sistema</h1>
          <form id="register-form" method="POST" action="cadastro.php">
            <div class="full-box">
              <label for="nome">Nome</label>
              <input type="text" name="nome" id="nome" placeholder="Digite seu nome completo" data-required data-min-length="3" data-max-length="25" />
            </div>
            <div class="full-box">
              <label for="cargo">Cargo</label>
              <input type="text" name="cargo" id="cargo" placeholder="Digite seu cargo" data-required data-min-length="3" data-max-length="30" />
            </div>
            <div class="full-box">
              <label for="endereco">Endereço</label>
              <input type="text" name="endereco" id="endereco" placeholder="Digite seu endereco" data-required data-min-length="3" data-max-length="35" />
            </div>

            <div class="full-box">
              <label for="telefone">Telefone</label>
              <input type="text" name="telefone" id="telefone" placeholder="Digite seu telefone" data-min-length="11" data-required data-min-length />
            </div>
            <div class="half-box spacing">
              <label for="cpf">CPF</label>
              <input type="text" name="cpf" id="cpf" placeholder="Digite seu CPF" data-required />
            </div>
            <div class="half-box">
              <label for="rg">RG</label>
              <input type="text" name="rg" id="rg" placeholder="Digite seu RG" data-required />
            </div>
            <div>
              <input type="checkbox" name="agreement" id="agreement" />
              <label for="agreement" id="agreement-label">Eu li e aceito os <a href="#">termos de uso</a></label>
            </div>
            <div class="full-box">
              <div class="action">
                <button class="button_Env" type="submit" name="enviar" value="Enviar">Enviar
                </button>
              </div>
            </div>
          </form>
          </br>
          <div class="full-box">
            <div class="action">


              <a href="index.php"><button class="button_En" name="envia">Logar </button> </a>

            </div>
          </div>




          <p class="error-validation template"></p>
          <script src="js/scripts.js"></script>



        </div>
      </body>
    </div>
  </div>

  </html>