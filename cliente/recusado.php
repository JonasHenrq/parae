<?php
session_start();
if(!isset($_SESSION["id"]) || !isset($_SESSION["valor"])){
    header("Location: index.php");
    exit;
}
$_SESSION['id'] = NULL;
$_SESSION['valor'] = NULL; 
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
    <title>Inserir Credito</title>
    <link rel="shortcut icon" href="../css/imagens/parae.ico" type="image/x-icon" />
    <center><img src="../css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" ></center>
    <br><br><br>
    <center><img src="../css/imagens/erro.png" class="img-rounded" width="100" height="105"></center>
    <center><h3>PEDIDO NÃO CONFIRMADO PELO PAYPAL!</h3></center>
    <br>
    <center><button class="btn btn-default" type="button" onclick="location.href='index.php'">Voltar</button></center>
</head>
<body>
