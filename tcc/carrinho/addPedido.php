<?php
include_once('../conexao.php');

$nome = $_POST['nome'];
$telefone = $_POST['telefone'];
$preco = $_POST['preco'];
$mesa = $_POST['mesa'];
$hora = date('H:i');


$sql = "INSERT INTO pedido (id_ped, nome_clie, telefone_cli, mesa,
                             preco_t, data, hora, pronto)
                    Value (null, '$nome', '$telefone','$mesa', '$preco', now(), '$hora', 0)";

                    if(mysqli_query($conn, $sql)){
                        return;
                    }

                    echo mysqli_error($conn);
                    
?>