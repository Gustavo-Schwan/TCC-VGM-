<?php

include('conexao.php');
// LOGIN
if (isset($_POST['enviar'])) {
  if (empty($_POST['nome']) || empty($_POST['cpf'])) {
    header('Location: Index.php');
    exit();
  }


  $nome = mysqli_real_escape_string($conn, $_POST['nome']);
  $cpf = mysqli_real_escape_string($conn, $_POST['cpf']);
  // VERIFICA SE USUARIO EXISTE PARA LOGAR
  $query = "select * from usuario where nome = '{$nome}' and cpf = '{$cpf}'";

  $result = mysqli_query($conn, $query);
  $dados = $result->fetch_assoc();
  $row = mysqli_num_rows($result);

  if ($row == 1) {
    $_SESSION['usuario'] = $dados;
    header('Location: produtos.php');
    exit();
  } else {
    $_SESSION['nao_autenticado'] = true;

    echo '<script>alert("Usuario ou senha incorretos");</script>';
  }
}
?>
<!DOCTYPE html>
<html lang="en">
<div class="content">
  <div class="center">
    <!DOCTYPE html>
    <html lang="en">

    <head>
      <meta charset="UTF-8" />
      <meta name="viewport" content="width=device-width, initial-scale=1.0" />
      <meta http-equiv="X-UA-Compatible" content="ie=edge" />
      <title>Login</title>
      <link rel="stylesheet" href="css/styles.css" />
    </head>


    <!-- AREA DE INSERÇÃO DOS DADOS DE LOGIN -->

    <body>
      <div id="main-container">
        <h1>Faça seu login para acessar o sistema</h1>
        <form id="register-form" action="Index.php" method="POST">
          <div class="full-box">
            <label for="nome">Nome</label>
            <input type="text" name="nome" id="nome" placeholder="Digite seu nome completo" />
          </div>
          <div class="full-box">
            <label for="cpf">CPF</label>
            <input type="text" name="cpf" id="cpf" placeholder="Digite seu CPF" />
          </div>

          <div class="full-box">

            <div class="action">
              <button class="button_En" type="submit" name="enviar" value="Enviar">Entrar</button>
            </div>
          </div>

        </form>
        </br>
        <div class="full-box">
          <div class="action">


            <a href="cadastro.php"><button class="button_En" name="envia">Cadastrar </button> </a>

          </div>
        </div>




        </button>
      </div>
  </div>


</div>
<p class="error-validation template"></p>
<script src="js/scripts.js"></script>
</body>

</html>
</div>
</div>

</html>