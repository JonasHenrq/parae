<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "user";
$conexao = mysql_connect($host, $user, $pass);
mysql_select_db($banco) or die (mysql_error());
?>

<?php
session_start();
if(!isset($_SESSION["id"]) || !isset($_SESSION["valor"])){
    header("Location: index.php");
    exit;
}
    $id = $_SESSION['id'];
    $valor = $_SESSION['valor']; 
    $consultaSaldo = mysql_query("SELECT saldo FROM cliente WHERE id = '$id'") or die(mysql_error());
    $Saldovector = mysql_fetch_row($consultaSaldo);
    $saldo = $Saldovector[0];
    $saldo = $saldo + $valor;
    mysql_query("UPDATE cliente SET saldo = '$saldo' WHERE id ='$id'");
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
    <br><br>
    <center><img src="../css/imagens/sucesso.jpg" class="img-rounded" width="100" height="105"></center>
    <center><h3>CREDITO INSERIDO COM SUCESSO! </h3></center>
    <br>
    <center><button class="btn btn-default" type="button" onclick="location.href='index.php'">Voltar</button></center>
</head>
<body>