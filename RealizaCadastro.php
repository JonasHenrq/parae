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
$usuario= $_POST['user'];
$password = $_POST['password'];
$tuser = $_POST['tuser'];	
$cpf = $_POST['cpf'];
if(($nome)&&($usuario)&&($password)&&($tuser)){
$sql = mysql_query("INSERT INTO usuario (name, cpf, user, password, tuser)
VALUES ('$nome', '$cpf', '$usuario', '$password', '$tuser')");
header("Location: sucesso.php");
} else {
	header("Location: FormularioCadastroUsuario.php");
}

mysql_close();

?>
<center><a href="paginicial.php">Voltar</a></center>
</body>
</html>