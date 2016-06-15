	<!DOCTYPE HTML>
	<html>
	<head>
		<title>Cadastrando...</title>
	</head>

	<body>
	<?php
	$host = "localhost";
	$user = "root";
	$pass = "";
	$banco = "user";

	$conn = mysql_connect($host,$user,$pass) or die (mysql_error());
	mysql_select_db($banco) or die(mysql_error());

	$setor = $_POST['setor'];
	$vcarro= $_POST['vcarro'];
	$sql = mysql_query("INSERT INTO vaga (setor, vcarro)
		VALUES ('$setor', '$vcarro')") or die (mysql_error());
	header("Location: sucesso.php");
	mysql_close();

	?>
	<center><a href="paginicial.php">Voltar</a></center>
	</body>
	</html>