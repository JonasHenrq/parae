<?php 
session_start();
if(!isset($_SESSION["user"]) || !isset($_SESSION["password"])){
	header("Location: Login.php");
	exit;
}
	$NomeUser=$_SESSION["user"];
?>

<!DOCTYPE html>
<html>
<head>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>ERRO 500</title>
	<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
	<div align="right"> Olá, <?php echo $NomeUser ?> | <a href="paginicial.php"><i class="icon-home"></i></a> | <a href="logout.php">Sair</a></div>
<body>
	<br><br><br>
	<center><img src="css/imagens/erro.png" class="img-rounded" width="100" height="105"></center>
	<center><h2><?php 
	$op = $_GET['op'];
	if($op==1){
		echo "CLIENTE NÃO ENCONTRADO";
	}
	if($op==2){
		echo "CLIENTE NÃO CADASTRADO OU SEÇÃO NÃO INICIADA";
	}
	if($op==5){
		echo "NÃO HÁ VAGAS DISPONIVEIS";
	}
	?></h2></center>
	<center><button class="btn btn-default" type="button" onclick="location.href='javascript:window.history.go(-1)'">Voltar</button></center>
</body>	
</head>