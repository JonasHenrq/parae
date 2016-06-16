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
	$valor = $_POST['valor'];
	function pv($pv_var){
	//muda ponto para virgula ou vice-versa
	//ex. x=pv("100.00"); o resultado será 100,00
	//ex. x=pv("100,00"); o resultado será 100.00
		$pv_tipo=',';
		if ($pv_tipo == '.') {
			return str_replace('.',',',$pv_var);
		} else {
			return str_replace(',','.',$pv_var);
		}
	}
	$valor = pv($valor);
	$sql = mysql_query("INSERT INTO vaga (setor, vcarro, valor)
		VALUES ('$setor', '$vcarro', '$valor')") or die (mysql_error());
	header("Location: sucesso.php");
	mysql_close();

	?>
	<center><a href="paginicial.php">Voltar</a></center>
	</body>
	</html>