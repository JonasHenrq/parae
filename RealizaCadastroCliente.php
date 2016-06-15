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
	$cpf= $_POST['cpf'];
	$rg = $_POST['rg'];
	$endereco = $_POST['endereco'];	
	$telefone = $_POST['telefone'];
	$placa = $_POST['placa'];
	$modelo = $_POST['modelo'];
	$convenio = $_POST['convenio'];
	$codigo = $_POST['codigo'];
	if(($nome)&&($cpf)){
		$sql = mysql_query("INSERT INTO cliente (nome, cpf, rg, endereco, telefone, placa, modelo, convenio, codigo)
			VALUES ('$nome', '$cpf', '$rg', '$endereco', '$telefone', '$placa', '$modelo', '$convenio', $codigo)");
		$sql2 = mysql_query("SELECT id FROM cliente WHERE cpf = '$cpf'") or die(mysql_error());
		$idCliente = mysql_fetch_row($sql2);
		$idCliente = $idCliente[0];
		$sql3 = mysql_query("INSERT INTO veiculo (modelo, placa, cliente)
			VALUES ('$modelo', '$placa', '$idCliente')")or die(mysql_error());
		header("Location: sucesso.php");
	} else {
		header("Location: FormularioCadastroCliente.php");
	}

	mysql_close();

	?>
	<center><a href="paginicial.php">Voltar</a></center>
</body>
</html>