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

	// Create connection
	$conn = mysql_connect($host,$user,$pass) or die (mysql_error());
	mysql_select_db($banco) or die(mysql_error());

	$nome = $_POST['name'];
	$porcentagem= $_POST['porc'];
	$validade = $_POST['validade'];
	if(($nome)&&($porcentagem)){
	$sql = mysql_query("INSERT INTO convenio (nome, porc, validade)
		VALUES ('$nome', '$porcentagem', '$validade')") or die (mysql_error());
	header("Location: sucesso.php");
	} else {
		header("Location: FormularioCadastroConvenio.php");
	}

	mysql_close();

	?>
	<center><a href="paginicial.php">Voltar</a></center>
	</body>
	</html>