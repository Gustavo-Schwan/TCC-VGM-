<?php

session_start();
$servidor = "localhost";
$usario = "root";
$senha = "";
$dbname = "tcc";
//criar a conexao 
$mysqli = new mysqli($servidor, $usario, $senha, $dbname);
$conn = mysqli_connect($servidor, $usario, $senha, $dbname);
