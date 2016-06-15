<?php
$host = "localhost";
$user = "root";
$pass = "";
$banco = "user";
$conexao = mysql_connect($host, $user, $pass);
mysql_select_db($banco) or die (mysql_error());
?>

<html>
<head>
	<title>Autenticando Usuario</title>
	<script type="text/javascript">
		function loginsuccessfully(){
			setTimeout("window.location='paginicial.php'",1000);	
		}
		function loginsuccessfully2(){
			setTimeout("window.location='Painel.php'",1000);	
		}
		function loginfailed(){
			setTimeout("window.location='login.php'",1000);
		}
	</script>
</head>
<body>

<?php
$usuario = $_POST['usuario'];
$senha = $_POST['senha'];
$sql = mysql_query("SELECT * FROM usuario WHERE user = '$usuario' and password = '$senha'") or die(mysql_error());
$row = mysql_num_rows($sql);
$tuser= mysql_fetch_array($sql);
$tusuario = $tuser['tuser'];
if($row > 0 ){
	session_start();
	$_SESSION['user']=$_POST['usuario'];
	$_SESSION['password']=$_POST['senha'];
	$_SESSION['tuser']=$tusuario;
	echo "<center>Você foi autenticado com sucesso! Aguarde um instante...</center>";
	if ($tusuario>1) {
			echo "<script>loginsuccessfully()</script>";
	} else {
		echo "<script>loginsuccessfully2()</script>";
	}
	

}else {
	echo "<center>Nome de usuario ou senha invalida! Retornando para tela de login...</center>";
	echo "<script>loginfailed()</script>";
}
?>


</body>
</html>