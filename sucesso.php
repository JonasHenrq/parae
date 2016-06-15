<?php 
session_start();
if(!isset($_SESSION["user"]) || !isset($_SESSION["password"])){
	header("Location: Login.php");
	exit;
} else {
	if ($_SESSION["tuser"]==1) {
		header("Location: Painel.php");
	}
	$NomeUser=$_SESSION["user"];
}
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Operação realizada com Sucesso!</title>
	<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
	<div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
<body>
	<br><br><br>
	<center><img src="css/imagens/sucesso.jpg" class="img-rounded" width="100" height="105"></center>
	<center><h2>Operação realizada com Sucesso!</h2></center>
	<center><button class="btn btn-default" type="button" onclick="location.href='paginicial.php'">Voltar</button></center>
</body>	
</head>