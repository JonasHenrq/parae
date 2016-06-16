<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "user";
$conexao = mysql_connect($host, $user, $pass);
mysql_select_db($banco) or die (mysql_error());
?>

<?php
setlocale (LC_ALL, 'pt_BR');
date_default_timezone_set("America/Sao_Paulo");
$hora = date("H"); 
$min = date("i");
?>

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
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Confirmar Dados</title>
	<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
     <div align="right"> Olá, <?php echo $NomeUser ?> | <a href="paginicial.php"><i class="icon-home"></i></a> | <a href="logout.php">Sair</a></div>
	<center><h3>SELECIONE O PERÍODO</h3></center>
	<br><br>
	<script language="Javascript">
		function validar(){
      if(document.form.diaI.value==""){
        alert("Por favor insira todos os dados!");
        document.form.diaI.focus();
        return false;
      }
      if(document.form.diaF.value==""){
        alert("Por favor insira todos os dados!");
        document.form.diaF.focus();
        return false;
      } else {
        return true;       
      }
    }		
		</script>  

</head>
<body>

	<form name = "form" action="relatorio.php" method="post" onsubmit="return validar();">
		<center>
			<label>
				<h5>De: </h5>
				<input class="input-defaut" type="date" name="diaI"> 
			</label>
				<h5>Até: </h5>
				<input class="input-defaut" type="date" name="diaF">  
			</label>
				<br><br>
				<button class="btn btn-default" type="submit">Confirmar</button>   
			</label>
			<br><BR><BR>
			<center><button class="btn btn-default" type="button" onclick="location.href='javascript:window.history.go(-1)'">Voltar</button></center>
		</form></center>