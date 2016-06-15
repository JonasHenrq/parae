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
	<title>Consulta Convenio</title>
	<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
	<div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
	<center><h3>Convênios Cadastrados</h3></center>

</head>
<body>
	<?php
	$BD = "SELECT * FROM convenio";
	$sql = mysql_query($BD) or die(mysql_error());
	$row = mysql_num_rows($sql);
	if ($row > 0){
		echo '<center><table class="table table-striped"></center>';
		echo '<thead><tr>';
		echo '<th><center>Convênio</center></th>';
		echo '<th><center>Validade</center></th>';
		echo '<th><center>Desconto</center></th>';
		echo '<th></th>';
		echo '<th></th>';
		echo '</tr></thead>';
		while ($linha = mysql_fetch_array($sql)) {
			$status = $linha['status'];
			if($status){
				$id = $linha['id'];
				$nome = $linha['nome'];
				$porc = $linha['porc'];
				$validade = $linha['validade'];
				echo '<tr>';
				echo '<td>' .'<center>'. $nome. '</center>'.'</td>';
				echo '<td>' .'<center>'. $validade. '</center>'.'</td>';
				echo '<td>' .'<center>'. $porc.'%'. '</center>'.'</td>';
				echo '<td>' .'<center>'. "<a href='AlteraConvenio.php?id=$id&alt=0&fun=1'>Editar</a>" .'</center>'. '</td>';
				echo '<td>' .'<center>'. "<a href='ConfirmaExclusao.php?id=$id&alt=0&fun=2&t=2&nome=$nome'>Remover</a>".'</center>' . '</td>';
				echo '</tr>';
			}
		}
		echo "</table>";
	}
	?>
	<center> <button class="btn btn-default" type="button" onclick="location.href='javascript:window.history.go(-1)'">Voltar</button></center>


</body>
</html>