<?php
include_once('../conexao.php');


$id_pro = $_POST['id_pro'];
$nome_cli = $_POST['nome'];
$quantidade = $_POST['quantidade'];
$obs = $_POST['obs'];
$nome_pro = $_POST['nome_pro'];
$precoItem = $_POST['precoItem'];

if($obs == ''){
    $obs = 'Sem observação';
}

$sql = "INSERT into carrinho (cod_carrinho, nome_cli, id_pro, nome_produto, quantidade, obs, preco) 
                    values (null, '$nome_cli', '$id_pro', '$nome_pro' ,'$quantidade','$obs', '$precoItem')";
        if(mysqli_query($conn, $sql)){
            return;
        }
        
        echo mysqli_error($conn)
?>