<?php
include_once('conexao.php');
 

$id=$_POST['id'];
$table = $_POST['table'];
if($table == 'carrinho'){
    $sql = "UPDATE carrinho SET feito=1
    where cod_carrinho = '$id'";   
} elseif ($table == "pedido" ){
    $sql = "UPDATE pedido SET pronto =1
    where id_ped = '$id'";
}

        if(mysqli_query($conn, $sql)){
            return;
        }
        
        echo mysqli_error($conn);
