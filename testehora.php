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
 #echo "\nSão $hora e $min minutos Porra BIIIIIIIIIIIIRRRRR!!";
 #echo money_format('%n', $min);
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

<?php
function placaCliente(){
	$id = $_GET['id'];
	if(!$id){header("Location: FormularioCadastroCliente.php");}
	$BD = "SELECT placa FROM veiculo WHERE cliente = '$id'" or die(mysql_error());
	$sql = mysql_query($BD) or die(mysql_error());
	$row = mysql_num_rows($sql);
	if ($row > 0){
		while ($linha = mysql_fetch_array($sql)) {
			$id = $linha['placa'];
			echo '<option value="'.$id.'"><center>'.$id.'</center></option>';
		}
	}
}

?>

<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<title>Confirmar Dados</title>
	<link rel="shortcut icon" href="css/imagens/parae.ico" type="image/x-icon" />
	<center><img src="css/imagens/paraefinal.png" class="img-rounded" width="200" height="205" onclick="location.href='paginicial.php'"></center>
	<div align="right"> Olá, <?php echo $NomeUser ?> | <a href="logout.php">Sair</a></div>
	<center><h3>CONFIRMAR DADOS</h3></center>
	<br><br>
	<script language="Javascript">
		function formatar(mascara, documento){
			var i = documento.value.length;
			var saida = mascara.substring(0,1);
			var texto = mascara.substring(i)

			if (texto.substring(0,1) != saida){
				documento.value += texto.substring(0,1);
			}
		}
	</script>   

</head>
<body>

	<form action="ConsultaCliente.php" method="GET">
		<center>
			<label>
				<h5>Hora de Entrada: </h5>
				<input type="text" class="input-mini" type="text" name="horaE" value="<?php echo "$hora";?>" style="text-align: center;"> : 
				<input type="text" class="input-mini" name="horaS" value="<?php echo "$min";?>" style="text-align: center;">
			</label>
			<label>
				<h5>Placa Veiculo: </h5>
				<SELECT name= "veiculo">
					<?php
					placaCliente();
					?>
				</SELECT>
			</label>
			<label>
				<br>
				<button class="btn btn-default" type="submit">Confirmar</button>   
			</label>
			<br>
			<a href='AdicionaVeiculo.php?id=<?php $id = $_GET['id']; echo "$id"; ?>'>Cadastrar Novo Veículo</a>
		</form></center>